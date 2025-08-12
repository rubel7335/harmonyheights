<?php
class Membership_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }
    
    
    public function get_mgmusers()
    {


        $role_id=4;
        $query = $this->db->get_where('personal_role', array('role_id' => $role_id));
        //var_dump($query->row_array());
        return $query->result_array();
  
    }

    public function get_mgmusers_id()
    {


        $role_id=4;
        $this->db->select('personal_id');
        $query = $this->db->get_where('personal_role', array('role_id' => $role_id));
        //var_dump($query->row_array());
        return $query->result_array();
  
    }
    
public function get_mgmusers_info($mgmCat)
    {
    

        $this->db->select('per_role.*,per_info.*');
        $this->db->from('personal_role per_role');  
        $this->db->join('personal_info per_info',  'per_role.personal_id = per_info.id', 'inner');          
        $this->db->where('per_role.role_id',$mgmCat);;
        
        $query = $this->db->get();
       // echo  $this->db->last_query(); die();
        return $query->result_array();
    }
    
    public function get_persons($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('personal_info');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('personal_info', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
    
    public function get_users($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('membership');
            //print_r($query->result_array());
            return $query->result_array();
        }
 
        $query = $this->db->get_where('membership', array('id' => $id));
        //var_dump($query->row_array());
        return $query->row_array();
    }
    
        public function get_members($id = FALSE)
    {
        $this->db->select('*');  
        $this->db->from('personal_info per');  
        $this->db->join('membership m', 'per.id = m.personal_id', 'inner');
       // $this->db->join('personal_role per_role',  'nom.id = sal.nominee_id', 'left');            
        $query = $this->db->get();
        $this->db->last_query(); //die();
        return $query->result_array();
    }
    
    
    
    public function get_user_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('membership');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('membership', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
public function get_user($id){
    $this->db->select('membership.id,membership.personal_id,membership.username, personal_info.fullname,personal_info.flat_no,personal_info.email,personal_info.contact_no,membership.user_cat_id,membership.remarks');
    $this->db->from('membership');
    $this->db->join('personal_info', 'membership.id = personal_info.id');
    $this->db->where('membership.id', $id);

    // Execute the query and get the result
    $query = $this->db->get();
    return $query->row_array();
}


    public function set_user($id = 0)
    {
        $this->load->helper('url');
        $userpass=$this->input->post('password');
        $password = password_hash($userpass,PASSWORD_BCRYPT);
 
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);
        $user_id ="admin";
        $data = array(
            'personal_id' => $this->input->post('personal_id'),
            'username' => $this->input->post('username'),
            'password' =>$password ,
            'password_cng_flag' =>0,    
            'user_cat_id' => $this->input->post('user_cat_id'),            
            'login_attempts' =>0,      
            'remarks' => $this->input->post('remarks'),
            'ins_upd_user'=>$user_id,
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );
        
        if ($id == 0) {
            return $this->db->insert('membership', $data);
        } else {
             $data = array(
            'personal_id' => $this->input->post('personal_id'),
            'username' => $this->input->post('username'),
            'password_cng_flag' =>0,    
            'user_cat_id' => $this->input->post('user_cat_id'),            
            'login_attempts' =>0,      
            'remarks' => $this->input->post('remarks'),
            'ins_upd_user'=>$user_id,
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );
            $this->db->where('id', $id);
            return $this->db->update('membership', $data);
        }
    }
    
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('membership');
    }
        public function reset_user($id)
    {
            $userpass="Qwerty123@";            
            $password = password_hash($userpass,PASSWORD_BCRYPT);
            
                $data = array(
                     'password' =>$password,
                     'password_cng_flag' =>0,
                     'login_attempts' =>0,
                     'ins_upd_user'=>$id,
                     'lock_unlock' =>1,
                     'ins_upd_host' =>gethostname(),
                     'ins_upd_ip' => getRealIpAddr()
                 );

            $this->db->where('id', $id);
            return $this->db->update('membership', $data);
    }
    
}