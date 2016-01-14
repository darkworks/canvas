<?php
include "header.php";
?>

<?php if(!isset($_SESSION['username'])): ?>

    <div class="jumbotron">
        <h3>Canvas picture</h3>
        <p class="lead">View the gallery please log in</p>
        <p><a href="/user" role="button" class="btn btn-lg btn-success">Sign In</a></p>
    </div>
<?php else: ?>
    <h3>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></h3>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div id="canvasBlock">
                    <canvas id="canvas"></canvas>
                    <div id="canvasTools">
                        <button id="pen" type="button" class="btn btn-info" title="Pen">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <br />
                        <button id="eraser" type="button" class="btn btn-info" title="Erase">
                            <span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                        </button></div>
                    </div>
                </div>
                <div>
                    <button id="save" class="btn btn-sm btn-success" type="button">Save</button>
                    <button id="clear" class="btn btn-sm btn-danger" type="button">Clear All</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3>Our gallery</h3>
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div id="galery">
                    <div class="picture">1</div>
                    <div class="picture">2</div>
                    <div class="picture">3</div>
                    <div class="picture">4</div>
                    <div class="picture">5</div>
                    <div class="picture">6</div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<?php
include "footer.php";
?>