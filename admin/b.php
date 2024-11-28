<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
@session_start();
include('backNe/db.php');
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

