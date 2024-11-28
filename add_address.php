<?php
@session_start();
include('db.php');
$user_id = $_SESSION['UserID'];
$sql = "SELECT * FROM `address` WHERE user_id = '$user_id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<body>
    <!-- Navbar start -->
    <!-- Navbar End -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 10px;
            box-shadow: 0 0 20px 5px rgba(0, 0, 255, 0.2);

        }


        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            /* เพิ่มขนาดตัวอักษร */
            box-sizing: border-box;
            /* ให้ความกว้างรวม padding และ border */
        }
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            /* เพิ่มขนาดตัวอักษร */
            box-sizing: border-box;
            /* ให้ความกว้างรวม padding และ border */
        }

        /* button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        } */

        button[type="submit"]:hover {
            background-color: #72d572;
        }
    </style>


    <body style="background-image: url('https://scontent.fnak1-1.fna.fbcdn.net/v/t1.15752-9/434779706_436062262307128_7853888014596627724_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeGT3SJPOaV5hUseuMkqeVZPKZ0EgtO3U2ApnQSC07dTYG9a1KdgRm43Abxg3-Vx_5i-YigC6QjRCFJXDQ4AWLYA&_nc_ohc=1DBi0-E7eDQAb5SWIcf&_nc_ht=scontent.fnak1-1.fna&cb_e2o_trans=t&oh=03_AdVtEKoP-tPs_FuolWJiGWCoXkRwJmjZQp-Lm0jIWwlLHA&oe=663EFC5E');">
        <div class="container">
            <center>
                <h2>ที่อยู่ในการรับสินค้า</h2> <br>
            </center>
            <form action="backend/bn_save_address.php" method="post">
                <div class="form-group">
                    <label for="full_name"><i class="bi bi-people-fill" style="font-size: 20px;"></i>&nbsp;ชื่อ - นามสกุล</label>

                    <input type="text" style="border-radius: 5px; background-color: transparent;" id="full_name" name="full_name">
                </div>
                <div class="form-group">
                    <label for="phone"><i class="bi bi-telephone-fill" style="font-size: 20px;"></i>&nbsp;เบอร์โทรศัพท์</label>
                    <input type="tel" style="border-radius: 5px; background-color: transparent;" id="phone" name="phone" >
                </div>
                <div class="form-group">
                    <label for="address"><i class="bi bi-house-fill" style="font-size: 20px;"></i>&nbsp;Address (บ้านเลขที่)</label>
                    <input type="text" style="border-radius: 5px; background-color: transparent;" id="address" name="address" >
                </div>
                <div class="form-group">
                    <label for="Sub_district"><i class="bi bi-geo-alt-fill" style="font-size: 20px;"></i>&nbsp;Sub-district (ตำบล)</label>
                    <input type="text" style="border-radius: 5px; background-color: transparent;" id="Sub_district" name="Sub_district">
                </div>
                <div class="form-group">
                    <label for="district"><i class="bi bi-geo-fill" style="font-size: 20px;"></i>&nbsp;District (อำเภอ)</label>
                    <input type="text" style="border-radius: 5px; background-color: transparent;" id="district" name="district">
                </div>
                <div class="form-group">
                    <label for="province"><i class="bi bi-geo-alt-fill" style="font-size: 20px;"></i>&nbsp;Province (จังหวัด)</label>
                    <!-- <input type="text" id="province" name="province" required> -->
                    <select id="province" style="border-radius: 5px; background-color: transparent;" name="province">

                        <option selected disabled hidden>--------------------------------------- เลือกจังหวัด ---------------------------------------</option>
                        <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                        <option value="กระบี่">กระบี่ </option>
                        <option value="กาญจนบุรี">กาญจนบุรี </option>
                        <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                        <option value="กำแพงเพชร">กำแพงเพชร </option>
                        <option value="ขอนแก่น">ขอนแก่น</option>
                        <option value="จันทบุรี">จันทบุรี</option>
                        <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                        <option value="ชัยนาท">ชัยนาท </option>
                        <option value="ชัยภูมิ">ชัยภูมิ </option>
                        <option value="ชุมพร">ชุมพร </option>
                        <option value="ชลบุรี">ชลบุรี </option>
                        <option value="เชียงใหม่">เชียงใหม่ </option>
                        <option value="เชียงราย">เชียงราย </option>
                        <option value="ตรัง">ตรัง </option>
                        <option value="ตราด">ตราด </option>
                        <option value="ตาก">ตาก </option>
                        <option value="นครนายก">นครนายก </option>
                        <option value="นครปฐม">นครปฐม </option>
                        <option value="นครพนม">นครพนม </option>
                        <option value="นครราชสีมา">นครราชสีมา </option>
                        <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                        <option value="นครสวรรค์">นครสวรรค์ </option>
                        <option value="นราธิวาส">นราธิวาส </option>
                        <option value="น่าน">น่าน </option>
                        <option value="นนทบุรี">นนทบุรี </option>
                        <option value="บึงกาฬ">บึงกาฬ</option>
                        <option value="บุรีรัมย์">บุรีรัมย์</option>
                        <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                        <option value="ปทุมธานี">ปทุมธานี </option>
                        <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                        <option value="ปัตตานี">ปัตตานี </option>
                        <option value="พะเยา">พะเยา </option>
                        <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                        <option value="พังงา">พังงา </option>
                        <option value="พิจิตร">พิจิตร </option>
                        <option value="พิษณุโลก">พิษณุโลก </option>
                        <option value="เพชรบุรี">เพชรบุรี </option>
                        <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                        <option value="แพร่">แพร่ </option>
                        <option value="พัทลุง">พัทลุง </option>
                        <option value="ภูเก็ต">ภูเก็ต </option>
                        <option value="มหาสารคาม">มหาสารคาม </option>
                        <option value="มุกดาหาร">มุกดาหาร </option>
                        <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                        <option value="ยโสธร">ยโสธร </option>
                        <option value="ยะลา">ยะลา </option>
                        <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                        <option value="ระนอง">ระนอง </option>
                        <option value="ระยอง">ระยอง </option>
                        <option value="ราชบุรี">ราชบุรี</option>
                        <option value="ลพบุรี">ลพบุรี </option>
                        <option value="ลำปาง">ลำปาง </option>
                        <option value="ลำพูน">ลำพูน </option>
                        <option value="เลย">เลย </option>
                        <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                        <option value="สกลนคร">สกลนคร</option>
                        <option value="สงขลา">สงขลา </option>
                        <option value="สมุทรสาคร">สมุทรสาคร </option>
                        <option value="สมุทรปราการ">สมุทรปราการ </option>
                        <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                        <option value="สระแก้ว">สระแก้ว </option>
                        <option value="สระบุรี">สระบุรี </option>
                        <option value="สิงห์บุรี">สิงห์บุรี </option>
                        <option value="สุโขทัย">สุโขทัย </option>
                        <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                        <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                        <option value="สุรินทร์">สุรินทร์ </option>
                        <option value="สตูล">สตูล </option>
                        <option value="หนองคาย">หนองคาย </option>
                        <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                        <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                        <option value="อุดรธานี">อุดรธานี </option>
                        <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                        <option value="อุทัยธานี">อุทัยธานี </option>
                        <option value="อุบลราชธานี">อุบลราชธานี</option>
                        <option value="อ่างทอง">อ่างทอง </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zipcode"><i class="bi bi-envelope-fill" style="font-size: 20px;"></i>&nbsp;Zipcode (รหัสไปรษณีย์) </label>
                    <input type="text" style="border-radius: 5px; background-color: transparent;" id="zipcode" name="zipcode">
                </div>
                <center>
                    <div>
                        <a href="index.php?id=user"><button type="button" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
                                </svg>
                                ย้อนกลับ
                            </button></a>
                        <button type="submit" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z"></path>
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"></path>
                            </svg>
                            บันทึกที่อยู่
                        </button>
                    </div>
                </center>
            </form>
        </div>
    </body>

    </html>