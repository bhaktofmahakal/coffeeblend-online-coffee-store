<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Contact Us</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section contact-section">
  <div class="container mt-5">
    <div class="row block-9">
      <div class="col-md-4 contact-info ftco-animate">
        <div class="row">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Address:</span> Antu, Uttar Pradesh 230501</p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Phone:</span> <a href="tel://1234567920">+91 12345 67890</a></p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Email:</span> <a href="mailto:info@coffeeblend.com">info@coffeeblend.com</a></p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Website:</span> <a href="#">coffeeblend.com</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-1"></div>

      <div class="col-md-6 ftco-animate">
        <form action="#" class="contact-form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Google Map Iframe -->
<div class="container mb-5" style="border-radius: 10px; overflow: hidden;">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28675.542251134084!2d81.87810544786943!3d26.0517819944707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399a8ce2b5879dc1%3A0xd0c3fcce7108dd40!2sAntu%2C%20Uttar%20Pradesh%20230501!5e0!3m2!1sen!2sin!4v1731931702972!5m2!1sen!2sin" 
    width="100%" 
    height="400" 
    style="border:0; filter: brightness(90%) contrast(110%);" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>

<?php require "includes/footer.php"; ?>
