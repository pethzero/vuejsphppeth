<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "people_db"; // เปลี่ยนเป็นชื่อฐานข้อมูลที่คุณใช้

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE people SET name='$name' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Person updated successfully']);
} else {
    echo json_encode(['error' => 'Error updating person']);
}

$conn->close();
?>
