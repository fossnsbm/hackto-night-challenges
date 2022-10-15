</head>
<body>
	<header>
		<a href="#"><img src="img/main/logo.png" class="main-logo" alt="logo"></a>
		<nav>
			<ul class="nav_link">
				<li><a href="#">Home</a></li>
				<li><a href="#">Sell</a></li>
				<li><a href="#">Cart</a></li>
				<li><a href="#">Profile</a></li>
				
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