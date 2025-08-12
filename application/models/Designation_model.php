<?php
class Designation_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_designations($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('designations');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('designations', array('id' => $id));
        return $query->row_array();
        //print_r($query->result_array());
    }
    
    public function get_designation_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('designations');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('designations', array('id' => $id));
        return $query->row_array();
        var_dump($query->row_array());
    }
    
    public function set_designations($id = 0)
    {
        $this->load->helper('url');
 
        $data = array(
            'title' => $this->input->post('title'),
            'alias' => $this->input->post('alias'),
            'grade_id' => $this->input->post('gradeID'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('designations', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('designations', $data);
        }
    }
    
    public function delete_news($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }
}