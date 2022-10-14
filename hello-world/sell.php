<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sell.css">
    <title>Document</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <main>
        <div class="heading">
            <img src="assets/Online Groceries-amico.png" alt="">
            <div class="search">
                <input type="search" class="search-bar" placeholder="Search">
            </div>
        </div>
        <h3>Add Items</h3>
        <form action="">
        <div class="item">
            <div class="item-desc">
                <h3>title</h3>
                <h5>catergory</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, nobis aliquid vero quo voluptate assumenda.</p>
            </div>
            <div class="item-img">
                <img src="assets/Online Groceries-amico.png" alt="">
            </div>
        </div>
        <input type="submit" value="Cancel">
        <input type="submit" value="Submit">
        </form>
    </main>
    <?php
    include 'footer.php';
    ?>
</body>

</html>

