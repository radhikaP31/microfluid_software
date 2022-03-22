<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoices extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Invoices_model', 'invoices');
    }
    public function index()
    {

        $data['title'] = 'Invoice Management';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['invoices'] = $this->db->get('invoices')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('invoice/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->invoices->insertInvoice($this->input->post('title'),$this->input->post('description'),$this->input->post('subscription'),$this->input->post('date'),$this->input->post('next_due_date'),$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Invoice added!</div>');
            redirect('invoices');
        }
    }

    public function editInvoice($invoice_id)
    {
        $data['title'] = 'Edit Invoice';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['invoice'] = $this->db->get_where('invoices', ['id' => $invoice_id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('invoice/edit-invoices', $data);
            $this->load->view('templates/footer');
        } else {
            
            $this->invoices->updateInvoice($invoice_id,$this->input->post('title'),$this->input->post('description'),$this->input->post('subscription'),$this->input->post('date'),$this->input->post('next_due_date'),$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Invoice Success!</div>');
            redirect('invoices');
        }
    }

    public function deleteInvoice($invoice_id)
    {
        $invoice = $this->db->get_where('invoices', ['id' => $invoice_id])->row_array();

        $this->db->delete('invoices', ['id' => $invoice_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $invoice['title'] . ' Invoice is deleted!</div>');
        redirect('invoices');
    }

}
