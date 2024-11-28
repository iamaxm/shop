<?php
@session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];

$order_sql = "SELECT * FROM orders WHERE status != 'ได้รับสินค้าแล้ว';";
$order_result = $conn->query($order_sql);
$No = 1;
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 2000px;
        margin: 2rem auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }

    th,
    td {
        border: none;
        padding: 8px;
        text-align: fixed;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 25px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        z-index: 150;
        max-width: 20%;
        max-height: 100%;
        overflow: auto;
        text-align: auto;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 25px;
        cursor: pointer;
        color: #333;
        margin: -3px;
    }

    .popup img {
        max-width: 100%;
        max-height: 100%;
        margin: auto;
        display: auto;
    }

    .slip-checking-status {
        margin-left: auto;
        color: #dc3545;
        /* กำหนดสีเป็นแดง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'กำลังจัดส่งสินค้า' */
    .shipping-status {
        margin-left: auto;
        color: #FF8C00;
        /* กำหนดสีเป็นแดง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'จัดส่งสินค้าแล้ว' */
    .shipped-status {
        margin-left: auto;
        color: #ffca28;
        /* กำหนดสีเป็นเหลือง */
    }

    /* เพิ่มหรือแก้ไข CSS class สำหรับสถานะ 'ได้รับสินค้าแล้ว' */
    .received-status {
        margin-left: auto;
        color: green;
        /* กำหนดสีเป็นเขียว */
    }
</style>
</head>

<body>
    <div class="card mt-5" style="padding-top:3rem; margin:2rem 2rem;">
        <h1>รายการคำสั่งซื้อทั้งหมด</h1>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th style="font-size: 16px;">ลำดับ</th>
                        <th style="font-size: 16px;">
                            <center>order_id</center>
                        </th>
                        <th style="font-size: 16px;">user_id (ของผู้สั่งซื้อ)</th>
                        <th style="font-size: 16px;">ชื่อผู้สั่งซื้อ</th>
                        <th style="font-size: 16px;">รายการคำสั่งซื้อ</th>
                        <th style="font-size: 16px;">ราคารวมทั้งหมด</th>
                        <th style="font-size: 16px;">สถานะการจัดส่ง</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order_row = $order_result->fetch_assoc()) : ?>
                        <tr>
                            <th scope="row"><?php echo number_format($No); ?></th>
                            <td style="text-align: center;"><?php echo $order_row['order_id']; ?></td>
                            <td style="text-align: center;"><?php echo $order_row['user_id']; ?></td>
                            <td><?php echo $order_row['full_name']; ?></td>
                            <td>
                                <div class="mt-3 text-center"> <!-- ใส่คลาส text-center เพื่อจัดให้ปุ่มอยู่ตรงกลาง -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $order_row['order_id']; ?>">ดูทั้งหมด</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modal_<?php echo $order_row['order_id']; ?>" tabindex="-1" aria-labelledby="modalCenterTitle_<?php echo $order_row['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <h1 class="modal-title" id="modalCenterTitle_<?php echo $order_row['order_id']; ?>">รายการคำสั่งซื้อ</h1>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <u><b align="left" style=" font-size:20px">ที่อยู่ในการจัดส่งสินค้า</b><br></u>
                                                            <b align="left" style=" font-size:20px"><?php echo $order_row['address']; ?> ตำบล <?php echo $order_row['sub_district']; ?> อำเภอ <?php echo $order_row['district']; ?> <br> จังหวัด <?php echo $order_row['province']; ?> รหัสไปรษณีย์ <?php echo $order_row['zipcode']; ?></b>
                                                        </tr>
                                                    </thead>
                                                    <thead style="text-align: center;">
                                                        <tr>
                                                            <th style="font-size: 20px;">ชื่อสินค้า</th>
                                                            <th style="font-size: 20px;">ราคา</th>
                                                            <th style="font-size: 20px;">จำนวน</th>
                                                            <th style="font-size: 20px;">ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Query to fetch order items for current order_id
                                                        $order_item_sql = "SELECT * FROM `order_item` WHERE order_id = {$order_row['order_id']};";
                                                        $order_item_result = $conn->query($order_item_sql);
                                                        while ($order_item_row = $order_item_result->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td style="font-size: 18px;text-align: center;"><?php echo $order_item_row['product_name']; ?></td>
                                                                <td style="font-size: 18px;text-align: center;"><?php echo $order_item_row['price']; ?> ฿</td>
                                                                <td style="font-size: 18px;text-align: center;"><?php echo $order_item_row['quantity']; ?></td>
                                                                <td style="font-size: 18px;text-align: center;"><?php echo $order_item_row['total']; ?> ฿</td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                        <tr>
                                                            <td><span class="badge rounded-pill bg-label-danger" style="font-size: 20px;">ราคารวมทั้งหมด <?php echo $order_row['total_amount']; ?> ฿</span></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="badge rounded-pill bg-label-dark">วันที่สั่งซื้อสินค้า <?php echo $order_row['order_date']; ?></span></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                            <td style="font-size: 18px;color:red;"></td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                                <div style="display: flex; justify-content: center; align-items: center; height:  5%; ">
                                                    <img src="slip_img/<?php echo $order_row['slip']; ?>" style="width: 30%; margin-top: 0px;border-radius:5px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td align="center"><?php echo $order_row['total_amount']; ?> ฿</td>
                            <td class="product-status <?php echo $order_row['status'] == 'กำลังตรวจสอบสลิป' ? 'slip-checking-status' : ($order_row['status'] == 'กำลังจัดส่งสินค้า' ? 'shipping-status' : ($order_row['status'] == 'จัดส่งสินค้าแล้ว' ? 'shipped-status' : 'received-status')); ?>">
                                <?php echo $order_row['status']; ?>
                            </td>

                        </tr>
                        <?php $No += 1; ?>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
