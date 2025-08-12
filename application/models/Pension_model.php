<?php
class Pension_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_pensions($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('pension_basic_informations');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pension_basic_informations', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_pension_info_emp_id($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('pension_basic_informations');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pension_basic_informations', array('employee_id' => $id,'nominee_id' =>0));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_pension_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('pension_basic_informations');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pension_basic_informations', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function get_pension_by_emp_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('pension_basic_informations');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pension_basic_informations', array('employee_id' => $id));
        return $query->row_array();
       // var_dump($query->row_array());
    }
    public function get_pension_by_nominee_id($id){
        $query = $this->db->get_where('pension_basic_informations', array('nominee_id' => $id));
        return $query->row_array();
        
    }
    public function set_pension($id = 0)
    {
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        if($this->input->post('last_increment_date')==NULL){
            $last_increment_date=NULL;
        }else $last_increment_date = date('Y-m-d', strtotime($this->input->post('last_increment_date'))); 
        
        if($this->input->post('next_increment_date')==NULL){
            $next_increment_date=NULL;
        }else $next_increment_date = date('Y-m-d', strtotime($this->input->post('next_increment_date'))); 
        
        if($this->input->post('fixation_date')==NULL){
            $fixation_date=NULL;
        }else $fixation_date = date('Y-m-d', strtotime($this->input->post('fixation_date')));
        
    
        $user = $this->session->userdata('userID');  
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'nominee_id' =>0,
            'pension_basic' => $this->input->post('pension_basic'),
            'last_increment_date' => $last_increment_date,
            'next_increment_date' => $next_increment_date,
            'fixation_date' => $fixation_date, 
           // 'period_for_payment' => $this->input->post('period_for_payment'),           
            'remarks' => $this->input->post('remarks'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_to_account_no' => $this->input->post('payment_to_account_no'),
            'payment_to_bank_id' => $this->input->post('payment_to_bank_id'),
            'payment_to_branch_id' => $this->input->post('payment_to_branch_id'),
            'ins_upd_host' =>gethostname(),
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_user' =>$user,
            'ins_upd_db_user'=>$this->db->username
        );
       
        
        if ($id == 0) {
            //$this->db->set('nominee_id', NULL);
           // return $this->db->insert('pension_basic_informations', $data);
            return $this->db->insert('pension_basic_informations', $data);
        } else {
            $this->db->where('id', $id);
            //$this->db->set('nominee_id', NULL);
            //return $this->db->update('pension_basic_informations', $data);
            return $this->db->update('pension_basic_informations', $data);
        }
    }
    
    public function delete_pension($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pension_basic_informations');
    }
}