<?php
@session_start();
include('db.php');
$user_id = $_SESSION['UserID'];
$sql = "SELECT * FROM `address` WHERE user_id = '$user_id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

// ตรวจสอบว่ามีข้อมูลที่อยู่ของผู้ใช้หรือไม่
if (empty($row)) {
    echo "<script>";
    echo "window.location.href = 'index.php?id=add_address';";
    echo "</script>";

    exit(); // หลีกเลี่ยงการทำงานของโค้ดที่เหลือในไฟล์ในกรณีที่มีการ redirect
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    body {
        background-color: #dee9ff;
    }

    .registration-form {
        padding: 50px 0;
    }

    .registration-form .container {

        display: flex;
        justify-content: space-between;
    }

    .registration-form form {
        background-color: #fff;
        max-width: 600px;
        margin: auto;
        padding: 50px 70px;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
    }

    .registration-form .form-icon {
        text-align: center;
        background-color: #5891ff;
        border-radius: 50%;
        font-size: 40px;
        color: white;
        width: 100px;
        height: 100px;
        margin: auto;
        margin-bottom: 10px;
        line-height: 100px;
    }

    .registration-form .item {
        border-radius: 10px;
        margin-bottom: 25px;
        padding: 10px 20px;
    }

    .registration-form .create-account {
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
        background-color: #5791ff;
        border: none;
        color: white;
        margin-top: 20px;
    }

    .registration-form .social-media {
        max-width: 600px;
        background-color: #fff;
        margin: auto;
        padding: 35px 0;
        text-align: center;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        color: #9fadca;
        border-top: 1px solid #dee9ff;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
    }

    .registration-form .social-icons {
        margin-top: 30px;
        margin-bottom: 16px;
    }

    .registration-form .social-icons a {
        font-size: 23px;
        margin: 0 3px;
        color: #5691ff;
        border: 1px solid;
        border-radius: 50%;
        width: 45px;
        display: inline-block;
        height: 45px;
        text-align: center;
        background-color: #fff;
        line-height: 45px;
    }

    .registration-form .social-icons a:hover {
        text-decoration: none;
        opacity: 0.6;
    }

    @media (max-width: 576px) {
        .registration-form form {
            padding: 50px 20px;
        }

        .registration-form .form-icon {
            width: 70px;
            height: 70px;
            font-size: 30px;
            line-height: 70px;
        }
    }
</style>

<body>
    <div class="registration-form">
        <form>
            <div class="form-icon">
                <span><i class="bi bi-house-door-fill"></i></span>
            </div>
            <!-- <h1><center>ที่อยู่ของฉัน</center></h1> -->
            <div class="form-group">
                <label for=""><i class="bi bi-people-fill"style="font-size: 20px;"></i>&nbsp;ชื่อ - นามสกุล</label>
                <p class="form-control item"><?php echo $row['full_name']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-telephone-fill" style="font-size: 20px;"></i>&nbsp;เบอร์โทรศัพท์</label>
                <p class="form-control item"><?php echo $row['phone']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-house-fill"style="font-size: 20px;"></i>&nbsp;Address (บ้านเลขที่)</label>
                <p class="form-control item"><?php echo $row['address']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-geo-alt-fill" style="font-size: 20px;"></i>&nbsp;Sub-district (ตำบล)</label>
                <p class="form-control item"><?php echo $row['sub_district']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-geo-fill"style="font-size: 20px;"></i>&nbsp;District (อำเภอ)</label>
                <p class="form-control item"><?php echo $row['district']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-geo-alt-fill"style="font-size: 20px;"></i>&nbsp;Province (จังหวัด)</label>
                <p class="form-control item"><?php echo $row['province']; ?></p>
            </div>
            <div class="form-group">
                <label for=""><i class="bi bi-envelope-fill"style="font-size: 20px;"></i>&nbsp;Zipcode (รหัสไปรษณีย์)</label>
                <p class="form-control item"><?php echo $row['zipcode']; ?></p>
            </div>
        </form>
        <div class="social-media">
            <div class="container">
                <a href="index.php?id=user"><button type="button" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
                        </svg>
                        ย้อนกลับ
                    </button></a>
                <a href="index.php?id=edit_address"><button type="button" class="btn btn-outline-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                            <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"></path>
                        </svg>
                        แก้ไขที่อยู่
                    </button></a>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>