var http = {
    send: function(type, url, callback, body) {
        var xhr = new XMLHttpRequest();
        xhr.open(type, url, true);
        if(type == 'POST') {
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
        xhr.addEventListener("readystatechange", function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                callback(JSON.parse(xhr.responseText), xhr.headers, xhr.status);
            }
        });

        xhr.send(body);
    },
    post: function(url, callback, body) {
        this.send('POST', url, callback, body);
    }
};

var paint = (function() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext("2d");
    var clearButton = document.getElementById('clear');
    var saveButton = document.getElementById('save');
    var editButton = document.getElementsByClassName("edit");

    var oldX;
    var oldY;
    var drawing = false;

    var draw = function(e) {
        // var position = document.getElementById('position');

        // position.innerText = 'X: ' + e.clientX + ' Y: ' + e.clientY
        // + '   OffsetX: ' + e.offsetX + ' OffsetY: ' + e.offsetY
        // + '   OffsetLeft: ' + canvas.offsetLeft + ' OffsetTop: ' + canvas.offsetTop;

        if(!oldX || !oldY) {
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

    var save = function() {
        var password = prompt("Please enter your password");

        var image = canvas.toDataURL("image/png");
        var body = "image=" + image + "&password=" + password;

        var mycallback = function(body, headers, status) {

            if(!body) {
                alert('Unknown error!');
                return false;
            }

            if(body.error) {
                alert('Error save Image!');
                return false;
            }

            var gallery = document.getElementById('gallery');
            var div = document.createElement('div');
            div.setAttribute('class', 'picture');
            var editButton = '<span data-image="image_' + body.id + '" class="btn btn-default btn-sm glyphicon glyphicon-pencil" title="Edit"></span>';
            div.innerHTML = editButton + '<img id="image_' + body.id + '" src="' + body.image + '" width="150" height="150" />';
            gallery.insertBefore(div, gallery.firstChild);

            addEventToEditButtons();
        }

        http.post('/save', mycallback, body);
    }

    var edit = function() {
        clear(false);

        var password = prompt("Please enter password for editing");

        if(!password) {
            return false;
        }

        var id = this.getAttribute("data-image");
        var body = "imageid=" + id.replace('image_', '') + "&password=" + password;

        var mycallback = function(body, headers, status) {

            if(!body) {
                alert('Unknown error!');
                return false;
            }

            if(body.error) {
                alert('Password wrong!');
                return false;
            }

            var img = document.getElementById(id);
            context.drawImage(img, 0, 0);
        }

        http.post('/access', mycallback, body);
    }

    var clear = function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    canvas.addEventListener("mousemove", function(e) {
        if(drawing) {
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

    var addEventToEditButtons = (function() {
        for (var i = 0; i < editButton.length; i++) {
            editButton[i].addEventListener("click", edit, false);
        }
    })();

})();
