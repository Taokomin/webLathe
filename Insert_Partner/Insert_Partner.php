<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Partner_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest Partner_id from the database
$sql1 = "SELECT Partner_id FROM partner ORDER BY Partner_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1['Partner_id']) {
    $GLOBALS['Partner_id'] = $result1['Partner_id'];
}

// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM partner ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2['Auto_number']) {
    $GLOBALS['Auto_number'] = $result2['Auto_number'];
}

// Function to increase Partner_id
function increaseIdPr($Partner_id)
{
    $matchId = preg_replace('/[^0-9]/', '', $Partner_id);
    $convertStringToInt = (int)$matchId;

    $concatIdWithString = (string)($convertStringToInt + 1);

    $round = 0;
    while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
        $concatIdWithString = '0' . $concatIdWithString;
        $round += 1;
    }

    return 'PR' . $concatIdWithString;
}

// Function to increase Auto_number
function increaseNumPr($Auto_number)
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
    <title>เพิ่มข้อมูลคู่ค้า</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มข้อมูลคู่ค้า</h1>
        <hr>
        <form action="ProcPni.php" method="post">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumPr($GLOBALS['Auto_number'])); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Partner_id" class="form-label">รหัสคู่ค้า</label>
                <input type="text" class="form-control" name="Partner_id" value="<?php echo (increaseIdPr($GLOBALS['Partner_id'])); ?>" readonly>
            </div>
            
            <?php
            require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
            $sql1 = $con;
            $query1 = "SELECT * FROM prefix_name ORDER BY Prefix_id asc";
            $result1 = mysqli_query($sql1, $query1);
            ?>
            <div class="mb-3">
                <label for="Prefix_id" class="form-label">เลือกคำนำหน้าชื่อ</label>
                <select class="form-select" aria-label="Default select example" name="Prefix_id" required>
                    <option value="">-กรุณาเลือก-</option>
                    <?php foreach ($result1 as $results) { ?>
                        <option value="<?php echo $results["Prefix_id"]; ?>">
                            <?php echo $results["Prefix_name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Partner_name" class="form-label">ชื่อผู้ติดต่อ</label>
                <input type="text" class="form-control" name="Partner_name" required>
            </div>
            <div class="mb-3">
                <label for="Partner_surname" class="form-label">นามสกุลผู้ติดต่อ</label>
                <input type="text" class="form-control" name="Partner_surname" required>
            </div>
            <div class="mb-3">
                <label for="Partner_number" class="form-label">เบอร์โทรผู้ติดต่อ</label>
                <input type="tel" class="form-control" name="Partner_number" required pattern="[0-9]+" onkeypress="return isNumberKey(event)">
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
                <label for="Partner_company" class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="Partner_email" required>
            </div>
            <div class="mb-3">
                <label for="Partner_company" class="form-label">บริษัทคู่ค้า</label>
                <input type="text" class="form-control" name="Partner_company" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">เพิ่มข้อมูล </button>
                <a type="button" class="btn btn-danger " href="..\Partner.php">ยกเลิก</a>
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