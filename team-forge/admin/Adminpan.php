<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/mystle.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin panel</title>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</head>

<body>


<div class="container_1">
    <div class="sidebar">
        <ul>
            <li>
                <a href="#">
                    <i class="fas fa-clinic-"></i>
                    <div class="title">RED HILL</div>
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
                <a href="user.php">
                    <i class="fas fa"></i>
                    <div class="title">Users</div>
                </a>
            </li>


            <li>
                <a href="AdminLogIn.php">
                    <i class="fas fa"></i>
                    <div class="title">Log Out</div>
                </a>

        </ul>
    </div>
    <div class="main">

        <div class="cards">
            <div class="card">
                <div class="card-content">
                    <div class="number">67</div>
                    <div class="card-name">Movies</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-p"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">105</div>
                    <div class="card-name">Users</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">8</div>
                    <div class="card-name">Upcoming movies</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="number">$450</div>
                    <div class="card-name">Earnings</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa"></i>
                </div>
            </div>
        </div>


        <div class="tables">
            <div class="last-appointments">
                <div class="heading">
                    <h2>Ticket selling rate</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                <table class="appointments">
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    <script>
                        var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        var yValues = [55, 49, 44, 24, 15, 90, 12, 45, 39, 67, 49, 87];
                        var barColors = ["red", "green", "blue", "orange", "brown", "pink", "red", "green", "blue", "orange", "brown", "pink"];

                        new Chart("myChart", {
                            type: "horizontalBar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                legend: {display: false},
                                title: {
                                    display: true,
                                    text: "Monthly ticket selling rates"
                                },
                                scales: {
                                    xAxes: [{ticks: {min: 10, max: 60}}]
                                }
                            }
                        });
                    </script>


                </table>
            </div>
            <div class="doctor-visiting">
                <div class="heading">
                    <h2>Trending movies</h2>
                    <a href="#" class="btn">View All</a>
                </div>
                <table class="visiting">
                    <thead>
                    <td>Photo</td>
                    <td>Movie Name</td>
                    <td>Tickets</td>

                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="img-box-small">
                                <img src="assets/img/Movies/c4.jpg" alt="">
                            </div>
                        </td>
                        <td>Morbious</td>
                        <td>3000</td>


                    </tr>
                    <tr>
                        <td>
                            <div class="img-box-small">
                                <img src="assets/img/Movies/u1.jpg">
                            </div>
                        </td>
                        <td>Texes</td>
                        <td>2800</td>

                    </tr>
                    <tr>
                        <td>
                            <div class="img-box-small">
                                <img src="assets/img/Movies/u8.jpg">
                            </div>
                        </td>
                        <td>Restless</td>
                        <td>2200</td>

                    </tr>
                    <tr>
                        <td>
                            <div class="img-box-small">
                                <img src="assets/img/Movies/u2.jpg">
                            </div>
                        </td>
                        <td>Downfall</td>
                        <td>1800</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>