<?php
session_start();
if (isset($_POST['Username'])) {
    require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM user WHERE Username='" . $Username . "' AND Password='" . $Password . "' ";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result);

        $_SESSION["UserID"] = $row["ID"];
        $_SESSION["User"] = $row["Employee_id"];
        $_SESSION["Userlevel"] = $row["License_id"];

        if ($_SESSION["Userlevel"] == "LC03") {

            Header("Location: executive.php");
        } else if ($_SESSION["Userlevel"] == "LC02") {

            Header("Location: manager.php");
        } else if ($_SESSION["Userlevel"] == "LC01") {

            Header("Location: index.php");
        } else {
            echo "<script>";
            echo "alert(\" Username หรือ  Password ไม่ถูกต้อง\");";
            echo "window.history.back()";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert(\" Username หรือ  Password ไม่ถูกต้อง\");";
        echo "window.history.back()";
        echo "</script>";
    }
} else {
    Header("Location: login.php");
}
?>