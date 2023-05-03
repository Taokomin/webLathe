<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Prefix_id = $_POST['Prefix_id'];
$Prefix_name = $_POST['Prefix_name'];
$check = "SELECT Prefix_name FROM prefix_name  WHERE Prefix_name = '$Prefix_name' ";
$result = mysqli_query($con, $check) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if (mysqli_num_rows($result) > 0) {
  echo "<script type='text/javascript'>";
  echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
  echo "window.location.href='Insert_Prefix_Name.php';";
  echo "</script>";
} else {
  $sql = "INSERT INTO prefix_name
  (
  Auto_number,
  Prefix_id,
  Prefix_name
  ) 
  VALUES
  (
  '$Auto_number',
  '$Prefix_id',
  '$Prefix_name'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Prefix_Name.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Prefix_Name.php';";
        echo "</script>";
    }
  }
exit();
?>
