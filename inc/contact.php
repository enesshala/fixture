<?php
require_once '../config/dbconnection.php';

if (isset($_POST["submit_contact"])) {
   $name = $_POST["name"];
   $email = $_POST["email"];
   $phone = $_POST["phone"];
   $gender = $_POST["gender"] ?? null;
   if (!empty($_POST["langs"])) {
      $favlangs = implode(", ", ($_POST["langs"]));
   } else {
      $favlangs = null;
   }
   $city = $_POST["city"] ?? null;
   $subject = $_POST["subject"];
   $message = $_POST["message"];

   $errCounter = 0;
   if (
      trim($name) === "" || trim($email) === "" ||
      trim($phone) === "" || trim($gender) === "" ||
      trim($favlangs) === "" || trim($city) === "" ||
      trim($subject) === "" || trim($subject) === "" ||
      trim($message) === ""
   )
      $errCounter++;
   else if (hasNumbers($name) || strlen($name) < 3) $errCounter++;
   else if (!isEmail($email)) $errCounter++;
   else if (!phoneNumberRegex($phone)) $errCounter++;

   if ($errCounter === 0) {
      $query = $connection->prepare("INSERT INTO contacts (contact_name, contact_email, contact_phone, contact_gender, contact_favlang, 	contact_city, contact_subject, contact_message) VALUES (:c_name, :c_email, :c_phone, :c_gender, :c_favlang, :c_city, :c_subject,:c_message) ");
      $query->bindValue(":c_name", $name);
      $query->bindValue(":c_email", $email);
      $query->bindValue(":c_phone", $phone);
      $query->bindValue(":c_gender", $gender);
      $query->bindValue(":c_favlang", $favlangs);
      $query->bindValue(":c_city", $city);
      $query->bindValue(":c_subject", $subject);
      $query->bindValue(":c_message", $message);

      $query->execute();
   }
}

function phoneNumberRegex($phone)
{
   return preg_match("/^(\d{2}\-)?(\(\d{3}\))?\d{3}\-\d{3}$/", $phone);
}


function hasNumbers($str)
{
   return preg_match('~[0-9]+~', $str);
}
?>


<div class="contact__wrapper">
   <h2>Contact Us</h2>
   <form action="#section__f" method="POST" name="contact__form" class="contact__form" id="form" autocomplete="off">
      <div class="form__group">
         <div class="form__control">
            <input type="text" name="name" id="name" placeholder="John Doe">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <span class="small"></span>
         </div>

         <div class="form__control">
            <input type="text" name="email" id="email" placeholder="example@example.com">
            <i class=" fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <span class="small"></span>
         </div>
      </div>

      <div class="form__control">
         <input type="tel" name="phone" id="phone" placeholder="Phone Number">
         <i class=" fas fa-check-circle"></i>
         <i class="fas fa-exclamation-circle" title="Use format xx-xxx-xxx"></i>
         <span class="small"></span>
      </div>

      <p id="gender__question">What is your gender?</p>
      <div class="gender__options">
         <label for="male" class="radio__label">Male
            <input type="radio" name="gender" id="male" value="male">
         </label>

         <label for="female" class="radio__label">Female
            <input type="radio" name="gender" id="female" value="female">
         </label>

         <label for="other" class="radio__label">Other
            <input type="radio" name="gender" id="other" value="other">
         </label>
      </div>

      <p id="language__question">What are your favourite programming languages?</p>
      <div class="languages__options">
         <label for="java" class="checkbox__label">Java
            <input type="checkbox" name="langs[]" id="java" value="Java">
         </label>

         <label for="javascript" class="checkbox__label">Javascript
            <input type="checkbox" name="langs[]" id="javascript" value="javascript">
         </label>

         <label for="python" class="checkbox__label">Python
            <input type="checkbox" name="langs[]" id="python" value="python">
         </label>
      </div>

      <p id="city__question">Where are you from?</p>
      <div class="form__control">
         <select name="city" id="city" class="select__box">
            <option value="choose" selected disabled>I come from</option>
            <option value="ferizaj">Ferizaj</option>
            <option value="prishtin">Prishtine</option>
            <option value="gjilan">Gjilan</option>
            <option value="peje">Peje</option>
            <option value="prizren">Prizren</option>
            <option value="gjakove">Gjakove</option>
            <option value="mitrovice">Mitrovice</option>
         </select>
         <i class="fas fa-check-circle"></i>
         <i class="fas fa-exclamation-circle"></i>
         <span class="small"></span>
      </div>

      <div class="form__control">
         <input type="text" name="subject" id="subject" placeholder="Subject">
         <i class=" fas fa-check-circle"></i>
         <i class="fas fa-exclamation-circle"></i>
         <span class="small"></span>
      </div>

      <div class="form__control">
         <textarea name="message" id="message" cols="30" rows="10" placeholder="Message..."></textarea>
         <i class="fas fa-check-circle"></i>
         <i class="fas fa-exclamation-circle"></i>
         <span class="small"></span>
      </div>

      <input type="submit" name="submit_contact" id="submit" value="SEND">

      <div class="success__message" id="success__msg">
         <p></p>
      </div>
   </form>
</div>