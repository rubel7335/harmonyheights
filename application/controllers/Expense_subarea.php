<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_subarea extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->model('expense_subarea_model');        
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('person_model');  
        $this->load->model('commondata_model');
        $this->load->model('equipment_model');
        $this->load->model('payment_model');  
        $this->load->model('supplier_model'); 
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }


    }

    // Display a list of all expense subareas
    public function index() {
        $data['expense_subareas'] = $this->expense_subarea_model->read_all();
        $this->load->view('expense_subarea/index', $data);
    }

    // Display a form to create a new expense subarea
    public function create($classID) {
        
       // $this->load->view('expense_subarea/create/'.$classID);
        $data = array(
            'classID' => $classID
        );
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('expense_subarea/create', $data);
        $this->load->view('templates/footer'); 



       
    }

    // Store a newly created expense subarea in the database
    public function store($classID) {
        $expense_area_id =$classID;
        $data = array(
            'expense_area_id' => $expense_area_id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );
        $this->expense_subarea_model->create($data);
       // redirect('expense_subarea');
        if( $expense_area_id ==1){redirect('equipment/create/');}
        if( $expense_area_id ==2){redirect('salaryexpense/create/');}
        if( $expense_area_id ==3){redirect('expense/create/');}
    }

    // Display the details of an expense subarea
    public function show($expense_subarea_id) {

        
        $data['expense_subarea'] = $this->expense_subarea_model->read($expense_subarea_id);
        $this->load->view('expense_subarea/show', $data);
    }

    // Display a form to edit an expense subarea
    public function edit($expense_subarea_id) {
        $data['expense_subarea'] = $this->expense_subarea_model->read($expense_subarea_id);
        $this->load->view('expense_subarea/edit', $data);
    }

    // Update an existing expense subarea in the database
    public function update($expense_subarea_id) {
        $expense_area_id =1;
        $data = array(
            'expense_area_id' => $expense_area_id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );

       
        $this->expense_subarea_model->update($data, $expense_subarea_id);
        redirect('expense_subarea');
    }

    // Delete an expense subarea from the database
    public function delete($expense_subarea_id) {
        $this->expense_subarea_model->delete($expense_subarea_id);
        redirect('expense_subarea');
    }
}
?>
