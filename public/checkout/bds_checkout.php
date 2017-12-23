<?php
function bds_checkout(){
    
    global $wpdb;
    
    $activities_order_transaction_detail = $wpdb->prefix.'activities_order_transaction_detail';
    $post_table = $wpdb->prefix.'posts';
    $calp_events = $wpdb->prefix.'calp_events';
    $activities_orders_table = $wpdb->prefix.'activities_orders';
    
    if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }
   $name_on_card = "";
   $credit_card_type = "";
   $card_number = "";
   $card_cvv_code = "";
   $card_expiration_month = "";
   $card_expiration_year = "";
   
   $checkout_form_error= "";
   
   if(isset($_POST['checkout_btn'])){
        require_once TEACHER_PLUGIN_PATH . 'include/payeezy/vendor/autoload.php';
        
        ///Post Card Values
        $cart_total_amount = $_POST['cart_total_amount'];
        $name_on_card = $_POST['name_on_card'];
        $credit_card_type = $_POST['credit_card_type'];
        $card_number = $_POST['card_number'];
        $card_cvv_code = $_POST['card_cvv_code'];
        $card_expiration_month = $_POST['card_expiration_month'];
        $card_expiration_year = $_POST['card_expiration_year'];
        
        $cart_products_id = $_POST['product_id'];
        $cart_items_id = $_POST['cart_items_id'];
        print_r($cart_product_ids);
            
        if($cart_total_amount == '0.0'){
            $checkout_form_error = "Shopping cart empty. Please purchase to continue." ;
        }else{
            
         if (!empty($name_on_card)){
            
           if(!empty($credit_card_type)){              
              
               if(!empty($card_number)){
                   
                  if(!empty($card_cvv_code)){
                      
                      if(!empty($card_expiration_month)){
                          
                          if(!empty($card_expiration_year)){
                              //$checkout_form_error= "All fields are ok!";
                              
                              /// Payezzy Api Connecting Code
                              /// Card Information update logiv Goes Here
                              
                                $client = new Payeezy_Client();
                                $client->setApiKey("HuvCdLpNsiFEIVoPg24JGR2pAER7PI41");
                                $client->setApiSecret("f1e777357c94aefdc47350a9b3032bfad91d3f5e692dcf7ef3c9d4c1d10c9ec4");
                                $client->setMerchantToken("fdoa-4c92e0793dfb4ae60b314aa81fda13d04c92e0793dfb4ae6");
                                $client->setUrl("https://api-cert.payeezy.com/v1/transactions");
                                //$client->setTokenUrl("https://api-cert.payeezy.com/v1/transactions/tokens");
                                //$client->setUrl("https://api.demo.globalgatewaye4.firstdata.com/transaction");
                                $card_transaction = new Payeezy_CreditCard($client);
                                $response = $card_transaction->purchase([
                                  //"merchant_ref" => "Astonishing-Sale",
                                  "transaction_type"=> "purchase",
                                  "method"=>"credit_card",
                                  "amount" => $cart_total_amount,
                                  "currency_code" => "USD",
                                  "partial_redemption"=> "false",
                                  "credit_card" => array(
                                    "type" => $credit_card_type,
                                    "cardholder_name" => $name_on_card,
                                    "card_number" => $card_number,
                                    "exp_date" => $card_expiration_month.$card_expiration_year,
                                    "cvv" => $card_cvv_code
                                  )
                                ]);
                                //echo "<pre/>";
                                //var_dump($response);
                                //payezzy Api Response        
                                if($response != null){
                                    $correlation_id = $response->correlation_id;
                                    $transaction_status = $response->transaction_status;
                                    $validation_status =  $response->validation_status;
                                    $transaction_type = $response->transaction_type;
                                    $transaction_id = $response->transaction_id;
                                    $transaction_tag = $response->transaction_tag;
                                    $method = $response->method;
                                    $amount = $response->amount;
                                    $currency = $response->currency;
                                    //Card details
                                    
//                                    $resp_card_detail_type = $response->type;
//                                    $resp_cardholder_name = $response->cardholder_name;
//                                    $resp_card_number = $response->card_number;
//                                    $resp_exp_date = $response->exp_date;
                                    
                                    //Bank Reposnse Code
                                    $bank_resp_code = $response->bank_resp_code;
                                    $bank_message = $response->bank_message;
                                    $gateway_resp_code = $response->gateway_resp_code;
                                    $gateway_message = $response->gateway_message;
                                    
                                    /// If transaction is approved 
                                    /// update order status
                                    /// Add/Insert order information
                                    if(!empty($transaction_status) && $transaction_status == "approved"){
                                        //echo "ok Approved";
                                        
                                        $insert_tnx_detail = $wpdb->insert($activities_order_transaction_detail, array(
                                                'correlation_id' => $correlation_id,
                                                'transaction_status' => $transaction_status,
                                                'validation_status' => $validation_status,
                                                'transaction_id' => $transaction_id,
                                                'transaction_tag' => $transaction_tag,
                                                'method' => $method,
                                                'amount' => $amount,
                                                'currency' => $currency,
//                                                'card_type' => $resp_card_detail_type,
//                                                'cardholder_name' => $resp_cardholder_name,
//                                                'card_number' => $resp_card_number,
//                                                'exp_date' => $resp_exp_date,
                                                'bank_resp_code' => $bank_resp_code,
                                                'bank_message' => $bank_message,
                                                'gateway_resp_code' => $gateway_resp_code,
                                                'gateway_message' => $gateway_message
                                        ));
                                        $insert_tnx_detail_id =  $wpdb->insert_id;
                                        //echo "<br/>Last Id".$insert_tnx_detail_id."<br/>";
                                        if(!empty($insert_tnx_detail_id) || $insert_tnx_detail_id > 0){
                                            //echo "<br/>insertion Done";
                                            //update the records of Ordered Products.
                                            foreach($cart_items_id as $cart_item_id){
                                                //echo $cart_item_id."<br/>";
                                                $update_order_table_vals = array(
                                                        'txn_id' => $transaction_id,
                                                        'date' => date("Y-m-d H:i:s"),
                                                        'order_status' => "completed"        
                                                );
                                                $where = array('id' => $cart_item_id);
                                                $updated = $wpdb->update( $activities_orders_table, $update_order_table_vals, $where );
                                            
                                                if(false === $updated ){
                                                    
                                                    //echo "<br/>Not Updated";
                                                }else{
                                                    $_SESSION['txn_id']= $transaction_id;
                                                    header('Location: bds-order-success/');
                                                    //echo "<br/>Updated Values";
                                                }
                                            }
                                            
                                        }else{
                                            echo "<br/>txn insertion failed";
                                        }                                      
                                    }
                                    
                                   $_SESSION['card_status'] = "Order Placed Successfully";
                                }else{
                                   $_SESSION['card_status'] = "Card Processing Failed"; 
                                }
 
                          }else{
                              $checkout_form_error = "Please select card expiration year";
                          }                         
                      }else{
                          $checkout_form_error = "Please select card expiration month";
                      }                  
                  }else{
                        $checkout_form_error = "Please Enter CVV code";
                 }                   
              }else{
                  $checkout_form_error = "Please Enter credit card number";
              } 
           }else{
               $checkout_form_error = "Please select credit card Type";
            }
         }else{
             $checkout_form_error = "Please Enter Name on card";
         }
        
     }
  
  }
   
