<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$conn = $con;

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Material_id = $_GET['Material_id'];
$sql = "SELECT m.*, u.Unit_id as Counting_unit, u2.Unit_name as Counting_unit_name, u2.Unit_id as Price_unit , u2.Unit_name as Price_unit_name , u.Unit_name, u2.Unit_name, mt.MaterialType_name
FROM material as m 
INNER JOIN unit as u ON m.Counting_unit = u.Unit_id
INNER JOIN unit as u2 ON m.Counting_unit = u2.Unit_id
INNER JOIN material_type as mt ON m.MaterialType_id = mt.MaterialType_id
WHERE Material_id='" . $Material_id . "'
ORDER BY u.Unit_id, mt.MaterialType_id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $material = array(
    'Material_id' => $row['Material_name'],
    'Material_quantity' => $row['Material_quantity'],
    'Counting_unit' => $row['Counting_unit'],
    'Counting_unit_name' => $row['Counting_unit_name'],
  );
  echo json_encode($material);
} else {
  echo "0 results";
}

$conn->close();
?>