<?php
function teacher_edit_event(){
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
        if(!ctype_digit($_GET['event'])){
            echo '<script>window.location="'.get_site_url().'/404";</script>';
            exit;
        }
        $user = true;
    }else{
        echo '<script>window.location="'.get_site_url().'/login";</script>';
        exit();
    }
// get value from post and is valid id
    global $wpdb;
    $table_post = $wpdb->prefix. 'posts';
    $table_postmeta = $wpdb->prefix. 'postmeta';
     $query = "SELECT `ID` FROM $table_post WHERE `post_name` = '".$_SESSION['teacher']."' AND `post_type` IN ('event','calp_event') AND `ID` = '".$_GET['event']."' ";
     $event = $wpdb->get_results( $query);
     $event = $event[0];
    if( !$event->ID){
        echo '<script>window.location="'.get_site_url().'/404";</script>';
        exit();
    }
//    get data from postmeta
    $event_postmeta = $wpdb->get_results( "SELECT * FROM $table_postmeta WHERE `post_id` = '".$event->ID."'");
    $event_postmeta = $event_postmeta[0];
   $item = json_decode( $event_postmeta->meta_value );
//	 teacher id
    $event_category=noceky_brs_common::event_category();
//data picker links
    wp_enqueue_style( 'datapickercss', plugin_dir_url( FILE ) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '' );
    wp_enqueue_script( 'sweetalertjs', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker.js', array( 'jquery' ), get_bloginfo('version'), false );
    wp_enqueue_script( 'sweetalertjs2', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker2.js', array( 'jquery' ), get_bloginfo('version'), false );
    ?>
    <script>
        jQuery( function() {
            jQuery( "#datepicker" ).datepicker();
        } );
    </script>

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>

        <div id="body_wrapper">
            <div class="title">
                <p>Teacher Event</p>
            </div>

                <div class="event_form">
                    <form method="post" action="#">
                        <input type="hidden" name="event_id" value="<?= $event->ID ?>">
                        <div class="event_title">
                            <p>
                                <label>Event Title</label> <small class="t_err"></small>
                            </p>
                            <input type="text" name="title" value="<?= $item->title ?>">
                            <input type="hidden" name="price" value="<?= $item->price ?>">
                        </div>
                        <!--<div class="event_price">
                            <p>
                                <label>Price</label> <small class="p_err"></small>
                            </p>
                            <input type="text" name="price" value="<?= $item->price ?>">
                        </div>-->
                        <div class="event_price">
                            <p>
                                <label>When</label> <small class="w_err"></small>
                            </p>
                            <input type="text" name="event_date" id="datepicker" value="<?= $item->event_date; ?>">
                        </div>

                        <div class="event_when">
                            <p>
                                <label>Category</label> <small class="c_err"></small>
                            </p>
                            <select type="text" name="category">
                                <option selected value="0">Select Category</option>
                                <?php

                                foreach($event_category as $key => $value): ?>
                                    <option <?php if($key == $item->category){echo 'selected';} ?> value="<?= $key ?>"><?= $value ?></option>

                               <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="event_desc">
                            <p>
                                <label>Description</label> <small class="d_err"></small>
                            </p>
                            <textarea name="description" rows="5"><?= $item->description ?></textarea>
                        </div>
                        <div style="float: left;width: 91%;">
                            <p>
                            <input type="hidden" value="1" name="is_calender_e" id="is_calender_e" >
                                <!--<input <php if($item->is_calender_e == "1"){echo 'checked';}?> type="checkbox" value="1" name="is_calender_e" id="is_calender_e" ><label for="is_calender_e"> Is Calendar Event</label>-->
                                <input <?php if($item->is_calender_e == "0"){echo 'checked';}?> type="checkbox" value="1" name="is_home" id="is_home" ><label for="is_home"> Is Home</label>
                            </p>
                        </div>
                        <div>
                            <p>
                                <button class="evnt_sub_btn" type="button" onclick="edit_event()"> Submit </button>
                            </p>
                        </div>
                    </form>
                </div>
            
    <?php
}
