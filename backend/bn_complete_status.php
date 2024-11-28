<?php

session_start();

include('../db.php');
$user_id = $_SESSION['UserID'];
$order_id = $_POST['order_id'];
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล

    $orders_sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result_orders = $conn->query($orders_sql);

    $orders_row = $result_orders->fetch_assoc();



    // รับค่าสถานะที่ส่งมาจากฟอร์ม
    $status = "ได้รับสินค้าแล้ว";


    date_default_timezone_set('Asia/Bangkok');
    // รับค่าวันที่และเวลาปัจจุบัน
    $orderUpdate_status_date = date('Y-m-d H:i:s');
    // คำสั่ง SQL เพื่ออัปเดตสถานะในตาราง orders
    $sql = "UPDATE orders SET status = '$status',
    orderUpdate_status_date = '$orderUpdate_status_date'
     WHERE order_id = '$order_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('สำเร็จ!');";
        echo "window.location='../index.php?id=product_received&status=ได้รับสินค้าแล้ว';";
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
