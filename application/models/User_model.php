<?php
class User_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }
    
    public function get_users($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('users');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('users', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
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
    
    public function set_user($id = 0)
    {
        $this->load->helper('url');
        $userpass=$this->input->post('password');
        $password = password_hash($userpass,PASSWORD_BCRYPT);
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'username' => $this->input->post('username'),
            'password' =>$password ,
            'password_cng_flg' =>0,         
            'user_category_id' => $this->input->post('category'),
            'login_attempts' =>0,
            'lock_unlock'   =>1,            
            'ins_upd_ip'=> getRealIpAddr(),
            'remarks' => $this->input->post('remarks')
        );
        
        if ($id == 0) {
            return $this->db->insert('membership', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('membership', $data);
        }
    }
    
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
        public function reset_user($id)
    {
            $userpass="Qwerty123@";  
            $password = password_hash($userpass,PASSWORD_BCRYPT);
            
                $data = array(
                     'password' =>$password,
                     'password_cng_flg' =>0,
                     'login_attempts' =>0,
                     'ins_upd_user'=>$id,
                     'lock_unlock' =>1,
                     'ins_upd_host' =>gethostname(),
                     'ins_upd_ip' => getRealIpAddr(),
                    'ins_upd_db_user'=>$this->db->username
                 );

            $this->db->where('id', $id);
            return $this->db->update('membership', $data);
    }
    
}