<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php

session_start();

include('db.php');
$user_id = $_SESSION['UserID'];
$order_id = $_POST['order_id'];
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล

    $orders_sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result_orders = $conn->query($orders_sql);

    $orders_row = $result_orders->fetch_assoc();



    // รับค่าสถานะที่ส่งมาจากฟอร์ม
    $status = $_POST["status"];
    if (empty($status)) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "กรุณาเลือกสถานะการจัดส่ง!",
            type: "warning", //success, warning, danger
            showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.history.back();
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert('กรุณาเลือกสถานะการจัดส่ง!');";
        // echo "window.history.back();"; // ย้อนกลับไปที่หน้าแก้ไขข้อมูล
        // echo "</script>";
        exit();
    }

    date_default_timezone_set('Asia/Bangkok');
    // รับค่าวันที่และเวลาปัจจุบัน
    $orderUpdate_status_date = date('Y-m-d H:i:s');
    // คำสั่ง SQL เพื่ออัปเดตสถานะในตาราง orders
    $sql = "UPDATE orders SET status = '$status',
    orderUpdate_status_date = '$orderUpdate_status_date'
     WHERE order_id = '$order_id'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
    setTimeout(function() {
        swal({
            title: "อัปเดตสถานะสำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "อัปเดตสถานะจาก \'กำลังตรวจสอบสลิป\' เป็น \'กำลังจัดส่งสินค้า\' เรียบร้อย!",
            type: "success", //success, warning, danger
            timer: 3000,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../home_admin.php?admin=order";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert('อัปเดตสถานะจาก \'กำลังตรวจสอบสลิป\' เป็น \'กำลังจัดส่งสินค้า\' เรียบร้อย!');";
        // echo "window.location='../home_admin.php?admin=order';";
        // echo "</script>";
        exit();
    } else {
        echo "<script>";
        echo "Error updating record: " . $conn->error;
        echo "window.history.back();"; // ย้อนกลับไปที่หน้าแก้ไขข้อมูล
        echo "</script>";
        exit();
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
?>