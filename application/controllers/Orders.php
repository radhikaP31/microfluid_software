<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');       
        $this->load->model('Orders_model', 'orders');
    }
    public function index()
    {

        $data['title'] = 'Order Management';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['orders'] = $this->db->get('orders')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('orders/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->orders->insertOrder($this->input->post('title'),$this->input->post('description'),$this->input->post('subscription'),$this->input->post('date'),$this->input->post('next_due_date'),$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Order added!</div>');
            redirect('orders');
        }
    }

    public function editOrder($order_id)
    {
        $data['title'] = 'Edit Order';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['order'] = $this->db->get_where('orders', ['id' => $order_id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('orders/edit-orders', $data);
            $this->load->view('templates/footer');
        } else {
            
            $this->orders->updateOrder($order_id,$this->input->post('title'),$this->input->post('description'),$this->input->post('subscription'),$this->input->post('date'),$this->input->post('next_due_date'),$this->input->post('status'));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit Order Success!</div>');
            redirect('orders');
        }
    }

    public function deleteOrder($order_id)
    {
        $order = $this->db->get_where('orders', ['id' => $order_id])->row_array();

        $this->db->delete('orders', ['id' => $order_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $order['title'] . ' Order is deleted!</div>');
        redirect('orders');
    }

}
