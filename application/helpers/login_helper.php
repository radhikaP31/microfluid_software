<?php
function is_logged_in()
{
    $CI = get_instance();
    if (!$CI->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $CI->session->userdata('role_id');
        $menu = $CI->uri->segment(1);
        $url = $CI->uri->segment(2) ? $menu.'/'.$CI->uri->segment(2) : $menu;
        
        $queryMenu = $CI->db->where("url LIKE '$url%'")->get('user_sub_menu')->row_array();

        if($queryMenu){
            $menu_id = $queryMenu['id'];
        
            //$queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
            //$menu_id = $queryMenu['id'];
            
            $userAccess = $CI->db->get_where('user_access_menu', ['role_id' => $role_id, 'sub_menu_id' => $menu_id]);

            if ($userAccess->num_rows() < 1) {
                redirect('auth/blocked');
            }
        }
        
    }
}

function check_access($role_id, $menu_id)
{
    $CI = get_instance();
    $CI->db->where('role_id', $role_id);
    $CI->db->where('menu_id', $menu_id);
     $CI->db->where('sub_menu_id IS NULL or sub_menu_id=0 ');
    $result = $CI->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_submenu_access($role_id, $menu_id)
{
    $CI = get_instance();
    $CI->db->where('role_id', $role_id);
    $CI->db->where('sub_menu_id', $menu_id);
    $result = $CI->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}



function active_check($is_active, $submenu_id)
{
    $CI = get_instance();
    $CI->db->where('is_active', $is_active);
    $CI->db->where('id', $submenu_id);
    $result = $CI->db->get('user_sub_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
