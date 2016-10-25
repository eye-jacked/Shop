<?php 
session_start();

require_once __DIR__.'./../../vendor/autoload.php';

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








if(!empty($_POST)) {
    

   
    

    if(isset($_POST['submit'])) {  
        
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
    
            
            
            
            
    case 'logout':
        unset($_SESSION['user']);
        echo 'Logged out';
        break;
       
            
        case 'register':
           echo 'got there'; 
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
            else {
                $firstName = $_POST['regfirst'];
            }
        
            
            
            if(!isset($_POST['reglast'])) {
                
                $formErrors['reglast'] = 'Last name not entered';
        
        
            }
            else {
                $lastName = $_POST['reglast'];
            }
            
    
                     
            if(!isset($_POST['regemail'])) {
                
                $formErrors['regemail'] = 'Email not entered';


                }
            else {
                $email = $_POST['regemail'];
            }






            if(!isset($_POST['regaddress'])) {
                  

                  $formErrors['regaddress'] = 'Address not entered';
                }  
            else {
                $address = $_POST['regaddress'];
            }

            
            if (empty($formErrors)) {       
                $regUser = new Shop\User($firstName,$lastName,$email,$password,$address);
//                $regUser->setPassword($password);
//                $regUser->setFirstName($firstName);
//                $regUser->setLastName($lastName);
//                $regUser->setEmail($email);
//                $regUser->setAddress($address);
                
                
                $userRep->addUser($regUser);
                $user_id = $regUser->getId();
                $_SESSION['user'] = $user_id;
                
                //code to redirect user
                header('Location: shop-account.php');
            }    
            
            
            
            break;
    }
    }
    

}

//if(isset($_SESSION['user'])) {
//    $_SESSION['user'] = $user_id;
//    $userInfo = $userInfo = $userRep->getUserById($user_id);
//    $firstName = $userInfo->getFirstName();
//}



include 'header.php';


?>
 <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
<!--            <li><a href="">Store</a></li>-->
            <li class="active">Log in</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">



 <div class="col-md-12 col-sm-12">
<div id="checkout-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>New Customer</h3>
                      <p>CLick continue to register account</p>
<!--                      <div class="radio-list">
                        <label>
                          <input type="radio" name="account"  value="register"> Register Account
                        </label>
                        <label>
                          <input type="radio" name="account"  value="guest"> Guest Checkout
                        </label> 
                      </div>
                      <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>-->
                      <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Continue</button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Returning Customer</h3>
                      <p>I am a returning customer.</p>
                      <form role="form" action="#" method='POST'>
                        <div class="form-group">
                          <label for="email-login">E-Mail</label>
                          <input type="email" name ='email' id="email-login" class="form-control" placeholder='E-mail'>
                        </div>
                        <div class="form-group">
                          <label for="password-login">Password</label>
                          <input type="password" name ='password' id="password-login" class="form-control" placeholder='Password'>
                        </div>
                        <a href="javascript:;">Forgotten Password?</a>
                        <div class="padding-top-20">                  
                          <button class="btn btn-primary" name='submit' value='login' type="submit">Login</button>
                        </div>
                         <div class="padding-top-20">                  
                          <button class="btn btn-primary" name='submit' value='logout' type="submit">Log out</button>
                        </div>
                        <hr>
                        
                      </form>
                    </div>
                  </div>
                </div>
              
            
<!--
               BEGIN PAYMENT ADDRESS 
-->              <div id="payment-address" class="panel panel-default">
<!--                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                      Step 2: Account &amp; Billing Details
                    </a>
                  </h2>
                </div>-->
                <div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <form action='#' method='POST'>

                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      <div class="form-group">
                        <label for="firstname">First Name <span class="require">*</span></label>
                        <input name ='regfirst' type="text" id="firstname" value="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Last Name <span class="require">*</span></label>
                        <input name = 'reglast' type="text" id="lastname" value="" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail <span class="require">*</span></label>
                        <input name ='regemail' type="text" id="email" class="form-control" value="">
                      </div>
<!--                      <div class="form-group">
                        <label for="telephone">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone" class="form-control">
                      </div>-->
                     

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="password">Password <span class="require">*</span></label>
                        <input name='regpassword' type="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Password Confirm <span class="require">*</span></label>
                        <input name='regpasswordconf' type="password" id="password-confirm" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Address</h3>

                      <div class="form-group">
                        <label for="address1">Address<span class="require">*</span></label>
                        <input name='regaddress' type="text" id="address1" value="" class="form-control">
                      </div>
                    </div>
                      
                    <hr>
                     <div class="clearfix"></div>
                      <button class="btn btn-primary" name='submit' value='register' type="submit" id="button-confirm">Confirm Registration</button>
                     </form>
                     </div>
                    </div>
                    </div>

 </div>
        </div>
      </div>
 </div>
                    
                    



<?php include 'footer.php';?>

