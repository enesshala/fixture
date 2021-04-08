<?php
require_once './functions.php';
checkSession("../public/login.php");

// database connection
require_once '../config/dbconnection.php';

include_once "./partials/header.php";
?>
<!-- End Navbar -->

<?php
$path = $_GET['id'] ?? null;

if (isset($_GET['searchquery'])) {
  include "search.php";
} else {
  switch ($path) {
    case 'home':
      include "dashboard.php";
      break;
    case 'tasks':
      include "tasks/tasks.php";
      break;
    case 'viewtask':
      include "tasks/viewtask.php";
      break;
    case 'deletetask':
      include "tasks/delete_task.php";
      break;
    case 'mytasks':
      include "tasks/mytasks.php";
      break;
    case 'viewtask':
      include "tasks/viewtask.php";
      break;
    case 'viewoffers':
      include "tasks/offers.php";
      break;
    case 'user':
      include "profile/user.php";
      break;
    case 'profile':
      include "profile/profile.php";
      break;
    case 'settings':
      include "profile/settings.php";
      break;
    default:
      include "404.php";
      break;
  }
}

?>

<!-- FOOTER -->
<?php include_once "./partials/footer.php"; ?>