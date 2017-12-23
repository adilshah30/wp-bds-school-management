<?php
/*
* Plugin Name: BDS School Management
* Version: 1.0.0
* Description: This is a school management plugin, for managing teacher classes, parents, students, homeworks (add/edit/view) , gallaries , downloads, pdfs, report cards, report cards (pdfs generations), built in custom shopping cart, user (teacher/parent/students) register/Invites via email, messaging, bootstrap , responsive for mobile devices. For Plugin's Documentation click <a href="http://adilshah.com" target="_blank">here</a>
* Author: Adil Shah
*/
session_start();

define( 'TEACHER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); 
//echo TEACHER_PLUGIN_PATH ;exit;
##  
##   external files include css, js
##
// $_SESSION['teacher']="noceky";
function myplugin_scripts() {
        wp_register_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'css/bootstrap.css' );
        wp_enqueue_style( 'foo-styles' );
    }
add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );

wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), '0.0.3', 'all' );
wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font_awesome.css', array(), get_bloginfo('version'), 'all' );
wp_enqueue_script( 'custom', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), get_bloginfo('version'), false );
wp_enqueue_style( 'sweetalert', plugin_dir_url( FILE ) . 'teacher/css/sweetalert.css', array(), get_bloginfo('version'), '' );
wp_enqueue_script( 'sweetalertjs', plugin_dir_url( FILE ) . 'teacher/js/sweetalert.min.js', array( 'jquery' ), get_bloginfo('version'), false );

add_action( 'init', 'wpse4378_custom_post_thumbs' );

function wpse4378_custom_post_thumbs() {
    add_theme_support( 'post-thumbnails' );
}

add_action( 'init', 'wpse4378_add_new_image_size' );
function wpse4378_add_new_image_size() {
    add_image_size( 'activity-detail', 414, 300, true ); //mobile
}
// addmin menue page to add teachers
add_action('admin_menu', 'admin_invite_teachers');
function admin_invite_teachers(){
	add_menu_page('Invite Teacher', 'Invite Teacher', 'manage_options', 'invite_teachers_settings', 'invite_teachers_options');
}

function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
}

// addmin menue page to add activities
add_action('admin_menu', 'add_activities');
function add_activities(){
    add_menu_page('Add Activity', 'Add Activity', 'manage_options', 'add_activity_settings', 'add_activity_options');
}

add_action('admin_menu', 'teacher_dashboard_admin');
add_action( 'init', 'my_script_enqueuer' );
add_action('wp_ajax_nopriv_ajax_login_action', 'ajax_login_action');

