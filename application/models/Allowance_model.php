<?php
class Allowance_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_allowances($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('allowances');
            $query = $this->db->get_where('allowances', array('active_inactive' =>1));
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('allowances', array('id' => $id,'active_inactive' =>1));// Check active deactive
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_all_allowances()
    {

            $query = $this->db->get('allowances');
            //print_r($query->result_array());
            return $query->result_array();


    }

    public function get_allowances_all($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('allowances');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('allowances', array('id' => $id));// Check active deactive
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_allowance_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('allowances');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('allowances', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_allowance($id = 0)
    {
        $this->load->helper('url');
        $user = $this->session->userdata('userID'); 
        $data = array(
            'allowance_type' => $this->input->post('allowance_type'),
            'allowance_amount' => $this->input->post('allowance_amount'),
            'gross_or_percentage' => $this->input->post('gross_or_percentage'),
            'ins_upd_host' =>gethostname(),
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_user' =>$user,
            'active_inactive' =>0,
            'ins_upd_db_user'=>$this->db->username
        );
        
        if ($id == 0) {
            return $this->db->insert('allowances', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('allowances', $data);
        }
    }
    
    public function delete_allowance($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('allowances');
    }
}