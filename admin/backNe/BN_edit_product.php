<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
// เรียกใช้ session_start() ที่บรรทัดแรกของไฟล์
@session_start();

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มแก้ไขหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เชื่อมต่อกับฐานข้อมูล
    include('db.php');

    // รับค่าที่ส่งมาจากฟอร์ม
    $product_id = $_POST['product_id'];
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
    $product_detail = $_POST['product_detail'];
    $product_price = $_POST['product_price'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
        // กำหนดตัวแปรสำหรับการอัปโหลดรูปภาพ
        $file_name = $_FILES["img"]["name"];
        $temp_name = $_FILES["img"]["tmp_name"];
        $img_folder = "../product_img/";
        $typefile = strrchr($file_name, ".");
        $newname = uniqid() . $typefile;

        // อัปโหลดรูปภาพไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($temp_name, $img_folder . $newname)) {
            // อัปเดตชื่อไฟล์รูปภาพในฐานข้อมูล
            $update_sql = "UPDATE products SET  
                product_type='$product_type',
                product_name='$product_name',
                product_detail='$product_detail',
                product_price='$product_price',
                img='$newname'
                WHERE product_id='$product_id'";

            $update_result = mysqli_query($conn, $update_sql);
            if ($update_result) {
                echo '<script>
    setTimeout(function() {
        swal({
            title: "ยินดีด้วย :)", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "อัปเดตข้อมูลและอัปโหลดรูปภาพสำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../home_admin.php?admin=product";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
                // echo "<script>";
                // echo "alert(\"อัปเดตข้อมูลและอัปโหลดรูปภาพสำเร็จ\");";
                // echo "window.location='../home_admin.php?admin=product';";
                // echo "</script>";
            } else {
                echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
        }
    } else {
        // กรณีที่ไม่มีการเลือกรูปภาพใหม่ ให้ทำการอัปเดตข้อมูลสินค้าตามปกติโดยไม่เปลี่ยนแปลงรูปภาพ
        $update_sql = "UPDATE products SET  
            product_type='$product_type',
            product_name='$product_name',
            product_detail='$product_detail',
            product_price='$product_price'
            WHERE product_id='$product_id'";

        $update_result = mysqli_query($conn, $update_sql);
        if ($update_result) {
            echo '<script>
    setTimeout(function() {
        swal({
            title: "ยินดีด้วย :)", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
            text: "อัปเดตข้อมูลสำเร็จ!",
            type: "success", //success, warning, danger
            timer: 1500,
            showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function() {
            window.location.href = "../home_admin.php?admin=product";
          });
    }, 100); // ใส่เวลาที่ต้องการให้ฟังก์ชันทำงาน (1500 มิลลิวินาที = 1.5 วินาที)
    </script>';
            // echo "<script>";
            // echo "alert(\"อัปเดตข้อมูลสำเร็จ\");";
            // echo "window.location='../home_admin.php?admin=product';";
            // echo "</script>";
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
        }
    }
}
?>