
<style>
    /* Google Poppins Font CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing: border-box;
}

/* Variables */
:root{
    --primary-font-family: 'Poppins', sans-serif;
    --light-white:#f5f8fa;
    --gray:#5e6278;
    --gray-1:#e3e3e3;
}
body{
    font-family:var(--primary-font-family);
    font-size: 14px;
} 

/* Main CSS OTP Verification New Changing */ 
.wrapper{
    padding:0 0 100px;
    background-image:url("images/bg.png");
    background-position:bottom center;
    background-repeat: no-repeat;
    background-size: contain;
    background-attachment: fixed;
    min-height: 100%;
    /* height:100vh;
    display:flex;
    align-items:center;
    justify-content:center; */
}
.wrapper .logo img{
    max-width:40%;
    padding-top: 2rem;
    margin-bottom: -3rem;
}
.wrapper input{
    background-color:var(--light-white);
    border-color:var(--light-white);
    color:var(--gray);
}
.wrapper input:focus{
    box-shadow: none;
}
.wrapper .password-info{
    font-size:10px;
}
.wrapper .submit_btn{
    padding:10px 15px;
    font-weight:500;
}
.wrapper .login_with{
    padding:8px 15px;
    font-size:13px;
    font-weight: 500;
    transition:0.3s ease-in-out;
}
.wrapper .submit_btn:focus,
.wrapper .login_with:focus{
    box-shadow: none;
}
.wrapper .login_with:hover{
    background-color:var(--gray-1);
    border-color:var(--gray-1);
}
.wrapper .login_with img{
    max-width:7%;
} 

/* OTP Verification CSS */
.wrapper .otp_input input{
    width:14%;
    height:70px;
    text-align: center;
    font-size: 20px;
    font-weight: 600;
}

@media (max-width:1200px){
    .wrapper .otp_input input{ 
        height:50px; 
    }
}
@media (max-width:767px){
    .wrapper .otp_input input{ 
        height:40px; 
    }
}
        
      
</style>

	<!-- Bootstrap 5 CDN Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<div class="logo">
					<img decoding="async" src="img/lg.png" class="img-fluid" alt="logo">
				</div>
				<form class="rounded bg-white shadow p-5" action="forgot_password/bn_reset_password.php" method="post">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Forget Password ?</h3>

					<div class="fw-normal text-muted mb-4">
						Enter your email to reset your password.
					</div>  

					<div class="form-floating mb-3">
						<input name="email" type="text" id="email" class="form-control" placeholder="name@example.com" required>
						<label for="floatingInput">Email address</label>
					</div>
					<button type="submit" name="send" class="btn btn-primary submit_btn my-4">Submit</button>
				</form>
			</div>
		</div>
	</section>
