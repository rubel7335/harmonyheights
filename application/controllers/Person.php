<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Person extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('person_model');  
        $this->load->model('commondata_model');
        $this->load->model('nominee_model');
        $this->load->model('payment_model');  
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    } 
    public function index()
    {
        $data['person']  = $this->person_model->get_all_personalinfo();
        $data['person_roles']  = $this->person_model->get_person_roles();
      //  var_dump($data['person_roles']); //  exit;
        $data['title'] = 'Personal information'; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('person/index', $data);
        $this->load->view('templates/footer');
    } 
    public function view($id = NULL)
    {
        $id= base64_decode($id);
        $data['person_id'] = $id;
        $data['person_item'] = $this->person_model->get_person($id); 
        //var_dump($data);
        $data['nominees']  = $this->nominee_model->get_nominee_by_perid($id);
        $data['payments']  = $this->payment_model->get_allpayments_bypersonid($id);
        $data['installments']  = $this->payment_model->get_all_installments();
        $data['roles']  = $this->person_model->get_roles();
        $data['person_roles']  = $this->person_model->get_person_roles($id);
        $data['user_categories']  = $this->person_model->get_user_categories();
     //   var_dump($data['person_item']);
        
        if (empty($data['person_item']))
        {
            show_404();
        }
     
        $data['title'] = $data['person_item']['fullname']; 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('person/view', $data);
        $this->load->view('templates/footer');
    }    
    public function create()
    {
        $error=false;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a new shareholder';
        $data['image_error'] = '';
        
        $data['banks'] = $this->commondata_model->get_fis();
        $data['person_roles']  = $this->person_model->get_roles();
      //  var_dump( $data['person_roles']);
      //  exit;

        if(isset($_FILES['image_file'])) {
            $errors     = array();
            $maxsize    = 306000;//in Bytes
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

            /*if(count($errors) === 0) {
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
        }  

                       
       // $this->form_validation->set_rules('person_role_id', 'Person category', 'required');
       // $this->form_validation->set_rules('flat_no', 'flat No', 'required');               
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required');        
        $this->form_validation->set_rules('mother_name', 'Mother Name', 'required');        
        //$this->form_validation->set_rules('spouse_name', 'Spouse Name', 'required');        
        $this->form_validation->set_rules('gender', 'Gender', 'required');        
        $this->form_validation->set_rules('blood_group', 'Blood group', 'required');        
        $this->form_validation->set_rules('birth_date', 'Birth date ', 'required');           
        $this->form_validation->set_rules('present_address', 'Present Address', 'required');
        $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');        
        $this->form_validation->set_rules('nationality', 'Nationality', 'required');
     //   $this->form_validation->set_rules('tin_no', 'Tin', 'required');
      //  $this->form_validation->set_rules('nid_no', 'NID', 'required');
      //  $this->form_validation->set_rules('birth_reg_no', 'Birth reg no', 'required');
     //   $this->form_validation->set_rules('passport_no', 'Passport', 'required');        
        $this->form_validation->set_rules('religion', 'religion', 'required');
        $this->form_validation->set_rules('educational_qualification', 'Education', 'required');
        $this->form_validation->set_rules('organization', 'Organization', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');        
        $this->form_validation->set_rules('office_address', 'Office Address', 'required'); 
        $this->form_validation->set_rules('contact_no', 'Contact no', 'required');        
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        
        if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['image_file']['name']))
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('person/create', $data);
            $this->load->view('templates/footer'); 
        }
    
        else
        {
            move_uploaded_file($tmp, 'upload/'.$image_name);
            $this->person_model->set_person($id=0,$image_name);
            $this->session->set_flashdata('confirmation',"Shareholder information added Successfully");
            redirect('person/index/');
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
        $data['title'] = 'Edit a person';        
          
        $data['person_item']  = $this->person_model->get_person($id);
       // $data['person_roles']  = $this->person_model->get_person_roles();
        $data['roles']  = $this->person_model->get_roles();
        $data['person_roles']  = $this->person_model->get_person_roles($id);

/*if(isset($_FILES['image_file'])) {*/
        if(isset($_POST) && !empty($_FILES['image_file']['name'])){    
                $errors     = array();
                $maxsize    = 306000;//in Bytes
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
                        $errors[] = 'Photo size too large. File must be less than 102 KB.';
                        $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                        $error=true;
                    }

                if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
                        $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                        $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                        $error=true;
                    }
                
                if(!$error){move_uploaded_file($tmp, 'upload/'.$image_name);}

    }else {  $image_name=$data['person_item']['image_url'];$error=false;}
       // $this->form_validation->set_rules('person_role_id', 'Person category', 'required');
      //  $this->form_validation->set_rules('flat_no', 'flat No', 'required');               
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required');        
        $this->form_validation->set_rules('mother_name', 'Mother Name', 'required');        
        $this->form_validation->set_rules('spouse_name', 'Spouse Name', 'required');        
      //  $this->form_validation->set_rules('gender', 'Gender', 'required');        
      //  $this->form_validation->set_rules('blood_group', 'Blood group', 'required');        
        $this->form_validation->set_rules('birth_date', 'Birth date ', 'required');           
      //  $this->form_validation->set_rules('present_address', 'Present Address', 'required');
     //   $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');        
      //  $this->form_validation->set_rules('nationality', 'Nationality', 'required');
       // $this->form_validation->set_rules('tin_no', 'Tin', 'required');
       // $this->form_validation->set_rules('nid_no', 'NID', 'required');
      //  $this->form_validation->set_rules('birth_reg_no', 'Birth reg no', 'required');
      //  $this->form_validation->set_rules('passport_no', 'Passport', 'required');        
       // $this->form_validation->set_rules('religion', 'religion', 'required');
       // $this->form_validation->set_rules('educational_qualification', 'Education', 'required');
       // $this->form_validation->set_rules('organization', 'Organization', 'required');
      //  $this->form_validation->set_rules('designation', 'Designation', 'required');        
       // $this->form_validation->set_rules('office_address', 'Office Address', 'required'); 
      //  $this->form_validation->set_rules('contact_no', 'Contact no', 'required');        
       // $this->form_validation->set_rules('email', 'Email', 'required');
        
        if ($this->form_validation->run() === FALSE||($error))
        {

            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('person/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {

           $return_value = $this->person_model->set_person($id,$image_name);
           if($return_value){
               $person_id = base64_encode($id);
               $this->session->set_flashdata('confirmation',"Update successful");
               redirect('person/view/'.$person_id);
           }else{
               echo "database operation faild";
           }
            //$this->load->view('news/success');
           // $this->session->set_flashdata('confirmation',"Update successful");
           // redirect('person/index/');
            //redirect( base_url() . 'index.php/employee');
        }
    } 
    public function expired_emp_list(){
        $last_day_this_month  = date('Y-m-t');
        $first_day_this_month = date('Y-m-01');       
        $data['employees']  = $this->employee_model->get_employees_expired_poa($first_day_this_month,$last_day_this_month);
        //var_dump($data);
        $this_month  = date('M-Y');
        $data['designations'] = $this->designation_model->get_designations();
        $data['branches'] = $this->branch_model->get_branches();
        $data['title'] = 'Expired Proof of alive employee list of: '.$this_month; 
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
        $this->session->set_flashdata('confirmation',"Payment has been stopped!");
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