<div class="homework-content">                    
    <div class="homework-left">
        <div class="pd-10">
            <div class="homework-top-notepad">                            
            </div>
            <div class="homework-date">
                <h2><?php echo $title; ?> <?php echo $year ?></h2>
            </div>                            
            <div class="homework-month-days-listing-wrap" id="left_homework_scroll">
                <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
                    <?php
                        $curent_row_date = $year."-".$month."-".$i;
                        $current_day = date('D', strtotime($curent_row_date));
                    ?>
                    <?php
                        
                        $get_homework = $wpdb->get_results("SELECT $homework_table.*, $subject_table.subject_name FROM $homework_table INNER JOIN $subject_table ON $homework_table.subject_id = $subject_table.id WHERE $homework_table.date = '".$curent_row_date."'" );
                        //echo  "SELECT $homework_table.*, $subject_table.subject_name * FROM $homework_table INNER JOIN $subject_table ON $homework_table.subject_id = $subject_table.id WHERE $homework_table.session_id = '".$session_id."' && $homework_table.date = '".$curent_row_date."'" ;
                        //$get_homework = $wpdb->get_results("SELECT * FROM $homework_table WHERE session_id='".$session_id."' && date = '".$curent_row_date."'" );                                        
                        
//echo "all-day";exit;
                        ?>
                        <?php if($day == $i): ?>
                        <div class="homework-month-days-wrap" id="date-<?php echo $curent_row_date; ?>">  
                            <div class="homework-month-days-lsiting">
                                <div class="list-day-wrap">
                                    <div class="day">
                                       <?php echo $current_day; ?> 
                                    </div>
                                    <div class="date">
                                        <?php echo $title ?> <strong><?php echo $i ?></strong>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php

                                if($get_homework) {
                                    // Query was empty or a database error occurred

                                    foreach ($get_homework as $homework){
                                    ?>
                                    <div class="list-homework-day-content">
                                        <a href="javascript:void(0);" class="bd-homework-row" id="<?php echo $homework->id ?>" style="display:block;width: 100%;height: 100%;">
                                        <div class="home-work-title">
                                            <h4><?php echo $homework->subject_name; ?></h4>
                                            <p style="font-size:11px;"><?php echo $homework->homework_title; ?></p>
                                        </div>
                                        </a>
                                    </div>
                                    <?php } ?>

                                <?php
                                }else{
                                    // Query succeeded. $results could be an empty array here
                                     ?>
                                    <div class="list-homework-day-content">
                                        <a href="javascript:void(0);" class="nill_homework" style="display:block;width: 100%;height: 100%;">
                                        <div class="home-work-title">
                                            <h4>...</h4>
                                            <p>...</p>
                                        </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div> 
                        </div><!-- End Homework Wrap-->                                       
                        <?php else: ?>  
                        <?php ?>
                        <div class="homework-month-days-wrap" id="date-<?php echo $curent_row_date; ?>">  
                            <div class="homework-month-days-lsiting">
                                <div class="list-day-wrap">
                                    <div class="day">
                                       <?php echo $current_day; ?> 
                                    </div>
                                    <div class="date">
                                        <?php echo $title ?> <strong><?php echo $i ?></strong>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php

                                if($get_homework) {
                                    // Query was empty or a database error occurred

                                foreach ($get_homework as $homework){
                                    ?>
                                    <div class="list-homework-day-content" >
                                        <a href="javascript:void(0);" class="bd-homework-row" id="<?php echo $homework->id ?>" style="display:block;width: 100%;height: 100%;">
                                        <div class="home-work-title">
                                            <h4><?php echo $homework->subject_name; ?></h4>
                                            <p style="font-size:11px;"><?php echo $homework->homework_title; ?></p>
                                        </div>
                                        </a>
                                    </div>
                                    <?php } 
                                }else{
                                    // Query succeeded. $results could be an empty array here
                                     ?>

                                    <div class="list-homework-day-content">
                                        <a href="javascript:void(0);" class="nill_homework" style="display:block;width: 100%;height: 100%;">
                                            <div class="home-work-title">
                                                <h4>...</h4>
                                                <p>...</p>
                                            </div>
                                        </a>
                                    </div>
                               <?php }
                                ?>
                            </div> 
                        </div><!-- End Homework Wrap-->                                       
                        <?php endif; ?>
                        <?php if(($i + $blank) % 7 == 0): ?>
                            <div></div>
                        <?php endif; ?>

                <?php endfor; ?>                         
            </div>                            
        </div>  
    </div>
    <div class="homework-right">

        <div class="homework-detail" >
            <div class="loader">
                <div class="overlay"></div>
                <div class="wrap">
                    <div >
                        <img src="<?php echo plugins_url( '../../../images/loader-4.gif', __FILE__ ); ?>" style="width:100px;" ><br/> 
                     </div>

                     <div> Loading.....</div>
                </div>

            </div>
            <div class="detail-work-content" id="bds_homework_detail">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>                    
</div>