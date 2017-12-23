<?php

function view_activity(){

?>

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

    <?php
    global $wpdb;
    $table = $wpdb->prefix.'activities';
    $query = "SELECT * FROM $table WHERE id = '".$_POST['activity_id']."' ";
    $activities = $wpdb->get_results( $query );
    $value = $activities[0];

    ?>

    <div class="h_wrapper">
        <div class="chk_out">
            <span>Checkout</span>
            <span>$<?= $value->price ?> Cart</span>

        </div>
        <div class="view">
            <img src="<?= $value->file ?>" alt="" height="249">
            <div class="b_title">
                <p><?= $value->event_type ?></p>
            </div>
        </div>
        <div class="activity_detail">
            <div class="top">
                <h2>Dancesss</h2>
                <span><img src="http://localhost/wordpress/wp-content/uploads/2016/08/star.png" alt=""><img src="http://localhost/wordpress/wp-content/uploads/2016/08/star.png" alt=""><img src="http://localhost/wordpress/wp-content/uploads/2016/08/star.png" alt=""></span>
                <h2>$<?= $value->price ?> Per Class</h2>
                <hr>
                <p><?= $value->description ?></p>
            </div>

            <div class="bullet">
                <input type="radio" id="fd" name="adf"><label for="fd"><b>Ballet 1</b> adsf dfa dsfasf fsa  </label>
                <p>asdf</p>
                <input type="radio" id="fd" name="af"><label for="fd"><b>Ballet 1</b> adsf dfa dsfasf fsa  </label>
                <p>asdf</p>
            </div>
            <br>
            <button class="buy_here"> Buy Here </button>
        </div>
    </div>

<?php }