?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

    <?php
    
    $activity_id = $_GET['activity_id'];
    
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_price=$cart_price->TotalItemsOrdered;
    
    $cart_products = $wpdb->get_results("SELECT *,$activities_orders_table.id AS cart_item_id FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_products_count= $wpdb->num_rows;
    ?>
    <style type="text/css">
    div.panel{
        display:block;
    }
    .cards{
    padding-left:0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards .mastercard {
  background-position: -51px 0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards .amex {
  background-position: -102px 0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards li:last-child {
  margin-right: 0;
}
.panel-checkout > .panel-heading {
    color: #fff;
    background-color: #879e73;
    border-color: #879e73;
}
</style>
<div class="mc-content-wrap">
    <div class="h_wrapper">
        
        <div class="chk_out">
            <span><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
            <span><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;"><?php echo $cart_products_count == 0 ? '(0)' : '('.$cart_products_count.')' ; ?> <i class="fa fa-shopping-cart" aria-hidden="true"></i> $<?php echo $cart_price == 0 ? '0': $cart_price; ?> </a></span>
        </div>
        <div class="event-detail-wrap">
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="">
                    
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-checkout">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="#">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body">
                            <?php
                              foreach($cart_products as $products){                             
                            ?>                            
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <?php
                                        if(has_post_thumbnail($products->product_id)){
                                            $thumb= wp_get_attachment_image_src(get_post_thumbnail_id($products->ID),'activity-detail');
                                            $thumb[0];
                                        }
                                        if($thumb[0] != ""){
                                        ?>
                                            <img src="<?= $thumb[0]; ?>" alt="" width="100%" >
                                        <?php
                                        }else{
                                        ?>
                                          <img src="http://placehold.it/100x100" alt="..." class="img-responsive"/>  
                                        <?php    
                                        }
                                           
                                    ?>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><?php echo $products->post_title; ?></div>
                                    <!--<div class="col-xs-12"><small>Quantity:<span>1</span></small></div>-->
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><span>$</span><?php echo $products->price ; ?></h6>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <input type="hidden" name="products_id[]" value="<?php echo $products->product_id; ?>">
                            <input type="hidden" name="cart_items_id[]" value="<?php echo $products->cart_item_id; ?>">
                            <?php } ?>
                            
                            
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Subtotal</strong>
                                    <div class="pull-right"><span>$</span><span><?= $cart_price ?></span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>-</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>$</span><span><?= $cart_price ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-checkout">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                            <div style="color:green;font-size: 15px; font-weight: bold;">
                                <?php
                                if(isset($_SESSION['card_status'])){
                                    echo $_SESSION['card_status'];
                                }
                                ?>    
                                </div>
                            <div class="form-error">
                                    <?php echo $checkout_form_error ; ?>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Name on Card:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="name_on_card" value="<?php echo $name_on_card; ?>" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="credit_card_type" class="form-control">
                                        <option value="">Select Credit Card</option>
                                        <option value="Visa">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="card_number" value="<?php echo $card_number; ?>" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card CVV:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="card_cvv_code" value="<?php echo $card_cvv_code ?>" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Expiration Date</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="card_expiration_month">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="card_expiration_year">
                                        <option value="">Year</option>
                                        <option value="15">2015</option>
                                        <option value="16">2016</option>
                                        <option value="17">2017</option>
                                        <option value="18">2018</option>
                                        <option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                        <option value="24">2024</option>
                                        <option value="25">2025</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="cart_total_amount" value="<?= $cart_price ?>">
                                    <input type="submit" class="btn btn-primary btn-submit-fix" name="checkout_btn" value="Place order">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
                </div>
                
                </form>
            </div>
            
            
        
        </div>
       
    </div>
</div>
    
    <?php
         unset($_SESSION['card_status'])
    ?>
<?php }