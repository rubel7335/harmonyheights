<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_info extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('person_model');  
        $this->load->model('salaryexpense_model');
        $this->load->model('equipment_model');
        $this->load->model('Supplier_info_model');
        $this->load->model('supplier_model');
        $this->load->model('membership_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }


    }

    // Display a list of all suppliers
    public function index() {
        $data['suppliers'] = $this->Supplier_info_model->read_all();
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('supplier_info/index', $data);
        $this->load->view('templates/footer');
    }

    // Display a form to create a new supplier
    public function create() {
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('supplier_info/create');
        $this->load->view('templates/footer');
    }

    // Store a newly created supplier in the database
    public function store() {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'contact_no' => $this->input->post('contact_no')
        );
        $this->Supplier_info_model->create($data);
        redirect('supplier_info');
    }

    // Display the details of a supplier
    public function show($id) {
        $data['supplier'] = $this->Supplier_info_model->read($id);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('supplier_info/show', $data);
        $this->load->view('templates/footer');
    }

    // Display a form to edit a supplier
    public function edit($id) {
        $data['supplier'] = $this->Supplier_info_model->read($id);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('supplier_info/edit', $data);
        $this->load->view('templates/footer');
    }

    // Update an existing supplier in the database
    public function update($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'contact_no' => $this->input->post('contact_no')
        );
        $this->Supplier_info_model->update($id, $data);
        redirect('supplier_info');
    }

    // Delete a supplier from the database
    public function delete($id) {
        $this->Supplier_info_model->delete($id);
        redirect('supplier_info');
    }
}
?>
