<?php
$page = 'contact';
include(__DIR__ . '/include/header.php');
?>
<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start"
      data-scrollax-parent="true">
      <div class="col-md-8 ftco-animate text-center text-md-left mb-5"
        data-scrollax=" properties: { translateY: '70%' }">
        <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a
              href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact Us</span></p>
        <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Contact Us</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section contact-section bg-light">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">
      <div class="col-md-12 mb-4">
        <h2 class="h3">Contact Information</h2>
      </div>
      <div class="w-100"></div>
      <div class="col-md-3">
        <p><span>Address:</span> 108/M/1 South Kodalia, Kolkata - 700131</p>
      </div>
      <div class="col-md-3">
        <p><span>Phone:</span> <a href="tel:+916289540499"> +91 6289540499</a></p>
      </div>
      <div class="col-md-3">
        <p><span>Email:</span> <a href="mailto:joblifeforu@gmail.com"> joblifeforu@gmail.com</a></p>
      </div>
      <div class="col-md-3">
        <p><span>Website:</span> <a href="https://www.joblyfe.com" target="_blank"> www.joblyfe.com</a></p>
      </div>
    </div>
    <div class="row block-9">
      <!-- <div class="col-md-6 order-md-last d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div> -->

      <div class="col-md-12 d-flex">
        <!-- <div id="map" class="bg-white"> -->
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d58904.420664250356!2d88.420531!3d22.671444!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89efaa97f1547%3A0x5803a6ab32a50237!2sBisharpara%2C%20Birati%2C%20Kolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1735327830819!5m2!1sen!2sin"
          width="1400" height="600" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- </div> -->
      </div>
    </div>
  </div>
</section>

<!-- <section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

<?php
include(__DIR__ . '/include/footer.php');
?>