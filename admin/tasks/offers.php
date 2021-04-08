<?php
$userid = $_SESSION['user_id'];
$query = $connection->prepare("SELECT o.offer_id, o.offer_price, o.offer_start, o.offer_end, o.offer_status, u.username, t.task_id, t.task_title 
                                 FROM offers o, users u, tasks t 
                                 WHERE offer_to = t.task_id 
                                 AND offer_author = u.user_id 
                                 AND t.task_author = :id
                              ");
$query->bindValue(":id", $userid);
$query->execute();
$offers = $query->fetchAll(PDO::FETCH_ASSOC);

$offerid = $offers[0]["offer_id"] ?? null;
$taskid = $offers[0]["task_id"] ?? null;

if (isset($_POST['approve_offer'])) {
   $query = $connection->prepare("UPDATE offers SET offer_status = 'accepted' WHERE offer_id = :id");
   $query->bindValue(":id", $offerid);
   $query->execute();

   $query = $connection->prepare("UPDATE tasks SET task_status = 'in progresss' WHERE task_id = :id");
   $query->bindValue(":id", $taskid);
   $query->execute();

   header("location: ?id=viewoffers");
}

if (isset($_POST['decline_offer'])) {
   $query = $connection->prepare("UPDATE offers SET offer_status = 'canceled' WHERE offer_id = :id");
   $query->bindValue(":id", $offerid);
   $query->execute();

   header("location: ?id=viewoffers");
}
?>
<div class="container-fluid">

   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Tasks Offers</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Task Title</th>
                     <th>Offer Price</th>
                     <th>Offer Start</th>
                     <th>Offer End</th>
                     <th>Offer Status</th>
                     <th>Offer Guy</th>
                     <th colspan="2" class="text-center">Actions</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>Task Title</th>
                     <th>Offer Price</th>
                     <th>Offer Start</th>
                     <th>Offer End</th>
                     <th>Offer Status</th>
                     <th>Offer Guy</th>
                     <th colspan="2" class="text-center">Actions</th>
                  </tr>
               </tfoot>
               <tbody>
                  <?php foreach ($offers as $offer) : ?>
                     <tr>
                        <td><?php echo $offer['task_title']; ?></td>
                        <td><?php echo $offer['offer_price']; ?></td>
                        <td><?php echo $offer['offer_start']; ?></td>
                        <td><?php echo $offer['offer_end']; ?></td>
                        <td><?php echo $offer['offer_status']; ?></td>
                        <td><?php echo $offer['username']; ?></td>
                        <td>
                           <form method="POST">
                              <input type="hidden">
                              <input type="submit" name="approve_offer" value="Approve" class="btn btn-primary">
                           </form>
                        </td>

                        <td>
                           <form method="POST">
                              <input type="hidden">
                              <input type="submit" name="decline_offer" value="Decline" class="btn btn-danger">
                           </form>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
</div>