<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (isset($_GET['PickupMaterial_detail_id'])) {
    $PickupMaterial_detail_id = $_GET['PickupMaterial_detail_id'];
    $query = "DELETE FROM pickup_material_detail WHERE PickupMaterial_detail_id ='" . $PickupMaterial_detail_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Pickup_Material.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
