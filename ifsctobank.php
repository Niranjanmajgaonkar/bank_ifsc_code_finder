<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .details {
            margin-bottom: 15px;
        }
        .details label {
            font-weight: bold;
        }
        .details span {
            display: block;
            margin-top: 5px;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="text"] {
        
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        body{
            background-color:#2874f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><span style="color: #e74c3c;">B</span>ank Detail<span style="color: #e74c3c;">s</span></h2>
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="bank_code" placeholder="Enter IFSC Code">
            <input type="submit" value="Get Details">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ifsc_finder";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $bank_name = $_POST['bank_code'];
            $query = "SELECT `adr1`, `adr2`, `adr3`, `adr4`, `adr5`, `contact`,`ifsc` FROM `bank_records` WHERE `ifsc`='$bank_name'";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    echo '<div class="details">';
                    echo '<span><label>Address 1:  </label>' . $row['adr1'] . '</span><br>';
                    echo '<span><label>Address 2:  </label>' . $row['adr2'] . '</span><br>';
                    echo '<span><label>Address 3:  </label>' . $row['adr5'] . '</span><br>';
                    echo '<span><label>District:   </label>' . $row['adr3'] . '</span><br>';
                    echo '<span><label>State:      </label>' . $row['adr4'] . '</span><br>';
                    echo '<span><label>Contact:    </label>' . $row['contact'] . '</span><br>';
                    echo '<span><label>IFSC:       </label>' . $row['ifsc'] . '</span><br>';
                    echo '</div>';
                } else {
                    echo "No results found";
                }
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
