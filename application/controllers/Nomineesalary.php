<?php
class Nomineesalary extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('branch_model');
        $this->load->model('employee_model');
        $this->load->model('allowance_model');        
        $this->load->model('fi_model');
        $this->load->model('category_model');
        $this->load->model('designation_model');
        $this->load->model('salary_model');
        $this->load->model('nomineesalary_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
        
       // $data['salaries']  = $this->salary_model->get_salaries();
        
        $data['salaries']  = $this->salary_model->get_sal_entry_details();
        $data['salary_entries'] = $this->salary_model->get_sal_entries();
        //print_r($data['salary_entries']);
        $data['empdetails'] = $this->salary_model->get_employees_id_details($data['salary_entries']);
        $data['title'] = 'Salaries archive'; 
        //print_r($data['empdetails']);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nomineesalary/index', $data);
        $this->load->view('templates/footer');
    }
    
    
        public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Generate nominee pension';
        $data['allowances']  = $this->allowance_model->get_allowances();       
        $data['deceased_employees']    = $this->salary_model->get_deceased_employees();  
        //print_r($data['deceased_employees']);      
        //$data['alive_nominees_details']    = $this->nomineesalary_model->get_alive_nominees_id_basic(); 
        //print_r($data['alive_nominees_details']); 
        //$data['salary_breakdowns']  = $this->salary_model->get_salary_breakdowns(); 
        $this->form_validation->set_rules('salary_month', 'Month', 'required');
        $this->form_validation->set_rules('salary_year', 'Year', 'required');
        $this->form_validation->set_rules('salary_type', 'Type', 'required');
        $this->form_validation->set_rules('date_of_payment', 'Date of payment', 'required');         
       
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nomineesalary/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {   
            
            $salary_month       = $this->input->post('salary_month');
            $salary_year        = $this->input->post('salary_year');
            $salary_type        = $this->input->post('salary_type');
            $date_of_payment    = $this->input->post('date_of_payment'); 
            $y=$salary_year;
            $m=$salary_month;
            $query_date = $y."-".$m;
            $last_day_this_month  = date('Y-m-t',strtotime($query_date));            
            $data['nominees_details']    = $this->nomineesalary_model->get_all_nominees_id_basic($last_day_this_month); // Find all nominees of dead employees 
           // var_dump($data['nominees_details']);            
                       
            foreach ($data['nominees_details'] as $nominee){ 
           // if(is_valid_nominee($nominee,$last_day_this_month)){               
            //echo"<br>".$nomineeID = $nominee['id'];echo"<br>".$nominee_basic = $nominee['nominees_basic'];echo"<br>".$nominee_share  =   $nominee['pension_percentage'];
            $this->nomineesalary_model->set_salary_breakdowns($nominee,$data['allowances']);
            //    }
            } 
            
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nomineesalary/success');
            $this->load->view('templates/footer');        
        }
    }
    
 
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['allowance_item']  = $this->allowance_model->get_allowances($id);
        if (empty($data['allowance_item']))
        {
            show_404();
        } 
        $data['title'] = $data['allowance_item']['allowance_type']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('salary/view', $data);
        $this->load->view('templates/footer');
    }
    

    

    
    public function viewsalary(){
        
    }
    
    public function edit()
    {
        $id = base64_decode($this->uri->segment(3));
        
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit an Allowance'; 
        $data['allowances']  = $this->allowance_model->get_allowances();
        $data['allowance_item'] = $this->allowance_model->get_allowance_by_id($id);    
                            
        $this->form_validation->set_rules('allowance_type', 'Allowance Type', 'required');
        $this->form_validation->set_rules('allowance_amount', 'Allowance Amount', 'required');
        $this->form_validation->set_rules('gross_or_percentage', 'Gross or Percentage', 'required');   
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('allowance/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->allowance_model->set_allowance($id);
            //$this->load->view('news/success');
            redirect( base_url() . 'index.php/allowance');
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
                
        $allowance_item = $this->allowance_model->get_allowance_by_id($id);
        
        $this->allowance_model->delete_allowance($id);        
        redirect( base_url() . 'index.php/allowance');        
    }
}