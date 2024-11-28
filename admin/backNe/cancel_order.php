<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
// เชื่อมต่อกับฐานข้อมูล
include('db.php');

// ตรวจสอบว่ามีการส่งค่า order_id มาหรือไม่
if(isset($_GET['order_id'])) {
    // รับค่า order_id ที่ส่งมาจาก URL
    $order_id = $_GET['order_id'];

    // เขียนคำสั่ง SQL สำหรับลบข้อมูลในตาราง order_item
    $sql_order_item = "DELETE FROM order_item WHERE order_id = '$order_id'";

    // เขียนคำสั่ง SQL สำหรับลบข้อมูลในตาราง orders
    $sql_order = "DELETE FROM orders WHERE order_id = '$order_id'";

    // ทำการลบข้อมูลในตาราง order_item
    if(mysqli_query($conn, $sql_order_item) && mysqli_query($conn, $sql_order)) {
        // ถ้าลบสำเร็จ ให้แสดงข้อความและ redirect ไปยังหน้าที่ต้องการ
        echo '<script>
    setTimeout(function() {
        swal({
            title: "สำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "ยกเลิกคำสั่งซื้อสำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../home_admin.php?admin=order";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
        // echo "<script>";
        // echo "alert(\"ยกเลิกคำสั่งซื้อสำเร็จ\");";
        // echo "window.location='../home_admin.php?admin=order';";
        // echo "</script>";
        exit;
    } else {
        // ถ้าเกิดข้อผิดพลาดในการลบ
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    // หากไม่มีการส่งค่า order_id มา
    echo "ไม่พบรหัสคำสั่งซื้อที่ต้องการยกเลิก";
}
?>

