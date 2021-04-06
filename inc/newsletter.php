<?php
require_once "../config/dbconnection.php";

$email = "";
$successMessage = "";
$errorMessage = "";
if (isset($_POST["submit"])) {
   $errCounter = 0;
   $email = $_POST["newsletterEmail"];

   $query = $connection->prepare("SELECT subscriber_email FROM subscribers WHERE subscriber_email=:email");
   $query->bindValue(":email", $email);
   $query->execute();
   $userExist = $query->fetch(PDO::FETCH_ASSOC);


   if (empty($email)) {
      $errorMessage = "Field can not be empty!";
      $errCounter++;
   } else if (strlen($email) > 30) {
      $errorMessage = "Max characters(30) exceeded!";
      $errCounter++;
   } else if (!isEmail($email)) {
      $errorMessage = "Email must be valid!";
      $errCounter++;
   } else if ($userExist) {
      $errorMessage = "This user is already subscribed!";
      $errCounter++;
   }

   if ($errCounter === 0) {
      $query = $connection->prepare("INSERT INTO subscribers (subscriber_email) VALUES (:email)");
      $query->bindValue(":email", $email);
      $query->execute();

      $successMessage = "You have been registered to newsletter list!";
   }
}

function isEmail($email)
{
   return filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>

<div id="newsletter" class="footer__contact">
   <h2>Get In Touch</h2>
   <p>Subscribe to our newsletter and get notification for upcoming cool stuff.</p>

   <form action="#newsletter" method="POST" id="newsletter-form" autocomplete="off">
      <div class=" form__wrapper">
         <div class="form__control">
            <input type="text" name="newsletterEmail" id="newsletter-email" placeholder="Enter email..." value="<?php echo $email; ?>">
            <p style="color: #f83f86">
               <?php echo $errorMessage ?>
            </p>
            <p style="color: #08d030;">
               <?php echo $successMessage ?>
            </p>
         </div>
         <input type="submit" name="submit" id="newsletter-submit" value="COUNT ME IN">
      </div>
   </form>
</div>