<?php
session_start();
include('db.php');


// $sql = "SELECT * FROM products";
// $result = $conn->query($sql);

//คิวรี่ข้อมูลประเภทสินค้า
$sqlPrdType = "SELECT * FROM product_types";
$resultPrdType = mysqli_query($conn, $sqlPrdType);

//ถ้ามีการคลิกเลือกประเภทสินค้า
if (isset($_GET['type_id'])) {
    $type_id = $_GET['type_id'];

    //คิวรี่ข้อมูลสินค้าตามประเภท
    $sql = "SELECT * FROM products WHERE type_id = '$type_id'";
    $result = mysqli_query($conn, $sql);

    //คิวรี่ชื่อประเภทสินค้า
    $sqlPrdTypeName = "SELECT type_name FROM product_types WHERE type_id = '$type_id'";
    $resultPrdTypeName = mysqli_query($conn, $sqlPrdTypeName);
    $rowPrdTypeName = mysqli_fetch_assoc($resultPrdTypeName);
} else {
    //คิวรี่ข้อมูลสินค้าทุกรายการ
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
}



?>


<!-- Spinner Start -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->


<!-- Navbar start -->

<!-- Navbar End -->


<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->


<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                <div class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                </div>
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
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over $300</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
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
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
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
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <?php while ($rowPrdType = mysqli_fetch_assoc($resultPrdType)) { ?>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="show_product.php?type_id=<?= $rowPrdType['type_id']; ?>&name=<?= $rowPrdType['type_name'];?>">
                                <span class="text-dark" style="width: 130px;"><?= $rowPrdType['type_name']; ?></span>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 130px;">Fruits</span>
                            </a>
                        </li> -->
                      
                    </ul>
                </div>
            </div>





            <!-- Fruits Shop Start-->
            <!--    
    <div class="container-fluid fruite py-5"> -->

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

                                                            <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['product_type']; ?></div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4><?php echo $row['product_name']; ?></h4>
                                                            <p></p><br><br>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">฿ <?php echo $row['product_price']; ?> / kg.</p>
                                                                <!-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1<?php echo $row['product_id'] ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                    Add to Cart
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal1<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                                    รายละเอียดสินค้า</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt=""> <br>
                                                                                <br>
                                                                                <h4><?php echo $row['product_name']; ?></h4>
                                                                                <?php echo $row['product_detail']; ?>
                                                                                <p class="text-dark fs-5 fw-bold mb-0">฿ <?php echo $row['product_price']; ?> / kg.</p>
                                                                                <br>

                                                                                <center>

                                                                                    <div class="input-group quantity mb-5" style="width: 100px;">
                                                                                        <div class="input-group-btn">
                                                                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                                                <i class="fa fa-minus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                                                                        <div class="input-group-btn">
                                                                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                                                                <i class="fa fa-plus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                </center>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                                                <a href="index.php?id=shopping_cart" class="btn btn-primary">เพิ่มลงตระกร้า</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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