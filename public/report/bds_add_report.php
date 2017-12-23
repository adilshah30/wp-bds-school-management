<?php
function bds_add_report(){
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    
   global $wpdb;  
    
   $tbl_report = $wpdb->prefix .'bds_report_card';
   $tbl_bds_report_literature_info_text = $wpdb->prefix .'bds_report_literature_info_text';
   $tbl_bds_report_foundational_skills = $wpdb->prefix . 'bds_report_foundational_skills';
   $tbl_bds_report_language_conventions = $wpdb->prefix . 'bds_report_language_conventions';
   $tbl_bds_report_text_type_purpose = $wpdb->prefix . 'bds_report_text_type_purpose';
   $tbl_bds_report_prest_of_knowledge = $wpdb->prefix . 'bds_report_prest_of_knowledge';
   $tbl_bds_report_counting_cardinality = $wpdb->prefix . 'bds_report_counting_cardinality';
   $tbl_bds_report_operations = $wpdb->prefix . 'bds_report_operations';
   $tbl_bds_report_number_sense = $wpdb->prefix . 'bds_report_number_sense';
   $tbl_bds_report_measurement_number = $wpdb->prefix . 'bds_report_measurement_number';
   $tbl_bds_report_geometry = $wpdb->prefix . 'bds_report_geometry';
   $tbl_bds_report_work_study_habit = $wpdb->prefix . 'bds_report_work_study_habit';
   $tbl_bds_report_life_skills = $wpdb->prefix . 'bds_report_life_skills';
   $tbl_bds_report_curricular_studies = $wpdb->prefix . 'bds_report_curricular_studies';
   $tbl_bds_report_attendence = $wpdb->prefix . 'bds_report_attendence';
   
   $table_student = $wpdb->prefix.'student';
   $table_parent = $wpdb->prefix.'parent';
   $table_teacher = $wpdb->prefix.'teacher';
    
    
    ///get All teacher's Students in a class
   $get_student_id= '';
   if(isset($_GET['std_id'])){
       $get_student_id = $_GET['std_id'];
   }
    $qery_teacher_students ="SELECT * FROM $table_student WHERE `teacher_id` = '".$_SESSION['teacher']."' AND `status` = '1' ";
    $get_all_teacher_students = $wpdb->get_results( $qery_teacher_students );
    
    $get_student=$wpdb->get_row("Select * FROM $table_student  WHERE `id` = '".$get_student_id."'");

    
    
   
   if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }
   
   $error_message = "";
   
   $title= "";
   $student_id ="";
   $teacher_signature="";
   $report_session="";
   $class_name="";
   $qtr_comment_1 = "";
   $qtr_comment_2 ="";
   $qtr_comment_3 ="";
   $qtr_comment_4 ="";
   
   $retells_q_1 ="";
   $retells_q_2 ="";
   $retells_q_3 ="";
   $retells_q_4 ="";
   $common_type_q_1 = "";
   $common_type_q_2 = "";
   $common_type_q_3 = "";
   $common_type_q_4 = "";
   
   ////Foundational Skils
   $reads_emergent_q_1 = "";
   $reads_emergent_q_2 = "";
   $reads_emergent_q_3 = "";
   $reads_emergent_q_4 = "";
   
   $analysis_skills_q_1 = "";
   $analysis_skills_q_2 = "";
   $analysis_skills_q_3 = "";
   $analysis_skills_q_4 = "";

   $recognize_upper_q_1 = "";
   $recognize_upper_q_2 = "";
   $recognize_upper_q_3 = "";
   $recognize_upper_q_4 = "";

   $identifies_q_1 = "";
   $identifies_q_2 = "";
   $identifies_q_3 = "";
   $identifies_q_4 = "";

   $f_skills_effort_q_1 = "";
   $f_skills_effort_q_2 = "";
   $f_skills_effort_q_3 = "";
   $f_skills_effort_q_4 = "";
   
   ///////language_conventions
   
   $prints_upper_q_1 = "";
   $prints_upper_q_2 = "";
   $prints_upper_q_3 = "";
   $prints_upper_q_4 = "";

    $demo_convent_q_1 = ""; 
    $demo_convent_q_2 = "";
    $demo_convent_q_3 = "";
    $demo_convent_q_4 = "";

    $acquires_q_1 = "";
    $acquires_q_2 = "";
    $acquires_q_3 = "";
    $acquires_q_4 = "";
    
    ///type_purpose
    
    $utilizes_journal_q_1  = "";
    $utilizes_journal_q_2 = "";
    $utilizes_journal_q_3 = "";
    $utilizes_journal_q_4 = "";

    $strengthen_writing_q_1 = "";
    $strengthen_writing_q_2 = "";
    $strengthen_writing_q_3 = "";
    $strengthen_writing_q_4 = "";
    
    ////prest_of_knowledge
   
    $contributes_q_1 = "";
    $contributes_q_2 = "";
    $contributes_q_3 = "";
    $contributes_q_4 = "";

    $ask_answers_q_1 = "";
    $ask_answers_q_2 = "";
    $ask_answers_q_3 = "";
    $ask_answers_q_4 = "";

    $expresses_q_1 = "";
    $expresses_q_2 = "";
    $expresses_q_3 = "";
    $expresses_q_4 = "";

    $pk_effort_q_1 = "";
    $pk_effort_q_2 = "";
    $pk_effort_q_3 = "";
    $pk_effort_q_4 = "";
    
    //wp_dkf3k12nf1_bds_report_counting_cardinality

$identifies_number_q_1 = "";
$identifies_number_q_2 = "";
$identifies_number_q_3 = "";
$identifies_number_q_4 = "";

$counts_tell_q_1 = "";
$counts_tell_q_2 = "";
$counts_tell_q_3 = "";
$counts_tell_q_4 = "";

$compares_sets_q_1 = "";
$compares_sets_q_2 = "";
$compares_sets_q_3 = "";
$compares_sets_q_4 = "";

//wp_dkf3k12nf1_bds_report_operations

$joins_sets_q_1 = "";
$joins_sets_q_2 = "";
$joins_sets_q_3 = "";
$joins_sets_q_4 = "";

$seprate_set_q_1 = "";
$seprate_set_q_2 = "";
$seprate_set_q_3 = "";
$seprate_set_q_4 = "";

$fluently_adds_q_1 = "";
$fluently_adds_q_2 = "";
$fluently_adds_q_3 = "";
$fluently_adds_q_4 = "";

//wp_dkf3k12nf1_bds_report_number_sense

$works_with_numbers_q_1 = "";
$works_with_numbers_q_2 = "";
$works_with_numbers_q_3 = "";
$works_with_numbers_q_4 = "";

//wp_dkf3k12nf1_bds_report_measurement_number

$describe_comp_q_1 = "";
$describe_comp_q_2 = "";
$describe_comp_q_3 = "";
$describe_comp_q_4 = "";

$sorts_classify_q_1 = "";
$sorts_classify_q_2 = "";
$sorts_classify_q_3 = "";
$sorts_classify_q_4 = "";

//wp_dkf3k12nf1_bds_report_geometry

$identifies_2d_q_1 = "";
$identifies_2d_q_2 = "";
$identifies_2d_q_3 = "";
$identifies_2d_q_4 = "";

$compares_2d_q_1 = "";
$compares_2d_q_2 = "";
$compares_2d_q_3 = "";
$compares_2d_q_4 = "";

$geometry_effort_q_1 = "";
$geometry_effort_q_2 = "";
$geometry_effort_q_3 = "";
$geometry_effort_q_4 = "";

//wp_dkf3k12nf1_bds_report_work_study_habit

$arrives_on_time_q_1 = "";
$arrives_on_time_q_2 = "";
$arrives_on_time_q_3 = "";
$arrives_on_time_q_4 = "";

$follow_dire_q_1 = "";
$follow_dire_q_2 = "";
$follow_dire_q_3 = "";
$follow_dire_q_4 = "";

$adequate_attention_q_1 = "";
$adequate_attention_q_2 = "";
$adequate_attention_q_3 = "";
$adequate_attention_q_4 = "";

$school_tools_q_1 = "";
$school_tools_q_2 = "";
$school_tools_q_3 = "";
$school_tools_q_4 = "";

$completes_tasks_q_1 = "";
$completes_tasks_q_2 = "";
$completes_tasks_q_3 = "";
$completes_tasks_q_4 = "";

$acc_responsibility_q_1 = "";
$acc_responsibility_q_2 = "";
$acc_responsibility_q_3 = "";
$acc_responsibility_q_4 = "";

$quality_work_q_1 = "";
$quality_work_q_2 = "";
$quality_work_q_3 = "";
$quality_work_q_4 = "";

$complete_hw_q_1 = "";
$complete_hw_q_2 = "";
$complete_hw_q_3 = "";
$complete_hw_q_4 = "";

$wsh_efforts_q_1 = "";
$wsh_efforts_q_2 = "";
$wsh_efforts_q_3 = "";
$wsh_efforts_q_4 = "";

//wp_dkf3k12nf1_bds_report_life_skills

$keeps_hands_q_1 = "";
$keeps_hands_q_2 = "";
$keeps_hands_q_3 = "";
$keeps_hands_q_4 = "";

$cooperates_in_group_q_1 = "";
$cooperates_in_group_q_2 = "";
$cooperates_in_group_q_3 = "";
$cooperates_in_group_q_4 = "";

$listens_without_q_1 = "";
$listens_without_q_2 = "";
$listens_without_q_3 = "";
$listens_without_q_4 = "";

$accepts_teachers_q_1 = "";
$accepts_teachers_q_2 = "";
$accepts_teachers_q_3 = "";
$accepts_teachers_q_4 = "";

$demonstrates_q_1 = "";
$demonstrates_q_2 = "";
$demonstrates_q_3 = "";
$demonstrates_q_4 = "";

$responsibility_q_1 = "";
$responsibility_q_2 = "";
$responsibility_q_3 = "";
$responsibility_q_4 = "";

$copes_q_1 = "";
$copes_q_2 = "";
$copes_q_3 = "";
$copes_q_4 = "";

$respects_rights_q_1 = "";
$respects_rights_q_2 = "";
$respects_rights_q_3 = "";
$respects_rights_q_4 = "";

$perseverance_q_1 = "";
$perseverance_q_2 = "";
$perseverance_q_3 = "";
$perseverance_q_4 = "";

$ls_efforts_q_1 = "";
$ls_efforts_q_2 = "";
$ls_efforts_q_3 = "";
$ls_efforts_q_4 = "";

//wp_dkf3k12nf1_bds_report_curricular_studies

$science_q_1 = "";
$science_q_2 = "";
$science_q_3 = "";
$science_q_4 = "";

$social_studies_q_1 = "";
$social_studies_q_2 = "";
$social_studies_q_3 = "";
$social_studies_q_4 = "";

$physical_edu_q_1 = "";
$physical_edu_q_2 = "";
$physical_edu_q_3 = "";
$physical_edu_q_4 = "";

$art_q_1 = "";
$art_q_2 = "";
$art_q_3 = "";
$art_q_4 = "";

$music_q_1 = "";
$music_q_2 = "";
$music_q_3 = "";
$music_q_4 = "";

//wp_dkf3k12nf1_bds_report_attendence

$days_tarday_q_1 = "";
$days_tarday_q_2 = "";
$days_tarday_q_3 = "";
$days_tarday_q_4 = "";

$days_absent_q_1 = "";
$days_absent_q_2 = "";
$days_absent_q_3 = "";
$days_absent_q_4 = "";

$tradies_q_1 = "";
$tradies_q_2 = "";
$tradies_q_3 = "";
$tradies_q_4 = "";

