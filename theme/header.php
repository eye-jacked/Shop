
 <?php if(isset($_POST['remove_product_cart'])) {
        unset($_SESSION['user_cart'][$_POST['remove_product_cart']]);
    } ?>

<!DOCTYPE html>
<!--
Template: Metronic Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
Version: 1.0.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Metronic Shop UI</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="assets/pages/css/animate.css" rel="stylesheet">
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/pages/css/slider.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">
    <!-- BEGIN STYLE CUSTOMIZER -->
<!--    <div class="color-panel hidden-sm">
      <div class="color-mode-icons icon-color"></div>
      <div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue" data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
      </div>
    </div>-->
    <!-- END BEGIN STYLE CUSTOMIZER --> 
<!--Begin header+pre-header container-->
<div class="header_full_container">
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                        <!-- BEGIN CURRENCIES -->
<!--                        <li class="shop-currencies">
                            <a href="javascript:void(0);">€</a>
                            <a href="javascript:void(0);">£</a>
                            <a href="javascript:void(0);" class="current">$</a>
                        </li>
                         END CURRENCIES 
                         BEGIN LANGS 
                        <li class="langs-block">
                            <a href="javascript:void(0);" class="current">English </a>
                            <div class="langs-block-others-wrapper"><div class="langs-block-others">
                              <a href="javascript:void(0);">French</a>
                              <a href="javascript:void(0);">Germany</a>
                              <a href="javascript:void(0);">Turkish</a>
                            </div></div>
                        </li>-->
                        <!-- END LANGS -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="shop-account.php">My Account</a></li>
                        <li><a href="shop-checkout.php">Checkout</a></li>
                        <li><a href="login.php">Log In</a></li>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="shop-index.php"><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
          <div class="top-cart-info">
            <a href="javascript:void(0);" class="top-cart-info-count"><?php echo totalProductCount();?> items</a>
            <a href="javascript:void(0);" class="top-cart-info-value">$<?php echo totalPrice();?></a>
          </div>
          <i class="fa fa-shopping-cart"></i>
                        
          <div class="top-cart-content-wrapper">
            <div class="top-cart-content">
              <ul class="scroller" style="height: 250px;">
             
                
                <?php    foreach($_SESSION['user_cart'] as $key => $val) {
                    $productDisplay = $productRep->getProductById($key);
                    $quantity = $val['quantity'];
                        $id = $productDisplay->getId();
                        $name = $productDisplay->getName();
                        $descr = $productDisplay->getDescription();
                        $price = $productDisplay->getPrice();
                        $stock = $productDisplay->getStock();
                        $allPhotos = $photoRep->getAllProductPhotos($key, 4);
                        $photo = $photoRep->getProductPhoto($key);

                    
                    
                echo '<li>
                  <a href="shop-item.php?id='.$id.'"><img src="'.$photoRep->getProductPhoto($key).'" alt="product photo" width="37" height="34"></a>
                  <span class="cart-content-count">x '.$quantity.'</span>
                  <strong><a href="shop-item.php?id='.$id.'">'.$name.'</a></strong>
                  <em>'.$price.'</em>
                
                  <form method="POST" action="#">
                      <button name="remove_product_cart" value ="'.$key.'" class="del-goods" href="javascript:;"></button>
                      </form>
                </li>';
                 
                }
                        ?>
             
