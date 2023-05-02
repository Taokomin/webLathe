<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['Auto_number'])) {
  $Auto_number = $_GET['Auto_number'];
  $sql = "SELECT * FROM deliver WHERE Auto_number = $Auto_number ORDER BY Deliver_id ASC";
} else {
  $sql = "SELECT * FROM deliver ORDER BY Deliver_id ASC";
}
$result = mysqli_query($con, $sql);
$content = "";
if (mysqli_num_rows($result) > 0) {
  $i = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $tablebody .= '<tr style="border:1px solid #000;">
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $i . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Deliver_id'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Deliver_day'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_id'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_day'] . '</td>
		<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_detail'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Unit_id'] .  '</td>
		<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Customer_id'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Deliver_address'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Employee_id'] . '</td>
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
      
      <h1>ใบส่งมอบสินค้า</h1>
      <div id="company" class="clearfix">
        <div>บริษัท คิว ดี อี พรีซิชั่น พาร์ท จำกัด</div>
        <div>หมู่ 13 ตำบลคลองสอง อำเภอคลองหลวง </div>
        <div>จังหวัดปทุมธานี 12120</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
    </header>
<table  id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">รหัสส่งมอบ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">วันที่ส่งมอบ</td>
        <td  width="10%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp; รหัสสั่งสินค้า </td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="10%">วันที่สั่ง</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">สินค้าที่สั่งทำ</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">รหัสหน่วยนับ</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">รหัสลูกค้า</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">ที่อยู่ที่ส่งมอบ</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">ชื่อพนักงาน</td>
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
