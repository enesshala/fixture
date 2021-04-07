<?php
require_once 'config/dbconnection.php';
session_start();

// Checks if session exists
if ($_SESSION) {
  header("location: admin/?id=index");
  exit;
}

$errors = [];
$registerSuccessMessage = "";
$loginSuccessMessage = "";

$username = "";
$email = "";
$password = "";
$rpassword = "";

if (isset($_POST['submit_registration'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rpassword = $_POST['rpassword'];

  $query = $connection->prepare('SELECT * FROM users WHERE username = :username OR user_email = :email');
  $query->bindValue(":username", $username);
  $query->bindValue(":email", $email);
  $query->execute();

  $user = $query->fetch();
  $userName = $user["username"] ?? null;
  $userEmail = $user["user_email"] ?? null;


  if (trim($username) === "") {
    $errors[] = "Username is required!";
  } else if (trim($email) === "") {
    $errors[] = "Email is required!";
  } else if (trim($password) === "") {
    $errors[] = "Password is required!";
  } else if (trim($rpassword) === "") {
    $errors[] = "Confirm password is required!";
  } else if ($password !== $rpassword) {
    $errors[] = "Confirm password should be the same!";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  } else if ($userName === $username) {
    $errors[] = "Username already exists!";
  } else if ($userEmail === $email) {
    $errors[] = "Email already exists!";
  }

  if (empty($errors)) {
    $query = $connection->prepare('INSERT INTO users (username, user_email, user_password) VALUES (:username, :email, :password)');
    $query->bindValue(":username", $username);
    $query->bindValue(":email", $email);
    $query->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));

    $query->execute();
    $registerSuccessMessage = "You have been successfully registered. please <strong>SIGN IN</strong> now!";

    // Reset variables
    $errors = [];
    $username = "";
    $email = "";
    $password = "";
    $rpassword = "";
  }
}

if (isset($_POST['submit_login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $remember = $_POST['remember'] ?? null;

  // Fetch the user if exists
  $query = $connection->prepare('SELECT * FROM users WHERE user_email = :email');
  $query->bindValue(":email", $email);
  $query->execute();

  $user = $query->fetch(PDO::FETCH_ASSOC);

  $userEmail = $user["user_email"] ?? null;
  $userPassword = $user["user_password"] ?? null;

  if (trim($email) === "")
    $errors[] = "Email field is required!";
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $errors[] = "Invalid email format";
  else if ($email !== $userEmail)
    $errors[] = "Email doesn't exist!";
  else if ($email === $userEmail && !password_verify($password, $userPassword))
    $errors[] = "Wrong password!";
  else if ($email !== $userEmail && !password_verify($password, $userPassword))
    $errors[] = "Wrong Credentials";
  else {
    if (isset($remember)) {
      setcookie("email", $email, strtotime(" +30 days "));
      setcookie("password", $password, strtotime(" +30 days "));
    }
    $_SESSION['user_id'] = $user['user_id'];
    header("Location: admin/?id=home");
  }
}

?>

<?php
# REMEMBER CREDENTIALS 
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
  $rememberEmail = $_COOKIE['email'];
  $rememberPw = $_COOKIE['password'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META TAGS -->
  <meta charset="UTF-8">
  <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
  <meta name="description" content="Projekti per Inxhinieri t'Webit">
  <meta name="author" content="Fitim Bytyqi">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Groove App - Sign In</title>

  <!-- BS5 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/logs.css">

  <!-- FAVICON -->
  <link rel="icon" href="favicon.ico" type="image/ico">

  <?php include_once "inc/preloader.php" ?>

  <?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
      <h5><?php echo $error; ?></h5>
    </div>
  <?php endforeach; ?>

  <?php if (isset($_POST['submit_registration']) && empty($errors)) : ?>
    <div class="alert alert-success" role="alert">
      <h5><?php echo $registerSuccessMessage ?></h5>
    </div>
  <?php endif; ?>

  <?php if (isset($_POST['submit_login']) && empty($errors)) : ?>
    <div class="alert alert-success" role="alert">
      <h5><?php echo $loginSuccessMessage ?></h5>
    </div>
  <?php endif; ?>

  <div class="container" id="container">

    <div class="form-container sign-up-container">
      <form method="POST">
        <h1>Create Account</h1>
        <span>or use your email for registration</span>
        <input type="text" name="username" id="username" placeholder="Username" value="<?php echo isset($_POST['submit_registration']) ? $username : ''; ?>" />
        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo isset($_POST['submit_registration']) ? $email : ''; ?>" />
        <input type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($_POST['submit_registration']) ? $password : ''; ?>" />
        <input type="password" name="rpassword" id="rpassword" placeholder="Repeat Password" value="<?php echo isset($_POST['submit_registration']) ? $rpassword : ''; ?>" />
        <button type="submit" name="submit_registration">Sign Up</button>
      </form>
    </div>

    <div class="form-container sign-in-container">
      <form method="POST">
        <h1>Sign in</h1>
        <span>or use your account</span>
        <input type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['submit_login']) ? $email : (isset($_COOKIE['email']) ? $rememberEmail : ""); ?>" />
        <input type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['submit_login']) ? $password : (isset($_COOKIE['password']) ? $rememberPw : ""); ?>" />
        <div class="remember_me">
          <input type="checkbox" checked name="remember">Remember Me
        </div>
        <button type="submit" name="submit_login">Sign In</button>
        <a href="index.php">Main Page</a>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, Friend!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>


  <!-- JS -->
  <script src="assets/js/signIn.js"></script>
  </body>

</html>