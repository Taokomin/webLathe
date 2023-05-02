<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Partner_id = $_POST['Partner_id'];
$Prefix_id = $_POST['Prefix_id'];
$Partner_name = $_POST['Partner_name'];
$Partner_surname 	= $_POST['Partner_surname '];
$Partner_number = $_POST['Partner_number'];
$Partner_company = $_POST['Partner_company'];
$sql = "UPDATE partner SET  Prefix_id = '$Prefix_id',Partner_name = '$Partner_name',Partner_surname = '$Partner_surname',Partner_number = '$Partner_number',Partner_company = '$Partner_company' WHERE Partner_id = '$Partner_id'";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Partner.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Partner.php';";
        echo "</script>";
    }
exit();
