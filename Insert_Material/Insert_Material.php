<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Material_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest Material_id from the database
$sql1 = "SELECT Material_id FROM material ORDER BY Material_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1['Material_id']) {
    $GLOBALS['Material_id'] = $result1['Material_id'];
}

// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM material ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2['Auto_number']) {
    $GLOBALS['Auto_number'] = $result2['Auto_number'];
}

// Function to increase Material_id
function increaseIdMr($Material_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Material_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'MR' . $concatIdWithString;
}

// Function to increase Auto_number
function increaseNumMr($Auto_number)
{
    $matchId = preg_replace('/[^0-9]/', '', $Auto_number);
    $Int = (int)$matchId;
    $newId = $Int + 1;
    return $newId;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลวัสดุและอุปกรณ์</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มข้อมูลวัสดุและอุปกรณ์</h1>
        <hr>
        <form action="ProcMri.php" method="post">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumMr($GLOBALS['Auto_number'])); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Material_id" class="form-label">รหัสวัสดุและอุปกรณ์</label>
                <input type="text" class="form-control" name="Material_id" value="<?php echo (increaseIdMr($GLOBALS['Material_id'])); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="Material_name" class="form-label">ชื่อวัสดุและอุปกรณ์</label>
                <input type="text" class="form-control" name="Material_name" required>
            </div>
            <div class="mb-3">
                <label for="Material_quantity" class="form-label">จำนวน</label>
                <input type="text" class="form-control" name="Material_quantity" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
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
            ?>
            <div class="mb-3">
                <label for="Counting_unit" class="form-label">เลือกหน่วยนับ</label>
                <select class="form-select" aria-label="Default select example" name="Counting_unit" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result1 as $results) { ?>
                        <option value="<?php echo $results["Unit_id"]; ?>">
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
            ?>
            <div class="mb-3">
                <label for="MaterialType_id" class="form-label">เลือกประเภทวัสดุและอุปกรณ์</label>
                <select class="form-select" aria-label="Default select example" name="MaterialType_id" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result2 as $results) { ?>
                        <option value="<?php echo $results["MaterialType_id"]; ?>">
                            <?php echo $results["MaterialType_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Material_price" class="form-label">ราคา</label>
                <input type="text" class="form-control" name="Material_price" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
            </div>
            <?php
            require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
            $sql3 = $con;
            $query3 = "SELECT * FROM unit ORDER BY Unit_id asc";
            $result3 = mysqli_query($sql3, $query3);
            ?>
            <div class="mb-3">
                <label for="Price_unit" class="form-label">เลือกหน่วยนับ</label>
                <select class="form-select" aria-label="Default select example" name="Price_unit" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result3 as $results) { ?>
                        <option value="<?php echo $results["Unit_id"]; ?>">
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