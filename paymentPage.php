<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .btn-group {
            text-align: center;
        }

        .btn-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Payment Details</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="itemprice">Item Price:</label>
                <input type="text" id="itemprice" name="itemprice" placeholder="item price" required>
            </div>
            <div class="form-group">
                <label for="cardnumber">Card Number:</label>
                <input type="text" id="cardnumber" name="cardnumber" placeholder="Enter card number" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>
            <div class="form-group">
                <label for="expdate">Expiration Date:</label>
                <input type="text" id="expdate" name="expdate" placeholder="MM/YYYY" required>
            </div>
            <div class="btn-group">
                <button type="submit" onclick="paySuc()">Submit Payment</button>
            </div>
        </form>
        <script>
            function paySuc() {
                var itemPrice = document.getElementById('itemprice').value;
            
                saveFinancialReport(itemPrice);


            }
            function saveFinancialReport(itemPrice) {
                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Prepare the POST request
                xhr.open("POST", "save_financial_report.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                // Define the function to handle the response from the server
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Request was successful, handle the response
                            alert(xhr.responseText);
                            // Log the response (you can handle it as needed)
                        } else {
                            // Request failed
                            alert("Error:", xhr.status);
                        }
                    }
                };

                // Send the POST request with the item price as data
                xhr.send("itemprice=" + itemPrice);

            }


        </script>
    </div>

</body>

</html>