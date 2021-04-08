<?php
if (!$isAdmin) {
    header("location: ?id=home");
    exit;
}

$taskid = $_GET['taskid'] ?? null;

if (!$taskid) {
    header("Location: index.php?id=tasks");
    exit;
}

$query = $connection->prepare("SELECT * FROM tasks t inner join users u on t.task_author = u.user_id WHERE t.task_id = :taskid ");
$query->bindValue(":taskid", $taskid);
$query->execute();
$task = $query->fetch(PDO::FETCH_ASSOC);

$errors = [];
if (isset($_POST['offer_submit'])) {
    $oPrice = $_POST['offer_price'];
    $oStartDate = $_POST['offer_sdate'];
    $oEndDate = $_POST['offer_edate'];

    if (!$oPrice) {
        $errors[] = 'Offer Price is required!';
    }

    if (!$oStartDate || !$oEndDate) {
        $errors[] = 'Offer Dates are required!';
    }

    if (empty($errors)) {
        $query = $connection->prepare("INSERT INTO offers (offer_to, offer_price, offer_start, offer_end) VALUES (:offerto, :offerprice, :offerstart, :offerend) ");
        $query->bindValue(':offerto', $taskid);
        $query->bindValue(':offerprice', $oPrice);
        $query->bindValue(':offerstart', $oStartDate);
        $query->bindValue(':offerend', $oEndDate);

        $query->execute();
        $successMessage = "Successfully sent an offer to the task!";
        header("Location: ?id=tasks");
    }
}


?>
<div class="container-fluid">
    <a class="btn btn-primary btn-sm mb-2" href="?id=tasks"><i class="fas fa-arrow-left"></i>Back to tasks</a>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h3 font-weight-bold text-primary text-uppercase mb-1"><?php echo $task['task_title']; ?></div>
                            <div class=" mb-0 text-gray-800"><strong> PCS:</strong> <?php echo $task['task_pcs']; ?></div>
                            <div class=" mb-0 text-gray-800"><strong>Created on: </strong> <?php echo date("m/d/Y", strtotime($task['created_at'])); ?></div>
                            <div class=" mb-0  text-gray-800"><strong> Descripton:</strong> <?php echo $task['task_desc']; ?></div>


                            <a class="btn btn-success px-5" title="Download File" href="<?php echo $task['task_file']; ?>" download>Download file <i class="fas fa-download"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h3 font-weight-bold text-primary text-uppercase mb-1  text-center"><i class="fas fa-arrow-left"></i> Make an offer</div>
                            <form method="POST">
                                <div class="mb-2">
                                    <label class="form-label">Your Price (EUR)</label>
                                    <input type="number" name="offer_price" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">I can start at: </label>
                                    <input type="date" name="offer_sdate" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">I can finish at: </label>
                                    <input type="date" name="offer_edate" class="form-control">
                                </div>
                                <button type="submit" name="offer_submit" class="btn btn-primary">Make Offer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>