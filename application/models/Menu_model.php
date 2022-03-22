<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu FROM user_sub_menu JOIN user_menu ON user_sub_menu.menu_id = user_menu.id";
        return $this->db->query($query)->result_array();
    }


    public function showMenu($role_id)
    {
        $queryMenu = "SELECT user_menu.id, menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE user_access_menu.role_id =  $role_id ORDER BY user_access_menu.menu_id ASC";
        return $this->db->query($queryMenu)->result_array();
    }
    
    public function showMenuByRole($role_id) {
         $queryMenu = "SELECT user_menu.id, menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE ( user_access_menu.sub_menu_id IS NULL or user_access_menu.sub_menu_id=0) and user_access_menu.role_id =  $role_id ORDER BY user_access_menu.menu_id ASC";
        return $this->db->query($queryMenu)->result_array();
    }
    
    public function showSubMenuByRole($menu_id , $role_id) {
         $queryMenu = "SELECT user_sub_menu.* FROM user_sub_menu JOIN user_access_menu ON user_sub_menu.id = user_access_menu.sub_menu_id WHERE user_access_menu.menu_id=$menu_id and user_access_menu.role_id =  $role_id group by user_sub_menu.id ORDER BY user_sub_menu.id ASC ";
         
        return $this->db->query($queryMenu)->result_array();
    }

    public function showSubMenu($menuId)
    {
        $querySubMenu = "SELECT * FROM user_sub_menu  WHERE menu_id = $menuId AND is_active = 1";
        return $this->db->query($querySubMenu)->result_array();
    }
    // User Menu
    public function getUserMenuAll()
    {
        return $this->db->get_where('user_menu')->result_array();
    }
     // User Sub Menu
    public function getUserSubMenuAll()
    {
        $menus = $this->db->get_where('user_sub_menu', ['is_active =' => 1])->result_array();
        $all_menus=[];
        foreach($menus as $menu) {
            $all_menus[$menu['menu_id']][] = $menu;
        }
        return $all_menus;
    }
}
