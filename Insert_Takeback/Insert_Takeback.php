<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Takeback_id'] = '0';
$GLOBALS['Takeback_detail_id'] = '0';


$sql1 = "SELECT Takeback_id FROM takeback ORDER BY Takeback_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1 && $result1['Takeback_id']) {
    $GLOBALS['Takeback_id'] = $result1['Takeback_id'];
}



$sql2 = "SELECT Takeback_detail_id FROM takeback_detail ORDER BY Takeback_detail_id DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2 && $result2['Takeback_detail_id']) {
    $GLOBALS['Takeback_detail_id'] = $result2['Takeback_detail_id'];
}



function increaseIdTm($Takeback_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Takeback_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'TM' . $concatIdWithString;
}
function increaseIdTmd($Takeback_detail_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Takeback_detail_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'TMD' . $concatIdWithString;
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
        <title>เพิ่มข้อมูลรับคืนวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลรับคืนวัสดุและอุปกรณ์</h1>
            <hr>
            <form id="myForm" method="GET">
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Takeback_id" class="form-label">รหัสเบิกวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="Takeback_id" value="<?php echo (increaseIdTm($GLOBALS['Takeback_id'])); ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Takeback_day" class="form-label">วันที่รับคืน</label>
                    <input type="date" class="form-control" name="Takeback_day" id="Takeback_day" value="<?php echo date('Y-m-d'); ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#Takeback_day').Takeback_day({
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
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $query1 = "SELECT PickupMaterial_detail_id FROM pickup_material_detail ORDER BY PickupMaterial_detail_id ASC";
                $result1 = mysqli_query($con, $query1);
                ?>
                <div class="mb-3" style="width : 166px;">
                    <label for="searchInput" class="form-label">เลือกรหัสคืน</label>
                    <select class="form-select" aria-label="Default select example" name="PickupMaterial_detail_id" required>
                        <option value="<?php if (isset($_GET['PickupMaterial_detail_id'])) {
                                            echo htmlspecialchars($_GET['PickupMaterial_detail_id']);
                                        } ?>">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <option value="<?php echo $results["PickupMaterial_detail_id"]; ?>">
                                <?php echo $results["PickupMaterial_detail_id"]; ?>
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
                        document.getElementById("myForm").action = "ProcTmi.php";
                        document.getElementById("myForm").method = "GET";
                        document.getElementById("myForm").submit();
                    }
                </script>
                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

                if (isset($_GET['PickupMaterial_detail_id'])) {
                    $PickupMaterial_detail_id = mysqli_real_escape_string($con, $_GET['PickupMaterial_detail_id']);

                    $query = "SELECT pm.*,pmd.PickupMaterial_quantity, m.Material_name, e.Employee_name, e.Employee_surname, 
                    mt.MaterialType_name, s.status_name,mt.MaterialType_id,pmd.Counting_unit,pmd.PickupMaterial_detail,pmd.PickupMaterial_detail_id,m.Material_id,
                    u.Unit_id AS Counting_unit_id, u.Unit_name AS Counting_unit_name
                    FROM pickup_material AS pm
                    INNER JOIN pickup_material_detail AS pmd ON pm.PickupMaterial_id = pmd.PickupMaterial_id
                    INNER JOIN material AS m ON pmd.PickupMaterial_detail = m.Material_id
                    INNER JOIN material_type AS mt ON pmd.MaterialType_id = mt.MaterialType_id
                    INNER JOIN unit AS u ON pmd.Counting_unit = u.Unit_id
                    INNER JOIN employee AS e ON pm.Employee_id = e.Employee_id
                    INNER JOIN status AS s ON pm.PickupMaterial_status = s.status_id
                    ORDER BY PickupMaterial_id ASC";


                    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        $takebackDetailId = increaseIdTmd($GLOBALS['Takeback_detail_id']);

                        echo '<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label  class="form-label">รหัสสั่งสินค้า</label>';
                        echo '<input type="hidden" class="form-control" name="Takeback_detail_id" value="' . $takebackDetailId . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="PickupMaterial_detail_id"  value="' . $row['PickupMaterial_detail_id'] . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row['PickupMaterial_id'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Takeback_detail" class="form-label">สินค้าที่สั่งทำ</label>';
                        echo '<input type="text" class="form-control"  value="' . $row['Material_name'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Takeback_detail" value="' . $row['Material_id'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Material_id" value="' . $row['Material_id'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="PickupMaterial_quantity" class="form-label">จำนวน</label>';
                        echo '<input type="text" class="form-control" name="PickupMaterial_quantity" value="' . $row['PickupMaterial_quantity'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Counting_unit" class="form-label">หน่วยนับ</label>';
                        echo '<input type="text" class="form-control"  value="' . $row['Counting_unit_name'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Counting_unit" value="' . $row['Counting_unit'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Takeback_quantity" class="form-label">จำนวนคืน</label>';
                        echo '<input type="text" class="form-control" name="Takeback_quantity" value=""  required>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="MaterialType_id" class="form-label">ประเภท</label>';
                        echo '<input type="text" class="form-control"  value="' . $row['MaterialType_name'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="MaterialType_id" value="' . $row['MaterialType_id'] . '" readonly>';
                        echo '</div>';
                    } else {
                        echo '<p>ไม่พบข้อมูล Pre-Order ID ที่เลือก</p>';
                    }
                }
                ?>
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

                <div class="mb-3" style="width : 166px;">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" value="<?php echo getEmployeeName($_SESSION['User']); ?>" readonly>
                    <input type="hidden" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitData()">เพิ่มข้อมูล</button>
                    <a type="button" class="btn btn-danger " href="..\Takeback.php">ยกเลิก</a>
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
<?php } ?>