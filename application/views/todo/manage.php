<div class="page-header">
    <h3>Manage tasks</h3>
</div>

<a href="/propeller/todo/add" id="add_task"><span class="glyphicon glyphicon-plus"></span></a>

<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Completed</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $id => $row): ?>

        <?php
        $type = ($row->completed == 0) ? 'remove-circle' : 'ok-circle';
        $color = ($row->completed == 0) ? 'red' : 'green';
        ?>

        <tr>
            <td scope="row"><b><?=$row->id;?></b></td>
            <td><?=$row->title;?></td>
            <td><span class="glyphicon glyphicon-<?=$type;?> completed-<?=$color;?>"></span></td>
            <td>
                <?=($row->completed == 0) ? '<a href="/propeller/todo/completed/'.$row->id.'"><span class="glyphicon glyphicon-ok"></span></a>' : '';?>
                <a href="/propeller/todo/edit/<?=$row->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="/propeller/todo/delete/<?=$row->id;?>"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>