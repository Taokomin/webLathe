<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Employee_id = $_POST['Employee_id'];
$Prefix_id = $_POST['Prefix_id'];
$Employee_name = $_POST['Employee_name'];
$Employee_surname = $_POST['Employee_surname'];
$Employee_number = $_POST['Employee_number'];
$Employee_address = $_POST['Employee_address'];
$EmployeeType_id = $_POST['EmployeeType_id'];
$Employee_license = $_POST['Employee_license'];
  $sql = "INSERT INTO employee
  (
  Auto_number,
  Employee_id,
  Prefix_id,
  Employee_name,
  Employee_surname,
  Employee_number,
  Employee_address,
  EmployeeType_id,
  Employee_license
  ) 
  VALUES
  (
  '$Auto_number',
  '$Employee_id',
  '$Prefix_id',
  '$Employee_name',
  '$Employee_surname',
  '$Employee_number',
  '$Employee_address',
  '$EmployeeType_id',
  '$Employee_license'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Employee.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Employee.php';";
        echo "</script>";
    }
exit();
