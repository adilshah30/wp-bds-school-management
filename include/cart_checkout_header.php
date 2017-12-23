<?php
    if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }

    global $wpdb;
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
    */
    $cart_price = $wpdb->get_row("SELECT SUM(price) AS TotalItemsOrdered FROM $activities_orders_table "
             ."INNER JOIN $post_table ON $post_table.ID = $activities_orders_table.product_id "
             ."INNER JOIN $calp_events ON $calp_events.post_id = $activities_orders_table.product_id "
             ."WHERE $activities_orders_table.customer_id = '".$user_id."' AND $activities_orders_table.order_status='in_cart'" );
    $cart_price=$cart_price->TotalItemsOrdered;
  ?>  
    <div class="chk_out" style="margin-bottom:10px;">
        <span><a href="<?= site_url()."/bds-checkout/" ?>" style="color:#fff;">Checkout</a></span>
        <span><a href="<?= site_url()."/bds-cart/" ?>" style="color:#fff;">Cart $<?php echo $cart_price; ?></a></span>
    </div>

