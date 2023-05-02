<?php
$con = mysqli_connect("localhost", "root", "", "lathe_application_db") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
?>