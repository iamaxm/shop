<?php
session_start();

if (isset($_POST['email_or_username'])) {
    // Connection
    include('../db.php');
    // Receive user & password
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    // Query
    $sql = "SELECT * FROM `users` WHERE (`email` = '$email_or_username' OR `username` = '$email_or_username') AND `password` ='$password'";
    $result = mysqli_query($conn, $sql);
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION["UserID"] = $row["user_id"];
        $_SESSION["User"] = $row["username"];
        $_SESSION["status"] = $row["role"];

        if ($_SESSION["status"] == "superadmin" || $_SESSION["status"] == "admin") {
            // If admin, redirect to admin page
            echo '<script>
    setTimeout(function() {
        swal({
            title: "ยินดีด้วย!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "เข้าสู่ระบบสำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../admin/home_admin.php?admin=dashboard";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
            exit(); // Terminate script after redirection
        } else if ($_SESSION["status"] == "user") {
            // If user, redirect to user page
            echo '<script>
    setTimeout(function() {
        swal({
            title: "ยินดีด้วย!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "เข้าสู่ระบบสำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../index.php?id=user";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
       
            // header("Location: ../index.php?id=user");
            exit(); // Terminate script after redirection
        } else {
            // Invalid role
            echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!",
            type: "warning", //success, warning, danger
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back();
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        //     echo '<script>
        //      setTimeout(function() {
        //       swal({
        //           title: "เกิดข้อผิดพลาด!",
        //           text: "Username หรือ Password ไม่ถูกต้อง!",
        //           type: "warning"
        //       }, function() {
        //         window.history.back(); //หน้าที่ต้องการให้กระโดดไป
        //       });
        //     }, 1000);
        // </script>';
            exit(); // Terminate script after output
        }
    } else {
        // Invalid credentials
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!",
            type: "warning", //success, warning, danger
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back();
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        exit(); // Terminate script after output
    }
} else {
    // Redirect to login form if email_or_username is not set

    header("Location: login.php");
    exit(); // Terminate script after redirection
}
