<?php 
session_start();

require_once __DIR__.'./../../vendor/autoload.php';

$userRep = new \Shop\UserRepository;


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

include 'header.php';
 
if(isset($_POST)) {
  






     if(isset($_POST['create_order'])) {
        $order = new \Shop\Order();
        $orderRep->addOrder($order);
        
        foreach($_SESSION['user_cart'] as $key => $val) {
                    $productDisplay = $productRep->getProductById($key);
                    $quantity = $val['quantity'];
           $order_product_Rep->addProductToOrder($order->getId(), $key, $quantity);  
           $productRep->changeStock($productDisplay, $quantiy);
                    
             
        }

    $submit = $_POST['submit'];
    
    switch ($submit) {
        case 'login':
            
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        
        
        }
        
        
     if(isset($_POST['password'])) {
        $password = $_POST['password'];
        
        
        }    
        
           
                $user_id = $userRep->authenticateUser($email, $password);
                
                if($user_id !== false) {
                $_SESSION['user'] = $user_id;
                echo 'Logged in';
                }
                else {
                    
                echo 'Email or password not correct';    
                
                }
                
            
        
            break;
       
            
        case 'register':
            
            $formErrors = array();
              
            if(isset($_POST['regpassword']) && isset($_POST['regpasswordconf'])) {
                if(($_POST['regpassword'])===($_POST['regpasswordconf'])) {
                    $password = $_POST['regpassword'];
                } else {
                    $formErrors['password'] = 'Passwords do not match';
                }
                
                
            }
           
            if(!isset($_POST['regfirst'])) {
                $formErrors['regfirst'] = 'First name not entered';
            }
        
            
            
            if(!isset($_POST['reglast'])) {
                $lastName = $_POST['reglast'];
                $formErrors['reglast'] = 'Last name not entered';
        
        
        }            
            
    
                     
            if(isset($_POST['regemail'])) {
                $email = $_POST['regemail'];
                $formErrors['regemail'] = 'Email not entered';


                }






            if(isset($_POST['regaddress'])) {
                   $address = $_POST['regaddress'];

                  $formErrors['regaddress'] = 'Address not entered';
                }    

            
            if (empty($formErrors)) {       
                $regUser = new User();
                $regUser->setPassword($password);
                $regUser->setFirstName($firstName);
                $regUser->setLastName($lastName);
                $regUser->setEmail($email);
                $regUser->setAddress($address);
                
                
                $userRep->addUser($regUser);
                $user_id = $regUser->getId();
                $_SESSION['user'] = $user_id;
                
                
            }    
            
            
            
            break;
            
            
            
        case 'confirm_order':
            //change order status!
            unset($_SESSION['user_cart']);
            header('Location: ordersuccess.php');
            
            
            break;
        
        
        
        case 'cancel_order': 
            $orderRep->cancelOrder($order);
            header('Location: shop-shopping-cart.php');
    
        break;
    }
    

}

}



?>

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
<!--            <li><a href="">Store</a></li>-->
            <li class="active">Checkout</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

              <!-- BEGIN CHECKOUT -->
              <div id="checkout" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle">
                      Step 1: Checkout Options
                    </a>
                  </h2>
                </div>
                <div id="checkout-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>New Customer</h3>
                      <p>CLick continue to register account</p>
             
                      <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Continue</button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Returning Customer</h3>
                      <p>I am a returning customer.</p>
                      <form role="form" action="#" method='POST'>
                        <div class="form-group">
                          <label for="email-login">E-Mail</label>
                          <input type="email" name ='email' id="email-login" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password-login">Password</label>
                          <input type="password" name ='password' id="password-login" class="form-control">
                        </div>
                        <a href="javascript:;">Forgotten Password?</a>
                        <div class="padding-top-20">                  
                          <button class="btn btn-primary" name='login' type="submit">Login</button>
                        </div>
                        <hr>
                        
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CHECKOUT -->
<!--
               BEGIN PAYMENT ADDRESS 
