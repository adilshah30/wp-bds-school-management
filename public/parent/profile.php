<?php
function parent_profile(){
    if(!isset($_SESSION['parent'])){
        echo '<script>window.location="'.get_site_url().'/login";</script>';
        exit();
    }
    global $wpdb;
    $table = $wpdb->prefix.'parent';
     $qery ="SELECT  * FROM $table WHERE `id` = '".$_SESSION['parent']."' AND `status` = '2' limit 1";
    $result = $wpdb->get_results( $qery );
    $result = $result[0];
    ?>
    <script>
        jQuery(document).ready(function (e) {
            var title = jQuery('.title1 P').html();
            jQuery('.chp_widget_page_title h1').text(title);
        })
    </script>

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        <div class="h_wrapper">
        <div class="stu_pro_body">
            <div class="title">
                <p> <?php echo ucwords( $result->full_name."'s profile " ); ?> <span><a href="<?= bloginfo('url');?>/edit-parent/"><i class="fa fa-pencil"></i> Edit Profile</a></span> </p>
            </div>
            <div class="stu_info">

                <table>
                    <tr>
                        <td width="140">Name</td>
                        <td><?php echo ucwords( $result->full_name ); ?></td>
                    </tr>
                    <tr>
                        <td width="140">Relation</td>
                        <td><?php echo ucwords($result->relation); ?></td>
                    </tr>
                    <tr>
                        <td >Email</td>
                        <td>
                            <?php
                            if(!empty($result->email_2)){
                                $result->email = $result->email.", ". $result->email_2;
                            }
                            echo $result->email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo  ucfirst( $result->gender); ?></td>
                    </tr>

                    <tr>
                        <td>Phone</td>
                        <td>
                            <?php
                            if(!empty($result->phone_2)){
                                $result->phone = $result->phone.", ". $result->phone_2;
                            }
                            echo $result->phone; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo  ucfirst( $result->address); ?></td>
                    </tr>

                    <tr>
                        <td>Registration Date</td>
                        <td><?php echo date('l, F jS, Y', strtotime($result->date)); ?></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="stu_pro_sidebar">
            <div class="pic">
                <div class="title">
                    <p><?php echo ucwords( $result->full_name ); ?></p>
                </div>
                <img src="<?php echo $result->file ?>">
            </div>
        </div>
    </div>
    </div>
    
    
    <?php
}
?>