<?php
// Establishing the database connection
$servername = "localhost";
$username = "id20906905_data";
$password = "Sil@1234";
$database = "id20906905_datab";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle signup request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Insert user into the database
    $query = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = [
            'status' => 'success',
            'message' => 'User registered successfully'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to register user'
        ];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Closing the database connection
mysqli_close($conn);
?>
