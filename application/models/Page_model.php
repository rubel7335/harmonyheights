<?php
class Page_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_pages($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('pages');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pages', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function get_page_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('pages');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('pages', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_page($id = 0)
    {
        $this->load->helper('url'); 
        $data = array(
            'name' => $this->input->post('name'),
            'url_controller' => $this->input->post('url_controller'),
            'url_action' => $this->input->post('url_action'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('pages', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('pages', $data);
        }
    }
    
    public function delete_page($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pages');
    }
}