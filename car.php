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

  // 1. Fetch distinct values to populate the filter dropdowns dynamically
  $brands = Db::queryAll('SELECT DISTINCT znacka FROM pauta WHERE znacka IS NOT NULL AND znacka != "" ORDER BY znacka');
  $models = Db::queryAll('SELECT DISTINCT model FROM pauta WHERE model IS NOT NULL AND model != "" ORDER BY model');
  $engines = Db::queryAll('SELECT DISTINCT motorizace FROM pauta WHERE motorizace IS NOT NULL AND motorizace != "" ORDER BY motorizace');

  // 2. Build the main query dynamically
  $sql = "SELECT pauta.*, pfotky.file_path 
          FROM pauta 
          LEFT JOIN pfotky ON pauta.ID = pfotky.car_id 
          WHERE (pfotky.is_main = 1 OR pfotky.is_main IS NULL)";

  // 3. Append WHERE clauses if filters were submitted via GET
  // Note: Using addslashes() for basic safety. If your Db class has a specific way to bind parameters, you should use that instead to prevent SQL injection.
  if (!empty($_GET['znacka'])) {
      $znacka_filter = addslashes($_GET['znacka']);
      $sql .= " AND pauta.znacka = '$znacka_filter'";
  }
  if (!empty($_GET['model'])) {
      $model_filter = addslashes($_GET['model']);
      $sql .= " AND pauta.model = '$model_filter'";
  }
  if (!empty($_GET['motorizace'])) {
      $motorizace_filter = addslashes($_GET['motorizace']);
      $sql .= " AND pauta.motorizace = '$motorizace_filter'";
  }

  if (!empty($_GET['min_price'])) {
      $min_price = (int)$_GET['min_price'];
      $sql .= " AND pauta.cena >= $min_price";
  }
  if (!empty($_GET['max_price'])) {
      $max_price = (int)$_GET['max_price'];
      $sql .= " AND pauta.cena <= $max_price";
  }

  $sql .= " GROUP BY pauta.ID";

  // Sorting Logic
  if (!empty($_GET['sort'])) {
      if ($_GET['sort'] == 'price_desc') {
          $sql .= " ORDER BY pauta.cena DESC";
      } elseif ($_GET['sort'] == 'price_asc') {
          $sql .= " ORDER BY pauta.cena ASC";
      }
  }

  // Cars Per Page Logic
  $limit = 9; // Default number of cars
  if (!empty($_GET['limit']) && is_numeric($_GET['limit'])) {
      $limit = (int)$_GET['limit'];
  }
  $sql .= " LIMIT $limit";

  // 4. Execute the final query
  $allRecords = Db::queryAll($sql);
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
              <li class="active"><a href="car.php">Cars</a></li>
              <li><a href="car-details.html">Car Details</a></li>
              <li><a href="about.html">About us</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </nav>
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
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Begin -->

