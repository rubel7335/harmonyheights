<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
 
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
        $data['title'] = 'Employees information'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/index', $data);
        $this->load->view('templates/footer');
    } 
    public function view($id = NULL)
    {
        $id= base64_decode($id);
        $data['emp_id'] = $id;
        $data['employee_item'] = $this->employee_model->get_employees($id); 
        $data['nominees']  = $this->nominee_model->get_nominee_by_empid($id);      
        $data['pension_item']  = $this->pension_model->get_pension_by_emp_id($id);
       // var_dump($data['employee_item']);
        $data['employee_poa_item'] = $this->employee_model->get_employees_poa_history($id);  
        //var_dump($data['employee_poa_item']);
        $data['pensioner_cat'] = $this->pension_model-> get_pensionercategories();
        $data['title_poa_history'] = 'Employees Proof of alive history'; 
        if (empty($data['employee_item']))
        {
            show_404();
        }
        $data['designations'] = $this->designation_model->get_designations();
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();    
        $data['title'] = $data['employee_item']['full_name']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/view', $data);
        $this->load->view('templates/footer');
    }    
    public function create()
    {
        $error=false;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new employee';
        $data['image_error'] = '';
        $data['branches'] = $this->branch_model->get_branches();
        $data['designations'] = $this->designation_model->get_designations();
    //    $data['employees'] = $this->employee_model->get_employees();
       

        if(isset($_FILES['image_file'])&&(!empty($_FILES['image_file']['name']))) {
            $errors     = array();
            $maxsize    = 102400;//in Bytes
            $acceptable = array(
                'image/jpeg',
                'image/jpg',
                'image/gif',
                'image/png'
            );

            $name_photo = @$_FILES['image_file']['name'];
            list($txt, $ext) = explode(".", $name_photo);
            $image_name = time().".".$ext;
            $tmp = @$_FILES['image_file']['tmp_name'];

            if(($_FILES['image_file']['size'] >= $maxsize)) {
                $errors[] = 'Photo size too large. File must be less than 100 KB.';
            // echo    $error_photo='File too large. File must be less than 2 megabytes.';
                $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                $this->form_validation->set_message('error_photo','Photo size too large. File must be less than 100 KB');
                $error=true;
            }

            if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
                $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                $error=true;
            }
/*
            if(count($errors) === 0) {
               move_uploaded_file($tmp, 'upload/'.$image_name);
            } else {
                foreach($errors as $error) {
                    $error_photo="Invalid File";
                    echo '<script>alert("'.$error.'");</script>';
                }
                    $this->load->view('templates/header');
                    $this->load->view('employee/create', $data);
                    $this->load->view('templates/footer'); 
               // die(); //Ensure no more processing is done
            }*/
        } else {
            $this->form_validation->set_rules('image_file', 'Employee Photo', 'required');    
        }  
        if(isset($_FILES['poa_file'])&&(!empty($_FILES['poa_file']['name']))) {
            $errors     = array();
            $maxsize    = 512000;//in Bytes
            $acceptable = array(
                'application/pdf',
                'image/jpeg',
                'image/jpg'
            );

            $name_poa = @$_FILES['poa_file']['name'];
            list($txt, $ext) = explode(".", $name_poa);
            $poa_file_name = time().".".$ext;
            $tmp_poa = @$_FILES['poa_file']['tmp_name'];

            if(($_FILES['poa_file']['size'] >= $maxsize)) {
                $errors[] = 'Proof of alive document size too large. File must be less than 500 KB.';
                $error_poa = 'Proof of alive document size too large. File must be less than 500 KB.';
                $data['error_poa']= 'Proof of alive document size too large. File must be less than 500 KB.';
                $error=true;
            }

            if((!in_array($_FILES['poa_file']['type'], $acceptable)) && (!empty($_FILES["poa_file"]["type"]))) {
                $errors[] = 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
                $error_poa = 'Invalid Proof of alive file type. Only PDF, JPG,JPEG  types are accepted.';
                $data['error_poa']= 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
                $error=true;
            }
        } 

                       
        $this->form_validation->set_rules('sap_id', 'SAP ID', 'required');
        $this->form_validation->set_rules('index_no', 'Index No', 'required');
        $this->form_validation->set_rules('ppo_no', 'PPO No', 'required');
        $this->form_validation->set_rules('file_no', 'File No', 'required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        
    //  $this->form_validation->set_rules('email', 'Email', 'required');
    //  $this->form_validation->set_rules('cell_phone', 'Cell phone', 'required');
        $this->form_validation->set_rules('designation_id', 'Designation', 'required');        
    //  $this->form_validation->set_rules('present_address', 'Present Address', 'required');
    //  $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
        $this->form_validation->set_rules('retired_branch_id', 'Retired from', 'required');
        $this->form_validation->set_rules('pension_provider_branch_id', 'Pension provider branch', 'required');        
        $this->form_validation->set_rules('dob_time', 'DOB', 'required');
      //  $this->form_validation->set_rules('dor_time', 'DOR', 'required');      
        $this->form_validation->set_rules('marital_status', 'Marrital status', 'required');
      //  $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required');        
        $this->form_validation->set_rules('last_basic_during_retirement', 'Last basic during retirement', 'required');
        $this->form_validation->set_rules('pension_amount_during_retirement', 'Pension amount during retirement', 'required');
      //  $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
       // if (($this->form_validation->run() === FALSE)||($error)||empty($_FILES['poa_file']['name']))
        //if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['image_file']['name'])||empty($_FILES['poa_file']['name']))
        if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['image_file']['name']))
            {
            //echo "Here";
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('employee/create', $data);
                //var_dump($data);
                $this->load->view('templates/footer'); 
            }
            else
            {
                if(!(empty($_FILES['image_file']['name']))){move_uploaded_file($tmp, 'upload/'.$image_name);}
                if(!(empty($_FILES['poa_file']['name']))){ move_uploaded_file($tmp_poa, 'upload/proof_of_alive/'.$poa_file_name);}
                $this->employee_model->set_employee($id=0,$image_name,$poa_file_name="NULL");
                $this->session->set_flashdata('confirmation',"Employee information added Successfully");
                redirect('employee/index/');
            /*
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/success');
            $this->load->view('templates/footer');*/
            }
    }
    public function edit()
    {
        $error=false;
        $id = $this->uri->segment(3);
        $id= base64_decode($id);
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');    
        $data['title'] = 'Edit an Employee';        
        $data['employee_item'] = $this->employee_model->get_employee_by_id($id);        
        $data['branches'] = $this->branch_model->get_branches();
        $data['designations'] = $this->designation_model->get_designations();
       // $data['employees'] = $this->employee_model->get_employees();
        
    

/*if(isset($_FILES['image_file'])) {*/
if(isset($_POST) && !empty($_FILES['image_file']['name'])){    
    $errors     = array();
    $maxsize    = 102000;//in Bytes
    $acceptable = array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );
    
    $name_photo = @$_FILES['image_file']['name'];
    list($txt, $ext) = explode(".", $name_photo);
    $image_name = time().".".$ext;
    $tmp = @$_FILES['image_file']['tmp_name'];
                
    if(($_FILES['image_file']['size'] >= $maxsize) || ($_FILES["image_file"]["size"] == 0)) {
       echo $errors[] = 'Photo size too large. File must be less than 102 KB.';
        $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
        $error=true;
    }

    if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
       echo $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
        $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
        $error=true;
    }
    
            if(!$error){move_uploaded_file($tmp, 'upload/'.$image_name);}

}else {  $image_name=$data['employee_item']['image_url'];}

