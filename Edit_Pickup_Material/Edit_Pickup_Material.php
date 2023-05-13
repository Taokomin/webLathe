<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$PickupMaterial_id = $_GET["PickupMaterial_id"];
$sql = "SELECT pm.*,pmd.PickupMaterial_quantity, e.Employee_name, e.Employee_surname, 
m.Material_name, s.status_name,
u.Unit_id AS Counting_unit_id, u.Unit_name AS Counting_unit_name
FROM pickup_material AS pm
INNER JOIN pickup_material_detail AS pmd ON pm.PickupMaterial_id = pmd.PickupMaterial_id
INNER JOIN material AS m ON pmd.PickupMaterial_detail = m.Material_id
INNER JOIN unit AS u ON pmd.Counting_unit = u.Unit_id
INNER JOIN employee AS e ON pm.Employee_id = e.Employee_id
INNER JOIN status AS s ON pm.PickupMaterial_status = s.status_id
WHERE pm.PickupMaterial_id='$PickupMaterial_id'
ORDER BY PickupMaterial_id ASC";
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
        <title>แก้ไขข้อมูลเบิกวัสดุและอุปกรณ์</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">แก้ไขข้อมูลเบิกวัสดุและอุปกรณ์</h1>
            <hr>
            <form action="ProcPme.php" method="post">
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_day" class="form-label">วันที่สั่ง</label>
                    <input type="date" class="form-control" name="PickupMaterial_day" id="PickupMaterial_day" value="<?php echo $values['PickupMaterial_day']; ?>" required>
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

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_detail" class="form-label">รหัสสั่งซื้อวัสดุและอุปกรณ์</label>
                    <input type="text" class="form-control" name="PickupMaterial_detail" value="<?php echo $values['Material_name']; ?>" readonly>
                </div>

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_quantity" class="form-label">จำนวนการเบิก</label>
                    <input type="tel" class="form-control" name="PickupMaterial_quantity" value="<?php echo $values['PickupMaterial_quantity']; ?>" readonly pattern="[0-9]+" onkeypress="return isNumberKey(event)">
                </div>

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Counting_unit" class="form-label">หน่วยนับ</label>
                    <input type="text" class="form-control" name="Counting_unit" value="<?php echo $values['Counting_unit_name']; ?>" readonly>
                </div>

                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="Employee_id" class="form-label">ชื่อพนักงาน</label>
                    <input type="text" class="form-control" name="Employee_id" value="<?php echo $values['Employee_name']. " " .$values['Employee_surname']; ?>" readonly>
                </div>
                <div class="mb-3" style="display: inline-block;width : 166px;">
                    <label for="PickupMaterial_status" class="form-label">สถานะ</label>
                    <input type="email" class="form-control" name="PickupMaterial_status" value="<?php echo $values['status_name']; ?>" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">แก้ไขข้อมูล </button>
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