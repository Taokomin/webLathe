<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['PickupMaterial_id'] = '0';
$GLOBALS['PickupMaterial_detail_id'] = '0';

// Get the latest PickupMaterial_id from the database
$sql1 = "SELECT PickupMaterial_id FROM pickup_material ORDER BY PickupMaterial_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1 && $result1['PickupMaterial_id']) {
    $GLOBALS['PickupMaterial_id'] = $result1['PickupMaterial_id'];
}

$sql2 = "SELECT PickupMaterial_detail_id FROM pickup_material_detail ORDER BY PickupMaterial_detail_id DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2 && $result2['PickupMaterial_detail_id']) {
    $GLOBALS['PickupMaterial_detail_id'] = $result2['PickupMaterial_detail_id'];
}

function increaseIdPm($PickupMaterial_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $PickupMaterial_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'PM' . $concatIdWithString;
}
function increaseIdPmd($PickupMaterial_detail_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $PickupMaterial_detail_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'PMD' . $concatIdWithString;
}
?>
<?php
isset($_POST['date']) ? $date = $_POST['date'] : $date = "";
if (!empty($date)) {
    echo "<div style='margin-top:1rem;'>คุณเลือกวันที่ {$date}</div>";
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
        <title>เพิ่มข้อมูลเบิกวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลเบิกวัสดุและอุปกรณ์</h1>
            <hr>
            <form action="ProcPmi.php" method="post">
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_id" class="form-label">รหัสเบิก</label>
                    <input type="text" class="form-control" name="PickupMaterial_id" value="<?php echo (increaseIdPm($GLOBALS['PickupMaterial_id'])); ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_day" class="form-label">วันที่สั่ง</label>
                    <input type="date" class="form-control" name="PickupMaterial_day" id="PickupMaterial_day" value="<?php echo date('Y-m-d'); ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#PickupMaterial_day').PickupMaterial_day({
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
                <script>
                    function showMaterialInfo(str) {
                        if (str == "") {
                            document.getElementById("Material_id").value = "";
                            document.getElementById("Material_quantity").value = "";
                            document.getElementById("Counting_unit").value = "";
                            document.getElementById("Counting_unit_name").value = "";
                            return;
                        } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    var material = JSON.parse(this.responseText);
                                    document.getElementById("Material_id").value = material.Material_id;
                                    document.getElementById("Material_quantity").value = material.Material_quantity;
                                    document.getElementById("Counting_unit").value = material.Counting_unit;
                                    document.getElementById("Counting_unit_name").value = material.Counting_unit_name;
                                }
                            };
                            xmlhttp.open("GET", "getMaterialInfo.php?Material_id=" + str, true);
                            xmlhttp.send();
                        }
                    }

                    function addProduct() {
                        const productsContainer = document.querySelector("#products");
                        const newProduct = productsContainer.firstElementChild.cloneNode(true);
                        const inputElements = newProduct.querySelectorAll("input");
                        inputElements.forEach((input) => {
                            input.value = "";
                        });
                        const selectElements = newProduct.querySelectorAll("select");
                        selectElements.forEach((select) => {
                            select.selectedIndex = 0;
                        });
                        const lastProduct = productsContainer.lastElementChild;
                        const lastProductCode = lastProduct.querySelector('[name="product_PickupMaterial_detail_id[]"]').value;
                        const newProductCode = 'PMD' + (parseInt(lastProductCode.substr(3)) + 1).toString().padStart(2, '0');
                        newProduct.querySelector('[name="product_PickupMaterial_detail_id[]"]').value = newProductCode;
                        productsContainer.appendChild(newProduct);
                    }

                    function cloneForm() {
                        const productsContainer = document.querySelector("#products");
                        const firstProduct = productsContainer.firstElementChild;
                        const newProduct = firstProduct.cloneNode(true);
                        const inputElements = newProduct.querySelectorAll("input");
                        inputElements.forEach((input) => {
                            input.value = "";
                        });
                        const selectElements = newProduct.querySelectorAll("select");
                        selectElements.forEach((select) => {
                            select.selectedIndex = 0;
                        });
                        const lastProduct = productsContainer.lastElementChild;
                        const lastProductCode = lastProduct.querySelector('[name="product_PickupMaterial_detail_id[]"]').value;
                        const newProductCode = 'PMD' + (parseInt(lastProductCode.substr(3)) + 1).toString().padStart(2, '0');
                        newProduct.querySelector('[name="product_PickupMaterial_detail_id[]"]').value = newProductCode;
                        productsContainer.appendChild(newProduct);
                    }
                </script>
                <div id="products">
                    <div class="product">
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_PickupMaterial_detail_id" class="form-label">รหัสรายการเบิก</label>
                            <input type="text" class="form-control" name="product_PickupMaterial_detail_id[]" value="<?php echo (increaseIdPmd($GLOBALS['PickupMaterial_detail_id'])); ?>" readonly>
                        </div>
                        <?php
                        require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                        $sql1 = $con;
                        $query1 = "SELECT m.*, u.Unit_id as Counting_unit, u.Unit_name as Counting_unit_name, u2.Unit_id as Price_unit , u2.Unit_name as Price_unit_name , u.Unit_name, u2.Unit_name, mt.MaterialType_name
                        FROM material as m 
                        INNER JOIN unit as u ON m.Counting_unit = u.Unit_id
                        INNER JOIN unit as u2 ON m.Price_unit = u2.Unit_id
                        INNER JOIN material_type as mt ON m.MaterialType_id = mt.MaterialType_id
                        ORDER BY m.Material_id ASC";
                        $result1 = mysqli_query($sql1, $query1);
                        ?>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_PickupMaterial_detail" class="form-label">เลือกวัสดุ</label>
                            <select class="form-select material-dropdown" aria-label="Default select example" name="product_PickupMaterial_detail[]" onchange="showMaterialInfo(this.value)" required>
                                <option value="">-กรุณาเลือก-</option>
                                <?php foreach ($result1 as $results) { ?>
                                    <option value="<?php echo $results["Material_id"]; ?>">
                                        <?php echo $results["Material_id"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_PickupMaterial_detail_id" class="form-label">สินค้าที่สั่งทำ</label>
                            <input type="text" class="form-control" id="Material_id" readonly>
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 120px;">
                            <label for="product1_PickupMaterial_quantity" class="form-label">จำนวนที่มีอยู่</label>
                            <input type="tel" class="form-control" id="Material_quantity" readonly pattern="[0-9]+" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_Counting_unit" class="form-label">หน่วยนับ</label>
                            <input type="text" class="form-control" id="Counting_unit_name" readonly>
                            <input type="hidden" class="form-control" id="Counting_unit" name="product_Counting_unit[]" readonly>
                        </div>
                        <div class="mb-3" style="display: inline-block;width : 166px;">
                            <label for="product1_PickupMaterial_quantity" class="form-label">จำนวนที่ต้องการเบิก</label>
                            <input type="tel" class="form-control" id="Material_quantity" name="product_PickupMaterial_quantity[]" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                </div>
                <div >
                    <button type="button" onclick="addProduct()" class="btn btn-primary">เพิ่มรายการสั่งซื้อ</button>
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
                    <label for="PickupMaterial_status" class="form-label">สถานะ</label>
                    <?php while ($row = mysqli_fetch_assoc($result3)) : ?>
                        <?php if ($row['status_id'] === 'ST01') : ?>
                            <input type="hidden" class="form-control" name="PickupMaterial_status" value="<?php echo $row['status_id']; ?>" readonly>
                            <input type="text" class="form-control" value="<?php echo $row['status_name']; ?>" readonly>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">เพิ่มข้อมูล </button>
                    <a type="button" class="btn btn-danger " href="..\Pickup_Material.php">ยกเลิก</a>
                </div>
            </form>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
        </script>
    </body>

    </html>
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
            max-width: 1180px;
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
<?php } ?>