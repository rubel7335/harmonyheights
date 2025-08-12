<?php
class Changepassword_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
        date_default_timezone_set("Asia/Dhaka");
    }
    public function check_all_user_pass($username)
    {
        $this->db->select('password'); 
        $query = $this->db->get_where('password_history', array('username' => $username));
        return $query->result_array();
    }
    public function check_user($username)
    {
 
        //$query = $this->db->get_where('users', array('username' => $username,'password' => $password));
        $query = $this->db->get_where('membership', array('username' => $username));
        //var_dump($query->row_array());
        return $query->row_array();
    }
   
    public function update_user_pass($userid)
    {
                      
      
        $userpass = $this->input->post('new_password');  
            $password = password_hash($userpass,PASSWORD_BCRYPT);
           // $date = new DateTime("now"); 
                $now = date('Y-m-d H:i:s');
                $data = array(
                     'password' =>$password,
                     'password_cng_flag' =>1,
                     'password_creation_time' => $now,
                     'login_attempts' =>0,
                     'ins_upd_user'=>$userid,
                     'lock_unlock' =>1,
                     'ins_upd_host' =>gethostname(),
                     'ins_upd_ip' => getRealIpAddr()
                 );

            $this->db->where('username', $userid);
            return $this->db->update('membership', $data);
    }
}