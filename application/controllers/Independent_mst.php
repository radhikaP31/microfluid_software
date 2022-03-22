<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Independent_mst extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Independent_model', 'master');
        $this->load->model('Common_type_model', 'common_type');

    }
    public function index($type_id='')
    {

        $data['title'] = 'Independent Master';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if($type_id){
            $data['masters'] = $this->db->get_where('independent_mst', ['type_id' => $type_id])->result_array();

        }else{
            $data['masters'] = $this->db->get('independent_mst')->result_array();
        }

        $data['common_types'] = $this->db->get('common_type')->result_array();


        $this->form_validation->set_rules('mstr_cd', 'Master Code', 'required|callback_CheckMstrCodeExist');
        $this->form_validation->set_rules('mstr_nm', 'Master Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $type_cd = $this->common_type->getTypeCodeByTypeID($this->input->post('type_id'));
            $this->master->insertMaster($this->input->post('mstr_cd'),$this->input->post('mstr_nm'),$this->input->post('mstr_description'),$this->input->post('type_id'),$type_cd,$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Independent Master added!</div>');
            redirect('independent_mst');
        }
    }

    public function editMaster($mstr_id)
    {
        $data['title'] = 'Edit Independent Master';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['master'] = $this->db->get_where('independent_mst', ['id' => $mstr_id])->row_array();
        $data['common_types'] = $this->db->get('common_type')->result_array();


        $this->form_validation->set_rules('mstr_cd', 'Master Code', 'required|callback_CheckMstrCodeExist');
        $this->form_validation->set_rules('mstr_nm', 'Master Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/edit-master', $data);
            $this->load->view('templates/footer');
        } else {
            
            $type_cd = $this->common_type->getTypeCodeByTypeID($this->input->post('type_id'));
            
            $this->master->updateMaster($mstr_id,$this->input->post('mstr_cd'),$this->input->post('mstr_nm'),$this->input->post('mstr_description'),$this->input->post('type_id'),$type_cd,$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Independent Master Success!</div>');
            redirect('independent_mst');
        }
    }

    public function deleteMaster($mstr_id)
    {
        $master = $this->db->get_where('independent_mst', ['id' => $mstr_id])->row_array();

        $this->db->delete('independent_mst', ['id' => $mstr_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $master['title'] . ' Independent Master is deleted!</div>');
        redirect('independent_mst');
    }

    public function CheckMstrCodeExist($mstr_cd='',$mstr_id=''){

        if($mstr_id){
            //$where = ' and id not in ('.$mstr_id.')';
            $this->db->where_not_in('id', $mstr_id);
        }

        $this->db->where('mstr_cd', $mstr_cd);

        $id = $this->db->get('independent_mst')->first_row()->id;

        if ($id) {
            $this->form_validation->set_message('CheckMstrCodeExist', 'This Master code already exists');
            return false;
        } else {
            return true;
        }
    }

}