<!-- Car Section Begin -->
<section class="car spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="car__sidebar">
          <div class="car__search">
            <h5>Car Search</h5>
            <form action="#">
              <input type="text" placeholder="Search...">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="car__filter">
            <h5>Car Filter</h5>
            <form action="car.php" method="GET">
              
              <select name="znacka">
                <option value="">Select Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= htmlspecialchars($brand['znacka']) ?>" <?= (isset($_GET['znacka']) && $_GET['znacka'] == $brand['znacka']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($brand['znacka']) ?>
                    </option>
                <?php endforeach; ?>
              </select>

              <select name="model">
                <option value="">Select Model</option>
                <?php foreach ($models as $model): ?>
                    <option value="<?= htmlspecialchars($model['model']) ?>" <?= (isset($_GET['model']) && $_GET['model'] == $model['model']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($model['model']) ?>
                    </option>
                <?php endforeach; ?>
              </select>

              <select name="motorizace">
                <option value="">Select Engine</option>
                <?php foreach ($engines as $engine): ?>
                    <option value="<?= htmlspecialchars($engine['motorizace']) ?>" <?= (isset($_GET['motorizace']) && $_GET['motorizace'] == $engine['motorizace']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($engine['motorizace']) ?>
                    </option>
                <?php endforeach; ?>
              </select>

              <select name="stav">
                <option value="">Condition</option>
                <option value="First Hand" <?= (isset($_GET['stav']) && $_GET['stav'] == 'First Hand') ? 'selected' : '' ?>>First Hand</option>
                <option value="Second Hand" <?= (isset($_GET['stav']) && $_GET['stav'] == 'Second Hand') ? 'selected' : '' ?>>Second Hand</option>
              </select>

              <div class="filter-price">
                <br>
                <br>
                <div class="price-range-wrap">
                  <div class="filter-price-range"></div>
                  <div class="range-slider">
                    <div class="price-input">
                      <input type="text" id="filterAmount" readonly style="border:0; color:#db2d2e; font-weight:bold; width:100%; max-width: 100%; background: transparent;">
                      
                      <input type="hidden" name="min_price" id="min_price" value="<?= isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : '0' ?>">
                      <input type="hidden" name="max_price" id="max_price" value="<?= isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '5000000' ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="car__filter__btn">
                <button type="submit" class="site-btn">Filter Cars</button>
                <a href="car.php" class="site-btn" style="background: #e1e1e1; color: #111; margin-top: 10px; display: block; text-align: center;">Reset Filter</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <form action="car.php" method="GET" id="top-filter-form">
          <?php if(!empty($_GET['znacka'])): ?><input type="hidden" name="znacka" value="<?= htmlspecialchars($_GET['znacka']) ?>"><?php endif; ?>
          <?php if(!empty($_GET['model'])): ?><input type="hidden" name="model" value="<?= htmlspecialchars($_GET['model']) ?>"><?php endif; ?>
          <?php if(!empty($_GET['motorizace'])): ?><input type="hidden" name="motorizace" value="<?= htmlspecialchars($_GET['motorizace']) ?>"><?php endif; ?>
          <?php if(!empty($_GET['min_price'])): ?><input type="hidden" name="min_price" value="<?= htmlspecialchars($_GET['min_price']) ?>"><?php endif; ?>
          <?php if(!empty($_GET['max_price'])): ?><input type="hidden" name="max_price" value="<?= htmlspecialchars($_GET['max_price']) ?>"><?php endif; ?>

          <div class="car__filter__option">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="car__filter__option__item">
                  <h6>Show On Page</h6>
                  <select name="limit" onchange="this.form.submit()">
                    <option value="9" <?= (isset($_GET['limit']) && $_GET['limit'] == 9) ? 'selected' : '' ?>>9 Cars</option>
                    <option value="15" <?= (isset($_GET['limit']) && $_GET['limit'] == 15) ? 'selected' : '' ?>>15 Cars</option>
                    <option value="20" <?= (isset($_GET['limit']) && $_GET['limit'] == 20) ? 'selected' : '' ?>>20 Cars</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="car__filter__option__item car__filter__option__item--right">
                  <h6>Sort By</h6>
                  <select name="sort" onchange="this.form.submit()">
                    <option value="">Default Sorting</option>
                    <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Price: Highest First</option>
                    <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Price: Lowest First</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
          
          <?php
if ($allRecords) {
    foreach ($allRecords as $record) {
        // Odstraníme úvodní lomítko z cesty v DB (z "/images/..." uděláme "images/...")
        $imagePath = ltrim($record["file_path"], '/');

        // Kontrola, zda soubor existuje, jinak dáme náhradní obrázek
        if (empty($imagePath) || !file_exists($imagePath)) {
            $imagePath = "img/cars/car-3.jpg"; // tvůj původní testovací obrázek
        }

        echo('  
        <div class="col-lg-4 col-md-4">
          <div class="car__item">
            <div class="car__item__pic">
                <img src="' . $imagePath . '" alt="' . $record["znacka"] . ' ' . $record["model"] . '" style="width: 100%; display: block;">
            </div>
            <div class="car__item__text">
              <div class="car__item__text__inner">
                <div class="label-date">' . $record["rok"] . '</div>
                <h5><a href="carProduct.php?id='. $record["ID"] . '">' . $record["znacka"] . ' '.  $record["model"] . '</a></h5>
                <ul>
                  <li><span>' . number_format($record["najezd"], 0, ',', ' ') . '</span> km</li>
                  <li>' . $record["motorizace"] . 'L</li>
                  <li><span>' . $record["vykon"] . '</span> hp</li>
                </ul>
              </div>
              <div class="car__item__price">
                <a style="text-decoration: none; color: white;" href="carProduct.php?id='. $record["ID"] . '"> 
                  <span class="car-option">' . number_format($record["cena"], 0, ',', ' ') . ' Kč</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        ');
    }
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
<script>
$(document).ready(function() {
    // 1. Get the current values from the URL (or use defaults)
    var currentMin = parseInt($("#min_price").val()) || 0;
    var currentMax = parseInt($("#max_price").val()) || 1000000; // Max set to 1,000,000

    // 2. Initialize the jQuery UI Slider
    $(".filter-price-range").slider({
        range: true,
        min: 0,
        max: 1000000, // Maximum slider limit
        step: 10000,  // How much the slider jumps by (e.g., 10,000 Kč)
        values: [currentMin, currentMax],
        slide: function(event, ui) {
            // 3. Format numbers with spaces (e.g., 500 000)
            var formattedMin = ui.values[0].toLocaleString('cs-CZ');
            var formattedMax = ui.values[1].toLocaleString('cs-CZ');

            // 4. Update the text the user sees
            $("#filterAmount").val(formattedMin + " Kč - " + formattedMax + " Kč");
            
            // 5. Update the hidden inputs that PHP reads
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
        }
    });

    // 6. Set the text box text immediately when the page loads
    var initialMin = $(".filter-price-range").slider("values", 0).toLocaleString('cs-CZ');
    var initialMax = $(".filter-price-range").slider("values", 1).toLocaleString('cs-CZ');
    $("#filterAmount").val(initialMin + " Kč - " + initialMax + " Kč");
});
</script>
</body>

</html>