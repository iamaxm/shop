<?php
@session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];

$order_sql = "SELECT * FROM orders WHERE status = 'ได้รับสินค้าแล้ว';";
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
    border-collapse: fixed;
    margin-top: 30px;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    font-size: 18px;
    /* เพิ่มขนาดตัวอักษรให้กับข้อความในตาราง */
  }

  th {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #f9f9f9;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    border: none;
    /* หรือ border: 0; */
  }

  th,
  td {
    border: none;
    /* หรือ border: 0; */
    padding: 8px;
    text-align: fixed;
  }

  .modal-title {
    margin: auto;
    text-align: right;

  }

  /* Styling for the popup container */
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
    max-width: 100%;
    /* ขนาดสูงสุดของ Popup เป็น 80% ของหน้าจอ */
    max-height: 100%;
    /* ขนาดสูงสุดของ Popup เป็น 80% ของหน้าจอ */
    overflow: auto;
    text-align: auto;
  }




  /* Styling for the close button */
  /* CSS for the close button */
  .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 25px;
    cursor: pointer;
    color: #333;
    margin: -3px;
    /* ขนาดกากบาต */
  }

  /* Styling for the image inside the popup */
  .popup img {
    max-width: 100%;
    /* ขนาดรูปภาพสูงสุดเท่ากับความกว้างของ Popup */
    max-height: 100%;
    /* ขนาดรูปภาพสูงสุดเท่ากับความสูงของ Popup */
    margin: auto;
    /* จัดการย่อหน้าต่างตามศูนย์กลาง */
    display: auto;
    /* ทำให้รูปภาพอยู่กลางตามแนวนอน */
  }

  p {
    margin-bottom: -4px;
    /* ปรับขนาดของช่องว่างระหว่างบรรทัดตามต้องการ */
  }

  .table th,
  .table td {
    text-align: left;
  }

  .grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 20px;
    padding: 20px;
  }

  .grid-item {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

  .grid-item h1 {
    text-align: center;
  }
</style>
<div class="container">
  <div class="card">
    <h1>รายการสินค้าที่ลูกค้าได้รับแล้ว</h1>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap">
            <th style="font-size: 20px;">#</th>
            <th style="font-size: 20px;">ชื่อผู้สั่งซื้อ</th>
            <th style="font-size: 20px; text-align: center;">ราคารวม</th>
            <th style="font-size: 20px; text-align: center;">วันที่ลูกค้ากดยืนยันสินค้า </th>
            <th style="font-size: 20px;">รายการสินค้าทั้งหมด</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($order_row = $order_result->fetch_assoc()) : ?>
            <tr>
              <th scope="row"><?php echo $order_row['order_id']; ?></th>
              <td><?php echo $order_row['full_name']; ?></td>
              <td style="text-align: center;"><?php echo $order_row['total_amount']; ?> ฿</td>
              <td style="text-align: center;"><?php echo $order_row['orderUpdate_status_date']; ?></td>
              <td>
                <div class="mt-3">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter<?php echo $order_row['order_id']; ?>" style="margin-left:3rem;">ดูทั้งหมด</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalCenter<?php echo $order_row['order_id']; ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle<?php echo $order_row['order_id']; ?>" style="margin-right: 30px;font-size:30px">รายการที่จัดส่งแล้ว</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th style="font-size:15px;">ชื่อสินค้า</th>
                            <th style="font-size:15px;">ราคา</th>
                            <th style="font-size:15px;">จำนวน</th>
                            <th style="font-size:15px;">ราคารวม</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Query to fetch order items for current order_id
                          $order_item_sql = "SELECT * FROM `order_item` WHERE order_id = {$order_row['order_id']};";
                          $order_item_result = $conn->query($order_item_sql);
                          while ($order_item_row = $order_item_result->fetch_assoc()) : ?>
                            <tr>
                              <td style="font-size:15px;"><?php echo $order_item_row['product_name']; ?></td>
                              <td style="font-size: 15px; text-align: center;"><?php echo $order_item_row['price']; ?> ฿</td>
                              <td style="font-size: 15px; text-align: center;"><?php echo $order_item_row['quantity']; ?></td>
                              <td style="font-size: 15px; text-align: center;"><?php echo $order_item_row['total']; ?> ฿</td>
                            </tr>
                          <?php endwhile; ?>
                          <tr>
                            <td><u style="color:red;">ราคารวมทั้งหมด : <?php echo $order_row['total_amount']; ?> ฿ </u></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php endwhile ?>
        </tbody>
      </table>
    </div>
  </div>