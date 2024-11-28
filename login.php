<style>
  .container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    /* ห้าม */
  }

  .login-form h1 {
    text-align: center;
    margin-bottom: 20px;
    /* ปรับระยะห่าง */
  }

  .login-form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 50px;
    background-color: #000;
    color: #fff;
    border: 1px solid #000;
    border-radius: 5px;
    cursor: pointer;
    /* ห้าม */
  }

  .login-form a {
    text-align: center;
    color: #000;
    text-decoration: none;
    text-align: center;
    /* จัดการให้ข้อความอยู่ตรงกลาง */
    /* ห้าม */
  }

  .input-group-text {
    background-color: rgba(255, 255, 255, 0);
  }



  .login-form {
    width: 500px;
    padding: 50px;
    border: 1px solid #ccc;
    border-radius: 20px;
    background-color: #fff;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: transparent;
    height: 550px; /* ปรับค่าตามที่ต้องการ */
}

  .links {
  margin-top: 20px;
  text-align: center;
  position: absolute;
  bottom: -50px; /* ปรับค่าตามที่ต้องการ */
  left: 50%;
  transform: translate(-50%, 50%);
}

.links- {
  margin-top: 20px;
  text-align: center;
  position: absolute;
  bottom: -10px; /* ปรับค่าตามที่ต้องการ (ต่างจาก .links) */
  left: 50%;
  transform: translate(-50%, 50%);
}

.links,
.links- {
  white-space: nowrap; /* ข้อความจะไม่ตัดเส้น */
  overflow: hidden; /* ลิงก์ที่ไม่อยู่ในหน้าจอจะถูกซ่อนไว้ */
  text-overflow: ellipsis; /* ข้อความที่เกินจากการแสดงจะแสดงเป็น ... */
}


</style>

</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://scontent.fnak1-1.fna.fbcdn.net/v/t1.15752-9/435535438_432185609360199_7835561982867815163_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeGtu8iHG02-J5gbzT0iirhJFLEPxOgZTswUsQ_E6BlOzMPWElS-J81BLojRJDRJmG46g85fUl1i1h-n6jCFnsD2&_nc_ohc=rRizgBI65noAb6kNUFg&_nc_oc=Adgxmd0hQv4GgPNdbp5gLXt3C7-jLnzdzJt35QlH9SPDzMG8g1C25_Futp_FNHWigu4&_nc_ht=scontent.fnak1-1.fna&cb_e2o_trans=t&oh=03_AdWxN1rrnSJTroLdJrkeKJGyjsfuugmYqnUIRwffa3U__A&oe=663C19BA">
</head>

<body style="background-image: url('https://scontent.fnak1-1.fna.fbcdn.net/v/t1.15752-9/435535438_432185609360199_7835561982867815163_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeGtu8iHG02-J5gbzT0iirhJFLEPxOgZTswUsQ_E6BlOzMPWElS-J81BLojRJDRJmG46g85fUl1i1h-n6jCFnsD2&_nc_ohc=rRizgBI65noAb6kNUFg&_nc_oc=Adgxmd0hQv4GgPNdbp5gLXt3C7-jLnzdzJt35QlH9SPDzMG8g1C25_Futp_FNHWigu4&_nc_ht=scontent.fnak1-1.fna&cb_e2o_trans=t&oh=03_AdWxN1rrnSJTroLdJrkeKJGyjsfuugmYqnUIRwffa3U__A&oe=663C19BA'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
  <div class="container">
    <div class="login-form">
      <h1 style="text-align: center;">
        <i class="bi bi-person-circle" style="font-size: 48px;">
        </i>
      </h1>
      <h1 style="font-size: 30px;">ลงชื่อเข้าใช้</h1>
      <form action="backend/bn_login.php" method="post">
        <div class="input-group mt-2">
          <div class="input-group-text bg-info" style="border-radius: 0;"><i class="fas fa-user"></i>
          </div>
          <input class="form-control" style="border-radius: 5px; background-color: transparent;" type="text" id="email_or_username" name="email_or_username" placeholder="อีเมลหรือชื่อผู้ใช้">

          <div class="input-group mt-2">
            <div class="input-group-text bg-info" style="border-radius: 0;"><i class="fas fa-lock"></i>
            </div>
            <input class="form-control" style="border-radius: 5px; background-color: transparent;" type="password" id="password" name="password" placeholder="รหัสผ่าน">
            <button type="submit" style="background-color:#52cffe;  margin-top: 25px;  border: none; border-radius: 0;">เข้าสู่ระบบ</button>
            <div class="links" style="margin-top: 20px; text-align: center; display: flex; justify-content: center;">
              <span style="color: #999;">ลืมรหัสผ่าน?</span>
              <a href="index.php?id=reset_password" style="color: #52cffe; text-decoration: none; margin-left: 5px;">รีเซ็ตรหัสผ่าน!</a>
            </div>
            <div class="links-" style="margin-top: 20px; text-align: center; display: flex; justify-content: center;">
              <span style="color: #999;">คุณยังไม่มีบัญชีใช่ไหม?</span>
              <a href="index.php?id=register" style="color: #52cffe; text-decoration: none; margin-left: 5px;">สมัครเลย!</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>