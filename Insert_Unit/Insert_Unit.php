<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Unit_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest Unit_id from the database
$sql1 = "SELECT Unit_id FROM unit ORDER BY Unit_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1['Unit_id']) {
    $GLOBALS['Unit_id'] = $result1['Unit_id'];
}

// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM unit ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2['Auto_number']) {
    $GLOBALS['Auto_number'] = $result2['Auto_number'];
}

// Function to increase Unit_id
function increaseIdUn($Unit_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Unit_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'UN' . $concatIdWithString;
}

// Function to increase Auto_number
function increaseNumUn($Auto_number)
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
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>เพิ่มข้อมูลหน่วยนับ</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มข้อมูลหน่วยนับ</h1>
        <hr>
        <form action="ProcUNi.php" method="post">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumUn($GLOBALS['Auto_number'])); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Unit_id" class="form-label">รหัสหน่วยนับ</label>
                <input type="text" class="form-control" name="Unit_id" value="<?php echo (increaseIdUn($GLOBALS['Unit_id'])); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Unit_name" class="form-label">หน่วยนับ</label>
                <input type="text" class="form-control" name="Unit_name" required>
            </div>
            <div class="modal-footer">
                <button type="submit" name="save" class="btn btn-success">เพิ่มข้อมูล </button>
                <a type="button" class="btn btn-danger" href="..\Unit.php">ยกเลิก</a>
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