<?php session_start(); ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';
require('Function\getEmployeeName.php');
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Bangkok');
@$d_s = $_GET['d_s'];
@$d_e = $_GET['d_e'];
$start_date = date("d/m/Y", strtotime($d_s));
$end_date = date("d/m/Y", strtotime($d_e));

$sql = "SELECT po.*,pod.PreOrder_detail, pod.PreOrder_quantity, u.Unit_id AS Counting_unit_id, u3.Unit_name AS Counting_unit_name,
 pod.PreOrder_price, u2.Unit_id AS Price_unit_id, u4.Unit_name AS Price_unit_name,
 pod.PreOrder_quantity, c.Customer_name, c.Customer_surname,c.Customer_email, e.Employee_name, e.Employee_surname
 FROM pre_order AS po
 INNER JOIN pre_order_detail AS pod ON po.PreOrder_id = pod.PreOrder_id
 INNER JOIN unit AS u ON pod.Counting_unit = u.Unit_id
 INNER JOIN unit AS u2 ON pod.Price_unit = u2.Unit_id
 INNER JOIN unit AS u3 ON pod.Counting_unit = u3.Unit_id
 INNER JOIN unit AS u4 ON pod.Price_unit = u4.Unit_id
 INNER JOIN customer AS c ON po.Customer_id = c.Customer_id
 INNER JOIN employee AS e ON po.Employee_id = e.Employee_id
 WHERE po.PreOrder_day BETWEEN '$d_s 00:00:00' AND '$d_e 23:59:59'
 ORDER BY po.PreOrder_id ASC;";

$result = mysqli_query($con, $sql);
$content = "";
$total = 0;
if (mysqli_num_rows($result) > 0) {
  $i = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $no = $row['PreOrder_id'];
    $date = date('d/m/Y', strtotime($row['PreOrder_day']));
    $emp = $row['Employee_name'] ." ". $row['Employee_surname'];
    $ctm = $row['Customer_name'] ." ". $row['Customer_surname'];
    $cem = $row['Customer_email'];
    $subtotal = $row['PreOrder_quantity'] * $row['PreOrder_price'];
    $total += $subtotal;
    $tablebody .= '<tr style="border:1px solid #000;">
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $i . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_detail'] . '</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_quantity'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_price'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . $row['PreOrder_quantity'] * $row['PreOrder_price'] . '</td>

      </tr>';
    $i++;
  }
}
$tablebody .= '<tr style="border:1px solid #000;">
    <td  colspan="4" style="border-right:1px solid #000;background-color:#A1E7FF;padding:3px;text-align:right;">ผลรวมสรุป:</td>
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
<h2 style="text-align:center;background-color:#A1E7FF;padding:10px;">รายงานสรุปยอดขายสินค้าตามช่วงเวลา</h2>
<h3 style="border-right:0px solid #000;padding:3px;text-align:center;"  >ตั้งแต่วันที่  '.$start_date.' ถึง '.$end_date.'</h3>


<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
<tr style="border:1px solid #000;padding:4px;">
<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;"   width="10%">ลำดับ</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;"  width="15%">สินค้าที่สั่งทำ</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="15%">จำนวน</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="15%">ราคา</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;background-color:#A1E7FF;" width="20%">ราคารวม</td>
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
?>