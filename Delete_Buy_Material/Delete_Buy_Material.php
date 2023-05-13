<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (isset($_GET['BuyMaterial_detail_id'])) {
    $BuyMaterial_detail_id = $_GET['BuyMaterial_detail_id'];
    $query = "DELETE FROM buy_material_detail WHERE BuyMaterial_detail_id ='" . $BuyMaterial_detail_id . "'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location = '../Buy_Material.php'</script>";
        exit();
    } else {
        echo "<script>alert('ข้อมูลนี้ไม่มีในระบบ'); history.back();</script>";
    }
}
