<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_type extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Common_type_model', 'common_type');
    }
    public function index()
    {

        $data['title'] = 'Common Type';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['masters'] = $this->db->get('independent_mst')->result_array();

        $data['common_types'] = $this->db->get('common_type')->result_array();


        $this->form_validation->set_rules('type_cd', 'Common Type Code', 'required|callback_CheckTypeCodeExist');
        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('common_type/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->common_type->insertType($this->input->post('type_cd'),$this->input->post('title'),$this->input->post('description'),$this->input->post('parent_id'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Common Type added!</div>');
            redirect('common_type');
        }
    }

    public function editType($type_id)
    {
        $data['title'] = 'Edit Common Type';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['common_type'] = $this->db->get_where('common_type', ['id' => $type_id])->row_array();        

        $this->form_validation->set_rules('type_cd', 'Common Type Code', 'required|callback_CheckTypeCodeExist');
        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('common_type/edit-common_type', $data);
            $this->load->view('templates/footer');
        } else {
            
            $this->common_type->updateType($mstr_id,$this->input->post('type_cd'),$this->input->post('title'),$this->input->post('description'),$this->input->post('parent_id'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Common Type Success!</div>');
            redirect('common_type');
        }
    }

    public function deleteType($type_id)
    {
        $common_type = $this->db->get_where('common_type', ['id' => $type_id])->row_array();

        $this->db->delete('common_type', ['id' => $type_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $common_type['title'] . ' Common Type is deleted!</div>');
        redirect('common_type');
    }

    public function CheckTypeCodeExist($type_cd='',$type_id=''){

        if($type_id){
            $this->db->where_not_in('id', $type_id);
        }

        $this->db->where('type_cd', $type_cd);

        $id = $this->db->get('common_type')->first_row()->id;

        if ($id) {
            $this->form_validation->set_message('CheckTypeCodeExist', 'This Type code already exists');
            return false;
        } else {
            return true;
        }
    }

}