<!--              <li>
                  <a href="shop-item.php"><img src="assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="shop-item.php">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>-->
              </ul>
              <div class="text-right">
                <a href="shop-shopping-cart.php" class="btn btn-default">View Cart</a>
                <a href="shop-checkout.php" class="btn btn-primary">Checkout</a>
              </div>
            </div>
          </div>            
        </div>
        <!--END CART -->

        <!-- BEGIN NAVIGATION -->
        <!--<div class="header-navigation">
          <ul>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Woman 
                
              </a>
                
              <!-- BEGIN DROPDOWN MENU -->
              <!--<ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <a href="shop-product-list.php">Hi Tops <i class="fa fa-angle-right"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="shop-product-list.php">Second Level Link</a></li>
                    <li><a href="shop-product-list.php">Second Level Link</a></li>
                    <li class="dropdown-submenu">
                      <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Second Level Link 
                        <i class="fa fa-angle-right"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="shop-product-list.php">Third Level Link</a></li>
                        <li><a href="shop-product-list.php">Third Level Link</a></li>
                        <li><a href="shop-product-list.php">Third Level Link</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="shop-product-list.php">Running Shoes</a></li>
                <li><a href="shop-product-list.php">Jackets and Coats</a></li>
              </ul>
              <!-- END DROPDOWN MENU -->
           <!-- </li>
            <li class="dropdown dropdown-megamenu">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Man
                
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="header-navigation-content">
                    <div class="row">
                      <div class="col-md-4 header-navigation-col">
                        <h4>Footwear</h4>
                        <ul>
                          <li><a href="shop-product-list.php">Astro Trainers</a></li>
                          <li><a href="shop-product-list.php">Basketball Shoes</a></li>
                          <li><a href="shop-product-list.php">Boots</a></li>
                          <li><a href="shop-product-list.php">Canvas Shoes</a></li>
                          <li><a href="shop-product-list.php">Football Boots</a></li>
                          <li><a href="shop-product-list.php">Golf Shoes</a></li>
                          <li><a href="shop-product-list.php">Hi Tops</a></li>
                          <li><a href="shop-product-list.php">Indoor and Court Trainers</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 header-navigation-col">
                        <h4>Clothing</h4>
                        <ul>
                          <li><a href="shop-product-list.php">Base Layer</a></li>
                          <li><a href="shop-product-list.php">Character</a></li>
                          <li><a href="shop-product-list.php">Chinos</a></li>
                          <li><a href="shop-product-list.php">Combats</a></li>
                          <li><a href="shop-product-list.php">Cricket Clothing</a></li>
                          <li><a href="shop-product-list.php">Fleeces</a></li>
                          <li><a href="shop-product-list.php">Gilets</a></li>
                          <li><a href="shop-product-list.php">Golf Tops</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 header-navigation-col">
                        <h4>Accessories</h4>
                        <ul>
                          <li><a href="shop-product-list.php">Belts</a></li>
                          <li><a href="shop-product-list.php">Caps</a></li>
                          <li><a href="shop-product-list.php">Gloves, Hats and Scarves</a></li>
                        </ul>

                        <h4>Clearance</h4>
                        <ul>
                          <li><a href="shop-product-list.php">Jackets</a></li>
                          <li><a href="shop-product-list.php">Bottoms</a></li>
                        </ul>
                      </div>
                      <div class="col-md-12 nav-brands">
                        <ul>
                          <li><a href="shop-product-list.php"><img title="esprit" alt="esprit" src="assets/pages/img/brands/esprit.jpg"></a></li>
                          <li><a href="shop-product-list.php"><img title="gap" alt="gap" src="assets/pages/img/brands/gap.jpg"></a></li>
                          <li><a href="shop-product-list.php"><img title="next" alt="next" src="assets/pages/img/brands/next.jpg"></a></li>
                          <li><a href="shop-product-list.php"><img title="puma" alt="puma" src="assets/pages/img/brands/puma.jpg"></a></li>
                          <li><a href="shop-product-list.php"><img title="zara" alt="zara" src="assets/pages/img/brands/zara.jpg"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li><a href="shop-item.php">Kids</a></li>
            <!--<li class="dropdown dropdown100 nav-catalogue">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                New
                
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="header-navigation-content">
                    <div class="row">
                      <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            <a href="shop-item.php"><img src="assets/pages/img/products/model4.jpg" class="img-responsive" alt="Berry Lace Dress"></a>
                          </div>
                          <h3><a href="shop-item.php">Berry Lace Dress</a></h3>
                          <div class="pi-price">$29.00</div>
                          <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            <a href="shop-item.php"><img src="assets/pages/img/products/model3.jpg" class="img-responsive" alt="Berry Lace Dress"></a>
                          </div>
                          <h3><a href="shop-item.php">Berry Lace Dress</a></h3>
                          <div class="pi-price">$29.00</div>
                          <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            <a href="shop-item.php"><img src="assets/pages/img/products/model7.jpg" class="img-responsive" alt="Berry Lace Dress"></a>
                          </div>
                          <h3><a href="shop-item.php">Berry Lace Dress</a></h3>
                          <div class="pi-price">$29.00</div>
                          <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            <a href="shop-item.php"><img src="assets/pages/img/products/model4.jpg" class="img-responsive" alt="Berry Lace Dress"></a>
                          </div>
                          <h3><a href="shop-item.php">Berry Lace Dress</a></h3>
                          <div class="pi-price">$29.00</div>
                          <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Pages 
                
              </a>
                
              <ul class="dropdown-menu">
                <li class="active"><a href="shop-index.php">Home Default</a></li>
                
                <li><a href="shop-product-list.php">Product List</a></li>
                <li><a href="shop-search-result.php">Search Result</a></li>
                <li><a href="shop-item.php">Product Page</a></li>
                <li><a href="shop-shopping-cart-null.php">Shopping Cart (Null Cart)</a></li>
                <li><a href="shop-shopping-cart.php">Shopping Cart</a></li>
                <li><a href="shop-checkout.php">Checkout</a></li>
                <li><a href="shop-about.php">About</a></li>
                <li><a href="shop-contacts.php">Contacts</a></li>
                <li><a href="shop-account.php">My account</a></li>
               
              </ul>
            </li>
            
            
            <li><a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes&amp;utm_source=download&amp;utm_medium=banner&amp;utm_campaign=metronic_frontend_freebie" target="_blank">Admin theme</a></li>

            <!-- BEGIN TOP SEARCH -->
           <!-- <li class="menu-search">
              <span class="sep"></span>
              <i class="fa fa-search search-btn"></i>
              <div class="search-box">
                <form action="#">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                  </div>
                </form>
              </div> 
            </li>
            <!-- END TOP SEARCH -->
        <!--  </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->
</div>
