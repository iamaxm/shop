<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
// เชื่อมต่อกับฐานข้อมูล
include('db.php');

// ตรวจสอบว่ามีการส่งค่า product_id มาหรือไม่
if(isset($_GET['user_id'])) {
    // รับค่า product_id ที่ส่งมาจากฟอร์ม
    $user_id = $_GET['user_id'];

    // เขียนคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM users WHERE user_id = '$user_id'";

    // ทำการลบข้อมูล;
    if(mysqli_query($conn, $sql)) {
        // ถ้าลบสำเร็จ ให้ redirect 
        echo '<script>
        setTimeout(function() {
            swal({
                title: "สำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                text: "ลบสมาชิกสำเร็จ!",
                type: "success", //success, warning, danger
                timer: 1500,
                showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
            }, function() {
                window.location.href = "../home_admin.php?admin=all_member";
              });
        }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
        </script>';
        // echo "<script>";
        // echo "alert(\"ลบสำเร็จ\");";
        // echo "window.location='../home_admin.php?admin=all_member';";
        // echo "</script>";

        exit;
    } else {
        // ถ้าเกิดข้อผิดพลาดในการลบ
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    // หากไม่มีการส่งค่า product_id มา
    echo "ไม่พบรหัสสมาชิกที่ต้องการลบ";
}
?>
