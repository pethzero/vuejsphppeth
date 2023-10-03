<?php
// $servername = "localhost";
// $dbuser = "root";
// $dbpassword = "1234";
// $dbname = "data_vue";

// $conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
// รับค่า input จากผู้ใช้
$username = $_POST['username'];
$password = $_POST['password'];

echo $username;
// ทำการคิวรี่ฐานข้อมูลโดยไม่เช็คค่า input ให้เป็นปลอดภัย
// $query = "SELECT * FROM user WHERE user = '$username' AND password = '$password'";

// // ทำการ execute คิวรี่
// $result = mysqli_query($conn, $query);

// // เช็คผลลัพธ์
// if ($result) {
//     // คิวรี่ถูกต้อง
//     if (mysqli_num_rows($result) > 0) {
//         echo "เข้าสู่ระบบสำเร็จ";
//     } else {
//         echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
//     }
// } else {
//     echo "มีข้อผิดพลาดในการคิวรี่: " . mysqli_error($conn);
// }

// // ปิดการเชื่อมต่อฐานข้อมูล
// mysqli_close($conn);
?>
