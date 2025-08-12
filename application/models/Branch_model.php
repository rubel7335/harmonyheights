<?php
class Branch_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_branches($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('branches');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('branches', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
   public function get_branch_fi_by_branchID($id){
        $this->db->select('fi_id,branch_name');
        $query = $this->db->get_where('branches', array('id' => $id));
        return $query->row_array();
   } 
public function get_branches_by_fi($id)
    {

 
        $query = $this->db->get_where('branches', array('fi_id' => $id));
        //var_dump($query->row_array());
        return $query->result_array();
    }
    
    public function get_branch_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('branches');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('branches', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_branch($id = 0)
    {
        $this->load->helper('url');
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'id' => $this->input->post('id'),
            'branch_name' => $this->input->post('name'),
            'branch_business_address' => $this->input->post('address'),
            'fi_id' => $this->input->post('fi'),
            'fax_num' => $this->input->post('fax_num'),
            'tel_num' => $this->input->post('tel_num'),
            'remarks' => $this->input->post('remarks'),
        );
        
        if ($id == 0) {
            return $this->db->insert('branches', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('branches', $data);
        }
    }
    
    public function delete_branch($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('branches');
    }
}