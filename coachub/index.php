<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <title>Coachub Delivery</title>
</head>
<body>
    <div class="container">
        <h2>Delivery submission</h2>
        <form id="deliveryForm" action="insert_order.php" method="post" onsubmit="return validateform();">

            <h3>Products</h3>
            <label class="product-label">
                <input type="checkbox" name="products[]" value="Product 1">
                <img src="favicon.png" alt="Product 1" width="50">
                <span class="product-info">
                    <strong>Product 1</strong><br>
                    Price: 40.00TND<br>
                    Description: Lorem ipsum dolor sit amet.
                </span>
            </label>
            <label class="product-label">
                <input type="checkbox" name="products[]" value="Product 2">
                <img src="favicon.png" alt="Product 2" width="50">
                <span class="product-info">
                    <strong>Product 2</strong><br>
                    Price: 15.50TND<br>
                    Description: Lorem ipsum dolor sit amet.
                </span>
            </label>
            <label class="product-label">
                <input type="checkbox" name="products[]" value="Product 3">
                <img src="favicon.png" alt="Product 3" width="50">
                <span class="product-info">
                    <strong>Product 3</strong><br>
                    Price: 39.90TND<br>
                    Description: Lorem ipsum dolor sit amet.
                </span>
            </label>
            <hr>

            <span class="total-amount">Total Amount: 120.40TND</span>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="(216) 90-493-037" required>

            <label for="deliveryAddress">Delivery Address:</label>
            <textarea id="deliveryAddress" name="deliveryAddress" rows="1" required></textarea>

            <label for="deliveryDate">Preferred Delivery Date:</label>
            <input type="date" id="deliveryDate" name="deliveryDate" required>

            <label for="specialInstructions">Special Instructions:</label>
            <textarea id="specialInstructions" name="specialInstructions" rows="4" required></textarea>

            <input type="submit">
        </form>
    </div>
    <script>
        function validateform(){
        var phonenumber=document.getElementById('phoneNumber').value;
        if(phonenumber === '' ||/^\d{8}$/.test(phonenumber)){
            return true;
        }else{
            alert("invalid tunisian phone number");
            return false;
        }
        var deliveryDateInput = document.getElementById('deliveryDate');
        var today = new Date();
        var selectedDate = new Date(deliveryDateInput.value);

        if (selectedDate < today) {
            alert("Preferred delivery date must be today or later");
            return false; 
        }

        return true;
        }
        validateform();
    </script>
</body>
</html>