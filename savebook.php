<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";
$conn = mysqli_connect($hostname, $username, $password, $dbname);



if (isset($_REQUEST['Submit'])) {
    $BookID =  $_REQUEST['BookID'];
    $BookName = $_REQUEST['BookName'];
    $typebook =  $_REQUEST['typebook'];
    $StatusID =  $_REQUEST['StatusID'];
    $Publish =  $_REQUEST['Publish'];
    $UnitPrice = $_REQUEST['UnitPrice'];
    $UnitRent = $_REQUEST['UnitRent'];
    $DayAmount = $_REQUEST['DayAmount'];
}



//copy file and save to folder
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
// save file to folder
move_uploaded_file($_FILES["ImageFile"]["tmp_name"], $target_file);


$sql = "INSERT INTO book (BookID, BookName, TypeID , StatusID, Publish,Picture , UnitPrice , UnitRent , DayAmount,BookDate) 
VALUES ('$BookID', '$BookName'  , '$typebook' , '$StatusID' , '$Publish','" . $_FILES["ImageFile"]["name"] . "' , '$UnitPrice' , '$UnitRent' , '$DayAmount',NOW())";

$sql1 = "INSERT INTO book (BookID , BookName) VALUES ('" . $BookID . "' , '" . $BookName . "')";
$statement = $conn->query($sql);
if ($statement) {
    echo "<br><br><CENTER><H2>บันทึกข้อมูลเรียบร้อย</H2><BR><BR></CENTER>";
    echo "<CENTER><A HREF=\"listofbook.php\">แสดงข้อมูลทั้งหมด</A></CENTER>";
}
?>
