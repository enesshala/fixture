<?php
$userid = $_SESSION["user_id"];

$query = $connection->prepare("SELECT * FROM users WHERE user_id = :id");
$query->bindValue(":id", $userid);
$query->execute();
$currentUser = $query->fetch(PDO::FETCH_ASSOC);


$currentUsername = $currentUser["username"];
$currentEmail = $currentUser["user_email"];
$currentPassword = $currentUser["user_password"];
$currentProfilePic = $currentUser["user_profile"];
$currentBio = $currentUser["about_user"];
$currentName = $currentUser["name"];
$currentSurname = $currentUser["surname"];
$currentAddress = $currentUser["address"];
$currentCity = $currentUser["city"];
$currentState = $currentUser["state"];
$currentZip = $currentUser["zipcode"];

$errors = [];
$errors2 = [];
if (isset($_POST['submit_update-personalinfo'])) {
    $username = $_POST['username'];
    $about = $_POST['description'];

    if ($currentUsername !== $username) {
        $query = $connection->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindValue(":username", $username);
        $query->execute();
    }



    $user = $query->fetch(PDO::FETCH_ASSOC);
    $user_name = $user['username'] ?? null;

    if ((($username === $currentUsername) || (($username === $currentUsername) && (trim($about === "")))))
        $errors[] = "Please make some changes!";
    if (trim($username) === "")
        $errors[] = "Username is required!";
    if ($username === $user_name)
        $errors[] = "Username already exists!";

    if (empty($errors)) {
        $query = $connection->prepare("UPDATE users SET username = :username, 
                                        about_user = :about
                                        WHERE user_id = :id");
        $query->bindValue(':id', $userid);
        $query->bindValue(':username', $username);
        if (trim($about) !== "")
            $query->bindValue(':about', $about);
        else
            $query->bindValue(':about', $currentBio);
        $query->execute();

        $successMessage = "Successfully Changed! Wait 3 Seconds!";
        header("refresh:3;url=?id=settings");
    }
}


if (isset($_POST['submit_photo'])) {
    $image = $_FILES['image'] ?? null;

    $imagePath = '';

    if (!is_dir('img')) {
        mkdir('img');
    }

    // echo !file_exists($_FILES['profile_pic']['tmp_name']) || !is_uploaded_file($_FILES['profile_pic']['tmp_name']);

    if ($image && file_exists($_FILES['image']['tmp_name'])) {
        if ($currentUser['user_profile']) {
            unlink($currentUser['user_profile']);
        }
        $imagePath = 'img/' . $currentUser["username"] . '/' . $image['name'];

        if (!is_dir(dirname($imagePath)))
            mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);

        $query = $connection->prepare("UPDATE users SET user_profile = :url WHERE user_id = :id");
        $query->bindValue(":url", $imagePath);
        $query->bindValue(":id", $userid);

        if ($query->execute()) {
            $successMessage = "Your avatar has been changed! Wait 3 seconds!";
            header('refresh: 3; URL=?id=settings');
        }
    } else {
        $errors[] = "Please insert a photo!";
    }
}


