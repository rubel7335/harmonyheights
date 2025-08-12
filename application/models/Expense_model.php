<?php
class Expense_model extends CI_Model {
 
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
    
    
    public function get_expensestypes()
    {

        $id=3;//2 for sal expense category
        // $query = $this->db->get_where('expense_subarea', array('expense_area_id' => $id));
       // $query = $this->db->order_by('title', 'ASC')->get_where('expense_subarea', array('expense_area_id' => $id));
       // $query = $this->db->order_by('title', 'ASC')->get_where('expense_subarea');

       $this->db->select('*');
        $this->db->from('expense_subarea');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get();

      //  $query = $this->db->get('expense_subarea');
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
        
    public function get_all_expenses_byperson($id)
    {
        $query = $this->db
    ->select('*, DATE_FORMAT(payment_date, "%Y-%m-%d") AS formatted_payment_date', FALSE)
    ->order_by('payment_date', 'ASC')
    ->get_where('expenses', array('paid_by_person_id' => $id));
    
return $query->result_array();

       
    }




    public function get_all_expenses($id = FALSE)
        {
            /*SELECT
                    expenses.id as expense_id,
                    expenses.description,
                    expenses.paid_by_person_id,
                    expenses.status,
                    expenses.payment_date,
                    expenses.total_amount,
                    expenses.memo_no,
                    expense_subarea.id as subarea_id,
                    expense_subarea.title as subarea_title
                    FROM
                        expenses
                    JOIN
                        expense_expensecategories ON expenses.id = expense_expensecategories.expense_id
                    JOIN
                    expense_subarea ON expense_expensecategories.expense_subarea_id = expense_subarea.id ORDER BY STR_TO_DATE(payment_date, '%Y-%m-%d') ASC
                    */
            $status=1;//confirmed
            if ($id === FALSE)
            {
            // $query = $this->db->get('expenses');
                $query = $this->db->query("SELECT * FROM expenses ORDER BY STR_TO_DATE(payment_date, '%Y-%m-%d') ASC");
                return $query->result_array();
            }
    
            $query = $this->db->order_by('payment_date', 'ASC')->get_where('expenses', array('id' => $id));              
            return $query->row_array();
        }


        // public function get_total_amount_spent() {
        //     $query = $this->db->select('paid_by_person_id, SUM(total_amount) as total_amount_spent')
        //                       ->from('expenses')
        //                       ->group_by('paid_by_person_id')
        //                       ->get();
    
        //     return $query->result();
        // }




    public function get_total_amount_spent($paid_by_person_id = false) {
        $this->db->select('paid_by_person_id, SUM(total_amount) as total_amount_spent')
                 ->from('expenses');

        if ($paid_by_person_id !== false) {
            $this->db->where('paid_by_person_id', $paid_by_person_id);
        }

        $this->db->group_by('paid_by_person_id');
        $query = $this->db->get();

        return $query->result();
    }




        public function get_all_expense_subarea($id = FALSE)
        {
           
            if ($id === FALSE)
            {
            // $query = $this->db->get('expenses');
                $query = $this->db->query("SELECT * FROM expense_expensecategories");
                return $query->result_array();
            }
    
            $query = $this->db->get_where('expense_expensecategories', array('id' => $id));              
            return $query->row_array();
        }

        
        public function get_all_expense_of_a_subarea($id)
            {           
                    $query = $this->db->get_where('expense_expensecategories', array('expense_subarea_id' => $id)); 
                    return $query->result_array();
            }

            public function get_expense_subarea_of_a_expense($id){
                $query = $this->db->get_where('expense_expensecategories', array('expense_id' => $id));              
                return $query->row_array();              
              //  var_dump($query->row_array());
              //  exit;
                
            }
            
        
    public function get_all_confirmed_expenses($id = FALSE)
    {
        $status=1;//confirmed
        if ($id === FALSE)
        {
            $query = $this->db->get_where('expenses', array('status' => $status));
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expenses', array('id' => $id));
        return $query->row_array();
    }


    public function get_all_pending_expenses($id = FALSE)
    {
        $status=0;//confirmed
        if ($id === FALSE)
        {
            $query = $this->db->get_where('expenses', array('status' => $status));
            return $query->result_array();
        }
 
        $query = $this->db->get_where('expenses', array('id' => $id,'status' => $status));
        return $query->row_array();
    }

    public function get_all_advances($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('fund_transfer');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('fund_transfer', array('id' => $id));
        return $query->result_array();
    }
    public function approve_expense($id){
        
       
        $user = $this->session->userdata('userID'); 
       // echo $user;
      
         $data = array(
            'status' => 1,
            'checker_id' => $user
        );
       
            $this->db->where('id', $id);
            $this->db->update('expenses', $data);               
        
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

    public function get_current_balance($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('balance');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('balance', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_expense($id=0,$memo_image=NULL)
    {
        
        if($this->input->post('payment_date')==NULL){
            $payment_date=NULL;
        }else $payment_date = date('Y-m-d', strtotime($this->input->post('payment_date'))); 
        
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        $paid_by_person_id=$this->input->post('paid_by_person_id');
        $data = array(
                'expense_subarea_id' => $this->input->post('expense_subarea_id'),
                'description' => $this->input->post('description'),
                'payment_date' => $payment_date,
                'total_amount' => $this->input->post('total_amount'),
                'memo_no' => $this->input->post('memo_no'),
                'memo_image' =>$memo_image,
                'paid_by_person_id' => $paid_by_person_id,
                'remarks ' => $this->input->post('remarks'),
                'maker_id ' => $user,
            );
        
        if ($id == 0) {
                    $this->db->insert('expenses', $data);
                    $inserted_id = $this->db->insert_id();
                    $total_amount= $this->input->post('total_amount');
                    $expense_table="expenses";
                    $transaction_type="Debit"; // for all kinds of expenses
            
                    $transaction_data = array(             
                            'amount' => $total_amount,
                            'expense_table' => $expense_table,
                            'expense_id' =>$inserted_id,
                            'transaction_type' => $transaction_type,
                            'ins_upd_ip' => getRealIpAddr(), 
                            'ins_upd_user' =>$user,
                        );
                    $this->db->insert('transaction', $transaction_data);

                    if($transaction_type =="Debit"){
                        echo "Debit operation of current balance ";
                        $this->db->set('current_balance', 'current_balance - ' . $total_amount, false);
                    }
                    
                    $this->db->where('personal_id', $paid_by_person_id);
                    $this->db->update('balance');
                } 
        
        if ($id){  
            //echo "update";   

            //Find existing expense total amount and compare it with posted amount
            // check the existing amount with current update amount, 
            //if posted amount is less than current account=>$val=existing-posted; subtract this $val from current_balance
            //if posted amount is grater than current account=>$val=posted-existing; add this $val with current_balance
            
                // echo "New amount".$data['total_amount'];
                // exit;
                $posted_amount=$data['total_amount'];
                $query = $this->db->get_where('expenses', array('id' => $id));
                $result = $query->row_array();
                echo "Current amount:". $current_amount = $result['total_amount'];

           

                if($posted_amount<$current_amount){
                        $val = $current_amount - $posted_amount;
                        echo "Need to deduct".$val;
                        $this->db->set('current_balance', 'current_balance +' . $val, false);                        
                        $this->db->where('personal_id', $paid_by_person_id);
                        $this->db->update('balance');
                    }

                if($posted_amount>$current_amount){
                        $val =  $posted_amount-$current_amount;
                        echo "Need to add".$val;
                        $this->db->set('current_balance', 'current_balance - ' . $val, false);                        
                        $this->db->where('personal_id', $paid_by_person_id);
                        $this->db->update('balance');
                    }
           
            
                $this->db->where('id', $id);
                    //$this->db->update('expenses', $data);                      
                if($this->db->update('expenses', $data)){echo "success";return TRUE;}else{return FALSE;};                      
                    // $str = $this->db->last_query();
                    // echo "<pre>";
                    // print_r($str);
                    // exit;
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
    public function delete_assignment($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('expense_expensecategories');    
        return $this->db->affected_rows();
    }
}