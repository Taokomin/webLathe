<?php session_start(); ?>
<?php

if (!$_SESSION["UserID"]) {

    Header("Location: index.php");
} else { ?>
    <!DOCTYPE html>
    <html lang="th9o08ikj #']">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>การจัดการรายชื่อผู้เข้าใช้งาน</title>
        <link rel="stylesheet" href="css\mystyle.css">
        <link rel="icon" href="picture\Title-logo.png" type="image/icon type">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="width:100%">
            <div class="">
                <img src="picture\Qde-logo2.png" width="45" height="34" class="navbar-brand">
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li>
                        <a>บริษัท คิว.ดี.อี. พรีซิชั่น พาร์ท จำกัด (Q.D.E Precision Part Co.ltd.)</a>
                    </li>
            </div>
            <div>
                <a style="color:white; display: flex; width: 200px;">
                    <iconify-icon icon="gg:profile" width="32" height="32"></iconify-icon><?php 
                    require('Function\getEmployeeName.php');
                    echo getEmployeeName($_SESSION['User']); ?>
                </a>
            </div>
            <div>
                <a type="button" class="btn btn-danger btn-sm" href="logout.php" style="color:white; display: flex; width: 100px; height: 40px">ออกจากระบบ</a>
            </div>
        </nav>
        <div>
            <br>
            <h2 class="text-center">ระบบการจัดการโรงกลึง</h2>
            <h1 class="text-center">Lathe Management</h1>
            <br>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light" style="width:100%">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container-fluid" id="navbarNavDarkDropdown">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                เลือกรายการที่ต้องการ
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="manager.php">หน้าแรก</a></li>
                                <li><a class="dropdown-item" href="User.php">การจัดการรายชื่อผู้เข้าใช้งาน</a></li>
                                <li><a class="dropdown-item" href="Decide_Buy_Material.php">อนุมัติการสั่งซื้อวัสดุและอุปกรณ์</a></li>
                                <li><a class="dropdown-item" href="Decide_Pickup_Material.php">อนุมัติการเบิกวัสดุและอุปกรณ์</a></li>
                                <li><a class="dropdown-item" href="Report_mng.php">การออกรายงาน</a></li>
                            </ul>
                        </li>
                </div>
        </nav>

        <div class="container">
            <br>
            <h3 class="text-center">การจัดการรายชื่อผู้เข้าใช้งาน</h3>
            <br>
            <div class="btn-add">
                <a type="button" class="btn btn-success" href="Insert_User_Name\Insert_User_Name.php">
                    <iconify-icon icon="carbon:document-add" style="color: white;" width="42" height="42"></iconify-icon>
                </a>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <table id="manager_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อล็อคอิน</th>
                        <th>รหัสผ่าน</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>สิทธิการใช้งาน</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                    $query = "SELECT * FROM user ORDER BY ID asc" or die("Error:");
                    $query = "
                        SELECT u.*,e.Employee_name,e.Employee_surname,l.License_name
                        FROM user as u 
                        INNER JOIN  employee as e ON u.Employee_id = e.Employee_id
                        INNER JOIN  license as l ON u.License_id = l.License_id
                        ORDER BY e.Employee_id,l.License_id asc";
                    $result = mysqli_query($con, $query);
                    while ($values = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $values["ID"]; ?></td>
                            <td><?php echo $values["Username"]; ?></td>
                            <td><?php echo md5($values["Password"]); ?></td>
                            <td><?php echo $values["Employee_name"].$values["Employee_surname"]; ?></td>
                            <td><?php echo $values["License_name"]; ?></td>
                            <td>
                                <a href="Edit_User_Name/Edit_User_Name.php?ID=<?php echo $values["ID"]; ?>" class="btn btn-primary">
                                    <iconify-icon icon="el:file-edit"></iconify-icon>
                                </a>
                                <a onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบรายการนี้?')" href="Delete_User_Name/Delete_User_Name.php?ID=<?php echo $values["ID"]; ?>" class='btn btn-danger'>
                                    <iconify-icon icon="ant-design:delete-outlined"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="path/to/th_TH.json"></script>

        <script>
            $(document).ready(function() {
                $('#manager_table').DataTable({
                    "oLanguage": {
                        "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                        "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                        "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                        "sSearch": "ค้นหา :",
                        "aaSorting": [
                            [0, 'desc']
                        ],
                        "oPaginate": {
                            "sFirst": "หน้าแรก",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "หน้าสุดท้าย"
                        },
                    }
                });
            });
        </script>
    </body>

    </html>
<?php } ?>