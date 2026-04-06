<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Loan Payment Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type='number'] {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type='submit'] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        input[type='submit']:hover {
            background-color: #45a049;
        }
        p {
            margin: 10px 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class='container'>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loan']) && isset($_POST['rate']) && isset($_POST['months'])) {
    $Loan = floatval($_POST['loan']);
    $Rate = floatval($_POST['rate']);
    $RatePercent = $Rate / 100;
    $Months = intval($_POST['months']);

    $TotalPerMonth = ($Loan / $Months) + ($Loan * $RatePercent);
    // Loan payment formula: M = P * [r(1+r)^n] / [(1+r)^n - 1] where r is monthly rate, n is months

    echo "<h2>Loan Payment Schedule</h2>";
    echo "<p>Loan Amount: $$Loan</p>";
    echo "<p>Interest Rate: $Rate%</p>";
    echo "<p>Number of Months: $Months</p>";
    echo "<p>Monthly Payment: $$TotalPerMonth</p>";

    for ($i = 1; $i <= $Months; $i++) {
        echo "<p>Month $i: Pay $$TotalPerMonth</p>";
    }
} else {
    // Display form
    echo "<h2>Enter Loan Details</h2>";
    echo "<form method='post'>";
    echo "<label for='loan'>Loan Amount:</label>";
    echo "<input type='number' id='loan' name='loan' min='0.01' step='0.01' required>";
    echo "<label for='rate'>Interest Rate (%):</label>";
    echo "<input type='number' id='rate' name='rate' min='0' step='0.01' required>";
    echo "<label for='months'>Number of Months:</label>";
    echo "<input type='number' id='months' name='months' min='1' required>";
    echo "<input type='submit' value='Calculate'>";
    echo "</form>";
}

echo "    </div>
</body>
</html>";
