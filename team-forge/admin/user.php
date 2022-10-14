<?php
include "../connection.php";
?>


<!DOCTYPE html>
<html>
<head>

    <title>User</title>
    <!-- Include CSS File Here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link href="assets/css/mystle.css" rel="stylesheet">
</head>
<body class="bgcol">
<div class="container_1">
    <div class="sidebar">
        <ul>
            <li>
                <a href="#">
                    <i class="fas fa-clinic-medical"></i>
                    <div class="title">RED HILLS</div>
                </a>
            </li>
            <li>
                <a href="Adminpan.php">
                    <i class="fas fa-th-"></i>
                    <div class="title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="movies.php">
                    <i class="fas fa-"></i>
                    <div class="title">Movies</div>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <i class="fas fa"></i>
                    <div class="title">Users</div>
                </a>
            </li>


            <li>
                <a href="AdminLogIn.php">
                    <i class="fas fa"></i>
                    <div class="title">Log Out</div>
                </a>
            </li>

        </ul>
    </div>
    <div class="main">
        <div class="text-center" style="font-size: 40px !important;">
            User Details
        </div>
        <?php
        $user_list = '';
        $search = '';
        $sql = '';


        $sql = "SELECT * FROM user WHERE role != 'admin' ORDER BY id ASC";


        $users = mysqli_query($connection, $sql);
        if ($users) {
            while ($user = mysqli_fetch_assoc($users)) {

                $user_list .= "<tr>";

                $user_list .= "<td>{$user['id']}</td>";
                $user_list .= "<td>{$user['username']}</td>";
                $user_list .= "<td>{$user['email']}</td>";

                $user_list .= "<td><button class='conf_delete' onclick='return DeleteUser()==true'><a id='delete' href=\"delete.php?user_id={$user['id']}\">delete</a></button></td>";

                $user_list .= "</tr>";
            }

        } else {
            echo "Database  related error " . $connection->error;
        }

        ?>


    </div>
</div>
</body>
</html>