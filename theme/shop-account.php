<?php 
session_start();

require_once __DIR__.'./../vendor/autoload.php';

$userRep = new \Shop\UserRepository;



$orderRep = new Shop\OrderRepository();


$order_product_Rep = new \Shop\OrderProductsRepository();

$productRep = new Shop\ProductRepository;


$photoRep = new \Shop\PhotoRepository;

$total=0;
$productCount = 0;





{
if(empty($_SESSION['user'])) {
    header('Location: login.php');
}
else {
    $user_id = $_SESSION['user'];
    $userInfo = $userRep->getUserById($user_id);
}

}

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








if(isset($_POST)) {
    
             if(isset($_POST['cancel'])) {
                header('Location:shop-account.php');

                }
                
            if(isset($_POST['delete_account'])) {
                //delete using $user_id

                }
         if(isset($_POST['edit_info'])) {
            
         
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
                echo 'im here';
                
                $user_id = $_SESSION['user'];
                $regUser = new Shop\User($firstName,$lastName,$email,$password,$address,$user_id);
              
                
                
                $userRep->updateUser($regUser);
               
                
                
                //code to redirect user
                header('Location: shop-account.php');
            }  
            
            }
}

include 'header.php';
?>
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
<!--            <li><a href="">Store</a></li>-->
            <li class="active">My Account Page</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">


          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <h1>My Account Page</h1>
            <div class="content-page">
              <h3>My Account</h3>
              <ul>
                  <li><a data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content" href="javascript:;">Edit your account information</a></li>
                 <div id="payment-address" class="panel panel-default">
<!--                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                      Step 2: Account &amp; Billing Details
                    </a>
                  </h2>
                </div>-->
                <div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                      <form action="#" method='POST'>

                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      <div class="form-group">
                        <label for="firstname">First Name <span class="require">*</span></label>
                        <input name ='regfirst' type="text" value=<?php echo $userInfo->getFirstName(); ?> id="firstname" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Last Name <span class="require">*</span></label>
                        <input name = 'reglast' type="text" id="lastname" value=<?php echo $userInfo->getLastName(); ?> class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail <span class="require">*</span></label>
                        <input name ='regemail' type="text" id="email" value=<?php echo $userInfo->getEmail(); ?> class="form-control">
                      </div>
<!--                      <div class="form-group">
                        <label for="telephone">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone" class="form-control">
                      </div>-->
                     

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="password">Password <span class="require">*</span></label>
                        <input name='regpassword' type="password" id="password" value='' class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Password Confirm <span class="require">*</span></label>
                        <input name='regpasswordconf' type="password" id="password-confirm" <?php echo $userInfo->getPassword(); ?> class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Address</h3>

                      <div class="form-group">
                        <label for="address1">Address<span class="require">*</span></label>
                        <input name='regaddress' type="text" id="address1" <?php echo $userInfo->getAddress(); ?> class="form-control">
                      </div>
                    </div>
                      
                    <hr>
                     <div class="clearfix"></div>
                      <button class="btn btn-primary" name='edit_info' type="submit" id="button-confirm">Confirm</button>
                     </form>
                     </div>
                    </div>
                    </div>
                    
               <li><a data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-delete-content" href="javascript:;">Delete your account</a></li>
            <!--     <li><a href="javascript:;">Modify your address book entries</a></li>-->
            
            <div id="payment-delete-content" class="panel-collapse collapse">
                            <div id="payment-address" class="panel panel-default"> 

                  <div class="panel-body row">
                      <p>Are you sure you want to delete your account?</p>
                       <hr>
                      <div class="clearfix"></div>
                      <form method="POST" action="#">
                      <button class="btn btn-primary" name='cancel' type="submit" id="button-confirm">Cancel</button>
                      <button class="btn btn-primary" name='delete_account' type="submit" id="button-confirm">Confirm</button>
                      </form>
                      </div>
                    </div>
                    </div>
               
              </ul>
              
              <hr>

              <h3>My Orders</h3>
              <ul>
                <li><a data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-orders-content" href="javascript:;">View your order history</a></li>
                   <div id="payment-address" class="panel panel-default">
                        
                       
                <div id="payment-orders-content" class="panel-collapse collapse">
                    <div class="panel-body row">
                     <ul>  
                   <?php    
                   
                   
                   $allUserOrders =  $orderRep->getAllUserOrders($user_id); 
                   $orderProductRep = new \Shop\OrderProductsRepository();
                   if(empty($allUserOrders)) {
                       echo 'No previous orders';
                   }
                   else {
                   foreach($allUserOrders as $userOrder) {
                        $order_id = $userOrder->getId();
                        $allOrderProducts = $orderProductRep->getAllOrderProductsForOrder($order_id); 
                        echo $userOrder->getStatusId();
                        echo $order_id;
                        foreach($allOrderProducts as $orderProduct) {
                            echo "<ul>
                                <li>".$orderProduct->getName()." </li>
                                <li>".$orderProduct->getPrice()." </li>
                                    </ul>";
                        }
                           
                        
                       }
                   }
                   
                   ?>
                        
                     </ul>    
                        
                        
                    </div>
                </div>
                   </div>
                
              </ul>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>


<?php include 'footer.php';?>