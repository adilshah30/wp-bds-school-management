var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;

//var site_url = "http://5de.147.myftpupload.com";
var site_url = "http://localhost/bds";

jQuery(document).ready(function(){

function first_homework_detail(){
    var requested_date=  jQuery('#requested_date').html();
    var split_date = requested_date.split("-");
    var year = split_date[0];
    var month = split_date[1];
    var day = split_date[2].replace(/^0+/, '');
    var full_date = year+"-"+month+"-"+day;
    
    
    var homework_detail_id = jQuery('#date-'+full_date+' a').attr('id');
    //alert(homework_detail_id);
    //(this).Addclass('')
    jQuery('#date-'+full_date+ ' #'+homework_detail_id ).addClass('active');
    var content = '';
    if(homework_detail_id){
       jQuery(this).addClass('active'); 
       //alert("yes fine") ;
            jQuery('.loader').show();
            jQuery.ajax({
             url: myAjax.ajaxurl,
             type: 'POST',
             data: {'id': homework_detail_id, action: 'ajax_bds_teacher_home_work_detail'},
             dataType : "json",
             success: function (data) {
                 //alert(data);
                 console.log(data);
                 //var json = jQuery.parseJSON(data);
                 if (data.id != ""){
                     //alert(data.id);
                     var original_date = data.date.split("-");
                    var date_year = original_date[0];
                    var date_month = original_date[1];
                    var date_day= original_date[2];

                     var date_homework= date_month+"/"+date_day+ "/"+date_year;
                     
                     var strLink = site_url+"/bds-teacher-add-homework-2/?id="+data.id;
                     var delete_link = site_url+"/bds-homework/?del_id="+data.id;
                     var pdf_link = site_url+"/wp-content/plugins/teacher/pdf/src/bds_homework_pdf.php?id="+data.id;
                     content ='<a href="'+pdf_link+'" class="btn-homework-pdf" target="_blank"></a>\n\
                                <div class="subject-title">\n\
                                     <h2>'+data.subject_name+'</h2>\n\
                                 </div>\n\
                                 <div class="event-date">\n\
                                    <div class="pull-left">\n\
                                     <i class="fa fa-calendar"></i> \n\ &nbsp;&nbsp;&nbsp;'+date_homework+' <br/><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;&nbsp;Title: '+data.homework_title+'\n\
                                    </div>\n\
                                    <div class="pull-right">\n\
                                      <a href="'+strLink+'" class="btn btn-bds-action bds-content-edit"><i class="fa fa-pencil"></i>Edit Homework</a>\n\
\n\                                   <a href="'+delete_link+'" class="btn btn-bds-action bds-content-delete"><i class="fa fa-trash"></i>Delete</a>\n\
                                    </div>\n\
                                    <div class="clearfix"></div>\n\
                                 </div>\n\
                                 <div class="homework-detail-content">\n\
                                 '+data.Description+'\n\
                                 </div>';
                     jQuery('#bds_homework_detail').html(content);
                     jQuery('.loader').hide();
                     jQuery('.homework-detail-content').slimscroll({
                        size: '5px',
                        height: '355px',
                        alwaysVisible: true,
                        color:'#000',
                        railOpacity: 0.8
                      });
                 }

             },
             error: function (errorThrown) {
                 alert(errorThrown);
             }
         });
    }else{
        //alert("No fine") ;
        
        content ='<div class="subject-title">\n\
                        <h2>No homework to display on this date</h2>\n\
                    </div>';
        jQuery('#bds_homework_detail').html(content);
    }
}
if(jQuery("#requested_date").length ){
    first_homework_detail();
}

jQuery('.nill_homework').click(function(){
    jQuery('.loader').show();
    var content = '';
    content ='<div class="subject-title">\n\
                    <h2>No homework to display on this date</h2>\n\
                </div>';
    jQuery('#bds_homework_detail').html(content);
    jQuery('.loader').hide();
    
});

jQuery('.bd-homework-row').click(function(){
    jQuery('.bd-homework-row').removeClass('active'); 
    jQuery(this).addClass('active'); 
    var homework_id = jQuery(this).attr('id');
    //alert(homework_id);
    var content = '';
    jQuery('.loader').show();
    jQuery.ajax({
        url: myAjax.ajaxurl,
        type: 'POST',
        data: {'id': homework_id, action: 'ajax_bds_teacher_home_work_detail'},
        dataType : "json",
        success: function (data) {
                            //alert(data);
            //console.log("url"+da);
            //var json = jQuery.parseJSON(data);
            
            if (data.id != ""){
                //alert(data.id);
                var original_date = data.date.split("-");
                var date_year = original_date[0];
                var date_month = original_date[1];
                var date_day= original_date[2];

                var date_homework = date_month+"/"+date_day+"/"+date_year;
                     
                var strLink = site_url+"/bds-teacher-add-homework-2/?id="+data.id;
                var delete_link = site_url+"/bds-homework/?del_id="+data.id;
                var pdf_link = site_url+"/wp-content/plugins/teacher/pdf/src/bds_homework_pdf.php?id="+data.id;
                content ='<a href="'+pdf_link+'" class="btn-homework-pdf" target="_blank"></a>\n\
                            <div class="subject-title">\n\
                                <h2>'+data.subject_name+'</h2>\n\
                            </div>\n\
                            <div class="event-date">\n\
                                <div class="pull-left">\n\
                                    <i class="fa fa-calendar"></i> \n\ &nbsp;&nbsp;&nbsp;'+date_homework+' <br/><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;&nbsp;Title: '+data.homework_title+'\n\
                                </div>\n\
                                <div class="pull-right">\n\
                                    <a href="'+strLink+'" class="btn btn-bds-action bds-content-edit"><i class="fa fa-pencil"></i>Edit Homework</a>\n\
                                    <a href="'+delete_link+'" class="btn btn-bds-action bds-content-delete"><i class="fa fa-trash"></i>Delete</a>\n\
                                </div>\n\
                                <div class="clearfix"></div>\n\
                            </div>\n\
                            <div class="homework-detail-content">\n\
                            '+data.Description+'\n\
                            </div>';
                jQuery('#bds_homework_detail').html(content);
                jQuery('.loader').hide();
                //Initialize Scroller
                jQuery('.homework-detail-content').slimscroll({
                        size: '5px',
                        height: '355px',
                        alwaysVisible: true,
                        color:'#000',
                        railOpacity: 0.8
                      });
                
            }
            
        },
        error: function (errorThrown) {
            alert(errorThrown);
        }
    });
    
    //alert(homework_id);
});

/*delete button homework*/
jQuery('.home-work-delete').click(function(){
    var r = confirm("Sure to delete?");
    if (r == true) {

        jQuery(ele).closest('li').hide();
        
        var id = jQuery(this).attr('id');
    //alert(id);
    
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_teacher_delete_home_work'},

            success: function (data) {
                                //alert(data);
                             console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Record Deleted Successfully!', 'success');
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });   
    } 
});

/*bds Add feaures newsletter */
jQuery('.featured_newsletter').each(function(){
    jQuery(this).click(function(){
        var id = (this.checked ? jQuery(this).attr("id") : "s")
        //alert(sThisVal);
        var news_teacher_id = jQuery('.news_teacher_id').val();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id,'teacher_id':news_teacher_id, action: 'ajax_bds_feature_newsletter'},

            success: function (data) {
                                //alert(data);
                             console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Record updated Successfully!', 'success');
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});

/*Bds Delete newsletter*/
jQuery('.btn_delete_newsletter').each(function(){
    jQuery(this).click(function(){
        var id = jQuery(this).attr("id");
        jQuery(this).closest('li').hide();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_delete_newsletter'},

            success: function (data) {
                                //alert(data);
                             console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Newsletter Deleted Successfully!', 'success');
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});

/*Bds Delete Newsletter category*/
jQuery('.btn_delete_newsletter_cat').each(function(){
    jQuery(this).click(function(){
        var id = jQuery(this).attr("id");
        alert(id);
        //jQuery(this).closest('li').hide();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_delete_newsletter_cat'},

            success: function (data) {
                //alert(data);
                console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Category Deleted Successfully!', 'success');
                    var strLink = site_url+"/bds-newsletter-category/";
                    window.location.href= strLink;
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});

/*bds Delete Download category*/
jQuery('.btn_delete_download_cat').each(function(){
    jQuery(this).click(function(){
        var id = jQuery(this).attr("id");
        alert(id);
        //jQuery(this).closest('li').hide();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_delete_download_cat'},

            success: function (data) {
                //alert(data);
                console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Category Deleted Successfully!', 'success');
                    var strLink = site_url+"/bds-newsletter-category/";
                    window.location.href= strLink;
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});

/*Bds Delete Newsletter category*/
jQuery('.btn_delete_gallery_cat').each(function(){
    jQuery(this).click(function(){
        var id = jQuery(this).attr("id");
        alert(id);
        //jQuery(this).closest('li').hide();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_delete_gallery_cat'},

            success: function (data) {
                //alert(data);
                console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Category Deleted Successfully!', 'success');
                    var strLink = site_url+"/bds-gallery-category/";
                    window.location.href= strLink;
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});



/*bds Add to cart*/



jQuery('#btn_add_to_cart').click(function(e){
    e.preventDefault()
    var required = "Required!";
    var customer_id = jQuery('#customer_id');
    //alert(bds_teacher_id);
    var product_id = jQuery('#product_id');
    
    
   
    
    if(product_id.val() != "" || customer_id.val() != "" )
    {
        //alert(bds_description.val());
        //alert("dsdsd");
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_add_to_cart');        
        fd.append('customer_id', customer_id.val());
        fd.append('product_id', product_id.val());

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Product Added Successfully', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    //var strLink = site_url+"/bds-add-teacher-subject/";
                    //window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});

/*End Bds Add to Cart*/

/*Bds Delete newsletter*/
jQuery('.btn_delete_subject').each(function(){
    jQuery(this).click(function(){
        var id = jQuery(this).attr("id");
        alert(id);
        jQuery(this).closest('tr').hide();
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_bds_delete_subject'},

            success: function (data) {
                                //alert(data);
                console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
                    //jQuery('.homework-row-' + id).hide();
                    swal('Success!', 'Subject Deleted Successfully!', 'success');
                }
                if(json.data == 0){
                    swal('Error!', 'Process failed!', 'error');
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
        
    });
});

/*bds Add Subject*/
jQuery('#bds-add-subject-btn').click(function(){

    var required = "Required!";
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    var bds_subject = jQuery('#bds_subject');
    if(bds_subject.val() == ""){
        bds_subject.css('border-top', '2px solid red'); 
        jQuery('.bds_subject_error').text(required).css('color','red');
    }else{
        bds_subject.css('border-top', '2px solid green'); 
        jQuery('.bds_subject_error').text("");
    }
    
   
    
    if(bds_subject.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_teacher_add_subject');        
        fd.append('bds_subject', bds_subject.val());
        fd.append('teacher_id', bds_teacher_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Subject Successfully Added!', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    var strLink = site_url+"/bds-add-teacher-subject/";
                    window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});
/*End bds Add Subject*/
jQuery('#bds-edit-subject-btn').click(function(){

    var required = "Required!";
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    var bds_subject_id = jQuery('#bds_subject_id').val();
    //alert(bds_teacher_id);
    var bds_subject = jQuery('#bds_subject');
    if(bds_subject.val() == ""){
        bds_subject.css('border-top', '2px solid red'); 
        jQuery('.bds_subject_error').text(required).css('color','red');
    }else{
        bds_subject.css('border-top', '2px solid green'); 
        jQuery('.bds_subject_error').text("");
    }
    
   
    
    if(bds_subject.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_teacher_edit_subject');        
        fd.append('bds_subject', bds_subject.val());
        fd.append('teacher_id', bds_teacher_id);
        fd.append('subject_id', bds_subject_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Subject upated Successfully!', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    var strLink = site_url+"/bds-add-teacher-subject/";
                    window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});


/*bds Add gallery category*/
jQuery('#bds-add-gallery-cat-btn').click(function(){
    //alert("sdsd");
    var required = "Required!";
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    var bds_gallery_cat = jQuery('#bds_gallery_cat');
    if(bds_gallery_cat.val() == ""){
        bds_gallery_cat.css('border-top', '2px solid red'); 
        jQuery('.bds_gallery_error').text(required).css('color','red');
    }else{
        bds_gallery_cat.css('border-top', '2px solid green'); 
        jQuery('.bds_gallery_error').text("");
    }
    
   
    
    if(bds_gallery_cat.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_teacher_add_gallery_cat');        
        fd.append('bds_gallery_cat', bds_gallery_cat.val());
        fd.append('teacher_id', bds_teacher_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Gallery category added successfully!', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    var strLink = site_url+"/bds-gallery-category/";
                    window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});
/*End bds Add Newsletter category*/


/*bds Add newsletter category*/
jQuery('#bds-add-news-cat-btn').click(function(){
    //alert("sdsd");
    var required = "Required!";
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    var bds_news_cat = jQuery('#bds_news_cat');
    if(bds_news_cat.val() == ""){
        bds_news_cat.css('border-top', '2px solid red'); 
        jQuery('.bds_subject_error').text(required).css('color','red');
    }else{
        bds_news_cat.css('border-top', '2px solid green'); 
        jQuery('.bds_subject_error').text("");
    }
    
   
    
    if(bds_news_cat.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_teacher_add_news_cat');        
        fd.append('bds_news_cat', bds_news_cat.val());
        fd.append('teacher_id', bds_teacher_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Newsletter Category Successfully!', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    var strLink = site_url+"/bds-newsletter-category/";
                    window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});
/*End bds Add newsletter category*/


/*bds Add Download category*/
jQuery('#bds-add-download-cat-btn').click(function(){
    //alert("sdsd");
    var required = "Required!";
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    
    var bds_download_cat = jQuery('#bds_download_cat');
    //alert(bds_download_cat.val());
    if(bds_download_cat.val() == ""){
        bds_download_cat.css('border-top', '2px solid red'); 
        jQuery('.bds_download_error').text(required).css('color','red');
    }else{
        bds_download_cat.css('border-top', '2px solid green'); 
        jQuery('.bds_download_error').text("");
    }
    
   
    
    if(bds_download_cat.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

        fd.append('action', 'ajax_bds_teacher_add_download_cat');        
        fd.append('bds_download_cat', bds_download_cat.val());
        fd.append('teacher_id', bds_teacher_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false

            success:function(data) {
                var json = jQuery.parseJSON(data);

                if(json.status == 1){
                    jQuery('.loader').hide();
                    swal('Success!', 'Download Category Successfully!', 'success');
                    //jQuery("#bds-add-homework-btn")[0].reset();
                    //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                    var strLink = site_url+"/bds-download-category/";
                    window.location.href= strLink;
                    //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                }
                if(json.status == 0){
                    jQuery('.loader').hide();
                    swal('Error!', 'Unknown error!', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
    
});
/*End bds Add newsletter category*/

jQuery('#bds-add-homework-btn').click(function(){

    var required = "Required!";
    //var bds_class = jQuery('#bds_class');
    //var bds_session = jQuery('#bds_session');
    var home_work_title = jQuery('#home_work_title');
    var bds_subject = jQuery('#bds_subject');
    //alert(bds_subject.val());
    var bds_date = jQuery('#bds_date');
    //alert(bds_date.val());
    var bds_description = jQuery('.nicEdit-main');
    //alert(bds_description);
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    /*if(bds_class.val() == ""){
        bds_class.css('border-top', '2px solid red'); 
        jQuery('.bds_class_error').text(required).css('color','red');
    }else{
        bds_class.css('border-top', '2px solid green'); 
        jQuery('.bds_class_error').text("");
    }*/
    
    /*if(bds_session.val() == ""){
        bds_session.css('border-top', '2px solid red'); 
        jQuery('.bds_session_error').text(required).css('color','red');
    }else{
        bds_session.css('border-top', '2px solid green'); 
        jQuery('.bds_session_error').text("");
    }*/
    
    if(home_work_title.val() == ""){
        home_work_title.css('border-top', '2px solid red'); 
        jQuery('.home_work_title_error').text(required).css('color','red');
    }else{
        home_work_title.css('border-top', '2px solid green'); 
        jQuery('.home_work_title_error').text("");
    }
    
    if(bds_subject.val() == ""){
        bds_subject.css('border-top', '2px solid red'); 
        jQuery('.bds_subject_error').text(required).css('color','red');
    }else{
        bds_subject.css('border-top', '2px solid green'); 
        jQuery('.bds_subject_error').text("");
    }
    
    if(bds_date.val() == ""){
        bds_date.css('border-top', '2px solid red'); 
        jQuery('.bds_date_error').text(required).css('color','red');
    }else{
        bds_date.css('border-top', '2px solid green'); 
        jQuery('.bds_date_error').text("");
    }
    
    /*if(bds_description.val() == ""){
        bds_description.css('border-top', '2px solid red'); 
        jQuery('.bds_description_error').text(required).css('color','red');
    }else{
        bds_description.css('border-top', '2px solid green'); 
        jQuery('.bds_description_error').text("");
    }*/
    
    if(home_work_title.val() != "" && bds_subject.val() != "" && bds_date.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

            fd.append('action', 'ajax_bds_teacher_add_home_work');
            //fd.append('bds_class',bds_class.val());
            //fd.append('session_id',bds_session.val());
            fd.append('home_work_title',home_work_title.val());
            fd.append('bds_subject', bds_subject.val());
            fd.append('bds_date', bds_date.val());
            fd.append('bds_description', bds_description.html());
            fd.append('teacher_id', bds_teacher_id);

                // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

                jQuery.ajax({
                    url: myAjax.ajaxurl,
                    type:'POST',
                    data:fd,
                    cache: false,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false

                    success:function(data) {
                        var json = jQuery.parseJSON(data);
                        
                        if(json.status == 1){
                            jQuery('.loader').hide();
                            swal('Success!', 'Homework Successfully!', 'success');
                            //jQuery("#bds-add-homework-btn")[0].reset();
                            //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                            var strLink = site_url+"/bds-homework/";
                            window.location.href= strLink;
                            //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                        }
                        if(json.status == 0){
                            jQuery('.loader').hide();
                            swal('Error!', 'Unknown error!', 'error');
                        }
                    },
                    error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                    }
                });
    }
    
});

/*Edit homeWork*/
jQuery('#bds-edit-homework-btn').click(function(){

    var required = "Required!";
    var bds_homework_id= jQuery('#bds_homework_id');
    //var bds_class = jQuery('#bds_class');
    //var bds_session = jQuery('#bds_session');
    var home_work_title = jQuery('#home_work_title');
    var bds_subject = jQuery('#bds_subject');
    //var bds_date = jQuery('#bds_date');
    var bds_description = CKEDITOR.instances['bds_description'].getData();
    //alert(bds_description);
    var bds_teacher_id = jQuery('#bds_teacher_id').val();
    //alert(bds_teacher_id);
    
    
    /*if(bds_session.val() == ""){
        bds_session.css('border-top', '2px solid red'); 
        jQuery('.bds_session_error').text(required).css('color','red');
    }else{
        bds_session.css('border-top', '2px solid green'); 
        jQuery('.bds_session_error').text("");
    }*/
    
    if(home_work_title.val() == ""){
        home_work_title.css('border-top', '2px solid red'); 
        jQuery('.home_work_title_error').text(required).css('color','red');
    }else{
        home_work_title.css('border-top', '2px solid green'); 
        jQuery('.home_work_title_error').text("");
    }
    
    if(bds_subject.val() == ""){
        bds_subject.css('border-top', '2px solid red'); 
        jQuery('.bds_subject_error').text(required).css('color','red');
    }else{
        bds_subject.css('border-top', '2px solid green'); 
        jQuery('.bds_subject_error').text("");
    }
    
    /*if(bds_date.val() == ""){
        bds_date.css('border-top', '2px solid red'); 
        jQuery('.bds_date_error').text(required).css('color','red');
    }else{
        bds_date.css('border-top', '2px solid green'); 
        jQuery('.bds_date_error').text("");
    }*/
    
    /*if(bds_description.val() == ""){
        bds_description.css('border-top', '2px solid red'); 
        jQuery('.bds_description_error').text(required).css('color','red');
    }else{
        bds_description.css('border-top', '2px solid green'); 
        jQuery('.bds_description_error').text("");
    }*/
    //alert(bds_subject.val());
    if(home_work_title.val() != "" && bds_subject.val() != "")
    {
        //alert(bds_description.val());
        jQuery('.loader').show();
        var fd = new FormData();

            fd.append('action', 'ajax_bds_teacher_edit_home_work');
            fd.append('id',bds_homework_id.val());
            //fd.append('bds_class',bds_class.val());
            //fd.append('session_id',bds_session.val());
            fd.append('home_work_title',home_work_title.val());
            fd.append('bds_subject', bds_subject.val());
            //fd.append('bds_date', bds_date.val());
            fd.append('bds_description', bds_description);
            fd.append('teacher_id', bds_teacher_id);

            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type:'POST',
                data:fd,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false

                success:function(data) {
                    var json = jQuery.parseJSON(data);
                    if(json.status == 1){
                        jQuery('.loader').hide();
                        swal('Success!', 'Homework Successfully!', 'success');
                        //jQuery("#bds-add-homework-btn")[0].reset();
                        //window.location.href="http://brookridgedayschool.mindclicksolutions.com/bds-homework/";
                        var strLink = site_url+"/bds-homework/";
                        window.location.href= strLink;
                        //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                    }
                    if(json.status == 0){
                        jQuery('.loader').hide();
                        swal('Error!', 'Unknown error!', 'error');
                    }
                },
                error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
                }
            });
    }
    
});
    
jQuery('#teacher_signup').click(function(){

    var required = " Required!";
    var error = 0;
    var id = jQuery('input[name="user"]').val();
    var name = jQuery('input[name="t_name"]');
    var t_no = jQuery('input[name="t_no"]');
    var phone = jQuery('input[name="phone"]');
    var gender = jQuery('input[name="gender"]');
    var address = jQuery('input[name="address"]');
    var email = jQuery('input[name="email"]');
    var password = jQuery('input[name="password"]');

    if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
    //
    // 
    if(t_no.val() == ""){ t_no.css('border-top', '2px solid red'); jQuery('.tno_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ t_no.css('border-top', '2px solid green'); jQuery('.tno_err').text(""); }
    // 
    if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
    //
//    if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
//    else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
    // 
    if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ 
        if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
     }
    // 
    if(password.val() == ""){ password.css('border-top', '2px solid red'); jQuery('.pass_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ password.css('border-top', '2px solid green'); jQuery('.pass_err').text(""); }
					
	   if(error < 1){

            var fd = new FormData();

            fd.append('action', 'ajax_teacher_signup_request');
            fd.append('name',name.val());
            fd.append('stu_no',t_no .val());
            fd.append('address', address.val());
            fd.append('phone', phone.val());
            fd.append('email', email.val());
            fd.append('password', password.val());

            fd.append('gender', jQuery('input[name=gender]:checked').val()  );
            fd.append('submit','teacher_reg');
            fd.append('id',id);

                // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

                jQuery.ajax({
                    url: myAjax.ajaxurl,
                    type:'POST',
                    data:fd,
                    cache: false,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false

                    success:function(data) {
                        var json = jQuery.parseJSON(data);

                        if(json.status == 1){
                            swal('Success!', 'Record Uploaded Successfully!', 'success');
                            jQuery("#trf")[0].reset();
                            window.location.href="http://brookridgedayschool.com/teacher-dashboard/";
                            //var strLink =site_url+ "teacher-dashboard/";
                            //document.getElementById("link_add_edit_homework").setAttribute("href",strLink);
                        }
                        if(json.status == 2){
                            swal('Error!', 'Unknown error!', 'error');
                        }
                    },
                    error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                    }
                });
      }
}); 
});


/*function submit_download_area(id){		

	var category = jQuery('#cat'+id).val();

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=image]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_download_request'); 
    fd.append('category', category);

var name = "";
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false  
    
    success:function(data) {
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });
	
}*/

function ajax_teacher_list_event() {

    var r = confirm("Sure to delete?");
    if (r == true) {

       /* jQuery(ele).closest('li').hide();

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': ele.id, table: table, action: 'ajax_teacher_delete_request'},
            success: function (data) {
                if (data == "1")
                    swal('Success!', 'Record Deleted Successfully!', 'success');
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });*/
    }
}
// #####################################
// #### download area form submission ##
// ##################################### 

function submit_download_area(id){		

	var category = jQuery('#cat'+id).val();

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=image]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_download_request'); 
    fd.append('category', category);

var name = "";
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false  
    
    success:function(data) {
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });
	
}

function submit_art_gallery(id){		

	var category = jQuery('#cat'+id).val();

   

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=image]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_gallery_request'); 
    fd.append('category', category);
    

var name = "";
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false  
    
    success:function(data) {
        //alert(data);
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });
	
}
// ############
// ########  newsletter
// ############
function submit_newsletter(id){

    var category = jQuery('#cat'+id).val();
    var title = jQuery('#news_title'+id).val();
    if(jQuery("#is_home"+id).is(':checked')){
        var is_home_value = 1;
    }

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=file]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_newsletter_request'); 
    fd.append('category', category);
    fd.append('title', title);
    fd.append('is_home', is_home_value);

var name = "";
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false  
    
    success:function(data) {
    	 //alert(data);
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    	jQuery('#news_title'+id).val("");
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });

}
// ############
// ########  spelling words
// ############
function submit_spelling_words(id){

var category = jQuery('#cat'+id).val();
var title = jQuery('#news_title'+id).val();

    if(jQuery("#is_home"+id).is(':checked')){
        var is_home_value = 1;
    }

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=file]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_spelling_words_request'); 
    fd.append('category', category);
    fd.append('title', title);
    fd.append('is_home', is_home_value);

var name = "";
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false  
    
    success:function(data) {
    	 //alert(data);
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    	jQuery('#news_title'+id).val("");
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });

}
// ############
// ########  home work 
// ############
function submit_home_work(id){
	var category = jQuery('#cat'+id).val();
    if(jQuery("#is_home"+id).is(':checked')){
        var is_home_value = 1;
    }

	var fd = new FormData();
    var file = jQuery("#form"+id).find('input[type="file"]');
    var caption = jQuery("#form"+id).find('input[name=image]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_teacher_home_work_request'); 
    fd.append('category', category);
    fd.append('is_home', is_home_value);

var name = "";

	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST', 
    data:fd,
    cache: false,
    processData: false, // Don't process the files
	contentType: false, // Set content type to false
    success:function(data) {
    	 //alert(data);
    	swal('Success!', 'Record Uploaded Successfully!', 'success');
    	jQuery('#panel'+id).addClass('show');
    	jQuery('#download_list'+id+' li:last-child').after(data);
    },
    error: function(errorThrown){
     swal('Error!', errorThrown, 'error');
    }
   });
	
}

function submit_homework(){

	var required = "Required!";
	var error = 0;
	var title = jQuery('input[name="title"]');
	var price = jQuery('input[name="price"]');
	var event_date = jQuery('input[name="event_date"]');
	var category = jQuery('select[name="category"]');
	var description = jQuery('textarea[name="description"]');
	var is_calender_e =jQuery('input[name="is_calender_e"]');
	var calender_value = 0;

	if(title.val() == ""){ title.css('border-top', '2px solid red'); jQuery('.t_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ title.css('border-color', 'green'); jQuery('.t_err').text(""); }
	// 
	/*if(price.val() == ""){ price.css('border-top', '2px solid red'); jQuery('.p_err').text(required).css('color','red');var  error =+error + +1;}
	else{ price.css('border-color', 'green'); jQuery('.p_err').text("");
		if (/\D/g.test( price.val() )) { price.css('border-top', '2px solid red'); jQuery('.p_err').text('Invalid Price').css('color','red');var  error =+error + +1;}
		else{ price.css('border-color', 'green'); jQuery('.p_err').text(""); }
	 }*/
	// 
	if(event_date.val() == ""){ event_date.css('border-top', '2px solid red'); jQuery('.w_err').text(required).css('color','red');var  error =+error + +1;}
	else{ event_date.css('border-color', 'green'); jQuery('.w_err').text("");}
	// 
	if(category.val() == "0"){ category.css('border-top', '2px solid red'); jQuery('.c_err').text(required).css('color','red');var  error =+error + +1;}
	else{ category.css('border-color', 'green'); jQuery('.c_err').text("");}
	// 
	if(description.val() == ""){ description.css('border-top', '2px solid red'); jQuery('.d_err').text(required).css('color','red');var  error =+error + +1;}
	else{ description.css('border-color', 'green'); jQuery('.d_err').text("");}
	// 
	var cat = category.val().substr(0,1).toUpperCase() + category.val().substr(1);

//var calender_value = 1;
var is_home_value = 0;

	if(jQuery("#is_calender_e").is(':checked')){
		calender_value = 1;
	}
    if(jQuery("#is_home").is(':checked')){
        is_home_value = 1;
    }

	if(error < 1 ){
	/*alert(title.val());
	alert(price.val());
	alert(event_date.val());
	alert(category.val());
	alert(description.val());*/	
	jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST',
    data: { 
	    action:'ajax_teacher_add_home_work_request',
	    title : title.val(),
	    teacher_id : price.val(),
	    event_date : event_date.val(),
	    category : category.val(),
	    description : description.val()	   
    },
    success:function(data) {
		//console.log(data);
        swal('Success!', 'Record Inserted Successfully!', 'success');
     // This outputs the result of the ajax request
        jQuery('.show').removeClass('show');
        jQuery('.'+cat+'1').addClass('show');
     	jQuery( '.'+cat+' tr:last-child' ).after(data);
    },
    error: function(errorThrown){
     alert(errorThrown);
    }
   });

		
	}
	
}
function edit_homework(){

     var required = "Required!";
     var error = 0;
	 
	
     var title = jQuery('input[name="title"]');
     var id = jQuery('input[name="id"]').val();
     var price = jQuery('input[name="price"]');
     var event_date = jQuery('input[name="event_date"]');
     var category = jQuery('select[name="category"]');
     var description = jQuery('textarea[name="description"]');
     var is_calender_e = jQuery('input[name="is_calender_e"]');
     var calender_value = 0;


     if(title.val() == ""){ title.css('border-top', '2px solid red'); jQuery('.t_err').text(required).css('color','red'); var  error =+error + +1;}
     else{ title.css('border-color', 'green'); jQuery('.t_err').text(""); }
     //
    /* if(price.val() == ""){ price.css('border-top', '2px solid red'); jQuery('.p_err').text(required).css('color','red');var  error =+error + +1;}
     else{ price.css('border-color', 'green'); jQuery('.p_err').text("");
         if (/\D/g.test( price.val() )) { price.css('border-top', '2px solid red'); jQuery('.p_err').text('Invalid Price').css('color','red');var  error =+error + +1;}
         else{ price.css('border-color', 'green'); jQuery('.p_err').text(""); }
     }*/
     //
     if(event_date.val() == ""){ event_date.css('border-top', '2px solid red'); jQuery('.w_err').text(required).css('color','red');var  error =+error + +1;}
     else{ event_date.css('border-color', 'green'); jQuery('.w_err').text("");}
     //
     if(category.val() == "0"){ category.css('border-top', '2px solid red'); jQuery('.c_err').text(required).css('color','red');var  error =+error + +1;}
     else{ category.css('border-color', 'green'); jQuery('.c_err').text("");}
     //
     if(description.val() == ""){ description.css('border-top', '2px solid red'); jQuery('.d_err').text(required).css('color','red');var  error =+error + +1;}
     else{ description.css('border-color', 'green'); jQuery('.d_err').text("");}
     //
     var cat = category.val().substr(0,1).toUpperCase() + category.val().substr(1);
 
    
         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data: {
                 action:'ajax_teacher_edit_home_work_request',
                 title : title.val(),
                 event_date : event_date.val(),
                 category : category.val(),
                 description : description.val(),
                 id:id,
             },
             success:function(data) {
		//alert(data);
                 var json = jQuery.parseJSON(data);
                 if(json.data == "1") {
                     swal('Success!', 'Record Inserted Successfully!', 'success');
					 
                 }else if(json.data == 'err'){
                     swal('Error!', 'Unknown error!', 'error');
                 }

                 // This outputs the result of the ajax request

             },
             error: function(errorThrown){
                 alert(errorThrown);
             }
         });


     

 }
function delete_homework(id){
    var r = confirm("Sure to delete?");
    if (r == true) {     

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_teacher_delete_home_work_request'},

            success: function (data) {
				//alert(data);
				//console.log(data);
                var json = jQuery.parseJSON(data);

                if (json.data == "1"){
					 jQuery('#tr_' + id).hide();
                    swal('Success!', 'Record Deleted Successfully!', 'success');
				}
				else
					swal('Error!', 'Process failed!', 'error');
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        })
    }
}
function back_homework(url){
	alert(url);
	}

// ############
// ########  delete function
// ############
function delete_this(ele,table) {

    var r = confirm("Sure to delete?");
    if (r == true) {

        jQuery(ele).closest('li').hide();

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': ele.id, table: table, action: 'ajax_teacher_delete_request'},
            success: function (data) {
                if (data == "1")
                    swal('Success!', 'Record Deleted Successfully!', 'success');
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
    }
}
// #####
// ## add event function

function submit_event(){

	var required = "Required!";
	var error = 0;
	var title = jQuery('input[name="title"]');
	var price = jQuery('input[name="price"]');
	var event_date = jQuery('input[name="event_date"]');
	var category = jQuery('select[name="category"]');
	var description = jQuery('textarea[name="description"]');
	var is_calender_e =jQuery('input[name="is_calender_e"]');
	var calender_value = 0;

	if(title.val() == ""){ title.css('border-top', '2px solid red'); jQuery('.t_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ title.css('border-color', 'green'); jQuery('.t_err').text(""); }
	// 
	if(price.val() == ""){ price.css('border-top', '2px solid red'); jQuery('.p_err').text(required).css('color','red');var  error =+error + +1;}
	else{ price.css('border-color', 'green'); jQuery('.p_err').text("");
		if (/\D/g.test( price.val() )) { price.css('border-top', '2px solid red'); jQuery('.p_err').text('Invalid Price').css('color','red');var  error =+error + +1;}
		else{ price.css('border-color', 'green'); jQuery('.p_err').text(""); }
	 }
	// 
	if(event_date.val() == ""){ event_date.css('border-top', '2px solid red'); jQuery('.w_err').text(required).css('color','red');var  error =+error + +1;}
	else{ event_date.css('border-color', 'green'); jQuery('.w_err').text("");}
	// 
	if(category.val() == "0"){ category.css('border-top', '2px solid red'); jQuery('.c_err').text(required).css('color','red');var  error =+error + +1;}
	else{ category.css('border-color', 'green'); jQuery('.c_err').text("");}
	// 
	if(description.val() == ""){ description.css('border-top', '2px solid red'); jQuery('.d_err').text(required).css('color','red');var  error =+error + +1;}
	else{ description.css('border-color', 'green'); jQuery('.d_err').text("");}
	// 
	var cat = category.val().substr(0,1).toUpperCase() + category.val().substr(1);

//var calender_value = 1;
var is_home_value = 0;

	if(jQuery("#is_calender_e").is(':checked')){
		calender_value = 1;
	}
    if(jQuery("#is_home").is(':checked')){
        is_home_value = 1;
    }

	if(error < 1 ){
//alert(event_date.val());
		jQuery.ajax({
    url: myAjax.ajaxurl,
    type:'POST',
    data: { 
	    action:'ajax_teacher_add_event_request',
	    title : title.val(),
	    price : price.val(),
	    event_date : event_date.val(),
	    category : category.val(),
	    description : description.val(),
	    is_calender_e : calender_value,
        is_home:is_home_value
    },
    success:function(data) {
		//alert(data);
        swal('Success!', 'Record Inserted Successfully!', 'success');
     // This outputs the result of the ajax request
        jQuery('.show').removeClass('show');
        jQuery('.'+cat+'1').addClass('show');
     jQuery( '.'+cat+' tr:last-child' ).after(data);
    },
    error: function(errorThrown){
     alert(errorThrown);
    }
   });

		
	}
	
}

 //########### update event

 function edit_event(){

     var required = "Required!";
     var error = 0;
     var title = jQuery('input[name="title"]');
     var id = jQuery('input[name="event_id"]').val();
     var price = jQuery('input[name="price"]');
     var event_date = jQuery('input[name="event_date"]');
     var category = jQuery('select[name="category"]');
     var description = jQuery('textarea[name="description"]');
     var is_calender_e = jQuery('input[name="is_calender_e"]');
     var calender_value = 0;

     if(title.val() == ""){ title.css('border-top', '2px solid red'); jQuery('.t_err').text(required).css('color','red'); var  error =+error + +1;}
     else{ title.css('border-color', 'green'); jQuery('.t_err').text(""); }
     //
     if(price.val() == ""){ price.css('border-top', '2px solid red'); jQuery('.p_err').text(required).css('color','red');var  error =+error + +1;}
     else{ price.css('border-color', 'green'); jQuery('.p_err').text("");
         if (/\D/g.test( price.val() )) { price.css('border-top', '2px solid red'); jQuery('.p_err').text('Invalid Price').css('color','red');var  error =+error + +1;}
         else{ price.css('border-color', 'green'); jQuery('.p_err').text(""); }
     }
     //
     if(event_date.val() == ""){ event_date.css('border-top', '2px solid red'); jQuery('.w_err').text(required).css('color','red');var  error =+error + +1;}
     else{ event_date.css('border-color', 'green'); jQuery('.w_err').text("");}
     //
     if(category.val() == "0"){ category.css('border-top', '2px solid red'); jQuery('.c_err').text(required).css('color','red');var  error =+error + +1;}
     else{ category.css('border-color', 'green'); jQuery('.c_err').text("");}
     //
     if(description.val() == ""){ description.css('border-top', '2px solid red'); jQuery('.d_err').text(required).css('color','red');var  error =+error + +1;}
     else{ description.css('border-color', 'green'); jQuery('.d_err').text("");}
     //
     var cat = category.val().substr(0,1).toUpperCase() + category.val().substr(1);


     if(jQuery("#is_calender_e").is(':checked')){
         var calender_value = 1;
     }
     if(jQuery("#is_home").is(':checked')){
         var is_home_value = 1;
     }

     if(error < 1 ){

         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data: {
                 action:'ajax_teacher_edit_event_request',
                 title : title.val(),
                 price : price.val(),
                 event_date : event_date.val(),
                 category : category.val(),
                 description : description.val(),
                 is_calender_e : calender_value,
                 is_home:is_home_value,
                 id:id,
             },
             success:function(data) {

                 var json = jQuery.parseJSON(data);
                 if(json.data == "1") {
                     swal('Success!', 'Record Inserted Successfully!', 'success');
					 
                 }else if(json.data == 'err'){
                     swal('Error!', 'Unknown error!', 'error');
                 }

                 // This outputs the result of the ajax request

             },
             error: function(errorThrown){
                 alert(errorThrown);
             }
         });


     }

 }

 //#########################################################   delete event   ###############
function delete_event(id){
    var r = confirm("Sure to delete?");
    if (r == true) {
        jQuery('#tr_' + id).hide();

        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {'id': id, action: 'ajax_teacher_delete_event_request'},

            success: function (data) {
                var json = jQuery.parseJSON(data);

                if (json.data == "1")
                    swal('Success!', 'Record Deleted Successfully!', 'success');
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        })
    }
}

 //#########################################################   edit student   ###############
jQuery(document).ready(function(e) {
	
	jQuery('#parent_edit_child').click(function(){
    var required = " Required!";
	var error = 0;
	var name = jQuery('input[name="stu_name"]');
    var id = jQuery('input[name="id"]');
	var stu_no = jQuery('input[name="stu_no"]');
	var phone = jQuery('input[name="phone"]');
	var gender = jQuery('input[name="gender"]');
	var address = jQuery('input[name="address"]');
	var email = jQuery('input[name="email"]');

	var file = jQuery('input[name="file"]');

        var year = jQuery('select[name="year"]');
        var month = jQuery('select[name="month"]');
        var day = jQuery('select[name="day"]');

        if(year.val() == "0"){ year.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ year.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(month.val() == "0"){ month.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ month.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(day.val() == "0"){ day.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ day.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
        //
        //if(file.val() == "") {
        //    if (file.attr('class') == "") {
        //        file.css('border-top', '2px solid red');
        //        jQuery('.file_err').text(required).css('color', 'red');
        //        var error = +error + +1;
        //    }
        //    else {
        //        file.css('border-top', '2px solid green');
        //        jQuery('.file_err').text("");
        //    }
        //}
        //


	if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
	// 

	// 
	if(stu_no.val() == ""){ stu_no.css('border-top', '2px solid red'); jQuery('.stuno_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ stu_no.css('border-top', '2px solid green'); jQuery('.stuno_err').text(""); }
	// 
	if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
	//
	if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
	else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
	// 
	if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ 
        if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
     }
	//

	if(error < 1){

        var dob = day.val() + "-" + month.val() + "-" + year.val();

	var fd = new FormData();
    var file = jQuery("#add_stu_form").find('input[type="file"]');
    var caption = jQuery("#add_stu_form").find('input[name=file]');
    var individual_file = file[0].files[0];
    fd.append("file", individual_file);
    var individual_capt = caption.val();
    fd.append("caption", individual_capt);  
    fd.append('action', 'ajax_parent_edit_child_request');
    fd.append('name',name.val());
    fd.append('stu_no',stu_no .val());
    fd.append('address', address.val());
    fd.append('phone', phone.val());
    fd.append('email', email.val());
    fd.append('dob', dob);
    fd.append('gender', jQuery('input[name=gender]:checked').val()  );
    fd.append('id', jQuery('input[name=id]').val()  );

    	jQuery.ajax({
		    url: myAjax.ajaxurl,
		    type:'POST', 
		    data:fd,
		    cache: false,
		    processData: false, // Don't process the files
			contentType: false, // Set content type to false  
		    
		    success:function(data) {
                //alert(data);
		    	 var json = jQuery.parseJSON(data);
		    	if(json.data == "1"){
		    	swal('Success!', 'Record Uploaded Successfully!', 'success');
		    	jQuery("#add_stu_form")[0].reset();
		    	jQuery('#img_disp').hide();
		    	 //window.location.href="http://brs.noceky.com/roster";
		    	}else if(json.data == 'err'){
		    		swal('Error!', 'Unknown Error', 'error');
		    	}else{
                    swal('Error!', data, 'error');
                }
		    },
		    error: function(errorThrown){
		     swal('Error!', errorThrown, 'error');
		    }
  		});
	}
	
	});

    //  add family
    jQuery('#add_family').click(function(){
        var required = " Required!";
        var error = 0;
        var name = jQuery('input[name="stu_name"]');
        var id = jQuery('input[name="id"]');
        var phone = jQuery('input[name="phone"]');
        var phone_label_1 = jQuery('input[name="phone_label_1"]');
        var gender = jQuery('input[name="gender"]');
        var address = jQuery('input[name="address"]');
        var email = jQuery('input[name="email"]');
        var password = jQuery('input[name="password"]');
        var relation = jQuery('select[name="relation"]');

        var file = jQuery('input[name="file"]');

        if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
        //
        //if(file.val() == ""){ file.css('border-top', '2px solid red'); jQuery('.file_err').text(required).css('color','red'); var  error =+error + +1;}
        //else{ file.css('border-top', '2px solid green'); jQuery('.file_err').text(""); }

        if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
        //
        if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
        //
        if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
        //
        if(phone_label_1.val() == ""){ phone_label_1.css('border-top', '2px solid red'); jQuery('.phone_label_1_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ phone_label_1.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
        //
        if(relation.val() == "0"){ relation.css('border-top', '2px solid red'); jQuery('.relation_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ relation.css('border-top', '2px solid green'); jQuery('.relation_err').text(""); }
        if(password.val() == ""){ password.css('border-top', '2px solid red'); jQuery('.password_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ password.css('border-top', '2px solid green'); jQuery('.relation_err').text(""); }
        //
        if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
        else{
            if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
        }
        //

        if(error < 1){
            var fd = new FormData();
            var file = jQuery("#add_stu_form").find('input[type="file"]');
            var caption = jQuery("#add_stu_form").find('input[name=file]');
            var individual_file = file[0].files[0];
            fd.append("file", individual_file);
            var individual_capt = caption.val();
            fd.append("caption", individual_capt);
            fd.append('action', 'ajax_parent_add_family_request');
            fd.append('name',name.val());
            fd.append('address', address.val());
            fd.append('phone', phone.val());
            fd.append('phone_label_1', phone_label_1.val());
            fd.append('email', email.val());
            fd.append('gender', jQuery('input[name=gender]:checked').val()  );
            fd.append('password', password.val());
            fd.append('relation', relation.val());
            fd.append('id', id.val());

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type:'POST',
                data:fd,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false
                success:function(data) {
                     //alert(data);
                    console.log(data);
                    var json = jQuery.parseJSON(data);
                    if(json.data == "1"){
                        swal('Success!', 'Record Uploaded Successfully!', 'success');
                        jQuery("#add_stu_form")[0].reset();
                        jQuery('#img_disp').hide();
                        history.back(1);
                    }else if(json.data == 'err'){
                        swal('Error!', 'Unknown Error', 'error');
                    }else if(json.data == '3') {
                        swal('Error!', "You havn't Permission to add more family members", 'error');
                    }else{
                        swal('Error!', data, 'error');
                    }
                },
                error: function(errorThrown){
                    swal('Error!', errorThrown, 'error');
                }
            });
        }

    });

    jQuery('#teacher_edit_roster').click(function(){
        var required = " Required!";
        var error = 0;
        var name = jQuery('input[name="stu_name"]');
        var id = jQuery('input[name="id"]');
        var stu_no = jQuery('input[name="stu_no"]');
        var phone = jQuery('input[name="phone"]');
        var email = jQuery('input[name="p_email"]');
        var gender = jQuery('input[name="gender"]');
        var address = jQuery('input[name="address"]');
        var grade = jQuery('input[name="grade"]');
        var password = jQuery('input[name="password"]');
        var file = jQuery('input[name="file"]');
        var year = jQuery('select[name="year"]');
        var month = jQuery('select[name="month"]');
        var day = jQuery('select[name="day"]');

        //alert(file.attr('class'));

        var movie = jQuery('input[name="movie"]');
        var student_of_week = jQuery('input[name="student_of_week"]');
        var support = jQuery('input[name="support"]');
        var hero = jQuery('input[name="hero"]');
        var teacher_id = jQuery('input[name="teacher_id"]');
        // vild phoen, email
        var email_style = jQuery('#2nd_email').attr('style');
        var phone_style = jQuery('#2nd_phone').attr('style');
        var email2 = jQuery('input[name="p_email2"]');
        var relation2 = jQuery('input[name="relation2"]');
        var phone2 = jQuery('input[name="phone2"]');
        var phone_lable2 = jQuery('input[name="phone_lable2"]');
        var relation = jQuery('input[name="relation"]');
        var phone_lable = jQuery('input[name="phone_lable"]');
        if (student_of_week.is(':checked')) {
            student_of_week = "1";
        }else{
            student_of_week = "0";
        }
        if(email_style == "" || email_style == 'display: block;'){
            //vars

            if(email2.val() == ""){ email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{
                if (emailPattern.test(email2.val()) ==false){email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
                else{  email2.css('border-top','2px solid green'); jQuery('.email2_err').text(''); }
            }
            if(relation2.val() == ""){ relation2.css('border-top', '2px solid red'); jQuery('.relation2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{ relation2.css('border-top', '2px solid green'); jQuery('.relation2_err_').text(""); }
        }

        //if(phone_style == "" || phone_style == 'display: block;'){
        //    if(phone_lable2.val() == ""){ phone_lable2.css('border-top', '2px solid red'); jQuery('.p_l2_err').text(required).css('color','red'); var  error =+error + +1;}
        //    else{ phone_lable2.css('border-top', '2px solid green'); jQuery('.p_l2_err').text(""); }
        //
        //    if(phone2.val() == ""){ phone2.css('border-top', '2px solid red'); jQuery('.phone2_err').text(required).css('color','red'); var  error =+error + +1;}
        //    else{ phone2.css('border-top', '2px solid green'); jQuery('.phone2_err').text(""); }
        //}

        if(year.val() == "0"){ year.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ year.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(month.val() == "0"){ month.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ month.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(day.val() == "0"){ day.css('border-top', '2px solid red'); var  error =+error + +1;}
        else{ day.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

        if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
        //
        //if(file.val() == "") {
        //    if (file.attr('class') == "") {
        //        file.css('border-top', '2px solid red');
        //        jQuery('.file_err').text(required).css('color', 'red');
        //        var error = +error + +1;
        //    }
        //    else {
        //        file.css('border-top', '2px solid green');
        //        jQuery('.file_err').text("");
        //    }
        //}
        //alert(email.val());
        //
        if(stu_no.val() == ""){ stu_no.css('border-top', '2px solid red'); jQuery('.stuno_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ stu_no.css('border-top', '2px solid green'); jQuery('.stuno_err').text(""); }
        //
        if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
        //

        //
        if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
        else{
            if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
            else{  email.css('border-top','2px solid green'); jQuery('.email_err').text(''); }
        }
        if(relation.val() == ""){ relation.css('border-top', '2px solid red'); jQuery('.relation_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ relation.css('border-top', '2px solid green'); jQuery('.relation_err').text(""); }

        //if(phone_lable.val() == ""){ phone_lable.css('border-top', '2px solid red'); jQuery('.p_l_err').text(required).css('color','red'); var  error =+error + +1;}
        //else{ phone_lable.css('border-top', '2px solid green'); jQuery('.p_l_err').text(""); }

        //if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
        //else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }

        if(error < 1){

            var dob = day.val() + "-" + month.val() + "-" + year.val();

            var fd = new FormData();
            var file = jQuery("#add_stu_form").find('input[type="file"]');
            var caption = jQuery("#add_stu_form").find('input[name=file]');
            var individual_file = file[0].files[0];
            fd.append("file", individual_file);
            var individual_capt = caption.val();
            fd.append("caption", individual_capt);
            fd.append('action', 'ajax_teacher_edit_roster_request');
            fd.append('name',name.val());
            fd.append('stu_no',stu_no .val());
            fd.append('address', address.val());
            fd.append('phone', phone.val());
            fd.append('email', email.val());
            fd.append('gender', jQuery('input[name=gender]:checked').val()  );
            fd.append('id', jQuery('input[name=id]').val()  );
            fd.append('dob', dob);
            fd.append('movie', movie.val());
            fd.append('student_of_week', student_of_week);
            fd.append('teacher_id', teacher_id.val());
            fd.append('hero', hero.val());
            fd.append('support', support.val());
            fd.append('relation', relation.val());
            fd.append('phone', phone.val());
            fd.append('phone_label', phone_lable.val());
            fd.append('email2', email2.val());
            fd.append('grade', grade.val());
            fd.append('relation2', relation2.val());
            fd.append('phone2', phone2.val());
            fd.append('phone_label2', phone2.val());
            fd.append('parent_id',jQuery('input[name="p_id"]').val());
            // jQuery('#add_students').after('&nbsp;<img class="loading" src="http://brs.noceky.com/wp-content/uploads/2016/08/loading.gif">');

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type:'POST',
                data:fd,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false

                success:function(data) {
                     //alert(data);
                    var json = jQuery.parseJSON(data);
                    if(json.data == "1"){
                        swal('Success!', 'Record Uploaded Successfully!', 'success');
                    }else{
                        swal('Error!', 'Unknown Error', 'error');
                    }
                },
                error: function(errorThrown){
                    swal('Error!', errorThrown, 'error');
                }
            });
        }

    });
});
 //################   add family

 //#########################################################   rooster search   ###############
function getRoosterById(v){
	jQuery('.session label').before('<img class="loading" src="http://brookridgedayschool.com/wp-content/uploads/2016/08/loading.gif"> &nbsp;');
jQuery.ajax({
		    url: myAjax.ajaxurl,
		    type:'POST', 
		    data:{
		    	action:'ajax_teacher_get_roster_by_id_request',
		    	'session':v,
		    },	    
		    success:function(data) {
		    	// alert(data);				    	
			    	jQuery('#tbody').html(data);    	
		    		jQuery('.loading').hide();
		    },
		    error: function(errorThrown){
		     swal('Error!', errorThrown, 'error');
		    }
  		});
}



 //#########################################################   login system Validation   ###############

jQuery(document).ready(function(){    
     jQuery('#login_system').click(function(){
         jQuery('.success').html('Loading...');

         var username =  jQuery('input[name="username"]').val();
         var password =  jQuery('input[name="password"]').val();
         var type =  jQuery('select[name="type"]').val();
         var login = "123";
         
         var error = 0;
         if(username == ""){
             jQuery('.user_err').text(' Required!').css('color','red');
             var error = +error + +1;
         }else{
            jQuery('.user_err').text('');
         }
         if(password == ""){
             jQuery('.pass_err').text(' Required!').css('color','red');
             var error = +error + +1;
         }else{
            jQuery('.pass_err').text('');
         }
         if(type == "0"){
             jQuery('.type_err').text(' Required!').css('color','red');
             var error = +error + +1;
         }else{
            jQuery('.type_err').text('');
         }

         if(error > 0){
             jQuery('.success').html('');

             jQuery('.error').html('please fix errors');

         }else{     
            jQuery('.error').html('');
  // console.log('Ajax Call ');
   // console.log(myAjax.ajaxurl);
            jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST', 
            data:{
                action:'ajax_login_action',
                'password':password,
                'type':type,
                'username':username,
                'login':login
            },      
            success:function(data) {

			//	window.location="http://brs.noceky.com/teacher-dashboard";
                 console.log(data);
               var json = jQuery.parseJSON(data);

                   if(json.data == "teacher"){
                        jQuery('.error').html('');

						window.location="teacher-dashboard";
                    }
                     if(json.data == "parent"){
                        jQuery('.error').html('');

                        window.location="teacher-dashboard";
                    }
                     if(json.data == "student"){
                        jQuery('.error').html('');

                        window.location="teacher-dashboard";
                    }
                    if(json.data == "err"){
                        jQuery('.success').html('');
                        jQuery('.error').html(' Wrong username or password!');
                    }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
            
         }

    });

     // ###############################
     // #### parent registration #####
     // ##############################

jQuery('#parent_signup').click(function(){
    var required = " Required!";
    var error = 0;
    var name = jQuery('input[name="p_name"]');
    var phone = jQuery('input[name="phone"]');
    var address = jQuery('input[name="address"]');
    var email = jQuery('input[name="email"]');
    var password = jQuery('input[name="password"]');
    var image_file = jQuery('input[name="file"]');
    var confirm_password = jQuery('#confirm_password');
    var id = jQuery('#user_id');
    
    if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ name.css('border-color', 'green'); jQuery('.name_err').text(""); }
    //
    if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red');var  error =+error + +1;}
    else{ phone.css('border-color', 'green'); jQuery('.phone_err').text("");}
    //
    if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red');var  error =+error + +1;}
    else{ address.css('border-color', 'green'); jQuery('.addr_err').text("");}    //
    //
   if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
    else{
        if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
     }
    //
    if(password.val() == ""){ password.css('border-top', '2px solid red'); jQuery('.pass_err').text(required).css('color','red');var  error =+error + +1;}
    else{
        if(password.val().length < 6 ){ password.css('border-top', '2px solid red'); jQuery('.pass_err').text(' Lenth should be grater than 6').css('color','red');var  error =+error + +1;
     }else{password.css('border-color', 'green'); jQuery('.pass_err').text("");}
 }
    //
    if(image_file.val() == ""){ image_file.css('border-top', '2px solid red'); jQuery('.file_err').text(required).css('color','red');var  error =+error + +1;}
    else{ image_file.css('border-color', 'green'); jQuery('.file_err').text("");}
    //
    if(confirm_password.val() == ""){ confirm_password.css('border-top', '2px solid red'); jQuery('.confirm_pass_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ confirm_password.css('border-color', 'green'); jQuery('.confirm_pass_err').text(""); }
    //
    if(confirm_password.val() != password.val() || password.val() != confirm_password.val() ){ 
        confirm_password.css('border-top', '2px solid red'); jQuery('.pass_match').text('Password Must Match.').css('color','red'); var  error =+error + +1;
    }
    else
    { 
        confirm_password.css('border-color', 'green'); jQuery('.pass_match').text("");
    }
    if(error < 1 ){
        var fd = new FormData();
//        var file = jQuery("#trf").find('input[type="file"]');
//        var caption = jQuery("#trf").find('input[name=file]');
//        var individual_file = file[0].files[0];
//        fd.append("file", individual_file);
//        var individual_capt = caption.val();
//        fd.append("caption", individual_capt);
        fd.append('action', 'ajax_parent_register');
        fd.append('p_name',name.val());
        fd.append('address', address.val());
        fd.append('phone', phone.val());
        fd.append('email', email.val());
        fd.append('id', id.val());
        fd.append('password', password.val());
        fd.append('submit', '123');
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data:fd,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false
            success:function(data) {
                var json = jQuery.parseJSON(data);
                //alert(json.data);
                if(json.status == "1"){
                    swal('Success!', 'Record Uploaded Successfully!', 'success');
                    window.location="login";
                    jQuery("#trf")[0].reset();
                    jQuery('#img_disp').hide();
                }else{
                    swal('Error!', data, 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });


    }
    });
});  // ##############    end document.ready function 

    function teacher_add_parent(){

        var required = " Required!";
        var error = 0;
        var name = jQuery('input[name="s_name"]');
        var stu_no = jQuery('input[name="s_no"]');
        var parent_name = jQuery('input[name="p_name"]');
        var email = jQuery('input[name="p_email"]');
        var p_relation = jQuery('select[name="p_relation"]'); // email
        var relation = jQuery('input[name="relation"]'); // parent relation
        var phone = jQuery('input[name="phone"]');
        var phone_lable = jQuery('input[name="phone_lable"]');
        var email_style = jQuery('#2nd_email').attr('style');
        //var phone_style = jQuery('#2nd_phone').attr('style');
        var email2 = jQuery('input[name="p_email2"]');
        var relation2 = jQuery('input[name="relation2"]');
        var phone2 = jQuery('input[name="phone2"]');
        var phone_lable2 = jQuery('input[name="phone_lable2"]');

        if(email_style == "" || email_style == 'display: block;'){
            //
            if(email2.val() == ""){ email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{
                if (emailPattern.test(email2.val()) ==false){email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
                else{  email2.css('border-top','2px solid green'); jQuery('.email2_err').text(''); }
            }
            if(relation2.val() == ""){ relation2.css('border-top', '2px solid red'); jQuery('.relation2_err').text(required).css('color','red'); var  error =+error + +1;}
                else{ relation2.css('border-top', '2px solid green'); jQuery('.relation2_err_').text(""); }
        }

//        if(phone_style == "" || phone_style == 'display: block;'){
//            //vars
//
//
//            if(phone_lable2.val() == ""){ phone_lable2.css('border-top', '2px solid red'); jQuery('.p_l2_err').text(required).css('color','red'); var  error =+error + +1;}
//            else{ phone_lable2.css('border-top', '2px solid green'); jQuery('.p_l2_err').text(""); }
//
//            if(phone2.val() == ""){ phone2.css('border-top', '2px solid red'); jQuery('.phone2_err').text(required).css('color','red'); var  error =+error + +1;}
//            else{ phone2.css('border-top', '2px solid green'); jQuery('.phone2_err').text(""); }
//        }

        if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.n_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ name.css('border-top', '2px solid green'); jQuery('.n_err').text(""); }
         
        if(stu_no.val() == ""){ stu_no.css('border-top', '2px solid red'); jQuery('.stno_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ stu_no.css('border-top', '2px solid green'); jQuery('.stno_err').text(""); }

        if(parent_name.val() == ""){ parent_name.css('border-top', '2px solid red'); jQuery('.pn_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ parent_name.css('border-top', '2px solid green'); jQuery('.pn_err').text(""); }

        if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
    else{ 
        if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
        else{  email.css('border-top','2px solid green'); jQuery('.email_err').text(''); }
     }
        if(relation.val() == ""){ relation.css('border-top', '2px solid red'); jQuery('.relation_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ relation.css('border-top', '2px solid green'); jQuery('.relation_err').text(""); }

        if(phone_lable.val() == ""){ phone_lable.css('border-top', '2px solid red'); jQuery('.p_l_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ phone_lable.css('border-top', '2px solid green'); jQuery('.p_l_err').text(""); }

        if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }


     if(error < 1 ){

    //     disable button
         jQuery('#tea_inv_pare').attr('disabled');

    jQuery.ajax({
            url : myAjax.ajaxurl,
            type : 'POST',
            data : {
                action :'ajax_add_parent_request',
                'name' : name.val(),
                'email' : email.val(),
                'parent_name' : parent_name.val(),
                'stu_no' : stu_no.val(),
                'relation' : relation.val(),
                'phone' : phone.val(),
                'phone_label' : phone_lable.val(),
                'email2' : email2.val(),
                'relation2' : relation2.val(),
//                'phone2' : phone2.val(),
//                'phone_label2': phone2.val(),
                'p_relation' : p_relation.val(),
            },      
            success:function(data) {
                // alert(data);
                var json = jQuery.parseJSON(data);
                if(json.data == 1) {
                    jQuery(".error").hide();
                    jQuery("#trf")[0].reset();
                    swal('Success!', 'Invitation email is send to' + email.val(), 'success');
                }else if(json.data == 1){
                    swal('Error!', 'Unknown Error', 'error');
                }
            },
            error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
            }
        });
    }
}

     //invite teacher
 //function invite_teacher(){
 //    var  required = " Required!";
 //    var f_name = jQuery('input[name="f_name"]');
 //
 //    var email  = jQuery('input[name="t_email"]');
 //    var error = 0;
 //    if( f_name.val() == "" ){ f_name.css('border-top','2px solid red'); jQuery('.fname_err').text(required).css('color','red');var  error =+error + +1;  }
 //    else{  f_name.css('border-top','2px solid green'); jQuery('.fname_err').text(''); }
 //
 //
 //    if(email.val() == ""){email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
 //    else{
 //        if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
 //        else{  email.css('border-top','2px solid green'); jQuery('.email_err').text(''); }
 //    }
 //
 //    if(error < 1 ){
 //
 //        jQuery.ajax({
 //            url: myAjax.ajaxurl,
 //            type:'POST',
 //            data:{
 //                action:'ajax_invite_teacher',
 //                'full_name': f_name.val(),
 //                'email' : email.val(),
 //
 //            },
 //            success:function(data) {
 //                // alert(data);
 //
 //                if(data == 1){ jQuery('.message').html('Email successfully send to '+ email.val()+'!'); }
 //                else{ jQuery('.message').addClass('error').html(data)};
 //
 //
 //            },
 //            error: function(errorThrown){
 //                swal('Error!', errorThrown, 'error');
 //            }
 //
 //
 //        });
 //    }
 //}

 function admin_add_teacher(){

     var  required = " Required!";
     var class_name = jQuery('select[name="class_name"]');
     var school_type = jQuery('select[name="school_type"]');
     var session = jQuery('select[name="session"]');

     var f_name = jQuery('input[name="full_name"]');
     var email  = jQuery('input[name="email"]');
     var error = 0;
     if( f_name.val() == "" ){ f_name.css('border-top','2px solid red'); jQuery('.fname_err').text(required).css('color','red');var  error =+error + +1;  }
     else{  f_name.css('border-top','2px solid green'); jQuery('.fname_err').text(''); }

     if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
     else{
         if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
         else{  email.css('border-top','2px solid green'); jQuery('.email_err').text(''); }
     }
     if(session.val() == "0"){ session.css('border-top', '2px solid red'); jQuery('.session_err').text(required).css('color','red'); var  error =+error + +1;}
     else{ session.css('border-top', '2px solid green'); jQuery('.session_err').text(""); }
     //
     if(class_name.val() == "0"){ class_name.css('border-top', '2px solid red'); jQuery('.class_err').text(required).css('color','red'); var  error =+error + +1;}
     else{ class_name.css('border-top', '2px solid green'); jQuery('.class_err').text(""); }
     //
     if(school_type.val() == "0"){ school_type.css('border-top', '2px solid red'); jQuery('.school_err').text(required).css('color','red'); var  error =+error + +1;}
     else{ school_type.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }
     if(error == 0 ){
    return true;
     }
     return false;
 }

 function invite_teacher(id){
     if(isNaN(id)){
         alert('unknown error');
     }else{

         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data:{
                 action:'ajax_invite_teacher',
                 'id':id,
             },
             success:function(data) {
                 var json = jQuery.parseJSON(data);
                 if(json.status == 1){
                     swal('Success!', 'Invitation Send Successfully!', 'success');
                     jQuery('.inv_btn_'+id+ ' button').text('reinvite');
                     jQuery('.inv_btn_'+id+ ' button').attr('onclick',"reinvite_teacher(this.value)");
                     jQuery('.inv_status_'+id).html('<i class="fa fa-clock-o"></i> Awaiting');
                 }

                 console.log(json.link);
             },
             error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }
 function reinvite_teacher(id){
     if(isNaN(id)){
         alert('unknown error');
     }else{

         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data:{
                 action:'ajax_reinvite_teacher',
                     'id':id,
             },
             success:function(data) {
                 var json = jQuery.parseJSON(data);
                 if(json.status == 3){
                     swal('Success!', 'Invitation Resend Successfully!', 'success');
                     jQuery('.inv_btn_'+id+ ' button').text('reinvited').css('background-color',"pink");
                     jQuery('.inv_btn_'+id+ ' button').attr('onclick',"reinvite_message()");
                     jQuery('.inv_status_'+id).text('Resubmitted');
                 }
             },
             error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
             }

         });
     }
 }

 function reinvite_message(){
     alert("Invitation Already Resend!");
 }

 function del_child(cls){

     var r = confirm("Sure to delete?");
     if (r == true) {
         var delid = cls.substr(6);
         var total = jQuery('.tb_ch tr').length;
         var total = total - 1;
         jQuery.ajax({
             url: myAjax.ajaxurl,
             type: 'POST',
             data: {
                 action: 'ajax_parent_delete_child_request',
                 'id': delid,
             },
             success: function (data) {
                 //alert(data);
                 var json = jQuery.parseJSON(data);
                 if (json.status == 1) {
                     swal('Success!', 'Teacher Deletd Successfully!', 'success');
                     jQuery('#td_' + delid).hide();
                     var totall = total - 1;
                     jQuery('#total_child span').text(totall);
                 }
             },
             error: function (errorThrown) {
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }

 function dell_teacher(id){

     var r = confirm("Sure to delete?");
     if (r == true) {


         if (isNaN(id)) {
             alert('unknown error');
         } else {
             //    ajax call to delete teacher
             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type: 'POST',
                 data: {
                     action: 'ajax_delete_teacher',
                     'id': id,
                 },
                 success: function (data) {
                     var json = jQuery.parseJSON(data);
                     if (json.status == 1) {
                         swal('Success!', 'Teacher Deleted Successfully!', 'success');

                         jQuery('.t_row_' + id).hide();
                     }
                 },
                 error: function (errorThrown) {
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }
     }
 }

 jQuery(document).ready(function(){
     jQuery('#teacher_update_profile').click(function(){

         var required = " Required!";
         var error = 0;
         var name = jQuery('input[name="t_name"]');
         var t_no = jQuery('input[name="t_no"]');
         var phone = jQuery('input[name="phone"]');
         var position = jQuery('input[name="position"]');
         var gender = jQuery('input[name="gender"]');
         var address = jQuery('input[name="address"]');
         var email = jQuery('input[name="email"]');
         var password = jQuery('input[name="password"]');
         var file = jQuery('input[name="file"]');
         var class_name = jQuery('select[name="class_name"]');
         var school_type = jQuery('select[name="school_type"]');
         var session = jQuery('select[name="session"]');
         var year = jQuery('select[name="year"]');
         var month = jQuery('select[name="month"]');
         var day = jQuery('select[name="day"]');

         //if(file.val() == "") {
         //    if (file.attr('class') == "") {
         //        file.css('border-top', '2px solid red');
         //        jQuery('.file_err').text(required).css('color', 'red');
         //        var error = +error + +1;
         //    }
         //    else {
         //        file.css('border-top', '2px solid green');
         //        jQuery('.file_err').text("");
         //    }
         //}


         if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }

         if(position.val() == ""){ position.css('border-top', '2px solid red'); jQuery('.pos_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ position.css('border-top', '2px solid green'); jQuery('.pos_err').text(""); }
         //
         if(t_no.val() == ""){ t_no.css('border-top', '2px solid red'); jQuery('.tno_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ t_no.css('border-top', '2px solid green'); jQuery('.tno_err').text(""); }
         //
         if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
         //
         if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
         //
         if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
         else{
             if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
         }
         if(password.val() == ""){ password.css('border-top', '2px solid red'); jQuery('.pass_err').text(' Enter Your Password!').css('color','red'); var  error =+error + +1;}
         else{ password.css('border-top', '2px solid green'); jQuery('.pass_err').text(""); }
         //
         if(session.val() == "0"){ session.css('border-top', '2px solid red'); jQuery('.session_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ session.css('border-top', '2px solid green'); jQuery('.session_err').text(""); }
         //
         if(class_name.val() == "0"){ class_name.css('border-top', '2px solid red'); jQuery('.class_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ class_name.css('border-top', '2px solid green'); jQuery('.class_err').text(""); }
         //
         if(school_type.val() == "0"){ school_type.css('border-top', '2px solid red'); jQuery('.school_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ school_type.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

         // dob
         if(year.val() == "0"){ year.css('border-top', '2px solid red'); var  error =+error + +1;}
         else{ year.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

         if(month.val() == "0"){ month.css('border-top', '2px solid red'); var  error =+error + +1;}
         else{ month.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

         if(day.val() == "0"){ day.css('border-top', '2px solid red'); var  error =+error + +1;}
         else{ day.css('border-top', '2px solid green'); jQuery('.school_err').text(""); }

         if(error < 1){

             var dob = day.val() + "-" + month.val() + "-" + year.val();

             var fd = new FormData();
             var file = jQuery("#trf").find('input[type="file"]');
             var caption = jQuery("#trf").find('input[name=file]');
             var individual_file = file[0].files[0];
             fd.append("file", individual_file);
             var individual_capt = caption.val();
             fd.append("caption", individual_capt);
             fd.append('action', 'ajax_teacher_profile_update_request');
             fd.append('name',name.val());
             fd.append('stu_no',t_no .val());
             fd.append('address', address.val());
             fd.append('phone', phone.val());
             fd.append('email', email.val());
             fd.append('password', password.val());
             fd.append('class_name', class_name.val());
             fd.append('session', session.val());
             fd.append('school_type', school_type.val());
             fd.append('gender', jQuery('input[name=gender]:checked').val()  );
             fd.append('submit','teacher_reg');
             fd.append('dob', dob);
             fd.append('position', position.val());

             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type:'POST',
                 data:fd,
                 cache: false,
                 processData: false, // Don't process the files
                 contentType: false, // Set content type to false

                 success:function(data) {
                     //alert(data);
                     var json = jQuery.parseJSON(data);

                     if(json.data == 1){
                         swal('Success!', 'Record Uploaded Successfully!', 'success');

                     }
                     if(json.data == 2){
                         swal('Erro!', 'Unknown Error!', 'error');
                     }
                     
                 },
                 error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }
     });
 });


 // inviter parent
 function invite_parent(id){

     //alert(id);

     if(isNaN(id)){
         alert('unknown error');
     }else{
         var dataString = {id: id,action:'ajax_invite_parent_request'};   
         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data:dataString,
             success:function(data) {
                 console.log("data ret"+ data);
                 var json = jQuery.parseJSON(data);
                 if(json.status == 1){
                     swal('Success!', 'Invitation Send Successfully!', 'success');
                     jQuery('.inv_btn_'+id+ ' span').text('Reinvite');
                     jQuery('.inv_btn_'+id+ ' span').attr('onclick',"reinvite_parent(this.id)");
                     jQuery('.inv_status_'+id+' .nameMember').after('<p class="p_approval"><i class="fa fa-clock-o"></i> Invitation Pending </p>');
                 }
                 if(json.data == '0'){
                     swal('Error!', 'Unknown Error!', 'error');
                 }
                 console.log(json.link);
             },
             error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }

 function reinvite_parent(id){
     if(isNaN(id)){
         alert('unknown error');
     }else{

         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data:{
                 action:'ajax_reinvite_parent_request',
                 'id':id,
             },
             success:function(data) {
                 //alert(data);
                 console.log(data);
                 var json = jQuery.parseJSON(data);
                 if(json.status == 3){
                     swal('Success!', 'Invitation Resend Successfully!', 'success');
                     //jQuery('.inv_btn_'+id+ ' span').text('reinvited').css('background-color',"pink");
                     //jQuery('.inv_btn_'+id+ ' span').attr('onclick',"reinvite_message()");
                     //jQuery('.inv_status_'+id+' P').text('Resubmitted');
                 }
             },
             error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }

 function dell_parent(id) {
     var r = confirm("Sure to delete?");
     if (r == true) {
         if (isNaN(id)) {
             alert('unknown error');
         } else {
             //    ajax call to delete teacher
             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type: 'POST',
                 data: {
                     action: 'ajax_delete_parent_request',
                     'id': id,
                 },
                 success: function (data) {
                     var json = jQuery.parseJSON(data);
                     if (json.status == 1) {
                         swal('Success!', 'Parent Deleted Successfully!', 'success');

                         jQuery('.t_row_' + id).hide();
                     }
                 },
                 error: function (errorThrown) {
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }
     }
 }
 //############# edit parent
 jQuery(document).ready(function(){
     jQuery('#edit_parent').click(function(){
         var required = " Required!";
         var error = 0;
         var name = jQuery('input[name="stu_name"]');
         var relation = jQuery('select[name="relation"]');
         var phone = jQuery('input[name="phone"]');
          var email = jQuery('input[name="p_email"]');
         var gender = jQuery('input[name="gender"]');
         var address = jQuery('input[name="address"]');
         var file = jQuery('input[name="file"]');
         var password = jQuery('input[name="password"]');
         var id = jQuery('input[name="id"]');

        var email_style = jQuery('#2nd_email').attr('style');
        var phone_style = jQuery('#2nd_phone').attr('style');
        var email2 = jQuery('input[name="p_email2"]');
        var relation2 = jQuery('input[name="relation2"]');
        var phone2 = jQuery('input[name="phone2"]');
        var phone_lable2 = jQuery('input[name="phone_lable2"]');
        var relation1 = jQuery('input[name="relation1"]');
        var phone_lable = jQuery('input[name="phone_lable"]');

        if(email_style == "" || email_style == 'display: block;'){
            //vars

            if(email2.val() == ""){ email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{
                if (emailPattern.test(email2.val()) ==false){email2.css('border-top', '2px solid red'); jQuery('.email2_err').text(' Invalid Email').css('color','red'); var  error =+error + +1;}
                else{  email2.css('border-top','2px solid green'); jQuery('.email2_err').text(''); }
            }
            if(relation2.val() == ""){ relation2.css('border-top', '2px solid red'); jQuery('.relation2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{ relation2.css('border-top', '2px solid green'); jQuery('.relation2_err_').text(""); }
          }

        if(phone_style == "" || phone_style == 'display: block;'){
            if(phone_lable2.val() == ""){ phone_lable2.css('border-top', '2px solid red'); jQuery('.p_l2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{ phone_lable2.css('border-top', '2px solid green'); jQuery('.p_l2_err').text(""); }

            if(phone2.val() == ""){ phone2.css('border-top', '2px solid red'); jQuery('.phone2_err').text(required).css('color','red'); var  error =+error + +1;}
            else{ phone2.css('border-top', '2px solid green'); jQuery('.phone2_err').text(""); }
        }

         if(password.attr('id') == 'true'){

             if(password.val() == ""){ password.css('border-top', '2px solid red'); jQuery('.password_err').text(required).css('color','red'); var  error =+error + +1;}
             else{ password.css('border-top', '2px solid green'); jQuery('.password_err').text(""); }
         }

         //if(file.val() == "") {
         //    if (file.attr('class') == "") {
         //        file.css('border-top', '2px solid red');
         //        jQuery('.file_err').text(required).css('color', 'red');
         //        var error = +error + +1;
         //    }
         //    else {
         //        file.css('border-top', '2px solid green');
         //        jQuery('.file_err').text("");
         //    }
         //}

         if(name.val() == ""){ name.css('border-top', '2px solid red'); jQuery('.name_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ name.css('border-top', '2px solid green'); jQuery('.name_err').text(""); }
         //
          if(phone_lable.val() == ""){ phone_lable.css('border-top', '2px solid red'); jQuery('.p_l_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ phone_lable.css('border-top', '2px solid green'); jQuery('.p_l_err').text(""); }
         //
         if(relation1.val() == ""){ relation1.css('border-top', '2px solid red'); jQuery('.relation1_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ relation1.css('border-top', '2px solid green'); jQuery('.relation1_err').text(""); }
         //
         if(email.val() == ""){ email.css('border-top', '2px solid red'); jQuery('.email_err').text(required).css('color','red'); var  error =+error + +1;}
        else{ 
            if (emailPattern.test(email.val()) ==false){email.css('border-top', '2px solid red'); jQuery('.email_err').text('Invalid Email').css('color','red'); var  error =+error + +1;}
         }
         if(relation.val() == "0"){ relation.css('border-top', '2px solid red'); jQuery('.stuno_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ relation.css('border-top', '2px solid green'); jQuery('.stuno_err').text(""); }
         //
         if(address.val() == ""){ address.css('border-top', '2px solid red'); jQuery('.addr_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ address.css('border-top', '2px solid green'); jQuery('.addr_err').text(""); }
         //
         if(phone.val() == ""){ phone.css('border-top', '2px solid red'); jQuery('.phone_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ phone.css('border-top', '2px solid green'); jQuery('.phone_err').text(""); }
         //

         if(error < 1){

             var fd = new FormData();
             var file = jQuery("#add_stu_form").find('input[type="file"]');
             var caption = jQuery("#add_stu_form").find('input[name=file]');
             var individual_file = file[0].files[0];
             fd.append("file", individual_file);
             var individual_capt = caption.val();
             fd.append("caption", individual_capt);
             fd.append('action', 'ajax_parent_edit_profile_request');
             fd.append('name',name.val());
             fd.append('relation',relation .val());
             fd.append('address', address.val());
             fd.append('phone', phone.val());
             fd.append('gender', jQuery('input[name=gender]:checked').val()  );            
             fd.append('phone_label', phone_lable.val());
             fd.append('email2', email2.val());
             fd.append('relation2', relation2.val());
             fd.append('phone2', phone2.val());
             fd.append('phone_label2', phone2.val());
             fd.append('email', email.val());
             fd.append('relation1', relation1.val());
             fd.append('id', id.val());
             if(password.attr('id') == 'true'){
                 fd.append('password', password.val());
             }
             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type:'POST',
                 data:fd,
                 cache: false,
                 processData: false, // Don't process the files
                 contentType: false, // Set content type to false
                 success:function(data) {
                       //alert(data);
                     var json = jQuery.parseJSON(data);

                     if(json.status == "1"){
                         swal('Success!', 'Record Updated Successfully', 'success');
                     }
                     if(json.pass == "err"){
                         jQuery('.pass_err').text(' Wrong password!').addClass('error');
                         password.css('border-top','2px solid red');
                         //window.location.href="http://brs.noceky.com/edit-parent-profile";
                     }
                 },
                 error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }

     });
 });

// ## delete non roster teacher

 function teacher_dell_nonroster(cls) {

     var r = confirm("Sure to delete?");
     if (r == true) {
         var delid = cls.substr(8);
         var total = jQuery('.tb_ch_non tr').length;
         var total = total - 1;
         jQuery.ajax({
             url: myAjax.ajaxurl,
             type: 'POST',
             data: {
                 action: 'ajax_teacher_dell_nonroster_request',
                 'id': delid,
             },
             success: function (data) {
                 var json = jQuery.parseJSON(data);
                  if (json.status == 1) {
                      swal('Success!', 'Teacher Deleted Successfully!', 'success');
                      jQuery('.nr_' + delid).hide();
                      var totall = total - 1;
                      jQuery('#total_non span').text(totall);
                  }
             },
             error: function (errorThrown) {
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }

 jQuery(document).ready(function(){
     jQuery('#add_activity').click(function(){
         var required = " Required!";
         var error = 0;

         var title = jQuery('input[name="title"]');
         var ins = jQuery('input[name="ins"]');
         var group = jQuery('input[name="group"]');
         var s_date = jQuery('input[name="s_date"]');
         var e_date = jQuery('input[name="e_date"]');
         var time = jQuery('input[name="time"]');
         var cat = jQuery('select[name="cat"]');
         var price = jQuery('input[name="price"]');
         var desc = jQuery('textarea[name="desc"]');
         var file = jQuery('input[name="file"]');

         if(title.val() == ""){ title.css('border-top', '2px solid red'); jQuery('.title_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ title.css('border-top', '2px solid green'); jQuery('.title_err').text(""); }
         //
         if(ins.val() == ""){ ins.css('border-top', '2px solid red'); jQuery('.ins_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ ins.css('border-top', '2px solid green'); jQuery('.ins_err').text(""); }
         //
         if(group.val() == ""){ group.css('border-top', '2px solid red'); jQuery('.group_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ group.css('border-top', '2px solid green'); jQuery('.group_err').text(""); }
         //
         if(s_date.val() == ""){ s_date.css('border-top', '2px solid red'); jQuery('.s_d_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ s_date.css('border-top', '2px solid green'); jQuery('.s_d_err').text(""); }
         //
         if(e_date.val() == ""){ e_date.css('border-top', '2px solid red'); jQuery('.e_date_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ e_date.css('border-top', '2px solid green'); jQuery('.e_date_err').text(""); }
         //
         if(time.val() == ""){ time.css('border-top', '2px solid red'); jQuery('.time_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ time.css('border-top', '2px solid green'); jQuery('.time_err').text(""); }
//
         if(price.val() == ""){ price.css('border-top', '2px solid red'); jQuery('.price_err').text(required).css('color','red');var  error =+error + +1;}
         else{ price.css('border-color', 'green'); jQuery('.price_err').text("");
             if (/\D/g.test( price.val() )) { price.css('border-top', '2px solid red'); jQuery('.price_err').text('Invalid Price').css('color','red');var  error =+error + +1;}
             else{ price.css('border-color', 'green'); jQuery('.price_err').text(""); }
         }
         //
         if(cat.val() == "0"){ cat.css('border-top', '2px solid red'); jQuery('.cat_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ cat.css('border-top', '2px solid green'); jQuery('.cat_err').text(""); }
         //
         if(desc.val() == ""){ desc.css('border-top', '2px solid red'); jQuery('.desc_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ desc.css('border-top', '2px solid green'); jQuery('.desc_err').text(""); }
         //
         //if(file.val() == ""){ file.css('border-top', '2px solid red'); jQuery('.file_err').text(required).css('color','red'); var  error =+error + +1;}
         //else{ file.css('border-top', '2px solid green'); jQuery('.file_err').text(""); }

         if(jQuery("#is_home").is(':checked')){
             var is_home_value = 1;
         }
         if(error < 1 ){
             var fd = new FormData();
             //var file = jQuery("#trf").find('input[type="file"]');
             var caption = jQuery("#trf").find('input[name=file]');
             var individual_file = jQuery("#imgInp").prop("files")[0];
             fd.append("file", individual_file);
             var individual_capt = caption.val();
             fd.append("caption", individual_capt);
             fd.append('action', 'ajax_add_activity_request');
             fd.append('title',title.val());
             fd.append('ins',ins.val());
             fd.append('s_date', s_date.val());
             fd.append('e_date', e_date.val());
             fd.append('time', time.val());
             fd.append('cat', cat.val());
             fd.append('price', price.val() );
             fd.append('submit','add_act');
             fd.append('desc',desc.val());
             fd.append('group',group.val());
             fd.append('is_home',is_home_value);

             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type:'POST',
                 data:fd,
                 cache: false,
                 processData: false, // Don't process the files
                 contentType: false, // Set content type to false

                 success:function(data) {
                     alert(data);
                     var json = jQuery.parseJSON(data);
                     if(json.data == 1){
                         swal('Success!', 'Record Inserted Successfully!', 'success');
                         jQuery("#trf")[0].reset();
                         //window.location.href="http://brs.noceky.com/teacher-activities/";
                     }
                     if(json.data == 'err'){
                         swal('Error!', 'Unknown error!', 'error');
                     }
                 },
                 error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }

     });
 });

function delete_activity(){

    var r = confirm("Sure to delete?");
    if (r == true) {

        var ids = jQuery('.select_box:checkbox:checked').map(function () {
            jQuery('.select_box:checkbox:checked').closest('tr').hide(600);
            return this.value;
        }).get().join(',');

        if (ids == "") {
            swal('Error!', 'Please Select Record ', 'error');
        } else {

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'ajax_delete_activity_request',
                    'id': ids,
                },
                success: function (data) {
                    var json = jQuery.parseJSON(data);
                    if (json.status == 1) {
                        swal('Success!', 'Record Deleted Successfully!', 'success');
                    }
                    if (json.status == 'err') {
                        swal('Error!', 'Unknown error!', 'error');
                    }
                },
                error: function (errorThrown) {
                    swal('Error!', errorThrown, 'error');
                }
            });
        }
    }
}

 jQuery(document).ready(function (e) {
    jQuery('.find_act').click(function () {

        var from = jQuery('input[name="from"]').val();
        var search = jQuery('input[name="search"]').val();
        var type = jQuery('select[name="type"]').val();
        var type_id = jQuery('select[name="type"]').children(":selected").attr("id");
		//jQuery('.collapse').removeClass('collapse').removeClass('in').addClass('collapse');
		
		jQuery('.accordion-body').removeAttr('style');		
		jQuery('.in').removeClass('in');
		jQuery('.collapse').removeClass('collapse');
		jQuery('.accordion-body').addClass('collapse');
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type:'POST',
            data: {
                action: 'ajax_search_activity_request',
                'from': from,
                'param': search,
                'type': type,
                'type_id':type_id
            },
             success:function(data) {
               // alert(type_id);
               /* jQuery('.show').removeClass('show');
                jQuery('#type_'+type_id).addClass('show');
                //alert(type_id);
                jQuery('.type_'+type_id).html(data);*/			
				//jQuery('.collapse').addClass('collapse');
				
				jQuery('#collapse'+type_id).removeClass('collapse').addClass('in');
               // jQuery('#collapse'+type_id).addClass('in');
                //alert(type_id);
				jQuery('#collapse'+type_id).css('height', 'auto');
                jQuery('.collapse'+type_id).html(data);
            },
            error: function(errorThrown){
                swal('Error!', errorThrown, 'error');
            }
        });
    });

     //add another email toggle div
     jQuery('.add_email').click(function(){
         jQuery('#2nd_email').toggle();

         var email_style = jQuery('#2nd_email').attr('style');
         if(email_style == "" || email_style == 'display: block;'){
             jQuery(this).text(' Delete Secondary Email');
             jQuery('input[name="p_email2"]').val('');
             jQuery('input[name="relation2"]').val('');
         }else{
             jQuery(this).text('Add Secondary Email');
         }
     });
     //2nd phone //add another phone toggle div    var phone_style = jQuery('#2nd_phone').attr('style');
     jQuery('.add_phone').click(function(){
         jQuery('#2nd_phone').toggle();
         var phone_style = jQuery('#2nd_phone').attr('style');
         if(phone_style == "" || phone_style == 'display: block;'){
             jQuery(this).text(' Delete Secondary Phone');
             jQuery('input[name="phone2"]').val('');
             jQuery('.del_phone').hide();
             jQuery('input[name="phone_lable2"]').val('');
         }else{
             jQuery(this).text('Add Secondary Phone');
             jQuery('.del_phone').show();
         }
     });

     jQuery('.teacher_change_password').click(function (e) {

         var o_pass = jQuery('input[name="old_password"]');
         var n_pass = jQuery('input[name="new_password"]');
         var c_pass = jQuery('input[name="c_new_password"]');

         var required = " Required";
         var error = 0;

         if(o_pass.val() == ""){ o_pass.css('border-top', '2px solid red'); jQuery('.o_pass_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ o_pass.css('border-top', '2px solid green'); jQuery('.o_pass_err').text(""); }

         if(n_pass.val() == ""){ n_pass.css('border-top', '2px solid red'); jQuery('.n_pass_err').text(required).css('color','red'); var  error =+error + +1;}
         else{
             if(n_pass.val().length < 6 ){ n_pass.css('border-top', '2px solid red'); jQuery('.n_pass_err').text(' Lenth should be grater than 6').css('color','red');var  error =+error + +1;
             }else{
                 n_pass.css('border-color', 'green'); jQuery('.n_pass_err').text("");
                 if(n_pass.val() != c_pass.val()){ o_pass.css('border-top', '2px solid red'); jQuery('.c_pass_err').text("Confirm New Password").css('color','red'); var  error =+error + +1;}
                 else{ c_pass.css('border-top', '2px solid green'); jQuery('.c_pass_err').text(""); }
             }
         }

         if( error < 1 ){
             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type:'POST',
                 data: {
                     action: 'ajax_teacher_reset_password_request',
                     'old_pass': o_pass.val(),
                     'new_pass': n_pass.val(),
                 },
                 success:function(data) {
                     // alert(data);
                         var json = jQuery.parseJSON(data);
                     if(json.data == "1"){
                         swal('Success!', 'Password Changed Successfully', 'success');
                         jQuery(".update_t")[0].reset();

                     }else if(json.data == "2"){
                         jQuery('.o_pass_err').html('Wrong password!').addClass('error');
                     }else if(json.data == "err"){
                        jQuery('.o_pass_err').html('Wrong password!').addClass('error');
                     }
                 },
                 error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }
});
     jQuery('.parent_change_password').click(function (e) {

         var o_pass = jQuery('input[name="old_password"]');
         var n_pass = jQuery('input[name="new_password"]');
         var c_pass = jQuery('input[name="c_new_password"]');

         var required = " Required";
         var error = 0;

         if(o_pass.val() == ""){ o_pass.css('border-top', '2px solid red'); jQuery('.o_pass_err').text(required).css('color','red'); var  error =+error + +1;}
         else{ o_pass.css('border-top', '2px solid green'); jQuery('.o_pass_err').text(""); }

         if(n_pass.val() == ""){ n_pass.css('border-top', '2px solid red'); jQuery('.n_pass_err').text(required).css('color','red'); var  error =+error + +1;}
         else{
             if(n_pass.val().length < 6 ){ n_pass.css('border-top', '2px solid red'); jQuery('.n_pass_err').text(' Lenth should be grater than 6').css('color','red');var  error =+error + +1;
             }else{
                 n_pass.css('border-color', 'green'); jQuery('.n_pass_err').text("");
                 if(n_pass.val() != c_pass.val()){ o_pass.css('border-top', '2px solid red'); jQuery('.c_pass_err').text("Confirm New Password").css('color','red'); var  error =+error + +1;}
                 else{ c_pass.css('border-top', '2px solid green'); jQuery('.c_pass_err').text(""); }
             }
         }

         if( error < 1 ){
             jQuery.ajax({
                 url: myAjax.ajaxurl,
                 type:'POST',
                 data: {
                     action: 'ajax_parent_reset_password_request',
                     'old_pass': o_pass.val(),
                     'new_pass': n_pass.val(),
                 },
                 success:function(data) {
                     //alert(data);
                     var json = jQuery.parseJSON(data);
                     if(json.data == "1"){
                         swal('Success!', 'Password Changed Successfully', 'success');
                         jQuery(".update_t")[0].reset();

                     }else if(json.data == "2"){
                         jQuery('.o_pass_err').html('Wrong password!').addClass('error');
                     }else if(json.data == "err"){
                        jQuery('.o_pass_err').html('Wrong password!').addClass('error');
                     }
                 },
                 error: function(errorThrown){
                     swal('Error!', errorThrown, 'error');
                 }
             });
         }
     });



 });// end document ready function


 function submit_report_card(id){

     var category = jQuery('#cat'+id).val();
     var stu_id = jQuery('#stu_id').val();

     var fd = new FormData();
     var file = jQuery("#form"+id).find('input[type="file"]');
     var caption = jQuery("#form"+id).find('input[name=image]');
     var individual_file = file[0].files[0];
     fd.append("file", individual_file);
     var individual_capt = caption.val();
     fd.append("caption", individual_capt);
     fd.append('action', 'ajax_teacher_report_card_request');
     fd.append('category', category);
     fd.append('stu_id', stu_id);

     var name = "";
     jQuery.ajax({
         url: myAjax.ajaxurl,
         type:'POST',
         data:fd,
         cache: false,
         processData: false, // Don't process the files
         contentType: false, // Set content type to false

         success:function(data) {
                //alert(data);
             swal('Success!', 'Record Uploaded Successfully!', 'success');
             jQuery('#panel'+id).addClass('show');
             jQuery('#download_list'+id+' li:last-child').after(data);
         },
         error: function(errorThrown){
             swal('Error!', errorThrown, 'error');
         }
     });

 }

 function delete_family_member(id){
     var r = confirm("Sure to delete?");
     if (r == true) {

         jQuery.ajax({
             url: myAjax.ajaxurl,
             type:'POST',
             data: {
                 action: 'ajax_delete_family_request',
                 'id': id,

             },
             success:function(data) {
                 //alert(data);
                 var json = jQuery.parseJSON(data);
                 if(json.data == "1") {
                     swal('Success!', 'Password Changed Successfully', 'success');
                     jQuery('.fam_' + id).hide();

                 }else if(json.data == "2"){
                     swal('Error!', 'Unknown error', 'error');
                 }else if(json.data == "3"){
                     swal('Error!', "You haven't permission to delete! ", 'error');
                 }

             },
             error: function(errorThrown){
                 swal('Error!', errorThrown, 'error');
             }
         });
     }
 }

function del_email_1() {
    jQuery('input[name="phone"]').val('');
    jQuery('input[name="phone_lable"]').val('');
}
 function del_email_2() {
     jQuery('input[name="phone2"]').val('');
     jQuery('input[name="phone_lable2"]').val('');
 }

 jQuery(document).ready(function () {
    jQuery('#send_messages').click(function(){
        var error=0;
        jQuery('.error').hide();
        var subject = jQuery('input[name="subject"]');
        var email = jQuery('input[name="email"]');
        var email = jQuery('.nicEdit-main');
        var roster_ids = jQuery('.r_c:checkbox:checked').map(function() {
            return this.value;
        }).get().join(',');

        var nonroster_ids = jQuery('.nr_c:checkbox:checked').map(function() {
            return this.value;
        }).get().join(',');

        if(subject.val() == ""){ subject.css('border-top', '2px solid red'); jQuery('.sub_err').text('Required!').css('color','red'); var  error =+error + +1;}
        else{ subject.css('border-top', '2px solid green'); jQuery('.sub_err').text(""); }

        if(email.html() == "<br>"){ jQuery('.email_err').text('Required').css('color','red'); var  error =+error + +1;}
        else{ jQuery('.email_err').text(""); }

        if(roster_ids == "" && nonroster_ids == "" ){
            jQuery('.roster_check h5').before('<small class="error">Please chose recipients!</small>');
        }

        var fd = new FormData();
        var file = jQuery("#form").find('input[type="file"]');
        var caption = jQuery("#form").find('input[name=file]');
        var individual_file = file[0].files[0];
        fd.append("file", individual_file);
        var individual_capt = caption.val();
        fd.append("caption", individual_capt);
        fd.append('action', 'ajax_teacher_send_message_request');
        fd.append('subject', subject.val());
        fd.append('email', email.html());
        fd.append('roster_id', roster_ids);
        fd.append('nonroster_id', nonroster_ids);


        if(error < 1 ) {

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type: 'POST',
                data: fd,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false

                success: function (data) {
                    //alert(data);
                    var json = jQuery.parseJSON(data);
                    if (json.data == 1) {
                        swal('Success!', 'Email send Successfully!', 'success');
                        jQuery("#form")[0].reset();
                        email.html('');
                        //window.location.href="http://brs.noceky.com/teacher-activities/";
                    }
                    if (json.data == 'err') {
                        swal('Error!', 'Unknown error!', 'error');
                    }
                },
                error: function (errorThrown) {
                    swal('Error!', errorThrown, 'error');
                }
            });

        }
    }) ;
    
    
    jQuery('#send_reply_messages').click(function(){
        var error=0;
        jQuery('.error').hide();
        var subject = jQuery('input[name="subject"]');
        //var message = jQuery('input[name="message"]');
        var message = jQuery('.nicEdit-main');
        var to_email = jQuery('#to_email');
        var to_id = jQuery('#to_id');
        var to_name = jQuery('#to_name');
        var from_email = jQuery('#from_email-main');
        var from_id = jQuery('#from_id');
        var from_name = jQuery('#from_name');
        
        if(subject.val() == ""){ subject.css('border-top', '2px solid red'); jQuery('.sub_err').text('Required!').css('color','red'); var  error =+error + +1;}
        else{ subject.css('border-top', '2px solid green'); jQuery('.sub_err').text(""); }

        if(message.html() == "<br>"){ jQuery('.email_err').text('Required').css('color','red'); var  error =+error + +1;}
        else{ jQuery('.email_err').text(""); }

        var fd = new FormData();
        var file = jQuery("#form").find('input[type="file"]');
        var caption = jQuery("#form").find('input[name=file]');
        var individual_file = file[0].files[0];
        fd.append("file", individual_file);
        var individual_capt = caption.val();
        fd.append("caption", individual_capt);
        fd.append('action', 'ajax_teacher_send_reply_message_request');
        fd.append('subject', subject.val());
        fd.append('message', message.html());
        fd.append('to_email', to_email.val());
        fd.append('to_id', to_id.val());
        fd.append('to_name', to_name.val());
        fd.append('from_email', to_email.val());
        fd.append('from_id', to_id.val());
        fd.append('from_name', to_name.val());

        if(error < 1 ) {

            jQuery.ajax({
                url: myAjax.ajaxurl,
                type: 'POST',
                data: fd,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false

                success: function (data) {
                    //alert(data);
                    var json = jQuery.parseJSON(data);
                    if (json.data == 1) {
                        swal('Success!', 'Email send Successfully!', 'success');
                        jQuery("#form")[0].reset();
                        email.html('');
                        //window.location.href="http://brs.noceky.com/teacher-activities/";
                    }
                    if (json.data == 'err') {
                        swal('Error!', 'Unknown error!', 'error');
                    }
                },
                error: function (errorThrown) {
                    swal('Error!', errorThrown, 'error');
                }
            });

        }
    }) ;
    
 });

 function is_home_gallery(id, table){
    if(isNaN(id)){
         alert('unknown error');
     }else{
        var fd = new FormData();
        fd.append('action', 'ajax_teacher_gallert_is_home_request');
            fd.append('id', id);
            

        jQuery.ajax({
                    url: myAjax.ajaxurl,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false

                    success: function (data) {
                        var json = jQuery.parseJSON(data);
                    if (json.data == 'err') {
                        swal('Error!', 'Unknown Error!', 'error');         
                    }              
                        
                    },
                    error: function (errorThrown) {
                        swal('Error!', errorThrown, 'error');
                    }
                });
        }   
 }