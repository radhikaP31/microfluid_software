<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getTableDetails($view_name=null)
{
   
    if($view_name){
    	$ci = &get_instance();

   		$ci->db->select('*');
		$result = $ci->db->get($view_name)->result_array();
    }
    return $result;
}

/**
 * Function for show side menus by user role
 * @param   int         $role_id         The role_id to search user menu
 * @return  array       False if no matches,array otherwise
 * */
function showMenuByRole($role_id=0) {
    $ci = &get_instance();
    if($ci->session->userdata('role_id')){
        $role_id = $ci->session->userdata('role_id');
    }
    $queryMenu = "SELECT user_menu.id, menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE ( user_access_menu.sub_menu_id IS NULL or user_access_menu.sub_menu_id=0) and user_access_menu.role_id =  $role_id ORDER BY user_access_menu.menu_id ASC";
    return $ci->db->query($queryMenu)->result_array();
}
/**
 * Multi string position detection. Returns the first position of $check found in
 * $str or an associative array of all found positions if $getResults is enabled.
 *
 * Always returns boolean false if no matches are found.
 *
 * @param   string         $str         The string to search
 * @param   string|array   $check       String literal / array of strings to check
 * @param   boolean        $getResults  Return associative array of positions?
 * @return  boolean|int|array           False if no matches, int|array otherwise
 */
function multi_strpos($string, $check)
{
    $result = array();

    foreach ($check as $s) {
        $pos = strpos($string, $s);
        if ($pos !== false) {
            $result[$s] = $pos;
        }

    }
    return $result;
}

if (!function_exists('setTextBoxControlCustom')) {
    function setTextBoxControlCustom($controlLabel, $controlName, $controlId = "", $controlValue = null, $isMandatory = true, $isHidden = false, $options = null)
    {
        //OPTIONAS
        /*attr, decrypt, class, style, parentClass, parentAttr, after, before, type, helptext
        class options for datepicker => 'datepicker', 'timepicker', 'datetimepicker'
        type options => password, text, 
        */
        $ci = get_instance();
        if (isset($options['attr']) and !empty($options['attr'])) {
            $attr = $options['attr'];
        } else {
            $attr = '';
        }

        if (isset($options['decrypt']) and !empty($options['decrypt'])) {
            $decrypt = $options['decrypt'];
        } else {
            $decrypt = '';
        }

        if (isset($options['class']) and !empty($options['class'])) {
            $class = $options['class'];
        } else {
            $class = '';
        }

        if (isset($options['style']) and !empty($options['style'])) {
            $style = $options['style'];
        } else {
            $style = '';
        }

        if (isset($options['parentClass']) and !empty($options['parentClass'])) {
            $parentClass = $options['parentClass'];
        } else {
            $parentClass = '';
        }

        if (isset($options['parentAttr']) and !empty($options['parentAttr'])) {
            $parentAttr = $options['parentAttr'];
        } else {
            $parentAttr = '';
        }

        if (isset($options['after']) and !empty($options['after'])) {
            $after = $options['after'];
        } else {
            $after = false;
        }

        if (isset($options['before']) and !empty($options['before'])) {
            $before = $options['before'];
        } else {
            $before = false;
        }

        if (isset($options['type']) and !empty($options['type'])) {
            $type = $options['type'];
        } else {
            $type = 'text';
        }

        if (isset($options['helptext']) and !empty($options['helptext'])) {
            $helptext = $options['helptext'];
        } else {
            $helptext = '';
        }

        $positions = multi_strpos($class, array('datepicker', 'timepicker', 'datetimepicker'));
        if (count($positions) > 0) {
            $attr = str_replace('readonly', $attr) . ' readonly';
        }

        if ($ci->input->post($controlName)) {
            $controlValue = $ci->input->post($controlName);
        }

        $ogControlValue = $controlValue;
        if (isset($positions['datepicker'])) {
            $controlValue = convertToSystemDateFormat($ogControlValue);
        }

        if ($decrypt) {
            if (!is_numeric($controlValue)) {
                $decryptedValue = encrypt_decrypt('decrypt', $controlValue);
                $controlValue = empty($decryptedValue) ? 0 : $decryptedValue;
            }
        }

        ob_start();
        ?>
<!--start Of div-->
<div class="form-group row <?php echo $parentClass; ?> <?php if (form_error($controlName)) {
            echo 'error';
        }
        ?> <?php if ($isHidden == true) {
            echo 'hidden';
        }
        ?>" <?php echo $parentAttr; ?>>

    <label class="col-sm-3 col-form-label"><?php echo $controlLabel; ?><?php if ($isMandatory == true) {?>
        <span style="color:red;">*</span>
    <?php }?></label>

    <div class="col-sm-9">
        <?php echo $before ?>
        <input class="form-control <?php echo $class; ?>" style="<?php echo $style;if ($after) {
            echo 'float:left';
        }
        ?>" <?php echo $attr; ?> id="<?php echo $controlId; ?>" name="<?php echo $controlName; ?>" type="<?php echo $type; ?>" value="<?php echo $controlValue; ?>">
        <?php if ($type == 'password') {?>
            <span toggle="#<?php echo $controlId; ?>" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        <?php }?>
        <?php if (isset($positions['datepicker'])) {?>
            <input type="hidden" id="<?php echo $controlName; ?>_ID" name="<?php echo $controlName; ?>" value="<?php echo $ogControlValue ?>">
        <?php }?>
        <?php echo $after ?>
        <div class="clearfix"></div>
        <span class="help-text"><p><?php echo $helptext; ?></p></span>
        <span class="help-inline">
            <?php echo form_error($controlName); ?>
        </span>
    </div>
