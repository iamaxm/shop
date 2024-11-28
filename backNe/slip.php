<?php
@session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];

$order_sql = "SELECT * FROM `orders` INNER JOIN order_item ON orders.order_id = order_item.order_id ;";
$order_result = $conn->query($order_sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสลิปการชำระเงิน</title>
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
</head>
<body>

<div class="container">
    <div class="card">
        <h1>ตรวจสอบสลิปการชำระเงิน</h1>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                    
                    </tr>
                </thead>
                <tbody>
                <?php while ($order_row = $order_result->fetch_assoc()) : ?>
                    <tr>
                        <th scope="row"><?php echo $order_row['order_id']; ?></th>
                        <td><?php echo $order_row['full_name']; ?></td>
                        
                        <td><?php echo $order_row['product_name']; ?></td>
                        <td><?php echo $order_row['quantity']; ?></td>
                        <td><?php echo $order_row['price']; ?></td>
                        <td>60</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" onclick="openPopup('../img/slip.jpg')">ตรวจสอบ</button>
                            <button type="button" class="btn btn-outline-danger">ยกเลิก</button>
                        </td>
                    </tr>
                 
                    <tr class="border-bottom">
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>รวมทั้งหมด</td>
                        <td>50</td>
                        <td>
                            <div style="display: inline-block;">
                                <select class="form-select" aria-label="Default select example" style="width: auto;">
                                    <option selected>อัปเดตสถานะการจัดส่ง</option>
                                    <option value="1">เตรรียมจัดส่ง</option>
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

<script>
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
</script>

</body>
</html>
