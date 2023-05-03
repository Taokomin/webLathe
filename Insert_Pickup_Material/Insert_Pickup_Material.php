<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['PickupMaterial_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest PickupMaterial_id from the database
$sql1 = "SELECT PickupMaterial_id FROM pickup_material ORDER BY PickupMaterial_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1 && $result1['PickupMaterial_id']) {
    $GLOBALS['PickupMaterial_id'] = $result1['PickupMaterial_id'];
}


// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM pickup_material ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2 && $result2['Auto_number']) {
    $GLOBALS['Auto_number'] = $result2['Auto_number'];
}


// Function to increase PickupMaterial_id
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

// Function to increase Auto_number
function increaseNumPm($Auto_number)
{
    $matchId = preg_replace('/[^0-9]/', '', $Auto_number);
    $Int = (int)$matchId;
    $newId = $Int + 1;
    return $newId;
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
            <form id="myForm" method="GET">
                <div class="mb-3">
                    <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                    <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumPm($GLOBALS['Auto_number'])); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="PickupMaterial_id" class="form-label">รหัสเบิกวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="PickupMaterial_id" value="<?php echo (increaseIdPm($GLOBALS['PickupMaterial_id'])); ?>" readonly>
                </div>
                <div class="mb-3">
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
                <?php
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                $query1 = "SELECT * FROM material ORDER BY Material_id ASC";
                $result1 = mysqli_query($con, $query1);
                ?>
                <div class="mb-3">
                    <label for="searchInput" class="form-label">เลือกรหัสวัสดุและอุปกรณ์</label>
                    <select class="form-select" aria-label="Default select example" name="Material_id" required>
                        <option value="<?php if (isset($_GET['Material_id'])) {
                                            echo htmlspecialchars($_GET['Material_id']);
                                        } ?>">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <option value="<?php echo $results["Material_id"]; ?>">
                                <?php echo $results["Material_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="searchBtn" onclick="submitSearch()">แสดงข้อมูล</button>
                </div>
                <script>
                    function submitSearch() {
                        document.getElementById("myForm").action = "";
                        document.getElementById("myForm").method = "GET";
                        document.getElementById("myForm").submit();
                    }

                    function submitData() {
                        document.getElementById("myForm").action = "ProcPmi.php";
                        document.getElementById("myForm").method = "GET";
                        document.getElementById("myForm").submit();
                    }
                </script>
                <?php
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');


                if (isset($_GET['Material_id'])) {

                    $Material_id = $_GET['Material_id'];


                    $query = "SELECT m.*, m.Material_name, u.Unit_name, mt.MaterialType_name
                              FROM material AS m
                              INNER JOIN unit AS u ON m.Unit_id = u.Unit_id
                              INNER JOIN material_type AS mt ON m.MaterialType_id = mt.MaterialType_id
                              WHERE m.Material_id = '$Material_id'";
                    $result = mysqli_query($con, $query);
                   
                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);


                        echo '<div class="mb-3">';
                        // echo '<label for="Material_id" class="form-label">รหัสสั่งซื้อวัสดุและอุปกรณ์</label>';
                        echo '<input type="hidden" class="form-control" name="Material_id" value="' . $row['Material_id'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="Material_name" class="form-label">ชื่อวัสดุและอุปกรณ์</label>';
                        echo '<input type="text" class="form-control" name="Material_name" value="' . $row['Material_name'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="Material_quantity" class="form-label">จำนวนที่มีอยู่</label>';
                        echo '<input type="tel" class="form-control" name="Material_quantity" value="' . $row['Material_quantity'] . '" readonly >';
                        echo '</div>';
   
                        echo '<div class="mb-3">';
                        echo '<label for="PickupMaterial_quantity" class="form-label">กรอกจำนวนที่ต้องการเบิก</label>';
                        echo '<input type="tel" class="form-control" name="PickupMaterial_quantity" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">';
                        echo '</div>';

                        // Add script to restrict input to numbers only
                        echo '<script>';
                        echo 'function isNumberKey(evt) {';
                        echo 'var charCode = (evt.which) ? evt.which : event.keyCode;';
                        echo 'if (charCode > 31 && (charCode < 48 || charCode > 57)) {';
                        echo 'return false;';
                        echo '}';
                        echo 'return true;';
                        echo '}';
                        echo '</script>'; 

                        echo '<div class="mb-3">';
                        echo '<label for="Unit_id" class="form-label">รหัสหน่วยนับ</label>';
                        echo '<input type="text" class="form-control" name="Unit_id" value="' . $row['Unit_name'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="MaterialType_id" class="form-label">รหัสประเภทวัสดุและอุปกรณ์</label>';
                        echo '<input type="text" class="form-control" name="MaterialType_id" value="' . $row['MaterialType_name'] . '" readonly>';
                        echo '</div>';
                    } else {
                        
                        echo '<p>ไม่พบข้อมูลที่เลือก</p>';
                    }
                }
                ?>

                <div class="mb-3">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="email" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="PickupMaterial_status" class="form-label">สถานะ</label>
                    <input type="text" class="form-control" name="PickupMaterial_status" value="รออนุมัติ" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitData()">เพิ่มข้อมูล </button>
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
            height: 115vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #03018C, #212AA5, #4259C3);
        }

        .container {
            max-width: 700px;
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