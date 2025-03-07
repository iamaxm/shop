<?php session_start(); ?>

<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
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
                    <a href="index.php?id=home" class="nav-item nav-link active">Home</a>
                    <a href="index.php?id=shop" class="nav-item nav-link">Shop</a>
                    <a href="index.php?id=shop-detail" class="nav-item nav-link">Shop Detail</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="index.php?id=cart" class="dropdown-item">Cart</a>
                            <a href="index.php?id=checkout" class="dropdown-item">Chackout</a>
                            <a href="index.php?id=testimonial" class="dropdown-item">Testimonial</a>
                            <a href="index.php?id=404" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="index.php?id=contact" class="nav-item nav-link">Contact</a>
                </div>



                <?php if (@$_SESSION["User"] != '') { ?>

                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    <a href="index.php?id=shopping_cart" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
    

                        <div class="dropdown">
                            <a class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <span class="material-symbols-outlined">
                                    settings_night_sight
                                </span> -->
                                <i class="fas fa-user fa-2x" style="font-size: 25px;"> <?php echo @$_SESSION["User"] ?></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" >    
                                <li><a class="dropdown-item" href="index.php?id=edit">แก้ไขข้อมูล</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <!-- <a href="
                                " class="my-auto">
                            
                        </a> -->
                        <!-- <a href="logout.php
                                " class="my-auto">
                            <i class="fas fa-user fa-2x" style="font: size 25px;">Logout</i>
                        </a> -->
                    <?php } else { ?>

                        <a href="#" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <!-- <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span> -->
                            </a>


                        <a href="index.php?id=login
                                " class="my-auto">
                            <i class="fas fa-user fa-2x" style="font: size 25px;"> Login</i>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </nav>
    </div>
</div>