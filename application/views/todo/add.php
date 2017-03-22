<div class="page-header">
    <h3>Add new task</h3>
</div>

<?php if (validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
        <?=validation_errors();?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label for="taskTitle">Task title</label>
        <input type="text" class="form-control" name="taskTitle" id="taskTitle" placeholder="Task name"/>
    </div>
    <div class="form-group">
        <label for="taskDescription">Task description</label>
        <textarea class="form-control" name="taskDescription" id="taskDescription" placeholder="Task description" rows="3"></textarea>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
        </div>
    </div>
</form>
