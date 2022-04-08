<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_details extends CI_Controller {

	public function __construct() {
		parent::__construct(); //call parent constructor
		$this->load->model('customer_details_m');
		$this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Admin_model', 'admin');
	}

	public function index()
	{
		$head['title'] = 'Customer Details';
		$data['name'] = 'Customer Details';
		$data['add_actions'] = site_url('customer_details/newCustomerDetails');

		$data['tableHeader'] = array('Code', 'Company', 'Address1', 'Address2', 'Website', 'Contact No');
		$data['tableBody'] = $this->customer_details_m->getTableDetails();

        $data['tableEditUrl'] = 'customer_details/editCustomerDetails';
        $data['tableDeleteUrl'] = 'customer_details/delete';
        $data['tableActions'] = [];
        $data['parentId'] = 0;

        $this->load->view('templates/header', $head);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('includes/list_view_v', $data);
        $this->load->view('templates/footer', $data);
	}

	public function form($id=0){

		$head['title'] = 'Customer Details';
		$data['name'] = 'Customer Details';
		$data['id'] = $id;

		if($id){
			$data['action'] = site_url('customer_details/update/');
			$data['actionMode'] = 'edit';

		}else{
			$data['action'] = site_url('customer_details/insert/');
			$data['actionMode'] = 'add';
		}

		$data['cancel_url'] = 'customer_details' ;
		$data['buttons'][] =  array('name' => 'saveAndAddItem',
                    'value' => 'saveAndAddItem',
                    'title' => 'Save and Add Item',
                    'type' => 'button',
                    'url' => site_url('contact_details/insert/'),
                    'icon' => 'fa fa-caret-square-o-right fa-paper-plane-o');

		/*$name = $this->customer_details_m->getCustName($id);
		$data['controls'][]  = setTextBoxControlCustom('Name', 'Customer Details_name', 'Customer Details_name', $name, 1,0);*/

		$company = $this->customer_details_m->getComanyName($id);
		$data['controls'][]  = setTextBoxControlCustom('Company', 'company', 'company', $company, 1,0);

		$address1 = $this->customer_details_m->getAddress1($id);
		$data['controls'][]  = setTextBoxControlCustom('Address1', 'address1', 'address1', $address1, 1,0);

		$address2 = $this->customer_details_m->getAddress2($id);
		$data['controls'][]  = setTextBoxControlCustom('Address2', 'address2', 'address2', $address2, 1,0);

		$website = $this->customer_details_m->getWebsite($id);
		$data['controls'][]  = setTextBoxControlCustom('Website', 'website', 'website', $website, 1,0);

		$contact = $this->customer_details_m->getContact($id);
		$data['controls'][]  = setTextBoxControlCustom('Contact No', 'contact', 'contact', $contact, 1,0);

		if ($id) {
            $data['controls'][] = '<div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <span class="btn btn-default btn-xs" id="add_employee" class="add_employee">Add Employee</span>
                                    </div>
                                </div>';
        }

		$cmp_cd = $this->customer_details_m->getCompanyCode($id);

		$template['header'] = $this->load->view('templates/header', $head);
		$template['body'] = $this->load->view('customer_details_v', $data);	
	}

	function setFormControls(){
		if($this->actionMode==0){
			//enter insert rules here
		}
		if($this->actionMode==1){
			$this->gvn_id = $this->input->post('id');
		}
		$this->gvn_company = $this->input->post('company');
		$this->gvn_address1 = $this->input->post('address1');
		$this->gvn_address2 = $this->input->post('address2');
		$this->gvn_website = $this->input->post('website');
		$this->gvn_contact = $this->input->post('contact');


		if($this->actionMode==0){
		
			$id=$this->customer_details_m->insert($this->gvn_company, $this->gvn_address1, $this->gvn_address2, $this->gvn_website, $this->gvn_contact);

		} else {
			$id = $this->gvn_id;
			$this->customer_details_m->update($this->gvn_id,$this->gvn_company, $this->gvn_address1, $this->gvn_address2, $this->gvn_website, $this->gvn_contact);
		}
	}

	function setFormValidation(){
		if($this->actionMode==0){
			//enter insert rules here
		}
		if($this->actionMode==1){
			$this->form_validation->set_rules('id','ID','trim|required');
		}
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('address1', 'Address1', 'trim|required');
		$this->form_validation->set_rules('address2', 'Address2', 'trim|required');
		$this->form_validation->set_rules('website', 'Website', 'trim');
		$this->form_validation->set_rules('contact', 'Contact No', 'trim|required');
	}

	function newCustomerDetails(){
		$this->form(0);
	}

	function editCustomerDetails($id=0){
		$this->form($id);
	}

	function insert(){
		$this->actionMode = 0;
		//start of form validation
		$this->load->library('form_validation');
		$this->setFormValidation();
		//end of form validation

		if($this->form_validation->run() == FALSE) {
			$this->newCustomerDetails();
		} else {
			$this->setFormControls();
			$this->session->set_flashdata('success', 'Successfully Added Company Details');
			if($this->input->post('next')) {
				redirect('customer_details/newCustomerDetails', 'refresh');
			}
			
			redirect('customer_details', 'refresh');

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
			$this->editCustomerDetails($this->input->post('id'));
		} else {
			$this->setFormControls();
			$this->session->set_flashdata('success', 'Successfully Updated Company Details');
			if($this->input->post('next')) {
				redirect('customer_details/newCustomerDetails', 'refresh');
			}
			redirect('customer_details', 'refresh');
		}
	}

	public function delete($id) {
		$this->customer_details_m->delete($id);
		$this->session->set_flashdata('success', 'Successfully Deleted');
		redirect('customer_details', 'refresh');
	}

	public function getEditEmployeeData($id=0){
		$this->customer_details_m->getEditEmployeeData($id);
		echo json_encode($data);
	}

	public function addNewEmployee(){
var_dump('expression');die;
		$emp_name = $this->input->post('emp_name');
		$emp_contact = $this->input->post('emp_contact');
		$emp_email = $this->input->post('emp_email');
		$emp_position = $this->input->post('emp_position');
		$emp_department = $this->input->post('emp_department');
		$emp_cd = $this->input->post('emp_cd');

		$insertedId = $this->customer_details_m->insertEmployee($emp_name, $emp_contact, $emp_email, $emp_position, $emp_department, $emp_cd);
		echo json_encode(array('success' => 1, 'employee_id' => $insertedId));
	}
	
}
