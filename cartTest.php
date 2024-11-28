<?php
@session_start();
include('db.php');
$user_id = $_SESSION['UserID'];
@$limit = $_GET['limit'];
@$order_id = $_GET['order_id']; // เพิ่มการรับค่า order_id จากพารามิเตอร์ใน URL
$order_item_sql = "SELECT * FROM `order_item` WHERE user_id = $user_id";
$order_item_sql_sum = "SELECT * FROM `order_item` WHERE user_id = $user_id";

// ถ้ามีการรับค่า order_id มาให้แสดงเฉพาะสินค้าที่มี order_id ตามที่ระบุ
if (isset($order_id)) {
    $order_item_sql .= " AND order_id = $order_id";
}

$order_item_sql .= " ORDER BY order_id, order_item_id ASC"; // เพิ่ม ORDER BY เพื่อเรียงลำดับ

$result = $conn->query($order_item_sql);
$result_sum = $conn->query($order_item_sql_sum);

$order_total_amounts = array(); // เก็บราคารวมของแต่ละ order_id

$order_sql = "SELECT * FROM `orders` WHERE user_id = '$user_id'";
$order_result = $conn->query($order_sql);
$order_row = $order_result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้าที่ต้องได้รับ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-list {
            margin-top: 20px;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .product-image {
            flex: 0 0 100px;
            margin-right: 20px;
        }

        .product-image img {
            max-width: 100%;
            border-radius: 5px;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            color: #007bff;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .product-quantity {
            color: #28a745;
            font-weight: bold;
        }

        .product-status {
            margin-left: auto;
            color: #dc3545;
        }

        .btn-view-all {
            margin-bottom: 10px;
        }

        .btn-view-all.hide {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>รายการสินค้าที่ต้องได้รับ</h1>
        <?php
        // เพิ่มตัวแปรเพื่อเก็บ order_id ที่แสดงแล้ว
        $displayed_order_ids = array();
        ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <!-- ตรวจสอบว่า order_id ในแต่ละรายการสินค้าตรงกับ order_id ที่กำหนดใน URL หรือไม่ -->
            <?php if ($row['order_id'] == $order_id || $limit == 'all' || !in_array($row['order_id'], $displayed_order_ids)) : ?>
                <!-- ตรวจสอบและคำนวณราคารวมของสินค้า -->
                <?php
              

                $tm = $row['price'] * $row['quantity'];
                $t += $row['price']; // เพิ่มราคารวมของสินค้าลงใน order_id นี้
                
                // เพิ่ม order_id ลงใน array เมื่อแสดงรายการสินค้าแล้ว
                $displayed_order_ids[] = $row['order_id'];
                ?>
                <div class="product-list">
                    <!-- HTML code to display product details -->
                    <div class="product-item">
                        <div class="product-image">
                            <img src="admin/product_img/<?php echo $row['img']; ?>" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <div class="product-name"><?php echo $row['product_name']; ?></div>
                            <div class="product-price">ราคา : ฿<?php echo $row['price']; ?></div>
                            <div class="product-quantity">จำนวน : <?php echo $row['quantity']; ?> Kg.</div>
                            <!-- แสดงราคารวมของแต่ละ order_id -->
                            <?php if ($limit != 'all') : ?>
                                <?php while ($row_sum = $result_sum->fetch_assoc()) : 
                                $ts += $row_sum['price'];;
                                    ?>  
                                <div class="product-price">ราคารวม : ฿<?php echo $row_sum['product_name'],$ts;?></div>
                            
                            <?php endwhile ?>
                            
                            <?php endif; ?>
                            <!-- แสดงปุ่ม "ดูรายการสินค้าทั้งหมด" ที่เชื่อมโยงกับ order_id นั้น โดยใช้เงื่อนไขการแสดงด้วยตัวแปร $limit -->
                            <?php if ($limit != 'all') : ?>
                                <a href="index.php?id=product_received&order_id=<?php echo $row['order_id']; ?>&limit=all" class="btn btn-outline-info">ดูรายการสินค้าทั้งหมด</a>
                            <?php endif; ?>
                        </div>
                        <!-- แสดงสถานะของ order -->
                        <?php if ($limit != 'all') : ?>
                        <div class="product-status"><?php echo $order_row['status']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endif; ?>
        
        <?php endwhile ?>

        <?php echo $t; ?>
        <br>

    </div>
</body>

</html>
