<?php
@session_start();
include('../db.php');

$cart_item_id = $_POST['cart_item_id'];




if(isset($_POST['remove_product']) && isset($_POST['cart_item_id'])) {
    $cart_id = $_POST['cart_item_id'];
    $user_id = $_SESSION['UserID'];
    
    // ลบสินค้าออกจากตะกร้าโดยใช้ cart_item_id และ user_id
    $sql = "DELETE FROM `cart` WHERE `cart_item_id` = $cart_item_id AND `user_id` = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        // ทำบางอย่างหลังจากลบสำเร็จ เช่น รีเดอร์เล็กชันหรือแสดงข้อความ
   
        // echo "<script>";
        // echo "alert(\"ลบสำเร็จ\");";
        header( "location: ../index.php?id=shopping_cart" );   // ส่งกลับไปยังหน้าตะกร้าหลังจากลบสำเร็จ
        // echo "</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>
