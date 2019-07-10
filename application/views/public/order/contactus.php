<!DOCTYPE html>
<html>
<head>

  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!--   <link rel="stylesheet" type="text/css" href="css/custom.css"> -->
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script type="text/javascript" src="js/jquery.min.js"></script>
<!--  <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
  <script type="text/javascript" src="js/customScript.js"></script>
<!-- font Awesome CDN -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link rel="stylesheet" href="css/animate.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">
              
              <li class="nav-item">
                <a class="nav-link" href="#">HOME</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="#">CONTACT US</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="#">ABOUT US</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="#">MENU</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="#">CHECKOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="#">CART</a>
              </li>

            </ul>
          </div>
        </nav>
	<!--Section: Contact v.2-->
<section class="mb-4">
	<div class="jumbotran rounded bg mt-1" style="padding: 6rem;"></div>
<div class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Your name</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="">Subject</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fa fa-map-marker fa-2x"></i>
                    <p>San Francisco, CA 94126, USA</p>
                </li>

                <li><i class="fa fa-phone mt-4 fa-2x"></i>
                    <p>+ 01 234 567 89</p>
                </li>

                <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                    <p>contact@mdbootstrap.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>
</div>
</section>
<!--Section: Contact v.2-->

 <footer class="footer mt-5 pt-5 bg-light">
      <div class="container-fluid ">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>SuperGreen</h3>
            <p style="font-size: 14px!important;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <dl >
              <dt>Main Menu</dt>
              <dd> - Home</dd>
              <dd> - About Us</dd>
              <dd> - Contact Us</dd>
            </dl>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="row text-center">
              <span class="footersocialicons"><i class="fab fa-facebook-f"></i></span>
              <span class="footersocialicons"><i class="fab fa-twitter"></i></span>
              <span class="footersocialicons"><i class="fab fa-instagram"></i>
</span>
              
            </div>

          </div>

        </div>
      </div>
    </footer>
</body>
</html>