-->              <div id="payment-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                      Step 2: Account &amp; Billing Details
                    </a>
                  </h2>
                </div>
               <div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <form>

                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      <div class="form-group">
                        <label for="firstname">First Name <span class="require">*</span></label>
                        <input name ='regfirst' type="text" id="firstname" value="<?php echo $firstName; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Last Name <span class="require">*</span></label>
                        <input name = 'reglast' type="text" id="lastname" value="<?php echo $lastName; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail <span class="require">*</span></label>
                        <input name ='regemail' type="text" id="email" value="<?php echo $email; ?>" class="form-control">
                      </div>
<!--                      <div class="form-group">
                        <label for="telephone">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone" class="form-control">
                      </div>-->
                     

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="password">Password <span class="require">*</span></label>
                        <input name='regpassword' type="password" id="password" value="<?php echo $password; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Password Confirm <span class="require">*</span></label>
                        <input name='regpasswordconf' type="password" id="password-confirm" value="<?php echo $password; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Address</h3>

                      <div class="form-group">
                        <label for="address1">Address<span class="require">*</span></label>
                        <input name='regaddress' type="text" id="address1" value="<?php echo $address; ?>" class="form-control">
                      </div>
                    </div>
                      
                    <hr>
                     <div class="clearfix"></div>
                      <button class="btn btn-primary" name='register' type="submit" id="button-confirm">Confirm Registration</button>
                     </form>

                  </div>
                </div>
              </div><!--
               END PAYMENT ADDRESS 

         

              <!-- BEGIN CONFIRM -->
              <div id="confirm" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                      Step 3: Confirm Order
                    </a>
                  </h2>
                </div>
                <div id="confirm-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12 clearfix">
                      <div class="table-wrapper-responsive">
                      <table>
                        <tr>
                          <th class="checkout-image">Image</th>
                          <th class="checkout-description">Description</th>
                          
                          <th class="checkout-quantity">Quantity</th>
                          <th class="checkout-price">Price</th>
                         
                        </tr>
                         <?php    foreach($_SESSION['user_cart'] as $key => $val) {
                    $productDisplay = $productRep->getProductById($key);
                    $quantity = $val['quantity'];
                    
                    
                    $productDisplay = $productRep->getProductById($key);
                    $name = $productDisplay-getName();
                    $descr = $productDisplay->getDescription();
                    $price = $productDisplay->getPrice();
                    $stock = $productDisplay->getStock();
        

                    $allPhotos = $photoRep->getAllProductPhotos($key, 4);
                    $photo = $photoRep->getProductPhoto($key);
                    
                    

                echo' <tr>
                    <td class="checkout-image">
                      <a href="shop-item.php?id='.$id.'">'.$photoRep->getProductPhoto($key).'" alt="Product Photo"></a>
                    </td>
                    <td class="checkout-description">
                      <h3><a href="shop-item.php?id='.$id.'">'.$name.'</a></h3>
                      
                    </td>
                    
                    <td class="checkout-quantity">
                     
                          '.$quantity.'
                     
                    </td>
                    <td class="checkout-price">
                      <strong><span>$</span>'.$price.'</strong>
                    </td>
                   
                    
                  </tr>';
                  
                  
                  }?>
<!--                        <tr>
                          <td class="checkout-image">
                            <a href="javascript:;"><img src="assets/pages/img/products/model4.jpg" alt="Berry Lace Dress"></a>
                          </td>
                          <td class="checkout-description">
                            <h3><a href="javascript:;">Cool green dress with red bell</a></h3>
                            <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                            <em>More info is here</em>
                          </td>
                         
                          <td class="checkout-quantity">1</td>
                          <td class="checkout-price"><strong><span>$</span>47.00</strong></td>
                          <td class="checkout-total"><strong><span>$</span>47.00</strong></td>
                        </tr>-->
                      </table>
                      </div>
                      <div class="checkout-total-block">
                        <ul>
                        

                          <li class="checkout-total-price">
                            <em>Total</em>
                            <strong class="price"><span>$</span><?php echo $total;?></strong>
                          </li>
                        </ul>
                      </div>
                      <div class="clearfix"></div>
                      <button class="btn btn-primary pull-right" name='confirm_order' type="submit" id="button-confirm">Confirm Order</button>
                      <button type="button" name="cancel_order" class="btn btn-default pull-right margin-right-20">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CONFIRM -->
            </div>
            <!-- END CHECKOUT PAGE -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>


<?php include 'footer.php';?>