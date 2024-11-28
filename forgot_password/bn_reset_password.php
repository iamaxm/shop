<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include('../db.php');

if (isset($_POST["send"])) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aomjung2747@gmail.com';
    $mail->Password = 'kvmj etaa nvek mwiw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set sender
    $mail->setFrom('aomjung2747@gmail.com');

    // Add recipient
    $mail->addAddress($_POST["email"]);

    // Set email format to HTML
    $mail->isHTML(true);

    // Set email subject and body
    $mail->Subject = 'Your Password';
    $mail->Body = '';

    // Query database to get user information
    $email = mysqli_real_escape_string($conn, $_POST["email"]); // Escape email for security
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Now you can use $row to get user data, for example:
        $username = $row['username'];
        $password = $row['password'];
        // Add user information to email body
        $mail->Body .= "<p>Hello $username,</p><p>Your Password is : $password</p>";
    } else {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "ไม่พบอีเมลของคุณในระบบ",
            type: "warning", //success, warning, danger
            timer: 2000,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../index.php?id=login";
          });
    }, 500); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        exit(); // Stop further execution if user not found
    }

    // Send email
    if ($mail->send()) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "ส่งอีเมลสำเร็จ", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "กรุณาดูรหัสผ่านของคุณในกล่องข้อความ",
            type: "success", //success, warning, danger
            timer: 2000,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../index.php?id=login";
          });
    }, 500); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else {
        echo "<script>alert('Error: " . $mail->ErrorInfo . "');</script>";
    }
}
?>