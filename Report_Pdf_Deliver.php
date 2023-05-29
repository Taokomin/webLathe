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

$sql = "SELECT * FROM deliver WHERE Deliver_day BETWEEN '$d_s' AND '$d_e' ORDER BY Deliver_id ASC";
$sql = "SELECT *,d.Deliver_day, u.Unit_id AS Counting_unit_id,
u3.Unit_name AS Counting_unit_name, u2.Unit_id AS Price_unit_id,
 u4.Unit_name AS Price_unit_name , 
 c.Customer_name, 
 c.Customer_surname, 
 c.Customer_surname,
 e.Employee_name, 
 e.Employee_surname
FROM deliver AS d
INNER JOIN deliver_detail AS dd ON d.Deliver_id = dd.Deliver_id
INNER JOIN unit AS u ON dd.Counting_unit = u.Unit_id
INNER JOIN unit AS u2 ON dd.Price_unit = u2.Unit_id
INNER JOIN unit AS u3 ON dd.Counting_unit = u3.Unit_id
INNER JOIN unit AS u4 ON dd.Price_unit = u4.Unit_id
INNER JOIN customer AS c ON dd.Customer_id = c.Customer_id
INNER JOIN employee AS e ON d.Employee_id = e.Employee_id 
WHERE d.Deliver_day BETWEEN '$d_s 00:00:00' AND '$d_e 23:59:59'
ORDER BY dd.Deliver_id ASC";
$result = mysqli_query($con, $sql);
$content = "";
$total = 0;
if (mysqli_num_rows($result) > 0) {
  $i = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $no = $row['Deliver_id'];
    $date = date('d/m/Y', strtotime($row['Deliver_day']));
    $emp = $row['Employee_name'] ." ". $row['Employee_surname'];
    $ctm = $row['Customer_name'] ." ". $row['Customer_surname'];
    $cem = $row['Customer_email'];
    $subtotal = $row['Deliver_quantity'] * $row['Deliver_price'];
    $total += $subtotal;
    $tablebody .= '<tr style="border:1px solid #000;">
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $i . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Deliver_detail'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Deliver_quantity'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Counting_unit_name'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . number_format($row['Deliver_price']) . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . number_format($row['Deliver_quantity'] * $row['Deliver_price']) . '</td>
      </tr>';
    $i++;
  }
}
$tablebody .= '<tr style="border:1px solid #000;">
    <td colspan="5" style="border-right:1px solid #000;background-color:#A1E7FF;padding:3px;text-align:right;">ผลรวมสรุป:</td>
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
<h2 style="text-align:center;background-color:#A1E7FF;padding:10px;"> รายงานสรุปยอดวัสดุและอุปกรณ์ตามช่วงเวลา</h2>
<h3 style="border-right:0px solid #000;padding:3px;text-align:center;"  >ตั้งแต่วันที่  '.$start_date.' ถึง '.$end_date.'</h3>



<table  id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;background-color:#A1E7FF;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  width="10%" style="border-right:1px solid #000;background-color:#A1E7FF;padding:4px;text-align:center;">&nbsp;ชื่อสินค้า</td>
        <td  style="border-right:1px solid #000;background-color:#A1E7FF;padding:4px;text-align:center;" width="10%">จำนวน</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="10%">หน่วยนับ</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="10%">ราคา(บาท)</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="20%">ราคารวม(บาท)</td>
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
