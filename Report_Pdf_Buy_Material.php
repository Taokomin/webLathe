<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php';
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Bangkok');
@$d_s = $_GET['d_s']; //ตัวแปรวันที่เริ่มต้น
@$d_e = $_GET['d_e']; //ตัวแปรวันที่สิ้นสุด
$start_date = date("d/m/Y", strtotime($d_s));
$end_date = date("d/m/Y", strtotime($d_e));

$sql = "SELECT bm.*, m.Material_name, u.Unit_name, mt.MaterialType_name, pn.Partner_name, pn.Partner_surname
  FROM buy_material AS bm
  INNER JOIN material AS m ON bm.Material_id = m.Material_id
  INNER JOIN unit AS u ON bm.Unit_id = u.Unit_id
  INNER JOIN material_type AS mt ON bm.MaterialType_id = mt.MaterialType_id
  INNER JOIN partner AS pn ON bm.Partner_id = pn.Partner_id
  WHERE bm.BuyMaterial_day BETWEEN '$d_s' AND '$d_e'
  ORDER BY m.Material_id, u.Unit_id, mt.MaterialType_id, pn.Partner_id, bm.BuyMaterial_id ASC
  ";
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

<h2 style="border-right:0px solid #000;padding:3px;text-align:center;"  >ตั้งแต่วันที่  '.$start_date.' ถึง '.$end_date.'</h2>
<h3 style="text-align:center">รายงานการสั่งซื้อวัสดุและอุปกรณ์ตามช่วงเวลา</h3>


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
<br>
<table id="bg-table2" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
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
