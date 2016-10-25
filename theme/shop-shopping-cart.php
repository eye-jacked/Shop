<?php 
session_start();

require_once __DIR__.'./../../vendor/autoload.php';

$orderRep = new Shop\OrderRepository();

$productRep = new Shop\ProductRepository();
$order_product_Rep = new \Shop\OrderProductsRepository();
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


 
if(!empty($_POST)) {
   
    
    if(isset($_POST['add_to_cart'])) {
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];
    
    $productDisplay = $productRep->getProductById($product_id);
    
   {
    
    if(array_key_exists($product_id, $_SESSION["user_cart"])) {

        $_SESSION['user_cart'][$product_id]['quantity'] += $quantity;
    }
    
    
    else {

    $_SESSION["user_cart"][$product_id] = array('quantity' => $quantity);
    
    }
    
    }
    
     }
    
    if(isset($_POST['remove_product'])) {
        unset($_SESSION['user_cart'][$_POST['remove_product']]);
    }
        
   
        
        
   
    
  header('Location:shop-shopping-cart.php');
    
}
  
  
 if(isset($_GET['id'])) {
    $product_id=$_GET['id'];
    
    $productDisplay = $productRep->getProductById($product_id);
    
    $_SESSION["user_cart"][$product_id] = array('quantity' => 1);
    
   
    
    
    
 }


 include 'header.php';


//foreach($_SESSION['user_cart'] as $key => $val) {
//    $productDisplay = $productRep->getProductById($key);
//    $quantity = $val['quantity'];
//}


?>

    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Description</th>
                    
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-price">Unit price</th>
                    
                  </tr>
       <?php    foreach($_SESSION['user_cart'] as $key => $val) {
                    $productDisplay = $productRep->getProductById($key);
                    $quantity = $val['quantity'];
                    
                    
                        $name = $productDisplay->getName();
                        $descr = $productDisplay->getDescription();
                        $price = $productDisplay->getPrice();
                        $stock = $productDisplay->getStock();
                        $allPhotos = $photoRep->getAllProductPhotos($key, 4);
                        $photo = $photoRep->getProductPhoto($key);

                echo' <tr>
                    <td class="goods-page-image">
                      <a href="shop-item.php?id='.$id.'"><img src="'.$photoRep->getProductPhoto($key).'" alt="product photo"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="shop-item.php?id='.$id.'">'.$name.'</a></h3>
                      
                    </td>
                    
                    <td class="goods-page-quantity">
                      <div class="product-quantity">
                          '.$quantity.'
                      </div>
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>'.$price.'</strong>
                    </td>
                   
                    <td class="del-goods-col">
                      <form method="POST" action="#">
                      <button name="remove_product" value ="'.$key.'" class="del-goods" href="javascript:;"></button>
                      </form>
                    </td>
                  </tr>';
                  
                  
                  }?>
                </table>
                </div>

                <div class="shopping-total">
                  <ul>
                   
                    <li class="shopping-total-price">
                      <em>Total</em>
                      <strong class="price"><span>$</span><?php echo totalPrice() ?></strong>
                    </li>
                  </ul>
                </div>
              </div>
                <a href="shop-index.php"><button class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></button></a>
                
                
                <form method='POST' action='shop-checkout.php'>
                
                <a href="shop-checkout.php"><button class="btn btn-primary" name="create_order" type="submit">Checkout <i class="fa fa-check"></i></button></a>
                </form>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
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
                  <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
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
                  <h3><a href="shop-item.html">Berry Lace Dress2</a></h3>
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
                  <h3><a href="shop-item.html">Berry Lace Dress3</a></h3>
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
                  <h3><a href="shop-item.html">Berry Lace Dress4</a></h3>
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
                  <h3><a href="shop-item.html">Berry Lace Dress5</a></h3>
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
                  <h3><a href="shop-item.html">Berry Lace Dress6</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
        </div>
         END SIMILAR PRODUCTS -->
      </div>
    </div>

   

    <?php include 'footer.php';?>