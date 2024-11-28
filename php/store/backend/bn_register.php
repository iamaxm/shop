<?php
include('../db.php');
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
if (empty($username)) {
    echo "<script>";
    echo "alert(\" กรุณากรอก username \");";
    echo "window.history.back()";
    echo "</script>";
}else if (empty($email)) {
    echo "<script>";
    echo "alert(\" กรุณากรอก email \");";
    echo "window.history.back()";
    echo "</script>";
}
else if (empty($password)){
    echo "<script>";
    echo "alert(\" กรุณากรอก password \");";
    echo "window.history.back()";
    echo "</script>";
}
else if (empty($cpassword)){
    echo "<script>";
    echo "alert(\" กรุณากรอก confirm password \");";
    echo "window.history.back()";
    echo "</script>";
}
 else {
    if ($password == $cpassword) {
        $sqli = "SELECT * FROM `users` WHERE `email` = '$email'";

        $resultt = mysqli_query($conn,$sqli);
      
        if(mysqli_num_rows($resultt)==1){
            echo "<script>";
            echo "alert('$email มีผู้ใช้งานแล้ว');";
            echo "window.location='../index.php?id=register';";
            echo "</script>";
        }else{
            $sql = "INSERT INTO `users`(`username`, `password`, `email`, `role`) VALUES ('$username','$password','$email','user')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>";
                echo "alert('Registration successful!');";
                echo "window.location='../index.php?id=login';";
                echo "</script>";
                // header('Location: ../index.php?id=login'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
       
    }else {
        echo "<script>";
        echo "alert('รหัสผ่านไม่ตรงกัน');";
        echo "window.location='../index.php?id=register';";
        echo "</script>";
    }
 
}
// $con= mysqli_connect("localhost","root","","loginRegister_php") or die("Error: " . mysqli_error($con));
// mysqli_query($con, "SET NAMES 'utf8' "); 


$conn->close();
