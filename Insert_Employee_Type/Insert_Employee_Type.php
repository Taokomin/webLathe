<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
if (!$con) {
  mysqli_connect_errno();
}

$GLOBALS['maxIdLength'] = 3;
$GLOBALS['EmployeeType_id'] = '0';
$GLOBALS['Auto_number'] = '0';

// Get the latest EmployeeType_id from the database
$sql1 = "SELECT EmployeeType_id FROM employee_type ORDER BY EmployeeType_id DESC LIMIT 1";
$query1 = $con->query($sql1);
$result1 = $query1->fetch_assoc();
if ($result1['EmployeeType_id']) {
  $GLOBALS['EmployeeType_id'] = $result1['EmployeeType_id'];
}

// Get the latest Auto_number from the database
$sql2 = "SELECT Auto_number FROM employee_type ORDER BY Auto_number DESC LIMIT 1";
$query2 = $con->query($sql2);
$result2 = $query2->fetch_assoc();
if ($result2['Auto_number']) {
  $GLOBALS['Auto_number'] = $result2['Auto_number'];
}

// Function to increase EmployeeType_id
function increaseIdEt($EmployeeType_id)
{
  $matchId = preg_replace('/[^0-9]/', '', $EmployeeType_id);
  $convertStringToInt = (int)$matchId;

  $concatIdWithString = (string)($convertStringToInt + 1);

  $round = 0;
  while ($round < $GLOBALS['maxIdLength'] - strlen($concatIdWithString)) {
    $concatIdWithString = '0' . $concatIdWithString;
    $round += 1;
  }

  return 'ET' . $concatIdWithString;
}

// Function to increase Auto_number
function increaseNumEt($Auto_number)
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
  <title>เพิ่มข้อมูลประเภทพนักงาน</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
  <div class="container">
    <h1 class="mt-5">เพิ่มข้อมูลประเภทพนักงาน</h1>
    <hr>
    <form action="ProcEti.php" method="post">
      <div class="mb-3">
        <!-- <label for="Auto_number" class="form-label">ลำดับ</label> -->
        <input type="hidden" class="form-control" name="Auto_number" value="<?php echo (increaseNumEt($GLOBALS['Auto_number'])); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="EmployeeType_id" class="form-label">รหัสประเภทพนักงาน</label>
        <input type="text" class="form-control" name="EmployeeType_id" value="<?php echo (increaseIdEt($GLOBALS['EmployeeType_id'])); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="EmployeeType_name" class="form-label">ชื่อประเภทพนักงาน</label>
        <input type="text" class="form-control" name="EmployeeType_name" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success ">เพิ่มข้อมูล </button>
        <a type="button" class="btn btn-danger " href="..\Employee_Type.php">ยกเลิก</a>
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