<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="registration.css">
    <script src="registration.js"></script>
</head>
<body>

<div class="container">
    <div class="tabs">


    </div>
    <div class="forms">
        <div class="register">
            <p style="background-color: rgb(99, 147, 192); color: #f1f1f1; font-weight: bold; font: size 20px;">Sign up
                to get started!</p>

            <form method="post" name="register" action="register.php">
                <input class="field" name="username" required type="text" placeholder="Username"/>
                <input class="field" name="email" required type="email" placeholder="myusername@domain.com"/>
                <input id="p1" class="field" name="password" required type="password" placeholder="Password"
                       onchange="form1.p2.pattern=this.value;"/>
                <input id="p2" class="field" name="confirm_password" type="password" placeholder="Rewrite Password"
                       required/>
                <input type="submit" onclick="checkpass()" value="Sign Up"/>
            </form>
        </div>


    </div>
</div>