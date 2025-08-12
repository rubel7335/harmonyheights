<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Equipment extends CI_Controller {
 
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
            $this->load->model('equipment_model');
            $this->load->model('supplier_model');
            $this->load->model('membership_model');
            $this->load->helper('url_helper');
            $is_loggedIn = $this->session->userdata('username');
            if(empty($is_loggedIn)){
                    redirect('login');
                }
        } 


    public function index()
    {
            $data['eq_expenses']  = $this->equipment_model->get_eq_expenses();
            $data['all_expense_area']  = $this->equipment_model->get_all_expense_area();        
            $data['expense_types'] = $this->equipment_model->get_eq_expensetypes();        
            $data['suppliers'] = $this->supplier_model->get_suppliers();// Get all personal_info id of mgm user
            $data['mgm_users'] = $this->membership_model->get_mgmusers();
            $mgmCat = 4;
            $data['mgm_users_info'] = $this->membership_model->get_mgmusers_info($mgmCat); // var_dump($data['mgm_users_info']); 
            $data['roles']  = $this->person_model->get_roles();
            $data['person']  = $this->person_model->get_person();
        // $data['designations'] = $this->designation_model->get_designations();
        // $data['branches'] = $this->branch_model->get_branches();
            $data['title'] = 'Equipments / materials purchase information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('equipment/index', $data);
            $this->load->view('templates/footer');
        } 

    public function currentstock()
    {
            $data['expdetails']  = $this->equipment_model->get_current_stock();
                // $data['items']      = $this->equipment_model->get_all_items($expense_subarea_id,$grand_parent_id);
            $data['all_items']  = $this->equipment_model->get_all_items();
            $data['units']      = $this->equipment_model->get_all_units();
                //  $data['designations'] = $this->designation_model->get_designations();
                //  $data['branches'] = $this->branch_model->get_branches();
                //  var_dump($data['expdetails']);
            $data['title'] = 'Current stock items'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('equipment/stockcurrent', $data);
            $this->load->view('templates/footer');
        } 




    public function view($id = NULL)
        {
            $id= base64_decode($id);
            $data['eq_expenses']  = $this->equipment_model->get_eq_expenses($id);
                // var_dump($data['eq_expenses']);
            $data['all_expense_area']  = $this->equipment_model->get_all_expense_area();        
            $data['expense_types'] = $this->equipment_model->get_eq_expensetypes();        
            $data['suppliers'] = $this->supplier_model->get_suppliers();// Get all personal_info id of mgm user
            $data['mgm_users'] = $this->membership_model->get_mgmusers();
            $mgmCat = 4;
            $data['mgm_users_info'] = $this->membership_model->get_mgmusers_info($mgmCat); // var_dump($data['mgm_users_info']); 
            $data['roles']  = $this->person_model->get_roles();
            $data['person']  = $this->person_model->get_person();
                // $data['designations'] = $this->designation_model->get_designations();
                // $data['branches'] = $this->branch_model->get_branches();
            $data['title'] = 'Equipments / materials purchase information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('equipment/view', $data);
            $this->load->view('templates/footer');
        }    



    public function create()
    {
        $error=false;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Equipment / materials purchase';
        $data['image_error'] = ''; //Equipment / materials purchase make it by query
        $data['expense_types'] = $this->equipment_model->get_eq_expensetypes();        
        $data['suppliers'] = $this->supplier_model->get_suppliers();// Get all personal_info id of mgm user
        $data['mgm_users'] = $this->membership_model->get_mgmusers();
        $mgmCat = 4;
        $data['mgm_users_info'] = $this->membership_model->get_mgmusers_info($mgmCat); // var_dump($data['mgm_users_info']); 
        $data['roles']  = $this->person_model->get_roles();
        $data['eq_expenses']  = $this->equipment_model->get_eq_expenses(); // var_dump($data['eq_expenses']);
        $data['all_expense_area']  = $this->equipment_model->get_all_expense_area();
        $data['person']  = $this->person_model->get_person();
        if(isset($_FILES['memo_image'])&&(!empty($_FILES['memo_image']['name']))) {        
            $errors     = array();
            $maxsize    = 102400;//in Bytes
            $acceptable = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png'
                );

            $name_photo = @$_FILES['memo_image']['name'];
            list($txt, $ext) = explode(".", $name_photo);
            $image_name = time().".".$ext;
            $tmp = @$_FILES['memo_image']['tmp_name'];

            if(($_FILES['memo_image']['size'] >= $maxsize) || ($_FILES["memo_image"]["size"] == 0)) {
                        $errors[] = 'Photo size too large. File must be less than 100 KB.';// echo    $error_photo='File too large. File must be less than 2 megabytes.';
                        $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                        $this->form_validation->set_message('error_photo','Photo size too large. File must be less than 100 KB');
                        $error=true;
                    }

            if((!in_array($_FILES['memo_image']['type'], $acceptable)) && (!empty($_FILES["memo_image"]["type"]))) {
                        $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                        $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                        $error=true;
                    }
                }else{
                    $this->form_validation->set_rules('memo_image', 'Memo image', 'required');
            } 
                       
            $this->form_validation->set_rules('expense_subarea_id', 'Category', 'required');
            $this->form_validation->set_rules('supplier_id', 'Supplier id', 'required');     
            $this->form_validation->set_rules('purchase_date', 'Date', 'required');
            $this->form_validation->set_rules('total_amount', 'Total amount', 'required');      
            $this->form_validation->set_rules('memo_no', 'Memo no', 'required');        
            $this->form_validation->set_rules('paid_unpaid', 'Paid or Unpaid', 'required');  
            $this->form_validation->set_rules('purchase_type', 'Purchase type', 'required');
            $this->form_validation->set_rules('purchase_by_person_id', 'Purchase by', 'required');
            // $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        

            if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['memo_image']['name']))
                {
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('equipment/create', $data);
                        $this->load->view('templates/footer'); 
                    }
            else
                {
                    move_uploaded_file($tmp, 'upload/equipment/'.$image_name);
                    $this->equipment_model->set_expense($id=0,$image_name);
                     $this->session->set_flashdata('confirmation',"Expense added successfully");
                    redirect('equipment/create/');
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
        $data['employees'] = $this->employee_model->get_employees();
        
    

        /*if(isset($_FILES['image_file'])) {*/
        if(isset($_POST) && !empty($_FILES['image_file']['name'])){    
            $errors     = array();
            $maxsize    = 102000;//in Bytes
            $acceptable = array('image/jpeg','image/jpg','image/gif','image/png');
        
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
                }else {$image_name=$data['employee_item']['image_url'];$error=false;}

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
                $errors[] = 'Proof of alive document size too large. File must be less than 500 KB.';
                $data['error_poa']= 'Proof of alive document size too large. File must be less than 500 KB.';
                $error=true;
            }

        if((!in_array($_FILES['poa_file']['type'], $acceptable)) && (!empty($_FILES["poa_file"]["type"]))) {
                $errors[] = 'Invalid Proof of alive file type. Only PDF, JPG, JPEG types are accepted.';
                $data['error_poa']= 'Invalid Proof of alive file type. Only PDF, JPG,JPEG types are accepted.';
                $error=true;
            }
        
        if(!$error){move_uploaded_file($tmp_poa, 'upload/proof_of_alive/'.$poa_file_name);}
                    }else { $poa_file_name=$data['employee_item']['proof_of_alive'];$error=false;}

            $this->form_validation->set_rules('sap_id', 'SAP ID', 'required');
            $this->form_validation->set_rules('index_no', 'Index No', 'required');
            $this->form_validation->set_rules('ppo_no', 'PPO No', 'required');
            $this->form_validation->set_rules('file_no', 'File No', 'required');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');   // $this->form_validation->set_rules('nid_no', 'NID', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');            //$this->form_validation->set_rules('email', 'Email', 'required'); //$this->form_validation->set_rules('cell_phone', 'Cell phone', 'required');
            $this->form_validation->set_rules('designation_id', 'Designation', 'required');   //$this->form_validation->set_rules('present_address', 'Present Address', 'required'); //$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
            $this->form_validation->set_rules('retired_branch_id', 'Retired from', 'required');
            $this->form_validation->set_rules('pension_provider_branch_id', 'Pension provider branch', 'required');        
            $this->form_validation->set_rules('dob_time', 'DOB', 'required');
            $this->form_validation->set_rules('dor_time', 'DOR', 'required');   
            $this->form_validation->set_rules('marital_status', 'Marrital status', 'required');
            $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required');        
            $this->form_validation->set_rules('last_basic_during_retirement', 'Last basic during retirement', 'required');
            $this->form_validation->set_rules('pension_amount_during_retirement', 'Pension amount during retirement', 'required');
            //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
            
            if ($this->form_validation->run() === FALSE||($error))
            {
                    $this->load->view('templates/header');
                    $this->load->view('templates/menu');
                    $this->load->view('employee/edit', $data);
                    $this->load->view('templates/footer');    
                }
            else
            {
                    $this->employee_model->set_employee($id,$image_name,$poa_file_name);    //$this->load->view('news/success');
                    $this->session->set_flashdata('confirmation',"Update successful");
                    redirect('employee/index/');
                    //redirect( base_url() . 'index.php/employee');
            }
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
            

            $this->form_validation->set_rules('proof_of_alive_validity', 'Proof of alive validity', 'required');  //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
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
                $this->employee_model->update_employee_poa($id,$poa_file_name); //redirect( base_url() . 'index.php/employee');   
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


        public function delete(){
            $id = $this->uri->segment(3);
            $id= base64_decode($id);
            if (empty($id)){ show_404();}                
            $employee_item = $this->employee_model->get_employee_by_id($id);        
            $this->employee_model->delete_employee($id);        
            redirect( base_url() . 'index.php/employee');        
        }    
}