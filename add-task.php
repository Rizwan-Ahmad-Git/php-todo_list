<?php

include 'conn.php';

if(isset($_POST['submit'])) {

   $task = $_POST["task"];

   $taskname = mysqli_real_escape_string($conn, trim($task));
   $taskerr ='';

   if(empty($taskname)) {
      $taskerr = 'Task name is required';
   } else {

      $sql = "insert into tasks(task_name) value('".$taskname."')";
      $result = mysqli_query($conn, $sql);
      
      if($result) {

         echo "<script>alert('Task added successfully')</script>";
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

</head>


<body>

<div class="container mt-3">
  <h2>Add Task</h2>
  <form method="post">
    <div class="mb-3 mt-3 col-6">
      <label for="email">Task:</label>
      <input type="text" class="form-control" id="task" placeholder="Enter Task" name="task">
      <p><?= isset($taskerr) ? $taskerr : ''; ?></p>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


</body>
</html>


