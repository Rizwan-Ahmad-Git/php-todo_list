<?php
include 'conn.php';

if(isset($_GET['delid'])) {
   
   $delid = $_GET['delid'];

   $sql = "delete from tasks where id='".$delid."'";
   $result = mysqli_query($conn, $sql);
   
   if($result) {

      echo "<script>alert('Task deleted successfully')</script>";
      header('location: index.php');
   } else {
   
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TechnoGripper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">


</head>
<body>

<div class="container mt-3">
  <h2>To-Do List</h2>
  <a href="add-task.php"><button type="button" class="btn btn-info">Add task</button></a>
  <table class="table table-striped">
    <thead>
      <tr>
         <th>Task</th>
         <th>Status</th>
         <th>Created At</th>
         <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
         $sql="select * from tasks";
         $result=mysqli_query($conn,$sql);
         $i=1;
	      while($data=mysqli_fetch_array($result))
	      {  ?>
         <tr>
         <td><?= $data['task_name']; ?></td>
         <td id="status-<?= $data['id'] ?>"><?= $data['status']; ?></td>
         <td><?= $data['created_at']; ?></td>
         <td>
            <a href="edit-task.php?editid=<?= $data['id'] ?>" onclick="return confirm('Edit this task?')" title="Edit">
               <i class="fa fa-pen-to-square"></i> 
            </a>
            <a href="index.php?delid=<?= $data['id'] ?>" onclick="return confirm('Delete this task?')" title="Delete">
               <i class="fa fa-trash"></i> 
            </a>
            <?php if($data['status'] == 'Pending') { ?>
               <a href="update-status.php?statusid=<?= $data['id'] ?>" title="change status">
                  <i class="fa fa-check"></i>
               </a>
            <?php } ?>
         </td>
         </tr>
      <?php  $i++; } ?>
      </tbody>
  </table>
</div>


</body>
</html>
