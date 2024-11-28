<style>
.container {
  margin-top: -6px; /* ปรับตำแหน่งของฟอร์มขึ้นมา */
}


  </style>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://scontent.fnak1-1.fna.fbcdn.net/v/t1.15752-9/434054091_2086443808408578_845359566241823804_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeExyYl78fAJIx1Ungv8W0xpT8vpmxFSrmBPy-mbEVKuYFehgA3jl3nGXaxJpqVGfFnCjCNcMRktUqXtVEByWens&_nc_ohc=sW3HdLT694gAb6V6vx9&_nc_ht=scontent.fnak1-1.fna&cb_e2o_trans=t&oh=03_AdXlfrJ5oONky50rVd1Fhs85u8XG8xI52udv71ENOZ-kMw&oe=663C0A28">
</head>
<body style="background-image: url('https://scontent.fnak1-1.fna.fbcdn.net/v/t1.15752-9/434054091_2086443808408578_845359566241823804_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeExyYl78fAJIx1Ungv8W0xpT8vpmxFSrmBPy-mbEVKuYFehgA3jl3nGXaxJpqVGfFnCjCNcMRktUqXtVEByWens&_nc_ohc=sW3HdLT694gAb6V6vx9&_nc_ht=scontent.fnak1-1.fna&cb_e2o_trans=t&oh=03_AdXlfrJ5oONky50rVd1Fhs85u8XG8xI52udv71ENOZ-kMw&oe=663C0A28'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
  <section class="vh-100" style="background: none;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card-body p-1 text-center" style="border: 2px solid black; border-radius: 1rem;">
            <div class="card-body p-1 text-center"> <!-- เปลี่ยน p-5 เป็น p-3 -->
              <div class="container">
                <div class="login-form">
                  <h1 style="text-align: center;">
                    <i class="bi bi-people" style="font-size: 70px; position: relative; top: 9px;"></i>
                  </h1>
                  <h3 class="mb-3" style="text-align: center; font-size: 35px;">สมัครสมาชิก!</h3> <!-- เปลี่ยน mb-5 เป็น mb-3 -->
                  <form action="backend/bn_register.php" method="post">
                    <div class="form-outline-0 mb-4">
                      <label class="form-label" for="typeEmailX-2">ชื่อผู้ใช้</label>
                      <input type="text" id="username" name="username" class="form-control form-control-lg" style="background-color: transparent; border: 2px solid black; border-radius: 0.5rem;" />

                    </div>
                    <div class="form-outline-0 mb-4">
                      <label class="form-label" for="typeEmailX-2">อีเมล</label>
                      <input type="email" id="email" name="email" class="form-control form-control-lg" style="background-color: transparent; border: 2px solid black; border-radius: 0.5rem;" autocomplete="email">

                    </div>
                    <div class="form-outline-0 mb-4">
                      <label class="form-label" for="typePasswordX-2">รหัสผ่าน</label>
                      <input type="password" id="password" name="password" class="form-control form-control-lg" style="background-color: transparent; border: 2px solid black; border-radius: 0.5rem;" autocomplete="new-password">

                    </div>
                    <div class="form-outline-0 mb-4">
                      <label class="form-label" for="typePasswordX-2">กรอกรหัสผ่านอีกครั้ง</label>
                      <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg" style="background-color: transparent; border: 2px solid black; border-radius: 0.5rem;" autocomplete="new-password">
                    </div>
                    <button class="btn btn-outline-dark" type="submit">สมัคร</button>
                    <div>
                      <br>
                      <p class="mb-0">คุณมีสมาชิกแล้วใช่ไหม? <span style="margin-right: 5px;"></span><a href="index.php?id=login" class="text-black-50 fw-bold">เข้าสู่ระบบ</a></p>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</body>
</html>