<?php require "layouts/header.php"; ?>    
<?php require "../config/config.php"; ?>    
<?php 


  if(!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
  }

  //products
  $products = $conn->query("SELECT COUNT(*) AS count_products FROM products");
  $products->execute();

  $productsCount = $products->fetch(PDO::FETCH_OBJ);


    //orders
  $orders = $conn->query("SELECT COUNT(*) AS count_orders FROM orders");
  $orders->execute();
  
  $ordersCount = $orders->fetch(PDO::FETCH_OBJ);


      //bookings
  $bookings = $conn->query("SELECT COUNT(*) AS count_bookings FROM bookings");
  $bookings->execute();

  $bookingsCount = $bookings->fetch(PDO::FETCH_OBJ);


    //admins
    $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
    $admins->execute();
  
    $adminsCount = $admins->fetch(PDO::FETCH_OBJ);


?>
            
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of products: <?php echo $productsCount->count_products; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Orders</h5>
              
              <p class="card-text">number of orders: <?php echo $ordersCount->count_orders; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bookings</h5>
              
              <p class="card-text">number of bookings: <?php echo $bookingsCount->count_bookings; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $adminsCount->count_admins; ?></p>
              
            </div>
          </div>
        </div>
      </div>
   
<?php require "layouts/footer.php"; ?>    
