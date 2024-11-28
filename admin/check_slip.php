<?php
@session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];

$order_sql = "SELECT * FROM `orders`;";
$order_result = $conn->query($order_sql);
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
        margin: 10px auto;
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
</style>


<div class="container">
    <div class="card">
        <h1>ตรวจสอบสลิปการชำระเงิน</h1>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th style="font-size: 20px;">ลำดับ</th>
                        <th style="font-size: 20px;">ชื่อผู้สั่งซื้อ</th>
                        <th style="font-size: 20px;">ราคารวม</th>
                        <th style="font-size: 20px;">ตรวจสอบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order_row = $order_result->fetch_assoc()) : ?>
                        <tr>
                            <th scope="row"><?php echo $order_row['order_id']; ?></th>
                            <td><?php echo $order_row['full_name']; ?></td>
                            <td><?php echo $order_row['total_amount']; ?> ฿</td>
                            <td>
                                <div class="mt-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $order_row['order_id']; ?>">
                                        ตรวจสอบ
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" onclick="showCancelMessage()" style="margin: 10px;">ยกเลิกคำสั่งซื้อ</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modal_<?php echo $order_row['order_id']; ?>" tabindex="-1" aria-labelledby="modalCenterTitle_<?php echo $order_row['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle_<?php echo $order_row['order_id']; ?>">รายการคำสั่งซื้อ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
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
                                                                <td style="font-size: 18px;"><?php echo $order_item_row['product_name']; ?></td>
                                                                <td style="font-size: 18px;"><?php echo $order_item_row['price']; ?> ฿</td>
                                                                <td style="font-size: 18px;"><?php echo $order_item_row['quantity']; ?></td>
                                                                <td style="font-size: 18px;"><?php echo $order_item_row['total']; ?> ฿</td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                        <tr>
                                                            <td style="font-size: 20px;color:red;">ราคารวมทั้งหมด</td>
                                                            <td style="font-size: 18px;color:red;"><?php echo $order_row['total_amount']; ?> ฿</td>
                                                        </tr>
                                                </table>
                                                <div style="display: flex; justify-content: center; align-items: center; height:  5%; ">
                                                    <img src="slip_img/<?php echo $order_row['slip']; ?>" style="width: 30%; margin-top: 0px;border-radius:5px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td>
                                <div style="display: inline-block;">
                                    <select class="form-select" aria-label="Default select example" style="width: auto;">
                                        <option selected>อัปเดตสถานะการจัดส่ง</option>
                                        <option value="1">เตรียมจัดส่ง</option>
                                    </select>
                                </div>
                                <div style="display: inline-block;">
                                    <a href="home_admin.php?admin=delivery"><button type="submit" class="btn btn-outline-success">อัปเดต</button></a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <script>
    function openPopup(imageUrl) {
        var popup = document.createElement('div');
        popup.classList.add('popup');

        var closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.innerHTML = '&times;';
        closeBtn.onclick = function() {
            document.body.removeChild(popup);
        };
        popup.appendChild(closeBtn);

        var img = document.createElement('img');
        img.src = imageUrl;
        popup.appendChild(img);

        document.body.appendChild(popup);
    }
</script> -->