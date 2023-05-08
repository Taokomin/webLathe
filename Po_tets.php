<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>เพิ่มข้อมูลสั่งสินค้าจากลูกค้า</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
            <link rel="icon" href="..\picture\Title-logo.png" type="image/icon type">
        </head>

        <body>
            <div class="container">
                <h1 class="mt-5">เพิ่มข้อมูลสั่งสินค้าจากลูกค้า</h1>
                <hr>
<form method="post" action="insert.php">
    <label for="po_code">PO Code:</label>
    <input type="text" name="po_code" id="po_code" required>

    <label for="order_date">Order Date:</label>
    <input type="date" name="order_date" id="order_date" required>

    <h2>Products</h2>

    <div id="products">
        <div class="product">
            <h3>Product 1</h3>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_code">Code:</label>
                <input type="text" name="product_codes[]" required>
            </div>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_name">Name:</label>
                <input type="text" name="product_names[]" required>
            </div>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_quantity">Quantity:</label>
                <input type="number" name="product_quantities[]" required>
            </div>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_counting_unit">Counting Unit:</label>
                <input type="text" name="product_counting_units[]" required>
            </div>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_price">Price:</label>
                <input type="number" name="product_prices[]" required>
            </div>
            <div class="mb-3" style="display: inline-block;">
                <label for="product1_price_unit">Price Unit:</label>
                <input type="text" name="product_price_units[]" required>
            </div>
        </div>
    </div>

    <button type="button" onclick="addProduct()">Add Product</button>

    <label for="customer_name">Customer Name:</label>
    <input type="text" name="customer_name" id="customer_name" required>

    <label for="employee_name">Employee Name:</label>
    <input type="text" name="employee_name" id="employee_name" required>

    <button type="submit">Submit</button>
</form>
</div>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
            </script>
        </body>

        </html>
<script>
    let productCount = 1;

    function addProduct() {
        const productsDiv = document.getElementById("products");

        const productDiv = document.createElement("div");
        productDiv.classList.add("product");

        const heading = document.createElement("h3");
        heading.textContent = `Product ${++productCount}`;
        productDiv.appendChild(heading);

        const codeLabel = document.createElement("label");
        codeLabel.setAttribute("for", `product${productCount}_code`);
        codeLabel.textContent = "Code:";
        productDiv.appendChild(codeLabel);

        const codeInput = document.createElement("input");
        codeInput.setAttribute("type", "text");
        codeInput.setAttribute("name", "product_codes[]");
        codeInput.setAttribute("required", "");
        codeInput.setAttribute("id", `product${productCount}_code`);
        productDiv.appendChild(codeInput);

        const nameLabel = document.createElement("label");
        nameLabel.setAttribute("for", `product${productCount}_name`);
        nameLabel.textContent = "Name:";
        productDiv.appendChild(nameLabel);

        const nameInput = document.createElement("input");
        nameInput.setAttribute("type", "text");
        nameInput.setAttribute("name", "product_names[]");
        nameInput.setAttribute("required", "");
        nameInput.setAttribute("id", `product${productCount}_name`);
        productDiv.appendChild(nameInput);

        const quantityLabel = document.createElement("label");
        quantityLabel.setAttribute("for", `product${productCount}_quantity`);
        quantityLabel.textContent = "Quantity:";
        productDiv.appendChild(quantityLabel);

        const quantityInput = document.createElement("input");
        quantityInput.setAttribute("type", "number");
        quantityInput.setAttribute("name", "product_quantities[]");
        quantityInput.setAttribute("required", "");
        quantityInput.setAttribute("id", `product${productCount}_quantity`);
        productDiv.appendChild(quantityInput);

        const countingUnitLabel = document.createElement("label");
        countingUnitLabel.setAttribute("for", `product${productCount}_counting_unit`);
        countingUnitLabel.textContent = "Counting Unit:";
        productDiv.appendChild(countingUnitLabel);

        const countingUnitInput = document.createElement("input");
        countingUnitInput.setAttribute("type", "text");
        countingUnitInput.setAttribute("name", "product_counting_units[]");
        countingUnitInput.setAttribute("required", "");
        countingUnitInput.setAttribute("id", `product${productCount}_counting_unit`);
        productDiv.appendChild(countingUnitInput);

        const priceLabel = document.createElement("label");
        priceLabel.setAttribute("for", `product${productCount}_price`);
        priceLabel.textContent = "Price:";
        productDiv.appendChild(priceLabel);

        const priceInput = document.createElement("input");
        priceInput.setAttribute("type", "number");
        priceInput.setAttribute("name", "product_prices[]");
        priceInput.setAttribute("required", "");
        priceInput.setAttribute("id", `product${productCount}_price`);
        productDiv.appendChild(priceInput);

        const priceUnitLabel = document.createElement("label");
        priceUnitLabel.setAttribute("for", `product${productCount}_price_unit`);
        priceUnitLabel.textContent = "Price Unit:";
        productDiv.appendChild(priceUnitLabel);

        const priceUnitInput = document.createElement("input");
        priceUnitInput.setAttribute("type", "text");
        priceUnitInput.setAttribute("name", "product_price_units[]");
        priceUnitInput.setAttribute("required", "");
        priceUnitInput.setAttribute("id", `product${productCount}_price_unit`);
        productDiv.appendChild(priceUnitInput);

        productsDiv.appendChild(productDiv);
    }
</script>
<style>
            @import url("https://fonts.googleapis.com/css2?family=Noto+Serif+Thai:wght@200;400&display=swap");

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Noto Serif Thai", serif;
            }

            body {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px;
                background: linear-gradient(135deg, #03018C, #212AA5, #4259C3);
            }

            .container {
                max-width: 700px;
                width: 100%;
                background-color: #fff;
                padding: 25px 30px;
                border-radius: 5px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            }

            .container .title {
                font-size: 25px;
                font-weight: 500;
                position: relative;
            }

            .container .title::before {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                height: 3px;
                width: 30px;
                border-radius: 5px;
                background: linear-gradient(135deg, #03018C, #212AA5, #4259C3);
            }
        </style>