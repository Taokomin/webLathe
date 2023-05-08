<?php

function getEmployeeName($userId)
{
    require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
    $db = $con;


    $query = "SELECT CONCAT(Employee_name, ' ', Employee_surname) AS full_name FROM employee WHERE Employee_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['full_name'];
}

?>