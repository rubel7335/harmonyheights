<?php
class Payment_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_payments($id = FALSE)
    {
        $status=2; // confirmed payments
        if ($id === FALSE)
        {
            //$query = $this->db->get_where('payment_info', array('status' => $status));
            //print_r($query->result_array());
            //return $query->result_array();

            $query = $this->db->query("SELECT * FROM payment_info where status=2 ORDER BY STR_TO_DATE(deposit_date, '%Y-%m-%d') ASC");
            return $query->result_array();
        }
 
        //$query = $this->db->get_where('payment_info', array('id' => $id));
        //var_dump($query->row_array());
        //return $query->row_array();

        $query = $this->db->order_by('deposit_date', 'ASC')->get_where('payment_info', array('id' => $id));              
        return $query->row_array();
    }
    
    public function get_total_amounts_ordered_by_person_id() {
        $this->db->select('personal_id, SUM(CASE WHEN payment_type = "Credit" THEN deposit_amount ELSE -deposit_amount END) AS total_amount', FALSE);
        $this->db->from('payment_info');
        $this->db->group_by('personal_id');
        $this->db->order_by('personal_id', 'ASC');
        
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function get_pending_payments($id = FALSE)
    {
        $status=0; // confirmed payments
        if ($id === FALSE)
        {
            $query = $this->db->get_where('payment_info', array('status' => $status));
            //print_r($query->result_array());
            return $query->result_array();

        }
 
        $query = $this->db->get_where('payment_info', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }


    public function get_payments_info($id)
    {
        $this->db->select('pinfo.id as receipt_no,pinfo.personal_id,pinfo.installment_id,pinfo.deposit_slip_no,pinfo.deposit_date deposit_date,pinfo.deposit_amount as deposit_amount,pinfo.bankname as bank,pinfo.branchname as branch,pinfo.check_by as approved_by,perinfo.fullname,perinfo.id, ins.id,ins.name as installment_name,mem.personal_id,perinfo2.id,perinfo2.fullname as verified_by');  
        $this->db->from('payment_info pinfo'); 
        $this->db->join('installments ins', 'pinfo.installment_id = ins.id', 'left'); 
        $this->db->join('membership mem', 'mem.username = pinfo.check_by', 'left');         
        $this->db->join('personal_info perinfo', 'pinfo.personal_id = perinfo.id', 'left');  
        $this->db->join('personal_info perinfo2', 'perinfo2.id = mem.personal_id', 'left'); 
      //  $this->db->join('pension_basic_informations pbi',  'pbi.employee_id = emp.id and pbi.nominee_id = 0', 'left');
 
        //$query = $this->db->where('pinfo.id=', $id);
        $this->db->where('pinfo.id',$id);
        $query = $this->db->get();
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    
    
    public function get_all_installments($id = FALSE)
    {
        if ($id === FALSE)
        {
            $this->db->select('*');
            $this->db->from('installments');
            $this->db->order_by('id', 'asc'); // Replace 'column_name' with the actual column name you want to order by
            $query = $this->db->get();
            

          //  $query = $this->db->orderBy('id', 'asc')->get('installments');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('installments', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_allpayments_bypersonid($id)
    {
      
        $query = $this->db
        ->select("*, DATE_FORMAT(deposit_date, '%Y-%m-%d') as formatted_deposit_date", false)
        ->order_by('deposit_date', 'ASC')
        ->get_where('payment_info', array('personal_id' => $id));
    
    return $query->result_array();
    
       
        // $query = $this->db->get_where('payment_info', array('personal_id' => $id));
        //var_dump($query->row_array());
       // $query = $this->db->order_by('deposit_date', 'ASC')->get_where('payment_info', array('personal_id' => $id)); 
        //return $query->result_array();
    }
    
   
  
    public function set_payment($id = 0,$image_name=NULL)
    {
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        if($this->input->post('deposit_date')==NULL){
            $deposit_date=NULL;
        }else $deposit_date = date('Y-m-d', strtotime($this->input->post('deposit_date'))); 
      

        $data = array(
            'personal_id' => $this->input->post('personal_id'),
            'installment_id' => $this->input->post('installment_id'),
            'deposit_slip_no' => $this->input->post('deposit_slip_no'),
            'payment_type' => $this->input->post('payment_type'),            
            'deposit_date' => $deposit_date,
            'deposit_amount' => $this->input->post('deposit_amount'),
            'image_url' => $image_name,
            'bankname' => $this->input->post('bankname'),
            'branchname' => $this->input->post('branchname'),
            'remarks' => $this->input->post('remarks'),
            'make_by' => $user,
            'make_time' => date('Y-m-d'),
            'remarks' => $this->input->post('remarks'),
            'ins_upd_user ' =>$user,            
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );
       
        
        if ($id == 0) {
            return $this->db->insert('payment_info', $data);
        } 
        if($id){
            $this->db->where('id', $id);
                $this->db->update('payment_info', $data);               
        }
    }
    public function approve_payment($id){
        
       
        $user = $this->session->userdata('userID'); 
         $data = array(
            'status' => 2,
            'check_by' => $user,
            'check_time' => date('Y-m-d'),
            'ins_upd_user ' =>$user,            
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );
       
            $this->db->where('id', $id);
            $this->db->update('payment_info', $data);               
        
    }
    public function delete_pension($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pension_basic_informations');
    }
}