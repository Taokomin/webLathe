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
        <title>การจัดการอนุมัติการสั่งซื้อวัสดุและอุปกรณ์</title>
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
                    <iconify-icon icon="gg:profile" width="32" height="32"></iconify-icon><?php echo ($_SESSION['User']); ?>
                    <?php ?>
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
            <h3 class="text-center">การจัดการอนุมัติการสั่งซื้อวัสดุและอุปกรณ์</h3>
            <br>
            <br>
            <br>
            <br>
            <hr>
            <table id="Buy_Material_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสสั่งซื้อวัสดุและอุปกรณ์</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>รหัสวัสดุและอุปกรณ์</th>
                        <th>จำนวน</th>
                        <th>รหัสหน่วยนับ</th>
                        <th>รหัสประเภทวัสดุและอุปกรณ์</th>
                        <th>รหัสพนักงาน</th>
                        <th>รหัสคู่ค้า</th>
                        <th>สถานะ</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

                    function approveMaterial($buyMaterialId)
                    {
                        global $con;
                        $buyMaterialId = intval($buyMaterialId);
                        $query = "UPDATE buy_material SET BuyMaterial_status = 'อนุมัติ' WHERE Auto_number = $buyMaterialId";
                        return mysqli_query($con, $query);
                    }



                    function disapproveMaterial($buyMaterialId)
                    {
                        global $con;
                        $buyMaterialId = intval($buyMaterialId);
                        $query = "UPDATE buy_material SET BuyMaterial_status = 'ไม่อนุมัติ' WHERE Auto_number = $buyMaterialId";
                        return mysqli_query($con, $query);
                    }

                    if (isset($_POST['buyMaterialId'])) {
                        $buyMaterialId = $_POST['buyMaterialId'];
                        if (isset($_POST['approve'])) {
                            $success = approveMaterial($_POST['buyMaterialId']);
                            if ($success) {
                                echo "<script>alert('อนุมัติสำเร็จ');</script>";
                            } else {
                                echo "<script>alert('เกิดข้อผิดพลาดขณะอนุมัติ');</script>";
                            }
                        } elseif (isset($_POST['disapprove'])) {
                            $success = disapproveMaterial($_POST['buyMaterialId']);
                            if ($success) {
                                echo "<script>alert('ไม่อนุมัติสำเร็จ');</script>";
                            } else {
                                echo "<script>alert('เกิดข้อผิดพลาดขณะไม่อนุมัติ');</script>";
                            }
                        }
                    }
                    ?>

                    <?php
                    require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
                    $query = "SELECT bm.*, m.Material_name, u.Unit_name, mt.MaterialType_name, pn.Partner_name, pn.Partner_surname
                    FROM buy_material AS bm
                    INNER JOIN material AS m ON bm.Material_id = m.Material_id
                    INNER JOIN unit AS u ON bm.Unit_id = u.Unit_id
                    INNER JOIN material_type AS mt ON bm.MaterialType_id = mt.MaterialType_id
                    INNER JOIN partner AS pn ON bm.Partner_id = pn.Partner_id
                    ORDER BY  m.Material_id, u.Unit_id, mt.MaterialType_id, pn.Partner_id ASC";
                    $result = mysqli_query($con, $query);
                    while ($values = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $values["Auto_number"]; ?></td>
                            <td><?php echo $values["BuyMaterial_id"]; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($values["BuyMaterial_day"] . " UTC")); ?></td>
                            <td><?php echo $values["Material_name"]; ?></td>
                            <td><?php echo $values["BuyMaterial_quantity"]; ?></td>
                            <td><?php echo $values["Unit_name"]; ?></td>
                            <td><?php echo $values["MaterialType_name"]; ?></td>
                            <td><?php echo $values["Employee_id"]; ?></td>
                            <td><?php echo $values["Partner_name"] . " " . $values["Partner_surname"]; ?></td>
                            <td><?php echo $values["BuyMaterial_status"]; ?></td>
                            <td>
                                <?php

                                if ($values["BuyMaterial_status"] == "รออนุมัติ") { ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="buyMaterialId" value="<?php echo $values["Auto_number"]; ?>">
                                        <button type="submit" name="approve" class="btn btn-success">อนุมัติ</button>
                                    </form>
                                    <form method="POST" action="">
                                        <input type="hidden" name="buyMaterialId" value="<?php echo $values["Auto_number"]; ?>">
                                        <button type="submit" name="disapprove" class="btn btn-warning">ไม่อนุมัติ</button>
                                    </form>
                                <?php
                                } else { ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="buyMaterialId" value="<?php echo $values["Auto_number"]; ?>">
                                        <button type="submit" name="disapprove" class="btn btn-warning">ไม่อนุมัติ</button>
                                    </form>
                                <?php } ?>
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
                $('#Buy_Material_table').DataTable({
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
    <style>
        #Buy_Material_table {
            font-size: 12px;
            table-layout: fixed
        }

        td {
            word-wrap: break-word;
        }

        button {
            font-size: 16px;
            /* Change the font size to 16 pixels */
            padding: 10px;
            /* Add some padding to make the button more clickable */
        }
    </style>
<?php } ?>