$grade_q_1 = "";
$grade_q_2 = "";
$grade_q_3 = "";
$grade_q_4 = "";
   
 
if(isset($_POST['add_report_btn'])){
       
   $title= $_POST['teacher_signature'];
   $student_id = $_POST['student_id'];
   $teacher_signature=$_POST['teacher_signature'];
   $report_session = $_POST['report_session'];
   $class_name = $_POST['class_name'];
   $qtr_comment_1 = $_POST['qtr_comment_1'];
   $qtr_comment_2 =$_POST['qtr_comment_2'];
   $qtr_comment_3 =$_POST['qtr_comment_3'];
   $qtr_comment_4 =$_POST['qtr_comment_4'];
   
   $retells_q_1 =$_POST['retells_q_1'];
   $retells_q_2 =$_POST['retells_q_2'];
   $retells_q_3 =$_POST['retells_q_3'];
   $retells_q_4 =$_POST['retells_q_4'];
   $common_type_q_1 = $_POST['common_type_q_1'];
   $common_type_q_2 = $_POST['common_type_q_2'];
   $common_type_q_3 = $_POST['common_type_q_3'];
   $common_type_q_4 = $_POST['common_type_q_4'];
   
   ////Foundational Skils
   $reads_emergent_q_1 = $_POST['reads_emergent_q_1'];
   $reads_emergent_q_2 = $_POST['reads_emergent_q_2'];
   $reads_emergent_q_3 = $_POST['reads_emergent_q_3'];
   $reads_emergent_q_4 = $_POST['reads_emergent_q_4'];
   
   $analysis_skills_q_1 = $_POST['analysis_skills_q_1'];
   $analysis_skills_q_2 = $_POST['analysis_skills_q_2'];
   $analysis_skills_q_3 = $_POST['analysis_skills_q_3'];
   $analysis_skills_q_4 = $_POST['analysis_skills_q_4'];

   $recognize_upper_q_1 = $_POST['recognize_upper_q_1'];
   $recognize_upper_q_2 = $_POST['recognize_upper_q_2'];
   $recognize_upper_q_3 = $_POST['recognize_upper_q_3'];
   $recognize_upper_q_4 = $_POST['recognize_upper_q_4'];

   $identifies_q_1 = $_POST['identifies_q_1'];
   $identifies_q_2 = $_POST['identifies_q_2'];
   $identifies_q_3 = $_POST['identifies_q_3'];
   $identifies_q_4 = $_POST['identifies_q_4'];

   $f_skills_effort_q_1 = $_POST['f_skills_effort_q_1'];
   $f_skills_effort_q_2 = $_POST['f_skills_effort_q_2'];
   $f_skills_effort_q_3 = $_POST['f_skills_effort_q_3'];
   $f_skills_effort_q_4 = $_POST['f_skills_effort_q_4'];
   
   ///////language_conventions
   
   $prints_upper_q_1 = $_POST['prints_upper_q_1'];
   $prints_upper_q_2 = $_POST['prints_upper_q_2'];
   $prints_upper_q_3 = $_POST['prints_upper_q_3'];
   $prints_upper_q_4 = $_POST['prints_upper_q_4'];

    $demo_convent_q_1 = $_POST['demo_convent_q_1'];
    $demo_convent_q_2 = $_POST['demo_convent_q_2'];
    $demo_convent_q_3 = $_POST['demo_convent_q_3'];
    $demo_convent_q_4 = $_POST['demo_convent_q_4'];

    $acquires_q_1 = $_POST['acquires_q_1'];
    $acquires_q_2 = $_POST['acquires_q_2'];
    $acquires_q_3 = $_POST['acquires_q_3'];
    $acquires_q_4 = $_POST['acquires_q_4'];
    
    ///type_purpose
    
    $utilizes_journal_q_1 = $_POST['utilizes_journal_q_1'];
    $utilizes_journal_q_2 = $_POST['utilizes_journal_q_2'];
    $utilizes_journal_q_3 = $_POST['utilizes_journal_q_3'];
    $utilizes_journal_q_4 = $_POST['utilizes_journal_q_4'];

    $strengthen_writing_q_1 = $_POST['strengthen_writing_q_1'];
    $strengthen_writing_q_2 = $_POST['strengthen_writing_q_2'];
    $strengthen_writing_q_3 = $_POST['strengthen_writing_q_3'];
    $strengthen_writing_q_4 = $_POST['strengthen_writing_q_4'];
    
    ////prest_of_knowledge
   
    $contributes_q_1 = $_POST['contributes_q_1'];
    $contributes_q_2 = $_POST['contributes_q_2'];
    $contributes_q_3 = $_POST['contributes_q_3'];
    $contributes_q_4 = $_POST['contributes_q_4'];

    $ask_answers_q_1 = $_POST['ask_answers_q_1'];
    $ask_answers_q_2 = $_POST['ask_answers_q_2'];
    $ask_answers_q_3 = $_POST['ask_answers_q_3'];
    $ask_answers_q_4 = $_POST['ask_answers_q_4'];

    $expresses_q_1 = $_POST['expresses_q_1'];
    $expresses_q_2 = $_POST['expresses_q_2'];
    $expresses_q_3 = $_POST['expresses_q_3'];
    $expresses_q_4 = $_POST['expresses_q_4'];

    $pk_effort_q_1 = $_POST['pk_effort_q_1'];
    $pk_effort_q_2 = $_POST['pk_effort_q_2'];
    $pk_effort_q_3 = $_POST['pk_effort_q_3'];
    $pk_effort_q_4 = $_POST['pk_effort_q_4'];
    
    //wp_dkf3k12nf1_bds_report_counting_cardinality

$identifies_number_q_1 = $_POST['identifies_number_q_1'];
$identifies_number_q_2 = $_POST['identifies_number_q_2'];
$identifies_number_q_3 = $_POST['identifies_number_q_3'];
$identifies_number_q_4 = $_POST['identifies_number_q_4'];

$counts_tell_q_1 = $_POST['counts_tell_q_1'];
$counts_tell_q_2 = $_POST['counts_tell_q_2'];
$counts_tell_q_3 = $_POST['counts_tell_q_3'];
$counts_tell_q_4 = $_POST['counts_tell_q_4'];

$compares_sets_q_1 = $_POST['compares_sets_q_1'];
$compares_sets_q_2 = $_POST['compares_sets_q_2'];
$compares_sets_q_3 = $_POST['compares_sets_q_3'];
$compares_sets_q_4 = $_POST['compares_sets_q_4'];

//wp_dkf3k12nf1_bds_report_operations

$joins_sets_q_1 = $_POST['joins_sets_q_1'];
$joins_sets_q_2 = $_POST['joins_sets_q_2'];
$joins_sets_q_3 = $_POST['joins_sets_q_3'];
$joins_sets_q_4 = $_POST['joins_sets_q_4'];

$seprate_set_q_1 = $_POST['seprate_set_q_1'];
$seprate_set_q_2 = $_POST['seprate_set_q_2'];
$seprate_set_q_3 = $_POST['seprate_set_q_3'];
$seprate_set_q_4 = $_POST['seprate_set_q_4'];

$fluently_adds_q_1 = $_POST['fluently_adds_q_1'];
$fluently_adds_q_2 = $_POST['fluently_adds_q_2'];
$fluently_adds_q_3 = $_POST['fluently_adds_q_3'];
$fluently_adds_q_4 = $_POST['fluently_adds_q_4'];

//wp_dkf3k12nf1_bds_report_number_sense

$works_with_numbers_q_1 = $_POST['works_with_numbers_q_1'];
$works_with_numbers_q_2 = $_POST['works_with_numbers_q_2'];
$works_with_numbers_q_3 = $_POST['works_with_numbers_q_3'];
$works_with_numbers_q_4 = $_POST['works_with_numbers_q_4'];

//wp_dkf3k12nf1_bds_report_measurement_number

$describe_comp_q_1 = $_POST['describe_comp_q_1'];
$describe_comp_q_2 = $_POST['describe_comp_q_2'];
$describe_comp_q_3 = $_POST['describe_comp_q_3'];
$describe_comp_q_4 = $_POST['describe_comp_q_4'];

$sorts_classify_q_1 = $_POST['sorts_classify_q_1'];
$sorts_classify_q_2 = $_POST['sorts_classify_q_2'];
$sorts_classify_q_3 = $_POST['sorts_classify_q_3'];
$sorts_classify_q_4 = $_POST['sorts_classify_q_4'];

//wp_dkf3k12nf1_bds_report_geometry

$identifies_2d_q_1 = $_POST['identifies_2d_q_1'];
$identifies_2d_q_2 = $_POST['identifies_2d_q_2'];
$identifies_2d_q_3 = $_POST['identifies_2d_q_3'];
$identifies_2d_q_4 = $_POST['identifies_2d_q_4'];

$compares_2d_q_1 = $_POST['compares_2d_q_1'];
$compares_2d_q_2 = $_POST['compares_2d_q_2'];
$compares_2d_q_3 = $_POST['compares_2d_q_3'];
$compares_2d_q_4 = $_POST['compares_2d_q_4'];

$geometry_effort_q_1 = $_POST['geometry_effort_q_1'];
$geometry_effort_q_2 = $_POST['geometry_effort_q_2'];
$geometry_effort_q_3 = $_POST['geometry_effort_q_3'];
$geometry_effort_q_4 = $_POST['geometry_effort_q_4'];

//wp_dkf3k12nf1_bds_report_work_study_habit

$arrives_on_time_q_1 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_2 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_3 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_4 = $_POST['arrives_on_time_q_1'];

$follow_dire_q_1 = $_POST['follow_dire_q_1'];
$follow_dire_q_2 = $_POST['follow_dire_q_2'];
$follow_dire_q_3 = $_POST['follow_dire_q_3'];
$follow_dire_q_4 = $_POST['follow_dire_q_4'];

$adequate_attention_q_1 = $_POST['adequate_attention_q_1'];
$adequate_attention_q_2 = $_POST['adequate_attention_q_2'];
$adequate_attention_q_3 = $_POST['adequate_attention_q_3'];
$adequate_attention_q_4 = $_POST['adequate_attention_q_4'];

$school_tools_q_1 = $_POST['school_tools_q_1'];
$school_tools_q_2 = $_POST['school_tools_q_2'];
$school_tools_q_3 = $_POST['school_tools_q_3'];
$school_tools_q_4 = $_POST['school_tools_q_4'];

$completes_tasks_q_1 = $_POST['completes_tasks_q_1'];
$completes_tasks_q_2 = $_POST['completes_tasks_q_2'];
$completes_tasks_q_3 = $_POST['completes_tasks_q_3'];
$completes_tasks_q_4 = $_POST['completes_tasks_q_4'];

$acc_responsibility_q_1 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_2 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_3 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_4 = $_POST['acc_responsibility_q_1'];

$quality_work_q_1 = $_POST['quality_work_q_1'];
$quality_work_q_2 = $_POST['quality_work_q_2'];
$quality_work_q_3 = $_POST['quality_work_q_3'];
$quality_work_q_4 = $_POST['quality_work_q_4'];

$complete_hw_q_1 = $_POST['complete_hw_q_1'];
$complete_hw_q_2 = $_POST['complete_hw_q_2'];
$complete_hw_q_3 = $_POST['complete_hw_q_3'];
$complete_hw_q_4 = $_POST['complete_hw_q_4'];

$wsh_efforts_q_1 = $_POST['wsh_efforts_q_1'];
$wsh_efforts_q_2 = $_POST['wsh_efforts_q_2'];
$wsh_efforts_q_3 = $_POST['wsh_efforts_q_3'];
$wsh_efforts_q_4 = $_POST['wsh_efforts_q_4'];

//wp_dkf3k12nf1_bds_report_life_skills

$keeps_hands_q_1 = $_POST['keeps_hands_q_1'];
$keeps_hands_q_2 = $_POST['keeps_hands_q_2'];
$keeps_hands_q_3 = $_POST['keeps_hands_q_3'];
$keeps_hands_q_4 = $_POST['keeps_hands_q_4'];

$cooperates_in_group_q_1 = $_POST['cooperates_in_group_q_1'];
$cooperates_in_group_q_2 = $_POST['cooperates_in_group_q_2'];
$cooperates_in_group_q_3 = $_POST['cooperates_in_group_q_3'];
$cooperates_in_group_q_4 = $_POST['cooperates_in_group_q_4'];

$listens_without_q_1 = $_POST['listens_without_q_1'];
$listens_without_q_2 = $_POST['listens_without_q_2'];
$listens_without_q_3 = $_POST['listens_without_q_3'];
$listens_without_q_4 = $_POST['listens_without_q_4'];

$accepts_teachers_q_1 = $_POST['accepts_teachers_q_1'];
$accepts_teachers_q_2 = $_POST['accepts_teachers_q_2'];
$accepts_teachers_q_3 = $_POST['accepts_teachers_q_3'];
$accepts_teachers_q_4 = $_POST['accepts_teachers_q_4'];

$demonstrates_q_1 = $_POST['demonstrates_q_1'];
$demonstrates_q_2 = $_POST['demonstrates_q_2'];
$demonstrates_q_3 = $_POST['demonstrates_q_3'];
$demonstrates_q_4 = $_POST['demonstrates_q_4'];

$responsibility_q_1 = $_POST['responsibility_q_1'];
$responsibility_q_2 = $_POST['responsibility_q_2'];
$responsibility_q_3 = $_POST['responsibility_q_3'];
$responsibility_q_4 = $_POST['responsibility_q_4'];

$copes_q_1 = $_POST['copes_q_1'];
$copes_q_2 = $_POST['copes_q_2'];
$copes_q_3 = $_POST['copes_q_3'];
$copes_q_4 = $_POST['copes_q_4'];

$respects_rights_q_1 = $_POST['respects_rights_q_1'];
$respects_rights_q_2 = $_POST['respects_rights_q_2'];
$respects_rights_q_3 = $_POST['respects_rights_q_3'];
$respects_rights_q_4 = $_POST['respects_rights_q_4'];

$perseverance_q_1 = $_POST['perseverance_q_1'];
$perseverance_q_2 = $_POST['perseverance_q_2'];
$perseverance_q_3 = $_POST['perseverance_q_3'];
$perseverance_q_4 = $_POST['perseverance_q_4'];

$ls_efforts_q_1 = $_POST['ls_efforts_q_1'];
$ls_efforts_q_2 = $_POST['ls_efforts_q_2'];
$ls_efforts_q_3 = $_POST['ls_efforts_q_3'];
$ls_efforts_q_4 = $_POST['ls_efforts_q_4'];

//wp_dkf3k12nf1_bds_report_curricular_studies

$science_q_1 = $_POST['science_q_1'];
$science_q_2 = $_POST['science_q_2'];
$science_q_3 = $_POST['science_q_3'];
$science_q_4 = $_POST['science_q_4'];

$social_studies_q_1 = $_POST['social_studies_q_1'];
$social_studies_q_2 = $_POST['social_studies_q_2'];
$social_studies_q_3 = $_POST['social_studies_q_3'];
$social_studies_q_4 = $_POST['social_studies_q_4'];

$physical_edu_q_1 = $_POST['physical_edu_q_1'];
$physical_edu_q_2 = $_POST['physical_edu_q_2'];
$physical_edu_q_3 = $_POST['physical_edu_q_3'];
$physical_edu_q_4 = $_POST['physical_edu_q_4'];

$art_q_1 = $_POST['art_q_1'];
$art_q_2 = $_POST['art_q_2'];
$art_q_3 = $_POST['art_q_3'];
$art_q_4 = $_POST['art_q_4'];

$music_q_1 = $_POST['music_q_1'];
$music_q_2 = $_POST['music_q_2'];
$music_q_3 = $_POST['music_q_3'];
$music_q_4 = $_POST['music_q_4'];

//wp_dkf3k12nf1_bds_report_attendence

$days_tarday_q_1 = $_POST['days_tarday_q_1'];
$days_tarday_q_2 = $_POST['days_tarday_q_2'];
$days_tarday_q_3 = $_POST['days_tarday_q_3'];
$days_tarday_q_4 = $_POST['days_tarday_q_4'];

$days_absent_q_1 = $_POST['days_absent_q_1'];
$days_absent_q_2 = $_POST['days_absent_q_2'];
$days_absent_q_3 = $_POST['days_absent_q_3'];
$days_absent_q_4 = $_POST['days_absent_q_4'];

$tradies_q_1 = $_POST['tradies_q_1'];
$tradies_q_2 = $_POST['tradies_q_2'];
$tradies_q_3 = $_POST['tradies_q_3'];
$tradies_q_4 = $_POST['tradies_q_4'];

$grade_q_1 = $_POST['grade_q_1'];
$grade_q_2 = $_POST['grade_q_2'];
$grade_q_3 = $_POST['grade_q_3'];
$grade_q_4 = $_POST['grade_q_4'];
       
       $add_report = $wpdb->insert($tbl_report, array(            
            'teacher_id'=> $_SESSION['teacher'],
            'student_id'=> $student_id,
            'title' => $title,
            'teacher_signature' => $teacher_signature,
            'report_session'=>$report_session,
            'class_name'=>$class_name,
            'qtr_comment_1' =>  $qtr_comment_1,
            'qtr_comment_2' =>  $qtr_comment_2,
            'qtr_comment_3' =>  $qtr_comment_3,
            'qtr_comment_4' =>  $qtr_comment_4
       ));
       $report_id= $wpdb->insert_id;
       
       $add_report_info_text = $wpdb->insert($tbl_bds_report_literature_info_text, array(            
            'report_id'=> $report_id , 
            'retells_q_1'=> $retells_q_1,
            'retells_q_2'=> $retells_q_2,
            'retells_q_3' => $retells_q_3,
            'retells_q_4' => $retells_q_4,
            'common_type_q_1' =>  $common_type_q_1,
            'common_type_q_2' =>  $common_type_q_2,
            'common_type_q_3' =>  $common_type_q_3,
            'common_type_q_4' =>  $common_type_q_4
       ));
       
       $add_report_f_skills = $wpdb->insert($tbl_bds_report_foundational_skills, array(            
            'report_id'=> $report_id , 
            'reads_emergent_q_1'=> $reads_emergent_q_1,
            'reads_emergent_q_2'=> $reads_emergent_q_2,
            'reads_emergent_q_3' => $reads_emergent_q_3,
            'reads_emergent_q_4' => $reads_emergent_q_4,
            'analysis_skills_q_1' =>  $analysis_skills_q_1,
            'analysis_skills_q_2' =>  $analysis_skills_q_2,
            'analysis_skills_q_3' =>  $analysis_skills_q_3,
            'analysis_skills_q_4' =>  $analysis_skills_q_4,
           'recognize_upper_q_1' =>  $recognize_upper_q_1,
           'recognize_upper_q_2' =>  $recognize_upper_q_2,
           'recognize_upper_q_3' =>  $recognize_upper_q_3,
           'recognize_upper_q_4' =>  $recognize_upper_q_4,
           'identifies_q_1' =>  $identifies_q_1,
           'identifies_q_2' =>  $identifies_q_2,
           'identifies_q_3' =>  $identifies_q_3,
           'identifies_q_4' =>  $identifies_q_4,
           'f_skills_effort_q_1' =>  $f_skills_effort_q_1,
           'f_skills_effort_q_2' =>  $f_skills_effort_q_2,
           'f_skills_effort_q_3' =>  $f_skills_effort_q_3,
           'f_skills_effort_q_4' =>  $f_skills_effort_q_4
       ));
       
       $add_report_l_con = $wpdb->insert($tbl_bds_report_language_conventions, array(            
            'report_id'=> $report_id , 
            'prints_upper_q_1'=> $prints_upper_q_1,
            'prints_upper_q_2'=> $prints_upper_q_2,
            'prints_upper_q_3' => $prints_upper_q_3,
            'prints_upper_q_4' => $prints_upper_q_4,
            'demo_convent_q_1' =>  $demo_convent_q_1,
            'demo_convent_q_2' =>  $demo_convent_q_2,
            'demo_convent_q_3' =>  $demo_convent_q_3,
            'demo_convent_q_4' =>  $demo_convent_q_4,
           'acquires_q_1' =>  $acquires_q_1,
           'acquires_q_2' =>  $acquires_q_2,
           'acquires_q_3' =>  $acquires_q_3,
           'acquires_q_4' =>  $acquires_q_4
       ));
       
       $add_report_t_t_p = $wpdb->insert($tbl_bds_report_text_type_purpose, array(            
            'report_id'=> $report_id , 
            'utilizes_journal_q_1'=> $utilizes_journal_q_1,
            'utilizes_journal_q_2'=> $utilizes_journal_q_2,
            'utilizes_journal_q_3' => $utilizes_journal_q_3,
            'utilizes_journal_q_4' => $utilizes_journal_q_4,
            'strengthen_writing_q_1' =>  $strengthen_writing_q_1,
            'strengthen_writing_q_2' =>  $strengthen_writing_q_2,
            'strengthen_writing_q_3' =>  $strengthen_writing_q_3,
            'strengthen_writing_q_4' =>  $strengthen_writing_q_4
       ));
       
       $add_report_p_o_k = $wpdb->insert($tbl_bds_report_prest_of_knowledge, array(            
            'report_id'=> $report_id , 
            'contributes_q_1'=> $contributes_q_1,
            'contributes_q_2'=> $contributes_q_2,
            'contributes_q_3' => $contributes_q_3,
            'contributes_q_4' => $contributes_q_4,
            'ask_answers_q_1' =>  $ask_answers_q_1,
            'ask_answers_q_2' =>  $ask_answers_q_2,
            'ask_answers_q_3' =>  $strengthen_writing_q_3,
            'ask_answers_q_4' =>  $ask_answers_q_4,
            'expresses_q_1' =>  $expresses_q_1,
            'expresses_q_2' =>  $expresses_q_2,
            'expresses_q_3' =>  $expresses_q_3,
            'expresses_q_4' =>  $expresses_q_4,
            'pk_effort_q_1' =>  $pk_effort_q_1,
            'pk_effort_q_2' =>  $pk_effort_q_2,
            'pk_effort_q_3' =>  $pk_effort_q_3,
            'pk_effort_q_4' =>  $pk_effort_q_4
       ));
       
       $add_report_c_c = $wpdb->insert($tbl_bds_report_counting_cardinality, array(            
            'report_id'=> $report_id , 
            'identifies_number_q_1'=> $identifies_number_q_1,
            'identifies_number_q_2'=> $identifies_number_q_2,
            'identifies_number_q_3' => $identifies_number_q_3,
            'identifies_number_q_4' => $identifies_number_q_4,
            'counts_tell_q_1' =>  $counts_tell_q_1,
            'counts_tell_q_2' =>  $counts_tell_q_2,
            'counts_tell_q_3' =>  $counts_tell_q_3,
            'counts_tell_q_4' =>  $counts_tell_q_4,
            'compares_sets_q_1' =>  $compares_sets_q_1,
            'compares_sets_q_2' =>  $compares_sets_q_2,
            'compares_sets_q_3' =>  $compares_sets_q_3,
            'compares_sets_q_4' =>  $compares_sets_q_4
       ));
       
       $add_report_operations = $wpdb->insert($tbl_bds_report_operations, array(            
            'report_id'=> $report_id , 
            'joins_sets_q_1'=> $joins_sets_q_1,
            'joins_sets_q_2'=> $joins_sets_q_2,
            'joins_sets_q_3' => $joins_sets_q_3,
            'joins_sets_q_4' => $joins_sets_q_4,
            'seprate_set_q_1' =>  $seprate_set_q_1,
            'seprate_set_q_2' =>  $seprate_set_q_2,
            'seprate_set_q_3' =>  $seprate_set_q_3,
            'seprate_set_q_4' =>  $seprate_set_q_4,
            'fluently_adds_q_1' =>  $fluently_adds_q_1,
            'fluently_adds_q_2' =>  $fluently_adds_q_2,
            'fluently_adds_q_3' =>  $fluently_adds_q_3,
            'fluently_adds_q_4' =>  $fluently_adds_q_4
       ));
       
       $add_report_number_sense = $wpdb->insert($tbl_bds_report_number_sense, array(            
            'report_id'=> $report_id , 
            'works_with_numbers_q_1'=> $works_with_numbers_q_1,
            'works_with_numbers_q_2'=> $works_with_numbers_q_2,
            'works_with_numbers_q_3' => $works_with_numbers_q_3,
            'works_with_numbers_q_4' => $works_with_numbers_q_4
       ));
       
       $add_report_m_num = $wpdb->insert($tbl_bds_report_measurement_number, array(            
            'report_id'=> $report_id , 
            'describe_comp_q_1'=> $describe_comp_q_1,
            'describe_comp_q_2'=> $describe_comp_q_2,
            'describe_comp_q_3' => $describe_comp_q_3,
            'describe_comp_q_4' => $describe_comp_q_4,
            'sorts_classify_q_1'=> $sorts_classify_q_1,
            'sorts_classify_q_2'=> $sorts_classify_q_2,
            'sorts_classify_q_3' => $sorts_classify_q_3,
            'sorts_classify_q_4' => $sorts_classify_q_4
       ));
       
       
       $add_report_geometry = $wpdb->insert($tbl_bds_report_geometry, array(            
            'report_id'=> $report_id , 
            'identifies_2d_q_1'=> $identifies_2d_q_1,
            'identifies_2d_q_2'=> $identifies_2d_q_1,
            'identifies_2d_q_3' => $identifies_2d_q_1,
            'identifies_2d_q_4' => $identifies_2d_q_4,
            'compares_2d_q_1'=> $compares_2d_q_1,
            'compares_2d_q_2'=> $compares_2d_q_2,
            'compares_2d_q_3' => $compares_2d_q_3,
            'compares_2d_q_4' => $compares_2d_q_4,
            'geometry_effort_q_1'=> $geometry_effort_q_1,
            'geometry_effort_q_2'=> $geometry_effort_q_2,
            'geometry_effort_q_3' => $geometry_effort_q_3,
            'geometry_effort_q_4' => $geometry_effort_q_4
       ));
       
       $add_report_work_study_habit = $wpdb->insert($tbl_bds_report_work_study_habit, array(            
            'report_id'=> $report_id , 
            'arrives_on_time_q_1' => $arrives_on_time_q_1,
            'arrives_on_time_q_2' => $arrives_on_time_q_2,
            'arrives_on_time_q_3' => $arrives_on_time_q_3,
            'arrives_on_time_q_4' => $arrives_on_time_q_4,
            'follow_dire_q_1'=> $follow_dire_q_1,
            'follow_dire_q_2'=> $follow_dire_q_2,
            'follow_dire_q_3' => $follow_dire_q_3,
            'follow_dire_q_4' => $follow_dire_q_4,
            'adequate_attention_q_1'=> $adequate_attention_q_1,
            'adequate_attention_q_2'=> $adequate_attention_q_2,
            'adequate_attention_q_3' => $adequate_attention_q_3,
            'adequate_attention_q_4' => $adequate_attention_q_3,
            'school_tools_q_1'=> $school_tools_q_1,
            'school_tools_q_2'=> $school_tools_q_2,
            'school_tools_q_3' => $school_tools_q_3,
            'school_tools_q_4' => $school_tools_q_4,
            'completes_tasks_q_1'=> $completes_tasks_q_1,
            'completes_tasks_q_2'=> $completes_tasks_q_2,
            'completes_tasks_q_3' => $completes_tasks_q_3,
            'completes_tasks_q_4' => $completes_tasks_q_4,
            'acc_responsibility_q_1'=> $acc_responsibility_q_1,
            'acc_responsibility_q_2'=> $acc_responsibility_q_2,
            'acc_responsibility_q_3' => $acc_responsibility_q_3,
            'acc_responsibility_q_4' => $acc_responsibility_q_4,
            'quality_work_q_1'=> $quality_work_q_1,
            'quality_work_q_2'=> $quality_work_q_2,
            'quality_work_q_3' => $quality_work_q_3,
            'quality_work_q_4' => $quality_work_q_4,
            'complete_hw_q_1'=> $complete_hw_q_1,
            'complete_hw_q_2'=> $complete_hw_q_2,
            'complete_hw_q_3' => $complete_hw_q_3,
            'complete_hw_q_4' => $complete_hw_q_4,
            'wsh_efforts_q_1'=> $wsh_efforts_q_1,
            'wsh_efforts_q_2'=> $wsh_efforts_q_2,
            'wsh_efforts_q_3' => $wsh_efforts_q_3,
            'wsh_efforts_q_4' => $wsh_efforts_q_4
       ));
       
       $add_report_life_skills = $wpdb->insert($tbl_bds_report_life_skills, array(            
            'report_id'=> $report_id , 
            'keeps_hands_q_1'=> $keeps_hands_q_1,
            'keeps_hands_q_2'=> $keeps_hands_q_2,
            'keeps_hands_q_3' => $keeps_hands_q_3,
            'keeps_hands_q_4' => $keeps_hands_q_4,
            'cooperates_in_group_q_1'=> $cooperates_in_group_q_1,
            'cooperates_in_group_q_2'=> $cooperates_in_group_q_2,
            'cooperates_in_group_q_3' => $cooperates_in_group_q_3,
            'cooperates_in_group_q_4' => $cooperates_in_group_q_4,
            'listens_without_q_1'=> $listens_without_q_1,
            'listens_without_q_2'=> $listens_without_q_2,
            'listens_without_q_3' => $listens_without_q_3,
            'listens_without_q_4' => $listens_without_q_4,
            'accepts_teachers_q_1'=> $accepts_teachers_q_1,
            'accepts_teachers_q_2'=> $accepts_teachers_q_2,
            'accepts_teachers_q_3' => $accepts_teachers_q_3,
            'accepts_teachers_q_4' => $accepts_teachers_q_4,
            'demonstrates_q_1'=> $demonstrates_q_1,
            'demonstrates_q_2'=> $demonstrates_q_2,
            'demonstrates_q_3' => $demonstrates_q_3,
            'demonstrates_q_4' => $demonstrates_q_4,
            'responsibility_q_1'=> $responsibility_q_1,
            'responsibility_q_2'=> $responsibility_q_2,
            'responsibility_q_3' => $responsibility_q_3,
            'responsibility_q_4' => $responsibility_q_4,
            'copes_q_1' => $copes_q_1,
            'copes_q_2' => $copes_q_2,
            'copes_q_3' => $copes_q_3,
            'copes_q_4' => $copes_q_4,
            'respects_rights_q_1' => $respects_rights_q_1,
            'respects_rights_q_2' => $respects_rights_q_2,
            'respects_rights_q_3' => $respects_rights_q_3,
            'respects_rights_q_4' => $respects_rights_q_4,
            'perseverance_q_1' => $perseverance_q_1,
            'perseverance_q_2' => $perseverance_q_2,
            'perseverance_q_3' => $perseverance_q_3,
            'perseverance_q_4' => $perseverance_q_4,
            'ls_efforts_q_1' => $ls_efforts_q_1,
            'ls_efforts_q_2' => $ls_efforts_q_2,
            'ls_efforts_q_3' => $ls_efforts_q_3,
            'ls_efforts_q_4' => $ls_efforts_q_4
       ));
       
       $add_report_curri_studies = $wpdb->insert($tbl_bds_report_curricular_studies, array(            
            'report_id'=> $report_id , 
            'science_q_1'=> $science_q_1,
            'science_q_2'=> $science_q_2,
            'science_q_3' => $science_q_3,
            'science_q_4' => $science_q_4,
            'social_studies_q_1'=> $social_studies_q_1,
            'social_studies_q_2'=> $social_studies_q_2,
            'social_studies_q_3' => $social_studies_q_3,
            'social_studies_q_4' => $social_studies_q_4,
            'physical_edu_q_1' => $physical_edu_q_1,
            'physical_edu_q_2' => $physical_edu_q_2,
            'physical_edu_q_3' => $physical_edu_q_3,
            'physical_edu_q_4' => $physical_edu_q_4,
            'art_q_1' => $art_q_1,
            'art_q_2' => $art_q_2,
            'art_q_3' => $art_q_3,
            'art_q_4' => $art_q_4,
            'music_q_1' => $music_q_1,
            'music_q_2' => $music_q_2,
            'music_q_3' => $music_q_3,
            'music_q_4' => $music_q_4  
       ));
       
       $add_report_attend = $wpdb->insert($tbl_bds_report_attendence, array(            
            'report_id'=> $report_id , 
            'days_tarday_q_1'=> $days_tarday_q_1,
            'days_tarday_q_2'=> $days_tarday_q_2,
            'days_tarday_q_3' => $days_tarday_q_3,
            'days_tarday_q_4' => $days_tarday_q_4,
            'days_absent_q_1'=> $days_absent_q_1,
            'days_absent_q_2'=> $days_absent_q_2,
            'days_absent_q_3' => $days_absent_q_3,
            'days_absent_q_4' => $days_absent_q_4,
            'tradies_q_1' => $tradies_q_1,
            'tradies_q_2' => $tradies_q_2,
            'tradies_q_3' => $tradies_q_3,
            'tradies_q_4' => $tradies_q_4,
            'grade_q_1' => $grade_q_1,
            'grade_q_2' => $grade_q_2,
            'grade_q_3' => $grade_q_3,
            'grade_q_4' => $grade_q_4 
       ));
       
       if($add_report === false){
           $error_message = '<h5 style="color:green;text-align: center;">Report add failed</h5>';
       }else{
           $error_message = '<h5 style="color:green;text-align: center;">Report added successfully</h5>';
       }
       
       //echo "Inserted Id ".$report_id;
       
   }

