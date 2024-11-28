<!DOCTYPE html>
<html>
<head>
    <title>ค้นหาสินค้า</title>
</head>
<body>

<h1>ค้นหาสินค้า</h1>

<form method="get" action="">
    <label for="search_query">ค้นหา:</label>
    <input type="text" id="search_query" name="q">
    <button type="submit">ค้นหา</button>
</form>

<?php
// การเชื่อมต่อกับฐานข้อมูล MySQL
include("db.php");


// ตรวจสอบว่ามีการส่งคำค้นหามาหรือไม่
if (isset($_GET['q'])) {
    $search_query = $_GET['q']; // เก็บคำค้นหาที่ผู้ใช้ป้อนเข้ามา

    // สร้างคำสั่ง SQL เพื่อค้นหาชื่อสินค้าที่มีคำค้นหา
    $sql = "SELECT * FROM products WHERE name LIKE '%" . $search_query . "%'";
    
    // ดึงข้อมูลจากฐานข้อมูล
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีผลลัพธ์จากการค้นหาหรือไม่
    if ($result->num_rows > 0) {
        // แสดงผลลัพธ์
        echo "<h2>ผลการค้นหาสำหรับ: " . htmlspecialchars($search_query) . "</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['name'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>ไม่พบสินค้าที่ตรงกับคำค้นหา</p>";
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>

</body>
</html>
