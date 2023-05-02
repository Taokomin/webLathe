<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
		}
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
		h1 {
			font-size: 24px;
			margin-bottom: 20px;
		}
		.address {
			margin-top: 30px;
			margin-bottom: 20px;
		}
		.address p {
			margin: 0;
		}
	</style>
</head>
<body>
	<h1>Purchase Order</h1>
	<table>
		<tr>
			<th>Item</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Product 1</td>
			<td>2</td>
			<td>$50.00</td>
			<td>$100.00</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Product 2</td>
			<td>1</td>
			<td>$75.00</td>
			<td>$75.00</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: right;"><strong>Subtotal</strong></td>
			<td>$175.00</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: right;"><strong>Tax</strong></td>
			<td>$17.50</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: right;"><strong>Total</strong></td>
			<td>$192.50</td>
		</tr>
	</table>
	<div class="address">
		<h3>Billing Address</h3>
		<p>John Doe</p>
		<p>123 Main Street</p>
		<p>Anytown, USA 12345</p>
	</div>
	<div class="address">
		<h3>Shipping Address</h3>
		<p>Jane Doe</p>
		<p>456 Oak Avenue</p>
		<p>Anytown, USA 12345</p>
	</div>
</body>
</html>
