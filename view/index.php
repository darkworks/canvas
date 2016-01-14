<?php
include "header.php";
?>

<?php if(!isset($_SESSION['username'])): ?>

    <div class="jumbotron">
        <h1>Canvas picture</h1>
        <p class="lead">View the gallery please log in</p>
        <p><a href="/user" role="button" class="btn btn-lg btn-success">Sign In</a></p>
    </div>
<?php else: ?>
    <h1>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></h1>

<?php endif; ?>


<?php
include "footer.php";
?>