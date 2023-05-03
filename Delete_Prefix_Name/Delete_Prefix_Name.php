<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
  $Prefix_id = mysqli_real_escape_string($con, $_GET['Prefix_id']);
  
  $check_query = "SELECT Prefix_id FROM prefix_name WHERE Prefix_id = '$Prefix_id'";
  $check_result = mysqli_query($con, $check_query);
  
  if (mysqli_num_rows($check_result) > 0) {
      $check_query = "SELECT Prefix_id FROM customer WHERE Prefix_id = '$Prefix_id'";
      $check_result = mysqli_query($con, $check_query);
      
      if (mysqli_num_rows($check_result) > 0) {
          echo "<script>alert('ไม่สามารถเนื่องจากข้อมูลนี้ถูกเรียกใช้งานอยู่'); history.back();</script>";
      } else {
          $delete_query = "DELETE FROM prefix_name WHERE Prefix_id = '$Prefix_id'";
          $delete_result = mysqli_query($con, $delete_query);
          
          if ($delete_result) {
              echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Prefix_Name.php';</script>";
          } else {
              echo "Error: " . $delete_query . " " . mysqli_error($con);
          }
      }
  } else {
      echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
  }

  mysqli_close($con);

//   <?php
// require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
// $Prefix_id = mysqli_real_escape_string($con, $_GET['Prefix_id']);

// // Check if the record exists in prefix_name table
// $check_query = "SELECT Prefix_id FROM prefix_name WHERE Prefix_id = '$Prefix_id'";
// $check_result = mysqli_query($con, $check_query);

// if (mysqli_num_rows($check_result) > 0) {
//     // Check if the record is used by other tables
//     $used_by_customer_query = "SELECT Prefix_id FROM customer WHERE Prefix_id = '$Prefix_id'";
//     $used_by_customer_result = mysqli_query($con, $used_by_customer_query);
    
//     $used_by_order_query = "SELECT Prefix_id FROM orders WHERE Prefix_id = '$Prefix_id'";
//     $used_by_order_result = mysqli_query($con, $used_by_order_query);
    
//     if (mysqli_num_rows($used_by_customer_result) > 0 || mysqli_num_rows($used_by_order_result) > 0) {
//         echo "<script>alert('This record is used by other tables'); history.back();</script>";
//     } else {
//         // Delete the record from prefix_name table
//         $delete_query = "DELETE FROM prefix_name WHERE Prefix_id = '$Prefix_id'";
//         $delete_result = mysqli_query($con, $delete_query);
          
//         if ($delete_result) {
//             echo "<script>alert('Record deleted successfully'); window.location = '../Prefix_Name.php';</script>";
//         } else {
//             echo "Error: " . $delete_query . " " . mysqli_error($con);
//         }
//     }
// } else {
//     echo "<script>alert('Record not found'); history.back();</script>";
// }

// mysqli_close($con);
// ?>
