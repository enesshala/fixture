<div class="container-fluid">

    <div class="profile">
        <div class="profile-header">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="<?php echo $user['user_profile']; ?>" alt="" />
                </div>
                <ul class="profile-header-tab nav nav-tabs nav-tabs-v2">
                    <li class="nav-item">
                        <a href="#profile-post" class="nav-link active" data-toggle="tab">
                            <div class="nav-field">Posts</div>
                            <div class="nav-value">382</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-followers" class="nav-link" data-toggle="tab">
                            <div class="nav-field">Followers</div>
                            <div class="nav-value">1.3m</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-media" class="nav-link disabled" data-toggle="tab">
                            <div class="nav-field">Photos</div>
                            <div class="nav-value">1,397</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-media" class="nav-link disabled" data-toggle="tab">
                            <div class="nav-field">Videos</div>
                            <div class="nav-value">120</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-followers" class="nav-link" data-toggle="tab">
                            <div class="nav-field">Following</div>
                            <div class="nav-value">2,592</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <?php include 'myInfo.php'; ?>
    </div>

</div>

</div>