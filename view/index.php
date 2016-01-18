<?php
include "header.php";
?>

<?php if (!isset($_SESSION['username'])): ?>

    <header class="jumbotron">
        <h3>Canvas picture</h3>
        <p class="lead">View the gallery please log in</p>
        <p><a href="/user" role="button" class="btn btn-lg btn-success">Sign In</a></p>
    </header>
<?php else: ?>

    <h3>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></h3>

    <section class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div id="canvasBlock">
                    <canvas id="canvas" width="700" height="400"></canvas>
                    <!--<div id="canvasTools">
                        <button id="pen" type="button" class="btn btn-info" title="Pen">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <br />
                        <button id="eraser" type="button" class="btn btn-info" title="Erase">
                            <span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                        </button></div>-->
                    </div>
                </div>
                <div>
                    <button id="save" class="btn btn-sm btn-success" type="button"><span class="glyphicon glyphicon-save"></span> Save</button>
                    <button id="clear" class="btn btn-sm btn-danger" type="button"><span class="glyphicon glyphicon-fire"></span> Clear All</button>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <h3>Our gallery</h3>
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div id="gallery">
                    <?php if (!empty($gallery)): ?>
                        <?php foreach ($gallery as $image): ?>
                            <div class="picture"><span data-image="image_<?=$image['id']; ?>" class="edit btn btn-default btn-sm glyphicon glyphicon-pencil" title="Edit"></span><img id="image_<?=$image['id']; ?>" src="/upload/<?=$image['name']; ?>" width="150" height="150" /></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Images not found
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (isset($pagination)): ?>
        <div class="row text-center">
            <button id="more" class="btn btn-primary" data-page="1"><span class="glyphicon glyphicon-chevron-down"></span> More</button>
        </div>
        <?php endif; ?>
    </section>

<?php endif; ?>


<?php
include "footer.php";
?>