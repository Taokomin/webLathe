<?php session_start(); ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';
require('Function\getEmployeeName.php');


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['PreOrder_id'])) {
  $PreOrder_id = $_GET['PreOrder_id'];
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
    WHERE po.PreOrder_id = '$PreOrder_id'
    ORDER BY po.PreOrder_id ASC;";
} else {
  $sql = "SELECT * FROM pre_order ORDER BY PreOrder_id ASC";
}
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
        <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['Counting_unit_name'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . number_format($row['PreOrder_price']) . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . number_format($row['PreOrder_quantity'] * $row['PreOrder_price']) . '</td>

      </tr>';
    $i++;
  }
}
$tablebody .= '<tr style="border:1px solid #000;">
    <td colspan="5" style="border-right:1px solid #000;padding:3px;text-align:right;">ผลรวมสรุป:</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . number_format($total) . '</td>
</tr>';
mysqli_close($con);

$mpdf = new \Mpdf\Mpdf();

$tableh = '
<style>
  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }
  
  a {
    color: #0087C3;
    text-decoration: none;
  }
  
  body {
    position: relative;
    width: 21cm;  
    height: 29.7cm; 
    margin: 0 auto; 
    color: #555555;
    background: #FFFFFF; 
    font-family: sarabun;
    font-size: 18px; 
  }
  
  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }
  
  #logo, #company{
    display: inline-block;
    vertical-align: middle;
  }

  #details, #client{
    display: inline-block;
    vertical-align: middle;
  }

  #logo {
    float: left;
    width: 301px;
  }
  
  #logo img {
    max-width: 100%;
  height: auto;
  }
  
  #company {
    text-align: right;
  width: calc(100% - 301px);
  }

  #company h1{
    margin-top: 0;
  margin-bottom: 5px;
  }

  #details {
    margin-bottom: 50px;
  }
  
  #client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    float: left;
    width: 301px;
  }
  
  #client .to {
    color: #777777;
  }
  
  h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
  }
  
  #invoice {
    text-align: right;
  width: calc(100% - 301px);
  }
  
  #invoice h1 {
    color: #0087C3;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
  }
  
  #invoice .date {
    font-size: 1.1em;
    color: #777777;
  }
margin-bottom: 50px;
  }
  
  #notices{
    padding-left: 6px;
    border-left: 6px solid #0087C3;  
  }
  
  #notices .notice {
    font-size: 1.2em;
  } 
}
</style>
<header class="clearfix">
      <div id="logo">
        <img src="picture\sizelogo.png">
      </div>
      <div id="company">
        <h1 class="name">บริษัท คิว.ดี.อี. พรีซิชั่น พาร์ท จำกัด</h1>
        <div>22/82 หมู่ 13 ซอยไอยรา 10  ตำบลคลองสอง อำเภอคลองหลวง จังหวัดปทุมธานี 12120</div>
        <div>096-269-9959, 02-100-4616</div>
        <div><a href="mailto:qde_engineer@yahoo.com">qde_engineer@yahoo.com</a></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">ชื่อผู้สั่งสินค้า : </div>
          <h2 class="name">'.$ctm.'</h2>
          <div class="email"><a href="mailto:'.$cem.'">'.$cem.'</a></div>
        </div>
        <div id="invoice">
          <h1>ใบสั่งซื้อสินค้า :'.$no .'</h1>
          <div class="date">วันที่สั่งซื้อ: '.$date.' </div>


        </div>
      </div>
  <table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
  <tr style="border:1px solid #000;padding:4px;">
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">สินค้าที่สั่งทำ</td>
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวน</td>
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">หน่วยนับ</td>
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคา(บาท)</td>
  <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">ราคารวม(บาท)</td>
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
