<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
@session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];

$order_sql = "SELECT * FROM orders WHERE status = 'กำลังตรวจสอบสลิป' ORDER BY order_date ASC";
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


<div class="card mt-5" style="padding-top:3rem; margin:2rem 2rem;">
    <h1>ตรวจสอบรายการคำสั่งซื้อ</h1>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th style="font-size: 16px;">ลำดับ</th>
                    <th style="font-size: 16px;"><center>order_id</center></th>
                    <th style="font-size: 16px;">user_id (ของผู้สั่งซื้อ)</th>
                    <th style="font-size: 16px;">ชื่อผู้สั่งซื้อ</th>
                    <th style="font-size: 16px; text-align: center;">ราคารวม</th>
                    <th style="font-size: 16px;">ตรวจสอบ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order_row = $order_result->fetch_assoc()) : ?>
                    <tr>
                        <th scope="row"><?php echo number_format($No); ?></th>
                        <td style="text-align: center;"><?php echo $order_row['order_id']; ?></td>
                        <td style="text-align: center;"><?php echo $order_row['user_id']; ?></td>
                        <td><?php echo $order_row['full_name']; ?></td>
                        <td style="text-align: center;"><?php echo $order_row['total_amount']; ?> ฿</td>

                        <td>
                            <div class="mt-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $order_row['order_id']; ?>">ตรวจสอบ</button>
                                <button type="button" class="btn btn-outline-danger" onclick="cancelOrder(<?php echo $order_row['order_id']; ?>)" style="margin: 10px;">ยกเลิกคำสั่งซื้อ</button>

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
                                                    <tr style="text-align: center;">
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
                                                        <tr style="text-align: center;">
                                                            <td style="font-size: 18px;"><?php echo $order_item_row['product_name']; ?></td>
                                                            <td style="font-size: 18px;"><?php echo $order_item_row['price']; ?> ฿</td>
                                                            <td style="font-size: 18px;"><?php echo $order_item_row['quantity']; ?></td>
                                                            <td style="font-size: 18px;"><?php echo $order_item_row['total']; ?> ฿</td>
                                                        </tr>

                                                    <?php endwhile; ?>
                                                    <tr>
                                                        <td><span class="badge rounded-pill bg-label-danger" style="font-size: 20px;">ราคารวมทั้งหมด <?php echo $order_row['total_amount']; ?> ฿</span></td>
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
                    <form action="backNe/BN_update_status.php" method="post">
                        <tr class="border-bottom">
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div style="display: inline-block;">
                                    <select class="form-select" id="status" name="status" aria-label="Default select example" style="width: auto;">
                                        <option selected disabled hidden>อัปเดตสถานะการจัดส่ง</option>
                                        <option value="กำลังจัดส่งสินค้า">กำลังจัดส่งสินค้า</option>
                                    </select>
                                </div>
                                <div style="display: inline-block;">
                                    <input hidden id="order_id" name="order_id" value="<?php echo $order_row['order_id']; ?>">
                                    <!-- ย้ายปุ่มอัปเดตไปใน form -->
                                    <button type="submit" class="btn btn-outline-success">อัปเดต</button>
                                </div>
                            </td>
                        </tr>
                    </form>

                    <?php $No += 1; ?>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function cancelOrder(orderId) {
        Swal.fire({
            title: "คุณแน่ใจหรือไม่ที่จะยกเลิกคำสั่งซื้อนี้?",
            text: "เมื่อยกเลิกคำสั่งซื้อแล้วคุณจะไม่สามารถย้อนกลับได้!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "ย้อนกลับ",
            confirmButtonText: "ใช่, ยกเลิกคำสั่งซื้อ!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "backNe/cancel_order.php?order_id=" + orderId;
            }
        });
    }
</script>