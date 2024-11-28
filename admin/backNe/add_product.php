<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<?php
include('db.php');

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $product_type = $_POST['product_type'];
    $product_name = $_POST['product_name'];
    $product_detail = $_POST['product_detail'];
    $product_price = $_POST['product_price'];
    if (empty($product_type)) {
        echo '<script>
            setTimeout(function() {
                swal({
                        title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                        text: "กรุณาเลือกประเภทสินค้า!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                        type: "warning", //success, warning, danger
                        
                        showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                    }, function(){
                        window.history.back();
                    });
                }, 100); 
        </script>';
        // echo "<script>";
        // echo "alert(\" กรุณาเลือกประเภทสินค้า \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else if (empty($product_name)) {
        echo '<script>
            setTimeout(function() {
                swal({
                        title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                        text: "กรุณากรอกชื่อสินค้า!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                        type: "warning", //success, warning, danger
                        
                        showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                    }, function(){
                        window.history.back();
                    });
                }, 100); 
        </script>';
        // echo "<script>";
        // echo "alert(\" กรุณากรอกชื่อสินค้า \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else if (empty($product_detail)) {
        echo '<script>
            setTimeout(function() {
                swal({
                        title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                        text: "กรุณากรอกรายละเอียดสินค้า!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                        type: "warning", //success, warning, danger
                        
                        showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                    }, function(){
                        window.history.back();
                    });
                }, 100); 
        </script>';
        // echo "<script>";
        // echo "alert(\" กรุณากรอกรายละเอียดสินค้า \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else if (empty($product_price)) {
        echo '<script>
        setTimeout(function() {
            swal({
                    title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                    text: "กรุณากรอกราคาสินค้า!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                    type: "warning", //success, warning, danger
                    
                    showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                }, function(){
                    window.history.back();
                });
            }, 100); 
    </script>';
        // echo "<script>";
        // echo "alert(\" กรุณากรอกราคาสินค้า \");";
        // echo "window.history.back()";
        // echo "</script>";
    } else {
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
            // กำหนดตัวแปรสำหรับการอัปโหลดรูปภาพ
            $numrand = (mt_rand());
            $file_name = $_FILES["img"]["name"];
            $temp_name = $_FILES["img"]["tmp_name"];
            $img_folder = "../product_img/";
            $typefile = strrchr($file_name, ".");
            $newname = $numrand . $typefile;

            // ตรวจสอบว่ามีชื่อสินค้าซ้ำหรือไม่
            $sql_check = "SELECT * FROM `products` WHERE `product_name` = '$product_name'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                // ถ้ามีสินค้าซ้ำ
                echo '<script>
        setTimeout(function() {
            swal({
                    title: "เสียใจด้วย ;(", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                    text: "มีสินค้านี้ในระบบแล้ว!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                    type: "error", //success, warning, danger
                    
                    showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                }, function(){
                    window.history.back();
                });
            }, 100); 
    </script>';
                // echo "<script>";
                // echo "alert('มีสินค้านี้ในระบบแล้ว!');";
                // echo "window.history.back()";
                // echo "</script>";
            } else {
                // ถ้าไม่มีสินค้าซ้ำ
                // อัปโหลดรูปภาพไปยังโฟลเดอร์ที่กำหนด
                if (move_uploaded_file($temp_name, $img_folder . $newname)) {
                    // ทำการ INSERT เข้าฐานข้อมูล
                    $sql_insert = "INSERT INTO `products`(`product_type`, `product_name`, `product_detail`, `product_price`, `img`) VALUES ('$product_type','$product_name','$product_detail','$product_price','$newname')";
                    $result_insert = mysqli_query($conn, $sql_insert);

                    if ($result_insert) {
                        echo '<script>
            setTimeout(function() {
                swal({
                        title: "สำเร็จ!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                        text: "บันทึกสินค้าสำเร็จ!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                        type: "success", //success, warning, danger
                        timer: 1500, //ระยะเวลา redirect 3000 = 3 วิ เพิ่มลดได้
                        showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                    }, function(){
                        window.location.href = "../home_admin.php?admin=product"; //หน้าเพจที่เราต้องการให้ redirect ไป อาจใส่เป็นชื่อไฟล์ภายในโปรเจคเราก็ได้ครับ เช่น admin.php
                    });
                }, 100); 
        </script>';
                        // echo "<script>";
                        // echo "alert('บันทึกสินค้าสำเร็จ!');";
                        // echo "window.location='../home_admin.php?admin=product';";
                        // echo "</script>";
                    } else {
                        echo "Error: " . $sql_insert . "<br>" . $conn->error;
                    }
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
                }
            }
        } else {
            echo '<script>
        setTimeout(function() {
            swal({
                    title: "เกิดข้อผิดพลาด!", //ข้อความ เปลี่ยนได้ เช่น บันทึกข้อมูลสำเร็จ!!
                    text: "กรุณาเลือกรูปภาพ!", //ข้อความเปลี่ยนได้ตามการใช้งาน
                    type: "warning", //success, warning, danger
                    
                    showConfirmButton: true //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
                }, function(){
                    window.history.back();
                });
            }, 100); 
    </script>';
            // echo "<script>";
            // echo "alert('กรุณาเลือกรูปภาพ!');";
            // echo "window.history.back()";
            // echo "</script>";
        }
    }
} else {
}
$conn->close();
