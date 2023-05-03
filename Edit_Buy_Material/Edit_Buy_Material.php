<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$BuyMaterial_id = $_GET["BuyMaterial_id"];
$sql = "SELECT * FROM buy_material WHERE BuyMaterial_id='$BuyMaterial_id'";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
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
        <title>แก้ไขข้อมูลสั่งซื้อวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">แก้ไขข้อมูลสั่งซื้อวัสดุและอุปกรณ์</h1>
            <hr>
            <form action="ProcBme.php" method="POST">
                <div class="mb-3">
                    <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                    <input type="hidden" class="form-control" name="Auto_number" value="<?php echo $values["Auto_number"]; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="BuyMaterial_id" class="form-label">รหัสสั่งซื้อวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="BuyMaterial_id" value="<?php echo $values["BuyMaterial_id"]; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="BuyMaterial_day" class="form-label">วั่นที่สั่งซื้อ</label>
                    <input type="date" class="form-control" name="BuyMaterial_day" id="BuyMaterial_day" value="<?php echo $values["BuyMaterial_day"]; ?>" required>
                    <script type='text/javascript'>
                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020', '1-7-2023', '15-7-2023'];
                        $(document).ready(function() {
                            $('#BuyMaterial_day').BuyMaterial_day({
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
                $sql = $con;
                $query = "SELECT * FROM material ORDER BY Material_id asc";
                $result = mysqli_query($sql, $query);
                $default_Material_id = "";
                if (isset($values['Material_id'])) {
                    $default_Material_id = $values['Material_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="Material_id" class="form-label">เลือกวัสดุและอุปกรณ์</label>
                    <select class="form-select" aria-label="Default select example" name="Material_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result as $results) { ?>
                            <?php $selected = ($results["Material_id"] == $default_Material_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Material_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Material_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="BuyMaterial_quantity" class="form-label">จำนวน</label>
                    <input type="text" class="form-control" name="BuyMaterial_quantity" value="<?php echo $values["BuyMaterial_quantity"]; ?>" required onkeypress="return isNumberKey(event)">
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
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                $sql1 = $con;
                $query1 = "SELECT * FROM unit ORDER BY Unit_id asc";
                $result1 = mysqli_query($sql1, $query1);
                $default_Unit_id = "";
                if (isset($values['Unit_id'])) {
                    $default_Unit_id = $values['Unit_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="Unit_id" class="form-label">เลือกหน่วยนับ </label>
                    <select class="form-select" aria-label="Default select example" name="Unit_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result1 as $results) { ?>
                            <?php $selected = ($results["Unit_id"] == $default_Unit_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Unit_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Unit_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <?php
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                $sql2 = $con;
                $query2 = "SELECT * FROM material_type ORDER BY MaterialType_id asc";
                $result2 = mysqli_query($sql2, $query2);
                $default_MaterialType_id = "";
                if (isset($values['MaterialType_id'])) {
                    $default_MaterialType_id = $values['MaterialType_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="MaterialType_id" class="form-label">เลือกประเภทวัสดุและอุปกรณ์</label>
                    <select class="form-select" aria-label="Default select example" name="MaterialType_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result2 as $results) { ?>
                            <?php $selected = ($results["MaterialType_id"] == $default_MaterialType_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["MaterialType_id"]; ?>"<?php echo $selected; ?>>
                                <?php echo $results["MaterialType_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" name="Employee_id" value="<?php echo $values["Employee_id"]; ?>" readonly>
                </div>
                <?php
                require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                $sql3 = $con;
                $query3 = "SELECT * FROM partner ORDER BY Partner_id asc";
                $result3 = mysqli_query($sql3, $query3);
                $default_Partner_id = "";
                if (isset($values['Partner_id'])) {
                    $default_Partner_id = $values['Partner_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="Partner_id" class="form-label">เลือกชื่อคู่ค้า</label>
                    <select class="form-select" aria-label="Default select example" name="Partner_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result3 as $results) { ?>
                            <?php $selected = ($results["Partner_id"] == $default_Partner_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Partner_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Partner_name"]. " " . $results["Partner_surname"];?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="BuyMaterial_status" class="form-label">สถานะ</label>
                    <input type="text" class="form-control" name="BuyMaterial_status" value="<?php echo $values["BuyMaterial_status"]; ?>" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">แก้ไขข้อมูล </button>
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