if(isset($_POST['update_report_btn'])){
   
   $student_report_id = $_POST['student_report_id']; 
   $title= $_POST['teacher_signature'];
   $student_id = $_POST['student_id'];
   $teacher_signature = $_POST['teacher_signature'];
   $report_session = $_POST['report_session'];
   $class_name = $_POST['class_name'];
   $qtr_comment_1 = $_POST['qtr_comment_1'];
   $qtr_comment_2 =$_POST['qtr_comment_2'];
   $qtr_comment_3 =$_POST['qtr_comment_3'];
   $qtr_comment_4 =$_POST['qtr_comment_4'];
   
   $retells_q_1 =$_POST['retells_q_1'];
   $retells_q_2 =$_POST['retells_q_2'];
   $retells_q_3 =$_POST['retells_q_3'];
   $retells_q_4 =$_POST['retells_q_4'];
   $common_type_q_1 = $_POST['common_type_q_1'];
   $common_type_q_2 = $_POST['common_type_q_2'];
   $common_type_q_3 = $_POST['common_type_q_3'];
   $common_type_q_4 = $_POST['common_type_q_4'];
   
   ////Foundational Skils
   $reads_emergent_q_1 = $_POST['reads_emergent_q_1'];
   $reads_emergent_q_2 = $_POST['reads_emergent_q_2'];
   $reads_emergent_q_3 = $_POST['reads_emergent_q_3'];
   $reads_emergent_q_4 = $_POST['reads_emergent_q_4'];
   
   $analysis_skills_q_1 = $_POST['analysis_skills_q_1'];
   $analysis_skills_q_2 = $_POST['analysis_skills_q_2'];
   $analysis_skills_q_3 = $_POST['analysis_skills_q_3'];
   $analysis_skills_q_4 = $_POST['analysis_skills_q_4'];

   $recognize_upper_q_1 = $_POST['recognize_upper_q_1'];
   $recognize_upper_q_2 = $_POST['recognize_upper_q_2'];
   $recognize_upper_q_3 = $_POST['recognize_upper_q_3'];
   $recognize_upper_q_4 = $_POST['recognize_upper_q_4'];

   $identifies_q_1 = $_POST['identifies_q_1'];
   $identifies_q_2 = $_POST['identifies_q_2'];
   $identifies_q_3 = $_POST['identifies_q_3'];
   $identifies_q_4 = $_POST['identifies_q_4'];

   $f_skills_effort_q_1 = $_POST['f_skills_effort_q_1'];
   $f_skills_effort_q_2 = $_POST['f_skills_effort_q_2'];
   $f_skills_effort_q_3 = $_POST['f_skills_effort_q_3'];
   $f_skills_effort_q_4 = $_POST['f_skills_effort_q_4'];
   
   ///////language_conventions
   
   $prints_upper_q_1 = $_POST['prints_upper_q_1'];
   $prints_upper_q_2 = $_POST['prints_upper_q_2'];
   $prints_upper_q_3 = $_POST['prints_upper_q_3'];
   $prints_upper_q_4 = $_POST['prints_upper_q_4'];

    $demo_convent_q_1 = $_POST['demo_convent_q_1'];
    $demo_convent_q_2 = $_POST['demo_convent_q_2'];
    $demo_convent_q_3 = $_POST['demo_convent_q_3'];
    $demo_convent_q_4 = $_POST['demo_convent_q_4'];

    $acquires_q_1 = $_POST['acquires_q_1'];
    $acquires_q_2 = $_POST['acquires_q_2'];
    $acquires_q_3 = $_POST['acquires_q_3'];
    $acquires_q_4 = $_POST['acquires_q_4'];
    
    ///type_purpose
    
    $utilizes_journal_q_1 = $_POST['utilizes_journal_q_1'];
    $utilizes_journal_q_2 = $_POST['utilizes_journal_q_2'];
    $utilizes_journal_q_3 = $_POST['utilizes_journal_q_3'];
    $utilizes_journal_q_4 = $_POST['utilizes_journal_q_4'];

    $strengthen_writing_q_1 = $_POST['strengthen_writing_q_1'];
    $strengthen_writing_q_2 = $_POST['strengthen_writing_q_2'];
    $strengthen_writing_q_3 = $_POST['strengthen_writing_q_3'];
    $strengthen_writing_q_4 = $_POST['strengthen_writing_q_4'];
    
    ////prest_of_knowledge
   
    $contributes_q_1 = $_POST['contributes_q_1'];
    $contributes_q_2 = $_POST['contributes_q_2'];
    $contributes_q_3 = $_POST['contributes_q_3'];
    $contributes_q_4 = $_POST['contributes_q_4'];

    $ask_answers_q_1 = $_POST['ask_answers_q_1'];
    $ask_answers_q_2 = $_POST['ask_answers_q_2'];
    $ask_answers_q_3 = $_POST['ask_answers_q_3'];
    $ask_answers_q_4 = $_POST['ask_answers_q_4'];

    $expresses_q_1 = $_POST['expresses_q_1'];
    $expresses_q_2 = $_POST['expresses_q_2'];
    $expresses_q_3 = $_POST['expresses_q_3'];
    $expresses_q_4 = $_POST['expresses_q_4'];

    $pk_effort_q_1 = $_POST['pk_effort_q_1'];
    $pk_effort_q_2 = $_POST['pk_effort_q_2'];
    $pk_effort_q_3 = $_POST['pk_effort_q_3'];
    $pk_effort_q_4 = $_POST['pk_effort_q_4'];
    
    //wp_dkf3k12nf1_bds_report_counting_cardinality

$identifies_number_q_1 = $_POST['identifies_number_q_1'];
$identifies_number_q_2 = $_POST['identifies_number_q_2'];
$identifies_number_q_3 = $_POST['identifies_number_q_3'];
$identifies_number_q_4 = $_POST['identifies_number_q_4'];

$counts_tell_q_1 = $_POST['counts_tell_q_1'];
$counts_tell_q_2 = $_POST['counts_tell_q_2'];
$counts_tell_q_3 = $_POST['counts_tell_q_3'];
$counts_tell_q_4 = $_POST['counts_tell_q_4'];

$compares_sets_q_1 = $_POST['compares_sets_q_1'];
$compares_sets_q_2 = $_POST['compares_sets_q_2'];
$compares_sets_q_3 = $_POST['compares_sets_q_3'];
$compares_sets_q_4 = $_POST['compares_sets_q_4'];

//wp_dkf3k12nf1_bds_report_operations

$joins_sets_q_1 = $_POST['joins_sets_q_1'];
$joins_sets_q_2 = $_POST['joins_sets_q_2'];
$joins_sets_q_3 = $_POST['joins_sets_q_3'];
$joins_sets_q_4 = $_POST['joins_sets_q_4'];

$seprate_set_q_1 = $_POST['seprate_set_q_1'];
$seprate_set_q_2 = $_POST['seprate_set_q_2'];
$seprate_set_q_3 = $_POST['seprate_set_q_3'];
$seprate_set_q_4 = $_POST['seprate_set_q_4'];

$fluently_adds_q_1 = $_POST['fluently_adds_q_1'];
$fluently_adds_q_2 = $_POST['fluently_adds_q_2'];
$fluently_adds_q_3 = $_POST['fluently_adds_q_3'];
$fluently_adds_q_4 = $_POST['fluently_adds_q_4'];

//wp_dkf3k12nf1_bds_report_number_sense

$works_with_numbers_q_1 = $_POST['works_with_numbers_q_1'];
$works_with_numbers_q_2 = $_POST['works_with_numbers_q_2'];
$works_with_numbers_q_3 = $_POST['works_with_numbers_q_3'];
$works_with_numbers_q_4 = $_POST['works_with_numbers_q_4'];

//wp_dkf3k12nf1_bds_report_measurement_number

$describe_comp_q_1 = $_POST['describe_comp_q_1'];
$describe_comp_q_2 = $_POST['describe_comp_q_2'];
$describe_comp_q_3 = $_POST['describe_comp_q_3'];
$describe_comp_q_4 = $_POST['describe_comp_q_4'];

$sorts_classify_q_1 = $_POST['sorts_classify_q_1'];
$sorts_classify_q_2 = $_POST['sorts_classify_q_2'];
$sorts_classify_q_3 = $_POST['sorts_classify_q_3'];
$sorts_classify_q_4 = $_POST['sorts_classify_q_4'];

//wp_dkf3k12nf1_bds_report_geometry

$identifies_2d_q_1 = $_POST['identifies_2d_q_1'];
$identifies_2d_q_2 = $_POST['identifies_2d_q_2'];
$identifies_2d_q_3 = $_POST['identifies_2d_q_3'];
$identifies_2d_q_4 = $_POST['identifies_2d_q_4'];

$compares_2d_q_1 = $_POST['compares_2d_q_1'];
$compares_2d_q_2 = $_POST['compares_2d_q_2'];
$compares_2d_q_3 = $_POST['compares_2d_q_3'];
$compares_2d_q_4 = $_POST['compares_2d_q_4'];

$geometry_effort_q_1 = $_POST['geometry_effort_q_1'];
$geometry_effort_q_2 = $_POST['geometry_effort_q_2'];
$geometry_effort_q_3 = $_POST['geometry_effort_q_3'];
$geometry_effort_q_4 = $_POST['geometry_effort_q_4'];

//wp_dkf3k12nf1_bds_report_work_study_habit

$arrives_on_time_q_1 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_2 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_3 = $_POST['arrives_on_time_q_1'];
$arrives_on_time_q_4 = $_POST['arrives_on_time_q_1'];

$follow_dire_q_1 = $_POST['follow_dire_q_1'];
$follow_dire_q_2 = $_POST['follow_dire_q_2'];
$follow_dire_q_3 = $_POST['follow_dire_q_3'];
$follow_dire_q_4 = $_POST['follow_dire_q_4'];

$adequate_attention_q_1 = $_POST['adequate_attention_q_1'];
$adequate_attention_q_2 = $_POST['adequate_attention_q_2'];
$adequate_attention_q_3 = $_POST['adequate_attention_q_3'];
$adequate_attention_q_4 = $_POST['adequate_attention_q_4'];

$school_tools_q_1 = $_POST['school_tools_q_1'];
$school_tools_q_2 = $_POST['school_tools_q_2'];
$school_tools_q_3 = $_POST['school_tools_q_3'];
$school_tools_q_4 = $_POST['school_tools_q_4'];

$completes_tasks_q_1 = $_POST['completes_tasks_q_1'];
$completes_tasks_q_2 = $_POST['completes_tasks_q_2'];
$completes_tasks_q_3 = $_POST['completes_tasks_q_3'];
$completes_tasks_q_4 = $_POST['completes_tasks_q_4'];

$acc_responsibility_q_1 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_2 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_3 = $_POST['acc_responsibility_q_1'];
$acc_responsibility_q_4 = $_POST['acc_responsibility_q_1'];

$quality_work_q_1 = $_POST['quality_work_q_1'];
$quality_work_q_2 = $_POST['quality_work_q_2'];
$quality_work_q_3 = $_POST['quality_work_q_3'];
$quality_work_q_4 = $_POST['quality_work_q_4'];

$complete_hw_q_1 = $_POST['complete_hw_q_1'];
$complete_hw_q_2 = $_POST['complete_hw_q_2'];
$complete_hw_q_3 = $_POST['complete_hw_q_3'];
$complete_hw_q_4 = $_POST['complete_hw_q_4'];

$wsh_efforts_q_1 = $_POST['wsh_efforts_q_1'];
$wsh_efforts_q_2 = $_POST['wsh_efforts_q_2'];
$wsh_efforts_q_3 = $_POST['wsh_efforts_q_3'];
$wsh_efforts_q_4 = $_POST['wsh_efforts_q_4'];

//wp_dkf3k12nf1_bds_report_life_skills

$keeps_hands_q_1 = $_POST['keeps_hands_q_1'];
$keeps_hands_q_2 = $_POST['keeps_hands_q_2'];
$keeps_hands_q_3 = $_POST['keeps_hands_q_3'];
$keeps_hands_q_4 = $_POST['keeps_hands_q_4'];

$cooperates_in_group_q_1 = $_POST['cooperates_in_group_q_1'];
$cooperates_in_group_q_2 = $_POST['cooperates_in_group_q_2'];
$cooperates_in_group_q_3 = $_POST['cooperates_in_group_q_3'];
$cooperates_in_group_q_4 = $_POST['cooperates_in_group_q_4'];

$listens_without_q_1 = $_POST['listens_without_q_1'];
$listens_without_q_2 = $_POST['listens_without_q_2'];
$listens_without_q_3 = $_POST['listens_without_q_3'];
$listens_without_q_4 = $_POST['listens_without_q_4'];

$accepts_teachers_q_1 = $_POST['accepts_teachers_q_1'];
$accepts_teachers_q_2 = $_POST['accepts_teachers_q_2'];
$accepts_teachers_q_3 = $_POST['accepts_teachers_q_3'];
$accepts_teachers_q_4 = $_POST['accepts_teachers_q_4'];

$demonstrates_q_1 = $_POST['demonstrates_q_1'];
$demonstrates_q_2 = $_POST['demonstrates_q_2'];
$demonstrates_q_3 = $_POST['demonstrates_q_3'];
$demonstrates_q_4 = $_POST['demonstrates_q_4'];

$responsibility_q_1 = $_POST['responsibility_q_1'];
$responsibility_q_2 = $_POST['responsibility_q_2'];
$responsibility_q_3 = $_POST['responsibility_q_3'];
$responsibility_q_4 = $_POST['responsibility_q_4'];

$copes_q_1 = $_POST['copes_q_1'];
$copes_q_2 = $_POST['copes_q_2'];
$copes_q_3 = $_POST['copes_q_3'];
$copes_q_4 = $_POST['copes_q_4'];

$respects_rights_q_1 = $_POST['respects_rights_q_1'];
$respects_rights_q_2 = $_POST['respects_rights_q_2'];
$respects_rights_q_3 = $_POST['respects_rights_q_3'];
$respects_rights_q_4 = $_POST['respects_rights_q_4'];

$perseverance_q_1 = $_POST['perseverance_q_1'];
$perseverance_q_2 = $_POST['perseverance_q_2'];
$perseverance_q_3 = $_POST['perseverance_q_3'];
$perseverance_q_4 = $_POST['perseverance_q_4'];

$ls_efforts_q_1 = $_POST['ls_efforts_q_1'];
$ls_efforts_q_2 = $_POST['ls_efforts_q_2'];
$ls_efforts_q_3 = $_POST['ls_efforts_q_3'];
$ls_efforts_q_4 = $_POST['ls_efforts_q_4'];

//wp_dkf3k12nf1_bds_report_curricular_studies

$science_q_1 = $_POST['science_q_1'];
$science_q_2 = $_POST['science_q_2'];
$science_q_3 = $_POST['science_q_3'];
$science_q_4 = $_POST['science_q_4'];

$social_studies_q_1 = $_POST['social_studies_q_1'];
$social_studies_q_2 = $_POST['social_studies_q_2'];
$social_studies_q_3 = $_POST['social_studies_q_3'];
$social_studies_q_4 = $_POST['social_studies_q_4'];

$physical_edu_q_1 = $_POST['physical_edu_q_1'];
$physical_edu_q_2 = $_POST['physical_edu_q_2'];
$physical_edu_q_3 = $_POST['physical_edu_q_3'];
$physical_edu_q_4 = $_POST['physical_edu_q_4'];

$art_q_1 = $_POST['art_q_1'];
$art_q_2 = $_POST['art_q_2'];
$art_q_3 = $_POST['art_q_3'];
$art_q_4 = $_POST['art_q_4'];

$music_q_1 = $_POST['music_q_1'];
$music_q_2 = $_POST['music_q_2'];
$music_q_3 = $_POST['music_q_3'];
$music_q_4 = $_POST['music_q_4'];

//wp_dkf3k12nf1_bds_report_attendence

$days_tarday_q_1 = $_POST['days_tarday_q_1'];
$days_tarday_q_2 = $_POST['days_tarday_q_2'];
$days_tarday_q_3 = $_POST['days_tarday_q_3'];
$days_tarday_q_4 = $_POST['days_tarday_q_4'];

$days_absent_q_1 = $_POST['days_absent_q_1'];
$days_absent_q_2 = $_POST['days_absent_q_2'];
$days_absent_q_3 = $_POST['days_absent_q_3'];
$days_absent_q_4 = $_POST['days_absent_q_4'];

$tradies_q_1 = $_POST['tradies_q_1'];
$tradies_q_2 = $_POST['tradies_q_2'];
$tradies_q_3 = $_POST['tradies_q_3'];
$tradies_q_4 = $_POST['tradies_q_4'];

$grade_q_1 = $_POST['grade_q_1'];
$grade_q_2 = $_POST['grade_q_2'];
$grade_q_3 = $_POST['grade_q_3'];
$grade_q_4 = $_POST['grade_q_4'];
       
       
       $where = array('id' => $student_report_id);
       $where_report_id = array('report_id' => $student_report_id);
       
       $update_report = $wpdb->update($tbl_report, array(            
            'title' => $title,
            'teacher_signature' => $teacher_signature,
            'report_session'=> $report_session,
            'class_name'=> $class_name,
            'qtr_comment_1' =>  $qtr_comment_1,
            'qtr_comment_2' =>  $qtr_comment_2,
            'qtr_comment_3' =>  $qtr_comment_3,
            'qtr_comment_4' =>  $qtr_comment_4
       ),$where);
       
       $update_report_info_text = $wpdb->update($tbl_bds_report_literature_info_text, array(             
            'retells_q_1'=> $retells_q_1,
            'retells_q_2'=> $retells_q_2,
            'retells_q_3' => $retells_q_3,
            'retells_q_4' => $retells_q_4,
            'common_type_q_1' =>  $common_type_q_1,
            'common_type_q_2' =>  $common_type_q_2,
            'common_type_q_3' =>  $common_type_q_3,
            'common_type_q_4' =>  $common_type_q_4
       ),$where_report_id);
       
       $update_report_f_skills = $wpdb->update($tbl_bds_report_foundational_skills, array(            
            'reads_emergent_q_1'=> $reads_emergent_q_1,
            'reads_emergent_q_2'=> $reads_emergent_q_2,
            'reads_emergent_q_3' => $reads_emergent_q_3,
            'reads_emergent_q_4' => $reads_emergent_q_4,
            'analysis_skills_q_1' =>  $analysis_skills_q_1,
            'analysis_skills_q_2' =>  $analysis_skills_q_2,
            'analysis_skills_q_3' =>  $analysis_skills_q_3,
            'analysis_skills_q_4' =>  $analysis_skills_q_4,
           'recognize_upper_q_1' =>  $recognize_upper_q_1,
           'recognize_upper_q_2' =>  $recognize_upper_q_2,
           'recognize_upper_q_3' =>  $recognize_upper_q_3,
           'recognize_upper_q_4' =>  $recognize_upper_q_4,
           'identifies_q_1' =>  $identifies_q_1,
           'identifies_q_2' =>  $identifies_q_2,
           'identifies_q_3' =>  $identifies_q_3,
           'identifies_q_4' =>  $identifies_q_4,
           'f_skills_effort_q_1' =>  $f_skills_effort_q_1,
           'f_skills_effort_q_2' =>  $f_skills_effort_q_2,
           'f_skills_effort_q_3' =>  $f_skills_effort_q_3,
           'f_skills_effort_q_4' =>  $f_skills_effort_q_4
       ),$where_report_id);
       
       $update_report_l_con = $wpdb->update($tbl_bds_report_language_conventions, array(             
            'prints_upper_q_1'=> $prints_upper_q_1,
            'prints_upper_q_2'=> $prints_upper_q_2,
            'prints_upper_q_3' => $prints_upper_q_3,
            'prints_upper_q_4' => $prints_upper_q_4,
            'demo_convent_q_1' =>  $demo_convent_q_1,
            'demo_convent_q_2' =>  $demo_convent_q_2,
            'demo_convent_q_3' =>  $demo_convent_q_3,
            'demo_convent_q_4' =>  $demo_convent_q_4,
           'acquires_q_1' =>  $acquires_q_1,
           'acquires_q_2' =>  $acquires_q_2,
           'acquires_q_3' =>  $acquires_q_3,
           'acquires_q_4' =>  $acquires_q_4
       ),$where_report_id);
       
       $update_report_t_t_p = $wpdb->update($tbl_bds_report_text_type_purpose, array(            
            'utilizes_journal_q_1'=> $utilizes_journal_q_1,
            'utilizes_journal_q_2'=> $utilizes_journal_q_2,
            'utilizes_journal_q_3' => $utilizes_journal_q_3,
            'utilizes_journal_q_4' => $utilizes_journal_q_4,
            'strengthen_writing_q_1' =>  $strengthen_writing_q_1,
            'strengthen_writing_q_2' =>  $strengthen_writing_q_2,
            'strengthen_writing_q_3' =>  $strengthen_writing_q_3,
            'strengthen_writing_q_4' =>  $strengthen_writing_q_4
       ),$where_report_id);
       
       $update_report_p_o_k = $wpdb->update($tbl_bds_report_prest_of_knowledge, array(             
            'contributes_q_1'=> $contributes_q_1,
            'contributes_q_2'=> $contributes_q_2,
            'contributes_q_3' => $contributes_q_3,
            'contributes_q_4' => $contributes_q_4,
            'ask_answers_q_1' =>  $ask_answers_q_1,
            'ask_answers_q_2' =>  $ask_answers_q_2,
            'ask_answers_q_3' =>  $strengthen_writing_q_3,
            'ask_answers_q_4' =>  $ask_answers_q_4,
            'expresses_q_1' =>  $expresses_q_1,
            'expresses_q_2' =>  $expresses_q_2,
            'expresses_q_3' =>  $expresses_q_3,
            'expresses_q_4' =>  $expresses_q_4,
            'pk_effort_q_1' =>  $pk_effort_q_1,
            'pk_effort_q_2' =>  $pk_effort_q_2,
            'pk_effort_q_3' =>  $pk_effort_q_3,
            'pk_effort_q_4' =>  $pk_effort_q_4
       ),$where_report_id);
       
       $update_report_c_c = $wpdb->update($tbl_bds_report_counting_cardinality, array(            
            'identifies_number_q_1'=> $identifies_number_q_1,
            'identifies_number_q_2'=> $identifies_number_q_2,
            'identifies_number_q_3' => $identifies_number_q_3,
            'identifies_number_q_4' => $identifies_number_q_4,
            'counts_tell_q_1' =>  $counts_tell_q_1,
            'counts_tell_q_2' =>  $counts_tell_q_2,
            'counts_tell_q_3' =>  $counts_tell_q_3,
            'counts_tell_q_4' =>  $counts_tell_q_4,
            'compares_sets_q_1' =>  $compares_sets_q_1,
            'compares_sets_q_2' =>  $compares_sets_q_2,
            'compares_sets_q_3' =>  $compares_sets_q_3,
            'compares_sets_q_4' =>  $compares_sets_q_4
       ),$where_report_id);
       
       $update_report_operations = $wpdb->update($tbl_bds_report_operations, array(             
            'joins_sets_q_1'=> $joins_sets_q_1,
            'joins_sets_q_2'=> $joins_sets_q_2,
            'joins_sets_q_3' => $joins_sets_q_3,
            'joins_sets_q_4' => $joins_sets_q_4,
            'seprate_set_q_1' =>  $seprate_set_q_1,
            'seprate_set_q_2' =>  $seprate_set_q_2,
            'seprate_set_q_3' =>  $seprate_set_q_3,
            'seprate_set_q_4' =>  $seprate_set_q_4,
            'fluently_adds_q_1' =>  $fluently_adds_q_1,
            'fluently_adds_q_2' =>  $fluently_adds_q_2,
            'fluently_adds_q_3' =>  $fluently_adds_q_3,
            'fluently_adds_q_4' =>  $fluently_adds_q_4
       ),$where_report_id);
       
       $update_report_number_sense = $wpdb->update($tbl_bds_report_number_sense, array(             
            'works_with_numbers_q_1'=> $works_with_numbers_q_1,
            'works_with_numbers_q_2'=> $works_with_numbers_q_2,
            'works_with_numbers_q_3' => $works_with_numbers_q_3,
            'works_with_numbers_q_4' => $works_with_numbers_q_4
       ),$where_report_id);
       
       $update_report_m_num = $wpdb->update($tbl_bds_report_measurement_number, array(             
            'describe_comp_q_1'=> $describe_comp_q_1,
            'describe_comp_q_2'=> $describe_comp_q_2,
            'describe_comp_q_3' => $describe_comp_q_3,
            'describe_comp_q_4' => $describe_comp_q_4,
            'sorts_classify_q_1'=> $sorts_classify_q_1,
            'sorts_classify_q_2'=> $sorts_classify_q_2,
            'sorts_classify_q_3' => $sorts_classify_q_3,
            'sorts_classify_q_4' => $sorts_classify_q_4
       ),$where_report_id);
       
       
       $update_report_geometry = $wpdb->update($tbl_bds_report_geometry, array(             
            'identifies_2d_q_1'=> $identifies_2d_q_1,
            'identifies_2d_q_1'=> $identifies_2d_q_1,
            'identifies_2d_q_1' => $identifies_2d_q_1,
            'identifies_2d_q_1' => $identifies_2d_q_1,
            'compares_2d_q_1'=> $compares_2d_q_1,
            'compares_2d_q_2'=> $compares_2d_q_1,
            'compares_2d_q_3' => $compares_2d_q_1,
            'compares_2d_q_4' => $compares_2d_q_1,
            'geometry_effort_q_1'=> $geometry_effort_q_1,
            'geometry_effort_q_2'=> $geometry_effort_q_2,
            'geometry_effort_q_3' => $geometry_effort_q_3,
            'geometry_effort_q_4' => $geometry_effort_q_4
       ),$where_report_id);
       
       $update_report_work_study_habit = $wpdb->update($tbl_bds_report_work_study_habit, array(             
            'arrives_on_time_q_1' => $arrives_on_time_q_1,
            'arrives_on_time_q_2' => $arrives_on_time_q_2,
            'arrives_on_time_q_3' => $arrives_on_time_q_3,
            'arrives_on_time_q_4' => $arrives_on_time_q_4,
            'follow_dire_q_1'=> $follow_dire_q_1,
            'follow_dire_q_2'=> $follow_dire_q_2,
            'follow_dire_q_3' => $follow_dire_q_3,
            'follow_dire_q_4' => $follow_dire_q_4,
            'adequate_attention_q_1'=> $adequate_attention_q_1,
            'adequate_attention_q_2'=> $adequate_attention_q_2,
            'adequate_attention_q_3' => $adequate_attention_q_3,
            'adequate_attention_q_4' => $adequate_attention_q_3,
            'school_tools_q_1'=> $school_tools_q_1,
            'school_tools_q_2'=> $school_tools_q_2,
            'school_tools_q_3' => $school_tools_q_3,
            'school_tools_q_4' => $school_tools_q_4,
            'completes_tasks_q_1'=> $completes_tasks_q_1,
            'completes_tasks_q_2'=> $completes_tasks_q_2,
            'completes_tasks_q_3' => $completes_tasks_q_3,
            'completes_tasks_q_4' => $completes_tasks_q_4,
            'acc_responsibility_q_1'=> $acc_responsibility_q_1,
            'acc_responsibility_q_2'=> $acc_responsibility_q_2,
            'acc_responsibility_q_3' => $acc_responsibility_q_3,
            'acc_responsibility_q_4' => $acc_responsibility_q_4,
            'quality_work_q_1'=> $quality_work_q_1,
            'quality_work_q_2'=> $quality_work_q_2,
            'quality_work_q_3' => $quality_work_q_3,
            'quality_work_q_4' => $quality_work_q_4,
            'complete_hw_q_1'=> $complete_hw_q_1,
            'complete_hw_q_2'=> $complete_hw_q_2,
            'complete_hw_q_3' => $complete_hw_q_3,
            'complete_hw_q_4' => $complete_hw_q_4,
            'wsh_efforts_q_1'=> $wsh_efforts_q_1,
            'wsh_efforts_q_2'=> $wsh_efforts_q_2,
            'wsh_efforts_q_3' => $wsh_efforts_q_3,
            'wsh_efforts_q_4' => $wsh_efforts_q_4
       ),$where_report_id);
       
       $update_report_life_skills = $wpdb->update($tbl_bds_report_life_skills, array(             
            'keeps_hands_q_1'=> $keeps_hands_q_1,
            'keeps_hands_q_2'=> $keeps_hands_q_2,
            'keeps_hands_q_3' => $keeps_hands_q_3,
            'keeps_hands_q_4' => $keeps_hands_q_4,
            'cooperates_in_group_q_1'=> $cooperates_in_group_q_1,
            'cooperates_in_group_q_2'=> $cooperates_in_group_q_2,
            'cooperates_in_group_q_3' => $cooperates_in_group_q_3,
            'cooperates_in_group_q_4' => $cooperates_in_group_q_4,
            'listens_without_q_1'=> $listens_without_q_1,
            'listens_without_q_2'=> $listens_without_q_2,
            'listens_without_q_3' => $listens_without_q_3,
            'listens_without_q_4' => $listens_without_q_4,
            'accepts_teachers_q_1'=> $accepts_teachers_q_1,
            'accepts_teachers_q_2'=> $accepts_teachers_q_2,
            'accepts_teachers_q_3' => $accepts_teachers_q_3,
            'accepts_teachers_q_4' => $accepts_teachers_q_4,
            'demonstrates_q_1'=> $demonstrates_q_1,
            'demonstrates_q_2'=> $demonstrates_q_2,
            'demonstrates_q_3' => $demonstrates_q_3,
            'demonstrates_q_4' => $demonstrates_q_4,
            'responsibility_q_1'=> $responsibility_q_1,
            'responsibility_q_2'=> $responsibility_q_2,
            'responsibility_q_3' => $responsibility_q_3,
            'responsibility_q_4' => $responsibility_q_4,
            'copes_q_1' => $copes_q_1,
            'copes_q_2' => $copes_q_2,
            'copes_q_3' => $copes_q_3,
            'copes_q_4' => $copes_q_4,
            'respects_rights_q_1' => $respects_rights_q_1,
            'respects_rights_q_2' => $respects_rights_q_2,
            'respects_rights_q_3' => $respects_rights_q_3,
            'respects_rights_q_4' => $respects_rights_q_4,
            'perseverance_q_1' => $perseverance_q_1,
            'perseverance_q_2' => $perseverance_q_2,
            'perseverance_q_3' => $perseverance_q_3,
            'perseverance_q_4' => $perseverance_q_4,
            'ls_efforts_q_1' => $ls_efforts_q_1,
            'ls_efforts_q_2' => $ls_efforts_q_2,
            'ls_efforts_q_3' => $ls_efforts_q_3,
            'ls_efforts_q_4' => $ls_efforts_q_4
       ),$where_report_id);
       
       $update_report_curri_studies = $wpdb->update($tbl_bds_report_curricular_studies, array(             
            'science_q_1'=> $science_q_1,
            'science_q_2'=> $science_q_2,
            'science_q_3' => $science_q_3,
            'science_q_4' => $science_q_4,
            'social_studies_q_1'=> $social_studies_q_1,
            'social_studies_q_2'=> $social_studies_q_2,
            'social_studies_q_3' => $social_studies_q_3,
            'social_studies_q_4' => $social_studies_q_4,
            'physical_edu_q_1' => $physical_edu_q_1,
            'physical_edu_q_2' => $physical_edu_q_2,
            'physical_edu_q_3' => $physical_edu_q_3,
            'physical_edu_q_4' => $physical_edu_q_4,
            'art_q_1' => $art_q_1,
            'art_q_2' => $art_q_2,
            'art_q_3' => $art_q_3,
            'art_q_4' => $art_q_4,
            'music_q_1' => $music_q_1,
            'music_q_2' => $music_q_2,
            'music_q_3' => $music_q_3,
            'music_q_4' => $music_q_4  
       ),$where_report_id);
       
       $update_report_attend = $wpdb->update($tbl_bds_report_attendence, array(             
            'days_tarday_q_1'=> $days_tarday_q_1,
            'days_tarday_q_2'=> $days_tarday_q_2,
            'days_tarday_q_3' => $days_tarday_q_3,
            'days_tarday_q_4' => $days_tarday_q_4,
            'days_absent_q_1'=> $days_absent_q_1,
            'days_absent_q_2'=> $days_absent_q_2,
            'days_absent_q_3' => $days_absent_q_3,
            'days_absent_q_4' => $days_absent_q_4,
            'tradies_q_1' => $tradies_q_1,
            'tradies_q_2' => $tradies_q_2,
            'tradies_q_3' => $tradies_q_3,
            'tradies_q_4' => $tradies_q_4,
            'grade_q_1' => $grade_q_1,
            'grade_q_2' => $grade_q_2,
            'grade_q_3' => $grade_q_3,
            'grade_q_4' => $grade_q_4 
       ),$where_report_id);
       
       if($update_report_attend === false){
           $error_message = '<h5 style="color:green;text-align: center;">Report update failed</h5>';
       }else{
           $error_message = '<h5 style="color:green;text-align: center;">Report updated successfully</h5>';
       }
       //echo "updated Id ".$report_id;
       
}   

