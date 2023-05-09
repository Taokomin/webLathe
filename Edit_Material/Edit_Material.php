<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Material_id = $_GET["Material_id"];
$sql = "SELECT * FROM material WHERE Material_id='$Material_id'";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลวัสดุและอุปกรณ์</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">แก้ไขข้อมูลวัสดุและอุปกรณ์</h1>
        <hr>
        <form action="ProcMre.php" method="post">
            <input type="hidden" value="<?php echo $values["Material_id"]; ?>" name="Material_id">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo $values["Auto_number"]; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Material_id" class="form-label">รหัสวัสดุและอุปกรณ์</label>
                <input type="text" class="form-control" name="Material_id" value="<?php echo $values["Material_id"]; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="Material_name" class="form-label">ชื่อวัสดุและอุปกรณ์</label>
                <input type="text" class="form-control" name="Material_name" value="<?php echo $values["Material_name"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Material_quantity" class="form-label">จำนวน</label>
                <input type="text" class="form-control" name="Material_quantity" value="<?php echo $values["Material_quantity"]; ?>" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
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
            $default_Counting_unit = "";
            if (isset($values['Counting_unit'])) {
                $default_Counting_unit = $values['Counting_unit'];
            }
            ?>
            <div class="mb-3">
                <label for="Counting_unit" class="form-label">เลือกหน่วยนับ</label>
                <select class="form-select" aria-label="Default select example" name="Counting_unit" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result1 as $results) { ?>
                        <?php $selected = ($results["Unit_id"] == $default_Counting_unit) ? "selected" : ""; ?>
                        <option value="<?php echo $results["Unit_id"]; ?>" <?php echo $selected; ?>>
                            <?php echo $results["Unit_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <?php
            require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
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
                        <option value="<?php echo $results["MaterialType_id"]; ?>" <?php echo $selected; ?>>
                            <?php echo $results["MaterialType_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php
            require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
            $sql3 = $con;
            $query3 = "SELECT * FROM unit ORDER BY Unit_id asc";
            $result3 = mysqli_query($sql3, $query3);
            $default_Price_unit = "";
            if (isset($values['Price_unit'])) {
                $default_Price_unit = $values['Price_unit'];
            }
            ?>
            <div class="mb-3">
                <label for="Material_price" class="form-label">ราคา</label>
                <input type="text" class="form-control" name="Material_price" value="<?php echo $values["Material_price"]; ?>" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-3">
                <label for="Price_unit" class="form-label">เลือกหน่วยนับ</label>
                <select class="form-select" aria-label="Default select example" name="Price_unit" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result3 as $results) { ?>
                        <?php $selected = ($results["Unit_id"] == $default_Price_unit) ? "selected" : ""; ?>
                        <option value="<?php echo $results["Unit_id"]; ?>" <?php echo $selected; ?>>
                            <?php echo $results["Unit_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">เพิ่มข้อมูล </button>
                <a type="button" class="btn btn-danger " href="..\Material.php">ยกเลิก</a>
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