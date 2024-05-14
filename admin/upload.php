<?php
// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Get the image file data
    $image = file_get_contents($_FILES['image']['tmp_name']);

    // Convert the image data to a binary string
    $image_data = bin2hex($image);

    // Insert the form data and image data into the database
    $sql = "INSERT INTO products (name, description, price, category, image_data) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssdss', $name, $description, $price, $category, $image_data);
    $stmt->execute();

    // Check if the product was added successfully
    if ($stmt->affected_rows > 0) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $db->close();
}
?>