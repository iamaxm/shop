<!-- <link rel="stylesheet" href="css/stylelogin.css"> -->

<section class="vh-100 gradient-custom">
    <!-- <div class="container py-5 h-100"> -->
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase"  style="color:white">Login</h2>
                            <p class="text-white-50 mb-5">Please Login Your Account!</p>
                            <form id="formAuthentication" class="mb-3" action="backend/login.php" method="POST">
                               
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
                               

                                <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
                                <div>
                                    <p class="mb-0">Don't have an account? <a href="index.php?id=register" class="text-white-50 fw-bold">Register</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>