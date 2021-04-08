<?php
$userid = $_SESSION['user_id'];

$query = $connection->prepare("SELECT * FROM users WHERE user_id = :id");
$query->bindValue(":id", $userid);
$query->execute();
$currentUser = $query->fetch(PDO::FETCH_ASSOC);

$query2 = $connection->prepare("SELECT * FROM tasks t inner join users u on t.task_author = u.user_id WHERE t.task_author = u.user_id AND t.task_status = 'pending' ORDER BY t.created_at DESC");
// $query2 = $connection->prepare("SELECT * FROM tasks WHERE task_author = (SELECT user_id FROM users  WHERE user_id = :id) ORDER BY created_at DESC");
$query2->bindValue(":id", $userid);
$query2->execute();
$tasks = $query2->fetchAll(PDO::FETCH_ASSOC);


$errors = [];
if (isset($_POST['tsubmit'])) {
    $tName = $_POST['tname'];
    $tDesc = $_POST['tdesc'];

    if (!$tName) {
        $errors[] = 'Task Name is required!';
    }

    if (!$tDesc) {
        $errors[] = 'Task Description is required!';
    }

    $file = $_FILES['tfile'] ?? null;

    $filePath = '';

    if (!is_dir('tasks/users')) {
        mkdir('tasks/users');
    }

    if ($file && file_exists($_FILES['tfile']['tmp_name'])) {
        // if ($currentUser['user_profile']) {
        //     unlink($currentUser['user_profile']);
        // }
        $filePath = 'tasks/users/' . $currentUser["username"] . '/' . $_FILES['tfile']['name'];

        if (!is_dir(dirname($filePath)))
            mkdir(dirname($filePath));
        move_uploaded_file($_FILES['tfile']['tmp_name'], $filePath);
    } else {
        $errors[] = 'Task File is required!';
    }

    if (empty($errors)) {
        $query = $connection->prepare("INSERT INTO tasks (task_title, task_desc, task_author, task_file) VALUES (:tName, :tDesc, :tAuth, :tFile) ");
        $query->bindValue(':tName', $tName);
        $query->bindValue(':tDesc', $tDesc);
        $query->bindValue(':tAuth', $userid);
        $query->bindValue(':tFile', $filePath);

        $query->execute();
        $successMessage = "Successfully created a new task!";
        header("Location: ?id=tasks");
    }
}
?>

<div class="container-fluid">

    <div class="row">
        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal">Create a Task <i class="fas fa-folder-plus"></i></button>
    </div> <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new task</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <form action="?id=tasks" method="POST" enctype="multipart/form-data">
                        <div id="smartwizard">
                            <ul>
                                <li><a href="#step-1">Step 1<br /><small>Title</small></a></li>
                                <li><a href="#step-2">Step 2<br /><small>Description</small></a></li>
                                <li><a href="#step-3">Step 3<br /><small>Insert File/Image</small></a></li>
                                <li><a href="#step-4">Step 4<br /><small>Confirm Task</small></a></li>
                            </ul>
                            <div class="mt-4">


                                <div id="step-1">
                                    <div class="row">
                                        <div class="col-md-6"> <input type="text" class="form-control" name="tname" placeholder="Task Name" required> </div>
                                    </div>
                                </div>
                                <div id="step-2">
                                    <div class="row">
                                        <div class="col-12"> <textarea type="text" rows="10" name="tdesc" class="form-control" placeholder="Task Description" required></textarea> </div>
                                    </div>
                                </div>
                                <div id="step-3">
                                    <div class="row">
                                        <div class="col-md-6"> <input type="file" name="tfile" class="form-control" placeholder="Insert a file" required> </div>
                                    </div>
                                </div>
                                <div id="step-4" class="">
                                    <div class="row">
                                        <div class="col-12"><input type="submit" name="tsubmit" class="btn btn-lg btn-success" value="Create Task"></div>
                                        <div class="col-md-12">
                                            <span><br>You are creating jobs for other people!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <?php foreach ($tasks as $task) : ?>
            <div class="col-md-6 col-lg-4 pb-3">

                <!-- Add a style="height: XYZpx" to div.card to limit the card height and display scrollbar instead -->
                <div class="card card-custom bg-white border-white border-0" style="height: 450px">
                    <div class="card-custom-img" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5GYqztVQFH_AXSKtodc5zo93twNXk02FdYw&usqp=CAU');"></div>
                    <div class="card-custom-avatar">
                        <img class="img-fluid" src="<?php echo $task['user_profile']; ?>" alt="<?php echo $task['name'] . ' ' . $task['surname']; ?>" title="<?php echo $task['name'] . ' ' . $task['surname']; ?>" />
                    </div>
                    <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title"><?php echo $task['task_title'] ?></h4>
                        <?php if ($task['task_pcs'] != null) { ?>
                            <h5 class="card-title">Pcs: <?php echo $task['task_pcs'] ?></h5>
                        <?php } ?>
                        <p class="card-text"><?php echo $task['task_desc'] ?></p>
                    </div>
                    <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="?id=viewtask&taskid=<?php echo $task['task_id'] ?>" class="btn btn-primary">View Task</a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>


</div>

</div>