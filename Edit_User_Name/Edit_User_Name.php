<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$ID = $_GET["ID"];
$sql = "SELECT * FROM user WHERE ID='$ID'";
$result = mysqli_query($con, $sql);
$values = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายชื่อผู้เข้าใช้งาน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">แก้ไขข้อมูลรายชื่อผู้เข้าใช้งาน</h1>
        <hr>
        <form action="PeocUri.php" method="post">
            <div class="mb-3">
                <label for="Username" class="form-label">ชื่อล็อคอิน</label>
                <input type="text" class="form-control" name="Username" value="<?php echo $values["Username"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">รหัสผ่าน</label>
                <input type="text" class="form-control" name="Password" value="<?php echo $values["Password"]; ?>" required>
            </div>
            <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql3 = $con;
                $query3 = "SELECT * FROM employee ORDER BY Employee_id asc";
                $result3 = mysqli_query($sql3, $query3);
                $default_Employee_id = "";
                if (isset($values['Employee_id'])) {
                    $default_Employee_id = $values['Employee_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="Employee_id" class="form-label">ชื่อลูกค้า</label>
                    <select class="form-select" aria-label="Default select example" name="Employee_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result3 as $results) { ?>
                            <?php $selected = ($results["Employee_id"] == $default_Employee_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["Employee_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["Employee_name"] . " " . $results["Employee_surname"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

            <?php
                require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                $sql3 = $con;
                $query3 = "SELECT * FROM license ORDER BY License_id asc";
                $result3 = mysqli_query($sql3, $query3);
                $default_License_id = "";
                if (isset($values['License_id'])) {
                    $default_License_id = $values['License_id'];
                }
                ?>
                <div class="mb-3">
                    <label for="License_id" class="form-label">สิทธิการใช้งาน</label>
                    <select class="form-select" aria-label="Default select example" name="License_id" required>
                        <option value="">-กรุณาเลือก-</option>
                        <?php foreach ($result3 as $results) { ?>
                            <?php $selected = ($results["License_id"] == $default_License_id) ? "selected" : ""; ?>
                            <option value="<?php echo $results["License_id"]; ?>" <?php echo $selected; ?>>
                                <?php echo $results["License_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">แก้ไขข้อมูล</button>
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