<?php
function bds_student_report(){
   /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
   } 
   global $wpdb;  
   $student_id='';
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
    $qery_teacher_students ="SELECT * FROM $table_student WHERE `teacher_id` = '".$_SESSION['teacher']."' AND `status` = '1' ";
    $get_all_teacher_students = $wpdb->get_results( $qery_teacher_students );
    
    
    
   
   if(isset($_SESSION['teacher'])){
       $user_id = $_SESSION['teacher'];
   }
   if(isset($_SESSION['parent'])){
       $user_id = $_SESSION['parent'];
   }
   if(isset($_SESSION['student'])){
       $user_id = $_SESSION['student'];
   }

if(isset($_POST['std_id'])){
   $student_id = $_POST['std_id'];
   $teacher_id = $_POST['teacher_id'];
   //Student name
    //$tbl_bds_report_counting_cardinality = $wpdb->prefix . 'bds_report_counting_cardinality';
    $get_report_query =  $wpdb->get_row("SELECT *, $tbl_report.id AS student_report_id, $table_teacher.full_name As teacher_full_name ,$table_student.full_name As std_full_name FROM $tbl_report "
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
             ."INNER JOIN $table_student ON $table_student.id = $student_id "
             ."INNER JOIN $table_teacher ON $table_teacher.id = $teacher_id "
             ."WHERE $tbl_report.student_id = '".$student_id."' AND $tbl_report.teacher_id='".$teacher_id."'");
   //$get_report_query->title;
    
   $student_report_id=$get_report_query->student_report_id; 
   
   $student_id = $_POST['student_id'];
   $student_name = $get_report_query->std_full_name;
   $teacher_full_name = $get_report_query->teacher_full_name;
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
    <div class="mc-content-wrap">
        <div class="h_wrapper">
            <div class="bds-report-wrap">
                <?php $std_id=$_POST['std_id']; ?>
                <a href="<?php echo 'https://brookridgedayschool.com/wp-content/plugins/teacher/pdf/src/student_report_card.php?std_id='.$std_id.'&&teacher_id='.$teacher_id ; ?>" target="_blank" class="btn" style="background: #879e73;    background: #879e73;
                color: #fff;
                border-radius: 5px;
                box-shadow: none;float:right;">Generate Pdf</a>
        <div class="clearfix"></div>
                <form method="post">

                    <div class="report-top-header">
                        <div class="report-logo">

                        </div>
                        <h2 class="report-class-heading"><?php echo $report_session; ?></h2>
                        <h2 class="report-page-heading">Performance Based Reporting Card</h2>
                        <h2 class="session-heading"><?php echo $class_name; ?></h2>
                        <div class="form-group">
                            <div class="col-md-2">
                                Name:
                            </div>  
                            <div class="col-md-5">
                                <label><?php echo $student_name; ?></label>
                            </div>
                            <div class="clear"></div> 
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                Teacher:
                            </div>  
                            <div class="col-md-5">
                                <label><?php echo $teacher_full_name; ?></label>
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
                                    <td class="text-center"><label><?php echo $retells_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $retells_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $retells_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $retells_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Recognize common types of texts: fiction, non-fiction, poetry, folktales</td>
                                    <td class="text-center"><label><?php echo $common_type_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $common_type_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $common_type_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $common_type_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $reads_emergent_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $reads_emergent_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $reads_emergent_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $reads_emergent_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Knows and applies grade-level phonics and word analysis skills (decoding words / segments and blends)</td>
                                    <td class="text-center"><label><?php echo $analysis_skills_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $analysis_skills_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $analysis_skills_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $analysis_skills_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Recognize upper and lower case letters</td>
                                    <td class="text-center"><label><?php echo $recognize_upper_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $recognize_upper_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $recognize_upper_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $recognize_upper_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Identifies/Recognizes high frequency words as studied</td>
                                    <td class="text-center"><label><?php echo $identifies_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Effort</td>
                                    <td class="text-center"><label><?php echo $f_skills_effort_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $f_skills_effort_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $f_skills_effort_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $f_skills_effort_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $prints_upper_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $prints_upper_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $prints_upper_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $prints_upper_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Demonstrates conventions: capitalization, punctuation, and spelling of high frequency words when writing</td>
                                    <td class="text-center"><label><?php echo $demo_convent_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $demo_convent_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $demo_convent_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $demo_convent_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Acquires and utilizes grade-appropriate vocabulary</td>
                                    <td class="text-center"><label><?php echo $acquires_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $acquires_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $acquires_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $acquires_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $utilizes_journal_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $utilizes_journal_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $utilizes_journal_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $utilizes_journal_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Add details to support and strengthen writing</td>
                                    <td class="text-center"><label><?php echo $strengthen_writing_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $strengthen_writing_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $strengthen_writing_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $strengthen_writing_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $contributes_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $contributes_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $contributes_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $contributes_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Asks and answers questions in order to seek help, get information, or clarify something that is not understood</td>
                                    <td class="text-center"><label><?php echo $ask_answers_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $ask_answers_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $ask_answers_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $ask_answers_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Expresses thoughts, feelings, and ideas clearly</td>
                                    <td class="text-center"><label><?php echo $expresses_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $expresses_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $expresses_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $expresses_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Effort</td>
                                    <td class="text-center"><label><?php echo $pk_effort_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $pk_effort_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $pk_effort_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $pk_effort_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $identifies_number_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_number_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_number_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $identifies_number_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Counts to tell the number of objects 0-20</td>
                                    <td class="text-center"><label><?php echo $counts_tell_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $counts_tell_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $counts_tell_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $counts_tell_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Compares sets of 0-10 objects to tell more, less, or equal to</td>
                                    <td class="text-center"><label><?php echo $compares_sets_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $compares_sets_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $compares_sets_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $compares_sets_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $joins_sets_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $joins_sets_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $joins_sets_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $joins_sets_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Separates sets to 10 (subtraction)</td> 
                                    <td class="text-center"><label><?php echo $seprate_set_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $seprate_set_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $seprate_set_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $seprate_set_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Fluently adds and subtracts numbers to 10</td>
                                    <td class="text-center"><label><?php echo $fluently_adds_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $fluently_adds_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $fluently_adds_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $fluently_adds_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $works_with_numbers_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $works_with_numbers_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $works_with_numbers_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $works_with_numbers_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $describe_comp_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $describe_comp_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $describe_comp_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $describe_comp_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Sorts, classifies, and counts objects in a category</td>
                                    <td class="text-center"><label><?php echo $sorts_classify_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $sorts_classify_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $sorts_classify_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $sorts_classify_q_4 ;?></label></td>
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
                                    <td class="text-center"> <label><?php echo $identifies_2d_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $identifies_2d_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $identifies_2d_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $identifies_2d_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Compares and creates 2D plane or 3D solid shapes</td>
                                    <td class="text-center"><label><?php echo $compares_2d_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $compares_2d_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $compares_2d_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $compares_2d_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Effort</td>
                                    <td class="text-center"><label><?php echo $geometry_effort_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $geometry_effort_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $geometry_effort_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $geometry_effort_q_4 ;?> </label></td>
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
                                    <td class="text-center"><label><?php echo $arrives_on_time_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $arrives_on_time_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $arrives_on_time_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $arrives_on_time_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Follows directions: verbal, written</td>
                                    <td class="text-center"><label><?php echo $follow_dire_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $follow_dire_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $follow_dire_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $follow_dire_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Has an adequate attention span, uses time efficiently</td>
                                    <td class="text-center"><label><?php echo $adequate_attention_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $adequate_attention_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $adequate_attention_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $adequate_attention_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Uses school tools and materials appropriately</td>
                                    <td class="text-center"><label><?php echo $school_tools_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $school_tools_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $school_tools_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $school_tools_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Completes tasks satisfactory in a reasonable length of time.</td>
                                    <td class="text-center"><label><?php echo $completes_tasks_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $completes_tasks_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $completes_tasks_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $completes_tasks_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Accepts responsibility: equipment, work area, clean up area</td>
                                    <td class="text-center"><label> <?php echo $acc_responsibility_q_1 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $acc_responsibility_q_2 ;?></label></td>
                                    <td class="text-center"><label><?php echo $acc_responsibility_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $acc_responsibility_q_4 ;?></label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Strives to produce quality work</td>
                                    <td class="text-center"><label><?php echo $quality_work_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $quality_work_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $quality_work_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $quality_work_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Completes homework as assigned</td>
                                    <td class="text-center"><label><?php echo $complete_hw_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $complete_hw_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $complete_hw_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $complete_hw_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Effort</td>
                                    <td class="text-center"><label><?php echo $wsh_efforts_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $wsh_efforts_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $wsh_efforts_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $wsh_efforts_q_4 ;?> </label></td>
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
                                    <td class="text-center"><label><?php echo $keeps_hands_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $keeps_hands_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $keeps_hands_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $keeps_hands_q_4 ;?> </label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Cooperates in group activities</td>
                                    <td class="text-center"><label><?php echo $cooperates_in_group_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $cooperates_in_group_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $cooperates_in_group_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $cooperates_in_group_q_4 ;?> </label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Listens without interrupting: teacher, child</td>
                                    <td class="text-center"><label> <?php echo $listens_without_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $listens_without_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $listens_without_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $listens_without_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Accepts and respects directions from teachers</td>
                                    <td class="text-center"><label><?php echo $accepts_teachers_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $accepts_teachers_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $accepts_teachers_q_3 ;?></label></td>
                                    <td class="text-center"><label><?php echo $accepts_teachers_q_4 ;?> </label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Demonstrates self-control</td>
                                    <td class="text-center"><label><?php echo $demonstrates_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $demonstrates_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $demonstrates_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $demonstrates_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Accepts responsibility for own behavior</td>
                                    <td class="text-center"><label> <?php echo $responsibility_q_1 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $responsibility_q_2 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $responsibility_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $responsibility_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Copes with and learns from error and correction</td>
                                    <td class="text-center"><label> <?php echo $copes_q_1 ;?></label></td>
                                    <td class="text-center"><label><?php echo $copes_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $copes_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $copes_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Respects rights of self and others</td>
                                    <td class="text-center"><label> <?php echo $respects_rights_q_1 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $respects_rights_q_2 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $respects_rights_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $respects_rights_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Shows perseverance in the pursuit of goals</td>
                                    <td class="text-center"><label><?php echo $perseverance_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $perseverance_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $perseverance_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $perseverance_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Effort</td>
                                    <td class="text-center"><label> <?php echo $ls_efforts_q_1 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $ls_efforts_q_2 ;?></label</td>
                                    <td class="text-center"><label><?php echo $ls_efforts_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $ls_efforts_q_4 ;?></label></td>
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
                                    <td class="text-center"><label><?php echo $science_q_1 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $science_q_2 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $science_q_3 ;?> </label></td>
                                    <td class="text-center"><label><?php echo $science_q_4 ;?> </label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Social Studies</td>
                                    <td class="text-center"><label> <?php echo $social_studies_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $social_studies_q_2 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $social_studies_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $social_studies_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Physical Education</td>
                                    <td class="text-center"><label> <?php echo $physical_edu_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $physical_edu_q_2 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $physical_edu_q_3 ;?></label></td>
                                    <td class="text-center"><label> <?php echo $physical_edu_q_4 ;?></label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Art</td>
                                    <td class="text-center"><label> <?php echo $art_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $art_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $art_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $art_q_4 ;?> </label></td>
                                </tr>

                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Music</td>
                                    <td class="text-center"><label> <?php echo $music_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $music_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $music_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $music_q_4 ;?> </label></td>
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
                                    <td class="text-center"><label> <?php echo $days_tarday_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_tarday_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_tarday_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_tarday_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Days Absent</td>
                                    <td class="text-center"><label> <?php echo $days_absent_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_absent_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_absent_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $days_absent_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Tardies and/or Absences interfere with the learning process</td>
                                    <td class="text-center"><label> <?php echo $tradies_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $tradies_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $tradies_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $tradies_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Grade Recommended for Next Year:</td>
                                    <td class="text-center"><label> <?php echo $grade_q_1 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $grade_q_2 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $grade_q_3 ;?> </label></td>
                                    <td class="text-center"><label> <?php echo $grade_q_4 ;?> </label></td>
                                </tr>
                                <tr class="detail-tbl-data">
                                    <td class="detail-col-1">Teacher's Signature:</td>
                                    <td class="text-center"><label> <?php echo $teacher_signature ;?> </label></td>
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
                                      <label>  <?php echo $qtr_comment_1 ;?></label> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <label> <?php echo $qtr_comment_2 ;?></label> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <label> <?php echo $qtr_comment_3 ;?></label> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      <label> <?php echo $qtr_comment_4 ;?> </label>
                                    </td>
                                </tr>
                            </table>    

                        </div>

                    </div>

                </form>            
            </div>
        </div>
    </div>
    

<?php }