<?php 
session_start();
include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
  </head>
  <body>
    <section class="h-100 gradient-form" style="background-color: #eee">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
                    <div class="text-center">
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                        style="width: 185px"
                        alt="logo"
                      />
                      <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                    </div>
                    <a href="./AdminLogin/login.php">Admin Login</a>
                    <h1>Login Here</h1>

                    <?php 
			
			if(isset($_COOKIE['success']))
			{
				echo "<p>".$_COOKIE['success']."</p>";
			}
			if(isset($_COOKIE['error']))
			{
				echo "<p>".$_COOKIE['error']."</p>";
			}
			
			function filterData($data)
			{
				return addslashes(strip_tags(trim($data)));
			}
			if(isset($_POST['login']))
			{
				$email = (isset($_POST['email'])) ? filterData($_POST['email']) : "";
				$pass = (isset($_POST['pwd'])) ? filterData($_POST['pwd']) : "";
				
				$result = mysqli_query($con,"select *from users where email='$email'");
				
				if(mysqli_num_rows($result)==1)
				{
					$row = mysqli_fetch_assoc($result);
					if(password_verify($pass, $row['password']))
					{
						if($row['status'] == "active")
						{
							$_SESSION["userid"] = $row['id'];
							header("Location:home.php");
						}
						else
						{
							echo "<p>Please activate your account<p>";
						}
					}
					else
					{
						echo "<p>Sorry! Wrong credentials entered</p>";
					}
				}
				else
				{
					echo "<p>Sorry! Unable to find your account</p>";
				}
				
			}
			?>

                    <form method="POST" action="" onsubmit="return loginValidate()">
                      <p>Please login to your account</p>

                      <div class="form-outline mb-4">
                        <input
						onfocus="hideError(this)" onblur="checkError(this)" name="email" id="email" type="email" class="form-control form-control-lg"
                          type="email"
                          id="email"
                          class="form-control"
                          placeholder="Email address"
                        />
                        <label class="form-label" for="form2Example11"
                          >Email</label
                        >
                      </div>

                      <div class="form-outline mb-4">
                        <input
						onfocus="hideError(this)" onblur="checkError(this)" type="password" name="pwd" id="pwd" 
                         
                          class="form-control"
                        />
                        <label class="form-label" for="form2Example22"
                          >Password</label
                        >
                      </div>

                      <div class="text-center pt-1 mb-5 pb-1">
                        <button type="submit" name="login" value="Login" class="btn btn-outline-danger" type="button">
                          Log in
                        </button>
                        <br />
                        <a class="text-muted" href="#!">Forgot password?</a>
                      </div>

                      <div
                        class="d-flex align-items-center justify-content-center pb-4"
                      >
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <a href="registeration.html">
                          <button type="button" type="submit" name="login" value="Login" class="btn btn-outline-danger">
                            Create new
                          </button>
                        </a>
                      </div>
                    </form>
                  </div>
                </div>
                <div
                  class="col-lg-6 d-flex align-items-center gradient-custom-2"
                >
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">We are more than just a company</h4>
                    <p class="small mb-0">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	<script src="js/validations.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/mdb.min.js"></script>
	<script src="js/index.js"></script>	
  </body>
</html>
