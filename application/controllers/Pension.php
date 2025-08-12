<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pension extends CI_Controller {
        public function __construct() {
            parent::__construct();
            date_default_timezone_set("Asia/Dhaka");
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('employee_model');
            $this->load->model('nominee_model');
            $this->load->model('fi_model');
            $this->load->model('branch_model');
            $this->load->model('pension_model');
            $this->load->model('category_model');
            $this->load->model('designation_model');
            $this->load->helper('url_helper');
            $this->load->database("db_pension_mgm");
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                redirect('login');
            }
        }

	public function index()
	{
            $data['pensions']  = $this->pension_model->get_pensions();
            $data['employees']  = $this->employee_model->get_employees();
            $data['nominees']  = $this->nominee_model->get_nominees();
            $data['fis'] = $this->fi_model->get_fis();
            $data['branches'] = $this->branch_model->get_branches();
            $data['usercategories'] = $this->category_model->get_categories();
            $data['designations'] = $this->designation_model->get_designations();
            $data['title'] = 'Pension distribution'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('pension/index', $data);
            $this->load->view('templates/footer');
	}
        public function create($id = NULL)
        {
            $id = base64_decode($id);
            $this->load->helper('form');
            $this->load->library('form_validation'); 
            $data['employee_id']=$id;
            
            $data['fis'] = $this->fi_model->get_fis();
            $data['branches'] = $this->branch_model->get_branches();
            $data['employee'] = $this->employee_model-> get_employee_by_id($id);
            $data['nominees'] = $this->nominee_model->get_nominees();
            $data['title'] = 'Pension basic of  '.$data['employee']['full_name']; 
            
            $this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
            $this->form_validation->set_rules('last_increment_date', 'Last increment date', 'required');        
            $this->form_validation->set_rules('next_increment_date', 'Next increment date', 'required');
            $this->form_validation->set_rules('fixation_date', 'Fixation date', 'required');     
           // $this->form_validation->set_rules('remarks', 'Remarks', 'required');            
            $this->form_validation->set_rules('payment_method', 'Payment method', 'required');            
           // $this->form_validation->set_rules('payment_to_account_no', 'Payment to account no', 'required');            
            $this->form_validation->set_rules('payment_to_bank_id', 'Payment to Bank', 'required');
            $this->form_validation->set_rules('payment_to_branch_id', 'Payment to Branch', 'required');   

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('pension/create', $data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->pension_model->set_pension();
                $this->session->set_flashdata('confirmation',"Pension basic added Successfully");
                redirect('employee/index/');
                /*
                $this->load->view('templates/header');
                $this->load->view('pension/success');
                $this->load->view('templates/footer');*/
            }
        }
        public function view($id = NULL)
        {
            $id = base64_decode($id);
            $data['pension_item'] = $this->pension_model->get_pensions($id);        
            if (empty($data['pension_item']))
            {
                show_404();
            }
            $data['designations'] = $this->designation_model->get_designations();
            $data['employees']  = $this->employee_model->get_employees();
            $data['nominees']  = $this->nominee_model->get_nominees();
            $data['fis'] = $this->fi_model->get_fis();
            $data['branches'] = $this->branch_model->get_branches();    
            $data['title'] = $data['pension_item']['employee_id']; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('pension/view', $data);
            $this->load->view('templates/footer');
        }
        public function get_pension_basic_by_id()
        {
            $id = $this->uri->segment(3); 
            $id = base64_decode($id);
            if (empty($id))
            {
                show_404();
            }   
            //$data['employees']  = $this->employee_model->get_employees();
            $data['employee'] = $this->employee_model-> get_employee_by_id($id);            
            $data['pension_item']  = $this->pension_model->get_pension_by_emp_id($id);
           // print_r($data);
            $data['designations'] = $this->designation_model->get_designations();
            $data['fis'] = $this->fi_model->get_fis();
            $data['branches'] = $this->branch_model->get_branches();
            $data['title'] = 'Pension basic of  '.$data['employee']['full_name']; 
            //print_r($data);

            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('pension/view', $data);
            $this->load->view('templates/footer');


        }

        public function edit()
        {
        $id = $this->uri->segment(3);
        $id = base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit pension basic';
        //$data['pension_item'] = $this->pension_model->get_pension_by_id($id);  
        $data['pension_item'] = $this->pension_model->get_pension_info_emp_id($id); 
        var_dump($data['pension_item']);
       
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();
        

        $this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
        //$this->form_validation->set_rules('nominee_id', 'Nominee id', 'required');
        $this->form_validation->set_rules('last_increment_date', 'Last increment date', 'required');        
        $this->form_validation->set_rules('next_increment_date', 'Next increment date', 'required');
        $this->form_validation->set_rules('fixation_date', 'Fixation date', 'required');            
       // $this->form_validation->set_rules('period_for_payment', 'Period for payment', 'required'); 
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');            
        $this->form_validation->set_rules('payment_method', 'Payment method', 'required');            
        $this->form_validation->set_rules('payment_to_account_no', 'Payment to account no', 'required');            
        $this->form_validation->set_rules('payment_to_bank_id', 'Payment to Bank', 'required');
        $this->form_validation->set_rules('payment_to_branch_id', 'Payment to Branch', 'required');   
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('pension/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->pension_model->set_pension($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/pension');
        }
    }
          public function delete()
        {
            $id = $this->uri->segment(3);
            $id = base64_decode($id);
            if (empty($id))
            {
                show_404();
            }

            $pension_item = $this->pension_model->get_pension_by_id($id);

            $this->pension_model->delete_pension($id);        
            redirect( base_url() . 'index.php/pension');        
        }

}