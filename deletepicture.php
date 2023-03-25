<html>

<head>
    <title>แก้ไขข้อมูลหนังสือ</title>
</head>

<body>
    <?php
    $id = $_REQUEST['id'];
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";
    $conn = mysqli_connect($hostname, $username, $password, "bookstore");
    if (!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");


    mysqli_select_db($conn, $dbname) or die("ไม่สามารถเลือกฐานข้อมูล bookstore ได้");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");

    $sql = "SELECT * FROM book WHERE BookID = $id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    function ZZ($conn, $TypeID)
    {
        $sql = "SELECT * FROM typebook";
        $sql_query = $conn->query($sql);
        while ($row = mysqli_fetch_array($sql_query)) {
            if ($row['TypeID'] == $TypeID) {
                echo "<option value = " . $row['TypeID'] . " selected>" . "" . $row['TypeName'] . "</option>" . "<br>";
            } else {
                echo "<option value = " . $row['TypeID'] . ">" . "" . $row['TypeName'] . "</option>" . "<br>";
            }
        }
    }

    function AA($conn, $StatusID)
    {
        $sql = "SELECT * FROM statusbook";
        $sql_query = $conn->query($sql);
        while ($row = mysqli_fetch_array($sql_query)) {
            if ($row['StatusID'] == $StatusID) {
                echo "<option value = " . $row['StatusID'] . " selected>" . "" . $row['StausName'] . "</option>" . "<br>";
            } else {
                echo "<option value = " . $row['StatusID'] . ">" . "" . $row['StausName'] . "</option>" . "<br>";
            }
        }
    }
    ?>
    <form enctype="multipart/form-data" name="save" method="post" action="saveupdatebook.php">
        <BR><BR>
        <table width="650" border="1" bgcolor="#FFFFFF" align="center">
            <tr>
                <td colspan="6" bgcolor="#3399CC" align="center" height="21">
                    <b>: : แก้ไขข้อมูลหนังสือ : :</td>
            </tr>
            <tr>
                <td width="200">รหัสหนังสือ : </td>
                <td width="400">
                    <?php echo "<input type=\"hidden\" name=\"BookID\" value=\"$id\">" . $id; ?>
                </td>
            </tr>
            <tr>
                <td width="200">ชื่อหนังสือ :</td>
                <td><input type="text" name="BookName" size="50" maxlength="50" value="<?php echo $data['BookName']; ?>"></td>
            </tr>
            <tr>
                <td width="200">ประเภทหนังสือ :</td>
                <td> <select name="typebook" id="typebook">
                        <?php ZZ($conn, $data['TypeID']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="200">สถานะหนังสือ :</td>
                <td> <select name="StatusID" id="StatusID">
                        <?php AA($conn, $data['StatusID']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="200">สำนักงานพิมพ์ :</td>
                <td><input type="text" name="Publish" size="50" maxlength="50" value="<?php echo $data['Publish']; ?>"></td>
            </tr>

            <tr>
                <td width="200">ราคาที่ซื้อ :</td>
                <td><input type="text" name="UnitPrice" size="50" maxlength="50" value="<?php echo $data['UnitPrice']; ?>"></td>
            </tr>

            <tr>
                <td width="200">ราคาที่เช่า :</td>
                <td><input type="text" name="UnitRent" size="50" maxlength="50" value="<?php echo $data['UnitRent']; ?>"></td>
            </tr>

            <tr>
                <td width="200">จำนวนวันที่เช่า :</td>
                <td><input type="text" name="DayAmount" size="50" maxlength="50" value="<?php echo $data['DayAmount']; ?>"></td>
            </tr>


            <tr>
                <td width="200">รูปภาพ</td>
                <td>
                    <input type="hidden" name="max_size" value="50000">
                    <input type="file" name="ImageFile" size="30">
                    <BR>
                    <font size=2 color=#FF3300>นามสกุล .gif หรือ .jpg (เท่านั้น)</font>
                </td>
            </tr>

            <tr>
                <td colspan="6" align="center">
                    <input type="submit" name="submit" value="บันทึก">
                    <button type="submit" formaction="listofbook.php">ยกเลิก</button>

                    
                </td>
            </tr>
        </table>
    </form>
</body>

