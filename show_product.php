<?php
session_start();
include('db.php');

@header('Content-Type: text/html; charset=utf-8');

// product_type = all = vegetable = fruit

$product_type = isset($_GET['type']) ? $_GET['type'] : "";
$product_name = isset($_GET['name']) ? $_GET['name'] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 12; // จำนวนผลิตภัณฑ์ต่อหน้า
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM `products`";
$sll = "SELECT * FROM `products`";

$sqlCount = "SELECT COUNT(*) AS total FROM `products`";

if (!empty($product_type)) {
    $sql .= " WHERE `product_type` = '$product_type'";
    $sqlCount .= " WHERE `product_type` = '$product_type'";
}if($product_type=="all"){
    $sql = "SELECT * FROM `products`";
    $sqlCount = "SELECT COUNT(*) AS total FROM `products`";
}
if (!empty($product_name)) {
    $sql .= " WHERE `product_name` LIKE '%$product_name%'";
    $sqlCount .= " WHERE `product_name` LIKE '%$product_name%'";
}


// เพิ่ม LIMIT และ OFFSET เพื่อกำหนดจำนวนและตำแหน่งเริ่มต้นของข้อมูลที่ต้องการคิวรี
$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$r = $conn->query($sll);

$result = $conn->query($sql);
$countResult = $conn->query($sqlCount);
$countRow = $countResult->fetch_assoc();
$totalProducts = $countRow['total'];

$totalPages = ($totalProducts > 0) ? ceil($totalProducts / $limit) : 0;

?>
<style>
    #myDropdown {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 2000px;
        /* ปรับความกว้างของ div */
        height: 200px;
        /* ปรับความสูงของ div */
        overflow-y: auto;
        /* เพิ่มเติม: เพื่อให้มีการเลื่อนแนวดิ่ง */
    }

    #myDropdown a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #ccc;
    }

    #myDropdown {
        display: none;
    }


    .contact-info {
        display: flex;
        flex-wrap: wrap;
    }

    .contact-info p {
        margin-right: 20px;
        white-space: nowrap;
    }

    .pagination {
        display: flex;
        justify-content: center;
        list-style-type: none;
        padding: 0;
    }

    .pagination a {
        padding: 8px 16px;
        margin: 0 4px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #666;
    }

    .pagination a.active {
        background-color: #ffb524;
        color: #fff;
    }
</style>
<!-- Spinner Start -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
            </div>


            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center"> <!-- เพิ่ม justify-content-center เพื่อจัดให้เรียงตรงกลาง -->
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center"> <!-- เพิ่มคลาส text-center เพื่อจัดให้เนื้อหาอยู่ตรงกลาง -->
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center"> <!-- เพิ่มคลาส text-center เพื่อจัดให้เนื้อหาอยู่ตรงกลาง -->
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center"> <!-- เพิ่มคลาส text-center เพื่อจัดให้เนื้อหาอยู่ตรงกลาง -->
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->



