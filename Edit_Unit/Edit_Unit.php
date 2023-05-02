<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$Unit_id = $_GET["Unit_id"];
$sql = "SELECT * FROM Unit WHERE Unit_id='$Unit_id'";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    <link rel="stylesheet" href="insert.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>แก้ไขข้อมูลหน่วยนับ</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">แก้ไขข้อมูลหน่วยนับ</h1>
        <hr>
        <form action="ProcUNe.php" method="post">
            <input type="hidden" value="<?php echo $values["Unit_id"]; ?>" name="Unit_id">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo $values['Auto_number']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Unit_id" class="form-label">รหัสหน่วยนับ</label>
                <input type="text" class="form-control" name="Unit_id" value="<?php echo $values['Unit_id']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Unit_name" class="form-label">ชื่อหน่วยนับ</label>
                <input type="text" class="form-control" name="Unit_name" value="<?php echo $values['Unit_name']; ?>" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success ml-1">แก้ไขข้อมูล </button>
                <a type="button" class="btn btn-danger  ml-1" href="..\Unit.php">ยกเลิก</a>
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