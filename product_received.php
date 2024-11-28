<?php
@session_start();
include('db.php');
@$user_id = $_SESSION['UserID'];
@$limit = $_GET['limit'];
@$order_id = $_GET['order_id']; // เพิ่มการรับค่า order_id จากพารามิเตอร์ใน URL
@$status = $_GET['status'];

@$status_allProduct = $_GET['status_allProduct'];
// SELECT * FROM `order_item` INNER JOIN `orders` ON orders.order_id = order_item.order_id WHERE  `order_item`.user_id = '16'  AND `order_item`.order_id = '1' AND orders.status = 'กำลังจัดส่งสินค้า'
// ถ้ามีการรับค่า order_id มาให้แสดงเฉพาะสินค้าที่มี order_id ตามที่ระบุ
if ($order_id == '') {

    $order_item_sql = "SELECT * FROM `order_item` INNER JOIN `orders` ON orders.order_id = order_item.order_id WHERE  `order_item`.user_id = '$user_id'  AND orders.status = '$status' ORDER BY orderUpdate_status_date ASC";
    $result = $conn->query($order_item_sql);

    if($status_allProduct == "all") {
    $order_item_sql = "SELECT * FROM `order_item` INNER JOIN `orders` ON orders.order_id = order_item.order_id WHERE `order_item`.user_id = '$user_id' AND NOT orders.status = 'ได้รับสินค้าแล้ว'";
    $result = $conn->query($order_item_sql);
    }
} else {

    $order_item_sql = "SELECT * FROM `order_item` INNER JOIN `orders` ON orders.order_id = order_item.order_id WHERE `order_item`.user_id = '$user_id' AND `order_item`.order_id = '$order_id'";
    $result = $conn->query($order_item_sql);
}


$order_total_amounts = array(); // เก็บราคารวมของแต่ละ order_id

$order_sql = "SELECT * FROM `orders` INNER JOIN order_item ON orders.order_id = order_item.order_id WHERE orders.user_id = '$user_id' and orders.status = '$status'";
$order_result = $conn->query($order_sql);
$order_row = $order_result->fetch_assoc();


// product_type = all = vegetable = fruit

// $status_order = isset($_GET['status']) ? $_GET['status'] : "";

// $status_order_sql = "SELECT * FROM `orders`";

// // Append WHERE clause if product type is provided
// if (!empty($status_order_sql)) {
//     $status_order_sql .= " WHERE `status` = '$status_order'";
// }
// $status_order_sql_result = $conn->query($status_order_sql);

