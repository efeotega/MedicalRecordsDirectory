<?php
// Start session to access session variables
session_start();

// Sample account numbers for wire transfer
$account_numbers = array("123456789", "987654321", "567890123");

// Function to generate invoice and download as a file
function generateInvoice()
{
    // Get drug name, patient email, and current date and time from session variables
    $drug_name = $_SESSION['drug'];
    $patient_email = $_SESSION['patientemail'];
    date_default_timezone_set('Africa/Lagos');
    $current_datetime = date("Y-m-d H:i:s");


    // Generate invoice content
    $invoice_content = "Hospital Name: Central Health Hospital\n\n";
    $invoice_content .= "Drug Name: $drug_name\n";
    $invoice_content .= "Patient Email: $patient_email\n";
    $invoice_content .= "Payment Account: 1234567890 GTBank\n";
    $invoice_content .= "Date and Time: $current_datetime\n";


    // Set headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="invoice.txt"');
    $payment_made = true;
    // Assuming you have established a database connection
    $conn = new mysqli("localhost", "root", "", "med_rec_database");

    // If payment has been made, insert details into financialreports table
    if ($payment_made) {
        // Set price to 3000 naira
        $price = 3000;
        // Prepare SQL statement to insert data into financialreports table
        $stmt = $conn->prepare("INSERT INTO financialreports (email, itembought, price, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $patient_email, $drug_name, $price, $current_datetime);

        // Execute SQL statement
        $stmt->execute();

        // Close statement
        $stmt->close();
    }
    // Output the invoice content
    echo $invoice_content;
    exit;
}

// Check if generate invoice button is clicked
if (isset($_POST['generate_invoice'])) {
    generateInvoice();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .account-numbers {
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Payment &#x20A6;3000</h1>
        <h2>Account Numbers For Transfer:</h2>
        <div class="account-numbers">
            <ul>
                <!-- <?php
                // Sample account numbers for wire transfer
                $account_numbers = array("123456789", "987654321", "567890123");
                foreach ($account_numbers as $account_number) {
                    echo "<li>$account_number</li>";
                }
                ?> -->
                <li>1234567890 GTBank</li>
            </ul>
        </div>
        <form method="post">
            <button type="submit" name="generate_invoice">I have made the payment</button>
        </form>
    </div>
</body>

</html>