<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
  $MaterialType_id = mysqli_real_escape_string($con, $_GET['MaterialType_id']);
  
  $check_query = "SELECT MaterialType_id FROM material_type WHERE MaterialType_id = '$MaterialType_id'";
  $check_result = mysqli_query($con, $check_query);
  
  if (mysqli_num_rows($check_result) > 0) {
      $check_query = "SELECT MaterialType_id FROM material WHERE MaterialType_id = '$MaterialType_id'";
      $check_result = mysqli_query($con, $check_query);
      
      if (mysqli_num_rows($check_result) > 0) {
          echo "<script>alert('ไม่สามารถเนื่องจากข้อมูลนี้ถูกเรียกใช้งานอยู่'); history.back();</script>";
      } else {
          $delete_query = "DELETE FROM material_type WHERE MaterialType_id = '$MaterialType_id'";
          $delete_result = mysqli_query($con, $delete_query);
          
          if ($delete_result) {
              echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Material_Type.php';</script>";
          } else {
              echo "Error: " . $delete_query . " " . mysqli_error($con);
          }
      }
  } else {
      echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
  }

  mysqli_close($con);