<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (isset($_GET['PreOrder_detail_id'])) {
    $PreOrder_detail_id = $_GET['PreOrder_detail_id'];
    $query = "DELETE FROM pre_order_detail WHERE PreOrder_detail_id ='" . $PreOrder_detail_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Pre_Order.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
