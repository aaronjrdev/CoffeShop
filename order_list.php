<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chavez_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders from the database
$sql = "SELECT name, email, product_name, price, `date` FROM products_table";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: beige;
            color: brown;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid brown;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: brown;
        }

        h3 {
            color: brown;
        }

        .nav-pills .nav-link {
        text-decoration: none;
        padding: 10px 15px;
        color: #6f4f37;
    }

    .nav-pills .nav-link.active {
        background-color: #6f4f37;
        color: white;
    }

    header {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .nav-item {
        margin-right: 15px;
    }

    .nav-link {
        color: #6f4f37;
    }

    .nav-link:hover {
        color: #8B4513;
    }

        
    </style>
</head>
<body>
    <div class="navigation">
            <header>
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item"><a href="./index.html" class="nav-link active" aria-current="page">Home</a></li>
                    
                    <li class="nav-item"><a href="./menu.html" class="nav-link">Product</a></li> 
                    <li class="nav-item"><a href="./contact.html" class="nav-link">Contact</a></li>
                </ul>
            </header>
        </div>


    <h3>Order List</h3>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="orderTableBody">
            <?php
            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output each row of the result
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No orders found</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>