// personal info
if (isset($_POST['submit_personal-info'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];


    $user_name = $currentUser['name'] ?? null;
    $user_surname = $currentUser['surname'] ?? null;
    $user_email = $currentUser['user_email'] ?? null;
    $user_address = $currentUser['address'] ?? null;
    $user_city = $currentUser['city'] ?? null;
    $user_state = $currentUser['state'] ?? null;
    $user_zip = $currentUser['zip'] ?? null;

    if ((($name === $user_name) && ($surname === $user_surname) && ($email === $user_email)))
        $errors2[] = "Please make some changes!";
    if (trim($name) === "")
        $errors2[] = "Name is required!";
    if (trim($surname) === "")
        $errors2[] = "Surname is required!";
    if (trim($email) === "")
        $errors2[] = "Email is required!";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors2[] = "Invalid email format";

    if (empty($errors2)) {
        $query = $connection->prepare("UPDATE users SET name = :name,
                                        surname = :surname,
                                        user_email = :email, 
                                        address = :address, 
                                        city = :city,
                                        state = :state,
                                        zipcode = :zipcode
                                        WHERE user_id = :id");
        $query->bindValue(':id', $userid);
        $query->bindValue(':name', $name);
        $query->bindValue(':surname', $surname);
        $query->bindValue(':email', $email);
        $query->bindValue(':address', $address);
        $query->bindValue(':city', $city);
        $query->bindValue(':state', $state);
        $query->bindValue(':zipcode', $zipcode);

        $query->execute();

        $successMessage2 = "Successfully Changed your Private Info! Wait 3 Seconds!";
        header("refresh:3;url=?id=settings");
    }
}
?>

<div class="container-fluid">


    <div class="container p-0">
        <h1 class="h3 mb-3">Settings</h1>
        <div class="row">
            <div class="col-md-5 col-xl-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                            Password
                        </a>
                        <a class="list-group-item list-group-item-action text-gray-300 disabled" data-toggle="list" href="#" role="tab">
                            Privacy and safety
                        </a>
                        <a class="list-group-item list-group-item-action text-gray-300 disabled" data-toggle="list" href="#" role="tab">
                            Email notifications
                        </a>
                        <a class="list-group-item list-group-item-action text-gray-300 disabled" data-toggle="list" href="#" role="tab">
                            Web notifications
                        </a>
                        <a class="list-group-item list-group-item-action text-gray-300 disabled" data-toggle="list" href="#" role="tab">
                            Widgets
                        </a>
                        <a class="list-group-item list-group-item-action text-gray-300 disabled" data-toggle="list" href="#" role="tab">
                            Your data
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                            Delete account
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <!-- <div class="card-actions float-right">
                                    <div class="dropdown show">
                                        <a href="#" data-toggle="dropdown" data-display="static">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div> -->
                                <h5 class="card-title mb-0">Public info</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <?php foreach ($errors as $error) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ((empty($errors) && isset($_POST["submit_update-personalinfo"])) || (empty($errors) && isset($_POST["submit_photo"]))) : ?>
                                        <div class="alert alert-success col-12" role="alert">
                                            <?php echo $successMessage; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-7">
                                        <form action="?id=settings" method="POST">

                                            <div class="form-group">
                                                <label for="inputUsername">Username</label>
                                                <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username" value="<?php echo $currentUsername ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputUsername">Biography</label>
                                                <textarea rows="2" class="form-control" name="description" id="inputBio" placeholder="Tell something about yourself"><?php echo $currentBio ?></textarea>
                                            </div>
                                            <input type="submit" name="submit_update-personalinfo" class="btn btn-primary" value="Save changes">
                                        </form>
                                    </div>


                                    <div class="col-md-5">
                                        <form action="?id=settings" method="POST" enctype="multipart/form-data">
                                            <div class="text-center">
                                                <img alt="" src="<?php echo (is_file($profile_picture)) ? $profile_picture : 'assets/img/anime3.png' ?>" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                                <div class="mt-2">
                                                    <input class="btn btn-sm btn-info" type="file" name="image">
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                            </div>
                                            <button type="submit" name="submit_photo" class="btn btn-fill btn-primary">CHANGE PHOTO</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card my-4">
                            <div class="card-header">
                                <div class="card-actions float-right">
                                    <!-- <div class="dropdown show">
                                        <a href="#" data-toggle="dropdown" data-display="static">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                                <form action="?id=settings" method="POST">
                                    <div class="col-12">
                                        <?php foreach ($errors2 as $error) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ((empty($errors2) && isset($_POST["submit_personal-info"]))) : ?>
                                        <div class="alert alert-success col-12" role="alert">
                                            <?php echo $successMessage2; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputFirstName">First name</label>
                                            <input type="text" name="name" class="form-control" id="inputFirstName" placeholder="First name" value="<?php echo $currentName ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputLastName">Last name</label>
                                            <input type="text" name="surname" class="form-control" value="<?php echo $currentSurname ?>" id="inputLastName" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" name="email" value="<?php echo $currentEmail ?>" class="form-control" id="inputEmail4" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" name="address" class="form-control" value="<?php echo $currentAddress ?>" id="inputAddress" placeholder="1234 Main St">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputAddress2">Address 2</label>
                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                    </div> -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" name="city" class="form-control" id="inputCity" value="<?php echo $currentCity ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select id="inputState" name="state" class="form-control">
                                                <option selected value="kosove">Kosove</option>
                                                <option value="shqiperi">Shqiperi</option>
                                                <option value="maqedoni">Maqedoni</option>
                                                <option>............</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="number" name="zipcode" class="form-control" id="inputZip" value="<?php echo $currentZip ?>">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit_personal-info" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form>
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent">
                                        <small><a href="#">Forgot your password?</a></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew2">Verify password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew2">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

</div>