<?php
class Salaryexpense_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_expensetypes($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('expense_area');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expense_area', array('id' => $id));
        return $query->row_array();
    }
    
    
    public function get_sal_expensetypes()
    {

        $id=2;//2 for sal expense category
        $query = $this->db->get_where('expense_subarea', array('expense_area_id' => $id));
        return $query->result_array();
    }
    
   public function get_all_expense_area($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('expense_area');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expense_area', array('id' => $id));
        return $query->row_array();
    }
        
    public function get_all_salaryexpenses($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('salary_exp');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('salary_exp', array('id' => $id));
        return $query->result_array();
    }
    
        public function get_all_expsubarea($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('expense_subarea');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expense_subarea', array('id' => $id));
        return $query->row_array();
    }
    public function check_if_generated($current_year,$current_month){
        $this->db->select('id'); 
        $query = $this->db->get_where('salaries', array('salary_year' => $current_year,'salary_month' => $current_month));
        return $query->result_array();
    }
    public function rollback_employee_salary($current_year,$current_month,$ids){
    foreach ($ids as $id){ 
        $this->db->where('salary_id', $id['id']);
        $this->db->delete('salary_breakdowns');            
    }
    
      
    if($this->db->affected_rows()){
        foreach ($ids as $id){ 
            $this->db->where('id', $id['id']);
            $this->db->delete('salaries');
        }
    }
     
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
    
    public function set_salexpense($id=0,$memo_image=NULL)
    {
        
        if($this->input->post('payment_date')==NULL){
            $payment_date=NULL;
        }else $payment_date = date('Y-m-d', strtotime($this->input->post('payment_date'))); 
        
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        $data = array(
            'expense_subarea_id' => $this->input->post('expense_subarea_id'),
            'person_id' => $this->input->post('person_id'),
            'payment_date' => $payment_date,
            'total_amount' => $this->input->post('total_amount'),
            'memo_no' => $this->input->post('memo_no'),
            'memo_image' =>$memo_image,
            'paid_by_person_id' => $this->input->post('paid_by_person_id'),
            'remarks ' => $this->input->post('remarks')
            
        );
        
        if ($id == 0) {
            //echo"insert";
            $this->db->insert('salary_exp', $data);
        } 
        
        if ($id){  
            //echo "update";
            
                $this->db->where('id', $id);
                $this->db->update('salary_exp', $data);   
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
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
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