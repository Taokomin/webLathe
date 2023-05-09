<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['AcceptMaterial_id'] = '0';
$GLOBALS['AcceptMaterial_detail_id'] = '0';


$sql1 = "SELECT AcceptMaterial_id FROM accept_material ORDER BY AcceptMaterial_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if (isset($result1['AcceptMaterial_id'])) {
    $GLOBALS['AcceptMaterial_id'] = $result1['AcceptMaterial_id'];
}
$sql2 = "SELECT AcceptMaterial_detail_id FROM accept_material_detail ORDER BY AcceptMaterial_detail_id DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if (isset($result2['AcceptMaterial_detail_id'])) {
    $AcceptMaterial_detail_id = $result2['AcceptMaterial_detail_id'];
}
function increaseIdAm($AcceptMaterial_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $AcceptMaterial_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'AM' . $concatIdWithString;
}
function increaseIdAmd($AcceptMaterial_detail_id)
{
    global $maxIdLength;

    $matchId = preg_replace('/[^0-9]/', '', $AcceptMaterial_detail_id);
    $convertStringToInt = (int) $matchId;

    $concatIdWithString = (string) ($convertStringToInt + 1);

    $round = 0;
    while ($round < $maxIdLength - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'AMD' . $concatIdWithString;
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
        <title>เพิ่มข้อมูลรับเข้าวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลรับเข้าวัสดุและอุปกรณ์</h1>
            <hr>
            <form id="myForm" method="GET">

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="AcceptMaterial_id" class="form-label">รหัสรับเข้า</label>
                    <input type="text" class="form-control" name="AcceptMaterial_id" value="<?php echo (increaseIdAm($GLOBALS['AcceptMaterial_id'])); ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="AcceptMaterial_day" class="form-label">วันที่รับเข้า</label>
                    <input type="date" class="form-control" name="AcceptMaterial_day" id="AcceptMaterial_day" value="<?php echo date('Y-m-d'); ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#AcceptMaterial_day').AcceptMaterial_day({
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

                $query1 = "SELECT bmd.*, bm.BuyMaterial_status
           FROM buy_material_detail AS bmd
           INNER JOIN buy_material AS bm ON bmd.BuyMaterial_id = bm.BuyMaterial_id
           WHERE bm.BuyMaterial_status = 'ST02' 
           ORDER BY bmd.BuyMaterial_detail_id ASC";
                $result1 = mysqli_query($con, $query1);
                ?>
                <div class="mb-3" style="width : 166px;">
                    <label for="searchInput" class="form-label">เลือกรหัสสั่งซื้อ</label>
                    <select class="form-select" aria-label="Default select example" name="BuyMaterial_detail_id" required>
                        <option value="<?php if (isset($_GET['BuyMaterial_detail_id'])) {
                                            echo htmlspecialchars($_GET['BuyMaterial_detail_id']);
                                        } ?>">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <option value="<?php echo $results["BuyMaterial_detail_id"]; ?>">
                                <?php echo $results["BuyMaterial_detail_id"]; ?>
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
                        document.getElementById("myForm").action = "ProcAmi.php";
                        document.getElementById("myForm").method = "GET";
                        document.getElementById("myForm").submit();
                    }
                </script>


                <?php
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

                if (isset($_GET['BuyMaterial_detail_id'])) {

                    $BuyMaterial_detail_id = $_GET['BuyMaterial_detail_id'];

                    $query = "SELECT bmd.*,
                m.Material_name,
                m.Material_quantity,
                m.Material_price,
                u.Unit_id AS Counting_unit_id,
                u3.Unit_name AS Counting_unit_name,
                u2.Unit_id AS Price_unit_id,
                u4.Unit_name AS Price_unit_name,
                mt.MaterialType_name,
                p.Partner_id, 
                p.Partner_name, 
                p.Partner_surname, 
                e.Employee_name, 
                e.Employee_surname,
                s.status_name

                FROM buy_material_detail AS bmd
                INNER JOIN buy_material AS b ON bmd.BuyMaterial_id = b.BuyMaterial_id
                INNER JOIN Material AS m ON bmd.BuyMaterial_detail = m.Material_id 
                INNER JOIN unit AS u ON bmd.Counting_unit = u.Unit_id
                INNER JOIN unit AS u2 ON bmd.Price_unit = u2.Unit_id
                INNER JOIN unit AS u3 ON bmd.Counting_unit = u3.Unit_id
                INNER JOIN unit AS u4 ON bmd.Price_unit = u4.Unit_id
                INNER JOIN material_type AS mt ON bmd.MaterialType_id = mt.MaterialType_id
                INNER JOIN partner AS p ON b.Partner_id = p.Partner_id
                INNER JOIN employee AS e ON b.Employee_id = e.Employee_id
                INNER JOIN status AS s ON b.BuyMaterial_status = s.status_id
                WHERE bmd.BuyMaterial_detail_id = '$BuyMaterial_detail_id'
                ORDER BY b.BuyMaterial_id ASC;";


                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);

                        $acceptDetailId = increaseIdAMd($GLOBALS['AcceptMaterial_detail_id']);


                        echo '<div class="mb-3">';
                        echo '<input type="hidden" class="form-control" name="Material_quantity" value="' . $row["Material_quantity"] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<input type="hidden" class="form-control" name="Material_price" value="' . $row["Material_price"] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="AcceptMaterial_detail_id" class="form-label">รหัสสั่งซื้อ</label>';
                        echo '<input type="hidden" class="form-control" name="AcceptMaterial_detail_id" value="' . $acceptDetailId . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row['BuyMaterial_id'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="AcceptMaterial_detail" class="form-label">ชื่อวัสดุ</label>';
                        echo '<input type="hidden" class="form-control" name="AcceptMaterial_detail" value="' . $row['BuyMaterial_detail'] . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row['Material_name'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="AcceptMaterial_quantity" class="form-label">จำนวน</label>';
                        echo '<input type="text" class="form-control" name="AcceptMaterial_quantity" value="' . $row['BuyMaterial_quantity'] . '" readonly>';
                        echo '</div>';


                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Counting_unit" class="form-label">จำนวน</label>';
                        echo '<input type="hidden" class="form-control" name="Counting_unit" value="' . $row['Counting_unit'] . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row['Counting_unit_name'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="AcceptMaterial_price" class="form-label">ราคา</label>';
                        echo '<input type="text" class="form-control" name="AcceptMaterial_price" value="' . $row['BuyMaterial_price'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Price_unit" class="form-label">หน่วยนับ</label>';
                        echo '<input type="hidden" class="form-control" name="Price_unit" value="' . $row["Price_unit"] . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row["Price_unit_name"] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="MaterialType_id" class="form-label">ประเภท</label>';
                        echo '<input type="hidden" class="form-control" name="MaterialType_id" value="' . $row["MaterialType_id"] .  '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row["MaterialType_name"] .  '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Partner_id" class="form-label">ชื่อคู่ค้า</label>';
                        echo '<input type="text" class="form-control" value="' . $row["Partner_name"] . " " . $row["Partner_surname"] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Partner_id" value="' . $row["Partner_id"] . '" readonly>';
                        echo '</div>';
                    } else {

                        echo '<p>ไม่พบข้อมูลที่เลือก</p>';
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

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" value="<?php echo getEmployeeName($_SESSION['User']); ?>" readonly>
                    <input type="hidden" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitData()">เพิ่มข้อมูล </button>
                    <a type="button" class="btn btn-danger " href="..\Accept_Material.php">ยกเลิก</a>
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
        max-width: 1090px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }
</style>