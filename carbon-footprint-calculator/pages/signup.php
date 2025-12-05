<?php
$host = 'localhost'; // Database host
$dbname = 'user_management'; // Your database name
$username = 'carbon-footprint'; // Your MySQL username
$password = 'yv8djpUjBrBZ@wur'; // Your MySQL password

try {
    // Create PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Output error message if connection fails
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $confirm_password = $_POST['psw-repeat'];

    // Validate password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert the user data
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters to prevent SQL injection
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    try {
        // Execute the query and insert the data
        $stmt->execute();
        echo "User successfully registered!";
    } catch (PDOException $e) {
        // If there is a database error, display the error message
        echo "Error: " . $e->getMessage();
    }
}
?>
