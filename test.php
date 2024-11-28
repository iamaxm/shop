
<link rel="stylesheet" href="css/stylelogin.css">
<link rel="stylesheet" href="stylee.css">
<section class="vh-100 gradient-custom">
    <!-- <div class="container py-5 h-100"> -->
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-black" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                        <h2 class="fw-bold mb-2 text-uppercase" style="color:white">แก้ไขข้อมูล</h2>

                        <form id="formAuthentication" class="mb-3" action="backend/bn_update_data.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus="">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            

                            <div class="bt-edit-user">

          
                                <a href="index.php?id=user"><button type="button" class="btn btn-outline-danger">ยกเลิก</button></a>
                                <a href="index.php?id=user"><button type="submit" class="btn btn-outline-success">ดำเนินการต่อ</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>