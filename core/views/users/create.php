<h1 class="text-center">Create User</h1>
<?php if(isset($error)):?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif ?>
    <form action="/users/store" method="post">

    <?php require "_form.php" ?>

</form>