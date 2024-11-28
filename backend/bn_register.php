<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
include('../db.php');
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
if (empty($username)) {
    echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกชื่อผู้ใช้!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';

    // echo "<script>";
    // echo "alert(\" กรุณากรอก username \");";
    // echo "window.history.back()";
    // echo "</script>";
} else if (empty($email)) {
    echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกอีเมล!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    // echo "<script>";
    // echo "alert(\" กรุณากรอก email \");";
    // echo "window.history.back()";
    // echo "</script>";
} else if (empty($password)) {
    echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกรหัสผ่าน!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    // echo "<script>";
    // echo "alert(\" กรุณากรอก password \");";
    // echo "window.history.back()";
    // echo "</script>";
} else if (empty($cpassword)) {
    echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกรหัสผ่านอีกครั้ง!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    // echo "<script>";
    // echo "alert(\" กรุณากรอก confirm password \");";
    // echo "window.history.back()";
    // echo "</script>";
} else {
    if (!preg_match('/@(gmail\.com|hotmail\.com)$/', $email)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "กรุณากรอกอีเมลที่เป็น @gmail.com หรือ @hotmail.com เท่านั้น!",
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert(\" กรุณากรอกอีเมลที่เป็น @gmail.com หรือ @hotmail.com เท่านั้น \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else if (strlen($password) < 5) { // เช็คความยาวของรหัสผ่าน
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร",
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert(\" รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) { // เช็คว่ามีทั้งตัวอักษรและตัวเลขหรือไม่
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "รหัสผ่านต้องประกอบด้วยตัวอักษรและตัวเลข",
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert(\" รหัสผ่านต้องประกอบด้วยตัวอักษรและตัวเลข \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else {
        if ($password == $cpassword) {
            // ตรวจสอบรหัสผ่านถูกต้องและดำเนินการต่อไป
            $sqli_email = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result_email = mysqli_query($conn, $sqli_email);

            $sqli_username = "SELECT * FROM `users` WHERE `username` = '$username'";
            $result_username = mysqli_query($conn, $sqli_username);

            if (mysqli_num_rows($result_email) > 0) {
                echo '<script>
    setTimeout(function() {
        swal({
            title: "เสียใจด้วย ;(", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "อีเมล ' . $email . ' มีผู้ใช้งานแล้ว",
            type: "error", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
                // echo "<script>";
                // echo "alert('Email $email มีผู้ใช้งานแล้ว');";
                // echo "window.location='../index.php?id=register';";
                // echo "</script>";
            } elseif (mysqli_num_rows($result_username) > 0) {
                echo '<script>
    setTimeout(function() {
        swal({
            title: "เสียใจด้วย ;(", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "ชื่อผู้ใช้ ' . $username . ' มีผู้ใช้งานแล้ว",
            type: "error", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
                // echo "<script>";
                // echo "alert('Username $username มีผู้ใช้งานแล้ว');";
                // echo "window.location='../index.php?id=register';";
                // echo "</script>";
            } else {
                $sql = "INSERT INTO `users`(`username`, `password`, `email`, `role`) VALUES ('$username','$password','$email','user')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<script>
    setTimeout(function() {
        swal({
            title: "ยินดีด้วย :)", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "สมัครสมาชิกสำเร็จ!",
            type: "success", //success, warning, danger
            timer:1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../index.php?id=login";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
                    // echo "<script>";
                    // echo "alert('สมัครสมาชิกสำเร็จ!');";
                    // echo "window.location='../index.php?id=login';";
                    // echo "</script>";
                    // header('Location: ../index.php?id=login'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo '<script>
    setTimeout(function() {
        swal({
            title: "รหัสผ่านไม่ตรงกัน!", 
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
            // echo "<script>";
            // echo "alert('รหัสผ่านไม่ตรงกัน');";
            // echo "window.history.back();";
            // echo "</script>";
        }
    }
}
// $con= mysqli_connect("localhost","root","","loginRegister_php") or die("Error: " . mysqli_error($con));
// mysqli_query($con, "SET NAMES 'utf8' "); 


$conn->close();
