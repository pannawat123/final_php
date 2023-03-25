<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");

mysqli_select_db($conn, $dbname) or die("ไม่สามารถเลือกฐานข้อมูล bookstore ได้");

mysqli_query($conn, "set character_set_results=tis620");
mysqli_query($conn, "set character_set_client=tis620");
mysqli_query($conn, "set character_set_connection=tis620");
mysqli_query($conn, "set character_set_results=utf8mb4");

$BookID = $_POST['BookID'];
$BookName = $_POST['BookName'];
$TypeID = $_POST['typebook'];
$StatusID = $_POST['StatusID'];
$Publish = $_POST['Publish'];
$UnitPrice = $_POST['UnitPrice'];
$UnitRent = $_POST['UnitRent'];
$DayAmount = $_POST['DayAmount'];
$ImageFile = $_FILES['ImageFile']['name'];
$max_size = $_POST['max_size'];



if ($ImageFile != "") {
    if ($_FILES['ImageFile']['size'] > $max_size) {
        die ("<script>alert('ขนาดไฟล์ภาพใหญ่เกินกว่าที่กำหนด')</script>");
      }
    $ImageFile_ext = substr($ImageFile, -3);
    if ($ImageFile_ext != "gif" && $ImageFile_ext != "jpg") {
        die("<script>alert('นามสกุลไฟล์ภาพไม่ถูกต้อง')</script>");
    }
    copy($_FILES['ImageFile']['tmp_name'], "uploads/" . $_FILES['ImageFile']['name']);
    $sql = "UPDATE book SET BookName = '$BookName', TypeID = $TypeID, StatusID = $StatusID, Publish = '$Publish', UnitPrice = $UnitPrice, UnitRent = $UnitRent, DayAmount = $DayAmount, Picture = '$ImageFile' WHERE BookID = $BookID";
} else {
    $sql = "UPDATE book SET BookName = '$BookName', TypeID = $TypeID, StatusID = $StatusID, Publish = '$Publish', UnitPrice = $UnitPrice, UnitRent = $UnitRent, DayAmount = $DayAmount WHERE BookID = $BookID";
}


$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
} else {
    echo "<script>alert('การแก้ไขข้อมูลผิดพลาด')</script>";
}


mysqli_close($conn);

echo "<script>window.location='listofbook.php'</script>";



?>