function my_script_enqueuer(){
	
wp_register_script( "my_ajax_script", plugin_dir_url( __FILE__ ).'js/my_ajax_script.js?ver=4.8.4', array('jquery') );
wp_localize_script( 'my_ajax_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'my_ajax_script' );
wp_enqueue_script( 'slimscroll', plugin_dir_url( FILE ) . 'teacher/js/jquery.slimscroll.min.js', array( 'jquery' ), get_bloginfo('version'), false );

add_shortcode('teacher_dashboard', 'teacher_dashboard');
add_shortcode('manage_homework','manage_homework');
add_shortcode('teacher_homework','teacher_homework');
add_shortcode('teacher_add_homework','teacher_add_homework');
add_shortcode('teacher_edit_homework', 'teacher_edit_homework');
add_shortcode('teacher_homework_details','teacher_homework_details');
add_shortcode('teacher_spelling_words','teacher_spelling_words');
/*HomeWork Section*/
add_shortcode('bds_homework','bds_homework');
add_shortcode('bds_teacher_manage_homework','bds_teacher_manage_homework');
add_shortcode('bds_teacher_add_homework','bds_teacher_add_homework');
add_shortcode('bds_teacher_add_subject','bds_teacher_add_subject');
add_shortcode('bds_homework_pdf','bds_homework_pdf');

/*Bds Cart*/
add_shortcode('bds_cart','bds_cart');
add_shortcode('bds_checkout','bds_checkout');
add_shortcode('bds_order_success','bds_order_success');

/*Bds Reports*/
add_shortcode('bds_add_report','bds_add_report');
add_shortcode('bds_student_report','bds_student_report');

/*Newsletter*/
add_shortcode('bds_teacher_newsletter_category','bds_teacher_newsletter_category');
/*End newsletter*/

/*Download Categories*/
add_shortcode('bds_teacher_downloads_category','bds_teacher_downloads_category');
/*End Download Categories*/

/*gallery*/
add_shortcode('bds_teacher_gallery_category','bds_teacher_gallery_category');
/*End newsletter*/

/*Forgot password*/
add_shortcode('forgot_password','forgot_password');
add_shortcode('set_password','set_password');
/*End forgot password*/

add_shortcode('teacher_download','teacher_download');
add_shortcode('teacher_event', 'teacher_event');
add_shortcode('teacher_registration', 'register_teacher');
add_shortcode('teacher_art_gallery', 'teacher_art_gallery');
add_shortcode('teacher_news_letter','teacher_news_letter');
add_shortcode('login_system','login_system'); 
add_shortcode('student_roster', 'student_roster');

add_shortcode('student_profile', 'student_profile');
add_shortcode('teacher_activities_new', 'teacher_activities_new');
add_shortcode('activity_detail', 'activity_detail');
add_shortcode('teacher_activities', 'teacher_activities');
add_shortcode('teacher_profile', 'teacher_profile');
add_shortcode('update_teacher_profile', 'update_teacher_profile');

add_shortcode('teacher_invite_parent', 'teacher_invite_parent');
add_shortcode('teacher_edit_roster', 'teacher_edit_roster');

add_shortcode('parent_registration', 'parent_registration');
add_shortcode('parent_child_info', 'parent_child_info');
add_shortcode('update_roster', 'update_roster');
add_shortcode('parent_update_child', 'parent_update_child');
add_shortcode('parent_profile', 'parent_profile');
add_shortcode('update_parent_profile', 'update_parent_profile');

add_shortcode('view_activity', 'view_activity');
add_shortcode('add_activity', 'add_activity');
add_shortcode('report_card', 'report_card');
add_shortcode('add_family', 'add_family');
add_shortcode('teacher_edit_event', 'teacher_edit_event');
add_shortcode('teacher_calendar', 'teacher_calendar');
add_shortcode('calendar_detail', 'calendar_detail');
add_shortcode('teacher_message', 'teacher_message');
add_shortcode('inbox_message', 'inbox_message');
add_shortcode('sent_message', 'sent_message');
add_shortcode('read_message', 'read_message');
add_shortcode('reply_message', 'reply_message');

add_shortcode('dashboard_event_calendar', 'dashboard_event_calendar');

require_once(TEACHER_PLUGIN_PATH.'include/ajax-call.php');
require_once(TEACHER_PLUGIN_PATH.'include/noceky-brs-common.php');
require_once(TEACHER_PLUGIN_PATH.'public/login.php'); 
require_once(TEACHER_PLUGIN_PATH.'public/view_activity.php');
// teacher
//--echo TEACHER_PLUGIN_PATH.'public/calendar_detail.php';
require_once(TEACHER_PLUGIN_PATH.'public/teacher/dashboard.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/download.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/event.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/gallery.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/newsletter.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/rooster.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/signup.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/spelling_words.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/activities.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/teacher_activities_new.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/activity_detail.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/profile.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/invite_parent.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/update_profile.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/edit_roster.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/report_card.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/edit_event.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/message.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/inbox_message.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/sent_message.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/read_message.php');
require_once(TEACHER_PLUGIN_PATH.'public/teacher/reply_message.php');
/*homework links*/
require_once(TEACHER_PLUGIN_PATH.'public/homework/homework.php');
require_once(TEACHER_PLUGIN_PATH.'public/homework/teacher_add_homework.php');
require_once(TEACHER_PLUGIN_PATH.'public/homework/teacher_manage_homework.php');
require_once(TEACHER_PLUGIN_PATH.'public/homework/bds_teacher_add_subject.php');
//require_once(TEACHER_PLUGIN_PATH.'pdf/src/bds_homework_pdf.php');

/*Gallery category*/
require_once(TEACHER_PLUGIN_PATH.'public/teacher/bds_teacher_gallery_category.php');

/*newsletter category*/
require_once(TEACHER_PLUGIN_PATH.'public/teacher/bds_teacher_newsletter_category.php');

/*Downloads category*/
require_once(TEACHER_PLUGIN_PATH.'public/teacher/bds_teacher_downloads_category.php');

/*bds cart*/
require_once(TEACHER_PLUGIN_PATH.'public/cart/bds_cart.php');
require_once(TEACHER_PLUGIN_PATH.'public/cart/bds_order_success.php');

/*bds cart*/
require_once(TEACHER_PLUGIN_PATH.'public/checkout/bds_checkout.php');

/*bds report*/
require_once(TEACHER_PLUGIN_PATH.'public/report/bds_add_report.php');
require_once(TEACHER_PLUGIN_PATH.'public/report/bds_student_report.php');

// student
require_once(TEACHER_PLUGIN_PATH.'public/student/profile.php');
// parent
require_once(TEACHER_PLUGIN_PATH.'public/parent/signup.php');
require_once(TEACHER_PLUGIN_PATH.'public/parent/edit_roster.php');
require_once(TEACHER_PLUGIN_PATH.'public/parent/roster.php');
require_once(TEACHER_PLUGIN_PATH.'public/parent/profile.php');
require_once(TEACHER_PLUGIN_PATH.'public/parent/edit_profile.php');
require_once(TEACHER_PLUGIN_PATH.'public/parent/add_family.php');
// admin
require_once(TEACHER_PLUGIN_PATH.'public/admin/invite_teacher.php');
require_once(TEACHER_PLUGIN_PATH.'public/admin/add_activity.php');

//Calendar
require_once(TEACHER_PLUGIN_PATH.'public/calendar/dashboard_event_calendar.php');

require_once(TEACHER_PLUGIN_PATH.'public/forgot_password.php');
require_once(TEACHER_PLUGIN_PATH.'public/set_password.php');
}

//admin side teacher invitation page

function teacher_dashboard_admin(){
    add_options_page('Teacher Dashboard','Teacher Dashboard','manage_options',__FILE__,'teacher_dashboard');
}

//define_public_hooks();
// echo "Public Hook";
//require_once plugin_dir_url( __FILE__ ) . 'include/ajax-call.php';

// add_action('wp_ajax_login_action', 'ajax_login_request');

//private function define_public_hooks() {
		
	//	$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
	//	$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	//	$this->loader->add_action( 'after_setup_theme', $plugin_public, 'remove_admin_bar' );
		
		//Ajax
	//	$this->loader->add_action( 'wp_ajax_pool_scoreboard', $plugin_public, 'pool_scoreboard' );
		///$this->loader->add_action( 'wp_ajax_bracket_scoreboard', $plugin_public, 'bracket_scoreboard' );
		//$this->loader->add_action( 'wp_ajax_search_division', $plugin_public, 'search_division' );
		//$this->loader->add_action( 'wp_ajax_save_team', $plugin_public, 'save_team' );		
	
	//}
	
?>