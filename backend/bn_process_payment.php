<?php
// Include เพื่อเชื่อมต่อกับฐานข้อมูล
include('../db.php');

// ตรวจสอบว่ามีการล็อกอินเข้าสู่ระบบหรือไม่
session_start();
if (!isset($_SESSION['UserID'])) {
    // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้าล็อกอินหรือหน้าที่เหมาะสม
    header("Location: index.php?id=login");
    exit();
}

// รับค่า user_id จาก session
$user_id = $_SESSION['UserID'];

// ตรวจสอบการอัปโหลดไฟล์ slip
if (!empty($_FILES['slip']) && $_FILES['slip']['error'] == 0) {
    $slip = $_FILES['slip'];

    // ดึงข้อมูลที่อยู่จัดส่ง
    $address_sql = "SELECT * FROM address WHERE user_id = $user_id";
    $address_result = $conn->query($address_sql);
    $address_data = $address_result->fetch_assoc();

    // ตรวจสอบว่ามีที่อยู่ในระบบหรือไม่
    if (empty($address_data)) {
        echo '<h2 style="color: red; text-align: center;">กรุณากรอกที่อยู่ของคุณก่อนดำเนินการต่อ</h2>';
        exit(); // ออกจากการทำงานหากไม่มีที่อยู่
    }

    // ตรวจสอบขนาดของไฟล์
    $max_file_size = 10 * 1024 * 1024; // 10 MB (หรือค่าที่ต้องการ)
    if ($_FILES['slip']['size'] > $max_file_size) {
        echo "ขนาดของไฟล์ใหญ่เกินไป โปรดอัปโหลดไฟล์ที่มีขนาดไม่เกิน 10 MB";
        exit();
    }
    // ดึงข้อมูลสินค้าในตะกร้า
    $cart_sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result = $conn->query($cart_sql);

    $cart_items = []; // สร้างตัวแปรเพื่อเก็บรายการสินค้าในตะกร้า
    $total_price = 0; // กำหนดค่าเริ่มต้นให้ total_price เป็น 0

    while ($cart_row = $cart_result->fetch_assoc()) {
        $cart_items[] = $cart_row; // เพิ่มข้อมูลสินค้าลงในตัวแปร $cart_items
        $total_price += $cart_row['total_price']; // คำนวณยอดรวมราคาสินค้าทั้งหมด
    }

    // ดึงข้อมูลสินค้าในตะกร้าอีกครั้งหลังจากที่ใช้ $cart_result ในลูป while
    $cart_sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result = $conn->query($cart_sql);


    // ล้างค่าเคอร์เซอร์เพื่อเริ่มต้นที่ record แรก
    mysqli_data_seek($cart_result, 0);



    // ดำเนินการต่อเพื่ออัปโหลดรูปภาพและเพิ่มข้อมูลลงในฐานข้อมูล
    $numrand = mt_rand();
    $file_name = $slip['name'];
    $temp_name = $slip['tmp_name'];
    $img_folder = "../admin/slip_img/";
    $typefile = strrchr($file_name, ".");
    $newname = $numrand . $typefile;

    // อัปโหลดรูปภาพไปยังโฟลเดอร์ที่กำหนด
    if (move_uploaded_file($temp_name, $img_folder . $newname)) {
        // เพิ่มข้อมูลในตาราง orders

        // วันที่และเวลาปัจจุบัน (ในโซนเวลาของไทย)
        date_default_timezone_set('Asia/Bangkok');
        $order_date = date('Y-m-d H:i:s');
        $orderUpdate_status_date = date('Y-m-d H:i:s');


        // เพิ่มข้อมูลในตาราง orders
        $insert_order_sql = "INSERT INTO orders (user_id, total_amount, address, sub_district, district, province, zipcode, full_name, phone, status, slip, order_date, orderUpdate_status_date) 
        VALUES ('$user_id', '$total_price', '{$address_data['address']}', '{$address_data['sub_district']}', '{$address_data['district']}', '{$address_data['province']}', '{$address_data['zipcode']}', 
        '{$address_data['full_name']}', '{$address_data['phone']}', 'กำลังตรวจสอบสลิป','$newname', '$order_date', '$orderUpdate_status_date')";
        $conn->query($insert_order_sql);
        $order_id = $conn->insert_id; // รับค่า ID ของ order ที่เพิ่งสร้าง

        // เพิ่มข้อมูลสินค้าในตะกร้าลงในตาราง order_item
        while ($cart_row = $cart_result->fetch_assoc()) {
            $product_id = $cart_row['product_id'];
            $product_name = $conn->real_escape_string($cart_row['product_name']);
            $price = $cart_row['product_price'];
            $quantity = $cart_row['quantity'];
            $total = $cart_row['total_price'];
            $img = $cart_row['img'];

            // เพิ่มข้อมูลในตาราง order_item
            $insert_order_item_sql = "INSERT INTO order_item (order_id, user_id, product_name, product_id, price, quantity, total, img) VALUES ('$order_id', '$user_id', '$product_name','$product_id', '$price', '$quantity', '$total', '$img')";
            $conn->query($insert_order_item_sql);
        }

        // ลบข้อมูลในตะกร้าหลังจากที่ทำการสั่งซื้อเสร็จสิ้น
        $delete_cart_sql = "DELETE FROM cart WHERE user_id = $user_id";
        $conn->query($delete_cart_sql);

        // ทำการ redirect ไปยังหน้า home
        echo "<script>";
        echo "alert('สั่งซื้อเสร็จสิ้น! กรุณารอร้านค้าตรวจสอบสลิปโอนเงิน สามารถเช็กสถานะสินค้าได้ที่ สินค้าที่ต้องได้รับ');";
        echo "window.location='../index.php?id=home';";
        echo "</script>";
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
    }
} else {
    echo "<script>";
    echo "alert('กรุณาอัปโหลดสลิปโอนเงิน!');";
    echo "window.history.back();";
    echo "</script>";
}

$conn->close();