?>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1100px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container_ {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 20px;

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

    .btn-view-all {
        margin-bottom: 10px;
    }

    .btn-view-all.hide {
        display: none;
    }
    .slip-checking-status {
        margin-left: auto;
        color: #dc3545; /* กำหนดสีเป็นแดง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'กำลังจัดส่งสินค้า' */
    .shipping-status {
        margin-left: auto;
        color: #FF8C00; /* กำหนดสีเป็นแดง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'จัดส่งสินค้าแล้ว' */
    .shipped-status {
        margin-left: auto;
        color: #ffca28; /* กำหนดสีเป็นเหลือง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'ได้รับสินค้าแล้ว' */
    .received-status {
        margin-left: auto;
        color: green; /* กำหนดสีเป็นเขียว */
    }
</style>

<div>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?id=user" style="color:black"><i class="bi bi-arrow-left" style="font-size: 30px;"></i></a>
</div>


<div class="container_">
    <center>
        <h1>รายการสินค้าที่ต้องได้รับ</h1>
    </center>
    <div>
        <br>
        <center>

            <div class="col-lg-8 text-end">
                <ul class="nav nav-pills d-inline-flex text-center mb-5">
                <ul class="nav nav-pills d-inline-flex text-center mb-5">
                    <li class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-infinity" viewBox="0 0 16 16">
  <path d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916z"/>
</svg>
                            <a class="" data-bs-toggle="pill">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=product_received&status_allProduct=all" ><span class="text-dark" style="width: 110px;">สินค้าทั้งหมด</span></a>
                            </a>

                        </li>
                    <li class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                        </svg>
                        <a class="" data-bs-toggle="pill">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=product_received&status=กำลังตรวจสอบสลิป"><span class="text-dark" style="width: 110px;">ที่ต้องชำระ</span></a>
                        </a>

                    </li>
                    <li class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box2-heart" viewBox="0 0 16 16">
                            <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982" />
                            <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z" />
                        </svg>
                        <a class="" data-bs-toggle="pill">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=product_received&status=กำลังจัดส่งสินค้า"><span class="text-dark" style="width: 110px;">ที่ต้องจัดส่ง</span></a>
                        </a>
                    </li>
                    <li class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                            <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276" />
                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z" />
                        </svg>
                        <a class="" data-bs-toggle="pill">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=product_received&status=จัดส่งสินค้าแล้ว"><span class="text-dark" style="width: 110px;">ที่ต้องได้รับ</span></a>
                        </a>
                    </li>
                    <li class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z" />
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                        </svg>
                        <a class="" data-bs-toggle="pill">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=product_received&status=ได้รับสินค้าแล้ว"><span class="text-dark" style="width: 110px;">ที่ได้รับแล้ว</span></a>
                        </a>
                    </li>
                </ul>
            </div>

        </center>
    </div>



    <?php
    // เพิ่มตัวแปรเพื่อเก็บ order_id ที่แสดงแล้ว
    $displayed_order_ids = array();
    ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <!-- ตรวจสอบว่า order_id ในแต่ละรายการสินค้าตรงกับ order_id ที่กำหนดใน URL หรือไม่ -->
        <?php if ($row['order_id'] == $order_id || $limit == 'all' || !in_array($row['order_id'], $displayed_order_ids)) : ?>
            <!-- ตรวจสอบและคำนวณราคารวมของสินค้า -->
            <?php
            // ตรวจสอบว่า order_id นี้มีการเริ่มคำนวณราคารวมหรือยัง
            if (!isset($order_total_amounts[$row['order_id']])) {
                $order_total_amounts[$row['order_id']] = 0; // กำหนดให้ราคารวมเริ่มต้นเป็น 0
            }

            // คำนวณราคารวมของสินค้าแต่ละรายการ
            $total_amount = $row['price'] * $row['quantity'];
            $order_total_amounts[$row['order_id']] += $total_amount; // เพิ่มราคารวมของสินค้าลงใน order_id นี้

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
                        <div class="product-price">ราคารวม : ฿<?php echo $row['total']; ?></div>
                        <!-- แสดงราคารวมของแต่ละ order_id -->


                        <!-- แสดงปุ่ม "ดูรายการสินค้าทั้งหมด" ที่เชื่อมโยงกับ order_id นั้น โดยใช้เงื่อนไขการแสดงด้วยตัวแปร $limit -->
                        <?php if ($limit != 'all') : ?>
                            <a href="index.php?id=product_received&order_id=<?php echo $row['order_id']; ?>&limit=all" class="btn btn-outline-info">ดูรายการสินค้าทั้งหมด</a>
                        <?php endif; ?>
                    </div>

                    <div class="product-status <?php echo $row['status'] == 'กำลังตรวจสอบสลิป' ? 'slip-checking-status' : ($row['status'] == 'กำลังจัดส่งสินค้า' ? 'shipping-status' : ($row['status'] == 'จัดส่งสินค้าแล้ว' ? 'shipped-status' : 'received-status')); ?>">
    <?php echo $row['status']; ?>

                        <?php if ($row['status'] == 'จัดส่งสินค้าแล้ว') { ?> <br><br>
                          
                            <center>
                                <form action="backend/bn_complete_status.php" method="post">
                                    <input hidden id="order_id" name="order_id" value="<?php echo $row['order_id']; ?>">
                                    <button type="submit" id="status" name="status" class="btn rounded-pill btn-outline-primary" style="font-size: 13px;">ได้รับสินค้าแล้ว</button>
                                </form>
                            </center>
                        <?php } else if ($row['status'] == 'ได้รับสินค้าแล้ว') { ?>
                            <style>
                                .product-status {
                                    margin-left: auto;
                                    color: green;
                                }
                            </style>
                            <br><span class="badge bg-success"><?php echo $row['orderUpdate_status_date']; ?></span>
                        <?php } ?>
                    </div>


                </div>
            </div>

        <?php endif; ?>
    <?php endwhile ?>
    <br>

    <?php
    // ตรวจสอบว่ามีการส่งค่า order_id มาหรือไม่

    if (isset($order_id)) {
        // ตรวจสอบว่ามีค่าราคารวมของ order_id นี้หรือไม่
        if (isset($order_total_amounts[$order_id])) {
            echo "<h3>รวมการสั่งซื้อทั้งหมด: ฿" . $order_total_amounts[$order_id] . "</h3>";
        } else {
            echo "<h3>ไม่พบข้อมูลการสั่งซื้อสำหรับ Order ID: $order_id</h3>";
        }
    }
    ?>
</div>