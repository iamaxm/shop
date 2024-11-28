<?php
session_start();
include('db.php');

// Check if user is logged in
if (isset($_SESSION['UserID'])) {
    // Get user ID from session
    $user_id = $_SESSION['UserID'];

    // SQL query to count the number of items in the user's cart
    $count_sql = "SELECT COUNT(*) as count FROM `cart` WHERE `user_id` = $user_id";

    // Execute the query
    $count_result = $conn->query($count_sql);

    // Fetch the result as an associative array
    $count_row = $count_result->fetch_assoc();

    // Extract the count value
    $cart_count = $count_row['count'];
} else {
    // If user is not logged in, set cart count to 0
    $cart_count = 0;
}
?>
<style>
    .btn-outline-success {
        color: #81c408;
        border-color: #81c408;
    }

    .btn-check:checked+.btn-outline-success,
    .btn-check:active+.btn-outline-success,
    .btn-outline-success:active,
    .btn-outline-success.active,
    .btn-outline-success.dropdown-toggle.show {
        color: #fff;
        background-color: #81c408;
        border-color: #81c408;
    }

    .btn-outline-success:hover {
        color: #fff;
        background-color: #81c408;
        border-color: #81c408;
    }

    .btn-success {
        color: #81c408;
        background: transparent;
        border-color: #81c408;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #81c408;
        border-color: #81c408;
    }

    .btn-check:focus+.btn-success,
    .btn-success:focus {
        color: #fff;
        background-color: #81c408;
        border-color: #81c408;
        box-shadow: 0 0 0 0.25rem rgba(60, 153, 110, .5);
    }

    .btn-check:focus+.btn-success,
    .btn-success:focus {
        color: #fff;
        background-color: #81c408;
        border-color: #81c408;
        box-shadow: 0 0 0 0.25rem rgba(60, 153, 110, .5);
    }
    
</style>
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">เลขที่ 5 ถนนเเจ้งสนิท อำเภอเมือง อุบลราชธานี</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">mail@utc.ac.th</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.php?id=show_product" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.php?id=home" class="nav-item nav-link <?php echo (@$_GET['id'] == 'home') ? 'active' : ''; ?>">รายการสินค้าทั้งหมด</a>
                    <a href="index.php?id=howto_payment" class="nav-item nav-link <?php echo (@$_GET['id'] == 'howto_payment') ? 'active' : ''; ?>">วิธีการสั่งซื้อ</a>
                    <!-- <a href="index.php?id=shop-detail" class="nav-item nav-link">Shop Detail</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="index.php?id=cart" class="dropdown-item">Cart</a>
                            <a href="index.php?id=checkout" class="dropdown-item">Chackout</a>
                            <a href="index.php?id=testimonial" class="dropdown-item">Testimonial</a>
                            <a href="index.php?id=404" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <?php if (@$_SESSION["User"] != '') { ?>
                        <a href="index.php?id=product_received&status_allProduct=all" class="nav-item nav-link ">สินค้าที่ต้องได้รับ</a>
                        <!-- <a href="index.php?id=contact" class="nav-item nav-link">Contact</a> -->
                    <?php } ?>
                </div>



                <?php if (@$_SESSION["User"] != '') { ?>

                    <div class="d-flex m-3 me-0">
                        <a href="index.php?id=shopping_cart" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $cart_count; ?></span>
                        </a>


                        <div class="btn-group">
                            <a class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user fa-2x" style="font-size: 25px;"> <?php echo @$_SESSION["User"] ?></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="index.php?id=show_address">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-heart-fill" viewBox="0 0 16 16">
                                            <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z" />
                                            <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018" />
                                        </svg>
                                        <span> &nbsp;ที่อยู่ของฉัน</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?id=edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                            <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                                        </svg>
                                        <span> &nbsp;แก้ไขข้อมูล</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <?php
                                if (isset($_SESSION['User']) && $_SESSION['status'] == 'superadmin' || $_SESSION['status'] == 'admin') { ?>
                                    <li>
                                        <a class="dropdown-item" href="admin/home_admin.php?admin=product">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                            </svg>
                                            <span> &nbsp;ไปหน้า Admin</span>
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php } ?>
                                <center>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="red" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                            </svg>
                                            <span style="color:red"> &nbsp;Logout</span>
                                        </a>
                                    </li>
                                </center>

                            </ul>
                        </div>

                    <?php } else { ?>


                        <!-- <a href="index.php?id=login" class="my-auto">
                            <i class="fas fa-user fa-2x" style="font: size 25px;"> Login</i>
                        </a>
                        <a href="index.php?id=login">
                            <button type="button" class="btn btn-outline-success" style="font: size 25px;">Success</button>
                        </a> -->
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="index.php?id=show_product">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                                        </svg>
                                        <span> &nbsp;หน้าหลัก</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?id=login">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                        <span> &nbsp;เข้าสู่ระบบ</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?id=register">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                        </svg>
                                        <span> &nbsp;สมัครสมาชิก</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>

                    </div>
            </div>
        </nav>
    </div>
</div>