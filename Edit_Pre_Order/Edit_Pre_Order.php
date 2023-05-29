<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$PreOrder_id = $_GET['PreOrder_id'];
$sql = "SELECT po.*,pod.PreOrder_detail_id,pod.PreOrder_detail, pod.PreOrder_quantity, u.Unit_id AS Counting_unit_id, u3.Unit_name AS Counting_unit_name,
pod.PreOrder_price, u2.Unit_id AS Price_unit_id, u4.Unit_name AS Price_unit_name,
pod.PreOrder_quantity, c.Customer_name, c.Customer_surname, e.Employee_name, e.Employee_surname
FROM pre_order AS po
INNER JOIN pre_order_detail AS pod ON po.PreOrder_id = pod.PreOrder_id
INNER JOIN unit AS u ON pod.Counting_unit = u.Unit_id
INNER JOIN unit AS u2 ON pod.Price_unit = u2.Unit_id
INNER JOIN unit AS u3 ON pod.Counting_unit = u3.Unit_id
INNER JOIN unit AS u4 ON pod.Price_unit = u4.Unit_id
INNER JOIN customer AS c ON po.Customer_id = c.Customer_id
INNER JOIN employee AS e ON po.Employee_id = e.Employee_id
WHERE po.PreOrder_id = '$PreOrder_id'
ORDER BY po.PreOrder_id,pod.PreOrder_detail_id ASC;";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
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
        <title>แก้ไขข้อมูลสั่งสินค้าจากลูกค้า</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">แก้ไขข้อมูลสั่งสินค้าจากลูกค้า</h1>
            <hr>
            <form action="ProcPoe.php" method="POST">
                <input type="hidden" class="form-control" name="PreOrder_id" value="<?php echo $values["PreOrder_id"]; ?>" readonly>
                <div class="mb-3" style="width : 166px;">
                    <label for="PreOrder_day" class="form-label">วันที่สั่งซื้อ</label>
                    <input type="date" class="form-control" name="PreOrder_day" id="PreOrder_day" value="<?php echo $values["PreOrder_day"]; ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#PreOrder_day').PreOrder_day({
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
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Employee_id" class="form-label">ชื่อสินค้า</label>
                    <input type="text" class="form-control" name="Employee_id" value="<?php echo $values["PreOrder_detail"]; ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PreOrder_quantity" class="form-label">จำนวน</label>
                    <input type="text" class="form-control" name="PreOrder_quantity" value="<?php echo $values["PreOrder_quantity"]; ?>" required onkeypress="return isNumberKey(event)">
                </div>
                <script>
                    function isNumberKey(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode;
                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                            return false;
                        }
                        return true;
                    }
                </script>
                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

                $sql1 = $con;
                $query1 = "SELECT * FROM unit ORDER BY Unit_id asc";
                $result1 = mysqli_query($sql1, $query1);

                $default_Counting_unit_id = "";
                if (isset($values['Counting_unit_id'])) {
                    $default_Counting_unit_id = $values['Counting_unit_id'];
                }
                ?>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Counting_unit" class="form-label">เลือกหน่วยนับ</label>
                    <select class="form-select" aria-label="Default select example" name="Counting_unit" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <?php $selected = ($results["Unit_id"] == $default_Counting_unit_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Unit_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Unit_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PreOrder_price" class="form-label">ราคา</label>
                    <input type="text" class="form-control" name="PreOrder_price" value="<?php echo $values["PreOrder_price"]; ?>" readonly>
                </div>
                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql2 = $con;
                $query2 = "SELECT * FROM unit ORDER BY Unit_id asc";
                $result2 = mysqli_query($sql2, $query2);
                $default_Price_unit_id = "";
                if (isset($values['Price_unit_id'])) {
                    $default_Price_unit_id = $values['Price_unit_id'];
                }
                ?>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Price_unit" class="form-label">เลือกหน่วยนับ</label>
                    <select class="form-select" aria-label="Default select example" name="Price_unit" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result2 as $results) { ?>
                            <?php $selected = ($results["Unit_id"] == $default_Price_unit_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Unit_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Unit_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>


                <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql3 = $con;
                $query3 = "SELECT * FROM customer ORDER BY Customer_id asc";
                $result3 = mysqli_query($sql3, $query3);
                $default_Customer_id = "";
                if (isset($values['Customer_id'])) {
                    $default_Customer_id = $values['Customer_id'];
                }
                ?>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Customer_id" class="form-label">ชื่อลูกค้า</label>
                    <select class="form-select" aria-label="Default select example" name="Customer_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result3 as $results) { ?>
                            <?php $selected = ($results["Customer_id"] == $default_Customer_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Customer_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Customer_name"] . " " . $results["Customer_surname"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PreOrder_detail" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" name="PreOrder_detail" value="<?php echo $values["Employee_name"] . " " . $values["Employee_surname"]; ?>" readonly>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ">แก้ไขข้อมูล </button>
                    <a type="button" class="btn btn-danger " href="..\Pre_Order.php">ยกเลิก</a>
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
            max-width: 920px;
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