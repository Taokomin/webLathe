<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
    mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['Prefix_id'] = '0';
$GLOBALS['ID'] = '0';


// Get the latest id from the database
$sql2 = "SELECT ID FROM user ORDER BY ID DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2['ID']) {
    $GLOBALS['ID'] = $result2['ID'];
}

// Function to increase Prefix_id

// Function to increase ID
function increaseNumPn($ID)
{
    $matchId = preg_replace('/[^0-9]/', '', $ID);
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
    <title>เพิ่มข้อมูลรายชื่อผู้เข้าใช้งาน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มข้อมูลรายชื่อผู้เข้าใช้งาน</h1>
        <hr>
        <form action="ProcUri.php" method="post">
            <div class="mb-3">
                <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
                <input type="hidden" class="form-control" name="ID" value="<?php echo (increaseNumPn($GLOBALS['ID'])); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Username" class="form-label">ชื่อล็อคอิน</label>
                <input type="text" class="form-control" name="Username" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">รหัสผ่าน</label>
                <input type="text" class="form-control" name="Password" required>
            </div>
            <div class="mb-3">
                <label for="Firstname" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="Firstname" required>
            </div>
            <div class="mb-3">
                <label for="Lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="Lastname" required>
            </div>
            <div class="mb-3">
                <label for="Userlevel" class="form-label">สิทธิการใช้งาน</label>
                <select class="form-select" aria-label="Default select example" name="Userlevel" required>
                    <option value="">-กรุณาเลือกสิทธิการใช้งาน-</option>
                    <option value="P">บุคลากร(P)</option>
                    <option value="M">ผู้จัดการ(M)</option>
                    <option value="E">ผู้บริหาร(E)</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">เพิ่มข้อมูล </button>
                <a type="button" class="btn btn-danger " href="..\User.php">ยกเลิก</a>
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