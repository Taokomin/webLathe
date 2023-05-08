<?php
if ($_POST["Password"] === $_POST["Confirm_password"]) {
    $ID = $_POST['ID'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Employee_id = $_POST['Employee_id'];
    $License_id = $_POST['License_id'];

    require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
    $con;
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $sql = "INSERT INTO user (ID,Username, Password, Employee_id,License_id) VALUES ('$ID','$Username', '$Password', '$Employee_id', '$License_id')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('ใส่ข้อมูลเรียบร้อยแล้ว!')</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแทรกข้อมูล: " . mysqli_error($con) . "')</script>";
    }


    mysqli_close($con);
} else {

    echo "<script>alert('รหัสผ่านไม่ตรงกัน.')</script>";
}
