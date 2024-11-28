<?php
@session_start();
include('db.php');
$user_id = $_SESSION['UserID'];
$sql = "SELECT  cart.cart_item_id ,cart.product_name,cart.quantity,cart.img,cart.status,cart.product_id,products.product_detail,products.product_price FROM `cart` INNER JOIN products ON cart.product_id = products.product_id  where cart.user_id = $user_id ";
$result = $conn->query($sql);

$total_price = 0; // กำหนดค่าเริ่มต้นของยอดรวมราคาเป็น 0

?>

<!-- Spinner Start -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<div>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?id=user" style="color:black"><i class="bi bi-arrow-left" style="font-size: 30px;"></i>
        <img src="img/cart.png" class="img-fluid me-5 rounded-circle" style="width: 60px; height: 60px;" alt=""></a>
</div>
<center>
    <div>
        <?php if ($result->num_rows > 0) { ?>
            <img src="img/lg.png" class="img-fluid me-4 rounded-circle" style="width: 90px; height: 90px; border: 3px solid #9ED900;">
        <?php } else { ?>

        <?php } ?>
        <h1><?php if ($result->num_rows > 0) { ?>
                Shopping Cart
            <?php } else { ?>
            <?php } ?> </h1>
    </div>
</center>
</div>

<!-- Single Page Header End -->

<!-- Cart Page Start -->
<style>
    th,
    td {
        text-align: center;
        /* ให้ข้อมูลในแต่ละเซลอยู่ตรงกันในแนวนอนตรงกลาง */
    }
</style>
<?php
$total_price = 0; // กำหนดให้ราคารวมเป็น 0 เพื่อนับราคาสินค้าทั้งหมด
if ($result->num_rows > 0) { // ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
?>
    <div class="container-fluid py-1">
        <div class="container py-3">
            <div class="table-responsive">
                <table class="table">
                    <!-- ส่วนหัวของตาราง -->
                    <thead>
                        <tr style="background-color:#76BC43 ">
                            <!-- คอลัมน์ของตาราง -->
                            <th scope="col" style="color:white; text-align: left;"><i class="bi bi-image"></i> Products </th>
                            <th scope="col" style="color:white"><i class="bi bi-person-fill"></i> Name </th>
                            <th scope="col" style="color:white"><i class="bi bi-wallet2"></i> Price </th>
                            <th scope="col" style="color:white"><i class="bi bi-hourglass-split"></i> Quantity </th>
                            <th scope="col" style="color:white"><i class="bi bi-wallet"></i> Total </th>
                            <th scope="col" style="color:white"><i class="bi bi-compass"></i> Status</th>
                            <th scope="col" style="color:white"><i class="bi bi-x-octagon"></i> Handle </th>
                        </tr>
                    </thead>
                    <!-- ส่วนของรายการสินค้า -->
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : // วนลูปแสดงรายการสินค้า 
                        ?>
                            <?php
                            $t = $row['product_price'] * $row['quantity']; // คำนวณราคารวมของสินค้าแต่ละรายการ
                            $total_price += $t; // เพิ่มราคารวมของสินค้าแต่ละรายการเข้ากับราคารวมทั้งหมด
                            ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="admin/product_img/<?php echo $row['img']; ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $row['product_name']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $row['product_price']; ?> ฿</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $row['quantity']; ?> Kg.</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $t ?> ฿</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" style="color:#76BC43"><?php echo $row['status']; ?></p>
                                </td>
                                <td>
                                    <form action="backend/bn_remove_from_cart.php" method="post">
                                        <input type="hidden" id="cart_item_id" name="cart_item_id" value="<?php echo $row['cart_item_id']; ?>">
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4" id="remove_product" name="remove_product">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
<!-- ตรวจสอบราคารวมเพื่อแสดงส่วนของราคาทั้งหมดและปุ่ม Checkout -->
<?php if ($total_price !== 0) { ?>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded style=color:#76BC43;">
                    <!-- ส่วนของราคาสินค้าทั้งหมด -->
                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <h1 class="display-6 mb-4" style="color:#76BC43;">Cart <span class="fw-normal ">Total</span></h1>
                            <img src="img/lg.png" style="width: 50px; height: 50px " alt="">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4" style="color:#76BC43;">Subtotal</h5>
                            <p class="mb-0" style="color:#76BC43;"><?php echo number_format($total_price, 2); ?> ฿</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4" style="color:#76BC43;">Shipping</h5>
                            <div class="">
                                <p class="mb-0" style="color:#76BC43;">Free Shipping</p>
                            </div>
                        </div>
                    </div>
                    <!-- ส่วนของปุ่ม Checkout -->
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4" style="color:#76BC43;">Total</h5>
                        <p class="mb-0 pe-4" style="color:#76BC43;"><?php echo number_format($total_price, 2); ?> ฿</p>
                    </div>
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="submit"><a href="index.php?id=checkouts" style="color:#76BC43;">Checkout</a></button>
                </div>
            </div>
        </div>
    <?php } else { // ถ้าไม่มีสินค้าในตะกร้า 
    ?>
        </div>
    </div>
    

    <?php } ?>
<?php } else { // ถ้าไม่มีสินค้าในตะกร้า 
?>

    <div style="text-align: center; margin-top: 150px;">
        <img src="https://cdn.icon-icons.com/icons2/1808/PNG/512/shopping-basket_115095.png" alt="Icon" width="150" height="150" style="margin-bottom: 15px; display: inline-block;">
    </div>
    <center>
        <h1 style="font-size: 24px;">ตะกร้าของคุณว่างเปล่า</h1>
    </center>
<?php } ?>

</div>
</section>
</section>

<!-- Cart Page End -->


<!-- Footer Start -->
<!-- <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0">Fruitables</h1>
                        <p class="text-secondary mb-0">Fresh products</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                        <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                        <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Why People Like us!</h4>
                    <p class="mb-4">typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                    <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Shop Info</h4>
                    <a class="btn-link" href="">About Us</a>
                    <a class="btn-link" href="">Contact Us</a>
                    <a class="btn-link" href="">Privacy Policy</a>
                    <a class="btn-link" href="">Terms & Condition</a>
                    <a class="btn-link" href="">Return Policy</a>
                    <a class="btn-link" href="">FAQs & Help</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Account</h4>
                    <a class="btn-link" href="">My Account</a>
                    <a class="btn-link" href="">Shop details</a>
                    <a class="btn-link" href="">Shopping Cart</a>
                    <a class="btn-link" href="">Wishlist</a>
                    <a class="btn-link" href="">Order History</a>
                    <a class="btn-link" href="">International Orders</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: 1429 Netus Rd, NY 48247</p>
                    <p>Email: Example@gmail.com</p>
                    <p>Phone: +0123 4567 8910</p>
                    <p>Payment Accepted</p>
                    <img src="img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </div> 
</div>
Footer End

Copyright Start
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                /*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/
                /*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/
                /*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/
                Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
Copyright End -->