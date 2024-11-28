<?php
@session_start();
include('../db.php');
$total_views = 0;
$all_member = 0;
$views_sql = "SELECT * FROM `log`";
$all_member_sql = "SELECT * FROM `users`";
$totalSeler = " SELECT  products.product_type,SUM(order_item.total) AS total FROM `products` INNER JOIN order_item ON products.product_id = order_item.product_id INNER JOIN orders ON order_item.order_id = orders.order_id WHERE products.product_type ='ผัก' AND orders.status = 'ได้รับสินค้าแล้ว';";
$toltelfruts = " SELECT  products.product_type,SUM(order_item.total) AS total FROM `products` INNER JOIN order_item ON products.product_id = order_item.product_id INNER JOIN orders ON order_item.order_id = orders.order_id WHERE products.product_type ='ผลไม้' AND orders.status = 'ได้รับสินค้าแล้ว';";
$target_sql = "SELECT `target1` FROM `target`";
$target_result = $conn->query($target_sql);
$target_row = $target_result->fetch_assoc();

$targetS_sql = "SELECT `target2` FROM `target`";
$targetS_result = $conn->query($targetS_sql);
$targetS_row = $targetS_result->fetch_assoc();

$sum_target_sql = "SELECT `sumtarget` FROM `target`";
$sum_target_sql_result = $conn->query($sum_target_sql);
$sum_target_sql_row = $sum_target_sql_result->fetch_assoc();


$views_result = $conn->query($views_sql);
$total_result = $conn->query($totalSeler);
$total_row = $total_result->fetch_assoc();
$toltelfruts_result = $conn->query($toltelfruts);
$toltelfruts_row = $toltelfruts_result->fetch_assoc();
$result = $conn->query($all_member_sql);

$sum_vegetable = $total_row['total'] - $target_row['target1'];
$sum_fruit = $toltelfruts_row['total'] - $targetS_row['target2'];
$all_total = $total_row['total'] + $toltelfruts_row['total']; //ยอดขายทั้งหมด
$sum_total = $all_total - $sum_target_sql_row['sumtarget']; //ยอดกำไร / ขาดทุน

if ($sum_target_sql_row['sumtarget'] != 0) {
    $all_percen = ($all_total / $sum_target_sql_row['sumtarget']) * 100;
    $missing_percen = ($sum_total / $sum_target_sql_row['sumtarget']) * 100;
} else {
    // Handle division by zero error
    $all_percen = 0; // %ที่ได้
    $missing_percen = 0; //% ที่ขาด
}




while ($views_row = $views_result->fetch_assoc()) {
    $total_views += 1;
}
while ($row = $result->fetch_assoc()) {
    $all_member += 1;
}
?>


<div class="container">
    <div class="card mt-3" style="padding-top: 1rem; margin: 1rem 1rem; background-color:#FFFFFF ;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-6col-md-12 col-6 mb-4">
                    <div class="card wider-frame" style=" background-color:#0066CC;">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-iconsbi bi-person-workspace">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: white;" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16" width="32" height="32">
                                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
                                        </svg>
                                    </i>
                                    <br /> <br />
                                    <h5 class="text-nowrap mb-2" style="color: white; text-align: right;">ยอดผู้เข้าชม</h5>

                                </div>
                            </div>
                            <br /> <br />
                            <div class="card-title">
                                <h3 class="card-title mb-2" style="color: white;"><?php echo number_format($total_views); ?> คน</h3>
                                <!-- <div style="text-align: right;">
                                    <img src="https://cdn3.iconfinder.com/data/icons/business-analytics/512/audience_growth_chart-512.png" width="100" height="85" alt="" title="" class="img-small" style="float: right;">
                                    <i class="menu-icon" style="margin-left: -40px;"></i>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card" style=" background-color:#99CCFF;">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bi bi-person-plus-fill" style="color: white;"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16" width="32" height="32">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                                        </svg></i>
                                    <br /> <br />
                                    <h5 class="text-nowrap mb-2" style="color: white;">สมาชิกใหม่
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                            <br /> <br />
                            <div class="card-title">
                                <h3 class="card-title mb-2" style="color: white;"><?php echo number_format($all_member); ?> คน</h3>
                                <!-- <div style="text-align: right;">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7697/7697766.png" width="100" height="85" alt="" title="" class="img-small" style="float: right;">
                                    <i class="menu-icon" style="margin-left: -40px;"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card" style=" background-color:#9966CC;">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bi bi-wallet2" style="color: white;"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16" width="32" height="32">
                                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                        </svg></i>

                                </div>
                            </div>
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2" style="color: white;">ยอดขายผัก</h5>
                                <h3 class="card-title mb-2" style="color: white;"><?php echo number_format($total_row['total']); ?> ฿</h3>
                            </div>

                            <small style="color: red;" class="bi bi-arrow-down">
                                <span style="font-size: 20px;">
                                    <?php if ($total_row['total'] > $target_row['target1']) { ?>
                                        <i class="menu-icon tf-iconsbi bi bi-arrow-up" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                                            </svg></i>
                                        <span style="color: green;">+</span>
                                    <?php } else { ?>
                                        <?php echo ''  ?>
                                        <i class="menu-icon tf-iconsbibi bi-arrow-down" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                            </svg></i>
                                    <?php  }  ?>
                                    <span <?php echo $total_row['total'] > $target_row['target1'] ? 'style="color: green;"' : 'style="color: red;"'; ?>><?php echo number_format($sum_vegetable); ?> ฿</span>
                                </span>
                            </small>
                            <!-- <div style="text-align: right;">
                                <img src="https://tpi2001.com/upload/services/food/picture_food.png" width="150" height="85" alt="" title="" class="img-small" style="float: right;">
                                <i class="menu-icon" style="margin-left: -40px;"></i>
                            </div> -->

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>