<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {

	public function __construct() {
		parent::__construct(); //call parent constructor
		$this->load->model('about_us_m');
		$this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Admin_model', 'admin');
	}

	public function index()
	{
		$head['title'] = 'About us Details';
		$data['name'] = 'About us Details';
		$data['add_actions'] = site_url('about_us/newAboutus');

		$data['tableHeader'] = array('Tab Name', 'Name', 'Image', 'Video Path');
		$data['tableBody'] = $this->about_us_m->getTableDetails();

        $data['tableEditUrl'] = 'about_us/editAboutus';
        $data['tableDeleteUrl'] = 'about_us/delete';
        $data['tableActions'] = [];
        $data['parentId'] = 0;

        $this->load->view('templates/header', $head);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('includes/list_view_v', $data);
        $this->load->view('templates/footer', $data);
	}

	public function form($id=0){

		$head['title'] = 'About us Details';
		$data['name'] = 'About us Details';
		$data['id'] = $id;

		if($id){
			$data['action'] = site_url('about_us/update/');
			$data['actionMode'] = '1';

		}else{
			$data['action'] = site_url('about_us/insert/');
			$data['actionMode'] = '0';
		}

		$data['cancel_url'] = 'about_us' ;
		$data['buttons'][] =  array('name' => 'saveAndAddItem',
                    'value' => 'saveAndAddItem',
                    'title' => 'Save and Add Item',
                    'type' => 'button',
                    'url' => site_url('contact_details/insert/'),
                    'icon' => 'fa fa-caret-square-o-right fa-paper-plane-o');

		$tab_name = $this->about_us_m->getTabName($id);
		$data['controls'][]  = setTextBoxControlCustom('Tab Name', 'tab_name', 'tab_name', $tab_name, 1,0);

		$name = $this->about_us_m->getName($id);
		$data['controls'][]  = setTextBoxControlCustom('Name', 'name', 'name', $name, 1,0);

		$description = $this->about_us_m->getDescription($id);
		$data['controls'][]  = setHTMLEditorControlCustom('Description', 'description', 'description', $description, 1,0);

		$image = $this->about_us_m->getImage($id);
		$data['controls'][]  = setTextBoxControlCustom('Image', 'image', 'image', $image, 1,0);

		$video_path = $this->about_us_m->getVideoPath($id);
		$data['controls'][]  = setTextBoxControlCustom('Video Path', 'video_path', 'video_path', $video_path, 1,0);
		$data['controls'][]  = setTextBoxControlCustom('Video Path', 'video_path', 'video_path', $video_path, 1,0,[]);

		$this->load->view('templates/header', $head);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('includes/form_view_v', $data);
        $this->load->view('templates/footer', $data);
	}

	function setFormControls(){
		if($this->actionMode==0){
			//enter insert rules here
		}
		if($this->actionMode==1){
			$this->gvn_id = $this->input->post('id');
		}
		$this->gvn_tab_name = $this->input->post('tab_name');
		$this->gvn_name = $this->input->post('name');
		$this->gvn_description = $this->input->post('description');
		$this->gvn_image = $this->input->post('image');
		$this->gvn_video_path = $this->input->post('video_path');


		if($this->actionMode==0){
		
			$id=$this->about_us_m->insert($this->gvn_tab_name, $this->gvn_name, $this->gvn_description, $this->gvn_image, $this->gvn_video_path);

		} else {
			$id = $this->gvn_id;
			$this->about_us_m->update($this->gvn_id,$this->gvn_tab_name, $this->gvn_name, $this->gvn_description, $this->gvn_image, $this->gvn_video_path);
		}
	}

	function setFormValidation(){
		if($this->actionMode==0){
			//enter insert rules here
		}
		if($this->actionMode==1){
			$this->form_validation->set_rules('id','ID','trim|required');
		}
		$this->form_validation->set_rules('tab_name', 'Contact No', 'trim|required');
		$this->form_validation->set_rules('name', 'Company', 'trim|required');
		$this->form_validation->set_rules('description', 'Address1', 'trim');
		$this->form_validation->set_rules('image', 'Address2', 'trim');
		$this->form_validation->set_rules('video_path', 'Website', 'trim');
	}

	function newAboutus(){
		$this->form(0);
	}

	function editAboutus($id=0){
		$this->form($id);
	}

	function insert(){
		$this->actionMode = 0;
		//start of form validation
		$this->load->library('form_validation');
		$this->setFormValidation();
		//end of form validation

		if($this->form_validation->run() == FALSE) {
			$this->newAboutus();
		} else {
			$this->setFormControls();
			$this->session->set_flashdata('success', 'Successfully Added About Details');
			if($this->input->post('next')) {
				redirect('about_us/newAboutus', 'refresh');
			}
			
			redirect('about_us', 'refresh');

		}
	}

	function update($id=0){
		$this->actionMode = 1;
		//start of form validation
		$this->load->library('form_validation');
		$this->setFormValidation();

		//end of form validation
		if($this->form_validation->run() == FALSE) {
		//	echo validation_errors();die();
			$this->editAboutus($this->input->post('id'));
		} else {
			$this->setFormControls();
			$this->session->set_flashdata('success', 'Successfully Updated About Details');
			if($this->input->post('next')) {
				redirect('about_us/newAboutus', 'refresh');
			}
			redirect('about_us', 'refresh');
		}
	}

	public function delete($id) {
		$this->about_us_m->delete($id);
		$this->session->set_flashdata('success', 'Successfully Deleted');
		redirect('about_us', 'refresh');
	}
	
}
