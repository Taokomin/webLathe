<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$EmployeeType_id = $_POST['EmployeeType_id'];
$EmployeeType_name = $_POST['EmployeeType_name'];
$sql = "UPDATE employee_type SET  EmployeeType_name = '$EmployeeType_name' WHERE EmployeeType_id = '$EmployeeType_id'";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Employee_Type.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Material_Type.php';";
    echo "</script>";
}

exit();
?>
