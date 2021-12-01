<div class="form-group">
    <label for="name">Name: </label>
    <input type="text" name="name" id="name" class="form-control" value="<?= $user->name ?>">
</div>

<div class="form-group mt-3">
    <label for="email">Email: </label>
    <input type="text" name="email" id="email" class="form-control" value="<?= $user->email ?>">
</div>

<div class="form-group mt-3">
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" class="form-control" value="<?= $user->password ?>">
</div>

<button class="btn btn-primary mt-3">Save</button>