<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$AcceptMaterial_id = $_GET["AcceptMaterial_id"];
$sql = "SELECT * FROM accept_material WHERE AcceptMaterial_id='$AcceptMaterial_id'";
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
        <title>แก้ไขข้อมูลรับเข้าวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">แก้ไขข้อมูลรับเข้าวัสดุและอุปกรณ์</h1>
            <hr>
            <form action="ProcAme.php" method="post">
                <div class="mb-3">
                    <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                    <input type="hidden" class="form-control" name="Auto_number" value="<?php echo $values["Auto_number"]; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="AcceptMaterial_id" class="form-label">รหัสรับเข้าวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="AcceptMaterial_id" value="<?php echo $values["AcceptMaterial_id"]; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="AcceptMaterial_day" class="form-label">วันที่รับเข้า</label>
                    <input type="date" class="form-control" name="AcceptMaterial_day" id="AcceptMaterial_day" value="<?php echo $values["AcceptMaterial_day"]; ?>" required>
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
                <div class="mb-3">
                    <label for="BuyMaterial_id" class="form-label">รหัสสั่งซื้อวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="BuyMaterial_id" value="<?php echo $values["BuyMaterial_id"]; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="BuyMaterial_day" class="form-label">วันที่สั่งซื้อ</label>
                    <input type="text" class="form-control" name="BuyMaterial_day" value="<?php echo $values["BuyMaterial_day"]; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="Material_id" class="form-label">รหัสวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="Material_id" value="<?php echo $values["Material_id"]; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="BuyMaterial_quantity" class="form-label">จำนวน</label>
                    <input type="text" class="form-control" name="BuyMaterial_quantity" value="<?php echo $values["BuyMaterial_quantity"]; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="Unit_id" class="form-label">หน่วยนับ</label>
                    <input type="text" class="form-control" name="Unit_id" value="<?php echo $values["Unit_id"]; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="MaterialType_id" class="form-label">ประเภทวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="MaterialType_id" value="<?php echo $values["MaterialType_id"]; ?>" readonly>
                        </div>

                        <div class="mb-3">
                        <label for="Partner_id" class="form-label">ชื่อคู่ค้า</label>
                        <input type="text" class="form-control" name="Partner_id" value="<?php echo $values["Partner_id"]; ?>" readonly>
                        </div>
                <div class="mb-3">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" name="Employee_id" value="<?php echo ($_SESSION['User']); ?> <?php ?>" readonly>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="submitData()">แก้ไขข้อมูล </button>
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