</div>
<!--end Of div-->
<?php
return ob_get_clean();

    }
}

if (!function_exists('add_employee_modal')) {
    function add_employee_modal($id = 0, $cmp_cd=null)
    {
        ob_start();?>
        <?php $CI = &get_instance();

        $modal = '<div class="modal " id="add_employee_modal" tabindex="-1" role="dialog" aria-labelledby="add_item" aria-hidden="true">

                <div class="modal-dialog modal-md" role="document" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title" id="item_heading">Add Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding:10px 20px;">
                            <form action="#" method="post" id="addEmployee">' .
            setTextBoxControlCustom('Employee Name', 'emp_name', 'emp_name', '', 1, 0) .
            setTextBoxControlCustom('Employee Contact', 'emp_contact', 'emp_contact', '', 1, 0) .
            setTextBoxControlCustom('Employee Email', 'emp_email', 'emp_email', '', 1, 0) .
            setTextBoxControlCustom('Employee Position', 'emp_position', 'emp_position', '', 1, 0) .
            setTextBoxControlCustom('Employee Department', 'emp_department', 'emp_department', '', 1, 0) .
                            '</form>
                        </div>
                        <input type="hidden" class="form-control" id="company_id" name="company_id"  value=' . $id . ' readonly>
                        <input type="hidden" class="form-control" id="company_cd" name="company_cd"  value=' . $cmp_cd . ' readonly>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary add_new_item" id="add_new_item">Add Employee</button>
                            <button class="btn btn-sm btn-success save_add" id="save_add">Save and Add</button>
                        </div>
                    </div>
                </div>
              </div>';

        return $modal;
    }
}
if (!function_exists('setHTMLEditorControlCustom')) {
    function setHTMLEditorControlCustom($controlLabel, $controlName, $controlId = "", $controlValue = null, $isMandatory = true, $isHidden = false, $options = null)
    {
        //OPTIONAS
        /*attr, decrypt, class, style, parentClass, parentAttr, after, before, type, helptext
        */
        $ci = get_instance();
        if (isset($options['attr']) and !empty($options['attr'])) {
            $attr = $options['attr'];
        } else {
            $attr = '';
        }

        if (isset($options['decrypt']) and !empty($options['decrypt'])) {
            $decrypt = $options['decrypt'];
        } else {
            $decrypt = '';
        }

        if (isset($options['class']) and !empty($options['class'])) {
            $class = $options['class'];
        } else {
            $class = '';
        }

        if (isset($options['style']) and !empty($options['style'])) {
            $style = $options['style'];
        } else {
            $style = '';
        }

        if (isset($options['parentClass']) and !empty($options['parentClass'])) {
            $parentClass = $options['parentClass'];
        } else {
            $parentClass = '';
        }

        if (isset($options['parentAttr']) and !empty($options['parentAttr'])) {
            $parentAttr = $options['parentAttr'];
        } else {
            $parentAttr = '';
        }

        if (isset($options['after']) and !empty($options['after'])) {
            $after = $options['after'];
        } else {
            $after = false;
        }

        if (isset($options['before']) and !empty($options['before'])) {
            $before = $options['before'];
        } else {
            $before = false;
        }

        if (isset($options['type']) and !empty($options['type'])) {
            $type = $options['type'];
        } else {
            $type = 'text';
        }

        if (isset($options['helptext']) and !empty($options['helptext'])) {
            $helptext = $options['helptext'];
        } else {
            $helptext = '';
        }

        $positions = multi_strpos($class, array('datepicker', 'timepicker', 'datetimepicker'));
        if (count($positions) > 0) {
            $attr = str_replace('readonly', $attr) . ' readonly';
        }

        if ($ci->input->post($controlName)) {
            $controlValue = $ci->input->post($controlName);
        }

        if ($decrypt) {
            if (!is_numeric($controlValue)) {
                $decryptedValue = encrypt_decrypt('decrypt', $controlValue);
                $controlValue = empty($decryptedValue) ? 0 : $decryptedValue;
            }
        }

        ob_start();
        ?>
<!--start Of div-->
<div class="form-group row <?php echo $parentClass; ?> <?php if (form_error($controlName)) {
            echo 'error';
        }
        ?> <?php if ($isHidden == true) {
            echo 'hidden';
        }
        ?>" <?php echo $parentAttr; ?>>

    <label class="col-sm-3 col-form-label"><?php echo $controlLabel; ?><?php if ($isMandatory == true) {?>
        <span style="color:red;">*</span>
    <?php }?></label>

    <div class="col-sm-9">
        <?php echo $before ?>
        <textarea class="form-control <?php echo $class; ?>" style="<?php echo $style;if ($after) {
            echo 'float:left';
        }
        ?>" <?php echo $attr; ?> id="<?php echo $controlId; ?>" name="<?php echo $controlName; ?>" type="<?php echo $type; ?>" value="<?php echo $controlValue; ?>"><?php echo $controlValue; ?></textarea>
        <?php echo $after ?>
        <div class="clearfix"></div>
        <span class="help-text"><p><?php echo $helptext; ?></p></span>
        <span class="help-inline">
            <?php echo form_error($controlName); ?>
        </span>
        <script>
                CKEDITOR.replace('<?php echo $controlName; ?>');
        </script>
    </div>
</div>
<!--end Of div-->
<?php
return ob_get_clean();

    }
}
?>