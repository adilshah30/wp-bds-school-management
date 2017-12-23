<?php
function bds_teacher_manage_homework(){
    /*adil edit session logout*/
    if(isset($_SESSION['teacher']) || isset($_SESSION['parent'] ) ){
            $user = true;
    }else{
            echo '<script>window.location="'.get_site_url().'/login";</script>';
            exit();
    } 
    global $wpdb;   
    $homework_table = $wpdb->prefix.'bds_homework';
    $class_table = $wpdb->prefix.'terms';
    $homeworks = $wpdb->get_results("SELECT * FROM $homework_table INNER JOIN $class_table ON $homework_table.class_id = $class_table.term_id WHERE $homework_table.teacher_id = '".$_SESSION['teacher']."'" );
    //print_r($homeworks);exit;
    
?>

    <div class="wrapper">
        <?php require_once TEACHER_PLUGIN_PATH . 'include/header.php'; ?>
    </div>
<div class="mc-content-wrap">
    <div class="h_wrapper">        
        <div class="bds-manage-homework">
            <div class="top-action">
                <div class="pull-left">
                    <h2 class="title">Manage</h2>
                </div>
                <div class="pull-right">
                    <a href="<?php echo site_url()."/bds-teacher-add-homework-2/"; ?>" class="btn btn-bds-action"><i class="fa fa-plus-circle"></i> &nbsp; Add Homework</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <table style="width:100%" class="bds-table-manage">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Title</th> 
                        <th>Subject</th>
                        <th>Date</th> 
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                </thead>
                
                <?php
                foreach($homeworks as $homework){                    
                ?>
                <tr class="homework-row-<?php echo $homework->id;?>">
                    <td><?php echo $homework->name; ?></td>
                    <td><?php echo $homework->homework_title; ?>Chapter one</td> 
                    <td><?php echo $homework->subject; ?></td>
                    <td><?php echo $homework->date; ?></td> 
                    <td><?php echo $homework->Description; ?></td>
                    <td class="action-bds-td">
                        <a style="margin-bottom:5px;" href='<?php echo site_url()."/bds-teacher-add-homework-2/?id=".$homework->id ;?>' class="btn btn-bds-action btn-block"><i class="fa fa-pencil"></i> &nbsp;Edit</a>
                        <a href="javascript:void(0);" class="btn btn-bds-action btn-block home-work-delete" id="<?php echo $homework->id;?>"><i class="fa fa-trash-o"></i> &nbsp;Delete</a>
                    </td>
                  </tr>
                <?php } ?>
             
              </table>
            
        </div>
    </div>
</div>
    

<?php }