<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

if (isset($_GET['Employee_id'])) {
    $Employee_id = $_GET['Employee_id'];
    $query = "DELETE FROM employee WHERE Employee_id ='" . $Employee_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Employee.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
