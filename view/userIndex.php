<?php
include "header.php";
?>

<form method="post" action="/user">
    <div class="form-group">
        <label for="username">Login</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Login">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <ul style="color: red;">
    <?php if (isset($errors)) : ?>
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
    </ul>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
include "footer.php";
?>