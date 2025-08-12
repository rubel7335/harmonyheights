<?php
class Usercatpage_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_permissions($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('user_categories_pages');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('user_categories_pages', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_permission_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('user_categories_pages');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('user_categories_pages', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_permission($id = 0)
    {
        $this->load->helper('url');        
        $pages['page'] = $this->input->post('pages'); 
        $data = array(                      
            'page_id' => $this->input->post('pages'),
            'user_category_id' => $this->input->post('category'),
            'remarks' => $this->input->post('remarks')
        );
       
        if ($id == 0) {
            return $this->db->insert('user_categories_pages', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('user_categories_pages', $data);
        }
    }


        public function delete_permission($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_categories_pages');
    }
}