<?php
class Commondata_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_fis($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('tbl_bank');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('tbl_bank', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }    
    public function get_fi_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('tbl_bank');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('tbl_bank', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    public function get_branch_by_bankname($bankid)
    {
        $query = $this->db->get_where('tbl_branch', array('FI_ID' => $bankid));
        return $query->result_array();
        //var_dump($query->row_array());
    }
    public function get_upazilla_thana_by_district_name($districtname)
    {
        $query = $this->db->get_where('tbl_div_dis_thana', array('district' => $districtname));
        return $query->result_array();
        //var_dump($query->row_array());
    }
    
}