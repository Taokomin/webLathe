<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

if (isset($_GET['Customer_id'])) {
    $Customer_id = $_GET['Customer_id'];
    $query = "DELETE FROM customer WHERE Customer_id ='" . $Customer_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Customer.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
