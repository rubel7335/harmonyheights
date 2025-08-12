<?php
class Equipment_model extends CI_Model {
 
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
    
    public function get_eq_expensetypes()
            {
                $id=1;
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
        
    public function updateStockData($id) {
        $newData =1;
        // Replace 'your_table' with your actual table name
        $data = array('stock_flag' => $newData);
        $this->db->where('id', $id);
        $this->db->update('expensedetail', $data);

        return $this->db->affected_rows() > 0; // Return true if the update was successful
    }


    public function get_eq_expenses($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('equipment_exp');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('equipment_exp', array('id' => $id));
        return $query->row_array();
    }
    
    public function get_all_expensearea($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('expense_area');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expense_area', array('id' => $id));
        return $query->row_array();
    }
    public function get_all_items($parent_id=FALSE,$grand_parent_id=FALSE)
    {
        if (($parent_id === FALSE)&&($grand_parent_id === FALSE))
        {
            $query = $this->db->get('items');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('items', array('expense_subarea_id' => $parent_id,'expense_area_id'=>$grand_parent_id));
       // $query = $this->db->get();
          
        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }
            public function get_all_units($id=FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('units');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('units', array('id' => $id));
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

    
     
    public function get_expensedetails_by_id($id,$grand_parent_id)
    {

        $query = $this->db->get_where('expensedetail', array('parent_id' => $id,'grand_parent_id' => $grand_parent_id));
        return $query->result_array();
        //var_dump($query->row_array());
    }

    public function get_current_stock()
    {
        $this->db->select('id,parent_id,grand_parent_id,item,unit_id,stock_flag, SUM(quantity) as Quantity');
        $this->db->group_by('item');
        $query = $this->db->get('expensedetail');
        return $query->result_array();   
        //var_dump($query->row_array());
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
    
    public function set_expense($id=0,$memo_image=NULL)
    {
        
        if($this->input->post('purchase_date')==NULL){
            $purchase_date=NULL;
        }else $purchase_date = date('Y-m-d', strtotime($this->input->post('purchase_date'))); 
        
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        $data = array(
            'expense_subarea_id' => $this->input->post('expense_subarea_id'),
            'supplier_id' => $this->input->post('supplier_id'),
            'purchase_date' => $purchase_date,
            'total_amount' => $this->input->post('total_amount'),
            'memo_no' => $this->input->post('memo_no'),
            'memo_image' =>$memo_image,
            'purchase_type' => $this->input->post('purchase_type'),
            'paid_unpaid' => $this->input->post('paid_unpaid'),
            'purchase_type'=> $this->input->post('purchase_type'),
            'purchase_by_person_id' => $this->input->post('purchase_by_person_id'),
            'remarks ' => $this->input->post('remarks')
            
        );
        
        if ($id == 0) {
            //echo"insert";
            $this->db->insert('equipment_exp', $data);
        } 
        
        if ($id){  
            //echo "update";
            
                $this->db->where('id', $id);
                $this->db->update('equipment_exp', $data);   
        }
    }
        public function set_equipmentdetail($id=0)
    {
        
        $parent_id =  $this->input->post('parent_id');
        $data = array(
            'parent_id' =>  $parent_id,
            'grand_parent_id' =>  $this->input->post('grand_parent_id'),
            'item' => $this->input->post('item'),
            'unit_id' => $this->input->post('unit_id'),
            'unit_price' => $this->input->post('unit_price'),
            'quantity' => $this->input->post('quantity'),
            'subtotal' => $this->input->post('subtotal'),
            'remarks ' => $this->input->post('remarks')
            
        );
        
        if ($id == 0) {
            //echo"insert";
            $this->db->insert('expensedetail', $data);
        } 
        
        if ($id){  
            //echo "update";
            
                $this->db->where('id', $id);
                $this->db->update('expensedetail', $data);   
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