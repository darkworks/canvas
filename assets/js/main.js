var addEventToEditButtons;

/**
 * Ajax requests to server
 */
var http = {
    /**
     * Wrapper request of ajax
     * @param  {string}   type     type of requests
     * @param  {string}   url      url of request
     * @param  {Function} callback callback function
     * @param  {string}   body     body of request
     * @return {void}
     */
    send: function(type, url, callback, body) {
        var xhr = new XMLHttpRequest();
        xhr.open(type, url, true);
        if (type == 'POST') {
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
        xhr.addEventListener("readystatechange", function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                callback(JSON.parse(xhr.responseText), xhr.headers, xhr.status);
            }
        });

        xhr.send(body);
    },

    /**
     * Send post request
     * @param  {string}   url      url of request
     * @param  {Function} callback callback function
     * @param  {string}   body     body of request
     * @return {void}
     */
    post: function(url, callback, body) {
        this.send('POST', url, callback, body);
    }
};

/**
 * Canvas editor
 */
var paint = (function() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext("2d");
    var clearButton = document.getElementById('clear');
    var saveButton = document.getElementById('save');
    var editButton = document.getElementsByClassName("edit");

    var oldX;
    var oldY;
    var drawing = false;

    /**
     * Drawing canvas lines
     * @param  {object} e mouse objects
     * @return {void}
     */
    var draw = function(e) {

        if (!oldX || !oldY) {
            oldX = e.offsetX;
            oldY = e.offsetY;
        }

        context.beginPath();
        context.moveTo(oldX, oldY);
        context.lineTo(e.offsetX, e.offsetY);
        context.stroke();

        oldX = e.offsetX;
        oldY = e.offsetY;
    }

    /**
     * Saving canvas image to server
     * @return {void}
     */
    var save = function() {

        var image = canvas.toDataURL("image/png");
        var imageId = this.getAttribute("data-imageid");

        if (imageId) {
            var body = "image=" + image + "&id=" + imageId;
        } else {
            var password = prompt("Please enter your password");

            if (!password) {
                return false;
            }

            var body = "image=" + image + "&password=" + password;
        }

        /**
         * Callback
         * @param  {mixed} body     body of response
         * @param  {ojects} headers response headers
         * @param  {integer} status response status
         * @return {boolean}        return in error
         */
        var mycallback = function(body, headers, status) {

            if (!body) {
                alert('Unknown error!');
                return false;
            }

            if (body.error) {
                alert('Error save Image!');
                return false;
            }

            if (imageId) {
                var editElement = document.getElementById('image_' + imageId);
                editElement.setAttribute('src', body.image + '?' + new Date().getTime());
                return false;
            }

            var gallery = document.getElementById('gallery');
            var div = document.createElement('div');
            div.setAttribute('class', 'picture');
            div.setAttribute('id', 'picture_' + body.id);
            var editButton = '<span data-image="image_' + body.id + '" class="edit btn btn-default btn-sm glyphicon glyphicon-pencil" title="Edit"></span>';
            div.innerHTML = editButton + '<img id="image_' + body.id + '" src="' + body.image + '" width="150" height="150" />';
            gallery.insertBefore(div, gallery.firstChild);

            addEventToEditButtons();
        }

        http.post('/save', mycallback, body);
    }

    /**
     * Editing canvas image
     * @return {[type]} [description]
     */
    var edit = function() {
        clear(false);

        var password = prompt("Please enter password for editing");

        if (!password) {
            return false;
        }

        var id = this.getAttribute("data-image");
        var body = "imageid=" + id.replace('image_', '') + "&password=" + password;

        /**
         * Callback
         * @param  {mixed} body     body of response
         * @param  {ojects} headers response headers
         * @param  {integer} status response status
         * @return {boolean}        return in error
         */
        var mycallback = function(body, headers, status) {

            if (!body) {
                alert('Unknown error!');
                return false;
            }

            if (body.error) {
                alert('Password wrong!');
                return false;
            }

            if (!body.image) {
                alert('Unknown error!');
                return false;
            }

            var img = new Image();
            img.src = body.image;
            context.drawImage(img, 0, 0);
            saveButton.setAttribute('data-imageid', id.replace('image_', ''));
        }

        http.post('/access', mycallback, body);
    }

    /**
     * Clear window canvas
     * @return {void}
     */
    var clear = function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    canvas.addEventListener("mousemove", function(e) {
        if (drawing) {
            draw(e);
        }
    });

    canvas.addEventListener("mousedown", function() {
        drawing = true;
    });

    canvas.addEventListener("mouseup", function() {
        drawing = false;
        oldX = null;
        oldY = null;
    });

    canvas.addEventListener("mouseout", function() {
        drawing = false;
        oldX = null;
        oldY = null;
    });

    clearButton.addEventListener("click", clear);

    saveButton.addEventListener("click", save);

    /**
     * Handlers put in the edit button
     * @return {void}
     */
    addEventToEditButtons = function() {
        for (var i = 0; i < editButton.length; i++) {
            editButton[i].addEventListener("click", edit, false);
        }
    };

    addEventToEditButtons();

})();


/**
 * Load images from Ajax
 * @return {void}
 */
var pagination = (function() {

    var getImages = function() {
        var currentPage = parseInt(this.getAttribute("data-page"), 10);

        var body = "page=" + (currentPage + 1);

        /**
         * Callback
         * @param  {mixed} body     body of response
         * @param  {ojects} headers response headers
         * @param  {integer} status response status
         * @return {boolean}        return in error
         */
        var mycallback = function(body, headers, status) {
            if (!body) {
                alert('Unknown error!');
                return false;
            }

            if (!body.images || !body.currentpage) {
                alert('Unknown error!');
                return false;
            }

            if (body.images.length == 0 || !body.button) {
                moreButton.style.display = 'none';
            }

            for (var i = 0; i < body.images.length; i++) {
                var gallery = document.getElementById('gallery');
                var div = document.createElement('div');
                div.setAttribute('class', 'picture');
                div.setAttribute('id', 'picture_' + body.images[i].id);
                var editButton = '<span data-image="image_' + body.images[i].id + '" class="edit btn btn-default btn-sm glyphicon glyphicon-pencil" title="Edit"></span>';
                div.innerHTML = editButton + '<img id="image_' + body.images[i].id + '" src="' + body.path + body.images[i].name+ '" width="150" height="150" />';
                gallery.appendChild(div);
            };

            moreButton.setAttribute('data-page', body.currentpage);
            addEventToEditButtons();
        }

        http.post('/getimages', mycallback, body);
    };

    var moreButton = document.getElementById('more');
    if (!!moreButton) {
        moreButton.addEventListener("click", getImages, false);
    }
})();