if(isset($_GET['std_id']) && isset($_GET['edit_report']) == true ){
   $edit_student_id =  $_GET['std_id'];
   
//    $tbl_bds_report_counting_cardinality = $wpdb->prefix . 'bds_report_counting_cardinality';
    $get_report_query =  $wpdb->get_row("SELECT *, $tbl_report.id AS student_report_id FROM $tbl_report "
             ."INNER JOIN $tbl_bds_report_literature_info_text ON $tbl_bds_report_literature_info_text.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_foundational_skills ON $tbl_bds_report_foundational_skills.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_language_conventions ON $tbl_bds_report_language_conventions.report_id = $tbl_report.id "   
             ."INNER JOIN $tbl_bds_report_text_type_purpose ON $tbl_bds_report_text_type_purpose.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_prest_of_knowledge ON $tbl_bds_report_prest_of_knowledge.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_counting_cardinality ON $tbl_bds_report_counting_cardinality.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_operations ON $tbl_bds_report_operations.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_number_sense ON $tbl_bds_report_number_sense.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_measurement_number ON $tbl_bds_report_measurement_number.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_geometry ON $tbl_bds_report_geometry.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_work_study_habit ON $tbl_bds_report_work_study_habit.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_life_skills ON $tbl_bds_report_life_skills.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_curricular_studies ON $tbl_bds_report_curricular_studies.report_id = $tbl_report.id "
             ."INNER JOIN $tbl_bds_report_attendence ON $tbl_bds_report_attendence.report_id = $tbl_report.id "
             ."WHERE $tbl_report.student_id = '".$edit_student_id."' AND $tbl_report.teacher_id='".$_SESSION['teacher']."'");
   //$get_report_query->title;
    
   $student_report_id=$get_report_query->student_report_id; 
   
   $student_id = $_POST['student_id'];
   $teacher_signature= $get_report_query->teacher_signature;
   $report_session= $get_report_query->report_session;
   $class_name= $get_report_query->class_name;
   $qtr_comment_1 = $get_report_query->qtr_comment_1;
   $qtr_comment_2 = $get_report_query->qtr_comment_2;
   $qtr_comment_3 = $get_report_query->qtr_comment_3;
   $qtr_comment_4 = $get_report_query->qtr_comment_4;
   
   $retells_q_1 =$get_report_query->retells_q_1;
   $retells_q_2 =$get_report_query->retells_q_2;
   $retells_q_3 =$get_report_query->retells_q_3;
   $retells_q_4 =$get_report_query->retells_q_4;
   
   $common_type_q_1 = $get_report_query->common_type_q_1;
   $common_type_q_2 = $get_report_query->common_type_q_2;
   $common_type_q_3 = $get_report_query->common_type_q_3;
   $common_type_q_4 = $get_report_query->common_type_q_4;
   
   ////Foundational Skils
   $reads_emergent_q_1 = $get_report_query->reads_emergent_q_1;
   $reads_emergent_q_2 = $get_report_query->reads_emergent_q_2;
   $reads_emergent_q_3 = $get_report_query->reads_emergent_q_3;
   $reads_emergent_q_4 = $get_report_query->reads_emergent_q_4;
   
   $analysis_skills_q_1 = $get_report_query->analysis_skills_q_1;
   $analysis_skills_q_2 = $get_report_query->analysis_skills_q_2;
   $analysis_skills_q_3 = $get_report_query->analysis_skills_q_3;
   $analysis_skills_q_4 = $get_report_query->analysis_skills_q_4;

   $recognize_upper_q_1 = $get_report_query->recognize_upper_q_1;
   $recognize_upper_q_2 = $get_report_query->recognize_upper_q_2;
   $recognize_upper_q_3 = $get_report_query->recognize_upper_q_3;
   $recognize_upper_q_4 = $get_report_query->recognize_upper_q_4;

   $identifies_q_1 = $get_report_query->identifies_q_1;
   $identifies_q_2 = $get_report_query->identifies_q_2;
   $identifies_q_3 = $get_report_query->identifies_q_3;
   $identifies_q_4 = $get_report_query->identifies_q_4;

   $f_skills_effort_q_1 = $get_report_query->f_skills_effort_q_1;
   $f_skills_effort_q_2 = $get_report_query->f_skills_effort_q_2;
   $f_skills_effort_q_3 = $get_report_query->f_skills_effort_q_3;
   $f_skills_effort_q_4 = $get_report_query->f_skills_effort_q_4;
   
   ///////language_conventions
   
   $prints_upper_q_1 = $get_report_query->prints_upper_q_1;
   $prints_upper_q_2 = $get_report_query->prints_upper_q_2;
   $prints_upper_q_3 = $get_report_query->prints_upper_q_3;
   $prints_upper_q_4 = $get_report_query->prints_upper_q_4;

    $demo_convent_q_1 = $get_report_query->demo_convent_q_1;
    $demo_convent_q_2 = $get_report_query->demo_convent_q_2;
    $demo_convent_q_3 = $get_report_query->demo_convent_q_3;
    $demo_convent_q_4 = $get_report_query->demo_convent_q_4;

    $acquires_q_1 = $get_report_query->acquires_q_1;
    $acquires_q_2 = $get_report_query->acquires_q_2;
    $acquires_q_3 = $get_report_query->acquires_q_3;
    $acquires_q_4 = $get_report_query->acquires_q_4;
    
    ///type_purpose
    
    $utilizes_journal_q_1 = $get_report_query->utilizes_journal_q_1;
    $utilizes_journal_q_2 = $get_report_query->utilizes_journal_q_2;
    $utilizes_journal_q_3 = $get_report_query->utilizes_journal_q_3;
    $utilizes_journal_q_4 = $get_report_query->utilizes_journal_q_4;

    $strengthen_writing_q_1 = $get_report_query->strengthen_writing_q_1;
    $strengthen_writing_q_2 = $get_report_query->strengthen_writing_q_2;
    $strengthen_writing_q_3 = $get_report_query->strengthen_writing_q_3;
    $strengthen_writing_q_4 = $get_report_query->strengthen_writing_q_4;
    
    ////prest_of_knowledge
   
    $contributes_q_1 = $get_report_query->contributes_q_1;
    $contributes_q_2 = $get_report_query->contributes_q_2;
    $contributes_q_3 = $get_report_query->contributes_q_3;
    $contributes_q_4 = $get_report_query->contributes_q_4;

    $ask_answers_q_1 = $get_report_query->ask_answers_q_1;
    $ask_answers_q_2 = $get_report_query->ask_answers_q_2;
    $ask_answers_q_3 = $get_report_query->ask_answers_q_3;
    $ask_answers_q_4 = $get_report_query->ask_answers_q_4;

    $expresses_q_1 = $get_report_query->expresses_q_1;
    $expresses_q_2 = $get_report_query->expresses_q_2;
    $expresses_q_3 = $get_report_query->expresses_q_3;
    $expresses_q_4 = $get_report_query->expresses_q_4;

    $pk_effort_q_1 = $get_report_query->pk_effort_q_1;
    $pk_effort_q_2 = $get_report_query->pk_effort_q_2;
    $pk_effort_q_3 = $get_report_query->pk_effort_q_3;
    $pk_effort_q_4 = $get_report_query->pk_effort_q_4;
    
    //wp_dkf3k12nf1_bds_report_counting_cardinality

    $identifies_number_q_1 = $get_report_query->identifies_number_q_1;
    $identifies_number_q_2 = $get_report_query->identifies_number_q_2;
    $identifies_number_q_3 = $get_report_query->identifies_number_q_3;
    $identifies_number_q_4 = $get_report_query->identifies_number_q_4;

    $counts_tell_q_1 = $get_report_query->counts_tell_q_1;
    $counts_tell_q_2 = $get_report_query->counts_tell_q_2;
    $counts_tell_q_3 = $get_report_query->counts_tell_q_3;
    $counts_tell_q_4 = $get_report_query->counts_tell_q_4;

    $compares_sets_q_1 = $get_report_query->compares_sets_q_1;
    $compares_sets_q_2 = $get_report_query->compares_sets_q_2;
    $compares_sets_q_3 = $get_report_query->compares_sets_q_3;
    $compares_sets_q_4 = $get_report_query->compares_sets_q_4;

    //wp_dkf3k12nf1_bds_report_operations

    $joins_sets_q_1 = $get_report_query->joins_sets_q_1;
    $joins_sets_q_2 = $get_report_query->joins_sets_q_2;
    $joins_sets_q_3 = $get_report_query->joins_sets_q_3;
    $joins_sets_q_4 = $get_report_query->joins_sets_q_4;

    $seprate_set_q_1 = $get_report_query->seprate_set_q_1;
    $seprate_set_q_2 = $get_report_query->seprate_set_q_2;
    $seprate_set_q_3 = $get_report_query->seprate_set_q_3;
    $seprate_set_q_4 = $get_report_query->seprate_set_q_4;

    $fluently_adds_q_1 = $get_report_query->fluently_adds_q_1;
    $fluently_adds_q_2 = $get_report_query->fluently_adds_q_2;
    $fluently_adds_q_3 = $get_report_query->fluently_adds_q_3;
    $fluently_adds_q_4 = $get_report_query->fluently_adds_q_4;

    //wp_dkf3k12nf1_bds_report_number_sense

    $works_with_numbers_q_1 = $get_report_query->works_with_numbers_q_1;
    $works_with_numbers_q_2 = $get_report_query->works_with_numbers_q_2;
    $works_with_numbers_q_3 = $get_report_query->works_with_numbers_q_3;
    $works_with_numbers_q_4 = $get_report_query->works_with_numbers_q_4;

    //wp_dkf3k12nf1_bds_report_measurement_number

    $describe_comp_q_1 = $get_report_query->describe_comp_q_1;
    $describe_comp_q_2 = $get_report_query->describe_comp_q_2;
    $describe_comp_q_3 = $get_report_query->describe_comp_q_3;
    $describe_comp_q_4 = $get_report_query->describe_comp_q_4;

    $sorts_classify_q_1 = $get_report_query->sorts_classify_q_1;
    $sorts_classify_q_2 = $get_report_query->sorts_classify_q_2;
    $sorts_classify_q_3 = $get_report_query->sorts_classify_q_3;
    $sorts_classify_q_4 = $get_report_query->sorts_classify_q_4;

    //wp_dkf3k12nf1_bds_report_geometry

    $identifies_2d_q_1 = $get_report_query->identifies_2d_q_1;
    $identifies_2d_q_2 = $get_report_query->identifies_2d_q_2;
    $identifies_2d_q_3 = $get_report_query->identifies_2d_q_3;
    $identifies_2d_q_4 = $get_report_query->identifies_2d_q_4;

    $compares_2d_q_1 = $get_report_query->compares_2d_q_1;
    $compares_2d_q_2 = $get_report_query->compares_2d_q_2;
    $compares_2d_q_3 = $get_report_query->compares_2d_q_3;
    $compares_2d_q_4 = $get_report_query->compares_2d_q_4;

    $geometry_effort_q_1 = $get_report_query->geometry_effort_q_1;
    $geometry_effort_q_2 = $get_report_query->geometry_effort_q_2;
    $geometry_effort_q_3 = $get_report_query->geometry_effort_q_3;
    $geometry_effort_q_4 = $get_report_query->geometry_effort_q_4;

    //wp_dkf3k12nf1_bds_report_work_study_habit

    $arrives_on_time_q_1 = $get_report_query->arrives_on_time_q_1;
    $arrives_on_time_q_2 = $get_report_query->arrives_on_time_q_2;
    $arrives_on_time_q_3 = $get_report_query->arrives_on_time_q_3;
    $arrives_on_time_q_4 = $get_report_query->arrives_on_time_q_4;

    $follow_dire_q_1 = $get_report_query->follow_dire_q_1;
    $follow_dire_q_2 = $get_report_query->follow_dire_q_2;
    $follow_dire_q_3 = $get_report_query->follow_dire_q_3;
    $follow_dire_q_4 = $get_report_query->follow_dire_q_4;

    $adequate_attention_q_1 = $get_report_query->adequate_attention_q_1;
    $adequate_attention_q_2 = $get_report_query->adequate_attention_q_2;
    $adequate_attention_q_3 = $get_report_query->adequate_attention_q_3;
    $adequate_attention_q_4 = $get_report_query->adequate_attention_q_4;

    $school_tools_q_1 = $get_report_query->school_tools_q_1;
    $school_tools_q_2 = $get_report_query->school_tools_q_2;
    $school_tools_q_3 = $get_report_query->school_tools_q_3;
    $school_tools_q_4 = $get_report_query->school_tools_q_4;

    $completes_tasks_q_1 = $get_report_query->completes_tasks_q_1;
    $completes_tasks_q_2 = $get_report_query->completes_tasks_q_2;
    $completes_tasks_q_3 = $get_report_query->completes_tasks_q_3;
    $completes_tasks_q_4 = $get_report_query->completes_tasks_q_4;

    $acc_responsibility_q_1 = $get_report_query->acc_responsibility_q_1;
    $acc_responsibility_q_2 = $get_report_query->acc_responsibility_q_2;
    $acc_responsibility_q_3 = $get_report_query->acc_responsibility_q_3;
    $acc_responsibility_q_4 = $get_report_query->acc_responsibility_q_4;

    $quality_work_q_1 = $get_report_query->quality_work_q_1;
    $quality_work_q_2 = $get_report_query->quality_work_q_2;
    $quality_work_q_3 = $get_report_query->quality_work_q_3;
    $quality_work_q_4 = $get_report_query->quality_work_q_4;

    $complete_hw_q_1 = $get_report_query->complete_hw_q_1;
    $complete_hw_q_2 = $get_report_query->complete_hw_q_2;
    $complete_hw_q_3 = $get_report_query->complete_hw_q_3;
    $complete_hw_q_4 = $get_report_query->complete_hw_q_4;

    $wsh_efforts_q_1 = $get_report_query->wsh_efforts_q_1;
    $wsh_efforts_q_2 = $get_report_query->wsh_efforts_q_2;
    $wsh_efforts_q_3 = $get_report_query->wsh_efforts_q_3;
    $wsh_efforts_q_4 = $get_report_query->wsh_efforts_q_4;

    //wp_dkf3k12nf1_bds_report_life_skills

    $keeps_hands_q_1 = $get_report_query->keeps_hands_q_1;
    $keeps_hands_q_2 = $get_report_query->keeps_hands_q_2;
    $keeps_hands_q_3 = $get_report_query->keeps_hands_q_3;
    $keeps_hands_q_4 = $get_report_query->keeps_hands_q_4;

    $cooperates_in_group_q_1 = $get_report_query->cooperates_in_group_q_1;
    $cooperates_in_group_q_2 = $get_report_query->cooperates_in_group_q_2;
    $cooperates_in_group_q_3 = $get_report_query->cooperates_in_group_q_3;
    $cooperates_in_group_q_4 = $get_report_query->cooperates_in_group_q_4;

    $listens_without_q_1 = $get_report_query->listens_without_q_1;
    $listens_without_q_2 = $get_report_query->listens_without_q_2;
    $listens_without_q_3 = $get_report_query->listens_without_q_3;
    $listens_without_q_4 = $get_report_query->listens_without_q_4;

    $accepts_teachers_q_1 = $get_report_query->accepts_teachers_q_1;
    $accepts_teachers_q_2 = $get_report_query->accepts_teachers_q_2;
    $accepts_teachers_q_3 = $get_report_query->accepts_teachers_q_3;
    $accepts_teachers_q_4 = $get_report_query->accepts_teachers_q_4;

    $demonstrates_q_1 = $get_report_query->demonstrates_q_1;
    $demonstrates_q_2 = $get_report_query->demonstrates_q_2;
    $demonstrates_q_3 = $get_report_query->demonstrates_q_3;
    $demonstrates_q_4 = $get_report_query->demonstrates_q_4;

    $responsibility_q_1 = $get_report_query->responsibility_q_1;
    $responsibility_q_2 = $get_report_query->responsibility_q_2;
    $responsibility_q_3 = $get_report_query->responsibility_q_3;
    $responsibility_q_4 = $get_report_query->responsibility_q_4;

    $copes_q_1 = $get_report_query->copes_q_1;
    $copes_q_2 = $get_report_query->copes_q_2;
    $copes_q_3 = $get_report_query->copes_q_3;
    $copes_q_4 = $get_report_query->copes_q_4;

    $respects_rights_q_1 = $get_report_query->respects_rights_q_1;
    $respects_rights_q_2 = $get_report_query->respects_rights_q_2;
    $respects_rights_q_3 = $get_report_query->respects_rights_q_3;
    $respects_rights_q_4 = $get_report_query->respects_rights_q_4;

    $perseverance_q_1 = $get_report_query->perseverance_q_1;
    $perseverance_q_2 = $get_report_query->perseverance_q_2;
    $perseverance_q_3 = $get_report_query->perseverance_q_3;
    $perseverance_q_4 = $get_report_query->perseverance_q_4;

    $ls_efforts_q_1 = $get_report_query->ls_efforts_q_1;
    $ls_efforts_q_2 = $get_report_query->ls_efforts_q_2;
    $ls_efforts_q_3 = $get_report_query->ls_efforts_q_3;
    $ls_efforts_q_4 = $get_report_query->ls_efforts_q_4;

    //wp_dkf3k12nf1_bds_report_curricular_studies

    $science_q_1 = $get_report_query->science_q_1;
    $science_q_2 = $get_report_query->science_q_2;
    $science_q_3 = $get_report_query->science_q_3;
    $science_q_4 = $get_report_query->science_q_4;

    $social_studies_q_1 = $get_report_query->social_studies_q_1;
    $social_studies_q_2 = $get_report_query->social_studies_q_2;
    $social_studies_q_3 = $get_report_query->social_studies_q_3;
    $social_studies_q_4 = $get_report_query->social_studies_q_4;

    $physical_edu_q_1 = $get_report_query->physical_edu_q_1;
    $physical_edu_q_2 = $get_report_query->physical_edu_q_2;
    $physical_edu_q_3 = $get_report_query->physical_edu_q_3;
    $physical_edu_q_4 = $get_report_query->physical_edu_q_4;

    $art_q_1 = $get_report_query->art_q_1;
    $art_q_2 = $get_report_query->art_q_2;
    $art_q_3 = $get_report_query->art_q_3;
    $art_q_4 = $get_report_query->art_q_4;

    $music_q_1 = $get_report_query->music_q_1;
    $music_q_2 = $get_report_query->music_q_2;
    $music_q_3 = $get_report_query->music_q_3;
    $music_q_4 = $get_report_query->music_q_4;

    //wp_dkf3k12nf1_bds_report_attendence

    $days_tarday_q_1 = $get_report_query->days_tarday_q_1;
    $days_tarday_q_2 = $get_report_query->days_tarday_q_2;
    $days_tarday_q_3 = $get_report_query->days_tarday_q_3;
    $days_tarday_q_4 = $get_report_query->days_tarday_q_4;

    $days_absent_q_1 = $get_report_query->days_absent_q_1;
    $days_absent_q_2 = $get_report_query->days_absent_q_2;
    $days_absent_q_3 = $get_report_query->days_absent_q_3;
    $days_absent_q_4 = $get_report_query->days_absent_q_4;

    $tradies_q_1 = $get_report_query->tradies_q_1;
    $tradies_q_2 = $get_report_query->tradies_q_2;
    $tradies_q_3 = $get_report_query->tradies_q_3;
    $tradies_q_4 = $get_report_query->tradies_q_4;

    $grade_q_1 = $get_report_query->grade_q_1;
    $grade_q_2 = $get_report_query->grade_q_2;
    $grade_q_3 = $get_report_query->grade_q_3;
    $grade_q_4 = $get_report_query->grade_q_4;
    
}


