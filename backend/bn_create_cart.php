<?php
include('../db.php');
session_start();

// ตรวจสอบว่ามีการล็อกอินเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['UserID'])) {
    // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้าล็อกอินหรือหน้าที่เหมาะสม
    header("Location: ../index.php?id=login");
    exit();
}

// รับข้อมูลสินค้าจากฟอร์ม
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = $_POST['quantity'];
$img = $_POST['img'];

// คำนวณราคารวม
$total_price = $product_price * $quantity;

// รับ user_id จาก session หรือจากการล็อกอิน
$user_id = $_SESSION['UserID'];

// ตรวจสอบว่ามีสินค้าที่มีชื่อเหมือนกันอยู่ในตะกร้าของผู้ใช้แล้วหรือไม่
$check_duplicate_sql = "SELECT COUNT(*) AS num_duplicates FROM cart WHERE user_id = '$user_id' AND product_name = '$product_name'";
$result = $conn->query($check_duplicate_sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $num_duplicates = $row['num_duplicates'];

    if ($num_duplicates > 0) {
        // ถ้ามีสินค้าที่มีชื่อเหมือนกันอยู่ในตะกร้าแล้ว ให้แจ้งเตือนว่าสินค้านี้มีอยู่ในตะกร้าของคุณแล้ว
        echo "<script>";
        echo "alert('สินค้านี้มีอยู่ในตะกร้าของคุณแล้ว!');";
        echo "window.location='../index.php?id=user';";
        echo "</script>";
        exit();
    }
}

// เพิ่มข้อมูลลงในตาราง cart ในฐานข้อมูล
$sql = "INSERT INTO cart (product_id, user_id, product_name, product_price, quantity, total_price, img, status) 
        VALUES ('$product_id', '$user_id', '$product_name', '$product_price', '$quantity', '$total_price', '$img', 'รอชำระเงิน')";

if ($conn->query($sql) === TRUE) {
    // ถ้าบันทึกข้อมูลสำเร็จให้ redirect กลับไปยังหน้าสินค้า
    echo "<script>";
    // echo "alert('เพิ่มลงตะกร้าสำเร็จ!');";
    echo "window.location='../index.php?id=user';";
    echo "</script>";
    exit();
} else {
    // ถ้ามีข้อผิดพลาดในการบันทึกข้อมูลให้แสดงข้อความข้อผิดพลาด
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
