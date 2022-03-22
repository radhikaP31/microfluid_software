<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Setting_model', 'settings');
    }
    public function index($setting_id=0)
    {

        $data['title'] = 'Setting';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['settings'] = $this->db->get_where('settings', ['id' => $setting_id])->row_array();

        if (!$this->input->post('website_title') && !$this->input->post('approved_client') && !$this->input->post('approved_coach')) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('setting/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->settings->replaceSettings($setting_id,$this->input->post('website_title'),$this->input->post('approved_client'),$this->input->post('approved_coach'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Setting Updated!! </div>');
            redirect('settings/index/'.$setting_id);
        }
    }
}
