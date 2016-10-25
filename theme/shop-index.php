<?php 
session_start();

require_once __DIR__.'./../vendor/autoload.php';

$products_per_page = 10;

{
if(!empty($_GET['page_nr']) && is_numeric($_GET['page_nr'])) {
    $current_page = (int)$_GET['page_nr'];
    
}

else {
    $current_page = 1;
}
}



{
    if($current_page===1) {
        $offset = 0;
    }
    
    else {
        $offset = ($current_page - 1)*($products_per_page);
    }
    
}


$productRep = new Shop\ProductRepository();
$allProducts = $productRep->getProducts($offset,$products_per_page);

$getProductCount = $productRep->getProductCount();

$last_page = ceil($getProductCount/$products_per_page);

if($current_page > $last_page) {
    $current_page === $last_page;
}

if($current_page < 1) {
    $current_page === 1;
}





//$name = $productDisplay->getName();
//$descr = $productDisplay->getDescription();
//$price = $productDisplay->getPrice();
//$stock = $productDisplay->getStock();
//        
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

include 'header.php';


?>



    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-35">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <div class="item carousel-item-four active">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                                Tones of <br/><span class="color-red-v2">Shop UI Features</span><br/> designed
                            </h2>
                            <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">Lorem ipsum dolor sit amet constectetuer diam <br/>
                            adipiscing elit euismod ut laoreet dolore.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Second slide -->
                <div class="item carousel-item-five">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <h2 class="animate-delay carousel-title-v4" data-animation="animated fadeInDown">
                                Unlimted
                            </h2>
                            <p class="carousel-subtitle-v2" data-animation="animated fadeInDown">
                                Layout Options
                            </p>
                            <p class="carousel-subtitle-v3 margin-bottom-30" data-animation="animated fadeInUp">
                                Fully Responsive
                            </p>
                            <a class="carousel-btn" href="#" data-animation="animated fadeInUp">See More Details</a>
                        </div>
                        <img class="carousel-position-five animate-delay hidden-sm hidden-xs" src="assets/pages/img/shop-slider/slide2/price.png" alt="Price" data-animation="animated zoomIn">
                    </div>
                </div>

                <!-- Third slide -->
                <div class="item carousel-item-six">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <span class="carousel-subtitle-v3 margin-bottom-15" data-animation="animated fadeInDown">
                                Full Admin &amp; Frontend
                            </span>
                            <p class="carousel-subtitle-v4" data-animation="animated fadeInDown">
                                eCommerce UI
                            </p>
                            <p class="carousel-subtitle-v3" data-animation="animated fadeInDown">
                                Is Ready For Your Project
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Fourth slide -->
                <div class="item carousel-item-seven">
                   <div class="center-block">
                        <div class="center-block-wrap">
                            <div class="center-block-body">
                                <h2 class="carousel-title-v1 margin-bottom-20" data-animation="animated fadeInDown">
                                    The most <br/>
                                    wanted bijouterie
                                </h2>
                                <a class="carousel-btn" href="#" data-animation="animated fadeInUp">But It Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
            
     
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product">
              
              
                  <div class='paginator'> 
        <?php
        for($i=1;$i<=$last_page;$i++) {
            if($i===$current_page) {
                    echo $i;
                                   }
        else {
                    echo '<a class="paginator_page" href="shop-index.php?page_nr='.$i.'">'.$i.'</a>';
             }
        } ?>

                 </div>
              
            <h2>New Arrivals</h2>
            
            
            <?php // for($i=0;$i<4;$i++) {
            
             
                
                
//               for($j=0;$j<4;$j++) {
            $tmp_count = 0;
            $total_count = 0;
            $total_product_nr = $productRep->getProductCount();
            
                foreach($allProducts as $product) {
                    if ($tmp_count === 0) {
                        echo'<div class="owl-carousel owl-carousel5">';    
                    }
                    
                    $id = $product->getId();
                    $name = $product->getName();
                    $price = $product->getPrice();
                    $description = $product->getDescription();
               
                    echo '<div>
               <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="'.$photoRep->getProductPhoto($id).'" class="img-responsive" alt="Berry Lace Dress" >
                    <div>
                      <a href="'.$photoRep->getProductPhoto($id).'" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="shop-item.php?id='.$id.'" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.php?id='.$id.'">'.$name.'</a></h3>
                  <div class="pi-price">'.$price.'</div>
                  <a href="shop-shopping-cart.php?id='.$id.'" class="btn btn-default add2cart">Add to cart</a>
                </div>
               </div>';
                    
                    $tmp_count++;
                    $total_count++;
                    
                    if ($tmp_count === 5||$total_count==$total_product_nr) {
                        echo '</div> ';
                        $tmp_count = 0;
                    }
                    
                    
                }
               
//               };
            
                
//            }  
                
                
                
                
                
                ?>
          
<!--            
             <img src="'.$photoRep->getProductPhoto($id).'" class="img-responsive" alt="">-->
            
            
<!--            <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="'" class="img-responsive" alt="">
                    <div>
                      <a href="assets/pages/img/products/model1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="shop-item.php?id=1&name=bla&descr=asdf&price=5" class="btn btn-default">View</a>
                    </div>
                  </div>bla</a></h3>
                  <div class="pi-price">2zl</div>
                  <a href="shop-shopping-cart.php?id=1" class="btn btn-default">Add to cart</a>
                  <div class="sticker sticker-sale"></div>
                </div>
               </div>
               
             </div> -->




                

                     
          <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

    
      
      
        
       
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
      </div>
    </div>
    


   

    <?php include 'footer.php';?>