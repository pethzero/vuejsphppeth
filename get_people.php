<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "data_vue";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM people";
$result = $conn->query($sql);

$people = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $people[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($people);
?>
