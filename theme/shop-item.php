<?php 
session_start();

require_once __DIR__.'./../vendor/autoload.php';

$orderRep = new Shop\OrderRepository();

$productRep = new Shop\ProductRepository();
$order_product_Rep = new \Shop\OrderProductsRepository();

$productRep = new Shop\ProductRepository();
$allProducts = $productRep->getProducts();

        
$photoRep = new \Shop\PhotoRepository();



$total=0;
$productCount = 0;


function totalProductCount() {
    $productCount=0;
    if(isset($_SESSION['user_cart'])) {
   foreach($_SESSION['user_cart'] as $key => $val) {
                   
                    $quantity = $val['quantity'];
                    
                     $productCount  += (1*$quantity);
                }
     return $productCount;
    }
}




function totalPrice() {
   $total = 0;
    global $productRep;
    if(isset($_SESSION['user_cart'])) {
   foreach($_SESSION['user_cart'] as $key => $val) {
                    
                 
       
                    $productDisplay = $productRep->getProductById($key);
                   
                    $quantity = $val['quantity'];
                    $price = $productDisplay->getPrice();
                    
                     $total += $price*$quantity;
                }
     return $total;
    }
}






if(isset($_GET['id'])) {
    $id=$_GET['id'];
    
$productDisplay = $productRep->getProductById($id);
$name = $productDisplay->getName();
$descr = $productDisplay->getDescription();
$price = $productDisplay->getPrice();
$stock = $productDisplay->getStock();
$photo = $photoRep->getProductPhoto($id); 
$allPhotos = $photoRep->getAllProductPhotos($id,3);
}


include 'header.php';

?>
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>

            <li class="active"><?php echo $name;?></li>
        </ul>
        

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                    <img src="<?php echo $photo;?> " alt="product photo" class="img-responsive" data-BigImgsrc="<?php echo $photo;?>">
                  </div>
                  <div class="product-other-images">
                      <?php 
                      
                      
                      
                      
                      foreach($allPhotos as $single_photo) {
                          
                   echo " <a href=". $single_photo ." class='fancybox-button' rel='photos-lib'><img alt='photo should go here' src=".$single_photo."></a>";
                   
                      }?>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1><?php echo $name;?></h1>
                  <div class="price-availability-block clearfix">
                    <div class="price">
                      <strong><span>$</span><?php echo $price;?></strong>
<!--                      <em>$<span>62.00</span></em>-->
                    </div>
                    <div class="availability">
                      Availability: <strong><?php echo $stock;?></strong>
                    </div>
                  </div>
                  <div class="description">
                    <p><?php echo $descr;?></p>
                  </div>
<!--             
                  <div class="product-page-cart">

-->                    

<form method='POST' action='shop-shopping-cart.php'>
                        <div class="product-quantity">
                            <input id="product-quantity" name='quantity' type="number" value="1" min="1" max="<?php echo $stock; ?>" readonly class="form-control input-sm">
                    </div>
                        
                        <input  name='product_id' type="hidden" value="<?php echo $id;?>">
                   
                    <button class="btn btn-primary" name="add_to_cart" type="submit">Add to cart</button>
                  
                  
                  </form>
<!--                  </div>

                  <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul>
                </div>-->


                    </div>
                  </div>
                </div>

<!--                <div class="sticker sticker-sale"></div>-->
              </div>
            
         
          <!-- END CONTENT -->
       
    

<!--         BEGIN SIMILAR PRODUCTS -->
<!--        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-new"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress2</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k3.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k3.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress3</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k4.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress4</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress5</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php">Berry Lace Dress6</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
        </div>-->
<!--         END SIMILAR PRODUCTS -->

    



  <?php include 'footer.php'; ?>