<?php
// เรียกใช้ session_start() ที่บรรทัดแรกของไฟล์
@session_start();

// ตรวจสอบว่ามีการเข้าถึงหน้านี้โดยไม่มีการส่งค่า product_id หรือไม่
if (!isset($_GET['product_id'])) {
    echo "<script>";
    echo "alert(\"ไม่พบข้อมูลสินค้าที่ต้องการแก้ไข\");";
    echo "window.location='../home_admin.php?admin=product';";
    echo "</script>";
    exit;
}

// เชื่อมต่อกับฐานข้อมูล
include('backNe/db.php');

// ตรวจสอบว่ามีการส่งค่า product_id ผ่าน URL หรือไม่
$product_id = $_GET['product_id'];
if (!is_numeric($product_id)) {
    echo "<script>";
    echo "alert(\"รหัสสินค้าต้องเป็นตัวเลขเท่านั้น\");";
    echo "window.location='../home_admin.php?admin=product';";
    echo "</script>";
    exit;
}

// คิวรี่ฐานข้อมูลเพื่อดึงข้อมูลสินค้าที่ต้องการแก้ไข
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "พบข้อผิดพลาดในการดึงข้อมูลสินค้า: " . mysqli_error($conn);
    exit;
}

// ตรวจสอบว่ามีข้อมูลสินค้าที่ต้องการแก้ไขหรือไม่
if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูลสินค้าที่ต้องการแก้ไข";
    exit;
}

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$row = mysqli_fetch_assoc($result);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
    }

    .move-right,
    .move-rights {
        display: flex;
        flex-direction: column;
        align-items: center;
    }


    .move-right {
        margin-left: 150px;
    }

    .move-rights {
        margin-left: 150px;
    }

    .poiuy {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .poiu {
        order: 1;
    }

    .poiuy {
        order: 2;
    }
</style>

<div class="card mt-5" style="padding-top:3rem; margin:2rem 2rem;">
    <div class="card-header d-flex align-items-center justify-content-center">
        <h1 class="mb-0">แก้ไขข้อมูลสินค้า</h1>
    </div>
    <div class="card-body">
        <form action="backNe/BN_edit_product.php" method="post" enctype="multipart/form-data">
            <!-- ส่งค่า product_id ผ่าน session -->
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <div class="row mb-3">
                <h5 class="col-sm-2 col-form-h5" for="product_type">ประเภทสินค้า</h5>
                <div class="col-sm-10">
                    <select class="form-control" id="product_type" name="product_type" aria-label="Default select example">
                        <option selected disabled hidden><?php echo $row['product_type']; ?></option>
                        <option value="ผัก" <?php echo ($row['product_type'] == 'ผัก') ? 'selected' : ''; ?>>ผัก</option>
                        <option value="ผลไม้" <?php echo ($row['product_type'] == 'ผลไม้') ? 'selected' : ''; ?>>ผลไม้</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <h5 class="col-sm-2 col-form-h5" for="product_name">ชื่อสินค้า</h5>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <h5 class="col-sm-2 col-form-h5" for="product_detail">รายละเอียดสินค้า</h5>
                <div class="col-sm-10">
                    <input type="text" class="form-control phone-mask" id="product_detail" name="product_detail" value="<?php echo $row['product_detail']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <h5 class="col-sm-2 col-form-h5" for="product_price">ราคาสินค้า</h5>
                <div class="col-sm-10">
                    <input type="number" class="form-control phone-mask" id="product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <h5 class="col-sm-2 col-form-h5" for="img">รูปภาพ</h5>
                <div class="col-sm-10">
                    <input name="img" type="file" id="img" class="form-control" onchange="previewImage(this);">
                </div>
            </div>


            <div class="row mb-3">
                <div class="flex-container">
                    <div class="move-right">
                        <?php if (!empty($row['img'])) : ?>
                            <h5 class="col-form-h5">รูปภาพเดิม</h5>
                            <img src="product_img/<?php echo $row['img']; ?>" style="height: 300px; width: 300px;">
                        <?php endif; ?>
                    </div>

                    <div class="move-rights">
                        <h5 class="col-form-h5">รูปภาพใหม่</h5>
                        <img id="img-preview" style="height: 300px; width: 300px;">
                    </div>
                </div>
            </div>




            <div class="row mb-3">
                <div class="poiuy">
                    <div class="poiu">
                        <a href="home_admin.php?admin=product" class="btn rounded-pill btn-danger mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>&nbsp;&nbsp;ยกเลิก</a>
                    </div>
                    <div class="poiuy">
                        <button type="submit" class="btn rounded-pill btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                            </svg>&nbsp;&nbsp;บันทึกการแก้ไข</button>
                    </div>
                </div>

            </div>


    </div>

    </form>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>