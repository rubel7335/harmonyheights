
<?php
class FundTransfer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('person_model');  
        $this->load->model('expense_model');
        $this->load->model('payment_model');  
        $this->load->model('equipment_model');        
        $this->load->model('supplier_model');
        $this->load->model('membership_model');
        $this->load->model('Fund_transfer_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }

    public function create() {

        $data['management'] = $this->person_model->get_management();  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $personalID =$this->input->post('reciever_id');
            $payment_type =$this->input->post('payment_type');
            $amount = $this->input->post('amount');
            if($this->input->post('payment_date')==NULL){
                $payment_date=NULL;
            }else $payment_date = date('Y-m-d', strtotime($this->input->post('payment_date'))); 

            $data = array(
                    'amount' => $this->input->post('amount'),
                    'payment_date' => $payment_date,
                    'purpose' => $this->input->post('purpose'),
                    'reciever_id' => $personalID,
                    'payment_type' => $this->input->post('payment_type'),
                    'remarks' => $this->input->post('remarks'),
                );

            $insert_id = $this->Fund_transfer_model->create($data);

            if ($insert_id) {
                        if($this->Fund_transfer_model->checkIfdataExists($personalID)){                    
                                if($payment_type =="Credit"){
                                    echo "Credit operation";
                                    $this->db->set('current_balance', 'current_balance + ' . $amount, false);
                                }
                                if($payment_type =="Debit"){
                                    echo "Debit operation";
                                    $this->db->set('current_balance', 'current_balance - ' . $amount, false);
                                }                        
                                    $this->db->where('personal_id', $personalID);
                                    $this->db->update('balance');
                                    $data['records'] = $this->Fund_transfer_model->read();
                                    $data['management'] = $this->person_model->get_management(); 
                                    $this->load->view('templates/header');
                                    $this->load->view('templates/menu');
                                    $this->load->view('fund_transfer/read', $data);
                                    $this->load->view('templates/footer');   
                        }else{
                                $dataBalance = array(
                                        'personal_id' => $personalID,
                                        'current_balance' => $amount,
                                    );
                                $this->db->insert('balance', $dataBalance);
                                $data['records'] = $this->Fund_transfer_model->read();
                                    $data['management'] = $this->person_model->get_management(); 
                                    $this->load->view('templates/header');
                                    $this->load->view('templates/menu');
                                    $this->load->view('fund_transfer/read', $data);
                                    $this->load->view('templates/footer');  
                        }
                    } else {
                        echo "Record creation failed.";
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('fund_transfer/create', $data);
                        $this->load->view('templates/footer');  
                    }
            } else {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('fund_transfer/create', $data);
                $this->load->view('templates/footer');            
            }
    }

    public function read($id = null) {

        $id = $this->input->get('id');
        if ($id !== null){
            $data['records'] = $this->Fund_transfer_model->get_cash_withdraw_by_id($id);
           // var_dump($data['records']);
        } else{
                $data['records'] = $this->Fund_transfer_model->read();
        }

         //   var_dump($data['records']);

        $data['management'] = $this->person_model->get_management(); 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('fund_transfer/read', $data);
        $this->load->view('templates/footer');
    }
    public function currentbalance() {
        $data['records'] = $this->Fund_transfer_model->read_currentbalance();
        $data['management'] = $this->person_model->get_management(); 
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('fund_transfer/currentbalance', $data);
        $this->load->view('templates/footer');
    }
    
    public function check_balance() {
        $personId = $this->input->post('personId');       
    
        // Query the database to get the current balance for $personId
        // You should replace 'balance_table' and 'balance_column' with your actual table and column names.
        $currentBalance = $this->db->get_where('balance', ['personal_id' => $personId])->row()->current_balance;
    
        // Return the current balance as a response
        echo $currentBalance;
    }
    public function update($id) {
        $user = $this->session->userdata('userID'); 
        $data['management'] = $this->person_model->get_management(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($this->input->post('payment_date')==NULL){
                $payment_date=NULL;
            }else $payment_date = date('Y-m-d', strtotime($this->input->post('payment_date'))); 
            $data = array(
                'amount' => $this->input->post('amount'),
                'payment_date' => $payment_date,
                'purpose' => $this->input->post('purpose'),
                'reciever_id' => $this->input->post('reciever_id'),
                'payment_type' => $this->input->post('payment_type'),
                'remarks' => $this->input->post('remarks'),
                'ins_upd_ip' => getRealIpAddr(),                
                'ins_upd_host' =>gethostname(),
                'ins_upd_user_id' =>$user,
            );
            
            $this->Fund_transfer_model->update($id, $data);
            $data['management'] = $this->person_model->get_management(); 
          //  echo "Record updated.";
            $data['records'] = $this->Fund_transfer_model->read();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('fund_transfer/read', $data);
            $this->load->view('templates/footer');
        } else {
            $data['record'] = $this->Fund_transfer_model->read($id);
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('fund_transfer/update', $data);
            $this->load->view('templates/footer');
           
        }
    }

    public function delete($id) {
        $this->Fund_transfer_model->delete($id);
        echo "Record deleted.";
    }
}
