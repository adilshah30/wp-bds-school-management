<?php
function teacher_activities()
{
    if (isset($_SESSION['teacher']) || isset($_SESSION['parent'])) {
        $user = true;
    } else {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
        exit();
    }
    /*wp_enqueue_style( 'datapickercss', plugin_dir_url( FILE ) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '' );
    wp_enqueue_script( 'sweetalertjs', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker.js', array( 'jquery' ), get_bloginfo('version'), false );
    wp_enqueue_script( 'sweetalertjs2', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker2.js', array( 'jquery' ), get_bloginfo('version'), false );*/
    wp_enqueue_style('datapickercss', plugin_dir_url(FILE) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '');
    wp_enqueue_style('bootstrap_css-css', plugin_dir_url(FILE) . 'teachercss/bootstrap.css', array(), get_bloginfo('version'), '');
    wp_enqueue_script('jq-datapicker', plugin_dir_url(FILE) . 'teacher/js/jq-datapicker.js', array('jq-datapicker'), get_bloginfo('version'), false);wp_enqueue_script('datapicker2', plugin_dir_url(FILE).'teacher/js/jq-datapicker2.js', array(''), get_bloginfo('version'), false);
    wp_enqueue_script('bootstrap_js', plugin_dir_url(FILE) . 'teacher/js/bootstrap.min.js', array('jquery'), get_bloginfo('version'), false);
	
    $activity_category = noceky_brs_common::activity_category();

    if (isset($_SESSION['teacher'])) {
        $TEACHER_ID = $_SESSION['teacher'];
    }
    if (isset($_SESSION['parent'])) {
        $TEACHER_ID = $_SESSION['teacher_id'];
    }
    ?>
    <script>
        jQuery(function () {
            jQuery("#datepicker").datepicker();
			$('#slider_example_4').datetimepicker({
	controlType: 'select',
	timeFormat: 'hh:mm tt'
});

        });
    </script>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="h_wrapper">

        <div class="activity_search">

            <div>
                <label>Date From</label>
                <input type="text" name="from" id="datepicker">
            </div>
            <div>
                <label>Search</label>
                <input type="text" name="search">
            </div>
            <div>
                <label>Category</label>
                <select name="type">
                    <?php
                    $count = 0;
                    foreach ($activity_category as $value) {
                        $count++;
                        echo '<option id="' . $count . '" value="' . $value . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="find_act">
                <button>Find Activities</button>
            </div>

        </div>
        <div class="panel-group" id="accordion">
            <?php
            $count = 0;
            $activity_category = noceky_brs_common::activity_category();
            foreach ($activity_category as $item) {
                $count++;
                ?>
                <div style="clear:both; padding-bottom:5px;">
                    <div style="border:solid 1px #eee; background-color:#F8F8F8 ">
                        <a class="accordion-toggle" data-toggle="collapse"
                           data-parent="#accordion <?php if ($count == "1") {
                               echo "active";
                           } ?>" href="#collapse<?php echo $count; ?>">
                            <div
                                style="border:solid 1px #D8E3D6; font-size: 12px; background-color:#EDEDED ;padding: 12px 25px 15px 25px;font-weight:bold;">

                                <!--   <span style="float:right; margin-top:0px;">
                                   <img src="http://www.aaysc.com/wp-content/themes/kingclub-theme-noceky/images/nav-down.png" width="7">
                                   </span>-->
                                <h4 class="panel-title-large"><i class="fa fa-angle-down"></i>&nbsp;&nbsp; <?= $item ?>
                                </h4>
                                <?php if (isset($_SESSION['admin'])): ?>
                                    <span> <a href="javascript:void(0)" onclick="delete_activity()"> <i
                                                class="fa fa-trash-o"></i> Delete Activity </a> </span> <span> <a
                                            href="<?= bloginfo('url') ?>/teacher-add-activity/?cat=<?= str_replace("=", "", base64_encode($item)) ?>">
                                            <i class="fa fa-plus-circle"></i> Add Activity </a> </span>
                                <?php endif; ?>

                            </div>
                        </a>

                        <div id="collapse<?php echo $count ?>" class="accordion-body collapse">
                            <div class="accordion-inner panel-body">
                                <div class="row">


                                    <!--<div id="type_<= $count ?>" class="<php if($count == "1"){ echo 'panel show';}else{echo 'panel';} ?> ">-->
                                    <!-- <div >-->
                                    <table class="activity_table">
                                        <thead>
                                        <tr>
                                            <?php if (isset($_SESSION['admin'])): ?>
                                                <th width="30"></th>
                                            <?php endif; ?>
                                            <th width="110">Day</th>
                                            <!--<th>Start</th>
                                            <th>End</th>-->
                                            <th>Activity</th>
                                            <th>Instructor</th>
                                            <th width="50">Time</th>
                                            <th width="50">Group</th>


                                            <th width="110" style="text-align:center">Registration</th>
                                        </tr>
                                        </thead>
                                        <tbody class="type_<?= $count ?>">

                                        <?php
                                        global $wpdb;
                                        $table = $wpdb->prefix . 'activities';

                                        $query = "SELECT * FROM $table WHERE  `category` = '" . $item . "' AND `status` != '-1' ";

                                        global $wpdb;
                                        $activities = $wpdb->get_results($query);

                                        //				   print_r($activities);

                                        $alt = 0;
                                        foreach ($activities as $value) {
                                            $alt++;
                                            ?>
                                            <tr>
                                                <?php if (isset($_SESSION['admin'])): ?>
                                                    <td><input class="select_box" type='checkbox' name="del"
                                                               value="<?= $value->id ?>"></td>
                                                <?php endif; ?>
                                                <td> <?= date("D-m-Y", strtotime($value->start_date)); ?> </td>
                                                <!-- <td> <= $value->start_date ?> </td>
                                                 <td> <= $value->end_date ?> </td>-->
                                                <td> <?= $value->title ?> </td>
                                                <td> <?= ucwords($value->instructor) ?> </td>
                                                <td> <?= $value->e_time ?> </td>
                                                <td> <?= $value->e_group ?> </td>


                                                <td style="text-align:center">
                                                    <form method="post" action="<?= bloginfo('url') ?>/view-activity">
                                                        <button value="<?= $value->id ?>" name="activity_id"
                                                                type="submit" class="buy_here"> Buy Here
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--</div>
                                </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>   
<?php } ?>