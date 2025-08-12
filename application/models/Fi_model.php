<?php
class FI_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_fis($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('fis');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('fis', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_fi_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('fis');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('fis', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_fi($id = 0)
    {
        $this->load->helper('url');
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'alias' => $this->input->post('alias'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('fis', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('fis', $data);
        }
    }
    
    public function delete_fi($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('fis');
    }
}