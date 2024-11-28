<?php
// เชื่อมต่อกับฐานข้อมูล
include('db.php');

// ตรวจสอบว่ามีการส่งค่า product_id มาหรือไม่
if(isset($_POST['product_id'])) {
    // รับค่า product_id ที่ส่งมาจากฟอร์ม
    $product_id = $_POST['product_id'];

    // เขียนคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM products WHERE product_id = '$product_id'";

    // ทำการลบข้อมูล;
    if(mysqli_query($conn, $sql)) {
        // ถ้าลบสำเร็จ ให้ redirect 
        
        echo "<script>";
        echo "alert(\"ลบสำเร็จ\");";
        echo "window.location='../home_admin.php?admin=product';";
        echo "</script>";

        exit;
    } else {
        // ถ้าเกิดข้อผิดพลาดในการลบ
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    // หากไม่มีการส่งค่า product_id มา
    echo "ไม่พบรหัสสินค้าที่ต้องการลบ";
}
?>