?>
    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>

<style>
    .detail-tbl-data .form-control{
        text-align: center;
        border: none;
    }
</style>
<div class="mc-content-wrap">
    <div class="h_wrapper">
        <div class="bds-report-wrap">
            <form method="post">
                
                <div class="report-top-header">
                    
                    <?php echo $error_message; ?>
                    <div class="report-logo">
                                    
                    </div>
                    <h2 class="report-class-heading"><?php echo $class_name; ?></h2>
                    <h2 class="report-page-heading">Performance Based Reporting Card</h2>
                    <h2 class="session-heading"><?php echo $report_session; ?></h2>
                    <div class="form-group">
                        <div class="col-md-2">
                            Name:
                        </div>  
                        <div class="col-md-5">
                            <!--<input type="text" class="form-control report-student-name"  >-->
                            <input name="student_name" type="text" class="form-control report-student-name" value="<?= $get_student->full_name; ?>" disabled >
                            <?php
                                if(isset($_GET['std_id']) && isset($_GET['edit_report']) == true ){
                            ?>
                                 <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
                            <?php
                                }else{
                            ?>
                                 <input type="hidden" name="student_id" value="<?php echo $get_student_id;?>">
                            <?php
                                }
                            ?>
                        </div>
                        <div class="clear"></div> 
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            Teacher:
                        </div>  
                        <div class="col-md-5">
                            <input type="text" class="form-control report-teacher-name" value="<?php echo $_SESSION['teacher_name']; ?>" disabled>
                        </div>
                        <div class="clear"></div> 
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                           Session:
                        </div>  
                        <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $report_session ;?>" name="report_session">
                        </div>
                        <div class="clear"></div> 
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            Class:
                        </div>  
                        <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $class_name ;?>" name="class_name">
                        </div>
                        <div class="clear"></div> 
                    </div>
                    <div>
                        <table class="tbl-progress-standard">
                            <tr>
                                <th colspan="4" class="table-heading">
                                    Progress Toward Standard
                                </th>
                            </tr>
                            <tr>
                                <td class="left-prg-cell">1        =</td>
                                <td class="left-prg-cell">Getting Started</td>
                                <td class="right-prg-cell">X       =</td>
                                <td class="right-prg-cell">Not Evaluated</td>
                            </tr>
                            <tr>
                                <td class="left-prg-cell">2        =</td>
                                <td class="left-prg-cell">Making Progress</td>
                                <td class="right-prg-cell">W      =</td>
                                <td class="right-prg-cell">With Assistance</td>
                            </tr>
                            <tr>
                                <td class="left-prg-cell">3        =</td>
                                <td class="left-prg-cell">Meeting Standards</td>
                                <td class="right-prg-cell">&#10003;       =</td>
                                <td class="right-prg-cell">Needs Improvement</td>
                            </tr>
                            <tr>
                                <td class="left-prg-cell">4        =</td>
                                <td class="left-prg-cell">Exceeds Standards</td>
                                <td class="right-prg-cell">&nbsp; </td>
                                <td class="right-prg-cell"> &nbsp;</td>
                            </tr>
                        </table>

                    </div>
                    <div class="report-detail-wrap">
                        <table>
                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">ENGLISH LANGUAGE ARTS - READING</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Literature and Informational Texts</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Retells stories in sequence and identifies key details related to characters, setting, and major events</td>
                                <td class="text-center"><input type="text" name="retells_q_1" class="form-control grades-fields" value="<?php echo $retells_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="retells_q_2" class="form-control grades-fields" value="<?php echo $retells_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="retells_q_3" class="form-control grades-fields" value="<?php echo $retells_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="retells_q_4" class="form-control grades-fields" value="<?php echo $retells_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Recognize common types of texts: fiction, non-fiction, poetry, folktales</td>
                                <td class="text-center"><input type="text" name="common_type_q_1" class="form-control grades-fields" value="<?php echo $common_type_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="common_type_q_2" class="form-control grades-fields" value="<?php echo $common_type_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="common_type_q_3" class="form-control grades-fields" value="<?php echo $common_type_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="common_type_q_4" class="form-control grades-fields" value="<?php echo $common_type_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Foundational Skills</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Reads emergent reader texts with purpose and understanding</td>
                                <td class="text-center"><input type="text" name="reads_emergent_q_1" class="form-control grades-fields" value="<?php echo $reads_emergent_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="reads_emergent_q_2" class="form-control grades-fields" value="<?php echo $reads_emergent_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="reads_emergent_q_3" class="form-control grades-fields" value="<?php echo $reads_emergent_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="reads_emergent_q_4" class="form-control grades-fields" value="<?php echo $reads_emergent_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Knows and applies grade-level phonics and word analysis skills (decoding words / segments and blends)</td>
                                <td class="text-center"><input type="text" name="analysis_skills_q_1" class="form-control grades-fields" value="<?php echo $analysis_skills_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="analysis_skills_q_2" class="form-control grades-fields" value="<?php echo $analysis_skills_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="analysis_skills_q_3" class="form-control grades-fields" value="<?php echo $analysis_skills_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="analysis_skills_q_4" class="form-control grades-fields" value="<?php echo $analysis_skills_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Recognize upper and lower case letters</td>
                                <td class="text-center"><input type="text" name="recognize_upper_q_1" class="form-control grades-fields" value="<?php echo $recognize_upper_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="recognize_upper_q_2" class="form-control grades-fields" value="<?php echo $recognize_upper_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="recognize_upper_q_3" class="form-control grades-fields" value="<?php echo $recognize_upper_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="recognize_upper_q_4" class="form-control grades-fields" value="<?php echo $recognize_upper_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Identifies/Recognizes high frequency words as studied</td>
                                <td class="text-center"><input type="text" name="identifies_q_1" class="form-control grades-fields" value="<?php echo $identifies_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_q_2" class="form-control grades-fields" value="<?php echo $identifies_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_q_3" class="form-control grades-fields" value="<?php echo $identifies_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_q_4" class="form-control grades-fields" value="<?php echo $identifies_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Effort</td>
                                <td class="text-center"><input type="text" name="f_skills_effort_q_1" class="form-control grades-fields" value="<?php echo $f_skills_effort_q_1 ;?>" ></td>
                                <td class="text-center"><input type="text" name="f_skills_effort_q_2" class="form-control grades-fields" value="<?php echo $f_skills_effort_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="f_skills_effort_q_3" class="form-control grades-fields" value="<?php echo $f_skills_effort_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="f_skills_effort_q_4" class="form-control grades-fields" value="<?php echo $f_skills_effort_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">ENGLISH LANGUAGE ARTS - WRITING</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Language - Conventions</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Prints upper and lowercase letters</td>
                                <td class="text-center"><input type="text" name="prints_upper_q_1" class="form-control grades-fields" value="<?php echo $prints_upper_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="prints_upper_q_2" class="form-control grades-fields" value="<?php echo $prints_upper_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="prints_upper_q_3" class="form-control grades-fields" value="<?php echo $prints_upper_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="prints_upper_q_4" class="form-control grades-fields" value="<?php echo $prints_upper_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Demonstrates conventions: capitalization, punctuation, and spelling of high frequency words when writing</td>
                                <td class="text-center"><input type="text" name="demo_convent_q_1" class="form-control grades-fields" value="<?php echo $demo_convent_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="demo_convent_q_2" class="form-control grades-fields" value="<?php echo $demo_convent_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="demo_convent_q_3" class="form-control grades-fields" value="<?php echo $demo_convent_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="demo_convent_q_4" class="form-control grades-fields" value="<?php echo $demo_convent_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Acquires and utilizes grade-appropriate vocabulary</td>
                                <td class="text-center"><input type="text" name="acquires_q_1" class="form-control grades-fields" value="<?php echo $acquires_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="acquires_q_2" class="form-control grades-fields" value="<?php echo $acquires_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="acquires_q_3" class="form-control grades-fields" value="<?php echo $acquires_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="acquires_q_4" class="form-control grades-fields" value="<?php echo $acquires_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Text Types and Purposes</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Utilizes journal to demonstrate a combination of drawing, dictating, and writing to communicate ideas and information effectively</td>
                                <td class="text-center"><input type="text" name="utilizes_journal_q_1" class="form-control grades-fields" value="<?php echo $utilizes_journal_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="utilizes_journal_q_2" class="form-control grades-fields" value="<?php echo $utilizes_journal_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="utilizes_journal_q_3" class="form-control grades-fields" value="<?php echo $utilizes_journal_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="utilizes_journal_q_4" class="form-control grades-fields" value="<?php echo $utilizes_journal_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Add details to support and strengthen writing</td>
                                <td class="text-center"><input type="text" name="strengthen_writing_q_1" class="form-control grades-fields" value="<?php echo $strengthen_writing_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="strengthen_writing_q_2" class="form-control grades-fields" value="<?php echo $strengthen_writing_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="strengthen_writing_q_3" class="form-control grades-fields" value="<?php echo $strengthen_writing_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="strengthen_writing_q_4" class="form-control grades-fields" value="<?php echo $strengthen_writing_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Presentation of Knowledge</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Contributes and participates in shared writing and home projects</td>
                                <td class="text-center"><input type="text" name="contributes_q_1" class="form-control grades-fields" value="<?php echo $contributes_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="contributes_q_2" class="form-control grades-fields" value="<?php echo $contributes_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="contributes_q_3" class="form-control grades-fields" value="<?php echo $contributes_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="contributes_q_4" class="form-control grades-fields" value="<?php echo $contributes_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Asks and answers questions in order to seek help, get information, or clarify something that is not understood</td>
                                <td class="text-center"><input type="text" name="ask_answers_q_1" class="form-control grades-fields" value="<?php echo $ask_answers_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="ask_answers_q_2" class="form-control grades-fields" value="<?php echo $ask_answers_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="ask_answers_q_3" class="form-control grades-fields" value="<?php echo $ask_answers_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="ask_answers_q_4" class="form-control grades-fields" value="<?php echo $ask_answers_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Expresses thoughts, feelings, and ideas clearly</td>
                                <td class="text-center"><input type="text" name="expresses_q_1" class="form-control grades-fields" value="<?php echo $expresses_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="expresses_q_2" class="form-control grades-fields" value="<?php echo $expresses_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="expresses_q_3" class="form-control grades-fields" value="<?php echo $expresses_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="expresses_q_4" class="form-control grades-fields" value="<?php echo $expresses_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Effort</td>
                                <td class="text-center"><input type="text" name="pk_effort_q_1" class="form-control grades-fields" value="<?php echo $pk_effort_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="pk_effort_q_2" class="form-control grades-fields" value="<?php echo $pk_effort_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="pk_effort_q_3" class="form-control grades-fields" value="<?php echo $pk_effort_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="pk_effort_q_4" class="form-control grades-fields" value="<?php echo $pk_effort_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">MATHEMATICS</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Counting and Cardinality</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Identifies Numbers 0-20</td>
                                <td class="text-center"><input type="text" name="identifies_number_q_1" class="form-control grades-fields" value="<?php echo $identifies_number_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_number_q_2" class="form-control grades-fields" value="<?php echo $identifies_number_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_number_q_3" class="form-control grades-fields" value="<?php echo $identifies_number_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_number_q_4" class="form-control grades-fields" value="<?php echo $identifies_number_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Counts to tell the number of objects 0-20</td>
                                <td class="text-center"><input type="text" name="counts_tell_q_1" class="form-control grades-fields" value="<?php echo $counts_tell_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="counts_tell_q_2" class="form-control grades-fields" value="<?php echo $counts_tell_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="counts_tell_q_3" class="form-control grades-fields" value="<?php echo $counts_tell_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="counts_tell_q_4" class="form-control grades-fields" value="<?php echo $counts_tell_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Compares sets of 0-10 objects to tell more, less, or equal to</td>
                                <td class="text-center"><input type="text" name="compares_sets_q_1" class="form-control grades-fields" value="<?php echo $compares_sets_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_sets_q_2" class="form-control grades-fields" value="<?php echo $compares_sets_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_sets_q_3" class="form-control grades-fields" value="<?php echo $compares_sets_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_sets_q_4" class="form-control grades-fields" value="<?php echo $compares_sets_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Operations and Algebraic Thinking</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Joins sets to 10 (addition)</td>
                                <td class="text-center"><input type="text" name="joins_sets_q_1" class="form-control grades-fields" value="<?php echo $joins_sets_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="joins_sets_q_2" class="form-control grades-fields" value="<?php echo $joins_sets_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="joins_sets_q_3" class="form-control grades-fields" value="<?php echo $joins_sets_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="joins_sets_q_4" class="form-control grades-fields" value="<?php echo $joins_sets_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Separates sets to 10 (subtraction)</td> 
                                <td class="text-center"><input type="text" name="seprate_set_q_1" class="form-control grades-fields" value="<?php echo $seprate_set_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="seprate_set_q_2" class="form-control grades-fields" value="<?php echo $seprate_set_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="seprate_set_q_3" class="form-control grades-fields" value="<?php echo $seprate_set_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="seprate_set_q_4" class="form-control grades-fields" value="<?php echo $seprate_set_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Fluently adds and subtracts numbers to 10</td>
                                <td class="text-center"><input type="text" name="fluently_adds_q_1" class="form-control grades-fields" value="<?php echo $fluently_adds_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="fluently_adds_q_2" class="form-control grades-fields" value="<?php echo $fluently_adds_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="fluently_adds_q_3" class="form-control grades-fields" value="<?php echo $fluently_adds_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="fluently_adds_q_4" class="form-control grades-fields" value="<?php echo $fluently_adds_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Number Sense and Operations in Base Ten</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Works with numbers 11-19 to demonstrate place value (compose and decompose)</td>
                                <td class="text-center"><input type="text" name="works_with_numbers_q_1" class="form-control grades-fields" value="<?php echo $works_with_numbers_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="works_with_numbers_q_2" class="form-control grades-fields" value="<?php echo $works_with_numbers_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="works_with_numbers_q_3" class="form-control grades-fields" value="<?php echo $works_with_numbers_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="works_with_numbers_q_4" class="form-control grades-fields" value="<?php echo $works_with_numbers_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Measurement and Data</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Describes and compares measureable attributes</td>
                                <td class="text-center"><input type="text" name="describe_comp_q_1" class="form-control grades-fields" value="<?php echo $describe_comp_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="describe_comp_q_2" class="form-control grades-fields" value="<?php echo $describe_comp_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="describe_comp_q_3" class="form-control grades-fields" value="<?php echo $describe_comp_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="describe_comp_q_4" class="form-control grades-fields" value="<?php echo $describe_comp_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Sorts, classifies, and counts objects in a category</td>
                                <td class="text-center"><input type="text" name="sorts_classify_q_1" class="form-control grades-fields" value="<?php echo $sorts_classify_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="sorts_classify_q_2" class="form-control grades-fields" value="<?php echo $sorts_classify_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="sorts_classify_q_3" class="form-control grades-fields" value="<?php echo $sorts_classify_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="sorts_classify_q_4" class="form-control grades-fields" value="<?php echo $sorts_classify_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">Geometry</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Identifies and describes 2D plane or 3D solid shapes</td>
                                <td class="text-center"><input type="text" name="identifies_2d_q_1" class="form-control grades-fields" value="<?php echo $identifies_2d_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_2d_q_2" class="form-control grades-fields" value="<?php echo $identifies_2d_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_2d_q_3" class="form-control grades-fields" value="<?php echo $identifies_2d_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="identifies_2d_q_4" class="form-control grades-fields" value="<?php echo $identifies_2d_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Compares and creates 2D plane or 3D solid shapes</td>
                                <td class="text-center"><input type="text" name="compares_2d_q_1" class="form-control grades-fields" value="<?php echo $compares_2d_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_2d_q_2" class="form-control grades-fields" value="<?php echo $compares_2d_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_2d_q_3" class="form-control grades-fields" value="<?php echo $compares_2d_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="compares_2d_q_4" class="form-control grades-fields" value="<?php echo $compares_2d_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Effort</td>
                                <td class="text-center"><input type="text" name="geometry_effort_q_1" class="form-control grades-fields" value="<?php echo $geometry_effort_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="geometry_effort_q_2" class="form-control grades-fields" value="<?php echo $geometry_effort_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="geometry_effort_q_3" class="form-control grades-fields" value="<?php echo $geometry_effort_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="geometry_effort_q_4" class="form-control grades-fields" value="<?php echo $geometry_effort_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">WORK / STUDY HABITS</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>
                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">P = Needs Improvement   / = Acceptable Progress    * = Outstanding Achievement</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Arrives on time, alert, ready for work</td>
                                <td class="text-center"><input type="text" name="arrives_on_time_q_1" class="form-control grades-fields" value="<?php echo $arrives_on_time_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="arrives_on_time_q_2" class="form-control grades-fields" value="<?php echo $arrives_on_time_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="arrives_on_time_q_3" class="form-control grades-fields" value="<?php echo $arrives_on_time_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="arrives_on_time_q_4" class="form-control grades-fields" value="<?php echo $arrives_on_time_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Follows directions: verbal, written</td>
                                <td class="text-center"><input type="text" name="follow_dire_q_1" class="form-control grades-fields" value="<?php echo $follow_dire_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="follow_dire_q_2" class="form-control grades-fields" value="<?php echo $follow_dire_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="follow_dire_q_3" class="form-control grades-fields" value="<?php echo $follow_dire_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="follow_dire_q_4" class="form-control grades-fields" value="<?php echo $follow_dire_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Has an adequate attention span, uses time efficiently</td>
                                <td class="text-center"><input type="text" name="adequate_attention_q_1" class="form-control grades-fields" value="<?php echo $adequate_attention_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="adequate_attention_q_2" class="form-control grades-fields" value="<?php echo $adequate_attention_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="adequate_attention_q_3" class="form-control grades-fields" value="<?php echo $adequate_attention_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="adequate_attention_q_4" class="form-control grades-fields" value="<?php echo $adequate_attention_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Uses school tools and materials appropriately</td>
                                <td class="text-center"><input type="text" name="school_tools_q_1" class="form-control grades-fields" value="<?php echo $school_tools_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="school_tools_q_2" class="form-control grades-fields" value="<?php echo $school_tools_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="school_tools_q_3" class="form-control grades-fields" value="<?php echo $school_tools_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="school_tools_q_4" class="form-control grades-fields" value="<?php echo $school_tools_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Completes tasks satisfactory in a reasonable length of time.</td>
                                <td class="text-center"><input type="text" name="completes_tasks_q_1" class="form-control grades-fields" value="<?php echo $completes_tasks_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="completes_tasks_q_2" class="form-control grades-fields" value="<?php echo $completes_tasks_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="completes_tasks_q_3" class="form-control grades-fields" value="<?php echo $completes_tasks_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="completes_tasks_q_4" class="form-control grades-fields" value="<?php echo $completes_tasks_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Accepts responsibility: equipment, work area, clean up area</td>
                                <td class="text-center"><input type="text" name="acc_responsibility_q_1" class="form-control grades-fields" value="<?php echo $acc_responsibility_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="acc_responsibility_q_2" class="form-control grades-fields" value="<?php echo $acc_responsibility_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="acc_responsibility_q_3" class="form-control grades-fields" value="<?php echo $acc_responsibility_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="acc_responsibility_q_4" class="form-control grades-fields" value="<?php echo $acc_responsibility_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Strives to produce quality work</td>
                                <td class="text-center"><input type="text" name="quality_work_q_1" class="form-control grades-fields" value="<?php echo $quality_work_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="quality_work_q_2" class="form-control grades-fields" value="<?php echo $quality_work_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="quality_work_q_3" class="form-control grades-fields" value="<?php echo $quality_work_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="quality_work_q_4" class="form-control grades-fields" value="<?php echo $quality_work_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Completes homework as assigned</td>
                                <td class="text-center"><input type="text" name="complete_hw_q_1" class="form-control grades-fields" value="<?php echo $complete_hw_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="complete_hw_q_2" class="form-control grades-fields" value="<?php echo $complete_hw_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="complete_hw_q_3" class="form-control grades-fields" value="<?php echo $complete_hw_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="complete_hw_q_4" class="form-control grades-fields" value="<?php echo $complete_hw_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Effort</td>
                                <td class="text-center"><input type="text" name="wsh_efforts_q_1" class="form-control grades-fields" value="<?php echo $wsh_efforts_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="wsh_efforts_q_2" class="form-control grades-fields" value="<?php echo $wsh_efforts_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="wsh_efforts_q_3" class="form-control grades-fields" value="<?php echo $wsh_efforts_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="wsh_efforts_q_4" class="form-control grades-fields" value="<?php echo $wsh_efforts_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">LIFE SKILLS</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">P = Needs Improvement   / = Acceptable Progress    * = Outstanding Achievement</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Keeps hands and feet to self</td>
                                <td class="text-center"><input type="text" name="keeps_hands_q_1" class="form-control grades-fields" value="<?php echo $keeps_hands_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="keeps_hands_q_2" class="form-control grades-fields" value="<?php echo $keeps_hands_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="keeps_hands_q_3" class="form-control grades-fields" value="<?php echo $keeps_hands_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="keeps_hands_q_4" class="form-control grades-fields" value="<?php echo $keeps_hands_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Cooperates in group activities</td>
                                <td class="text-center"><input type="text" name="cooperates_in_group_q_1" class="form-control grades-fields" value="<?php echo $cooperates_in_group_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="cooperates_in_group_q_2" class="form-control grades-fields" value="<?php echo $cooperates_in_group_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="cooperates_in_group_q_3" class="form-control grades-fields" value="<?php echo $cooperates_in_group_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="cooperates_in_group_q_4" class="form-control grades-fields" value="<?php echo $cooperates_in_group_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Listens without interrupting: teacher, child</td>
                                <td class="text-center"><input type="text" name="listens_without_q_1" class="form-control grades-fields" value="<?php echo $listens_without_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="listens_without_q_2" class="form-control grades-fields" value="<?php echo $listens_without_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="listens_without_q_3" class="form-control grades-fields" value="<?php echo $listens_without_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="listens_without_q_4" class="form-control grades-fields" value="<?php echo $listens_without_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Accepts and respects directions from teachers</td>
                                <td class="text-center"><input type="text" name="accepts_teachers_q_1" class="form-control grades-fields" value="<?php echo $accepts_teachers_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="accepts_teachers_q_2" class="form-control grades-fields" value="<?php echo $accepts_teachers_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="accepts_teachers_q_3" class="form-control grades-fields" value="<?php echo $accepts_teachers_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="accepts_teachers_q_4" class="form-control grades-fields" value="<?php echo $accepts_teachers_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Demonstrates self-control</td>
                                <td class="text-center"><input type="text" name="demonstrates_q_1" class="form-control grades-fields" value="<?php echo $demonstrates_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="demonstrates_q_2" class="form-control grades-fields" value="<?php echo $demonstrates_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="demonstrates_q_3" class="form-control grades-fields" value="<?php echo $demonstrates_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="demonstrates_q_4" class="form-control grades-fields" value="<?php echo $demonstrates_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Accepts responsibility for own behavior</td>
                                <td class="text-center"><input type="text" name="responsibility_q_1" class="form-control grades-fields" value="<?php echo $responsibility_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="responsibility_q_2" class="form-control grades-fields" value="<?php echo $responsibility_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="responsibility_q_3" class="form-control grades-fields" value="<?php echo $responsibility_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="responsibility_q_4" class="form-control grades-fields" value="<?php echo $responsibility_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Copes with and learns from error and correction</td>
                                <td class="text-center"><input type="text" name="copes_q_1" class="form-control grades-fields" value="<?php echo $copes_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="copes_q_2" class="form-control grades-fields" value="<?php echo $copes_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="copes_q_3" class="form-control grades-fields" value="<?php echo $copes_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="copes_q_4" class="form-control grades-fields" value="<?php echo $copes_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Respects rights of self and others</td>
                                <td class="text-center"><input type="text" name="respects_rights_q_1" class="form-control grades-fields" value="<?php echo $respects_rights_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="respects_rights_q_2" class="form-control grades-fields" value="<?php echo $respects_rights_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="respects_rights_q_3" class="form-control grades-fields" value="<?php echo $respects_rights_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="respects_rights_q_4" class="form-control grades-fields" value="<?php echo $respects_rights_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Shows perseverance in the pursuit of goals</td>
                                <td class="text-center"><input type="text" name="perseverance_q_1" class="form-control grades-fields" value="<?php echo $perseverance_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="perseverance_q_2" class="form-control grades-fields" value="<?php echo $perseverance_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="perseverance_q_3" class="form-control grades-fields" value="<?php echo $perseverance_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="perseverance_q_4" class="form-control grades-fields" value="<?php echo $perseverance_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Effort</td>
                                <td class="text-center"><input type="text" name="ls_efforts_q_1" class="form-control grades-fields" value="<?php echo $ls_efforts_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="ls_efforts_q_2" class="form-control grades-fields" value="<?php echo $ls_efforts_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="ls_efforts_q_3" class="form-control grades-fields" value="<?php echo $ls_efforts_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="ls_efforts_q_4" class="form-control grades-fields" value="<?php echo $ls_efforts_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">CURRICULAR STUDIES</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">P = Needs Improvement   / = Acceptable Progress    * = Outstanding Achievement</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Science</td>
                                <td class="text-center"><input type="text" name="science_q_1" class="form-control grades-fields" value="<?php echo $science_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="science_q_2" class="form-control grades-fields" value="<?php echo $science_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="science_q_3" class="form-control grades-fields" value="<?php echo $science_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="science_q_4" class="form-control grades-fields" value="<?php echo $science_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Social Studies</td>
                                <td class="text-center"><input type="text" name="social_studies_q_1" class="form-control grades-fields" value="<?php echo $social_studies_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="social_studies_q_2" class="form-control grades-fields" value="<?php echo $social_studies_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="social_studies_q_3" class="form-control grades-fields" value="<?php echo $social_studies_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="social_studies_q_4" class="form-control grades-fields" value="<?php echo $social_studies_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Physical Education</td>
                                <td class="text-center"><input type="text" name="physical_edu_q_1" class="form-control grades-fields" value="<?php echo $physical_edu_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="physical_edu_q_2" class="form-control grades-fields" value="<?php echo $physical_edu_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="physical_edu_q_3" class="form-control grades-fields" value="<?php echo $physical_edu_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="physical_edu_q_4" class="form-control grades-fields" value="<?php echo $physical_edu_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Art</td>
                                <td class="text-center"><input type="text" name="art_q_1" class="form-control grades-fields" value="<?php echo $art_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="art_q_2" class="form-control grades-fields" value="<?php echo $art_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="art_q_3" class="form-control grades-fields" value="<?php echo $art_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="art_q_4" class="form-control grades-fields" value="<?php echo $art_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Music</td>
                                <td class="text-center"><input type="text" name="music_q_1" class="form-control grades-fields" value="<?php echo $music_q_1 ;?>" ></td>
                                <td class="text-center"><input type="text" name="music_q_2" class="form-control grades-fields" value="<?php echo $music_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="music_q_3" class="form-control grades-fields" value="<?php echo $music_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="music_q_4" class="form-control grades-fields" value="<?php echo $music_q_4 ;?>"></td>
                            </tr>

                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">ATTENDANCE</th>
                                <th colspan="4" class="text-center">QUARTER</th>
                            </tr>

                            <tr class="detail-tbl-subheading">
                                <th class="detail-col-1">&nbsp;</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>

                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Days Tardy</td>
                                <td class="text-center"><input type="text" name="days_tarday_q_1" class="form-control grades-fields" value="<?php echo $days_tarday_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_tarday_q_2" class="form-control grades-fields" value="<?php echo $days_tarday_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_tarday_q_3" class="form-control grades-fields" value="<?php echo $days_tarday_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_tarday_q_4" class="form-control grades-fields" value="<?php echo $days_tarday_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Days Absent</td>
                                <td class="text-center"><input type="text" name="days_absent_q_1" class="form-control grades-fields" value="<?php echo $days_absent_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_absent_q_2" class="form-control grades-fields" value="<?php echo $days_absent_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_absent_q_3" class="form-control grades-fields" value="<?php echo $days_absent_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="days_absent_q_4" class="form-control grades-fields" value="<?php echo $days_absent_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Tardies and/or Absences interfere with the learning process</td>
                                <td class="text-center"><input type="text" name="tradies_q_1" class="form-control grades-fields" value="<?php echo $tradies_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="tradies_q_2" class="form-control grades-fields" value="<?php echo $tradies_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="tradies_q_3" class="form-control grades-fields" value="<?php echo $tradies_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="tradies_q_4" class="form-control grades-fields" value="<?php echo $tradies_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Grade Recommended for Next Year:</td>
                                <td class="text-center"><input type="text" name="grade_q_1" class="form-control grades-fields" value="<?php echo $grade_q_1 ;?>"></td>
                                <td class="text-center"><input type="text" name="grade_q_2" class="form-control grades-fields" value="<?php echo $grade_q_2 ;?>"></td>
                                <td class="text-center"><input type="text" name="grade_q_3" class="form-control grades-fields" value="<?php echo $grade_q_3 ;?>"></td>
                                <td class="text-center"><input type="text" name="grade_q_4" class="form-control grades-fields" value="<?php echo $grade_q_4 ;?>"></td>
                            </tr>
                            <tr class="detail-tbl-data">
                                <td class="detail-col-1">Teacher's Signature:</td>
                                <td class="text-center"><input type="text" name="teacher_signature" class="form-control grades-fields"  value="<?php echo $teacher_signature ;?>"></td>
                                <td class="text-center">&nbsp;</td>
                                <td class="text-center">&nbsp;</td>
                                <td class="text-center">&nbsp;</td>
                            </tr>

                        </table>

                        <table>
                            <tr class="detail-tbl-heading">
                                <th colspan="1" class="detail-col-1">QUARTERLY COMMENTS</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="qtr_comment_1" class="form-control" placeholder="1"><?php echo $qtr_comment_1 ;?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="qtr_comment_2" class="form-control" placeholder="2"><?php echo $qtr_comment_2 ;?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="qtr_comment_3" class="form-control" placeholder="3"><?php echo $qtr_comment_3 ;?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="qtr_comment_4" class="form-control" placeholder="4"><?php echo $qtr_comment_4 ;?></textarea>
                                </td>
                            </tr>
                        </table>    

                    </div>

                </div>
                <?php
                    if(isset($_GET['std_id']) && isset($_GET['edit_report']) == true ){
                ?>
                    <input type="hidden" value="<?php echo $student_report_id; ?>" name="student_report_id"/>
                    <input type="submit" value="Edit Report" name="update_report_btn" />
                <?php
                    }else{
                ?>  
                    <input type="submit" value="Add Report" name="add_report_btn" />
                <?php        
                    }
                ?>
                
                
            </form>            
        </div>
    </div>
</div>
    

<?php }