/*if(isset($_FILES['poa_file'])) {*/
if(isset($_POST) && !empty($_FILES['poa_file']['name'])){   
    $errors     = array();
    $maxsize    = 512000;//in Bytes
    $acceptable = array(
        'application/pdf',
        'image/jpeg',
        'image/jpg'
    );
    
    $name_poa = @$_FILES['poa_file']['name'];
    list($txt, $ext) = explode(".", $name_poa);
    $poa_file_name = time().".".$ext;
    $tmp_poa = @$_FILES['poa_file']['tmp_name'];
                
    if(($_FILES['poa_file']['size'] >= $maxsize) || ($_FILES["poa_file"]["size"] == 0)) {
       echo $errors[] = 'Proof of alive document size too large. File must be less than 500 KB.';
        $data['error_poa']= 'Proof of alive document size too large. File must be less than 500 KB.';
        $error=true;
    }

    if((!in_array($_FILES['poa_file']['type'], $acceptable)) && (!empty($_FILES["poa_file"]["type"]))) {
       echo $errors[] = 'Invalid Proof of alive file type. Only PDF, JPG, JPEG types are accepted.';
        $data['error_poa']= 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
        $error=true;
    }
    
            if(!$error){
                if(move_uploaded_file($tmp_poa, 'upload/proof_of_alive/'.$poa_file_name)){
                   echo "POA upload Success!".$poa_file_name; 
                }else{
                    echo "POA upload failed!";    
                    $error=true;
                }
                
            }
                }else { 
                    $poa_file_name=$data['employee_item']['proof_of_alive'];                
                }

        $this->form_validation->set_rules('sap_id', 'SAP ID', 'required');
        $this->form_validation->set_rules('index_no', 'Index No', 'required');
        $this->form_validation->set_rules('ppo_no', 'PPO No', 'required');
        $this->form_validation->set_rules('file_no', 'File No', 'required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');   
        //$this->form_validation->set_rules('image_file', 'Employee Photo', 'required');
       // $this->form_validation->set_rules('nid_no', 'NID', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        //$this->form_validation->set_rules('cell_phone', 'Cell phone', 'required');
        $this->form_validation->set_rules('designation_id', 'Designation', 'required');        
        //$this->form_validation->set_rules('present_address', 'Present Address', 'required');
        //$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
        $this->form_validation->set_rules('retired_branch_id', 'Retired from', 'required');
        $this->form_validation->set_rules('pension_provider_branch_id', 'Pension provider branch', 'required');        
        $this->form_validation->set_rules('dob_time', 'DOB', 'required');
       // $this->form_validation->set_rules('dor_time', 'DOR', 'required');   
        $this->form_validation->set_rules('marital_status', 'Marrital status', 'required');
      //  $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required');        
        $this->form_validation->set_rules('last_basic_during_retirement', 'Last basic during retirement', 'required');
        $this->form_validation->set_rules('pension_amount_during_retirement', 'Pension amount during retirement', 'required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        if ($this->form_validation->run() === FALSE||($error))
        {
//echo "Error in form";
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {

//echo "Ready to update DB".$poa_file_name;

            $this->employee_model->set_employee($id,$image_name,$poa_file_name);
            //$this->load->view('news/success');
            $this->session->set_flashdata('confirmation',"Update successful");
            redirect('employee/index/');
            //redirect( base_url() . 'index.php/employee');
        }
    } 
    
    public function poa_expire_view(){
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/expiredpoa');
        $this->load->view('templates/footer');
    }
    public function expired_emp_list(){
        $from_date = date('Y-m-d', strtotime($this->input->post('date_from')));
        $to_date = date('Y-m-d', strtotime($this->input->post('date_to')));
        
        $this->form_validation->set_rules('from_date', 'From date', 'required');
        $this->form_validation->set_rules('from_date', 'To date ', 'required');
        
        
        $data['employees']  = $this->employee_model->get_employees_expired_poa($from_date,$to_date);
       // var_dump($data);
        
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'Expired Proof of alive employee list of: '.$from_date." To ".$to_date; 
        
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/index', $data);
        $this->load->view('templates/footer');
    }       
    public function expired_emp_list_next(){            
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');
        $first_day_next_month = date('Y-m-d', strtotime ( '+1 month' , strtotime ( $first_day_this_month )) ) ;  
        $last_day_next_month = date("Y-m-t", strtotime($first_day_next_month));      
        $data['employees']  = $this->employee_model->get_employees_expired_poa($first_day_next_month,$last_day_next_month);       
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'Expired Proof of alive employee list of: '.$first_day_next_month." to ".$last_day_next_month; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/index', $data);
        $this->load->view('templates/footer');
    }     
    public function update_poa($id = NULL){
        $id= base64_decode($id);
        $data['employee_poa_item'] = $this->employee_model->get_employees_poa_history($id);        
        if (empty($data['employee_poa_item']))
        {
            show_404();
        }

        $data['title_poa_history'] = 'Employees Proof of alive history'; 
        $data['employee_item'] = $this->employee_model->get_employees($id);        
        if (empty($data['employee_item']))
        {
            show_404();
        }
        $data['errormessage']="";
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        if(isset($_POST) && !empty($_FILES['poa_file']['name'])){
		$name = $_FILES['poa_file']['name'];
		list($txt, $ext) = explode(".", $name);
		$poa_file_name = time().".".$ext;
		$tmp = $_FILES['poa_file']['tmp_name'];
		if(move_uploaded_file($tmp, 'upload/proof_of_alive/'.$poa_file_name)){
                    echo "POA uploading success";
		}else{
			echo "POA uploading failed";
                        $data['errormessage']="File uploading failed";
		}
	}
        

        $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required');       
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();    
        $data['title'] = $data['employee_item']['full_name']; 
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/poa_update_view', $data);
            $this->load->view('templates/footer');            
 
        }
        else
        {
        $this->employee_model->update_employee_poa($id,$poa_file_name);
        //redirect( base_url() . 'index.php/employee');   
        $this->session->set_flashdata('confirmation',"Update successful");
        redirect( base_url() . 'employee/expired_emp_list'); 
        }
        

        
    }
    public function stop_payment_status($id = NULL){
        $id= base64_decode($id);
        
       // $data['employee_poa_item'] = $this->employee_model->get_employees_poa_history($id);        
        $data['title_payment_history'] = 'Employees Payment Status'; 
        $data['employee_item'] = $this->employee_model->get_employees($id);     //nominee info
       
      
        if (empty($data['employee_item']))
        {
            show_404();
        }
        $data['errormessage']="";
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        

        $this->form_validation->set_rules('effective_date_of_stop_payment', 'Effective Date of stop payment', 'required');       
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();    
        $data['title'] = $data['employee_item']['full_name']; 
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/payment_stop_view', $data);
            $this->load->view('templates/footer');            
 
        }
        else
        {
        $this->employee_model->update_employee_payment_stop($id);
        $this->session->set_flashdata('confirmation',"Payment has been stopped!");
        redirect( base_url() . 'employee'); 
        }
        

        
    }
    public function restart_payment_status($id = NULL){
        $id= base64_decode($id);        
        $data['title_payment_history'] = 'Employees Payment Status'; 
        $data['employee_item'] = $this->employee_model->get_employees($id);
        if (empty($data['employee_item']))
        {
            show_404();
        }
        $data['errormessage']="";
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();    
        $data['title'] = $data['employee_item']['full_name']; 
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('employee/payment_restart_view', $data);
            $this->load->view('templates/footer');            
 
        }
        else
        {
        $this->employee_model->update_employee_payment_restart($id);
        $this->session->set_flashdata('confirmation',"Payment has been restarted!");
        redirect( base_url() . 'employee'); 
        }
        

        
    }   
    
    public function approve_maker(){
    $data['selected_ids'] = $this->input->post('selectedItem');  

    // $data is an array of selected item whose status need to be changed to Maker 
     $this->employee_model->update_employee_approve_maker($data);
    // $this->session->set_flashdata('confirmation',"Update successful");
    // redirect( base_url() . 'employee/index'); 
    }    
    public function user_data_submit() {        
    $data = stripslashes($_POST['info']);
      foreach($data as $d){
         echo $d;
      }
    //Either you can print value or you can send value to database
    echo json_encode($data);
}
    public function poa_history($id=NULL){
        $id= base64_decode($id);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('employee/poa_history', $data);
        $this->load->view('templates/footer');
    }    
    public function delete()
    {
        $id = $this->uri->segment(3);
        $id= base64_decode($id);
        if (empty($id)){ show_404();}                
        $employee_item = $this->employee_model->get_employee_by_id($id);        
        $this->employee_model->delete_employee($id);        
        redirect( base_url() . 'index.php/employee');        
    }    
}