<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
// Connect to the database
$conn = $con;

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert data into tb_po table
$po_code = $_POST["po_code"];
$order_date = $_POST["order_date"];
$customer_name = $_POST["customer_name"];
$employee_name = $_POST["employee_name"];

$sql = "INSERT INTO tb_po (code, order_date, customer_name, employee_name)
        VALUES ('$po_code', '$order_date', '$customer_name', '$employee_name')";

if ($conn->query($sql) !== TRUE) {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert data into tb_pod table
$product_codes = $_POST["product_codes"];
$product_names = $_POST["product_names"];
$product_quantities = $_POST["product_quantities"];
$product_counting_units = $_POST["product_counting_units"];
$product_prices = $_POST["product_prices"];
$product_price_units = $_POST["product_price_units"];

// Loop through the products and insert each one
for ($i = 0; $i < count($product_codes); $i++) {
  $code = $product_codes[$i];
  $name = $product_names[$i];
  $quantity = $product_quantities[$i];
  $counting_unit = $product_counting_units[$i];
  $price = $product_prices[$i];
  $price_unit = $product_price_units[$i];

  $sql = "INSERT INTO tb_pod (code, name, quantity, counting_unit, price, price_unit, po_code)
VALUES ('$code', '$name', '$quantity', '$counting_unit', '$price', '$price_unit', '$po_code')";

if ($conn->query($sql) !== TRUE) {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
$conn->close();
?>