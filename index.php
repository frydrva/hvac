<?php
include "Db.php";

define('_DB_HOST', 'localhost');
define('_DB_NAME', 'frydrva1');
define('_DB_USER', 'frydrva1');
define('_DB_PASSWORD', 'venda2007');

try {
    Db::connect(_DB_HOST, _DB_NAME, _DB_USER, _DB_PASSWORD);
} catch (Exception $ex) {
    echo "Chyba připojení k databázi: " . $ex->getMessage();
    exit;
}

// Načtení unikátních dat pro filtry
$years = Db::queryAll('SELECT DISTINCT rok FROM pauta ORDER BY rok DESC');
$brands = Db::queryAll('SELECT DISTINCT znacka FROM pauta ORDER BY znacka ASC');

// Načtení nejnovějšího auta pro Hero sekci
$latestCar = Db::queryOne('SELECT * FROM pauta ORDER BY ID DESC LIMIT 1');
?>
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
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="offcanvas-menu-overlay"></div>
  <div class="offcanvas-menu-wrapper">
    <div class="offcanvas__widget">
      <a href="#"><i class="fa fa-cart-plus"></i></a>
      <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
      <a href="#" class="primary-btn">Add Car</a>
    </div>
    <div class="offcanvas__logo">
      <a href="index.php"><img src="img/logo.png" alt="" fetchpriority="high" decoding="sync"></a>
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
            <a href="index.php"><img src="img/logo.png" alt="" fetchpriority="high" decoding="sync"></a>
          </div>
        </div>
        <div class="col-lg-10">
          <div class="header__nav">
            <nav class="header__menu">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="car.php">Cars</a></li>
                <li><a href="car-details.html">Car Details</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="contact.php">Contact</a></li>
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

    <section class="hero spad set-bg" data-setbg="images/a4_1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <span style="color: #202020; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">NAJDĚTE SVŮJ VYSNĚNÝ VŮZ</span>
                            <h2 style="color: #202020; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);"><?php echo ($latestCar['znacka'] ?? 'Porsche') . ' ' . ($latestCar['model'] ?? 'Cayenne S'); ?></h2>
                        </div>
                        <div class="hero__text__price" style="color: #202020; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                            <div class="car-model" style="color: #202020; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">Model <?php echo $latestCar['rok'] ?? '2024'; ?></div>
                            <h2 style="color: #202020; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);"><?php echo number_format(($latestCar['cena'] ?? 1250000), 0, ',', ' '); ?> Kč</h2>
                        </div>
                        <a href="car.php" class="primary-btn" >Prohlédnout nabídku</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero__tab">
                        <div class="hero__tab__form">
                            <h2>Vyhledat auto</h2>
                            <form action="car.php" method="GET">
                                <div class="select-list">
                                    <div class="select-list-item">
                                        <p>Značka</p>
                                        <select name="brand">
                                            <option value="">Všechny značky</option>
                                            <?php foreach ($brands as $b): ?>
                                                <option value="<?php echo $b['znacka']; ?>"><?php echo $b['znacka']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="select-list-item">
                                        <p>Rok výroby</p>
                                        <select name="year">
                                            <option value="">Všechny roky</option>
                                            <?php foreach ($years as $y): ?>
                                                <option value="<?php echo $y['rok']; ?>"><?php echo $y['rok']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="car-price">
                                    <p>Najezd (km):</p>
                                    <div class="price-range-wrap">
                                        <div id="mileage-range-hero" class="price-range"></div>
                                        <div class="range-slider">
                                            <div class="price-input">
                                                <input type="text" id="mileage-amount" name="mileage" readonly style="border:0; color:#db2d2e; font-weight:bold; background:transparent;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="car-price">
                                    <p>Cena (Kč):</p>
                                    <div class="price-range-wrap">
                                        <div id="price-range-hero" class="price-range"></div>
                                        <div class="range-slider">
                                            <div class="price-input">
                                                <input type="text" id="price-amount" name="price" readonly style="border:0; color:#db2d2e; font-weight:bold; background:transparent;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="site-btn">Vyhledat</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/main.js"></script>

    <script>
    $(function() {
        // Inicializace slideru pro najezd
        $("#mileage-range-hero").slider({
            range: true,
            min: 0,
            max: 500000,
            values: [0, 200000],
            slide: function(event, ui) {
                $("#mileage-amount").val(ui.values[0].toLocaleString() + " - " + ui.values[1].toLocaleString() + " km");
            }
        });
        $("#mileage-amount").val($("#mileage-range-hero").slider("values", 0).toLocaleString() +
            " - " + $("#mileage-range-hero").slider("values", 1).toLocaleString() + " km");

        // Inicializace slideru pro cenu
        $("#price-range-hero").slider({
            range: true,
            min: 0,
            max: 3000000,
            values: [100000, 1500000],
            slide: function(event, ui) {
                $("#price-amount").val(ui.values[0].toLocaleString() + " - " + ui.values[1].toLocaleString() + " Kč");
            }
        });
        $("#price-amount").val($("#price-range-hero").slider("values", 0).toLocaleString() +
            " - " + $("#price-range-hero").slider("values", 1).toLocaleString() + " Kč");
    });
    </script>

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
