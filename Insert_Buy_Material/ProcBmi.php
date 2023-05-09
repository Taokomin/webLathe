<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$BuyMaterial_id = mysqli_real_escape_string($con, $_POST['BuyMaterial_id']);
$BuyMaterial_day = mysqli_real_escape_string($con, $_POST['BuyMaterial_day']);
$Partner_id = mysqli_real_escape_string($con, $_POST['Partner_id']);
$Employee_id = mysqli_real_escape_string($con, $_POST['Employee_id']);
$BuyMaterial_status	 = mysqli_real_escape_string($con, $_POST['BuyMaterial_status']);
$product_BuyMaterial_detail_id = $_POST['product_BuyMaterial_detail_id'];
$product_BuyMaterial_detail = $_POST['product_BuyMaterial_detail'];
$product_BuyMaterial_quantity = $_POST['product_BuyMaterial_quantity'];
$product_Counting_unit = $_POST['product_Counting_unit'];
$product_BuyMaterial_price = $_POST['product_BuyMaterial_price'];
$product_Price_unit = $_POST['product_Price_unit'];



$sql1 = "INSERT INTO buy_material (BuyMaterial_id, BuyMaterial_day, Partner_id, Employee_id, BuyMaterial_status) 
         VALUES ('$BuyMaterial_id', '$BuyMaterial_day', '$Partner_id', '$Employee_id', '$BuyMaterial_status')";

mysqli_query($con, $sql1);

for ($i = 0; $i < count($product_BuyMaterial_detail_id); $i++) {
    $BuyMaterial_detail_id = mysqli_real_escape_string($con, $product_BuyMaterial_detail_id[$i]);

    echo $product_BuyMaterial_detail_id[$i];
    $BuyMaterial_detail = mysqli_real_escape_string($con, $product_BuyMaterial_detail[$i]);
    $BuyMaterial_quantity = mysqli_real_escape_string($con, $product_BuyMaterial_quantity[$i]);
    $Counting_unit = mysqli_real_escape_string($con, $product_Counting_unit[$i]);
    $BuyMaterial_price = mysqli_real_escape_string($con, $product_BuyMaterial_price[$i]);
    $Price_unit = mysqli_real_escape_string($con, $product_Price_unit[$i]);
    $MaterialType_id = mysqli_real_escape_string($con, $product_MaterialType_id[$i]);
    
    $sql2 = "INSERT INTO buy_material_detail (BuyMaterial_detail_id,  BuyMaterial_detail,BuyMaterial_quantity, Counting_unit, BuyMaterial_price, Price_unit,MaterialType_id ,BuyMaterial_id)
             VALUES ('$BuyMaterial_detail_id', '$BuyMaterial_detail', '$BuyMaterial_quantity', '$Counting_unit', '$BuyMaterial_price', '$Price_unit','$MaterialType_id', '$BuyMaterial_id')";
    mysqli_query($con, $sql2);
}

if(mysqli_affected_rows($con) > 0) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Buy_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Buy_Material.php';";
    echo "</script>";
    exit;
}

mysqli_close($con);
