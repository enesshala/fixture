<?php
$description = "";
$errors = [];

$id = $_SESSION['user_id'];


if (isset($_POST['submit_post'])) {
    $description = $_POST['myPost'];

    if (!$description) {
        $errors[] = 'Post Description is required!';
    }

    if (empty($errors)) {
        $query = $connection->prepare("INSERT INTO personalpost (description, author_id) VALUES (:description, :author) ");
        $query->bindValue(':description', $description);
        $query->bindValue(':author', $userid);

        $query->execute();
        $successMessage = "Successfully created a new post!";
        header("refresh:3;url=?id=profile");
    }
}

$query = $connection->prepare("SELECT * FROM personalpost WHERE author_id = (SELECT user_id FROM users  WHERE user_id = '$id') ORDER BY created_at DESC");
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="tab-pane fade active show" id="profile-post">


    <ul class="timeline col-12-sm">
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <?php if (empty($errors) && isset($_POST["submit_post"])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <li>
            <!-- begin timeline-time -->

            <!-- end timeline-time -->
            <!-- begin timeline-icon -->
            <div class="timeline-icon">
                <a href="javascript:;">&nbsp;</a>
            </div>
            <!-- end timeline-icon -->
            <!-- begin timeline-body -->
            <div class="timeline-body">


                <div class="timeline-comment-box">
                    <div class="user"><img src="<?php echo $user['user_profile'] ?>"></div>
                    <div class="input">
                        <form action="?id=profile" method="POST">
                            <textarea type=" text" name="myPost"></textarea>
                            <span class="input-group-btn p-l-10">
                                <button class="btn btn-primary f-s-12 rounded-corner" name="submit_post" type="submit">Create Post</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end timeline-body -->
        </li>

        <!-- my posts -->
        <?php foreach ($posts as $post) : ?>
            <li>
                <!-- begin timeline-time -->
                <div class="timeline-time">
                    <span class="date"><?php echo date("m/d/Y", strtotime($post['created_at'])); ?></span>
                    <span class="time"><?php echo date("h:m:s", strtotime($post['created_at'])); ?></span>
                </div>
                <!-- end timeline-time -->
                <!-- begin timeline-icon -->
                <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                </div>
                <!-- end timeline-icon -->
                <!-- begin timeline-body -->
                <div class="timeline-body">
                    <div class="timeline-header">
                        <span class="userimage"><img src="<?php echo $user['user_profile']; ?>" alt=""></span>
                        <span class="username"><a href="javascript:;"><?php echo $user['name'] . " " . $user['surname']; ?></a> <small></small></span>
                        <!-- <span class="pull-right text-muted">18 Views</span> -->
                    </div>
                    <div class="timeline-content">
                        <?php echo $post['description']; ?>
                    </div>
                    <!-- <div class="timeline-likes">
                        <div class="stats-right">
                            <span class="stats-text">259 Shares</span>
                            <span class="stats-text">21 Comments</span>
                        </div>
                        <div class="stats">
                            <span class="fa-stack fa-fw stats-icon">
                                <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                            </span>
                            <span class="fa-stack fa-fw stats-icon">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="stats-total">4.3k</span>
                        </div>
                    </div> -->
                    <div class="timeline-footer">
                        <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                        <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                        <!-- <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a> -->
                    </div>
                    <div class="timeline-comment-box">
                        <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar6.png"></div>
                        <div class="input">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                                    <span class="input-group-btn p-l-10">
                                        <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end timeline-body -->
            </li>
        <?php endforeach; ?>

    </ul>
</div>