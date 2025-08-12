<?php
class Task1_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function initiate_taske(){
        
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
        //var_dump($query->row_array());
    }
    
    public function set_task1_sal($ids)
    {
        
        $last_increment_date = date('Y-m-d H:i:s', strtotime($this->input->post('last_increment_date'))); 
        $next_increment_date = date('Y-m-d H:i:s', strtotime($this->input->post('next_increment_date'))); 
        $fixation_date = date('Y-m-d H:i:s', strtotime($this->input->post('fixation_date'))); 
        
     //foreach ($ids as $id){
        $data = array(
            'employee_id' => 1,
            'nominee_id' => NULL,
            'gross_amount' => NULL,
            'salary_month' => 1,
            'salary_year' => 2017,
            'salary_type' => "Regular", 
            'date_of_payment' => NULL,           
            'payment_status' => "Paid to Account",
            'transaction_id' => NULL
        );
        $this->db->insert('salaries', $data);
     //  } 
    }
    
    public function delete_pension($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pension_basic_informations');
    }
}