<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "chavez_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Insert data into the database
    
    $stmt = $conn->prepare("INSERT INTO products_table (name, email, product_name, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('sssd', $name, $email, $product_name, $price );
    $stmt->execute();
    $stmt->close();

    
    $message = "Your order has been placed successfully!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location.href = 'order_list.php';
    </script>";

}
// Get search query from form
$search_query = isset($_GET['query']) ? $_GET['query'] : '';

if ($search_query) {
    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM product_table WHERE name LIKE ?");
    $search_query_param = "%" . $search_query . "%";
    $stmt->bind_param('s', $search_query_param);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Order List</h3>";

   
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

