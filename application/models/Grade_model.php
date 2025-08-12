<?php
class Grade_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_grades($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('grade');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('grade', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_grade_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('grade');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('grade', array('id' => $id));
        return $query->row_array();
        var_dump($query->row_array());
    }
    
    public function set_grade($id = 0)
    {
        $this->load->helper('url');
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('title'),
            'active_inactive' => $this->input->post('active_inactive'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('grade', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('grade', $data);
        }
    }
    
    public function delete_grade($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('grade');
    }
}