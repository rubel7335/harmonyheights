<?php
class Person_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_person($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('personal_info');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('personal_info', array('id' => $id));
        return $query->row_array();
    }



    
    public function get_certificate_person($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('certificate_info');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('certificate_info', array('id' => $id));
        return $query->row_array();
    }

    
    public function get_management($id = FALSE)
    {
                
        $this->db->select('per.id,per.fullname');  
        $this->db->from('personal_info per');  
        $this->db->join('personal_role per_role', 'per.id = per_role.personal_id', 'inner');
        $this->db->where('per_role.role_id',4);
     //   $this->db->join('personal_role per_role',  'per_role.role_id = 5', 'left');            
        $query = $this->db->get();
        //$this->db->last_query(); //die();
        return $query->result_array();
        
        
        
        
    }
    
    
    public function get_all_personalinfo(){
        $this->db->select('*');  
        $this->db->from('personal_info per');  
       // $this->db->join('personal_role per_role', 'per.id = per_role.personal_id', 'inner');
       // $this->db->join('personal_role per_role',  'nom.id = sal.nominee_id', 'left');            
        $query = $this->db->get();
        //$this->db->last_query(); //die();
        return $query->result_array();
    }
    
    public function get_person_roles($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('personal_role');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('personal_role', array('personal_id' => $id));
        return $query->result_array();
    }
       public function get_roles($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('role');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('role', array('id' => $id));
        return $query->row_array();
    }
    public function get_user_categories(){
            $query = $this->db->get('user_categories');
            return $query->result_array();
    }
    public function get_paid_person()
    {
        
            
       // $query=$this->db->get_where('personal_info',array('id' => 6));
        $this->db->select('pi.id,pi.fullname');  
        $this->db->from('personal_info pi');  
        $query =  $this->db->get();
        /*
        $this->db->select('r.id,r.name');  
        $this->db->from('role r');  
        $this->db->where_in('id', ['3','4','5','7','8']);  
        $query2 = $this->db->get_compiled_select();        
        $query = $this->db->query($query1 . ' UNION ' . $query2);*/
        
        return $query->result_array();
    }
     public function update_employee_approve_maker($data){
        $user = $this->session->userdata('userID'); 
        foreach ($data as $id){      
        //   echo $id;
           $myArray = explode(',', $id);
        }
        foreach ($myArray as $id){ 
//print_r($myArray); 
            $id= base64_decode($id);
           // echo "Decrypted".$id;
          //  exit;
                $emp_update_data = array(
                                    'status' =>1,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                $this->db->update('employees', $emp_update_data);
        }
          
     }
    
    public function get_employees_expired_poa($first_day,$last_day)
    {    
       $this->db->select('*'); 
       $this->db->from('employees'); 
       $this->db->where('proof_of_alive_validity <=',  $last_day);
       $this->db->where('proof_of_alive_validity >=',  $first_day);    
       $query = $this->db->get();
       return $query->result_array();
    }
    public function get_employees_poa_history($id){
       $this->db->select('poa_file,ins_upd_user,ins_upd_time,poa_validity_date'); 
       $this->db->from('poa_history'); 
       $this->db->where('emp_nom_id',$id); 
       $this->db->where('type',1); 
       $query = $this->db->get();
       return $query->result_array();
    }
    public function get_dead_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time!=' =>NULL));
        return $query->result_array();
    }
    public function get_alive_employees(){
        $this->db->select('id');
        $query = $this->db->get_where('employees', array('dod_time' => NULL));
        return $query->result_array();
    }
    
    public function get_employee_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('employees');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('employees', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }
    
    public function set_person($id=0,$image_name=NULL)
    {
        
        //echo $id.$image_name.$poa_file_name;
        
        $this->load->helper('url');
                
        if($this->input->post('birth_date')==NULL){
            $birth_date=NULL;
        }else $birth_date = date('Y-m-d', strtotime($this->input->post('birth_date'))); 
        

        

                

        $user = $this->session->userdata('userID'); 
        $data = array(
          //  'person_role_id' => $this->input->post('person_role_id'),
            'flat_no' => $this->input->post('flat_no'),            
            'fullname' => $this->input->post('fullname'),
            'father_name' => $this->input->post('father_name'),
            'mother_name' => $this->input->post('mother_name'),
            'spouse_name' => $this->input->post('spouse_name'),
            'gender' => $this->input->post('gender'),
            'blood_group' => $this->input->post('blood_group'),
            'birth_date' => $birth_date,
            'present_address' => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'nationality' => $this->input->post('nationality'),
            'nid_no' => $this->input->post('nid_no'),
            'tin_no' => $this->input->post('tin_no'),
            'birth_reg_no' => $this->input->post('birth_reg_no'),
            'passport_no' => $this->input->post('passport_no'),
            'religion' => $this->input->post('religion'),
            'educational_qualification' => $this->input->post('educational_qualification'),
            'organization' => $this->input->post('organization'),                     
            'designation' => $this->input->post('designation'),
            'office_address' => $this->input->post('office_address'),
            'contact_no' => $this->input->post('contact_no'),
            'email' => $this->input->post('email'),            
            'image_url' => $image_name,
           // 'sign_url' => $sign_name,
            'ins_upd_usr' =>$user,            
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_host' =>gethostname()
        );
        
        if ($id == 0) {
            //echo"insert";
            $this->db->insert('personal_info', $data);
           } 
        
        if ($id){  
               echo "update".$id;       
               var_dump($data);
           //     exit;
                $this->db->where('id', $id);
                if($this->db->update('personal_info', $data)){echo "success";return TRUE;}else{return FALSE;};    
                
                $str = $this->db->last_query();
                echo "<pre>";
                print_r($str);
                exit;
        }
    }

    public function update_employee_poa($id,$poa_file_name){
        if($this->input->post('proof_of_alive_validity')==NULL){
            $proof_of_alive_validity=NULL;
        }else $proof_of_alive_validity = date('Y-m-d', strtotime($this->input->post('proof_of_alive_validity')));  
        
        $user = $this->session->userdata('userID'); 
        $data_poa = array(
                            'emp_nom_id' => $id,'type' =>1,
                            'poa_file' => $poa_file_name,
                            'poa_validity_date' => $proof_of_alive_validity,
                            'remarks' => $this->input->post('remarks'),
                            'ins_upd_ip' => getRealIpAddr(),                
                            'ins_upd_host' =>gethostname(),
                            'ins_upd_user' =>$user,
                            'ins_upd_db_user'=>$this->db->username
                        );
                $this->db->insert('poa_history', $data_poa);                
                $this->db->where('id', $id);
                
        $emp_update_data = array(
                                    'proof_of_alive'          =>$poa_file_name,
                                    'proof_of_alive_validity' =>$proof_of_alive_validity,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );        
                return $this->db->update('employees', $emp_update_data);
    }
    public function update_employee_payment_stop($id){
        if($this->input->post('effective_date_of_stop_payment')==NULL){
            $effective_date_of_stop_payment=NULL;
        }else $effective_date_of_stop_payment = date('Y-m-d', strtotime($this->input->post('effective_date_of_stop_payment')));  
        
        $user = $this->session->userdata('userID'); 

                
        $emp_update_data = array(
                                    'effective_date_of_stop_payment' =>$effective_date_of_stop_payment,
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>1,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                return $this->db->update('employees', $emp_update_data);
    }
    public function update_employee_payment_restart($id){        
        $user = $this->session->userdata('userID');                 
        $emp_update_data = array(
                                    
                                    'reason' =>$this->input->post('reason'),
                                    'stop_payment' =>0,
                                    'effective_date_of_stop_payment' =>0,
                                    'ins_upd_ip' => getRealIpAddr(),                
                                    'ins_upd_host' =>gethostname(),
                                    'ins_upd_user' =>$user,
                                    'ins_upd_db_user'=>$this->db->username
                                );     
                $this->db->where('id', $id);
                return $this->db->update('employees', $emp_update_data);
    }    
    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employees');
    }
}