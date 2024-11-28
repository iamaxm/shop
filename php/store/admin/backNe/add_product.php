<?php
include('db.php');
$product_type = $_POST['product_type'];
$product_name = $_POST['product_name'];
$product_detail = $_POST['product_detail'];
$product_price = $_POST['product_price'];
$img = $_POST['img'];

// echo $Product_type,'<br>',$Product_name,'<br>',$detell,'<br>',$totell,'<br>',$img;

        $sqli = "SELECT * FROM `products` WHERE `Product_name` = '$product_name'";

        $resultt = mysqli_query($conn,$sqli);
      
        if(mysqli_num_rows($resultt)==1){
            echo "<script>";
            echo "alert('$product_name มีรายชื่อสินค้านี้อยู่แล้ว');";
            echo "window.history.back()";
            echo "</script>";
        }else{
            $sql = "INSERT INTO `products`(`product_type`, `product_name`, `product_detail`, `product_price`, `img`) VALUES ('$product_type','$product_name','$product_detail','$product_price','$img')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>";
                echo "alert('บันทึกสินค้าสำเร็จ!');";
                echo "window.history.back()";
                echo "</script>";
                // header('Location: ../index.php?id=login'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
       


$conn->close();
