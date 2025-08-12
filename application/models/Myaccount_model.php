<?php
class Myaccount_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_appuser($id)
    {

        $query = $this->db->get_where('membership', array('username' => $id));
        return $query->row_array();
    }
    public function get_dead_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time!=' => "0000-00-00 00:00:00"));
        return $query->result_array();
    }
     public function get_alive_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time' => "0000-00-00 00:00:00"));
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
    
    public function set_employee($id = 0)
    {
        $this->load->helper('url');
        
        $dob_time = date('Y-m-d H:i:s', strtotime($this->input->post('dob_time'))); 
        $dor_time = date('Y-m-d H:i:s', strtotime($this->input->post('dor_time'))); 
        $dod_time = date('Y-m-d H:i:s', strtotime($this->input->post('dod_time')));
        $proof_of_alive_validity = date('Y-m-d H:i:s', strtotime($this->input->post('proof_of_alive_validity')));
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'sap_id' => $this->input->post('sap_id'),
            'index_no' => $this->input->post('index_no'),
            'ppo_no' => $this->input->post('ppo_no'),
            'file_no' => $this->input->post('file_no'),
            'full_name' => $this->input->post('full_name'),
            'gender' => $this->input->post('gender'),
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
            'proof_of_alive' => $this->input->post('proof_of_alive'),
            'proof_of_alive_validity' => $proof_of_alive_validity,
            'last_basic_during_retirement' => $this->input->post('last_basic_during_retirement'),
            'pension_amount_during_retirement ' => $this->input->post('pension_amount_during_retirement'),
            'remarks ' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('employees', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('employees', $data);
        }
    }
    
    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employees');
    }
}