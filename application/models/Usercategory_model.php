<?php
class Usercategory_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_categories($category_name = FALSE)
    {
        if ($category_name === FALSE)
        {
            $query = $this->db->get('user_categories');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('branches', array('branch_name' => $branch_name));
        return $query->row_array();
    }
    
    public function get_news_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }
    
    public function set_news($id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );
        
        if ($id == 0) {
            return $this->db->insert('news', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('news', $data);
        }
    }
    
    public function delete_news($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }
}