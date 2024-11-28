<?php
@session_start();
include('db.php');
$user_id = $_SESSION['UserID'];
$sql = "SELECT * FROM `users`  WHERE user_id = '$user_id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>


<section class="vh-100" style="background-color: #AFD7F6;">

    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem; background-color: rgba(255, 255, 255, 0.5);">
                    <div class="card-body p-5 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2755/2755518.png" alt="Icon" width="80" height="80 style=margin-bottom: 100px;">
                        <h3 class="mb-5">แก้ไขข้อมูล</h3>
                        <form action="backend/bn_update_data.php" method="post">
                            <div class="form-outline mb-4" style="display: flex; text-align: left; flex-direction: column;">
                                <label class="form-label" for="typeEmailX-2" style="background-color: transparent; margin-bottom: 5px;">
                                    <i class="bi bi-person-circle" style="vertical-align: middle;"></i> username
                                </label>
                                <input type="text" id="username" name="username" class="form-control form-control-lg" style="background-color: rgba(255, 255, 255, 0.5); border: none;" value="<?php echo $row['username']; ?>" />
                            </div>

                            <div class="form-outline mb-4" style="display: flex; text-align: left; flex-direction: column;">
                                <label class="form-label" for="typeEmailX-2" style="background-color: transparent; margin-bottom: 5px;">
                                    <i class="bi bi-lock-fill"></i>
                                    <label class="form-label" for="typePasswordX-2  style=background-color: transparent; text-align: left; float: left;">Password</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" style="background-color: rgba(255, 255, 255, 0.5);" />
                            </div>

                            <!-- Checkbox -->
                            <!-- <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
              <label class="form-check-label" for="form1Example3"> Remember password </label>
            </div> -->

                            <div class="bt-edit-user">

                                <a href="index.php?id=user" style="text-decoration: none; float: left;">
                                    <button type="button" class="btn btn-outline-dark">
                                        <i class="bi bi-arrow-left" style="margin-right: 5px;"></i> ย้อนกลับ
                                    </button>
                                </a>

                                </a>
                                <a href="index.php?id=user" style="text-decoration: none; float: right;">
                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="bi bi-clipboard-check" style="margin-right: 5px;"></i> บันทึกข้อมูล
                                    </button>
                                </a>
                            </div>

                            <!-- <hr class="my-4">

            <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"
              type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
            <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
              type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>