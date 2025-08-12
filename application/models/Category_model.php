<?php
class Category_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_categories($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('user_categories');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('user_categories', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_category_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('user_categories');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('user_categories', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_category($id = 0)
    {
        $this->load->helper('url');
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(            
            'category_name' => $this->input->post('name'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('user_categories', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('user_categories', $data);
        }
    }
    
    public function delete_categories($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_categories');
    }
}