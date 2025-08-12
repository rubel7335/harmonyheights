<?php
class Nominee_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_nominees($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('nominee_info');
            return $query->result_array();
        }
       
        $query = $this->db->get_where('nominee_info', array('id' => $id));
        return $query->row_array();
    }
    
    public function get_nominee_by_id($id)
    {
        $query = $this->db->get_where('nominee_info', array('id' => $id));
        return $query->row_array();
          
        //var_dump($query->row_array());
    }
    
    public function get_nominee_by_perid($id)
    {
        $query = $this->db->get_where('nominee_info', array('personal_id' => $id));
        return $query->result_array();
        //var_dump($query->row_array());
    }
    
    
    public function get_employee_pension_basic($id)
    {
        $this->db->select('emp.*');  
        $this->db->select('pbi.last_increment_date,pbi.next_increment_date,pbi.fixation_date,pbi.period_for_payment,pbi.remarks'); 
        $this->db->from('employees emp');
        $this->db->join('pension_basic_informations pbi','emp.id=pbi.employee_id','left');  
        $this->db->where('pbi.nominee_id', "0");
        $this->db->where('emp.id',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();die();
        return $query->row_array();
    }
    
    public function get_nominee_pension_basic($id)
    {
        $this->db->select('nom.*,emp.id');  
        $this->db->select('pbi.last_increment_date,pbi.next_increment_date,pbi.fixation_date,pbi.period_for_payment,pbi.remarks'); 
        $this->db->from('nominees nom');
        $this->db->join('pension_basic_informations pbi','nom.id=pbi.nominee_id','left'); 
        $this->db->join('employees emp','emp.id=nom.employee_id','left'); 
       // $this->db->where('employee_id', "0");
        $this->db->where('nom.id',$id);
        $query = $this->db->get();
       // echo $this->db->last_query();die();
       return $query->row_array();
    }
    
    public function get_nominees_poa_history($id){
       $this->db->select('poa_file,ins_upd_user,ins_upd_time,poa_validity_date'); 
       $this->db->from('poa_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',2); 
       $query = $this->db->get();
       return $query->result_array();
    }
    
    
    public function get_nominees_nmc_history($id){
       $this->db->select('non_marriage_cert,ins_upd_user,ins_upd_time,non_marriage_cert_validity'); 
       $this->db->from('nmc_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',2); 
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function set_nominee($id=0,$image_name=NULL)
    {
        
        $this->load->helper('url');
        //$id = base64_decode($id);
        if($this->input->post('birth_date')==NULL){
            $birth_date=NULL;
        }else $birth_date = date('Y-m-d', strtotime($this->input->post('birth_date')));         
       
        $user = $this->session->userdata('userID'); 
        $data = array(            
            'personal_id' => $this->input->post('personal_id'), 
            'fullname' => $this->input->post('fullname'),
            'relation' => $this->input->post('relation'),
            'share_percentage' => $this->input->post('share_percentage'),
            'gender' => $this->input->post('gender'),
            'blood_group' => $this->input->post('blood_group'),
            'marital_status' => $this->input->post('marital_status'),
            'birth_date' => $birth_date,
            'present_address' => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'nationality' => $this->input->post('nationality'),
            'nid_no' => $this->input->post('nid_no'),
            'birth_reg_no' => $this->input->post('birth_reg_no'),
            'passport_no' => $this->input->post('passport_no'),
            'religion' => $this->input->post('religion'),
            'educational_qualification' => $this->input->post('educational_qualification'),
            'organization' => $this->input->post('organization'),                     
            'designation' => $this->input->post('designation'),
            'office_address' => $this->input->post('office_address'),
            'contact_no' => $this->input->post('contact_no'),
            'email' => $this->input->post('email'),            
            'image_url' => $image_name,
           // 'sign_url' => $sign_name,
            'ins_upd_usr' =>$user,            
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );        


            if(!($id)){    
            $this->db->insert('nominee_info', $data);
            $nominee_id = $this->db->insert_id();              
                return  $nominee_id;
            }
            if($id){   
                $this->db->where('id', $id);
                $this->db->update('nominee_info', $data);                     
                return  $nominee_id;
            }
    }
    
    public function set_nominee_basic($nomineeId,$empInfo)
    {
        $user = $this->session->userdata('userID'); 
        $this->load->helper('url');
        $data = array(  
            'employee_id' => $empInfo['id'],
            'nominee_id' => $nomineeId,
            'pension_basic' => $empInfo['pension_amount_during_retirement'],
            'last_increment_date' => $empInfo['last_increment_date'],
            'next_increment_date' => $empInfo['next_increment_date'],
            'fixation_date' => $empInfo['fixation_date'],
            'period_for_payment' =>$empInfo['period_for_payment'],
            'remarks' => $empInfo['remarks'],
            'payment_method' => $this->input->post('payment_method'),
            'payment_to_account_no' => $this->input->post('payment_to_account_no'),
            'payment_to_bank_id' => $this->input->post('payment_to_bank_id'),
            'payment_to_branch_id' => $this->input->post('payment_to_branch_id'),
            'ins_upd_ip' => getRealIpAddr(),                
            'ins_upd_host' => gethostname(),
            'ins_upd_user' => $user,
            'ins_upd_db_user' =>$this->db->username
        );        
        return $this->db->insert('pension_basic_informations', $data);
    }
    public function update_nominee_basic($nomineeId,$empInfo){
    $this->load->helper('url');
        $data = array(  
            'payment_method' => $this->input->post('payment_method'),
            'payment_to_account_no' => $this->input->post('payment_to_account_no'),
            'payment_to_bank_id' => $this->input->post('payment_to_bank_id'),
            'payment_to_branch_id' => $this->input->post('payment_to_branch_id')
        );
         $this->db->where('employee_id',  $empInfo['id']);
         $this->db->where('nominee_id',  $nomineeId);
         return $this->db->update('pension_basic_informations', $data); 
        //return $this->db->update('pension_basic_informations', $data);        
    }
    
    public function get_nomineess_poa_history($id){
       $this->db->select('poa_file,ins_upd_user,ins_upd_time,poa_validity_date'); 
       $this->db->from('poa_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',2);
       $query = $this->db->get();
       return $query->result_array();
    } 
    
    public function get_nomineess_nmc_history($id){
       $this->db->select('non_marriage_cert,ins_upd_user,ins_upd_time,non_marriage_cert_validity'); 
       $this->db->from('nmc_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',2);
       $query = $this->db->get();
       return $query->result_array();
    } 
    
    
    
    public function update_nominee_poa($id,$poa_file_name){
        if($this->input->post('proof_of_alive_validity')==NULL){
            $proof_of_alive_validity=NULL;
        }else $proof_of_alive_validity = date('Y-m-d', strtotime($this->input->post('proof_of_alive_validity')));  
        $user = $this->session->userdata('userID'); 
        $data_poa = array(
                'emp_nom_id' => $id,
                'type' =>2,
                'poa_file' => $poa_file_name,
                'poa_validity_date' => $proof_of_alive_validity,
                'remarks' => $this->input->post('remarks'),
                'ins_upd_ip' => getRealIpAddr(),                
                'ins_upd_host' =>gethostname(),
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
                return $this->db->update('nominees', $emp_update_data);
    }
    
    
    public function update_nominee_nmc($id,$nmc_file_name){
        if($this->input->post('non_marriage_cert_validity')==NULL){
            $non_marriage_cert_validity=NULL;
        }else $non_marriage_cert_validity = date('Y-m-d', strtotime($this->input->post('non_marriage_cert_validity')));  
        $user = $this->session->userdata('userID'); 
        $data_nmc = array(
                'emp_nom_id' => $id,
                'type' =>2,
                'non_marriage_cert' => $nmc_file_name,
                'non_marriage_cert_validity' => $non_marriage_cert_validity,
                'remarks' => $this->input->post('remarks'),
                'ins_upd_ip' => getRealIpAddr(),                
                'ins_upd_host' =>gethostname(),
                'ins_upd_user' =>$user,
                'ins_upd_db_user'=>$this->db->username
                );
                $this->db->insert('nmc_history', $data_nmc);     
                
                $this->db->where('id', $id);
        $nom_update_data = array(
            'non_marriage_cert'          =>$nmc_file_name,
            'non_marriage_cert_validity' =>$non_marriage_cert_validity,
            'ins_upd_ip' => getRealIpAddr(),                
            'ins_upd_host' =>gethostname(),
            'ins_upd_user' =>$user,
            'ins_upd_db_user'=>$this->db->username
        );        
                return $this->db->update('nominees', $nom_update_data);
    }
    public function get_nominees_expired_poa($first_day,$last_day)
    {    
       $this->db->select('*'); 
       $this->db->from('nominees'); 
       $this->db->where('proof_of_alive_validity <=',  $last_day);
       $this->db->where('proof_of_alive_validity >=',  $first_day);    
       $query = $this->db->get();
       return $query->result_array();
    }
    
    public function get_nominees_expired_nmc($first_day,$last_day){
       $this->db->select('*'); 
       $this->db->from('nominees'); 
       $this->db->where('non_marriage_cert_validity <=',  $last_day);
       $this->db->where('non_marriage_cert_validity >=',  $first_day);    
       $query = $this->db->get();
       return $query->result_array();
        
    }
    
    public function update_nominee_payment_stop($id){
        if($this->input->post('effective_date_of_stop_payment')==NULL){
            $effective_date_of_stop_payment=NULL;
        }else $effective_date_of_stop_payment = date('Y-m-d', strtotime($this->input->post('effective_date_of_stop_payment')));  
        
        $user = $this->session->userdata('userID'); 

                
        $nom_update_data = array(
                                    'effective_date_of_stop_payment' =>$effective_date_of_stop_payment,
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>1,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                return $this->db->update('nominees', $nom_update_data);
        
    }
    public function update_nominee_payment_restart($id){
        $user = $this->session->userdata('userID');                 
        $nom_update_data = array(
                                
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>0,
                                    'effective_date_of_stop_payment' =>0,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
        $this->db->where('id', $id);
        return $this->db->update('nominees', $nom_update_data);
    }
    
    public function delete_nominee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('nominees');
    }
}