<h1>Users</h1>

<a href="/users/create" class="btn btn-primary">Create</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Pass</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->name ?></td>     
            <td><?= $user->email ?></td>
            <td><?= $user->password ?></td>
            <td><?= $user->created_at ?></td>
            <td>
                <a href="/users/<?= $user->id ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php endforeach ?>


    </tbody>
</table>