<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expense extends CI_Controller {
 
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
        $this->load->model('expense_model');
        $this->load->model('expense_subarea_model');
        $this->load->model('payment_model');  
        $this->load->model('equipment_model');        
        $this->load->model('supplier_model');
        $this->load->model('Fund_transfer_model');        
        $this->load->model('membership_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    } 



    public function index($id = null) {
            
        $id = $this->input->get('id');
        if ($id !== null){
            $data['all_expenses'] = $this->expense_model->get_all_expenses_byperson($id);
           // var_dump($data['records']);
        } else{                
                $data['all_expenses']  = $this->expense_model->get_all_expenses();  
        }
        //var_dump($data['all_expenses']);
        // $data['all_salaryexpenses']  = $this->salaryexpense_model->get_all_salaryexpenses();
            // $data['all_expense_area']  = $this->equipment_model->get_all_expense_area();
            $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
              
            $data['expense_expensecategories']  = $this->expense_model->get_all_expense_subarea();      
            $data['person']  = $this->person_model->get_person();
            $data['expense_types'] = $this->expense_model->get_expensestypes();
            // var_dump($data['expense_subarea']);
            $data['paid_person']  = $this->person_model->get_paid_person();
            //  var_dump( $data['paid_person'] );
            $data['management'] = $this->person_model->get_management();  
            //   var_dump( $data['management'] );              
            $data['title'] = 'Expense information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expense/index', $data);
            $this->load->view('templates/footer');
        } 

        public function approval(){
            $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
            $data['all_expenses']  = $this->expense_model->get_all_pending_expenses();   
            $data['person']  = $this->person_model->get_person();
            $data['expense_types'] = $this->expense_model->get_expensestypes();
            $data['paid_person']  = $this->person_model->get_paid_person();
            $data['management'] = $this->person_model->get_management();  
            $data['title'] = 'Expense information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expense/approval', $data);
            $this->load->view('templates/footer');
        }
        
        public function approve($id = NULL){
            // $id = $this->uri->segment(3);
                $id = base64_decode($id);
            // echo "Expense ID:".$id;                        
                $this->expense_model->approve_expense($id);        
            // redirect( 'payment/approve/'); 
                redirect('expense/index/');
            }

    public function view($id = NULL)
    {
            $id= base64_decode($id);
            $data['expense_id']=$id;
            $data['expenses_item']  = $this->expense_model->get_all_expenses($id);  
            $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();                
            $data['person']  = $this->person_model->get_person();
            $data['expense_types'] = $this->expense_model->get_expensestypes();
        //  var_dump($data['expense_types']);
            $data['paid_person']  = $this->person_model->get_paid_person();
        //  var_dump( $data['paid_person'] );
            $data['management'] = $this->person_model->get_management();  
         //   var_dump( $data['management'] );
              
        // $data['designations'] = $this->designation_model->get_designations();
        // $data['branches'] = $this->branch_model->get_branches();
            $data['title'] = 'Expense information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expense/view', $data);
            $this->load->view('templates/footer');
        }  
        

        public function expense_by_person(){
            // $data['all_salaryexpenses']  = $this->salaryexpense_model->get_all_salaryexpenses();
            // $data['all_expense_area']  = $this->equipment_model->get_all_expense_area();
          //  $data['expense_subarea']  = $this->expense_model->get_all_expsubarea();
            $data['all_expenses_group_by']  = $this->expense_model->get_total_amount_spent();    
            var_dump( $data['all_expenses_group_by'] );
            
           // $data['expense_expensecategories']  = $this->expense_model->get_all_expense_subarea();      
            $data['person']  = $this->person_model->get_person();
            // $data['expense_types'] = $this->expense_model->get_expensestypes();
            // var_dump($data['expense_subarea']);
            $data['paid_person']  = $this->person_model->get_paid_person();
            //  var_dump( $data['paid_person'] );
            $data['management'] = $this->person_model->get_management();  
            //   var_dump( $data['management'] );              
            $data['title'] = 'Expense information'; 
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expense/individual', $data);
            $this->load->view('templates/footer');

        }
    
    public function create()
    {
        $error=false;
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add expense';
        $data['image_error'] = '';
        
       // $data['expense_subarea']  = $this->salaryexpense_model->get_all_expsubarea();
       // $data['all_salaryexpenses']  = $this->salaryexpense_model->get_all_salaryexpenses();
        
        $data['person']  = $this->person_model->get_person();
        $data['expenses_types'] = $this->expense_model->get_expensestypes();
        $data['paid_person']  = $this->person_model->get_paid_person(); //  var_dump( $data['paid_person'] );
        $data['records'] = $this->Fund_transfer_model->read_currentbalance();
      //  var_dump($data['records']);
    
        $data['management'] = $this->person_model->get_management(); 
       

        if(isset($_FILES['memo_image'])) {
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
                            $errors[] = 'Photo size too large. File must be less than 100 KB.';
                        // echo    $error_photo='File too large. File must be less than 2 megabytes.';
                            $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                            $this->form_validation->set_message('error_photo','Photo size too large. File must be less than 100 KB');
                            $error=true;
                        }

                    if((!in_array($_FILES['memo_image']['type'], $acceptable)) && (!empty($_FILES["memo_image"]["type"]))) {
                            $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                            $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                            $error=true;
                        }

                }  
     

                       
        $this->form_validation->set_rules('expense_subarea_id', 'Equipments / materials category', 'required');
       // $this->form_validation->set_rules('person_id', 'Person id', 'required');     
        $this->form_validation->set_rules('payment_date', 'Payment Date', 'required');
      //  $this->form_validation->set_rules('total_amount', 'Total amount', 'required');      
        $this->form_validation->set_rules('total_amount', 'Total amount', 'required|callback_check_balance');

        $this->form_validation->set_rules('memo_no', 'Memo no', 'required');             
        $this->form_validation->set_rules('paid_by_person_id', 'Paid by', 'required');
        
       // $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        

        if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['memo_image']['name']))
        {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('expense/create', $data);
                $this->load->view('templates/footer'); 
            }
    
        else
        {
                move_uploaded_file($tmp, 'upload/expense/'.$image_name);
                $this->expense_model->set_expense($id=0,$image_name);
                $this->session->set_flashdata('confirmation',"Expense added successfully");
                redirect('expense/index/');
            }
    }

    public function check_balance($total_amount) {
        $personId = $this->input->post('paid_by_person_id');
        $result = $this->db->select('current_balance')->where('personal_id', $personId)->get('balance')->row();

        if ($result) {
            $current_balance = $result->current_balance;
            // Use $current_balance as needed
        } else {
            // Handle the case where the query did not return a valid result
         //   echo "No valid result found for personal_id: $personId";
         $this->form_validation->set_message('check_balance', 'The {field} must be less than or equal to the current balance.');
           
            return false; 
        }
        
        

        //    $current_balance = $this->db->select('current_balance')->where('personal_id', $personId)->get('balance')->row()->current_balance;
        
        if ($total_amount <= $current_balance) {
            return true; // Validation passed
        } else {
            $this->form_validation->set_message('check_balance', 'The {field} must be less than or equal to the current balance.');
            return false; // Validation failed
        }
    }


    public function incomeexpense(){
        $data['magm_users_id']= $this->membership_model->get_mgmusers_id();
     
        $person_info_array = array();

        foreach ($data['magm_users_id'] as $person_item):             
            $data['person_info']  = $this->person_model->get_person($person_item['personal_id']);  
            $name=$data['person_info']['fullname']; 
            $person_id=$data['person_info']['id'];   
            $data['all_expenses_group_by']  = $this->expense_model->get_total_amount_spent($person_item['personal_id']);
            if (!empty($data['all_expenses_group_by'])) {
                $spent = $data['all_expenses_group_by'][0]->total_amount_spent;
                } else {
                    $spent = 0; 
                }

            $data['all_caswithdraw_group_by']  = $this->Fund_transfer_model->get_total_cash_withdraw($person_item['personal_id']);  
            $withdraw=$data['all_caswithdraw_group_by'][0]->total_amount_withdraw;  
            $cash_in_hand =$withdraw-$spent;    
            $person_info_array[$person_id] = array(
                                                'person_id' =>$person_id,
                                                'name' => $name,
                                                'spent' => $spent,
                                                'withdraw' => $withdraw,
                                                'cash_in_hand' => $cash_in_hand,
                                            );
        endforeach;
        $data['person_info_array']= $person_info_array;
        $data['payments']  = $this->payment_model->get_payments();
        $credits=0;$debits=0; $totalExp=0;$totalincome=0;$totalAdv=0;$totalBalance=0;
        
        foreach ($data['payments'] as $payment_item): 
            $debitCredit=$payment_item['payment_type'];if($debitCredit =='Credit'){$credits=$credits+$payment_item['deposit_amount']; } 
            $debitCredit=$payment_item['payment_type'];if($debitCredit =='Debit'){$debits=$debits+$payment_item['deposit_amount'];}
        endforeach;

        $totalincome = $credits-$debits;
        $data['person_roles']       = $this->person_model->get_person_roles();
        $data['installments']       = $this->payment_model->get_all_installments();
        $data['titleIncome']        = 'Income information'; 
        $data['expense_subarea']    = $this->expense_model->get_all_expsubarea();
        $data['all_expenses']       = $this->expense_model->get_all_confirmed_expenses();      
        
      
        foreach ($data['all_expenses'] as $all_expense): 
            $total_amount=$all_expense['total_amount'];
             $totalExp = $totalExp+$total_amount;
        endforeach;
 
        $data['all_advances']  = $this->expense_model->get_all_advances(); 
        foreach ($data['all_advances'] as $all_advances): 
            $total_amount=$all_advances['amount'];
            $totalAdv = $totalAdv+$total_amount;
        endforeach;

        $data['current_balances']  = $this->expense_model->get_current_balance(); 
        foreach ($data['current_balances'] as $all_balances): 
            $totalBalance = $totalBalance+$all_balances['current_balance'];
        endforeach;

        $data['total_income']=$totalincome ;
        $data['total_expense']=$totalExp ;
        $data['total_advance']=$totalAdv ;
        $data['total_balance']=$totalBalance ;

        $data['person']  = $this->person_model->get_person();
        $data['expense_types'] = $this->expense_model->get_expensestypes();
        $data['paid_person']  = $this->person_model->get_paid_person();
        $data['management'] = $this->person_model->get_management();        
        $data['titleExpense'] = 'Expense information'; 

            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('expense/incomeexpense', $data);
            $this->load->view('templates/footer');
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
        $data['title'] = 'Edit expense';     
        
        $data['expenses_item']  = $this->expense_model->get_all_expenses($id);  
       
       // var_dump($data['expenses_item']);
        $data['person']  = $this->person_model->get_person();
        $data['expenses_types'] = $this->expense_model->get_expensestypes();
        $data['paid_person']  = $this->person_model->get_paid_person(); //  var_dump( $data['paid_person'] );    
        $data['management'] = $this->person_model->get_management(); 
        
    
        if(isset($_POST) && !empty($_FILES['memo_image']['name'])){    
            $errors     = array();
            $maxsize    = 306000;//in Bytes
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
                    $errors[] = 'Photo size too large. File must be less than 102 KB.';
                    $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                    $error=true;
                }

            if((!in_array($_FILES['memo_image']['type'], $acceptable)) && (!empty($_FILES["memo_image"]["type"]))) {
                    $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                    $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                    $error=true;
                }
            
            if(!$error){move_uploaded_file($tmp, 'upload/expense/'.$image_name);}

        }else {  $image_name=$data['expenses_item']['memo_image'];$error=false;}

        $this->form_validation->set_rules('expense_subarea_id', 'Equipments / materials category', 'required');
        // $this->form_validation->set_rules('person_id', 'Person id', 'required');     
        $this->form_validation->set_rules('payment_date', 'Payment Date', 'required');
      //  $this->form_validation->set_rules('total_amount', 'Total amount', 'required');  
        $this->form_validation->set_rules('total_amount', 'Total amount', 'required|callback_check_balance');    
        $this->form_validation->set_rules('memo_no', 'Memo no', 'required');             
        $this->form_validation->set_rules('paid_by_person_id', 'Paid by', 'required');
        // $this->form_validation->set_rules('remarks', 'Remarks', 'required');

    
 

        if ($this->form_validation->run() === FALSE||($error))
        {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('expense/edit', $data);
                $this->load->view('templates/footer');

            }
        else
        {

        $return_value = $this->expense_model->set_expense($id,$image_name);
            if($return_value){
                $expense_id = base64_encode($id);
                $this->session->set_flashdata('confirmation',"Update successful");
                redirect('expense/view/'.$expense_id);
            }else{
                echo "Database operation faild!";
            }
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