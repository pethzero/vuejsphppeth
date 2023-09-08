<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "data_vue";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];

$sql = "INSERT INTO people (name) VALUES ('$name')";
if ($conn->query($sql) === TRUE) {
    $newPersonId = $conn->insert_id;
    $newPerson = array('id' => $newPersonId, 'name' => $name);
    echo json_encode($newPerson);
} else {
    echo json_encode(['error' => 'Error adding person']);
}

$conn->close();
?>
