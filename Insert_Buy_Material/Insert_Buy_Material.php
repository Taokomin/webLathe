<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['BuyMaterial_id'] = '0';
$GLOBALS['BuyMaterial_detail_id'] = '0';


$sql1 = "SELECT BuyMaterial_id FROM buy_material ORDER BY BuyMaterial_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if (isset($result1['BuyMaterial_id'])) {
    $GLOBALS['BuyMaterial_id'] = $result1['BuyMaterial_id'];
}

$sql1 = "SELECT BuyMaterial_detail_id FROM buy_material_detail ORDER BY BuyMaterial_detail_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if (isset($result1['BuyMaterial_detail_id'])) {
    $GLOBALS['BuyMaterial_detail_id'] = $result1['BuyMaterial_detail_id'];
}

function increaseIdBm($BuyMaterial_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $BuyMaterial_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'BM' . $concatIdWithString;
}
function increaseIdBmd($BuyMaterial_detail_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $BuyMaterial_detail_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'BMD' . $concatIdWithString;
}

?>
<?php session_start(); ?>
<?php

if (!$_SESSION["UserID"]) {

    Header("Location: index.php");
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>เพิ่มข้อมูลสั่งซื้อวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลสั่งซื้อวัสดุและอุปกรณ์</h1>
            <hr>
            <form action="ProcBmi.php" method="post">
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="BuyMaterial_id" class="form-label">รหัสสั่งสินค้าจากลูกค้า</label>
                    <input type="text" class="form-control" name="BuyMaterial_id" value="<?php echo (increaseIdBm($GLOBALS['BuyMaterial_id'])); ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="BuyMaterial_day" class="form-label">วันที่สั่ง</label>
                    <input type="date" class="form-control" name="BuyMaterial_day" id="BuyMaterial_day" value="<?php echo date('Y-m-d'); ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#BuyMaterial_day').PreOrder_day({
                                beforeShowDay: function(date) {
                                    var month = date.getMonth() + 1;
                                    var year = date.getFullYear();
                                    var day = date.getDate();
                                    var newdate = day + "-" + month + '-' + year;
                                    var tooltip_text = "New event on " + newdate;
                                    if ($.inArray(newdate, highlight_dates) != -1) {
                                        return [true, "highlight", tooltip_text];
                                    }
                                    return [true];
                                }
                            });
                        });
                    </script>
                </div>
                <div id="products">
                    <div class="product">
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_BuyMaterial_detail_id" class="form-label">รหัสรายการสั่งสินค้า</label>
                            <input type="text" class="form-control" name="product_BuyMaterial_detail_id[]" value="<?php echo (increaseIdBmd($GLOBALS['BuyMaterial_detail_id'])); ?>" readonly>
                        </div>
                        <?php
                        require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                        $sql1 = $con;
                        $query1 = "SELECT * FROM material ORDER BY Material_id asc";
                        $result1 = mysqli_query($sql1, $query1);
                        ?>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_BuyMaterial_detail" class="form-label">เลือกวัสดุและอุปกรณ์</label>
                            <select class="form-select" aria-label="Default select example" name="product_BuyMaterial_detail[]" required>
                                <option value="">-กรุณาเลือก-</option>
                                <?php foreach ($result1 as $results) { ?>
                                    <option value="<?php echo $results["Material_id"]; ?>">
                                        <?php echo $results["Material_name"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 120px;">
                            <label for="product1_BuyMaterial_quantity" class="form-label">จำนวน</label>
                            <input type="tel" class="form-control" name="product_BuyMaterial_quantity[]" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
                        </div>
                        <?php
                        require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                        $sql1 = $con;
                        $query1 = "SELECT * FROM unit ORDER BY Unit_id asc";
                        $result1 = mysqli_query($sql1, $query1);
                        ?>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_Counting_unit" class="form-label">เลือกหน่วยนับ</label>
                            <select class="form-select" aria-label="Default select example" name="product_Counting_unit[]" required>
                                <option value="">-กรุณาเลือก-</option>
                                <?php foreach ($result1 as $results) { ?>
                                    <option value="<?php echo $results["Unit_id"]; ?>">
                                        <?php echo $results["Unit_name"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 120px;">
                            <label for="product1_BuyMaterial_price" class="form-label">ราคา</label>
                            <input type="text" class="form-control" name="product_BuyMaterial_price[]" required onkeypress="return isNumberKey(event)">
                        </div>
                        <?php
                            require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                            $sql1 = $con;
                            $query1 = "SELECT * FROM unit ORDER BY Unit_id asc";
                            $result1 = mysqli_query($sql1, $query1);
                            ?>
                            <div class="mb-3" style="display: inline-block;width : 166px;">
                                <label for="product1_Price_unit" class="form-label">เลือกหน่วยนับ</label>
                                <select class="form-select" aria-label="Default select example" name="product_Price_unit[]" required>
                                    <option value="">-กรุณาเลือก-</option>
                                    <?php foreach ($result1 as $results) { ?>
                                        <option value="<?php echo $results["Unit_id"]; ?>" <?php if ($results["Unit_id"] === 'UN05') : ?>selected<?php endif; ?>>
                                            <?php echo $results["Unit_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                </div>
                <button type="button" onclick="addProduct()" class="btn btn-primary">เพิ่มรายการสั่งซื้อ</button>
                <br><br>
                <script>
                    function addProduct() {
                        // Find the products container
                        const productsContainer = document.querySelector("#products");

                        // Clone the first product element
                        const newProduct = productsContainer.firstElementChild.cloneNode(true);

                        // Find all input elements and clear their values
                        const inputElements = newProduct.querySelectorAll("input");
                        inputElements.forEach((input) => {
                            input.value = "";
                        });

                        // Find all select elements and set their selected index to 0
                        const selectElements = newProduct.querySelectorAll("select");
                        selectElements.forEach((select) => {
                            select.selectedIndex = 0;
                        });

                        // Update the order item code
                        const lastProduct = productsContainer.lastElementChild;
                        const lastProductCode = lastProduct.querySelector('[name="product_BuyMaterial_detail_id[]"]').value;
                        const newProductCode = 'BMD' + (parseInt(lastProductCode.substr(3)) + 1).toString().padStart(2, '0');
                        newProduct.querySelector('[name="product_BuyMaterial_detail_id[]"]').value = newProductCode;

                        // Set the counting unit input value to "UN05"
                        const newProductUnitInput = newProduct.querySelector('[name="product_Price_unit[]"]');
                            newProductUnitInput.value = "UN05";

                        // Append the new product to the products container
                        productsContainer.appendChild(newProduct);
                    }
                </script>

                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql2 = $con;
                $query2 = "SELECT Partner_id, Partner_name, Partner_surname FROM Partner ORDER BY Partner_id ASC";
                $result2 = mysqli_query($sql2, $query2);
                ?>
                <div class="mb-3" style="display: inline-block;">
                    <label for="Partner_id" class="form-label">ชื่อคู่ค้า</label>
                    <select class="form-select" aria-label="Default select example" name="Partner_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result2 as $results) { ?>
                            <option value="<?php echo $results["Partner_id"]; ?>">
                                <?php echo $results["Partner_name"] . " " . $results["Partner_surname"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
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

                <div class="mb-3" style="display: inline-block;">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" value="<?php echo getEmployeeName($_SESSION['User']); ?>" readonly>
                    <input type="hidden" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>
                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql3 = $con;
                $query3 = "SELECT status_id,status_name FROM status ORDER BY status_id ASC";
                $result3 = mysqli_query($sql3, $query3);
                ?>
                <div class="mb-3" style="display: inline-block;">
                    <label for="BuyMaterial_status" class="form-label">สถานะ</label>
                    <?php while ($row = mysqli_fetch_assoc($result3)) : ?>
                        <?php if ($row['status_id'] === 'ST01') : ?>
                            <input type="hidden" class="form-control" name="BuyMaterial_status" value="<?php echo $row['status_id']; ?>" readonly>
                            <input type="text" class="form-control" value="<?php echo $row['status_name']; ?>" readonly>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ">เพิ่มข้อมูล </button>
                    <a type="button" class="btn btn-danger " href="..\Buy_Material.php">ยกเลิก</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
        </script>
    </body>

    </html>
<?php } ?>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Noto+Serif+Thai:wght@200;400&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Noto Serif Thai", serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #03018C, #212AA5, #4259C3);
    }

    .container {
        max-width: 1000px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: linear-gradient(135deg, #03018C, #212AA5, #4259C3);
    }
</style>