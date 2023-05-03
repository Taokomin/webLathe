<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$EmployeeType_id = $_POST['EmployeeType_id'];
$EmployeeType_name = $_POST['EmployeeType_name'];
$check = "SELECT EmployeeType_name FROM employee_type  WHERE EmployeeType_name = '$EmployeeType_name' ";
$result = mysqli_query($con, $check) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if (mysqli_num_rows($result) > 0) {
  echo "<script type='text/javascript'>";
  echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
  echo "window.location.href='Insert_EmployeeType_name.php';";
  echo "</script>";
} else {
  $sql = "INSERT INTO employee_type
  (
  Auto_number,
  EmployeeType_id,
  EmployeeType_name
  ) 
  VALUES
  (
  '$Auto_number',
  '$EmployeeType_id',
  '$EmployeeType_name'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Employee_Type.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_EmployeeType_name.php';";
        echo "</script>";
    }
  }
exit();
?>
