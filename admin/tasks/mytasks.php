<?php
$query = $connection->prepare("SELECT * FROM tasks WHERE task_author = (SELECT user_id FROM users  WHERE user_id = :id) ORDER BY created_at DESC");
$query->bindValue(":id", $userid);
$query->execute();
$tasks = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Tasks</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Task Title</th>
                            <th>Task Description</th>
                            <th>Task File</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Task Title</th>
                            <th>Task Description</th>
                            <th>Task File</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($tasks as $task) : ?>
                            <tr>
                                <td><?php echo $task['task_title']; ?></td>
                                <td><?php echo substr($task['task_desc'], 0, 20); ?></td>
                                <td class="text-center"><a class="btn btn-success px-4" title="Download File" href="<?php echo $task['task_file']; ?>" download><i class="fas fa-download"></i></a></td>
                                <?php if ($task['task_status'] == 'pending') { ?>
                                    <td class="text-center">
                                        <a tabindex="0" class="btn btn-sm btn-secondary text-white" role="button" data-toggle="popover" data-trigger="focus" title="Pending Status" data-content="Pending Status means that this task an open task and waiting for people to take it!">pending</a>
                                    </td>
                                <?php } elseif ($task['task_status'] == 'in progres') { ?>
                                    <td class="text-center">
                                        <a tabindex="0" class="btn btn-sm btn-info text-white" role="button" data-toggle="popover" data-trigger="focus" title="In Progress Status" data-content="In Progress Status means that this task is given to somebody and he is working on it!">in progress</a>
                                    </td>
                                <?php } elseif ($task['task_status'] == 'canceled') { ?>
                                    <td class="text-center"><span class="btn btn-sm btn-danger">canceled</span></td>
                                <?php } else { ?>
                                    <td class="text-center"><span class="btn btn-sm btn-success">finished</span></td>
                                <?php } ?>
                                <td class="text-center"><a href="?id=viewtask&task_id=" class="btn btn-primary btn-circle"><i class="fas fa-eye"></i></a></td>
                                <td class="text-center"><a href="#" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>