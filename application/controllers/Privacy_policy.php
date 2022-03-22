<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privacy_policy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Privacy_policy_model', 'privacy_policy');
    }
    public function index($policy_id=0)
    {

        $data['title'] = 'Privacy Policy';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['privacy_policy'] = $this->db->get_where('privacy_policy', ['id' => $policy_id])->row_array();

        if (!$this->input->post('privacy_policy') && !$this->input->post('terms_condition')) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('privacy_policy/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->privacy_policy->replacePolicy($policy_id,$this->input->post('privacy_policy'),$this->input->post('terms_condition'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Privacy Policy Updated!! </div>');
            redirect('privacy_policy/index/'.$policy_id);
        }
    }
}
