<?php

session_start();

require_once __DIR__.'./../vendor/autoload.php';



if(isset($_SESSION['user'])) {
    $_SESSION['user'] = $user_id;
    $userInfo = $userInfo = $userRep->getUserById($user_id);
    $firstName = $userInfo->getFirstName();
}


$orderRep = new Shop\OrderRepository();

$productRep = new Shop\ProductRepository();
$order_product_Rep = new \Shop\OrderProductsRepository();
$userRep = new Shop\UserRepository;


$allProducts = $productRep->getProducts();

$photoRep = new \Shop\PhotoRepository;

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

<h2>Order has been placed</h2>


<?php include 'footer.php'; ?>

