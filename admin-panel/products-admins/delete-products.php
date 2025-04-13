<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['admin_name'])) {
        header("location: ".ADMINURL."/admins/login-admins.php");
    }

    if(isset($_GET['id'])) {

        $id = $_GET['id'];


        //delete the image
        $select = $conn->query("SELECT * FROM products WHERE id='$id'");
        $select->execute();

        $image = $select->fetch(PDO::FETCH_OBJ);

        unlink("images/".$image->image."");


        $delete = $conn->query("DELETE FROM products WHERE id='$id'");
        $delete->execute();

        header("location: show-products.php");
    }