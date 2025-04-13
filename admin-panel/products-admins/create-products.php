<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

  if(!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
  }

  
  if(isset($_POST['submit'])) {

    if(empty($_POST['name']) OR empty($_POST['price']) OR empty($_POST['description'])
    OR empty($_POST['type'])) {
      echo "<script>alert('one or more inputs are empty');</script>";
    } else {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $type = $_POST['type'];
      $image = $_FILES['image']['name'];

      $dir = "images/" . basename($image);

      $insert = $conn->prepare("INSERT INTO products (name, price, description, type,
       image)
      VALUES (:name, :price, :description, :type, :image)");

      $insert->execute([
        ":name" => $name,
        ":price" => $price,
        ":description" => $description,
        ":type" => $type,
        ":image" => $image,
      ]);

      if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
        header("location: show-products.php");

      }

      
      

    }
  }

?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Product</h5>
          <form method="POST" action="create-products.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control"  />
                 
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
               
                <div class="form-outline mb-4 mt-4">

                  <select name="type" class="form-select  form-control" aria-label="Default select example">
                    <option selected>Choose Type</option>
                    <option value="drink">drink</option>
                    <option value="dessert">dessert</option>
                  </select>
                </div>

                <br>
              

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
<?php require "../layouts/footer.php"; ?>
