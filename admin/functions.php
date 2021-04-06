<?php
function checkSession($path)
{
   session_start();
   if (!isset($_SESSION['user_id'])) {
      header("location: logout.php");
      exit;
   }
}

function randomString($n)
{
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $str = '';
   for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $str .= $characters[$index];
   }

   return $str;
}

function greeting()
{
   $time = date("H");
   $message = '';
   if ($time >= "00" && $time < "12") {
      $message = 'Morning, ';
   } else if ($time >= "12" && $time < "16") {
      $message = 'Afternoon, ';
   } else if ($time >= "16" && $time < "24") {
      $message = 'Evening, ';
   } else {
      $message = 'Howdy, ';
   }

   return $message;
}
