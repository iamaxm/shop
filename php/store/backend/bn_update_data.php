
<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    //connection
    include('../db.php');
    //รับค่า user & password

    $id =  $_SESSION["UserID"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        echo "<script>";
        echo "alert(\" กรุณากรอก username \");";
        echo "window.history.back()";
        echo "</script>";
    } else if (empty($password)) {
        echo "<script>";
        echo "alert(\" กรุณากรอก password \");";
        echo "window.history.back()";
        echo "</script>";
    } else {
        $sql = "UPDATE users SET  
        username='$username' ,
        password='$password'
        WHERE user_id='$id' ";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>";
            echo "alert(\" แก้ไขสำเร็จ\");";
            echo "window.location = '../index.php?id=user'; ";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert(\"แก้ไขไม่สำเร็จ\");";
            echo "window.location = '../index.php?id=user'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script>";
    echo "alert(\"มีค่าว่าง\");";
    echo "window.history.back()";
    echo "</script>";
}
