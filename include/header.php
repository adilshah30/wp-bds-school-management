<?php
$pgname = basename($_SERVER['PHP_SELF']);
$active = "";

if ($pgname == "teacher-dashboard")
    $active = "class='active'";
?>
<style type="text/css">
input[type='text'],input[type='email'],input[type='password'],select{
    width: 90%;
    height: 35px;
}
textarea{
    width: 90%;
}
 select{
    height: 35px;
    background-color: #e2e2e2;
    border-top: 3px solid #cecece;
    border-bottom: none;
    border-left: none;
    border-right: none;
}
    
</style>

<div class="header">
    <div class="menu-top">
        <div class="account-nemu" align="right">

            <?php if (isset($_SESSION['teacher'])): //unset($_SESSION['parent']); unset($_SESSION['student']);   ?>
                <span><a href="<?= bloginfo('url') ?>/teacher-profile">Welcome <?php echo $_SESSION['teacher_name']; ?></a> | <a href="<?= bloginfo('url') ?>/login"> Sign Out</a> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['student'])): ?>
                <span><a href="<?= bloginfo('url') ?>/student-profile">Welcome <?php echo $_SESSION['student_name']; ?></a> | <a href="<?= bloginfo('url') ?>/login"> Sign Out</a> </span>
            <?php endif; ?>

            <?php if (isset($_SESSION['parent'])): ?>
                <span><a href="<?= bloginfo('url') ?>/parent-profile">Welcome <?php echo $_SESSION['parent_name']; ?></a> | <a href="<?= bloginfo('url') ?>/login"> Sign Out </a></span>
            <?php endif; ?>

        </div>		
        <ul>
            <a <?php echo $active; ?> href="<?php echo get_site_url(); ?>/teacher-dashboard/"><li <?php if (get_the_title() == "Teacher Dashboard") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-home"></i><p>Home</p><span class="clearfix"></span></li></a>
            <?php if (isset($_SESSION['teacher'])): ?>
                <a href="<?php echo get_site_url(); ?>/student-roster"><li  <?php if (get_the_title() == "Student Roster") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-user-plus"></i><p>Roster</p><span class="clearfix"></span></li></a>

            <?php endif;
            if (isset($_SESSION['parent'])):
                ?>
                <a href="<?php echo get_site_url(); ?>/roster"><li  <?php if (get_the_title() == "Roster") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-user-plus"></i><p>Roster</p><span class="clearfix"></span></li></a>
            <?php endif; ?>

                <a href="<?php echo get_site_url(); ?>/inbox-message"><li <?php if (get_the_title() == "Inbox Message") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-envelope"></i><p>Messages</p><span class="clearfix"></span></li></a>
            <a href="<?php echo get_site_url(); ?>/teacher-news-letter"><li <?php if (get_the_title() == "Teacher News Letter") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-file"></i><p>Newsletter</p><span class="clearfix"></span></li></a>
            <a href="<?php echo get_site_url(); ?>/teacher-download-area"><li <?php if (get_the_title() == "Teacher Download Area") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-download"></i><p>Download</p><span class="clearfix"></span></li></a>
            <a href="<?php echo get_site_url(); ?>/teacher-art-gallery"><li <?php if (get_the_title() == "Teacher Art Gallery") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-image"></i><p>Gallery</p><span class="clearfix"></span></li></a> 
            <a href="<?php echo get_site_url(); ?>/teacher-activities-new"><li <?php if (get_the_title() == "Activities") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-credit-card"></i><p>Activities</p><span class="clearfix"></span></li></a>
            <a href="<?php echo get_site_url(); ?>/dashboard-event-calendar"><li <?php if (get_the_title() == "Dashboard Event Calendar") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-calendar"></i><p>Calendar</p><span class="clearfix"></span></li></a>
            <a href="<?php echo get_site_url(); ?>/bds-homework"><li <?php if (get_the_title() == "Homework") echo "style='background-color:#C5D4B7;'"; ?>><i class="fa fa-book"></i><p>Homework</p><span class="clearfix"></span></li></a>
            <div class="clearfix"></div>    
        </ul>
    </div>
</div>
<!-- change page title -->
<script>
    jQuery(document).ready(function (e) {
<?php if (isset($_SESSION['teacher'])) { ?>
            var title = '<?= $_SESSION['teacher_name']; ?>' + ' (Dashboard)';
<?php } elseif (isset($_SESSION['parent'])) { ?>
            var title = '<?= $_SESSION['teacher_name']; ?>' + ' (<?= $_SESSION['teacher_grade'] . ' Grade' ?>)';
<?php } ?>
        jQuery('.chp_widget_page_title h1').text(title);
    });
</script>