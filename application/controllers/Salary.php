<?php
class Salary extends CI_Controller {
 
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
            $this->load->model('allowance_model');        
            $this->load->model('fi_model');
            $this->load->model('category_model');
            $this->load->model('designation_model');
            $this->load->model('salary_model');
            $this->load->helper('url_helper');
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                redirect('login');
            }
        } 


    public function index()
        {
                $current_year = date("Y"); 
                $current_month = ltrim(date("m"),'0');
                $month = date("M");
                    // $data['salaries']  = $this->salary_model->get_sal_entry_details();
                $data['salary_entries'] = $this->salary_model->get_sal_entries($current_year,$current_month);                
                    // print_r($data['salary_entries']);    
                    // $data['active_allowances'] = $this->salary_model->get_active_allowances();
                    // $data['allowances'] = $this->salary_model->get_sal_breakdown_by_sal_id($salID);
                    // print_r($data['active_allowances']);
                    // $data['empdetails'] = $this->salary_model->get_employees_id_details($data['salary_entries']);
                $data['title'] = 'Pension of '.$month." ".$current_year; 
                $data['header1'] = 'Bangladesh Bank'; 
                $data['header2'] = 'Expenditure Management Department-1, Pension Section'; 
                //print_r($data['empdetails']);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('salary/index', $data);
                $this->load->view('templates/footer');                
            }    



    public function create()
        {
        //echo $user = $this->session->userdata('userID'); 
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Generate salary';
        $data['allowances']  = $this->allowance_model->get_allowances(); // get active allowance list
        //$data['alive_employees']    = $this->salary_model->get_alive_employees();  
        $data['all_employees_details']    = $this->salary_model->get_all_employees_id_basic(); // get all employee list no dod or any kind of check
        // $data['alive_employees_details']    = $this->salary_model->get_alive_employees_id_basic();  // All alive employees whose DOD is NULL
        // print_r($data['all_employees_details']);  
        // $data['salary_breakdowns']  = $this->salary_model->get_salary_breakdowns(); 
        $this->form_validation->set_rules('salary_month', 'Month', 'required');
        $this->form_validation->set_rules('salary_year', 'Year', 'required');
        $this->form_validation->set_rules('salary_type', 'Type', 'required');
        $this->form_validation->set_rules('date_of_payment', 'Date of payment', 'required');   
        
        if ($this->form_validation->run() === FALSE)
            {
                    $this->load->view('templates/header');
                    $this->load->view('templates/menu');
                    $this->load->view('salary/create', $data);
                    $this->load->view('templates/footer');
                }
            else
            {               
                $current_month = $this->input->post('salary_month');
                $current_year = $this->input->post('salary_year');       
                $data['sal_ids'] = $this->employee_model->check_if_generated($current_year,$current_month);    // Check if already generated for this month      
                if($data['sal_ids']){           
                $this->session->set_flashdata('confirmation',"Pension already generated for this month");
                redirect('salary/create/');
                    //delete from salary as well as salary breakdowns
                    //do rollback
                }
                $this->salary_model->set_salary_breakdowns($data['all_employees_details'],$data['allowances']);        
                $this->session->set_flashdata('confirmation',"Pension Initiated Successfully");
                redirect('salary');
                /*
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('salary/success');
                $this->load->view('templates/footer');*/
            }
        }   
        
        
    public function add_areear($id = NULL){
        @$areear_basic =NULL;
        @$areear_medical==NULL;
        @$areear_bonus==NULL;
        @$areear_others==NULL;
        $id = base64_decode($id); 
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['salary_id']      = $id;
        $data['allowances']     = $this->allowance_model->get_all_allowances();
        // print_r($_POST['allowanceAmount']);
        // print_r($_POST['allowanceID']);
        // print_r($_POST['remarks']);
        if(empty($_POST))
            {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('salary/areear', $data);
                $this->load->view('templates/footer');
            }
        else{
        //print_r($_POST['allowanceAmount']);
            $totalAreear = 0;
        foreach ($_POST['allowanceAmount'] as $index => $amount){
            if($amount){
                    $totalAreear = $totalAreear+$amount;
                    $this->salary_model->set_areear_breakdowns($id,$_POST['allowanceID'][$index],$amount,$_POST['remarks'][$index]);
                    /*echo "salary_id".$id;
                    echo "Index is".$index."<br>"; 
                    echo "Amount is".$amount."<br>";
                    echo "Allowance ID".$_POST['allowanceID'][$index]."<br>";
                    echo "Remarks".$_POST['remarks'][$index]."<br>";     */     
                }
            }
            $this->salary_model->update_gross_amount($id,$totalAreear);
            $this->session->set_flashdata('confirmation',"Pension Initiated Successfully");
            redirect('salary');
        }
    }
    
    public function search(){
        $current_year = date("Y"); 
        $current_month = ltrim(date("m"),'0');
        $month = date("M");
        $data['current_year']=$current_year;
        $data['current_month']=$current_month; 
        
        $this->form_validation->set_rules('salary_month', 'Month', 'required');
        $this->form_validation->set_rules('salary_year', 'Year', 'required');
        

        
        $data['header1'] = 'Bangladesh Bank'; 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('salary/index', $data);
            $this->load->view('templates/footer');
        }
        else
        {   
        $salary_month       = $this->input->post('salary_month');
        $salary_year        = $this->input->post('salary_year');
        $data['title'] = 'Pension of '.date('M', mktime(0, 0, 0, $salary_month, 10))." ,".$salary_year; 
        $data['header1'] = 'Bangladesh Bank'; 
        $data['header2'] = 'Expenditure Management Department-1, Pension Section'; 
        /*
        if($this->input->post('starting_date')==NULL){
            $starting_date=NULL;
        }else $starting_date = date('Y-m-d', strtotime($this->input->post('starting_date'))); 
        
                if($this->input->post('end_date')==NULL){
            $end_date=NULL;
        }else $end_date = date('Y-m-d', strtotime($this->input->post('end_date')));  
        
        echo $starting_date."</br>";
                //echo "</br>".$end_date;
                
            $dateValue = strtotime($starting_date);
            echo $yr = date("Y", $dateValue) ." "; 
            echo $mon = date("m", $dateValue)." "; 
            echo $date = date("d", $dateValue); 
        */
            $data['salary_entries'] = $this->salary_model->get_sal_entries($salary_year,$salary_month);
          //   print_r($data['salary_entries']);
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('salary/index',$data);
            $this->load->view('templates/footer');
        }
  }
    public function view($id = NULL)
        {
        $id = base64_decode($id);
        $data['salary_entry'] = $this->salary_model->get_sal_entry_by_id($id);
        $salID = $data['salary_entry'] ['id'];
        $empID = $data['salary_entry'] ['employee_id'];
        $nomID = $data['salary_entry'] ['nominee_id'];
        $data['allowances'] = $this->salary_model->get_sal_breakdown_by_sal_id($salID);
        $data['payment_info']   =   $this->salary_model->get_payment_info_by_emp_nom_id($empID,$nomID);
        
        if (empty($data['salary_entry']))
        {
            show_404();
        } 
        //print_r($data['allowances']);
       
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('salary/view', $data);
        $this->load->view('templates/footer');
       
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