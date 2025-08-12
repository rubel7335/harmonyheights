<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rollback extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('branch_model');
        $this->load->model('employee_model');
        $this->load->model('fi_model');
        $this->load->model('category_model');
        $this->load->model('designation_model');
        $this->load->model('nominee_model');
        $this->load->model('pension_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        $data['employees']  = $this->employee_model->get_employees();
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('rollback/processing', $data);
        $this->load->view('templates/footer');
    }
 

    
    public function employee_salary()
    {
        
        //show modal for confirmation

        
        
        
        $current_year = date('Y'); 
        $current_month = date('m', strtotime('-0 month'));
        $data['sal_ids'] = $this->employee_model->check_if_generated($current_year,$current_month);  
        if(empty($data['sal_ids'])){
            $this->session->set_flashdata('confirmation',"Pension not generated for this month");
            redirect('salary');
            //echo "Empty";
        }
      //  var_dump($data);
        
        if($data['sal_ids']){
            $this->employee_model->rollback_employee_salary($current_year,$current_month,$data['sal_ids']);
            $this->session->set_flashdata('confirmation',"Rollback completed");
            redirect('salary');
            //delete from salary as well as salary breakdowns
            //do rollback
        }

        
        exit();
        $error=false;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new employee';
        $data['image_error'] = '';
        $data['branches'] = $this->branch_model->get_branches();
        $data['designations'] = $this->designation_model->get_designations();
        $data['employees'] = $this->employee_model->get_employees();

                       
        $this->form_validation->set_rules('sap_id', 'SAP ID', 'required');

        if (($this->form_validation->run() === FALSE))
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/create', $data);
            $this->load->view('templates/footer'); 
        }
    
        else
        {
            move_uploaded_file($tmp, 'upload/'.$image_name);
            move_uploaded_file($tmp_poa, 'upload/proof_of_alive/'.$poa_file_name);
            $this->employee_model->set_employee($id=0,$image_name,$poa_file_name);
            $this->session->set_flashdata('confirmation',"Employee information added Successfully");
            redirect('employee/index/');
        }
    }


    

}