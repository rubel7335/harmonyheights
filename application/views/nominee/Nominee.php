<?php
class Nominee extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('branch_model');
        $this->load->model('employee_model');
        $this->load->model('nominee_model');
        $this->load->model('fi_model');
        $this->load->model('category_model');
        $this->load->model('designation_model');
        $this->load->model('pension_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }
 
    public function index()
    {
      //  $data['employees']  = $this->employee_model->get_employees();
        $data['nominees']  = $this->nominee_model->get_nominees();
      //  $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'Nominee archive';         
        //print_r($data);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/index', $data);
        $this->load->view('templates/footer');
    }
    public function get_nominee_id()
    {           
        $id = $this->uri->segment(3);        
        $id = base64_decode($id);
        $data['nominee_id'] = $id;
        if (empty($id))
        {
            show_404();
        }   
       // $data['employees']  = $this->employee_model->get_employees();
        $data['employee'] = $this->employee_model-> get_employee_by_id($id);
       // print_r($data['employee']);
        $data['nominees']  = $this->nominee_model->get_nominee_by_empid($id);
       // print_r($data['nominees']);
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['emp_name'] = $data['employee']['full_name']; 
        $data['emp_sap'] = $data['employee']['sap_id']; 
        $data['employee_image'] = $data['employee']['image_url'];
       
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/nominee_by_empid', $data);        
        $this->load->view('templates/footer');       
        
        
    }    
    public function create($id = NULL)
    {
        $error=false;
        $encryptId = $id;
        $id= base64_decode($id);
       // echo $id;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data["encryptedID"] = $encryptId;
        $data['title'] = 'Add a new nominee';
        $data['employee_id']=$id;        
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();      
        $data['employees_pension_info'] = $this->nominee_model-> get_employee_pension_basic($id);
      //print_r($data['employees_pension_info']); 
        $data['employee'] = $this->employee_model-> get_employee_by_id($id);
        if(isset($_FILES['image_file'])) {
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
                $errors[] = 'Photo size too large. File must be less than 100 KB.';
                $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                $this->form_validation->set_message('error_photo','Photo size too large. File must be less than 100 KB');
                $error=true;
            }

            if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
                $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                $error=true;
            }

        }  
        if(isset($_FILES['poa_file'])) {
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
                $errors[] = 'Proof of alive document size too large. File must be less than 500 KB.';
                $error_poa = 'Proof of alive document size too large. File must be less than 500 KB.';
                $data['error_poa']= 'Proof of alive document size too large. File must be less than 500 KB.';
                $error=true;
            }

            if((!in_array($_FILES['poa_file']['type'], $acceptable)) && (!empty($_FILES["poa_file"]["type"]))) {
                $errors[] = 'Invalid Proof of alive file type. Only PDF, JPG, JPEG types are accepted.';
                $error_poa = 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
                $data['error_poa']= 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
                $error=true;
            }
        } 
        if(isset($_FILES['nmc_file'])) {
            $errors     = array();
            $maxsize    = 512000;//in Bytes
            $acceptable = array(
                'application/pdf',
                'image/jpeg',
                'image/jpg'
            );

            $name_nmc = @$_FILES['nmc_file']['name'];
            list($txt, $ext) = explode(".", $name_nmc);
            $nmc_file_name = time().".".$ext;
            $tmp_nmc = @$_FILES['nmc_file']['tmp_name'];

            if(($_FILES['nmc_file']['size'] >= $maxsize) || ($_FILES["nmc_file"]["size"] == 0)) {
                $errors[] = 'Non marriage certificate document size too large. File must be less than 500 KB.';
                $error_poa = 'Non marriage certificate size too large. File must be less than 500 KB.';
                $data['error_poa']= 'Non marriage certificate  size too large. File must be less than 500 KB.';
                $error=true;
            }

            if((!in_array($_FILES['nmc_file']['type'], $acceptable)) && (!empty($_FILES["nmc_file"]["type"]))) {
                $errors[] = 'Invalid Non marriage certificate file type. Only PDF, JPG, JPEG types are accepted.';
                $error_poa = 'Invalid Non marriage certificate  type. Only PDF, JPG, JPEG types are accepted.';
                $data['error_poa']= 'Invalid Non marriage certificate type. Only PDF, JPG,JPEG types are accepted.';
                $error=true;
            }
        } 
       
        //print_r($data['employee']);
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');        
        $this->form_validation->set_rules('relation', 'Relation', 'required');
        $this->form_validation->set_rules('marital_status', 'Marrital status', 'required');
        $this->form_validation->set_rules('physical_status', 'Physical status', 'required');        
        $this->form_validation->set_rules('pension_percentage', 'Pension Percentage', 'required');
        $this->form_validation->set_rules('payment_method', 'Payment method', 'required');            
       // $this->form_validation->set_rules('payment_to_account_no', 'Payment to account no', 'required');            
        $this->form_validation->set_rules('payment_to_bank_id', 'Payment to Bank', 'required');
        $this->form_validation->set_rules('payment_to_branch_id', 'Payment to Branch', 'required'); 
        //$this->form_validation->set_rules('email', 'Email', 'required');
       // $this->form_validation->set_rules('nid_no', 'Nid_no', 'required');
        //$this->form_validation->set_rules('cell_phone', 'Cell phone', 'required');
        //$this->form_validation->set_rules('present_address', 'Present Address', 'required');
        //$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
        $this->form_validation->set_rules('pension_provider_branch_id', 'Pension provider branch', 'required');
        $this->form_validation->set_rules('dob_time', 'DOB', 'required');  
        $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required'); 
        $this->form_validation->set_rules('non_marriage_cert_validity', 'Non marriage certificate validity', 'required'); 
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        

        if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['image_file']['name'])||empty($_FILES['poa_file']['name']))
        {            
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nominee/create', $data);
            $this->load->view('templates/footer'); 
        }  
        else
        {   
            move_uploaded_file($tmp,'upload/nominee/'.$image_name);
            move_uploaded_file($tmp_poa,'upload/proof_of_alive/'.$poa_file_name);
            move_uploaded_file($tmp_nmc,'upload/non_marriage_certificate/'.$nmc_file_name);
            $nominee_id=$this->nominee_model->set_nominee($id=0,$image_name,$poa_file_name,$nmc_file_name);          
            $this->nominee_model->set_nominee_basic($nominee_id,$data['employees_pension_info']);
            $this->session->set_flashdata('confirmation',"Nominee information added Successfully");
            redirect('employee/index/');
            /*
            $this->load->view('templates/header');
            $this->load->view('nominee/success');
            $this->load->view('templates/footer');  */          
        }        
    }
    public function view($id = NULL)
    {
        $id = base64_decode($id);
        $data['nominee_id'] = $id;
        $data['nominee_item'] = $this->nominee_model->get_nominees($id);
        $data['pension_item']  = $this->pension_model->get_pension_by_nominee_id($id); 
        $data['nominee_poa_item'] = $this->nominee_model->get_nominees_poa_history($id);
        $data['nominee_nmc_item'] = $this->nominee_model->get_nominees_nmc_history($id);
        if (empty($data['nominee_item']))
        {
            show_404();
        }
        $data['designations'] = $this->designation_model->get_designations();
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();    
        $data['title'] = $data['nominee_item']['full_name']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/view', $data);
        $this->load->view('templates/footer');
    } 
    public function edit()
    {
        $error=false; 
        $id = $this->uri->segment(3);
        $id = base64_decode($id);
        if (empty($id))
        {
            show_404();
        }

      
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a Nominee';
        $data['nominee_item'] = $this->nominee_model->get_nominee_by_id($id);        
        //$data['employee_item'] = $this->employee_model->get_employee_by_id($id);  
        $emp_id = $data['nominee_item']['employee_id'];
        $emp_id = base64_encode($emp_id);
       // var_dump($data['nominee_item'] );
        $data['pension_item']  = $this->pension_model->get_pension_by_nominee_id($id);
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();
        $data['designations'] = $this->designation_model->get_designations();
        $data['nominees_pension_info'] = $this->nominee_model->get_nominee_pension_basic($id);
        
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
            $errors[] = 'Photo size too large. File must be less than 100 KB.';
            $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
            $error=true;
        }

        if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
            $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
            $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
            $error=true;
        }
        if(!$error){move_uploaded_file($tmp, 'upload/nominee/'.$image_name);}





    }else {  $image_name=$data['nominee_item']['image_url'];$error=false;} 
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
            $errors[] = 'Proof of alive document size too large. File must be less than 500 KB.';
            $data['error_poa']= 'Proof of alive document size too large. File must be less than 500 KB.';
            $error=true;
        }

        if((!in_array($_FILES['poa_file']['type'], $acceptable)) && (!empty($_FILES["poa_file"]["type"]))) {
            $errors[] = 'Invalid Proof of alive file type. Only PDF, JPG, JPEG types are accepted.';
            $data['error_poa']= 'Invalid Proof of alive file type. Only PDF, JPG, JPEG types are accepted.';
            $error=true;
        }
        if(!$error){move_uploaded_file($tmp_poa, 'upload/proof_of_alive/'.$poa_file_name);}

    }else { $poa_file_name=$data['nominee_item']['proof_of_alive'];$error=false;}
        if(isset($_POST) && !empty($_FILES['nmc_file']['name'])){   
        $errors     = array();
        $maxsize    = 512000;//in Bytes
        $acceptable = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg'
        );

        $name_nmc = @$_FILES['nmc_file']['name'];
        list($txt, $ext) = explode(".", $name_nmc);
        $nmc_file_name = time().".".$ext;
        $tmp_nmc = @$_FILES['nmc_file']['tmp_name'];

        if(($_FILES['nmc_file']['size'] >= $maxsize) || ($_FILES["nmc_file"]["size"] == 0)) {
            $errors[] = 'Non marriage certificate size too large. File must be less than 500 KB.';
            $data['error_nmc']= 'Non marriage certificate size too large. File must be less than 500 KB.';
            $error=true;
        }

        if((!in_array($_FILES['nmc_file']['type'], $acceptable)) && (!empty($_FILES["nmc_file"]["type"]))) {
            $errors[] = 'Invalid Non marriage certificate file type. Only PDF, JPG, JPEG types are accepted.';
            $data['error_nmc']= 'Invalid Non marriage certificate file type. Only PDF, JPG,JPEG types are accepted.';
            $error=true;
        }
        if(!$error){move_uploaded_file($tmp_nmc, 'upload/non_marriage_certificate/'.$nmc_file_name);}
    }else { $nmc_file_name=$data['nominee_item']['non_marriage_cert'];$error=false;}    
        
        
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');        
        $this->form_validation->set_rules('relation', 'Relation', 'required');
        $this->form_validation->set_rules('marital_status', 'Marrital status', 'required');
        $this->form_validation->set_rules('physical_status', 'Physical status', 'required');        
        $this->form_validation->set_rules('pension_percentage', 'Pension Percentage', 'required');        
        $this->form_validation->set_rules('payment_method', 'Payment method', 'required');            
        $this->form_validation->set_rules('payment_to_account_no', 'Payment to account no', 'required');            
        $this->form_validation->set_rules('payment_to_bank_id', 'Payment to Bank', 'required');
        $this->form_validation->set_rules('payment_to_branch_id', 'Payment to Branch', 'required'); 
        //$this->form_validation->set_rules('email', 'Email', 'required');
       // $this->form_validation->set_rules('nid_no', 'NID no', 'required');
        //$this->form_validation->set_rules('cell_phone', 'Cell phone', 'required');
        //$this->form_validation->set_rules('present_address', 'Present Address', 'required');
        //$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
        $this->form_validation->set_rules('pension_provider_branch_id', 'Pension provider branch', 'required');
        $this->form_validation->set_rules('dob_time', 'DOB', 'required');
        $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required'); 
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        
        //if ($this->form_validation->run() === FALSE)
        if ($this->form_validation->run() === FALSE||($error))
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nominee/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $nominee_id=$this->nominee_model->set_nominee($id,$image_name,$poa_file_name,$nmc_file_name);          
            $this->nominee_model->update_nominee_basic($nominee_id,$data['nominees_pension_info']);     
            $this->session->set_flashdata('confirmation',"Update successful");
            redirect('employee/view/'.$emp_id);

        }
    }
    public function update_poa($id = NULL){
        $id= base64_decode($id);
        $data['nominee_id'] = $id;
        $data['nominee_poa_item'] = $this->nominee_model->get_nomineess_poa_history($id); 
        $data['pension_item']  = $this->pension_model->get_pension_by_nominee_id($id);
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();   
        $data['title_poa_history'] = 'Nominees Proof of alive history'; 
        $data['nominee_item'] = $this->nominee_model->get_nominees($id);  
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
       // $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();    
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nominee/poa_update_view', $data);
            $this->load->view('templates/footer');            
 
        }
        else
        {
        $this->nominee_model->update_nominee_poa($id,$poa_file_name);
        $this->session->set_flashdata('confirmation',"Update successful");
      //  redirect( base_url() . 'index.php/nominee');  
        redirect( base_url() . 'nominee/expired_nominee_list');
        }
    }
    
    public function update_nmc($id = NULL){
        $id= base64_decode($id);
        $data['nominee_id'] = $id;
        $data['nominee_nmc_item'] = $this->nominee_model->get_nomineess_nmc_history($id); 
        $data['pension_item']  = $this->pension_model->get_pension_by_nominee_id($id);
        $data['fis'] = $this->fi_model->get_fis();
        $data['branches'] = $this->branch_model->get_branches();   
        $data['title_nmc_history'] = 'Nominees non marriage certificate history'; 
        $data['nominee_item'] = $this->nominee_model->get_nominees($id);  
        $data['errormessage']="";
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        if(isset($_POST) && !empty($_FILES['nmc_file']['name'])){
		$name = $_FILES['nmc_file']['name'];
		list($txt, $ext) = explode(".", $name);
		$nmc_file_name = time().".".$ext;
		$tmp = $_FILES['nmc_file']['tmp_name'];
		if(move_uploaded_file($tmp, 'upload/non_marriage_certificate/'.$nmc_file_name)){
                    echo "NMC uploading success";
		}else{
			echo "NMC uploading failed";
                        $data['errormessage']="File uploading failed";
		}
	}
        

        $this->form_validation->set_rules('non_marriage_cert_validity', 'Certificate validity', 'required');       
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();    
        //$data['title'] = $data['employee_item']['full_name']; 
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('nominee/nmc_update_view', $data);
            $this->load->view('templates/footer');            
 
        }
        else
        {
        $this->nominee_model->update_nominee_nmc($id,$nmc_file_name);
        $this->session->set_flashdata('confirmation',"Update successful");
       // redirect( base_url() . 'index.php/nominee');  
        redirect( base_url() . 'nominee/expired_nominee_nmc_list'); 
        }
    }
    

    
    public function expired_nominee_list(){
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');       
        $data['nominees']  = $this->nominee_model->get_nominees_expired_poa($first_day_this_month,$last_day_this_month);
        //var_dump($data);
        $this_month  = date('M-Y');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'List of expired proof of alive of: '.$this_month; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/nominee_expired_list', $data);
        $this->load->view('templates/footer');
    }    
    
    public function expired_nominee_list_next(){            
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');
        $first_day_next_month = date('Y-m-d', strtotime ( '+1 month' , strtotime ( $first_day_this_month )) ) ;  
        $last_day_next_month = date("Y-m-t", strtotime($first_day_next_month));      
        $data['nominees']  = $this->nominee_model->get_nominees_expired_poa($first_day_next_month,$last_day_next_month);       
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'List of expired proof of alive of:'.$first_day_next_month." to ".$last_day_next_month; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/nominee_expired_list', $data);
        $this->load->view('templates/footer');
    } 
    
    public function expired_nominee_nmc_list(){
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');       
        $data['nominees']  = $this->nominee_model->get_nominees_expired_nmc($first_day_this_month,$last_day_this_month);
        //var_dump($data);
        $this_month  = date('M-Y');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'List of expired non marriage certificate of:'.$this_month; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/nominee_nmc', $data);
        $this->load->view('templates/footer');
    }
    
    public function expired_nominee_nmc_list_next(){            
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');
        $first_day_next_month = date('Y-m-d', strtotime ( '+1 month' , strtotime ( $first_day_this_month )) ) ;  
        $last_day_next_month = date("Y-m-t", strtotime($first_day_next_month));      
        $data['nominees']  = $this->nominee_model->get_nominees_expired_nmc($first_day_next_month,$last_day_next_month);       
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'List of expired proof of alive non marriage certificate of:'.$first_day_next_month." to ".$last_day_next_month; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('nominee/nominee_nmc', $data);
        $this->load->view('templates/footer');
    }
    
    
    public function stop_payment_status($id = NULL){
        $id= base64_decode($id);
        
        $data['employee_poa_item'] = $this->employee_model->get_employees_poa_history($id);        
        $data['title_payment_history'] = 'Employees Payment Status'; 
        $data['employee_item'] = $this->employee_model->get_employees($id);     
       
      
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
        $this->session->set_flashdata('confirmation',"Payment has been stopped!");
        redirect( base_url() . 'employee'); 
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
                
        $nominee_item = $this->nominee_model->get_nominee_by_id($id);
        
        $this->nominee_model->delete_nominee($id);        
        redirect( base_url() . 'index.php/nominee');        
    }
}