<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php';

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
    <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >' . $row['PreOrder_price'] . '</td>
    <td style="border-right:1px solid #000;padding:3px;text-align:center;">' . $row['PreOrder_quantity'] * $row['PreOrder_price'] . '</td>

      </tr>';
    $i++;
  }
}
mysqli_close($con);

$mpdf = new \Mpdf\Mpdf();

$tableh = '
<style>
body {
  font-family: sarabun;
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    border-radius: 5px;
    text-align: center;
  }

  .logo {
    width: 100px;
    height: 100px;
  }
  .address{
    text-align:left;
  }
  h1 {
    display: flex;
    align-items: center;
  }
}

</style>
<div class="container">
<img class="logo" src="picture\notbglogo.png">
    <div id="document">
        <div id="documenthead">
            <div id="metadata">
                <table>
                    <tr class="metadata-purchaseorderid">
                        <th>หมายเลขใบสั่งซื้อ</th>
                        <td>X X X X</td>
                    </tr>
                    <tr class="metadata-warehouse">
                        <th>บริษัท</th>
                        <td>บริษัท คิว ดี อี พรีซิชั่น พาร์ท จำกัด</td>
                    </tr>
                    <tr class="metadata-date">
                        <th>วันที่</th>
                        <td>(..........................................................)</td>
                    </tr>
                    <tr class="metadata-delivery-date">
                        <th>วันที่จัดส่งที่คาดไว้</th>
                        <td>(..........................................................)</td>
                    </tr>
                    <tr class="metadata-supplier-orderid">
                        <th>ผู้จัดจำหน่ายหมายเลขคำสั่งซื้อ</th>
                        <td>(..........................................................)</td>
                    </tr>
                </table> 
              <div class="address">
              ที่อยู่ บริษัท คิว ดี อี พรีซิชั่น พาร์ท จำกัด<br>
              หมู่ 13 ตำบลคลองสอง อำเภอคลองหลวง<br>
              จังหวัดปทุมธานี 12120<br>
              </div>
              </div>
          </div>
	</div>
  <br>
<table  id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">รหัสสั่งสินค้าจากลูกค้า</td>
        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp; วันที่สั่ง </td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">รายละเอียดการสั่งสินค้า</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวน</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">หน่วยนับ</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="30%">ชื่อลูกค้า</td>
		<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">ชื่อพนักงาน</td>
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
<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
<tr style="border:1px solid #000;padding:4px;">
<td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">สินค้าที่สั่งทำ</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวน</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคา</td>
<td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="20%">ราคารวม</td>
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
