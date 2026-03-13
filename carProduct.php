<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="HVAC Template">
  <meta name="keywords" content="HVAC, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="robots" content="noindex, nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

  <title>HVAC | Template</title>

  <link href="https://fonts.googleapis.com/css2e027.css?family=Lato:wght@300;400;700;900&amp;display=swap"
        rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">

  <?php
  include "Db.php";

  define('_DB_HOST', 'localhost');
  define('_DB_NAME', 'frydrva1');
  define('_DB_USER', 'frydrva1');
  define('_DB_PASSWORD', 'venda2007');


  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  try {
      Db::connect(_DB_HOST, _DB_NAME, _DB_USER, _DB_PASSWORD);
  } catch (Exception $ex) {
      echo "Chyba připojení k databázi: " . $ex->getMessage();
      exit;
  }

  $allRecords = Db::queryAll('SELECT * FROM pauta');
  
  if (isset($_GET['id'])) {
    $car = Db::queryOne('SELECT * FROM pauta WHERE id = ?', [$_GET['id']])
  }

  ?>
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
  <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
  <div class="offcanvas__widget">
    <a href="#"><i class="fa fa-cart-plus"></i></a>
    <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
    <a href="#" class="primary-btn">Add Car</a>
  </div>
  <div class="offcanvas__logo">
    <a href="index-2.html"><img src="img/logo.png" alt="" fetchpriority="high" decoding="sync"></a>
  </div>
  <div id="mobile-menu-wrap"></div>
  <ul class="offcanvas__widget__add">
    <li><i class="fa fa-clock-o"></i> Week day: 08:00 am to 18:00 pm</li>
    <li><i class="fa fa-envelope-o"></i> Info.colorlib@gmail.com</li>
  </ul>
  <div class="offcanvas__phone__num">
    <i class="fa fa-phone"></i>
    <span>(+12) 345 678 910</span>
  </div>
  <div class="offcanvas__social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-google"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
  </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
  <div class="header__top">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <ul class="header__top__widget">
            <li><i class="fa fa-clock-o"></i> Week day: 08:00 am to 18:00 pm</li>
            <li><i class="fa fa-envelope-o"></i> Info.colorlib@gmail.com</li>
          </ul>
        </div>
        <div class="col-lg-5">
          <div class="header__top__right">
            <div class="header__top__phone">
              <i class="fa fa-phone"></i>
              <span>(+12) 345 678 910</span>
            </div>
            <div class="header__top__social">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-google"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <div class="header__logo">
          <a href="index-2.html"><img src="img/logo.png" alt="" fetchpriority="high" decoding="sync"></a>
        </div>
      </div>
      <div class="col-lg-10">
        <div class="header__nav">
          <nav class="header__menu">
            <ul>
              <li><a href="index-2.html">Home</a></li>
              <li class="active"><a href="car.php">Cars</a></li>
              <li><a href="car-details.html">Car Details</a></li>
              <li><a href="about.html">About us</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="canvas__open">
      <span class="fa fa-bars"></span>
    </div>
  </div>
</header>
<!-- Header Section End -->

<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Car Listing</h2>
          <div class="breadcrumb__links">
            <a href="index-2.html"><i class="fa fa-home"></i> Home</a>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Begin -->

<!-- Car Section Begin -->

          
          <?php
          if ($allRecords) {
            echo('  
            
                <div class="col-lg-4 col-md-4">
                  <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                      <img src="img/cars/car-3.jpg" alt="" loading="lazy" decoding="async">
                    </div>
                    <div class="car__item__text">
                      <div class="car__item__text__inner">
                        <div class="label-date">' . $record["rok"] . '</div>
                        <h5><a href="#">' . $record["znacka"] . ' '.  $record["model"] . '</a></h5>
                        <ul>
                          <li><span>' . $record["najezd"] . '</span> km</li>
                          <li>' . $record["motorizace"] . 'L</li>
                          <li><span></span> hp</li>
                        </ul>
                      </div>
                      <div class="car__item__price">
                        <span class="car-option">' . $record["cena"] . '</span>
                        <h6></h6>
                      </div>
                    </div>
                  </div>
                </div>
            ');            
          }
            ?>
        </div>
      </div>
    </div>
</section>
        
<!-- Car Section End -->

<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
  <div class="container">
    <div class="footer__contact">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="footer__contact__title">
            <h2>Contact Us Now!</h2>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="footer__contact__option">
            <div class="option__item"><i class="fa fa-phone"></i> (+12) 345 678 910</div>
            <div class="option__item email"><i class="fa fa-envelope-o"></i> Colorlib@gmail.com</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="footer__about">
          <div class="footer__logo">
            <a href="#"><img src="img/footer-logo.png" alt="" loading="lazy" decoding="async"></a>
          </div>
          <p>Any questions? Let us know in store at 625 Gloria Union, California, United Stated or call us
            on (+1) 96 123 8888</p>
          <div class="footer__social">
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="google"><i class="fa fa-google"></i></a>
            <a href="#" class="skype"><i class="fa fa-skype"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-2 offset-lg-1 col-md-3">
        <div class="footer__widget">
          <h5>Infomation</h5>
          <ul>
            <li><a href="#"><i class="fa fa-angle-right"></i> Purchase</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Payemnt</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Shipping</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Return</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-2 col-md-3">
        <div class="footer__widget">
          <h5>Infomation</h5>
          <ul>
            <li><a href="#"><i class="fa fa-angle-right"></i> Hatchback</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Sedan</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> SUV</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Crossover</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer__brand">
          <h5>Top Brand</h5>
          <ul>
            <li><a href="#"><i class="fa fa-angle-right"></i> Abarth</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Acura</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Alfa Romeo</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Audi</a></li>
          </ul>
          <ul>
            <li><a href="#"><i class="fa fa-angle-right"></i> BMW</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Chevrolet</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Ferrari</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Honda</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer__copyright__text">
      <p>Vytvořil tým Josefa Hovorky a Lukáše Kumprechta pod dohledem pedagoga Bc. Mikuláše Slavíka v rámci studia T3A
        2025/26 a vývoje seminárního projektu předmětu PRG na SPŠ ELIT Dobruška.</p>
    </div>
  </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
  <div class="h-100 d-flex align-items-center justify-content-center">
    <div class="search-close-switch">+</div>
    <form class="search-model-form">
      <input type="text" id="search-input" placeholder="Search here.....">
    </form>
  </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>