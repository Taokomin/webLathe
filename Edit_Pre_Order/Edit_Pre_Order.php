<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$PreOrder_detail_id = $_GET['PreOrder_detail_id'];
$query1 = "SELECT pod.*, po.PreOrder_day 
           FROM pre_order_detail AS pod
           INNER JOIN pre_order AS po ON pod.PreOrder_id = po.PreOrder_id
           WHERE pod.PreOrder_detail_id = '$PreOrder_detail_id'";

$result1 = mysqli_query($con, $query1);
$PreOrder_detail = mysqli_fetch_assoc($result1);

$query2 = "SELECT * FROM unit";
$result2 = mysqli_query($con, $query2);
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
            <form method="POST">
                <div>
                    <label for="PreOrder_detail">รายการสินค้า</label>
                    <input type="text" class="form-control" id="PreOrder_detail" name="PreOrder_detail" value="<?php echo $PreOrder_detail['PreOrder_day']; ?>" required>
                </div>
                <div>
                    <label for="PreOrder_detail">รายการสินค้า</label>
                    <input type="text" class="form-control" id="PreOrder_detail" name="PreOrder_detail" value="<?php echo $PreOrder_detail['PreOrder_detail']; ?>" required>
                </div>
                <div>
                    <label for="PreOrder_quantity">จำนวนสินค้า</label>
                    <input type="number" class="form-control" id="PreOrder_quantity" name="PreOrder_quantity" value="<?php echo $PreOrder_detail['PreOrder_quantity']; ?>" required>
                </div>
                <div>
                    <label for="Counting_unit">หน่วยนับ</label>
                    <select class="form-control" id="Counting_unit" name="Counting_unit" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                            <?php $selected = ($row2["Unit_id"] == $PreOrder_detail["Counting_unit"]) ? "selected" : ""; ?>
                            <option value="<?php echo $row2["Unit_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $row2["Unit_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="PreOrder_price">ราคา</label>
                    <input type="number" class="form-control" id="PreOrder_price" name="PreOrder_price" value="<?php echo $PreOrder_detail['PreOrder_price']; ?>" required>
                </div>
                <div>
                    <label for="Price_unit">หน่วยนับ</label>
                    <select class="form-control" id="Price_unit" name="Price_unit" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php mysqli_data_seek($result2, 0); // Reset result set pointer 
                        ?>
                        <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                            <?php $selected = ($row2["Unit_id"] == $PreOrder_detail["Price_unit"]) ? "selected" : ""; ?>
                            <option value="<?php echo $row2["Unit_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $row2["Unit_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input type="hidden" name="PreOrder_id" value="<?php echo $values["PreOrder_id"]; ?>">
                <input type="hidden" name="PreOrder_detail_id" value="<?php echo $values["PreOrder_detail_id"]; ?>">

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
            max-width: 600px;
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