<div class="page-header">
    <h3>Tasks list</h3>
</div>

<?php foreach ($tasks as $id => $row): ?>

    <div class="task<?=($row->completed == 1) ? ' completed' : '';?>" id="<?=$row->id;?>">
        <div class="task_title">
            <?=$row->title;?>
            <?=($row->completed == 0) ? '<a href="/propeller/todo/completed/'.$row->id.'" class="task_check"><span class="glyphicon glyphicon-ok"></span></a>' : '<div class="task_date">'.$row->completed_date.'</div>';?>
        </div>
        <div class="task_description"><?=nl2br(htmlspecialchars($row->description));?></div>
    </div>

<?php endforeach; ?>
