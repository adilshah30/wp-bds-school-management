<?php
function dashboard_event_calendar()
{
    if (isset($_SESSION['teacher']) || isset($_SESSION['parent'])) {
        $user = true;
    } else {
        echo '<script>window.location="' . get_site_url() . '/login";</script>';
        exit();
    }
    if (isset($_SESSION['teacher'])) {
        $TEACHER_ID = $_SESSION['teacher'];
    }
    if (isset($_SESSION['parent'])) {
        $TEACHER_ID = $_SESSION['teacher_id'];
    }
    ?>
<style>
    #calp-container{
        width: 896px;
        /* margin: auto; */
        margin-left: 38px;  
    }
    @media only screen and (max-width : 480px) {
        #calp-container {
       width: 95%;
       /* margin: auto; */
       margin: auto;
        }
    }

@media only screen and (min-width : 481px) and (max-width: 768px) {
     #calp-container {
    width: 95%;
    /* margin: auto; */
    margin: auto;
    }
}
   
</style>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
    <div class="mc-content-wrap">
        <div class="h_wrapper">
            <div class="top-action">
                <div>
                    <h2 class="title">Calendar</h2>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="lll">
                <?php 
                    Calp_App_Controller::route_request();
                ?>
            </div>
        </div>

            <div class="clearfix"></div>
    </div>    
<?php } ?>