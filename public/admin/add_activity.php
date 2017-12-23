<?php

function add_activity_options(){

    $_SESSION['teacher'] = 3;
    if(!isset($_SESSION['teacher'])){
        echo '<script>window.location="'.get_site_url().'/login";</script>';
    }
    $activity_category = noceky_brs_common::activity_category();

    wp_enqueue_style( 'datapickercss', plugin_dir_url( FILE ) . 'teacher/css/dp-style.css', array(), get_bloginfo('version'), '' );
    wp_enqueue_script( 'sweetalertjs', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker.js', array( 'jquery' ), get_bloginfo('version'), false );
    wp_enqueue_script( 'sweetalertjs2', plugin_dir_url( FILE ) . 'teacher/js/jq-datapicker2.js', array( 'jquery' ), get_bloginfo('version'), false );
?>
<!-- html -->
    <script>
        jQuery( function() {
            jQuery( "#s_date" ).datepicker();
            jQuery( "#e_date" ).datepicker();
        } );
    </script>


    <div>
        <div class="title">
            <p style="width: 38.4%;">Add Activity</p>
        </div>
        <table>
        <form id="trf">
        <tr>
            <td>
                <label> Image </label>
            </td>
            <td>
                <small class="file_err"></small>
                <input type="file" name="file" id="imgInp" >
                <img style="display: none;" id="img_disp" src="#" alt="your image" />
            </td>
        </tr>
        <tr>
            <td>
                <label> Title </label>
            </td>
            <td>
            <small class="title_err"></small>
            <input type="text" name="title">
            </td>

        </tr>
        <tr>
            <td>
                <label> Instructor </label>
            </td>
            <td>
            <small class="ins_err"></small>
            <input type="text" name="ins">
            </td>
        </tr>
        <tr>
            <td>
                <label> Group </label>
            </td>
            <td>
                <small class="group_err"></small>
                <input type="text" name="group">
            </td>
        </tr>
        <tr>
            <td>
                <label> Price </label>
            </td>
            <td>
                <small class="price_err"></small>
                <input type="text" name="price">
            </td>
        </tr>
        <tr>
            <td>
                <label>Start Date</label>
            </td>
            <td>
                <small class="s_d_err"></small>
                <input type="text" name="s_date" id="s_date">
            </td>
        </div>

        <tr>
            <td>
                <label> End Date </label>
            </td>
            <td>
                <small class="e_date_err"></small>
                <input type="text" name="e_date" id="e_date">
            </td>
        </tr>

        <tr>
            <td>
                <label> Time</label>
            </td>
        <td>
            <small class="time_err"></small>
            <input type="text"  name="time" style="width: 60%">
            </td>
        </tr>

        <tr>
            <td>
                <label> Activity </label>
            </td>
            <td>
                <small class="cat_err"></small>
                <select name="cat" style="width: 60%">
                    <option value="0">Select Activity</option>
                <?php foreach($activity_category as $value){?>
                   <option <?php if(base64_decode( $_GET['cat'])== $value){echo 'selected';} ?> value="<?= $value ?>"><?= $value ?></option>
               <?php } ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label> Description </label>
            </td>
            <td>
                <small class="desc_err"></small>
                <textarea name="desc" rows="5"></textarea>
            </td>
        </tr>
        </tr>
            <td></td>
            <td>
            <input type="checkbox" value="1" name="is_home" ><label for="is_home"> Is Home</label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
              <button type="button" id="add_activity"> Submit </button>
            </td>
        </tr>
    </form>
    </table>
</div>

<?php
}