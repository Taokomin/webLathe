<?php require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="picture\Title-logo.png" type="image/icon type">
    <link href="bt/css/bootstrap.min.css" rel="stylesheet">
    <link href="bt/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    <title>ออกรายงานสรุปการสั่งซื้อวัสดุและอุปกรณ์</title>
    <style type="text/css">
        img {
            width: 20px;
            height: auto;
        }

        .custom-panel {
            border-color: #03018c;
        }

        .custom-panel .panel-heading {
            background-color: #03018c;
            border-color: #03018c;
        }
    </style>
</head>

<body>

    <div class="row">
        <div class="col-md-12">
            <div class="panel custom-panel">
                <div class="panel-heading"><b>
                        <font size="5">
                            <center style="color: white"> ค้นหา รายงานสรุปการสั่งซื้อวัสดุและอุปกรณ์ ตามช่วงวันที่</center>
                        </font>
                        </b></div>
                    <div class="panel-body">
                        <form id="form1" name="form1" class="form-inline" method="post" action="Report_mng2.php">
                            <center>
                                <div class="form-group">
                                    <label for="exampleInputName2">วันที่ :</label>
                                    <input type="date" class="form-control" name="d_s" id="datepicker" value="<?php echo date('Y-m-d'); ?>" required>
                                    <script type='text/javascript'>
                                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020'];

                                        $(document).ready(function() {


                                            $('#BuyMaterial_day').BuyMaterial_day({
                                                beforeShowDay: function(date) {
                                                    var month = date.getMonth() + 1;
                                                    var year = date.getFullYear();
                                                    var day = date.getDate();
                                                    var newdate = day + "-" + month + '-' + year;
                                                    var tooltip_text = "New event on " + newdate;
                                                    if ($.inArray(newdate, highlight_dates) != -1) {
                                                        return [true, "highlight", tooltip_text];
                                                    }
                                                    return [true];
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">&nbsp;ถึงวันที่ :&nbsp;</label>
                                    <input type="date" class="form-control" name="d_e" id="datepicker2" value="<?php echo date('Y-m-d'); ?>" required>
                                    <script type='text/javascript'>
                                        var highlight_dates = ['1-5-2020', '11-5-2020', '18-5-2020', '28-5-2020'];

                                        $(document).ready(function() {


                                            $('#BuyMaterial_day').BuyMaterial_day({
                                                beforeShowDay: function(date) {
                                                    var month = date.getMonth() + 1;
                                                    var year = date.getFullYear();
                                                    var day = date.getDate();
                                                    var newdate = day + "-" + month + '-' + year;
                                                    var tooltip_text = "New event on " + newdate;
                                                    if ($.inArray(newdate, highlight_dates) != -1) {
                                                        return [true, "highlight", tooltip_text];
                                                    }
                                                    return [true];
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                &nbsp;&nbsp;<button id="non-printable" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                                <a href="Report_mng2.php" class="btn btn-info">รีเซ็ต</a>
                                <a href="Report_mng.php" class="btn btn-danger">ย้อนกลับ</a>
                            </center>
                            <style type="text/css">
                                #printable {
                                    display: block;
                                }

                                @media print {
                                    #non-printable {
                                        display: none;
                                    }

                                    #printable {
                                        display: block;
                                    }
                                }
                            </style>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>









    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>

    <script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>







    </div>
    </div>


    <div class="container">
        <table id="Buy_Material_table" class="table table-bordered table-striped" style="width:100%">
            <!--ส่วนหัว-->
            <thead>
                <tr>
                    <th style="text-align: center;">ลำดับ</th>
                    <th style="text-align: center;">รหัสสั่งซื้อ</th>
                    <th style="text-align: center;">วันที่สั่งซื้อ</th>
                    <th style="text-align: center;">รหัสรายการ</th>
                    <th style="text-align: center;">ชื่อวัสดุ</th>
                    <th style="text-align: center;">จำนวน</th>
                    <th style="text-align: center;">หน่วยนับ</th>
                    <th style="text-align: center;">ราคา(บาท)</th>
                    <th style="text-align: center;">ชื่อพนักงาน</th>
                    <th style="text-align: center;">ชื่อคู่ค้า</th>
                    <th style="text-align: center;">สถานะ</th>
            </thead>



            <?php
            require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
            $num = 1;

            @$d_s = $_POST['d_s'];
            @$d_e = $_POST['d_e'];


            $d_s .= " 00:00:00";
            $d_e .= " 23:59:59";

            $query = "SELECT bm.*,bmd.BuyMaterial_detail_id,bmd.BuyMaterial_detail ,
                    bmd.BuyMaterial_quantity,bmd.BuyMaterial_price,
                    m.Material_name, u.Unit_id AS Counting_unit_id,
                    u3.Unit_name AS Counting_unit_name,
                    u2.Unit_id AS Price_unit_id,
                    u4.Unit_name AS Price_unit_name,
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
                    INNER JOIN partner AS p ON bm.Partner_id = p.Partner_id
                    INNER JOIN employee AS e ON bm.Employee_id = e.Employee_id
                    INNER JOIN status AS s ON bm.BuyMaterial_status = s.status_id
                    WHERE bm.BuyMaterial_day BETWEEN '$d_s' AND '$d_e'
                    ORDER BY bm.BuyMaterial_id,bmd.BuyMaterial_detail_id ASC;
                    ";


            $result = mysqli_query($con, $query);

            $i = 1;
            $num2 = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td align="center"><?php echo $i++; ?></td>
                    <td align="center"><?php echo $row["BuyMaterial_id"]; ?></td>
                    <td align="center"><?php echo date("d/m/Y", strtotime($row["BuyMaterial_day"] . " UTC")); ?></td>
                    <td align="center"><?php echo $row["BuyMaterial_detail_id"]; ?></td>>
                    <td align="center"><?php echo $row["Material_name"]; ?></td>
                    <td align="center"><?php echo $row["BuyMaterial_quantity"]; ?></td>
                    <td align="center"><?php echo $row["Counting_unit_name"]; ?></td>
                    <td align="center"><?php echo number_format($row["BuyMaterial_price"]); ?></td>
                    <td align="center"><?php echo $row["Employee_name"] . " " . $row["Partner_surname"]; ?></td>
                    <td align="center"><?php echo $row["Partner_name"] . " " . $row["Employee_surname"]; ?></td>
                    <td align="center"><?php echo $row["status_name"]; ?></td>
                </tr>
            <?php
            }

            // Close database connection
            mysqli_close($con);
            ?>

        </table>
        <center><a href="Report_Pdf_BuyMaterial.php?d_s=<?php echo $d_s; ?>&&d_e=<?php echo $d_e; ?>" class="btn btn-primary" style="background-color:#03018c">ออกรายงาน</a></center>

    </div>

</body>