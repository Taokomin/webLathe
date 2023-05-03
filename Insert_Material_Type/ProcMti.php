<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$MaterialType_id = $_POST['MaterialType_id'];
$MaterialType_name = $_POST['MaterialType_name'];
$check = "SELECT MaterialType_name FROM material_type  WHERE MaterialType_name = '$MaterialType_name' ";
$result = mysqli_query($con, $check) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if (mysqli_num_rows($result) > 0) {
  echo "<script type='text/javascript'>";
  echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
  echo "window.location.href='Insert_Material_Type.php';";
  echo "</script>";
} else {
  $sql = "INSERT INTO material_type
  (
  Auto_number,
  MaterialType_id,
  MaterialType_name
  ) 
  VALUES
  (
  '$Auto_number',
  '$MaterialType_id',
  '$MaterialType_name'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Material_Type.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Material_Type.php';";
        echo "</script>";
    }
  }
exit();
?>
