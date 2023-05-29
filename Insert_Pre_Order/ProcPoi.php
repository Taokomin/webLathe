<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$PreOrder_id = mysqli_real_escape_string($con, $_POST['PreOrder_id']);
$PreOrder_day = mysqli_real_escape_string($con, $_POST['PreOrder_day']);
$Customer_id = mysqli_real_escape_string($con, $_POST['Customer_id']);
$Employee_id = mysqli_real_escape_string($con, $_POST['Employee_id']);
$product_PreOrder_detail_id = $_POST['product_PreOrder_detail_id'];
$product_PreOrder_detail = $_POST['product_PreOrder_detail'];
$product_PreOrder_quantity = $_POST['product_PreOrder_quantity'];
$product_Counting_unit = $_POST['product_Counting_unit'];
$product_PreOrder_price = $_POST['product_PreOrder_price'];
$product_Price_unit = $_POST['product_Price_unit'];
$product_showTb = $_POST['product_showTb'];


$sql1 = "INSERT INTO pre_order (PreOrder_id, PreOrder_day, Customer_id, Employee_id) 
         VALUES ('$PreOrder_id', '$PreOrder_day', '$Customer_id', '$Employee_id')";
mysqli_query($con, $sql1);

for ($i = 0; $i < count($product_PreOrder_detail_id); $i++) {
    $PreOrder_detail_id = mysqli_real_escape_string($con, $product_PreOrder_detail_id[$i]);

    echo $product_PreOrder_detail_id[$i];
    $PreOrder_detail = mysqli_real_escape_string($con, $product_PreOrder_detail[$i]);
    $PreOrder_quantity = mysqli_real_escape_string($con, $product_PreOrder_quantity[$i]);
    $Counting_unit = mysqli_real_escape_string($con, $product_Counting_unit[$i]);
    $PreOrder_price = mysqli_real_escape_string($con, $product_PreOrder_price[$i]);
    $Price_unit = mysqli_real_escape_string($con, $product_Price_unit[$i]);
    $showTb = mysqli_real_escape_string($con, $product_showTb[$i]);

    $sql2 = "INSERT INTO pre_order_detail (PreOrder_detail_id, PreOrder_detail, PreOrder_quantity, Counting_unit, PreOrder_price, Price_unit, PreOrder_id,showTb)
             VALUES ('$PreOrder_detail_id', '$PreOrder_detail', '$PreOrder_quantity', '$Counting_unit', '$PreOrder_price', '$Price_unit', '$PreOrder_id','$showTb')";
    mysqli_query($con, $sql2);
}

if(mysqli_affected_rows($con) > 0) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Pre_Order.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Pre_Order.php';";
    echo "</script>";
    exit;
}

mysqli_close($con);
