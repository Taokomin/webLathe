<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

if (!$con) {
    mysqli_connect_errno();
}

$maxIdLength = 3;
$Deliver_id = '0';
$Deliver_detail_id = '0';

$sql1 = "SELECT Deliver_id FROM deliver ORDER BY Deliver_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if (isset($result1['Deliver_id'])) {
    $Deliver_id = $result1['Deliver_id'];
}

$sql2 = "SELECT Deliver_detail_id FROM deliver_detail ORDER BY Deliver_detail_id DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if (isset($result2['Deliver_detail_id'])) {
    $Deliver_detail_id = $result2['Deliver_detail_id'];
}

function increaseIdDv($Deliver_id)
{
    global $maxIdLength;

    $matchId = preg_replace('/[^0-9]/', '', $Deliver_id);
    $convertStringToInt = (int) $matchId;

    $concatIdWithString = (string) ($convertStringToInt + 1);

    $round = 0;
    while ($round < $maxIdLength - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'DV' . $concatIdWithString;
}

function increaseIdDvd($Deliver_detail_id)
{
    global $maxIdLength;

    $matchId = preg_replace('/[^0-9]/', '', $Deliver_detail_id);
    $convertStringToInt = (int) $matchId;

    $concatIdWithString = (string) ($convertStringToInt + 1);

    $round = 0;
    while ($round < $maxIdLength - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'DVD' . $concatIdWithString;
}

?>
<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (isset($_GET['Pre_Order_id'])) {
    $pre_order_id = $_GET['Pre_Order_id'];
    $query = "
        SELECT po.*, u.Unit_name, c.Customer_name, c.Customer_surname
        FROM pre_order AS po
        INNER JOIN unit AS u ON po.Unit_id = u.Unit_id
        INNER JOIN customer AS c ON po.Customer_id = c.Customer_id
        WHERE po.Pre_Order_id = '$pre_order_id';
    ";

    $result = mysqli_query($con, $query);
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
        <title>เพิ่มข้อมูลการส่งมอบ</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลการส่งมอบ</h1>
            <hr>
            <form id="myForm" method="GET">
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Deliver_id" class="form-label">รหัสส่งมอบ</label>
                    <input type="text" class="form-control" name="Deliver_id" value="<?php echo (increaseIdDv($GLOBALS['Deliver_id'])); ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Deliver_day" class="form-label">วันที่ส่งมอบ</label>
                    <input type="date" class="form-control" name="Deliver_day" id="Deliver_day" value="<?php echo date('Y-m-d'); ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#Deliver_day').Deliver_day({
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

                $query1 = "SELECT * FROM pre_order_detail ORDER BY PreOrder_detail_id ASC";
                $result1 = mysqli_query($con, $query1) or die("Error: " . mysqli_error($con));
                ?>

                <div class="mb-3" style="width: 166px;">
                    <label for="searchInput" class="form-label">เลือกรหัสส่งมอบซื้อสินค้า</label>
                    <select class="form-select" aria-label="Default select example" name="PreOrder_detail_id" id="pre-order-select" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php while ($results = mysqli_fetch_assoc($result1)) { ?>
                            <option value="<?php echo htmlspecialchars($results["PreOrder_detail_id"]); ?>">
                                <?php echo $results["PreOrder_detail_id"]; ?>
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
                        document.getElementById("myForm").action = "ProcDvi.php";
                        document.getElementById("myForm").method = "GET";
                        document.getElementById("myForm").submit();
                    }
                </script>
                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

                if (isset($_GET['PreOrder_detail_id'])) {
                    $PreOrder_detail_id = mysqli_real_escape_string($con, $_GET['PreOrder_detail_id']);

                    $query = "SELECT pod.*, po.Customer_id,po.PreOrder_day, u.Unit_id AS Counting_unit_id, u3.Unit_name AS Counting_unit_name,
                pod.PreOrder_price, u2.Unit_id AS Price_unit_id, u4.Unit_name AS Price_unit_name , c.Customer_name, c.Customer_surname
                FROM pre_order_detail AS pod
                INNER JOIN pre_order po ON pod.PreOrder_id = po.PreOrder_id
                INNER JOIN unit AS u ON pod.Counting_unit = u.Unit_id
                INNER JOIN unit AS u2 ON pod.Price_unit = u2.Unit_id
                INNER JOIN unit AS u3 ON pod.Counting_unit = u3.Unit_id
                INNER JOIN unit AS u4 ON pod.Price_unit = u4.Unit_id
                INNER JOIN customer AS c ON po.Customer_id = c.Customer_id
                WHERE pod.PreOrder_detail_id = '$PreOrder_detail_id'";


                    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        $deliverDetailId = increaseIdDvd($GLOBALS['Deliver_detail_id']);

                        echo '<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label  class="form-label">รหัสสั่งสินค้า</label>';
                        echo '<input type="hidden" class="form-control" name="Deliver_detail_id" value="' . $deliverDetailId . '" readonly>';
                        echo '<input type="text" class="form-control"  value="' . $row['PreOrder_id'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Deliver_detail" class="form-label">สินค้าที่สั่งทำ</label>';
                        echo '<input type="text" class="form-control" name="Deliver_detail" value="' . $row['PreOrder_detail'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Deliver_quantity" class="form-label">จำนวน</label>';
                        echo '<input type="text" class="form-control" name="Deliver_quantity" value="' . $row['PreOrder_quantity'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Counting_unit" class="form-label">หน่วยนับ</label>';
                        echo '<input type="text" class="form-control"  value="' . $row['Counting_unit_name'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Counting_unit" value="' . $row['Counting_unit'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Deliver_price" class="form-label">ราคา</label>';
                        echo '<input type="text" class="form-control" name="Deliver_price" value="' . $row['PreOrder_price'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 120px;">';
                        echo '<label for="Price_unit" class="form-label">หน่วยนับ</label>';
                        echo '<input type="text" class="form-control"  value="' . $row['Price_unit_name'] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Price_unit" value="' . $row['Price_unit'] . '" readonly>';
                        echo '</div>';

                        echo '&nbsp;&nbsp;<div class="mb-3" style="display: inline-block;width : 166px;">';
                        echo '<label for="Customer_id" class="form-label">ชื่อลูกค้า</label>';
                        echo '<input type="text" class="form-control" value="' . $row["Customer_name"] . " " . $row["Customer_surname"] . '" readonly>';
                        echo '<input type="hidden" class="form-control" name="Customer_id" value="' . $row["Customer_id"] . '" readonly>';
                        echo '</div>';
                    } else {
                        echo '<p>ไม่พบข้อมูล Pre-Order ID ที่เลือก</p>';
                    }
                }
                ?>
                <div class="mb-3" style="width : 940px;">
                    <label for="Deliver_address" class="form-label">ที่อยู่ที่ส่งมอบ</label>
                    <input type="text" class="form-control" name="Deliver_address" value="" required>
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

                <div class="mb-3" style="width : 166px;">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" value="<?php echo getEmployeeName($_SESSION['User']); ?>" readonly>
                    <input type="hidden" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitData()">เพิ่มข้อมูล </button>
                    <a type="button" class="btn btn-danger " href="..\Deliver.php">ยกเลิก</a>
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