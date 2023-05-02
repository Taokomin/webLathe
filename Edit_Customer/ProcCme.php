<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$Customer_id = $_POST['Customer_id'];
$Prefix_id = $_POST['Prefix_id'];
$Customer_name = $_POST['Customer_name'];
$Customer_surname    = $_POST['Customer_surname'];
$Customer_number = $_POST['Customer_number'];
$Customer_email = $_POST['Customer_email'];
$sql = "UPDATE customer SET  Prefix_id = '$Prefix_id',Customer_name = '$Customer_name',Customer_surname = '$Customer_surname',Customer_number = '$Customer_number',Customer_email = '$Customer_email' WHERE Customer_id = '$Customer_id'";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Customer.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Customer.php';";
    echo "</script>";
}

exit();
