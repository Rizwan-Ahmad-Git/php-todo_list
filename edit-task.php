<?php 

include 'conn.php';

$editid = $_GET['editid'];

$sql = "select * from tasks where id='".$editid."'";
$result = mysqli_query($conn, $sql);
$editdata = mysqli_fetch_array($result);
// print_r($editdata); 


if(isset($_POST['submit'])) {

   $task = $_POST["task"];
   $status = $_POST["status"];

   $taskname = mysqli_real_escape_string($conn,trim($task));
   $status = mysqli_real_escape_string($conn,trim($status));

   if (empty($taskname) || empty($status)) {
      $taskerr = 'Task name and status are required';
   } else {

      $sql = "update tasks set task_name='".$taskname."', status='".$status."' where id= '".$editid."' ";
      $result = mysqli_query($conn, $sql);
      
      if($result) {

         echo "<script>alert('Task Edit successfully')</script>";
         header('Location: index.php');
      } else {
	      
         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
   }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>TechnoGripper </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/style.css">


</head>
<body>

<div class="container mt-3">
  <h2>Edit Task</h2>
  <?php 
   if (!empty($taskerr)) {
      echo "<div style='color:red;'>$taskerr</div>";
   }
  ?>
  <form method="post">
    <div class="mb-3 mt-3 col-6">
      <label for="task">Task:</label>
      <input type="text" class="form-control" id="task" placeholder="Enter Task" name="task" value="<?= $editdata['task_name']; ?>">
      <p><?//= $taskerr; ?></p>
    </div>
    <div class="mb-3 mt-3 col-6">
      <label for="status">Status:</label>
      <select  class="form-control" name="status" id="status" >
         <option value="Pending" <?= $editdata['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
         <option value="Completed" <?= $editdata['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
      </select>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


</body>
</html>