<?php
class Salary_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }    
    public function get_salaries($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('salaries');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('salaries', array('id' => $id));
        return $query->row_array();
    }
    public function get_salary_breakdowns($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('salary_breakdowns');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('salary_breakdowns', array('id' => $id));
        return $query->row_array();
    }
    public function get_alive_employees(){
        $this->db->select('id');
        $this->db->select('pension_amount_during_retirement');
        $query = $this->db->get_where('employees', array('dod_time' => NULL));
        return $query->result_array();
    }
    public function get_deceased_employees(){
        $this->db->select('id');
        $this->db->select('pension_amount_during_retirement');
        $query = $this->db->get_where('employees', array('dod_time!=' => NULL));
      //  echo  $this->db->last_query(); die();
        return $query->result_array();
    }
    public function get_blank_entries(){
        $this->db->select('id');
        $this->db->select('employee_id');
        $query = $this->db->get_where('salaries', array('gross_amount' => 0));
        return $query->result_array();
    }
    public function get_sal_entries($current_year,$current_month){        
        $this->db->select('"" as Nominee_Name, emp.id,emp.stop_payment,emp.full_name,emp.cell_phone,emp.sap_id,"" as relation,'
                . "GROUP_CONCAT(`alw`.allowance_type, '=', `salbk`.`allowance_amount` SEPARATOR '<br/>') as Allowances,"
                . 'pbi.payment_method,pbi.payment_to_account_no,'
                . 'fi.name as fi_name, br.branch_name as branch_name,'
                . 'pbi.payment_to_bank_id, pbi.payment_to_branch_id,'
                . 'sal.id salary_id,sal.employee_id,sal.nominee_id,sal.gross_amount,sal.salary_month,sal.salary_year,sal.salary_type,sal.date_of_payment,sal.payment_status,sal.status,'
                . 'alw.id,alw.allowance_type');  
        
        $this->db->from('salaries sal');    
        $this->db->join('employees emp', 'sal.employee_id = emp.id', 'left');       
        $this->db->join('pension_basic_informations pbi',  'pbi.employee_id = emp.id and pbi.nominee_id = 0', 'left');
        $this->db->join('fis fi', 'pbi.payment_to_bank_id = fi.id', 'left');
        $this->db->join('branches br', 'pbi.payment_to_branch_id = br.id', 'left');
        $this->db->join('salary_breakdowns salbk', 'salbk.salary_id = sal.id', 'left');
        $this->db->join('allowances alw', 'salbk.allowance_id = alw.id','left');
        $this->db->where('sal.nominee_id',NULL);
        $this->db->where('sal.salary_month',$current_month);
        $this->db->where('sal.salary_year',$current_year);         
        $this->db->group_by(array('emp.id'));
        $query1 = $this->db->get_compiled_select();
        
        
        $this->db->select('nom.full_name, nom.id,nom.stop_payment,emp.full_name,nom.cell_phone,emp.sap_id,nom.relation,'
                . "GROUP_CONCAT(`alw`.allowance_type, '=', `salbk`.`allowance_amount` SEPARATOR '<br/>') as Allowances,"
                . 'pbi.payment_method,payment_to_account_no,'
                . 'fi.name as fi_name,br.branch_name as branch_name,'
                . 'pbi.payment_to_bank_id,pbi.payment_to_branch_id, '
                . 'sal.id salary_id,sal.employee_id,sal.nominee_id,sal.gross_amount,sal.salary_month,sal.salary_year,sal.salary_type,sal.date_of_payment,sal.payment_status,sal.status, '
                . 'alw.id,alw.allowance_type');  
        $this->db->from('salaries sal');    
        $this->db->join('nominees nom', 'sal.nominee_id = nom.id', 'left');  
        $this->db->join('employees emp', 'nom.employee_id = emp.id', 'left');  
        $this->db->join('pension_basic_informations pbi',  'nom.id = pbi.nominee_id', 'left');
        $this->db->join('fis fi', 'pbi.payment_to_bank_id = fi.id', 'left');
        $this->db->join('branches br', 'pbi.payment_to_branch_id = br.id', 'left');      
        $this->db->join('salary_breakdowns salbk', 'salbk.salary_id = sal.id', 'left');
        $this->db->join('allowances alw', 'salbk.allowance_id = alw.id','left');
        $this->db->where('sal.nominee_id!=',NULL);
        $this->db->where('sal.salary_month',$current_month);
        $this->db->where('sal.salary_year',$current_year); 
        $this->db->group_by(array('nom.id'));
        $query2 = $this->db->get_compiled_select();
        $query = $this->db->query($query1 . ' UNION ' . $query2);
        return $query->result_array();
    }
    public function get_sal_entries_backup($current_year,$current_month){        
        $this->db->select('"" as Nominee_Name,emp.full_name,emp.cell_phone,sal.*,pbi.payment_method,pbi.payment_to_account_no,fi.name as fi_name,br.branch_name as branch_name,pbi.payment_to_bank_id,pbi.payment_to_branch_id,sal.id as sal_id, sal.gross_amount,salbk.*,alw.id,alw.allowance_type');  
        $this->db->from('salaries sal');    
        $this->db->join('employees emp', 'sal.employee_id = emp.id', 'left');       
        $this->db->join('pension_basic_informations pbi',  'pbi.employee_id = emp.id and pbi.nominee_id = 0', 'left');
        $this->db->join('fis fi', 'pbi.payment_to_bank_id = fi.id', 'left');
        $this->db->join('branches br', 'pbi.payment_to_branch_id = br.id', 'left');
        $this->db->join('salary_breakdowns salbk', 'salbk.salary_id = sal.id', 'left');
        $this->db->join('allowances alw', 'salbk.allowance_id = alw.id','left');
        $this->db->where('sal.nominee_id',NULL);
        $this->db->where('sal.salary_month',$current_month);
        $this->db->where('sal.salary_year',$current_year);         
        $query1 = $this->db->get_compiled_select();
        
        
        $this->db->select('nom.full_name,emp.full_name,nom.cell_phone,sal.*,pbi.payment_method,payment_to_account_no,fi.name as fi_name,br.branch_name as branch_name,pbi.payment_to_bank_id,pbi.payment_to_branch_id,sal.id as sal_id,sal.gross_amount,salbk.*,alw.id,alw.allowance_type');  
        $this->db->from('salaries sal');    
        $this->db->join('nominees nom', 'sal.nominee_id = nom.id', 'left');  
        $this->db->join('employees emp', 'nom.employee_id = emp.id', 'left');  
        $this->db->join('pension_basic_informations pbi',  'nom.id = pbi.nominee_id', 'left');
        $this->db->join('fis fi', 'pbi.payment_to_bank_id = fi.id', 'left');
        $this->db->join('branches br', 'pbi.payment_to_branch_id = br.id', 'left');      
        $this->db->join('salary_breakdowns salbk', 'salbk.salary_id = sal.id', 'left');
        $this->db->join('allowances alw', 'salbk.allowance_id = alw.id','left');
        $this->db->where('sal.nominee_id!=',NULL);
        $this->db->where('sal.salary_month',$current_month);
        $this->db->where('sal.salary_year',$current_year); 
        $query2 = $this->db->get_compiled_select();
        $query = $this->db->query($query1 . ' UNION ' . $query2);
        return $query->result_array();
    }    
    public function get_active_allowances(){
        $this->db->select('allowance_type');
        $this->db->select('allowances');
        $query = $this->db->get_where('allowances', array('active_inactive' => 1));
        return $query->result_array();
    }      
    public function get_sal_entry_by_id($empID){
        $this->db->select('nom.full_name as nominee_full_name,sal.id,sal.employee_id,sal.nominee_id,sal.gross_amount,sal.salary_month,sal.salary_year,sal.salary_type,sal.date_of_payment,emp.full_name');  
        $this->db->from('salaries sal');    
        $this->db->join('employees emp', 'emp.id = sal.employee_id', 'inner');
        $this->db->join('nominees nom',  'nom.id = sal.nominee_id', 'left');
        $this->db->where('sal.id',$empID);         
        $query = $this->db->get();
       // echo  $this->db->last_query(); die();
        return $query->row_array();
    }
    public function get_sal_breakdown_by_sal_id($salID){
        $this->db->select('alw.allowance_type,salbk.pay_type,salbk.allowance_id,salbk.allowance_amount');  
        $this->db->from('salary_breakdowns salbk');  
        $this->db->where('salbk.salary_id',$salID); 
        $this->db->join('allowances alw',  'alw.id = salbk.allowance_id', 'inner');
        $query = $this->db->get();
      //  echo  $this->db->last_query(); die();
        return $query->result_array();
    }
    public function get_payment_info_by_emp_nom_id($emplID,$nomID){
        if($nomID==NULL){$nomID=0;}
        $this->db->select('pbi.payment_method,pbi.payment_to_account_no,fi.name as fi_name,br.branch_name as branch_name,pbi.payment_to_bank_id,pbi.payment_to_branch_id');  
        $this->db->from('pension_basic_informations pbi');  
        $this->db->where('pbi.employee_id',$emplID);
        $this->db->where('pbi.nominee_id',$nomID); 
        $this->db->join('fis fi', 'pbi.payment_to_bank_id = fi.id', 'left');
        $this->db->join('branches br', 'pbi.payment_to_branch_id = br.id', 'left');
        $query = $this->db->get();
      //  echo  $this->db->last_query(); die();
        return $query->row_array();
    }
    public function get_sal_entry_details(){
        $query = $this->db->get_where('salaries', array('gross_amount'!=0));
        return $query->result_array();
    }    
    public function get_employees_id_details($entryids){
          foreach ($entryids as $id){
            $query = $this->db->get_where('employees');             
          }
        return $query->result_array();        
    }
    public function pension_basic_by_empID($id){
        $this->db->select('pension_basic');
        $query = $this->db->get_where('pension_basic_informations', array('employee_id' => $id));
        return $query->result_array();
    }
    public function get_alive_employees_id_basic(){
        $salary_month       = $this->input->post('salary_month');
        $salary_year        = $this->input->post('salary_year');
        $this->db->select('emp.*');  
        $this->db->select('pbi.pension_basic'); 
        $this->db->from('employees emp');
        $this->db->join('pension_basic_informations pbi','emp.id=pbi.employee_id','left');        
        $this->db->where('emp.dod_time', NULL);
        $this->db->where('pbi.nominee_id', "0");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_employees_id_basic(){
        $salary_month       = $this->input->post('salary_month');
        $salary_year        = $this->input->post('salary_year');
        $this->db->select('emp.*');  
        $this->db->select('pbi.pension_basic'); 
        $this->db->from('employees emp');
        $this->db->join('pension_basic_informations pbi','emp.id=pbi.employee_id','left');    
        $this->db->where('pbi.nominee_id', "0");
        $query = $this->db->get();
        return $query->result_array();
    }  
    public function set_salary_breakdowns($empBasicInfo,$allowances){ //$ids == $empBasicInfo
        
        foreach($empBasicInfo as $emp){
            $empID               = $emp['id'];
            $basic               = $emp['pension_basic'];    
            $employee_dob        = $emp['dob_time'];
            $user = $this->session->userdata('userID');  
            $DaysCurrentMonth = date("t");
            /*
             * $NumberOfDaysInMonth = xxx
             * $EffectiveDateOfPayment from pension-basic = xxx
             * $PaymentEnableStatus  from pension-basic = xxx
             * $TerminationDate = xxx 
            */
            
        if($this->input->post('date_of_payment')==NULL){
            $date_of_payment=NULL;
        }else $date_of_payment = date('Y-m-d', strtotime($this->input->post('date_of_payment')));  
            
            
            
        $data = array(
            'employee_id'  =>$empID,
            'gross_amount' =>0,
            'salary_month' => $this->input->post('salary_month'),
            'salary_year' => $this->input->post('salary_year'),
            'salary_type' => $this->input->post('salary_type'),
            'date_of_payment' => $date_of_payment,
            'ins_upd_host' =>gethostname(),
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_user' =>$user,
            'ins_upd_db_user'=>$this->db->username            
        );
        $this->db->insert('salaries', $data);//Blank entry to salaries table
        
        $salary_id = $this->db->insert_id();//get salary_id
            
        $gross_amount=0;
        foreach ($allowances as $allowance){            
            $allowance_type         = $allowance['allowance_type'];    
            $gross_or_percentage    = $allowance['gross_or_percentage'];
            $allowance_amount       = $allowance['allowance_amount'];  
            
            if($allowance_type == 'Basic Pay') {
                $allowance_amount = $basic;
            }   
            elseif($gross_or_percentage == 'percentage') {
                $allowance_amount = $basic * ($allowance_amount/100);
            }            
            $gross_amount=$gross_amount+$allowance_amount;
            
            
            $salary_breakdowns_data = array(
            'salary_id'         =>$salary_id,
            'allowance_id'      =>$allowance['id'],
            'allowance_amount'  => $allowance_amount,
            'ins_upd_host'      =>gethostname(),
            'ins_upd_ip'        => getRealIpAddr(),
            'ins_upd_db_user'   =>$this->db->username,
            'ins_upd_user'      =>$user,
            ); 
            $this->db->insert('salary_breakdowns', $salary_breakdowns_data);// For each allowance type entry into salary_breakdowns
          }
            $salary_data = ['gross_amount'  =>$gross_amount]; 
            $this->db->where('id', $salary_id);
            $this->db->update('salaries', $salary_data);// Update gross amount into salaries table
        }       
    }    
    public function set_areear_breakdowns($id,$allowanceID,$amount,$remarks){
        
            $user = $this->session->userdata('userID');
            
            
            $data = array(
            'salary_id'         => $id,
            'allowance_id'      => $allowanceID,
            'allowance_amount'  => $amount,
            'pay_type'          => "Areear",
            'ins_upd_host'      => gethostname(),
            'ins_upd_ip'        => getRealIpAddr(),
            'ins_upd_db_user'   => $this->db->username,
            'ins_upd_user'      => $user,
            'remarks'           => $remarks          
        );

        $this->db->insert('salary_breakdowns', $data);        
        $this->db->where('id', $id);
        
        /*$salary_data = array('gross_amount'=>$totalAreear); 
        $this->db->set('gross_amount', 'gross_amount+'.$totalAreear, FALSE);
        $this->db->update('salaries');*/

    }
    public function update_gross_amount($id,$totalAreear){
        $this->db->where('id', $id);
        $this->db->set('gross_amount', 'gross_amount+'.$totalAreear, FALSE);
        $this->db->update('salaries');
        
    }
    public function set_blank_entry($empids){
        
        foreach ($empids as $ids){
        $data = array(
            'employee_id'       =>$ids['id'],
            'gross_amount'      =>0,
            'salary_month'      => $this->input->post('salary_month'),
            'salary_year'       => $this->input->post('salary_year'),
            'salary_type'       => $this->input->post('salary_type'),
            'date_of_payment'   => $this->input->post('date_of_payment')            
        );
        $this->db->insert('salaries', $data);
        }
        
    }
    public function get_allowance_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('allowances');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('allowances', array('id' => $id));
        return $query->row_array();
        //var_dump($query->row_array());
    }    
    public function set_allowance($id = 0)
    {
        $this->load->helper('url');

        $data = array(
            'allowance_type'        => $this->input->post('allowance_type'),
            'allowance_amount'      => $this->input->post('allowance_amount'),
            'gross_or_percentage'   => $this->input->post('gross_or_percentage')
        );
        
        if ($id == 0) {
            return $this->db->insert('allowances', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('allowances', $data);
        }
    }    
    public function delete_allowance($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('allowances');
    }
}