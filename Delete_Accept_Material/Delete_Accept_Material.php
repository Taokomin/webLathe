<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (isset($_GET['AcceptMaterial_detail_id'])) {
    $AcceptMaterial_detail_id = $_GET['AcceptMaterial_detail_id'];
    $query = "DELETE FROM accept_material_detail WHERE AcceptMaterial_detail_id ='" . $AcceptMaterial_detail_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Accept_Material.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
