<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
@session_start();
// เชื่อมต่อกับฐานข้อมูล
include('../db.php');
$user_id = $_SESSION['UserID'];

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์ม
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $Sub_district = $_POST['Sub_district'];
    $district = $_POST['district'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];

    if (empty($full_name)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกชื่อผู้รับสินค้า!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else if (empty($phone) || strlen($phone) != 10) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เบอร์โทรศัพท์ไม่ถูกต้อง!",
            text: "กรุณากรอกเบอร์โทรศัพท์ที่มีจำนวน 10 ตัวเท่านั้น",
            type: "warning",
            showConfirmButton: true
        }, function() {
            window.history.back();
          });
    }, 100);
    </script>';
    } else if (empty($address)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกบ้านเลขที่!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else if (empty($Sub_district)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกตำบล!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else if (empty($district)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกอำเภอ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else if (empty($province)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกจังหวัด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
    } else if (empty($zipcode) || strlen($zipcode) != 5) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "รหัสไปรษณีย์ไม่ถูกต้อง!",
            text: "กรุณากรอกรหัสไปรษณีย์ที่มีจำนวน 5 หลัก",
                type: "warning", //success, warning, danger
               
                showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
            }, function() {
                window.history.back(); //หน้าที่ต้องการให้กระโดดไป
              });
        }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
        </script>';
    } else {

        // กำหนดโซนเวลาเป็นไทย
        date_default_timezone_set('Asia/Bangkok');

        // รับค่าวันที่และเวลาปัจจุบัน
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO address (user_id, full_name, phone, address, Sub_district, district, province, zipcode, created_at, updated_at) VALUES ('$user_id','$full_name','$phone', '$address', '$Sub_district', '$district', '$province', '$zipcode', '$created_at', '$updated_at')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>
    setTimeout(function() {
        swal({
            title: "สำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "เพิ่มที่อยู่สำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../index.php?id=show_address";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
            exit();
        } else {
            echo "Error adding address: " . $conn->error;
        }
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
