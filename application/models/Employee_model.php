<?php
class Employee_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_employees($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('employees');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('employees', array('id' => $id));
        return $query->row_array();
    }
    public function check_if_generated($current_year,$current_month){
        $this->db->select('id'); 
        $query = $this->db->get_where('salaries', array('salary_year' => $current_year,'salary_month' => $current_month,'nominee_id' => NULL));       
        return $query->result_array();
    }
   
    
    public function rollback_employee_salary($current_year,$current_month,$ids){
       
        foreach ($ids as $id){             
            $this->db->where('salary_id', $id['id']);
            $this->db->delete('salary_breakdowns');     
            //   $str = $this->db->last_query();
            //   echo "<pre>";
             //  print_r($str);
               
        }
        
       // exit;
      //  if($this->db->affected_rows()){
            foreach ($ids as $id){ 
                $this->db->where('id', $id['id']);
                $this->db->delete('salaries');
               //$str = $this->db->last_query();
                //echo "<pre>";
                //print_r($str);
            }
       // }
      
     
    }
    
     public function update_employee_approve_maker($data){
        $user = $this->session->userdata('userID');  

        foreach ($data as $id){      
        //   echo $id;
           $myArray = explode(',', $id);
        }
        foreach ($myArray as $id){ 
//print_r($myArray); 
            $id= base64_decode($id);
           // echo "Decrypted".$id;
          //  exit;
                $emp_update_data = array(
                                    'status' =>1,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                $this->db->update('employees', $emp_update_data);
        }
          
     }
    
    public function get_employees_expired_poa($first_day,$last_day)
    {    
       $this->db->select('*'); 
       $this->db->from('employees'); 
       $this->db->where('proof_of_alive_validity <=',  $last_day);
       $this->db->where('proof_of_alive_validity >=',  $first_day);    
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function get_employees_expired_poa_next($first_day,$last_day)
    {    
       $this->db->select('*'); 
       $this->db->from('employees'); 
       $this->db->where('proof_of_alive_validity <=',  $last_day);
       $this->db->where('proof_of_alive_validity >=',  $first_day);    
       $query = $this->db->get();
       return $query->result_array();
    }
    
    
    public function get_employees_poa_history($id){
       $this->db->select('poa_file,ins_upd_user,ins_upd_time,poa_validity_date'); 
       $this->db->from('poa_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',1); 
       $query = $this->db->get();
       return $query->result_array();
    }
    public function get_dead_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time!=' =>NULL));
        return $query->result_array();
    }
    public function get_alive_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time' => NULL));
        return $query->result_array();
    }
    
    public function get_employee_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('employees');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('employees', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_employee($id=0,$image_name,$poa_file_name)
    {
        
        
        $this->load->helper('url');
              
       $dob_timelen =  strlen($this->input->post('dob_time'));       
       if (strlen($dob_timelen) >1){
            $dob_time = date('Y-m-d', strtotime($this->input->post('dob_time')));
       }else{
            $dob_time = NULL;
       }
       
       $dod_timelen =  strlen($this->input->post('dod_time'));       
       if (strlen($dod_timelen) >1){
            $dod_time = date('Y-m-d', strtotime($this->input->post('dod_time')));
       }else{
           $dod_time = NULL;
       }
       
       $dor_timelen =  strlen($this->input->post('dor_time'));       
       if (strlen($dor_timelen) >1){
            $dor_time = date('Y-m-d', strtotime($this->input->post('dor_time')));
       }else{
           $dor_time = NULL;
       }
       

         $proof_of_alive_validitylen =  strlen($this->input->post('proof_of_alive_validity')); 
         
       if (strlen($proof_of_alive_validitylen) >1){
            $proof_of_alive_validity = date('Y-m-d', strtotime($this->input->post('proof_of_alive_validity')));
       }else{
           $proof_of_alive_validity = NULL;
       }
       
       
        
        /*
        if(($this->input->post('proof_of_alive_validity')==NULL)||($dod_time)||($poa_file_name == NULL)){
            $proof_of_alive_validity=NULL;
        }else $proof_of_alive_validity = date('Y-m-d', strtotime($this->input->post('proof_of_alive_validity')));  
        */
        

        $user = $this->session->userdata('userID'); 
        $data = array(
            'sap_id' => $this->input->post('sap_id'),
            'index_no' => $this->input->post('index_no'),
            'ppo_no' => $this->input->post('ppo_no'),
            'file_no' => $this->input->post('file_no'),
            'full_name' => $this->input->post('full_name'),
            'gender' => $this->input->post('gender'),
            'nid_no' => $this->input->post('nid_no'),
            'email' => $this->input->post('email'),
            'cell_phone' => $this->input->post('cell_phone'),
            'designation_id' => $this->input->post('designation_id'),
            'present_address' => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'retired_branch_id' => $this->input->post('retired_branch_id'),
            'pension_provider_branch_id' => $this->input->post('pension_provider_branch_id'),
            'dob_time' => $dob_time,
            'dor_time' => $dor_time,
            'dod_time' => $dod_time,
            'marital_status ' => $this->input->post('marital_status'),
            'proof_of_alive' => $poa_file_name,
            'proof_of_alive_validity' => $proof_of_alive_validity,
            'last_basic_during_retirement' => $this->input->post('last_basic_during_retirement'),
            'pension_amount_during_retirement ' => $this->input->post('pension_amount_during_retirement'),
            'remarks ' => $this->input->post('remarks'),
            'ins_upd_user' =>$user,
            'ins_upd_db_user'=>$this->db->username,
            'image_url' =>$image_name
        );
        
        if ($id == 0) {
            echo"insert";
            $this->db->insert('employees', $data);            
            $employee_id = $this->db->insert_id();
            
             /*   $data_poa = array(
                'emp_nom_id' => $employee_id,
                'type' =>1,
                'poa_file' => $poa_file_name,
                'poa_validity_date' => $proof_of_alive_validity,
                'remarks' => "Initial entry",                    
                'ins_upd_ip' => getRealIpAddr(),                
                'ins_upd_host' =>gethostname(),
                'ins_upd_user' =>$user,
                'ins_upd_db_user'=>$this->db->username
                );
                return $this->db->insert('poa_history', $data_poa);*/
        } 
        
        if ($id){  
            echo "POA:".$proof_of_alive_validity;
            
                $this->db->where('id', $id);
                $this->db->update('employees', $data);   
                echo $this->db->last_query();
            //    exit;
                $employee_id = $id;
             /*   $data_poa = array(
                'emp_nom_id' => $employee_id,
                'type' =>1,
                'poa_file' => $poa_file_name,
                'poa_validity_date' => $proof_of_alive_validity,
                'ins_upd_ip' => getRealIpAddr(),                
                'ins_upd_host' =>gethostname(),
                'ins_upd_user' =>$user,
                'ins_upd_db_user'=>$this->db->username
                );*/
                //return $this->db->update('poa_history_', $data_poa);   
               // return $this->db->insert('poa_history', $data_poa);   
        }
    }
    
    public function update_employee_poa($id,$poa_file_name){
        if($this->input->post('proof_of_alive_validity')==NULL){
            $proof_of_alive_validity=NULL;
        }else $proof_of_alive_validity = date('Y-m-d', strtotime($this->input->post('proof_of_alive_validity')));  
        
        $user = $this->session->userdata('userID'); 
        $data_poa = array(
                            'emp_nom_id' => $id,'type' =>1,
                            'poa_file' => $poa_file_name,
                            'poa_validity_date' => $proof_of_alive_validity,
                            'remarks' => $this->input->post('remarks'),
                            //'ins_upd_ip' => getRealIpAddr(),                
                            //'ins_upd_host' =>gethostname(),
                            'ins_upd_user' =>$user,
                            'ins_upd_db_user'=>$this->db->username
                        );
                $this->db->insert('poa_history', $data_poa);                
                $this->db->where('id', $id);
                
        $emp_update_data = array(
                                    'proof_of_alive'          =>$poa_file_name,
                                    'proof_of_alive_validity' =>$proof_of_alive_validity,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );        
                return $this->db->update('employees', $emp_update_data);
    }
    public function update_employee_payment_stop($id){
        if($this->input->post('effective_date_of_stop_payment')==NULL){
            $effective_date_of_stop_payment=NULL;
        }else $effective_date_of_stop_payment = date('Y-m-d', strtotime($this->input->post('effective_date_of_stop_payment')));  
        
        $user = $this->session->userdata('userID'); 

                
        $emp_update_data = array(
                                    'effective_date_of_stop_payment' =>$effective_date_of_stop_payment,
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>1,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                return $this->db->update('employees', $emp_update_data);
    }
    public function update_employee_payment_restart($id){        
        $user = $this->session->userdata('userID');                 
        $emp_update_data = array(
                                    
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>0,
                                    'effective_date_of_stop_payment' =>0, 
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                return $this->db->update('employees', $emp_update_data);
    }    
    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employees');
    }
}