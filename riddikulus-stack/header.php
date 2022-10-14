<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title></title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse " id="navbarSupportedContent" >
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
            <h6 class="h6"><a class="nav-link active text-white" aria-current="page" href="#">Home</a></h6>
        </li>
        <li class="nav-item">
            <h6 class="h6"><a class="nav-link text-white" href="#">Sell</a></h6>
        </li>
        <li class="nav-item">
            <h6 class="h6"><a class="nav-link text-white" href="#">Cart</a></h6>
        </li>
        <li class="nav-item">
            <h6 class="h6"><a class="nav-link text-white" href="#">Profile</a></h6>
        </li>
      </ul>
    </div>
  </div>
</nav>
=======
</head>
<body>
	<header>
		<a href="#"><img src="img/main/logo.png" class="main-logo" alt="logo"></a>
		<nav>
			<ul class="nav_link">
				<li><a href="#">Home</a></li>
				<li><a href="#">Hotels</a></li>
				<li><a href="#">Vehicles</a></li>
				<li><a href="#">Restaurants</a></li>
				<li><a href="#">Packages</a></li>
				<li><a href="#">Notices</a></li>
				<li><a href="#">Attraction</a></li>
				<li><a href="#">About Us</a></li>
				<?php
					if(isset($_SESSION['logged'])){
						echo '<li><a href="prof.php" class="login"><button class="btn-animation">Account</button></a></li>';
					}else{
						echo '<li><a href="login1.php" class="login"><button class="btn-animation">Login</button></a></li>';
					}
				?>
			</ul>
		</nav>
		<div class="burger">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</header>
	<hr>
>>>>>>> 60dc9d924c77946fbe464fc94a835f2ad70b04bd
