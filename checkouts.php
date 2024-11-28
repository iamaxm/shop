<?php
@session_start();
include('db.php');
require_once("qr/lib/PromptPayQR.php");

// ตรวจสอบว่ามีการล็อกอินเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['UserID'])) {
    // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้าล็อกอินหรือหน้าที่เหมาะสม
    header("Location: index.php?id=login");
    exit();
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$user_id = $_SESSION['UserID'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$user_result = $conn->query($sql);
$user_data = $user_result->fetch_assoc();

// ดึงข้อมูลที่อยู่จัดส่ง
$address_sql = "SELECT * FROM address WHERE user_id = $user_id";
$address_result = $conn->query($address_sql);
$address_data = $address_result->fetch_assoc();

// ดึงข้อมูลสินค้าในตะกร้า
$cart_sql = "SELECT * FROM cart WHERE user_id = $user_id";
$cart_result = $conn->query($cart_sql);

$cart_items = []; // สร้างตัวแปรเพื่อเก็บรายการสินค้าในตะกร้า
$total_price = 0; // กำหนดค่าเริ่มต้นให้ total_price เป็น 0

while ($cart_row = $cart_result->fetch_assoc()) {
    $cart_items[] = $cart_row; // เพิ่มข้อมูลสินค้าลงในตัวแปร $cart_items
    $total_price += $cart_row['total_price']; // คำนวณยอดรวมราคาสินค้าทั้งหมด
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 -10px (0, 0, 0, 0.1);
            /* เพิ่มเงาให้กล่อง */
            background-color: rgba(255, 255, 255, 0.8);
            /* สีของกล่องเป็นสีขาวโปร่งใส */

        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #AFD7F6;
        }

        /* Style for payment button */
        .payment-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .payment-btn:hover {
            background-color: #45a049;
        }

        /* Additional style for note */
        .note {
            text-align: center;
            margin-top: 10px;
            font-style: italic;
            font-size: 12px;
        }

        /* Style for file input */
        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        /* Style for uploaded image preview */
        .uploaded-image {
            display: block;
            margin: 20px auto;
            max-width: 200px;
            border-radius: 5px;
        }

        body {
            background-color: #AFD7F6;
            /* สีพื้นหลัง */
        }
        
    </style>

</head>

<div class="container" >
<div style="text-align: center;">
    <img src="https://png.pngtree.com/png-vector/20231211/ourmid/pngtree-spend-money-icon-payment-png-image_10873618.png" alt="Icon" width="80" height="80" style="margin-bottom: 15px; display: inline-block;">
</div>
    <h1>Checkout Page</h1>

    <?php
    // ตรวจสอบว่ามีที่อยู่ในระบบหรือไม่
    if (empty($address_data)) {
        echo '<h2 style="color: red; text-align: center;">กรุณากรอกที่อยู่ของคุณก่อนดำเนินการต่อ</h2>';
    } else {
    ?>
    
        <h2>User Information</h2>
        <p><i class="bi bi-person-circle" style="margin-right: 10px;"></i>ชื่อผู้รับพัสดุ:  <?php echo $address_data['full_name']; ?></p>
        <p><i class="bi bi-house-door"style="margin-right: 10px;"></i>Address : <?php echo $address_data['address']; ?> ตำบล <?php echo $address_data['sub_district']; ?> อำเภอ <?php echo $address_data['district']; ?> จังหวัด <?php echo $address_data['province']; ?> รหัสไปรษณีย์ <?php echo $address_data['zipcode']; ?></p>
        <p><i class="bi bi-telephone-inbound" style="margin-right: 10px;"></i>เบอร์โทรศัพท์ : <?php echo $address_data['phone']; ?></p>

        <h2><i class="bi bi-cart4"style="margin-right: 10px;"></i>Cart Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: center;">Quantity</th>
<th style="text-align: center;">Total Price</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $cart_item) : ?>
                    <tr>
                        <td><?php echo $cart_item['product_name']; ?></td>
                        <td style="text-align: right;"><?php echo $cart_item['product_price']; ?> ฿</td>
                        <td style="text-align: center;"><?php echo $cart_item['quantity']; ?></td>
<td style="text-align: center;"><?php echo $cart_item['total_price']; ?> ฿</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        
        <h2><Total style="text-align: center;">
    <img src="https://png.pngtree.com/png-vector/20220517/ourmid/pngtree-digital-payment-icon-color-flat-png-image_4665870.png" alt="Icon" width="55" height="55" style="margin-bottom: 15px; display: inline-block;">
Total Price : <?php echo $total_price; ?> ฿</h2>

        <?php
        $PromptPayQR = new PromptPayQR(); // new object
        $PromptPayQR->size = 8; // Set QR code size to 8
        $PromptPayQR->id = '0619718560'; // PromptPay ID
        $PromptPayQR->amount = $total_price; // Set amount (not necessary)
        $qrCodeUrl = $PromptPayQR->generate();
        ?>
        <!-- QR Code for Payment -->
        <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code for Payment" style="display: block; margin: 20px auto; max-width: 200px; border-radius: 5px;">

        <!-- Payment Button -->

        <!-- Payment Button -->
        <form action="backend/bn_process_payment.php" method="post" enctype="multipart/form-data">
            <center>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Upload Your Slip</label>
                    <input class="form-control" name="slip" type="file" id="formFileMultiple">
                    <!-- Slip preview image -->
                    <img id="slip-preview" src="#" alt="Slip Preview" style="max-width: 100%; max-height: 300px; margin-top: 30px; border-radius: 10px; display: none;">
                </div>
            </center>
            <center>
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
<button type="submit" class="btn rounded-pill btn-outline-info">
    Proceed to Payment
</button>

                <p class="note">*หมายเหตุ : เมื่ออัปโหลดสลิปเสร็จแล้วให้กดปุ่ม Proceed to Payment <br>
                    เมื่อกดปุ่ม Proceed to Payment แล้วจะไม่สามารถเปลี่ยนแปลงที่อยู่ในการจัดส่งได้ กรุณาตรวจสอบที่อยู่ให้ดีก่อนกดปุ่ม Proceed to Payment
                </p>
            </center>
        </form>

    <?php
    }
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to preview slip image
        function previewSlip(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#slip-preview').attr('src', e.target.result);
                    $('#slip-preview').show(); // Show the slip preview image
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Call the previewSlip function when file input changes
        $("#formFileMultiple").change(function() {
            previewSlip(this);
        });
    });
</script>
</body>

</html>