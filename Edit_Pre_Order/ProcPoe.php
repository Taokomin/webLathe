
<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$PreOrder_id = $_POST['PreOrder_id'];
$PreOrder_day = $_POST['PreOrder_day'];


$PreOrder_detail = $_POST['PreOrder_detail'];
$PreOrder_quantity = $_POST['PreOrder_quantity'];
$Counting_unit = $_POST['Counting_unit'];
$PreOrder_price = $_POST['PreOrder_price'];
$Price_unit = $_POST['Price_unit'];

$sql = "UPDATE pre_order SET  
PreOrder_day = '$PreOrder_day',
WHERE PreOrder_id = '$PreOrder_id'";
$result1 = mysqli_query($con, $sql);


$sql1 = "UPDATE pre_order_detail SET  
PreOrder_detail = '$PreOrder_detail',
PreOrder_quantity = '$PreOrder_quantity',
Counting_unit = '$Counting_unit'
PreOrder_price = '$PreOrder_price'
Price_unit = '$Price_unit'
WHERE PreOrder_id = '$PreOrder_id'";
$result2 = mysqli_query($con, $sql1);


if ($result1 && $result2) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Pre_Order.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Pre_Order.php';";
    echo "</script>";
}

exit();