<?php session_start(); ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';
require('Function\getEmployeeName.php');
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Bangkok');
@$d_s = $_GET['d_s']; //ตัวแปรวันที่เริ่มต้น
@$d_e = $_GET['d_e']; //ตัวแปรวันที่สิ้นสุด
$start_date = date("d/m/Y", strtotime($d_s));
$end_date = date("d/m/Y", strtotime($d_e));
$sql = "SELECT bm.*,bmd.BuyMaterial_detail ,
  bmd.BuyMaterial_quantity,bmd.BuyMaterial_price,
  m.Material_name, u.Unit_id AS Counting_unit_id,
  u3.Unit_name AS Counting_unit_name,
  u2.Unit_id AS Price_unit_id,
  u4.Unit_name AS Price_unit_name,
  mt.MaterialType_name,
  p.Partner_name, 
  p.Partner_surname, 
  p.Partner_email,
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
  WHERE bm.BuyMaterial_day BETWEEN '$d_s 00:00:00' AND '$d_e 23:59:59'
  ORDER BY bm.BuyMaterial_id ASC;
  ";
$result = mysqli_query($con, $sql);
$total = 0;
if (mysqli_num_rows($result) > 0) {
  $i = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $no = $row['BuyMaterial_id'];
    $date = date('d/m/Y', strtotime($row['BuyMaterial_day']));
    $emp = $row['Employee_name'] . " " . $row['Employee_surname'];
    $ctm = $row['Partner_name'] . " " . $row['Partner_surname'];
    $cem = $row['Partner_email'];
    $subtotal = $row['BuyMaterial_quantity'] * $row['BuyMaterial_price'];
    $total += $subtotal;
    $tablebody .= '<tr style="border:1px solid #000;">
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $i . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Material_name'] . '</td>
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['BuyMaterial_quantity'] . '</td>  
          <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['BuyMaterial_price'] . '</td>    
          <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . $row['BuyMaterial_quantity'] * $row['BuyMaterial_price'] . '</td>
        </tr>';
    $i++;
  }
}
$tablebody .= '<tr style="border:1px solid #000;">
    <td colspan="4" style="border-right:1px solid #000;background-color:#A1E7FF;padding:3px;text-align:right;">ผลรวมสรุป:</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . $total . '</td>
</tr>';

mysqli_close($con);
$mpdf = new \Mpdf\Mpdf();

$tableh = '
<style>
  body{
    font-family: sarabun; 
  }
  #bg-table {
    border-collapse: collapse;
    width: 100%;
    font-size: 12pt;
    margin-top: 8px;
}

#bg-table th, #bg-table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: center;
}

#bg-table th {
    background-color: #f2f2f2;
}

#bg-table td:nth-child(odd) {
    background-color: #f9f9f9;
}
</style>
<h2 style="text-align:center;background-color:#A1E7FF;padding:10px;">รายงานการสั่งซื้อวัสดุและอุปกรณ์ตามช่วงเวลา</h2>
<h3 style="border-right:0px solid #000;padding:3px;text-align:center;"  >ตั้งแต่วันที่  ' . $start_date . ' ถึง ' . $end_date . '</h3>
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
<tr style="border:1px solid #000;padding:4px;">
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;"   width="10%">ลำดับ</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;"  width="30%">ชื่อวัสดุและอุปกรณ์</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="20%">จำนวน</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="20%">ราคา</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;"  width="20%">ราคารวม</td>
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
              <td  style="border-right:0px solid #000;padding:4px;"   width="10%" align="right">ลงชื่อ  :  '. getEmployeeName($_SESSION['User']) .'</td>
          </tr>
          <tr style="border:0px solid #000;padding:4px;">
          <td  style="border-right:0px solid #000;padding:4px;"  width="10%" align="right">(.........................................)</td>
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
