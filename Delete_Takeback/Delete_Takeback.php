<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (isset($_GET['Takeback_id'])) {
    $Takeback_id = $_GET['Takeback_id'];
    $query = "DELETE FROM takeback WHERE Takeback_id ='" . $Takeback_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Takeback.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
