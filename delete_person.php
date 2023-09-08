<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "data_vue";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM people WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Person deleted successfully']);
} else {
    echo json_encode(['error' => 'Error deleting person']);
}

$conn->close();
?>
