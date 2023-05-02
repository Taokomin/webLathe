<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

if (isset($_GET['AcceptMaterial_id'])) {
    $AcceptMaterial_id = $_GET['AcceptMaterial_id'];
    $query = "DELETE FROM accept_material WHERE AcceptMaterial_id ='" . $AcceptMaterial_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Accept_Material.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
