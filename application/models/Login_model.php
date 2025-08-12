<?php
class Login_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
        date_default_timezone_set("Asia/Dhaka");
    }
    
    public function check_user($username)
    {
 
        //$query = $this->db->get_where('users', array('username' => $username,'password' => $password));
        $query = $this->db->get_where('membership', array('username' => $username));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    public function check_all_user_pass($username)
    {
        $this->db->select('password'); 
        $query = $this->db->get_where('password_history', array('username' => $username));
        return $query->result_array();
    }
    
    public function get_slider(){
        $query = $this->db->get_where('photo_gallery', array('gallery_type' => 1));
        return $query->result_array();
    }

    public function invalid_attempt_flag_update($username,$login_attempts)
    {

            if($login_attempts<3){
                $this->db->where('username', $username);
                $this->db->set('login_attempts ', 'login_attempts+1', FALSE);
                return $this->db->update('users');
            }
           // return $this->db->update('users', $data);
    }
    public function lock_user($username,$login_attempts){
             if($login_attempts>=3){
                $this->db->where('username', $username);
                $this->db->set('lock_unlock', '0', FALSE);
                return $this->db->update('users');
            }
    }
    public function invalid_attempt_check($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
       // var_dump($query->row_array());
    }
    public function set_logintime_ip($username){
        $now = date('Y-m-d H:i:s');
            $data = array(
            'last_login_ip' => getRealIpAddr(),
            'last_login_time' =>$now          
        );
        $this->db->where('username', $username);
        $this->db->update('users', $data);
    }
    public function get_user_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function usercat_pages_id($usercat){
        $this->db->select('page_id'); 
        $this->db->from('user_categories_pages');   
        $this->db->where('user_category_id', $usercat);
        return $this->db->get()->result_array();
       // return $this->db->get()->result();        
       // $query = $this->db->get_where('user_categories_pages',array('user_category_id' => $usercat));
       // return $query->result_array();
    }
    function get_users_page($page_id_array)
    {
        $pages=array();
        foreach($page_id_array as $page)
        {
            $pages[]= $page['page_id'];
        }
        $query_str = 'SELECT  url_action FROM pages WHERE id IN ('.implode(",", $pages).')';
        $query = $this->db->query($query_str);
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    public function set_user($id = 0)
    {
        $this->load->helper('url');
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'full_name' => $this->input->post('fullname'),
            'gender' => $this->input->post('gender'),
            'email' => $this->input->post('email'),
            'cell_phone' => $this->input->post('cellphone'),
            'designation_id' => $this->input->post('designation'),
            'office_address' => $this->input->post('officeaddress'),
            'office_phone' => $this->input->post('officephone'),
            'user_category_id' => $this->input->post('category'),
            'branch_id' => $this->input->post('branch'),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('users', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
    }
    
    public function set_accesshistory(){
            $data = array(
            'user_id' => $this->input->post('username'),
            'session_id' => $this->input->post('password'),
            'ip_address' => ''
        );
    }
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}