<?php
$userid = $_SESSION['user_id'];

$query = $connection->prepare("SELECT * FROM users WHERE user_id = :id");
$query->bindValue(":id", $userid);
$query->execute();
$currentUser = $query->fetch(PDO::FETCH_ASSOC);

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

    if (!is_dir('/users')) {
        mkdir('/users');
    }

    if ($file && file_exists($_FILES['tfile']['tmp_name'])) {
        // if ($currentUser['user_profile']) {
        //     unlink($currentUser['user_profile']);
        // }
        $filePath = 'users/' . $currentUser["username"] . '/' . $_FILES['tfile']['name'];

        if (!is_dir(dirname($filePath)))
            mkdir(dirname($filePath));
        move_uploaded_file($_FILES['tfile']['tmp_name'], $filePath);
    } else {
        $errors[] = 'Task File is required!';
    }

    if (false) {
        $query = $connection->prepare("INSERT INTO tasks (task_title, task_desc, task_author, task_file) VALUES (:tName, :tDesc, :tAuth, :tFile) ");
        $query->bindValue(':tName', $tName);
        $query->bindValue(':tDesc', $tDesc);
        $query->bindValue(':tAuth', $userid);
        $query->bindValue(':tFile', $filePath);

        $query->execute();
        $successMessage = "Successfully created a new task!";
    }
}
?>

<div class="container-fluid">
    <div class="row"> <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Create a Task <i class="fas fa-folder-plus"></i></button> </div> <!-- Modal -->
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

    <!-- tasks -->
    <div class="col-12 mt-1">
        <div class="card border-bottom-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-1">
        <div class="card border-bottom-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-1">
        <div class="card border-bottom-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-1">
        <div class="card border-bottom-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-1">
        <div class="card border-bottom-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>