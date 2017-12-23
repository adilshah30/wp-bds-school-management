<?php
require_once('../../../../../wp-config.php');
mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);


if(isset($_GET['id'])){
    global $wpdb; 
    $homework_table = $wpdb->prefix.'bds_homework';
    //$class_table = $wpdb->prefix.'terms';
    $homework_id = $_GET['id'];
    $subject_table = $wpdb->prefix.'bds_teacher_subjects';
    $homework_details = $wpdb->get_row("SELECT $homework_table.*, $subject_table.subject_name FROM $homework_table INNER JOIN $subject_table ON $homework_table.subject_id = $subject_table.id WHERE $homework_table.id = '".$homework_id."'" );
    
//exit;
    //$result= $wpdb->query($sql);       
?>
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #879e73; border-bottom: solid 1mm #9bbd7e; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #879e73; border-top: solid 1mm #9bbd7e; padding: 2mm}
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul.main { width: 95%; list-style-type: square; }
    ul.main li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
    h3 { text-align: center; font-size: 14mm}
    .homework-tbl table tr{
        margin-bottom:20px;
    }
    p{
        margin-bottom: 5px;
        margin-top: 5px;
        
    }
-->
</style>
<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 50%; text-align: left">
                    <img src="http://brookridgedayschool.com/wp-content/uploads/2014/07/BDS_horizontal_white_web1.png">
                </td>
                <td style="width: 50%; text-align: right">
                   
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    https://brookridgedayschool.com
                </td>
                <td style="width: 34%; text-align: center">
                    page [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 33%; text-align: right">
                    &copy;copyrights 2017-2018
                </td>
            </tr>
        </table>
    </page_footer>
<!--    <bookmark title="Présentation" level="0" ></bookmark>-->
    <br><br>
    <h1 style="font-size:24px;">Homework Detail</h1>
    <!--<h3>Day School</h3><br>-->
    <div style="text-align: center; width: 100%;">
        <br>
    </div>
    <div class="note homework-tbl">
        <table>
            <tr>
                <td width="30%"><b>Subject</b></td>
                <td style="padding-left:20px;"><?php echo $homework_details->subject_name ;?></td>
            </tr>
            <tr>
                <td width="30%"><b>Title</b></td>
                <td style="padding-left:20px;"><?php echo $homework_details->homework_title ;?></td>
            </tr>
            
            <tr>
                <td width="30%"><b>Date</b></td>
                <td style="padding-left:20px;"><?php echo $homework_details->date ;?></td>
            </tr>
            <tr>
                <td width="30%"><b>Homework</b></td>
                <td style="padding-left:20px;"><?php echo $homework_details->Description ;?></td>
            </tr>
            
        </table>
    </div>
</page>

<?php 
}else{
    echo "nothing to display";
}
?>