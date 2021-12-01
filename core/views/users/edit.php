<h1 class="text-center">Edit <?= $user->name ?></h1>

<form action="/users/<?= $user->id ?>/update" method="post">

    <?php require "_form.php" ?>

</form>