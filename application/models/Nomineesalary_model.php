<?php
class Nomineesalary_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    

    
    public function get_all_nominees_id_basic($last_day_this_month){
    // Get deceased employees nominees     
        $this->db->select('emp.dod_time,emp.dor_time,nm.employee_id,nm.id,nm.full_name,nm.marital_status,nm.non_marriage_cert_validity, nm.relation, nm.physical_status, nm.dob_time,nm.proof_of_alive_validity,nm.pension_percentage, pbi.pension_basic,((nm.pension_percentage * pbi.pension_basic)/100) as nominees_basic');  
        $this->db->from('nominees nm');
        $sub_query="(select * from employees where dod_time != 'NULL')";// dead employees        
        $this->db->join("$sub_query emp",'nm.employee_id = emp.id','inner');    
        $this->db->join('pension_basic_informations pbi ','on nm.id = pbi.nominee_id','inner'); 
        $this->db->where('nm.id!=',0);
     //   $this->db->where('nm.dod_time',NULL);
     //   $this->db->where('nm.proof_of_alive_validity>=',$last_day_this_month);//Alive nominee        
     //   To see query generated
        $query = $this->db->get();
       // echo $this->db->last_query();die();
        return $query->result_array();
        
        
    }
    
    public function set_salary_breakdowns($nominee,$allowances){ //$ids == $empBasicInfo
       
            $empID = $nominee['employee_id'];
            $empDateOfRetirement = $nominee['dor_time'];
            $emp_dod_time = $nominee['dod_time'];            
            $employee_pension_basic = $nominee['pension_basic'];
            $emp_relation_with_nominee = $nominee['relation'];
            $physical_status = $nominee['physical_status'];
            $nominee_dob_time = $nominee['dob_time'];            
            $nom_marital_status = $nominee['marital_status'];            
            $nomineeID = $nominee['id'];
            $nominee_basic = $nominee['nominees_basic'];
            $nominee_share  =   $nominee['pension_percentage'];
      //    echo "emp:".$empID."empBasic:".$employee_pension_basic."nomineeID".$nomineeID."nomineeBasic".$nominee_basic."nomineePercentage".$nominee_share;
            
        if($this->input->post('date_of_payment')==NULL){
            $date_of_payment=NULL;
        }else $date_of_payment = date('Y-m-d', strtotime($this->input->post('date_of_payment'))); 
            
        $data = array(
            'employee_id'  =>$empID,
            'nominee_id'   =>$nomineeID,
            'gross_amount' =>0,
            'salary_month' => $this->input->post('salary_month'),
            'salary_year' => $this->input->post('salary_year'),
            'salary_type' => $this->input->post('salary_type'),
            'date_of_payment' => $date_of_payment,
            'ins_upd_host' =>gethostname(),
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_db_user'=>$this->db->username              
        );
        $this->db->insert('salaries', $data);//Blank entry to salaries table
        $salary_id = $this->db->insert_id();//get salary_id
            
            $gross_amount=0;
            foreach ($allowances as $allowance){  
            $gross_or_percentage = $allowance['gross_or_percentage'];
            $allowance_type      = $allowance['allowance_type']; 
            $allowance_amount    = $allowance['allowance_amount'];
           // $allowance_amount = $allowance['allowance_amount']*($nominee_share/100);
           // echo "<br>"."gross_or_percentage:".$gross_or_percentage."<br>"."allowance_type:"."<br>".$allowance_type."<br>"."allowance_amount:".$allowance_amount;
            
            if(($allowance_type == 'Basic Pay')&&($gross_or_percentage == 'gross')) {
                $allowance_amount = $nominee_basic;
            }  
          //  echo "allowance_amount".$allowance_amount;
            if($gross_or_percentage == 'percentage') {
                $allowance_amount = ($employee_pension_basic * ($allowance_amount/100))*($nominee_share/100);
            }   
            if(($allowance_type != 'Basic Pay')&&($gross_or_percentage == 'gross')) {
                $allowance_amount = ($allowance_amount*(($nominee_share/100)));
            }   
           // echo "allowance_amount::".$allowance_amount;
            $gross_amount=$gross_amount+$allowance_amount;
           // echo"<br>"."allowance['id']"."<br>".$allowance['id']." "."allowance_amount".$allowance_amount;
            $salary_breakdowns_data = array(
            'salary_id'  =>$salary_id,
            'allowance_id' =>$allowance['id'],
            'allowance_amount' => $allowance_amount,
            'ins_upd_host' =>gethostname(),
            'ins_upd_ip' => getRealIpAddr(),
            'ins_upd_db_user'=>$this->db->username  
            ); 
            $this->db->insert('salary_breakdowns', $salary_breakdowns_data);// For each allowance type entry into salary_breakdowns
          }
            $salary_data = ['gross_amount'  =>$gross_amount]; 
            $this->db->where('id', $salary_id);
            $this->db->update('salaries', $salary_data);// Update gross amount into salaries table       
    }
}