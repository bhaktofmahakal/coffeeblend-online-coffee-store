<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

	if(!isset($_SERVER['HTTP_REFERER'])){
		header('location: http://localhost/coffee-blend');
		exit;
	}

	if(!isset($_SESSION['user_id'])) {
		header("location: ".APPURL."");
		exit;
	}

	$type = $_GET['type'] ?? null;
	$ref_id = $_GET['id'] ?? null;

	if(!$type || !$ref_id) {
		echo "<script>alert('Invalid review request');window.location.href='".APPURL."';</script>";
		exit;
	}

	if(isset($_POST['submit'])) {

		if(empty($_POST['review'])) {
			echo "<script>alert('Review field is empty');</script>";
		} else {

			$review = $_POST['review'];
			$username = $_SESSION['username'];

			// Check if already reviewed
			if($type === 'booking') {
				$check = $conn->prepare("SELECT * FROM reviews WHERE booking_id = :ref_id");
			} else {
				$check = $conn->prepare("SELECT * FROM reviews WHERE order_id = :ref_id");
			}

			$check->execute([":ref_id" => $ref_id]);

			if($check->rowCount() > 0) {
				echo "<script>alert('You have already submitted a review for this.');</script>";
			} else {
				// Insert review
				if($type === 'booking') {
					$insert = $conn->prepare("INSERT INTO reviews (review, username, booking_id) VALUES (:review, :username, :ref_id)");
				} else {
					$insert = $conn->prepare("INSERT INTO reviews (review, username, order_id) VALUES (:review, :username, :ref_id)");
				}

				$insert->execute([
					":review" => $review,
					":username" => $username,
					":ref_id" => $ref_id
				]);

				echo "<script>alert('Review submitted successfully'); window.location.href='".APPURL."';</script>";
			}
		}
	}
?>

<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">
				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Write Review</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Write Review</span></p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<form action="" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
					<h3 class="mb-4 billing-heading">Write a Review</h3>
					<div class="row align-items-end">
						<div class="col-md-12">
							<div class="form-group">
								<label for="review">Review</label>
								<input name="review" type="text" class="form-control" placeholder="Write your review here...">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group mt-4">
								<div class="radio">
									<p><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Submit Review</button></p>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>
</section>

<?php require "../includes/footer.php"; ?>
