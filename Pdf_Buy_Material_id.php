<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['Auto_number'])) {
    $Auto_number = $_GET['Auto_number'];
    $sql = "SELECT bm.*, m.Material_name, u.Unit_name, mt.MaterialType_name, pn.Partner_name, pn.Partner_surname
    FROM buy_material AS bm
    INNER JOIN material AS m ON bm.Material_id = m.Material_id
    INNER JOIN unit AS u ON bm.Unit_id = u.Unit_id
    INNER JOIN material_type AS mt ON bm.MaterialType_id = mt.MaterialType_id
    INNER JOIN partner AS pn ON bm.Partner_id = pn.Partner_id
    WHERE bm.Auto_number = $Auto_number
    ORDER BY m.Material_id, u.Unit_id, mt.MaterialType_id, pn.Partner_id, bm.BuyMaterial_id ASC
    ";
  
} else {
    $sql = "SELECT * FROM pre_order ORDER BY PreOrder_id ASC";
}
$result = mysqli_query($con, $sql);
$content = "";
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $tablebody .= '<tr style="border:1px solid #000;">
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $i . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['BuyMaterial_id'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['BuyMaterial_day'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Material_id'] . '</td>
              <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['BuyMaterial_quantity'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Unit_name'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['MaterialType_name'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Employee_id'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Partner_name'] . " " . $row["Partner_surname"] . '</td>
        </tr>';
      $i++;
    }
  }
mysqli_close($con);

$mpdf = new \Mpdf\Mpdf();

$tableh = '
<style>
body {
  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }
  
  a {
    color: #5D6975;
    text-decoration: underline;
  }
  
  body {
    position: relative;
    width: 21cm;  
    height: 29.7cm; 
    margin: 0 auto; 
    color: #001028;
    background: #FFFFFF; 
    font-family: sarabun;
    font-size: 12px; 
  }
  
  header {
    padding: 10px 0;
    margin-bottom: 30px;
  }
  
  #notbglogo {
    display: block;
    margin-left:auto;
    margin-right:auto;
    width: 100px;
    height: 100px;
  }
  
  h1 {
    border-top: 1px solid  #5D6975;
    border-bottom: 1px solid  #5D6975;
    color: #5D6975;
    font-size: 2.4em;
    line-height: 1.4em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url(dimension.png);
  }
  #company {
    float: left;
    text-align: left;
  }
  
  #notices .notice {
    color: #5D6975;
    font-size: 1.2em;
  }
}
</style>
<div id="notbglogo" >
      <img src="picture\notbglogo.png">
      </div>
<header class="clearfix">
      
      <h1>ใบสั่งซื้อวัสดุและอุปกรณ์</h1>
      <div id="company" class="clearfix">
        <div>บริษัท คิว ดี อี พรีซิชั่น พาร์ท จำกัด</div>
        <div>หมู่ 13 ตำบลคลองสอง อำเภอคลองหลวง </div>
        <div>จังหวัดปทุมธานี 12120</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
    </header>
    <table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="30%">รหัสสั่งซื้อวัสดุและอุปกรณ์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">วันที่สั่งซื้อ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="20%">รหัสวัสดุและอุปกรณ์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">รหัสหน่วยนับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="20%">รหัสประเภทวัสดุและอุปกรณ์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">รหัสพนักงาน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">รหัสคู่ค้า</td>
    </tr>
</thead>
  <tbody>';

$tableend = "</tbody>
</table>";
$tablebody2 .= '<tr style="border:0px solid #000;">

<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%"><h2 style="text-align:center"> รายการการเบิกวัสดุอุปกรณ์ </h2></td>

      </tr>';

$tableh2 = '
<br><br><br><br><br><br>
<table id="bg-table2" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:0px solid #000;padding:4px;">
        <td  style="border-right:0px solid #000;padding:4px;"   width="10%" align="right">ลงชื่อ.....................................</td>
    </tr>
    <tr style="border:0px solid #000;padding:4px;">
    <td  style="border-right:0px solid #000;padding:4px;"  width="10%" align="right">(....................................)</td>
    </tr>
</thead>
  <tbody>';

$tableend2 = "</tbody>
</table>";


$mpdf->WriteHTML($tableh);
$mpdf->WriteHTML($tablebody);
// $mpdf->WriteHTML($tablebody2);
$mpdf->WriteHTML($tableend);


$mpdf->WriteHTML($tableh2);
// $mpdf->WriteHTML($tablebody2);
$mpdf->WriteHTML($tableend2);
$mpdf->Output();

//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
