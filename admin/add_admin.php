<?php
@session_start();

if ($_SESSION["User"] != '') {
  // ตรวจสอบว่ามี session status และไม่ใช่ admin ให้ redirect ไปยังหน้าที่ไม่อนุญาติให้เข้าถึง
  if (isset($_SESSION['User'])) {
    // เช็คว่าผู้ใช้ไม่ใช่ admin และไม่ใช่ superadmin
    if ($_SESSION['status'] == 'admin') {
      header('Location: ../index.php?id=dashboard');
      exit; // หยุดการทำงานของสคริปต์
    } else if ($_SESSION['status'] == 'user') {
      header('Location: ../index.php?id=login');
      exit; // หยุดการทำงานของสคริปต์
    }
  } else {
    header('Location: ../index.php');
    exit; // หยุดการทำงานของสคริปต์
  }
}



?>
<style>
  .card {
    width: 40%;

  }

  .authentication-inner {
    align-items: center;
    height: 100%;
    margin-top: 2rem;
  }
</style>

<body>
  <!-- Content -->
  <center>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <br>
              <div class="app-brand justify-content-center">
                <a href="" class="app-brand-link gap-2">
                  <h1 class="app-brand-text demo text-body fw-bolder">เพิ่มผู้ดูแลระบบ</h1>
                </a>
              </div><br>
              <!-- /Logo -->

              <form id="formAuthentication" class="mb-3" action="backNe/BN_add_admin.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label><br>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus="">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="············" aria-describedby="password">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>


                <button type="submit" class="btn btn-primary d-grid w-100">สมัครสมาชิก</button>
              </form>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
  </center>


  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>


</body>