<?php
include('db.php');



// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
    $product_detail = $_POST['product_detail'];
    $product_price = $_POST['product_price'];
    
    // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
        // กำหนดตัวแปรสำหรับการอัปโหลดรูปภาพ
        $numrand = (mt_rand());
        $file_name = $_FILES["img"]["name"];
        $temp_name = $_FILES["img"]["tmp_name"];
        $img_folder = "../product_img/";
        $typefile = strrchr( $file_name,".");
        $newname = $numrand.$typefile;
        echo $newname;
        
        // อัปโหลดรูปภาพไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($temp_name, $img_folder.$newname)) {
            // เพิ่มข้อมูลสินค้าในฐานข้อมูล
            $sql = "INSERT INTO products (product_type, product_name, product_detail, product_price, img) VALUES ('$product_type','$product_name','$product_detail','$product_price','$newname')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>";
                echo "alert('บันทึกสินค้าสำเร็จ!');";
                echo "window.history.back()";
                echo "</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
        }
    } else {
        echo "กรุณาเลือกรูปภาพ";
    }
}
$conn->close();

?>