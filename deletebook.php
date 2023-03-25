<?php
$id = $_REQUEST['id'];
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";
$conn = mysqli_connect($hostname, $username, $password);
if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");
mysqli_select_db($conn, $dbname) or die("ไม่สามารถเลือกฐานข้อมูล bookstore ได้");
$sql = "DELETE FROM book WHERE BookID = '$id' ";
mysqli_query($conn, $sql) or die("DELETE จาตาราง book มีข้อผิดพลาดเกิดขึ้น" . mysqli_error($conn));
mysqli_close($conn);
header("Location:listofbook.php");
?>
