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


    // เช็กค่าว่างของทุก input
    if (empty($full_name) || empty($phone) || empty($address) || empty($Sub_district) || empty($district) || empty($province) || empty($zipcode)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "กรุณากรอกข้อมูลให้ครบทุกช่อง!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            type: "warning", //success, warning, danger
           
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back(); //หน้าที่ต้องการให้กระโดดไป
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        exit();
    }



    // เช็กว่าผู้ใช้มีที่อยู่อยู่แล้วหรือไม่
    $sql_check_address = "SELECT * FROM address WHERE user_id = '$user_id'";
    $result_check_address = $conn->query($sql_check_address);

    if ($result_check_address->num_rows > 0) {
        // ถ้ามีที่อยู่อยู่แล้ว ให้อัปเดตที่อยู่นั้น
        $row = $result_check_address->fetch_assoc();
        $address_id = $row['address_id'];

        $sql_update_address = "UPDATE address SET full_name = '$full_name',
                                                phone = '$phone',
                                                address = '$address',
                                                Sub_district = '$Sub_district',
                                                district = '$district',
                                                province = '$province',
                                                zipcode = '$zipcode'
                                                WHERE address_id = '$address_id'";

        if ($conn->query($sql_update_address) === TRUE) {
            echo '<script>
    setTimeout(function() {
        swal({
            title: "สำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "อัปเดตที่อยู่สำเร็จ!",
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
            echo "Error updating address: " . $conn->error;
        }
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