<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">



            <div class="row g-4">
                <center>

                    <div class="col-lg-4 text-start">
                        <h1>Our Organic Products</h1>
                    </div>
                </center>
                <form action="#" method="GET">
                    <div class="input-group">
                        <input type="text" placeholder="ค้นหาชื่อสินค้าที่ต้องการ..." id="myInput" onkeyup="filterFunction()" class="form-control" name="name" aria-label="Recipient's username" aria-describedby="button-addon2" style="width: calc(100% - 90px); margin-right: -1px;">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">ค้นหา</button>
                    </div>
                </form>
                <div id="myDropdown">
                    <?php while ($rows = $r->fetch_assoc()) : ?>
                        <a href="index.php?id=user&name=<?php echo $rows['product_name']; ?>"><?php echo $rows['product_name']; ?></a>
                    <?php endwhile ?>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="" data-bs-toggle="pill">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=user&type=all"><span class="text-dark" style="width: 130px;">สินค้าทั้งหมด</span></a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-bs-toggle="pill">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=user&type=ผัก"><span class="text-dark" style="width: 130px;">ผัก</span></a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-bs-toggle="pill">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active-nav-link product-type-btn" href="index.php?id=user&type=ผลไม้"><span class="text-dark" style="width: 130px;">ผลไม้</span></a>
                            </a>
                        </li>
                </div>
            </div>

            <div class="container py-5 ">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="tab-content">

                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div class="rounded position-relative fruite-item">

                                                        <div class="fruite-img">

                                                            <img src="admin/product_img/<?php echo $row['img']; ?>" class="img-fluid w-100 rounded-top" alt="" style="height: 324px; width: 324px;">

                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['product_type']; ?></div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4><?php echo $row['product_name']; ?></h4>
                                                            <p></p><br><br>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">฿ <?php echo $row['product_price']; ?></p>
                                                                <!-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                                                                <!-- Button trigger modal -->
                                                                <div style="margin-left: 2rem;">
                                                                    <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1<?php echo $row['product_id'] ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                        Add to Cart
                                                                    </button>
                                                                </div>


                                                                <!-- Modal -->
                                                                <form action="backend/bn_create_cart.php" method="POST">
                                                                    <div class="modal fade" id="exampleModal1<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                                        รายละเอียดสินค้า</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <img src="admin/product_img/<?php echo $row['img']; ?>" class="img-fluid w-100 rounded-top" alt="" style="height: 324px; width: 324px;"><br>
                                                                                    <br>
                                                                                    <h4><?php echo $row['product_name']; ?></h4>
                                                                                    <?php echo $row['product_detail']; ?>
                                                                                    <p class="text-dark fs-5 fw-bold mb-0">฿ <?php echo $row['product_price']; ?></p>
                                                                                    <br>
                                                                                    <center>
                                                                                        <div class="input-group mb-5" style="width: 100px;">
                                                                                            <div class="input-group-btn">
                                                                                                <button type="button" onclick="{
                                                                                                     var input = document.getElementById('quantity-<?php echo $row['product_id'] ?>'); input.value = parseInt(input.value) - 1;
                                                                                                }" class="btn btn-sm rounded-circle bg-light border">
                                                                                                    <i class="fa fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                            <input hidden id="product_id" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                                                            <input hidden id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>">
                                                                                            <input hidden id="product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
                                                                                            <input hidden id="img" name="img" value="<?php echo $row['img']; ?>">
                                                                                            <input type="text" id="quantity-<?php echo $row['product_id'] ?>" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                                                                                            <div class="input-group-btn">
                                                                                                <button type="button" onclick="{
                                                                                                     var input = document.getElementById('quantity-<?php echo $row['product_id'] ?>'); input.value = parseInt(input.value) + 1;
                                                                                                    }" class="btn btn-sm rounded-circle bg-light border">
                                                                                                    <i class="fa fa-plus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </center>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                                                    <button class="btn btn-primary" type="submit">เพิ่มลงตระกร้า</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endwhile ?>
                                            <!-- Fruits Shop End-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>&type=<?php echo $product_type; ?>&name=<?php echo $product_name; ?>" <?php if ($page == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>


<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0">Fruitables</h1>
                        <p class="text-secondary mb-0">Fresh products</p>
                    </a>
                </div>


            </div>
        </div>
        <div class="row g-5">

            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3" style="font-size:30px;">Contact</h4>
                    <div class="contact-info">
                        <div class="contact-info">
                            <p> <i class="bi bi-geo-alt-fill"></i> Address: 5 Chaeng Sanit Road, Nai Mueang Subdistrict, Mueang Ubon Ratchathani District, Ubon Ratchathani 34000</p>
                        </div>
                        <div class="contact-info">
                            <p> <i class="bi bi-envelope-at-fill"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                                    <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671" />
                                    <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791" />
                                </svg>&nbsp; Email: mail@utc.ac.th, utcubon@hotmail.com</p>
                            <p><i class="bi bi-telephone-fill"></i> &nbsp;Phone: 045 255047, 045240577</p>
                        </div>
                        <!-- <img src="img/payment.png" class="img-fluid" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="bi bi-globe2">&nbsp;&nbsp;</i></i>vegetables and fruits</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->

            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
<!-- Placeholder dropdown menu -->
<div id="myDropdown">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
</div>

<script>
    function filterFunction() {
        var input, filter, div, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase().trim();
        div = document.getElementById("myDropdown");

        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            a[i].style.display = "none"; // Hide all links if input is empty
        }
        if (filter !== "") { // Check if input is not empty
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = ""; // Show matching links
                } else {
                    a[i].style.display = "none"; // Hide non-matching links
                }
            }
            // Show the dropdown when there's input
            div.style.display = "block";
        } else {
            // Hide the dropdown when input is empty
            div.style.display = "none";
        }
    }
</script>

<script>
    document.querySelectorAll('.product-type-btn').forEach(item => {
        item.addEventListener('click', event => {
            // ลบคลาส active ทั้งหมดที่มีอยู่
            document.querySelectorAll('.product-type-btn').forEach(btn => {
                btn.classList.remove('active-nav-link');
            });
            // เพิ่มคลาส active สำหรับปุ่มที่คลิก
            item.classList.add('active-nav-link');

            // อนุญาตให้ปฏิบัติการที่ต้องการเกิดขึ้น (คลิกปุ่ม) โดยไม่ต้องป้องกัน
            // นี่เป็นการยกเว้นให้การทำงานปกติเมื่อคลิกปุ่ม
        });
    });
</script>


<script>
    // เช็กพารามิเตอร์ "type" ใน URL
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');

    // หาคำสั่ง <a> ที่มี href มี type ที่ตรงกับพารามิเตอร์ "type" และเพิ่มคลาส "active" ให้กับ <a> นั้น
    const productTypeLinks = document.querySelectorAll('.product-type-btn');
    productTypeLinks.forEach(link => {
        if (link.getAttribute('href').includes(type)) {
            link.classList.add('active');
        }
    });
</script>
