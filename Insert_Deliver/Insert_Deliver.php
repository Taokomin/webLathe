<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Deliver_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest Deliver_id from the database
$sql1 = "SELECT Deliver_id FROM deliver ORDER BY Deliver_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if (isset($result1['Deliver_id'])) {
    $GLOBALS['Deliver_id'] = $result1['Deliver_id'];
}


// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM deliver ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if (isset($result2['Auto_number'])) {
    $GLOBALS['Auto_number'] = $result2['Auto_number'];
}

// Function to increase Deliver_id
function increaseIdDv($Deliver_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Deliver_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'DV' . $concatIdWithString;
}

// Function to increase Auto_number
function increaseNumDv($Auto_number)
{
    $matchId = preg_replace('/[^0-9]/', '', $Auto_number);
    $Int = (int)$matchId;
    $newId = $Int + 1;
    return $newId;
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
        <title>เพิ่มข้อมูลรหัสส่งมอบ</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">เพิ่มข้อมูลรหัสส่งมอบ</h1>
            <hr>
            <form id="myForm" method="GET">
                <div class="mb-3">
                    <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                    <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumDv($GLOBALS['Auto_number'])); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="Deliver_id" class="form-label">รหัสส่งมอบ</label>
                    <input type="text" class="form-control" name="Deliver_id" value="<?php echo (increaseIdDv($GLOBALS['Deliver_id'])); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="Deliver_day" class="form-label">วั่นที่สั่ง</label>
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
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                $query1 = "SELECT po.*, u.Unit_name
                FROM pre_order AS po
                INNER JOIN unit AS u ON po.Unit_id = u.Unit_id ORDER BY PreOrder_id ASC";
                $result1 = mysqli_query($con, $query1);
                ?>
                <div class="mb-3">
                    <label for="searchInput" class="form-label">เลือกรหัสสั่งซื้อสินค้าจากลูกค้า</label>
                    <select class="form-select" aria-label="Default select example" name="PreOrder_id" required>
                        <option value="<?php if (isset($_GET['PreOrder_id'])) {
                                            echo htmlspecialchars($_GET['PreOrder_id']);
                                        } ?>">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <option value="<?php echo $results["PreOrder_id"]; ?>">
                                <?php echo $results["PreOrder_detail"]. " " .$results["PreOrder_quantity"]. " " .$results["Unit_name"]; ?>
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
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

                // Check if a PreOrder_id has been selected
                if (isset($_GET['PreOrder_id'])) {

                    $PreOrder_id = $_GET['PreOrder_id'];

                    // Query the database for the selected PreOrder_id
                    $query = "SELECT po.*, u.Unit_name, c.Customer_name, c.Customer_surname
                            FROM pre_order AS po
                            INNER JOIN unit AS u ON po.Unit_id = u.Unit_id
                            INNER JOIN customer AS c ON po.Customer_id = c.Customer_id
                            WHERE po.PreOrder_id = '$PreOrder_id'";
                    $result = mysqli_query($con, $query);

                    // If there is a result, display the information in textboxes
                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);

                        // Create textboxes to display information
                        echo '<div class="mb-3">';
                        echo '<label for="PreOrder_id" class="form-label">รหัสสั่งซื้อสินค้าจากลูกค้า</label>';
                        echo '<input type="text" class="form-control" name="PreOrder_id" value="' . $row['PreOrder_id'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="PreOrder_day" class="form-label">วันที่สั่ง</label>';
                        echo '<input type="text" class="form-control" name="PreOrder_day" value="' . $row['PreOrder_day'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="PreOrder_detail" class="form-label">สินค้าที่สั่งทำ</label>';
                        echo '<input type="text" class="form-control" name="PreOrder_detail" value="' . $row['PreOrder_detail'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="PreOrder_quantity" class="form-label">จำนวน</label>';
                        echo '<input type="text" class="form-control" name="PreOrder_quantity" value="' . $row['PreOrder_quantity'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="Unit_id" class="form-label">หน่วยนับ</label>';
                        echo '<input type="text" class="form-control" name="Unit_id" value="' . $row['Unit_name'] . '" readonly>';
                        echo '</div>';

                        echo '<div class="mb-3">';
                        echo '<label for="Customer_id" class="form-label">ลูกค้า</label>';
                        echo '<input type="text" class="form-control" name="Customer_id" value="' . $row["Customer_name"] . " " . $row["Customer_surname"] . '" readonly>';
                        echo '</div>';
                    } else {
                        // If no result is found, display an error message
                        echo '<p>ไม่พบข้อมูล Pre-Order ID ที่เลือก</p>';
                    }
                }
                ?>

                    <div class="mb-3">
                        <label for="Deliver_address" class="form-label">ที่อยู่ที่ส่งมอบ</label>
                        <input type="text" class="form-control" name="Deliver_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                        <input type="text" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
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
        height: 125vh;
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