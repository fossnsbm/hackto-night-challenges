<html>
    <head>
    <mrta charset="UTF-8"></mrta>
        <meta http-equiv="='X-UA-Compatible" content="'IF-edge">
        <meta name="viewpoint" content="width=device-width.initial-scale=1.0">
        <title>BBH Warehouse</title>

        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

        <link rel="stylesheet" href="style.css">
<!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <header>
                    <a href="#" class="logo">BBH Warehouse</a>
                    <div class="bx bx-menu" id="menu-icon"></div>
        
                    <ul class="navbar">
                        <li><a href="#login">Login</a></li>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#sell">Sell</a></li>
                        <li><a href="#cart">Cart</a></li>
                        <li><a href="#profile">Profile</a></li>
                        
                        <div class="bx bx-moon" id="darkmode"></div>
                    </ul>
                </header>
                
                <selection class="home" id="home">
                    <div class="home-text">
                        

                    </div>

                    

                </selection>
      </header>
    </body>
</html>
<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin_page.php');
 };
 
 ?>

<?php

$select = mysqli_query($conn, "SELECT * FROM products");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
         <td><?php echo $row['name']; ?></td>
         <td>$<?php echo $row['price']; ?>/-</td>
         <td>
            
         </td>
      </tr>
   <?php } ?>
   </table>
</div>

</div>


</body>


</html>