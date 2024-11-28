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
        echo "<script>";
        echo "alert('กรุณาเลือกสถานะการจัดส่ง!');";
        echo "window.history.back();"; // ย้อนกลับไปที่หน้าแก้ไขข้อมูล
        echo "</script>";
        exit();
    }

    // คำสั่ง SQL เพื่ออัปเดตสถานะในตาราง orders
    $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('อัปเดตสถานะจาก \'กำลังจัดส่งสินค้า\' เป็น \'จัดส่งสินค้าแล้ว\' เรียบร้อย!');";
        echo "window.location='../home_admin.php?admin=delivery';";
        echo "</script>";
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