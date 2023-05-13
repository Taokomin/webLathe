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
        <title>การจัดการข้อมูลสั่งซื้อวัสดุและอุปกรณ์</title>
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
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">หน้าแรก</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ข้อมูลพื้นฐาน
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="prefix_name.php">ข้อมูลคำนำหน้าชื่อ</a></li>
                                <li><a class="dropdown-item" href="unit.php">ข้อมูลหน่วยนับ</a></li>
                                <li><a class="dropdown-item" href="employee_type.php">ข้อมูลประเภทพนักงาน</a></li>
                                <li><a class="dropdown-item" href="material_type.php">ข้อมูลประเภทวัสดุและอุปกรณ์</a></li>
                            </ul>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ข้อมูลหลัก
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="Customer.php">ข้อมูลลูกค้า</a></li>
                                <li><a class="dropdown-item" href="Employee.php">ข้อมูลพนักงาน</a></li>
                                <li><a class="dropdown-item" href="Material.php">ข้อมูลวัสดุและอุปกรณ์</a></li>
                                <li><a class="dropdown-item" href="Partner.php">ข้อมูลคู่ค้า</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Pre_Order.php">ข้อมูลการสั่งซื้อสินค้าจากลูกค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Deliver.php">ข้อมูลการส่งมอบสินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Buy_Material.php">ข้อมูลการสั่งซื้อวัสดุและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Accept_Material.php">ข้อมูลการรับเข้าวัสดุและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Pickup_Material.php">ข้อมูลการเบิกวัสดุและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Takeback.php">ข้อมูลการรับคืนวัสดุและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Report.php">การออกรายงาน</a>
                        </li>
                    </ul>
                    </ul>
                </div>
        </nav>

        <div class="container">
            <br>
            <h3 class="text-center">การจัดการข้อมูลสั่งซื้อวัสดุและอุปกรณ์</h3>
            <br>
            <div class="btn-add">
                <a type="button" class="btn btn-success" href="Insert_Buy_Material/Insert_Buy_Material.php">
                    <iconify-icon icon="carbon:document-add" style="color: white;" width="42" height="42"></iconify-icon>
                </a>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <table id="Buy_Material_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 3%;">ลำดับ</th>
                        <th style="width: 3%;">รหัสสั่งซื้อ</th>
                        <th style="width: 4%;">วันที่สั่งซื้อ</th>
                        <th style="width: 3%;">ชื่อวัสดุ</th>
                        <th style="width: 3%;">จำนวน</th>
                        <th style="width: 4%;">หน่วยนับ</th>
                        <th style="width: 4%;">ประเภทวัสดุและอุปกรณ์</th> 
                        <th style="width: 3%;">ราคา</th>
                        <th style="width: 4%;">หน่วยนับ</th>
                        <th>ชื่อพนักงาน</th>
                        <th>ชื่อคู่ค้า</th>
                        <th style="width: 4%;">สถานะ</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
                    $query = "SELECT bm.*,bmd.BuyMaterial_detail_id,bmd.BuyMaterial_detail ,
                    bmd.BuyMaterial_quantity,bmd.BuyMaterial_price,
                    m.Material_name, u.Unit_id AS Counting_unit_id,
                    u3.Unit_name AS Counting_unit_name,
                    u2.Unit_id AS Price_unit_id,
                    u4.Unit_name AS Price_unit_name,
                    mt.MaterialType_name,
                    p.Partner_name, 
                    p.Partner_surname, 
                    e.Employee_name, 
                    e.Employee_surname,
                    s.status_name
                    FROM buy_material AS bm
                    INNER JOIN buy_material_detail AS bmd ON bm.BuyMaterial_id = bmd.BuyMaterial_id
                    INNER JOIN Material AS m ON bmd.BuyMaterial_detail = m.Material_id 
                    INNER JOIN unit AS u ON bmd.Counting_unit = u.Unit_id
                    INNER JOIN unit AS u2 ON bmd.Price_unit = u2.Unit_id
                    INNER JOIN unit AS u3 ON bmd.Counting_unit = u3.Unit_id
                    INNER JOIN unit AS u4 ON bmd.Price_unit = u4.Unit_id
                    INNER JOIN material_type AS mt ON bmd.MaterialType_id = mt.MaterialType_id
                    INNER JOIN partner AS p ON bm.Partner_id = p.Partner_id
                    INNER JOIN employee AS e ON bm.Employee_id = e.Employee_id
                    INNER JOIN status AS s ON bm.BuyMaterial_status = s.status_id
                    ORDER BY bm.BuyMaterial_id,bmd.BuyMaterial_detail_id ASC;
                    ";


                    $result = mysqli_query($con, $query);
                    $i = 1;
                    while ($values = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td align="center"><?php echo $i++; ?></td>
                            <?php $values["BuyMaterial_id"]; ?>
                            <td align="center"><?php echo $values["BuyMaterial_detail_id"]; ?></td>>
                            <td align="center"><?php echo date("d/m/Y", strtotime($values["BuyMaterial_day"] . " UTC")); ?></td>
                            <td align="center"><?php echo $values["Material_name"]; ?></td>
                            <td align="center"><?php echo $values["BuyMaterial_quantity"]; ?></td>
                            <td align="center"><?php echo $values["Counting_unit_name"]; ?></td>
                            <td align="center"><?php echo $values["MaterialType_name"]; ?></td>
                            <td align="center"><?php echo $values["BuyMaterial_price"]; ?></td>
                            <td align="center"><?php echo $values["Price_unit_name"]; ?></td>
                            <td align="center"><?php echo $values["Employee_name"] . " " . $values["Partner_surname"]; ?></td>
                            <td align="center"><?php echo $values["Partner_name"] . " " . $values["Employee_surname"]; ?></td>
                            <td align="center"><?php echo $values["status_name"]; ?></td>
                            <td align="center">
                                <a href="Pdf_Buy_Material_id.php?BuyMaterial_id=<?php echo $values['BuyMaterial_id']; ?>" class="btn btn-warning"><iconify-icon icon="bxs:file-pdf" style="width: 14px; height: 14px"></iconify-icon></a>
                                <a href="Edit_Buy_Material/Edit_Buy_Material.php?BuyMaterial_id=<?php echo $values["BuyMaterial_id"]; ?>" class="btn btn-primary">
                                    <iconify-icon style="width: 13px; height: 13px" icon="el:file-edit"></iconify-icon>
                                </a>
                                <a onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบรายการนี้?')" href="Delete_Buy_Material/Delete_Buy_Material.php?BuyMaterial_id=<?php echo $values["BuyMaterial_id"]; ?>" class='btn btn-danger'>
                                    <iconify-icon style="width: 13px; height: 13px" icon="ant-design:delete-outlined"></iconify-icon>
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
    </style>
<?php } ?>