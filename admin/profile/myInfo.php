<div class="profile-container">
    <div class="profile-sidebar">
        <div class="desktop-sticky-top">
            <h4><?php echo $user['username']; ?></h4>
            <div class="font-weight-600 mb-3 text-muted mt-n2">@<?php echo $user['username']; ?></div>
            <p>
                <?php echo $user['about_user']; ?>
            </p>
            <div class="mb-1"><i class="fa fa-map-marker-alt fa-fw text-muted"></i> New York, NY</div>
            <div class="mb-3"><i class="fa fa-link fa-fw text-muted"></i> seantheme.com/studio</div>
            <hr class="mt-4 mb-4" />
        </div>
    </div>

    <div class="profile-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="tab-content p-0">
                    <?php include 'myPosts.php'; ?>
                    <?php include 'myFollowers.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>