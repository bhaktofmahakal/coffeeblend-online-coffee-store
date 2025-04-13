<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
if (!isset($_GET['id'])) {
    header("location: ".APPURL."/404.php");
    exit;
}

$id = $_GET['id'];

// Get single product
$product = $conn->prepare("SELECT * FROM products WHERE id = ?");
$product->execute([$id]);
$singelProduct = $product->fetch(PDO::FETCH_OBJ);

if (!$singelProduct) {
    header("location: ".APPURL."/404.php");
    exit;
}

// Get related products
$relatedProducts = $conn->prepare("SELECT * FROM products WHERE type = ? AND id != ?");
$relatedProducts->execute([$singelProduct->type, $singelProduct->id]);
$allRelatedProducts = $relatedProducts->fetchAll(PDO::FETCH_OBJ);

// Handle Add to Cart
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $pro_id = $_POST['pro_id'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    $insert_cart = $conn->prepare("INSERT INTO cart (name, image, price, pro_id, description, quantity, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert_cart->execute([$name, $image, $price, $pro_id, $description, $quantity, $user_id]);

    echo "<script>alert('Added to cart successfully');</script>";
}

// Check if product already in cart
$rowCount = 0;
if (isset($_SESSION['user_id'])) {
    $validateCart = $conn->prepare("SELECT * FROM cart WHERE pro_id = ? AND user_id = ?");
    $validateCart->execute([$id, $_SESSION['user_id']]);
    $rowCount = $validateCart->rowCount();
}
?>

<!-- Product Header -->
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Product Detail</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Detail -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="#" class="image-popup">
                    <img src="<?php echo IMAGEPRODUCTS . '/' . $singelProduct->image; ?>" class="img-fluid" alt="Product Image">
                </a>
            </div>

            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $singelProduct->name; ?></h3>
                <p class="price"><span>$<?php echo $singelProduct->price; ?></span></p>
                <p><?php echo $singelProduct->description; ?></p>

                <form method="POST" action="product-single.php?id=<?php echo $id; ?>">
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field=""><i class="icon-minus"></i></button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control text-center input-number" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""><i class="icon-plus"></i></button>
                        </span>
                    </div>

                    <!-- Hidden fields -->
                    <input type="hidden" name="name" value="<?php echo $singelProduct->name; ?>">
                    <input type="hidden" name="image" value="<?php echo $singelProduct->image; ?>">
                    <input type="hidden" name="price" value="<?php echo $singelProduct->price; ?>">
                    <input type="hidden" name="pro_id" value="<?php echo $singelProduct->id; ?>">
                    <input type="hidden" name="description" value="<?php echo $singelProduct->description; ?>">

                    <div class="mt-4">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php if ($rowCount > 0): ?>
                                <button name="submit" type="submit" class="btn btn-secondary py-3 px-5" disabled>Added to Cart</button>
                            <?php else: ?>
                                <button name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-danger">Login to add product to cart</p>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Related Products</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($allRelatedProducts as $related): ?>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="product-single.php?id=<?php echo $related->id; ?>" class="img" style="background-image: url(<?php echo IMAGEPRODUCTS . '/' . $related->image; ?>);"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="product-single.php?id=<?php echo $related->id; ?>"><?php echo $related->name; ?></a></h3>
                            <p><?php echo $related->description; ?></p>
                            <p class="price"><span>$<?php echo $related->price; ?></span></p>
                            <p><a href="product-single.php?id=<?php echo $related->id; ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require "../includes/footer.php"; ?>

<!-- Quantity JS -->
<script>
document.querySelector(".quantity-left-minus").addEventListener("click", function() {
    let qty = document.getElementById("quantity");
    let value = parseInt(qty.value);
    if (value > 1) qty.value = value - 1;
});
document.querySelector(".quantity-right-plus").addEventListener("click", function() {
    let qty = document.getElementById("quantity");
    let value = parseInt(qty.value);
    qty.value = value + 1;
});
</script>
