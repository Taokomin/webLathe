<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Employee_id = $_GET["Employee_id"];
$sql = "SELECT * FROM employee WHERE Employee_id='$Employee_id'";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลพนักงาน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">แก้ไขข้อมูลพนักงาน</h1>
        <hr>
        <form action="ProcEme.php" method="post">
            <input type="hidden" value="<?php echo $values["Employee_id"]; ?>" name="Employee_id">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo $values['Auto_number']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Employee_id" class="form-label">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="Employee_id" value="<?php echo $values['Employee_id']; ?>" readonly>
            </div>
            <?php
            require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
            $sql1 = $con;
            $query1 = "SELECT * FROM prefix_name ORDER BY Prefix_id asc";
            $result1 = mysqli_query($sql1, $query1);
            $default_prefix_id = "";
            if (isset($values['Prefix_id'])) {
                $default_prefix_id = $values['Prefix_id'];
            }
            ?>
            <div class="mb-3">
                <label for="Prefix_id" class="form-label">เลือกคำนำหน้าชื่อ</label>
                <select class="form-select" aria-label="Default select example" name="Prefix_id" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result1 as $results) { ?>
                        <?php $selected = ($results["Prefix_id"] == $default_prefix_id) ? "selected" : ""; ?>
                        <option value="<?php echo $results["Prefix_id"]; ?>" <?php echo $selected; ?>>
                            <?php echo $results["Prefix_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Employee_name" class="form-label">ชื่อพนักงาน</label>
                <input type="text" class="form-control" name="Employee_name" value="<?php echo $values['Employee_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Employee_surname" class="form-label">นามสกุลพนักงาน</label>
                <input type="text" class="form-control" name="Employee_surname" value="<?php echo $values['Employee_surname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Employee_number" class="form-label">เบอร์โทรพนักงาน</label>
                <input type="tel" class="form-control" name="Employee_number" value="<?php echo $values['Employee_number']; ?>" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
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
            <div class="mb-3">
                <label for="Employee_address" class="form-label">ที่อยู่พนักงาน</label>
                <input type="text" class="form-control" name="Employee_address" value="<?php echo $values['Employee_address']; ?>" required>
            </div>
            <div class="mb-3">
                <!-- <label for="Employee_license" class="form-label">สิทธิการใช้งาน</label> -->
                <input type="hidden" class="form-control" name="Employee_license" value="LC01" required>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">แก้ไขข้อมูล </button>
                <a type="button" class="btn btn-danger " href="..\Employee.php">ยกเลิก</a>
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