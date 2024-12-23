<?php 
   
   include 'conn.php';


   $statusid = $_GET['statusid'];

   $sql = "update tasks set status='Completed' where id= '".$statusid."' ";
   $result = mysqli_query($conn, $sql);
      
      if($result) {
         
         echo "<script>alert('Status Updated.')</script>";
         header('Location: index.php');
      } else {
         
         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

?>