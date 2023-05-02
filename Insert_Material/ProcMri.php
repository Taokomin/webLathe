<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Material_id = $_POST['Material_id'];
$Material_name = $_POST['Material_name'];
$Material_quantity = $_POST['Material_quantity'];
$Unit_id = $_POST['Unit_id'];
$MaterialType_id = $_POST['MaterialType_id'];
  $sql = "INSERT INTO material
  (
  Auto_number,
  Material_id,
  Material_name,
  Material_quantity,
  Unit_id,
  MaterialType_id
  ) 
  VALUES
  (
  '$Auto_number',
  '$Material_id',
  '$Material_name',
  '$Material_quantity',
  '$Unit_id',
  '$MaterialType_id'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Material.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Material.php';";
        echo "</script>";
    }
exit();
