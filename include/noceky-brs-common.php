<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Aaysc_Tournament
 * @subpackage Aaysc_Tournament/include
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaysc_Tournament
 * @subpackage Aaysc_Tournament/include
 * @author     Masood U <masood.u@allshoreresources.com>
 */
class noceky_brs_common {
	
	public static function session(){
		$session = get_terms('session', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "DESC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($session as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
			
	}

	public static function school_type(){
				
		$school_type = get_terms('school_type', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "DESC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($school_type as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
			
	}

	public static function class_name(){

		$class_name = get_terms('class_name', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "DESC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($class_name as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
	}

	function download_category(){

		$download_category = get_terms('download_category', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($download_category as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
	}

	function home_work_category(){

		$home_work = get_terms('home_work', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($home_work as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
	}

	function art_gallery_category(){

		$art_gallery = get_terms('art_gallery', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($art_gallery as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
	}
	function spelling_word_category(){
		$spell_word = get_terms('spelling_words', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($spell_word as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;

	}

	function newsletter_category(){

		$news_letter = get_terms('news_letter', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));

		$field_name = array();
		$field_value = array();

	    foreach ($news_letter as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);        
	    }
		$result =  array_combine($field_value, $field_name);

		return $result;
	}

	// event category
	function event_category(){
		$event_category = get_terms('event_type', array(
			'hide_empty' => false,
	    	'taxonomy'	 => 'teacher',
	    	'order'      => "ASC",
    	));
		$field_name = array();
		$field_value = array();
	    foreach ($event_category as $term) {
	    	$field_name[] = $term->name;
	        $field_value[] = strtolower($term->slug);
	    }
		$result =  array_combine($field_value, $field_name);
		return $result;
	}
	function parent_relation(){
		$event_category = get_terms('parent_relation', array(
			'hide_empty' => false,
			'taxonomy'	 => 'teacher',
			'order'      => "ASC",
		));
		$field_name = array();
		$field_value = array();
		foreach ($event_category as $term) {
			$field_name[] = $term->name;
			$field_value[] = strtolower($term->slug);
		}
		$result =  array_combine($field_value, $field_name);
		return $result;
	}

	function user_type(){
		return array(
			"teacher" => "Teacher",
			"parent" => "Parent",

		);
	}

	function activity_category(){
		$activity_type = get_terms('activity_category', array(
			'hide_empty' => false,
			'taxonomy'	 => 'teacher',
			'order'      => "ASC",
		));
		$field_name = array();
		$field_value = array();
		foreach ($activity_type as $term) {
			$field_name[] = $term->name;
			$field_value[] = strtolower($term->slug);
		}
		$result =  array_combine($field_value, $field_name);
		return $result;
	}
	function report_card_category(){
		$activity_type = get_terms('report_card', array(
			'hide_empty' => false,
			'taxonomy'	 => 'teacher',
			'order'      => "ASC",
		));
		$field_name = array();
		$field_value = array();
		foreach ($activity_type as $term) {
			$field_name[] = $term->name;
			$field_value[] = strtolower($term->slug);
		}
		$result =  array_combine($field_value, $field_name);
		return $result;
	}


	function years(){

			// Now we set the range we want
			$max_age = date('Y') - 100; // 100 years ago
			$min_age = date('Y') - 7; // 7 years ago

			// Now we populate the array
			$form_element = array();
			foreach (range($max_age, $min_age) as $year){
				$form_element[] = $year;
			}
			// We return our modified element
			return $form_element;
	}

	function month(){
		$month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
		return $month_names;
	}
	function day(){
		$days = array("01", "02", "03", "04", "05", "06", "07", "07", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28","29", "30", "31" );
		return $days;
	}
}// end class
?>