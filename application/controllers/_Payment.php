<?php

class Payment extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->helper(array('form', 'url'));
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->model('person_model');
            $this->load->model('payment_model');   
            $this->load->helper('url_helper');     
            //print_r($this->session->userdata());    
            $is_loggedIn = $this->session->userdata('username');
            $user_cat = $this->session->userdata('usercat');
            $pages = $this->session->userdata('pages');
            //print_r($pages);
            if(empty($is_loggedIn)){
                redirect('login');
            }
        }
 
    public function index()
    {   
            $data['payments']  = $this->payment_model->get_payments();
            
            $data['person']  = $this->person_model->get_all_personalinfo();
            $data['person_roles']  = $this->person_model->get_person_roles();
            $data['installments']  = $this->payment_model->get_all_installments();
            $data['title'] = 'All payment information'; 
            //$allowed_pages = $this->session->userdata('pages');
            //print_r($data);
            
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('payment/index', $data);
            $this->load->view('templates/footer');
        }


    public function approval()
    {       
          //  $data['payments']  = $this->payment_model->get_payments();
             $data['payments']  = $this->payment_model->get_pending_payments();
            $data['person']  = $this->person_model->get_all_personalinfo();
            $data['person_roles']  = $this->person_model->get_person_roles();
            $data['installments']  = $this->payment_model->get_all_installments();
            $data['title'] = 'Approve payment information'; 
            //$allowed_pages = $this->session->userdata('pages');
            //print_r($data);
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('payment/approve', $data);
            $this->load->view('templates/footer');
        }
    
    public function approve($id = NULL){
        // $id = $this->uri->segment(3);
            $id = base64_decode($id);
        //  echo "Payment ID:".$id;
        // exit;
        
            $this->payment_model->approve_payment($id);        
        // redirect( 'payment/approve/'); 
            redirect('payment/index/');
        }

    public function download($id = NULL){
            $id = base64_decode($id);
            $data['title'] = 'Harmony Heights';
            //$data['payment_item']  = $this->payment_model->get_payments($id);
            $data['payment_item']  = $this->payment_model->get_payments_info($id);
        // var_dump($data['payment_item'] );
        // exit;
        
            $this->load->library('pdf');
            $html = $this->load->view('generatepdf', $data, true);        
            $this->pdf->createPDF($html, 'mypdf', false);
        }


    public function certificate($id = NULL){
            $id = base64_decode($id);
            $this->load->library('pdf');
            $data['person']  = $this->person_model->get_certificate_person();          
            // foreach ($data['person']  as $item) {
            //         // Generate the HTML content for the data set
            //         $html = $this->load->view('generateCertificatepdf', $item, true);    
            //         // Generate the PDF for the data set
            //         $this->pdf->createPDF($html, 'certificate_' . $item['id'], true, 'A4', 'landscape');
            //     }
            // var_dump($data['person']);    
            // Generate the PDF certificate  
                    
            $html = $this->load->view('generateCertificatepdf', $data, true);    
            $this->pdf->createPDF($html, 'certificate', true, 'A4', 'landscape');    
            $this->pdf->createPDF($html, 'mypdf', false);  
          
        }


    public function view($id = NULL)
    {
            $id = base64_decode($id);
            $data['payment_item']  = $this->payment_model->get_payments($id);
            $data['installments']= $this->payment_model->get_all_installments();
            $data['person']  = $this->person_model->get_all_personalinfo();
            if (empty($data['payment_item']))
            {
                show_404();
            } 
        
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('payment/view', $data);
            $this->load->view('templates/footer');
        }
    
    public function get_payment_info_by_personid(){
            $id = $this->uri->segment(3);        
            $id = base64_decode($id);
            $data['person_id'] = $id;
            if (empty($id))
            {
                show_404();
            }   
        // $data['employees']  = $this->employee_model->get_employees();
            $data['person'] = $this->person_model->get_person($id);
        // print_r($data['employee']);
            $data['payments']  = $this->payment_model->get_allpayments_bypersonid($id);
            $data['person_name'] = $data['person']['fullname']; 
            $data['person_image'] = $data['person']['image_url'];
            $data['installments']= $this->payment_model->get_all_installments();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('payment/get_payment_info_by_personid', $data);        
            $this->load->view('templates/footer');
        }



    public function create($id=NULL)
    {
        $error=FALSE;
        $encryptId = $id;
        $id= base64_decode($id);
            
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $data['title'] = 'Add a Payment';        
        $data["encryptedID"] = $encryptId;
        $data['shareholder_id']=$id;          
        $data['installments']= $this->payment_model->get_all_installments();
        
        if(isset($_FILES['image_file'])) {
                $errors     = array();
                $maxsize    = 102000;//in Bytes
                $acceptable = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png'
                );

            $name_photo = @$_FILES['image_file']['name'];
            list($txt, $ext) = explode(".", $name_photo);
            $image_name = time().".".$ext;
            $tmp = @$_FILES['image_file']['tmp_name'];

            if(($_FILES['image_file']['size'] >= $maxsize) || ($_FILES["image_file"]["size"] == 0)) {
                    $errors[] = 'Photo size too large. File must be less than 100 KB.';
                    $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                    $this->form_validation->set_message('error_photo','Photo size too large. File must be less than 100 KB');
                    $error=true;
                }

            if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
                    $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                    $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                    $error=true;
                }

        }  
        
        $this->form_validation->set_rules('installment_id', 'installment_id', 'required');
        $this->form_validation->set_rules('deposit_slip_no', 'deposit_slip_no', 'required');
        $this->form_validation->set_rules('payment_type', 'payment_type', 'required');
        $this->form_validation->set_rules('deposit_date', 'deposit_date', 'required');
        $this->form_validation->set_rules('deposit_amount', 'deposit_amount', 'required');        
        $this->form_validation->set_rules('bankname', 'bankname', 'required');
        $this->form_validation->set_rules('branchname', 'branchname', 'required');
        
     //   $this->form_validation->set_rules('remarks', 'remarks', 'required');
       
        if (($this->form_validation->run() === FALSE)||($error)|| empty($_FILES['image_file']['name']))
        {
            // var_dump($data);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('payment/create', $data);
                $this->load->view('templates/footer'); 
            }
        else
        {
                move_uploaded_file($tmp,'upload/payment/'.$image_name);
                $this->payment_model->set_payment($id=0,$image_name);
                redirect('person/view/'.$encryptId);
            /*   $this->load->view('templates/header');
                    $this->load->view('templates/menu');
                    $this->load->view('payment/success');
                    $this->load->view('templates/footer');
                */
            }
    }
    
    public function edit()
    {
        $id = base64_decode($this->uri->segment(3));    
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit payment'; 
        $data['installments']   = $this->payment_model->get_all_installments();
        $data['payment_item']   = $this->payment_model->get_payments($id); 

        var_dump($data['payment_item']);
        
        if(isset($_POST) && !empty($_FILES['image_file']['name'])){    
            $errors     = array();
            $maxsize    = 102000;//in Bytes
            $acceptable = array(
                'image/jpeg',
                'image/jpg',
                'image/gif',
                'image/png'
            );
    
        $name_photo = @$_FILES['image_file']['name'];
        list($txt, $ext) = explode(".", $name_photo);
        $image_name = time().".".$ext;    
        $tmp = @$_FILES['image_file']['tmp_name'];
                
        if(($_FILES['image_file']['size'] >= $maxsize) || ($_FILES["image_file"]["size"] == 0)) {
                $errors[] = 'Photo size too large. File must be less than 102 KB.';
                $data['error_photo']= 'Photo size too large. File must be less than 100 KB';
                $error=true;
            }

        if((!in_array($_FILES['image_file']['type'], $acceptable)) && (!empty($_FILES["image_file"]["type"]))) {
                $errors[] = 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.'; 
                $data['error_photo']= 'Invalid Photo type. Only JPG, GIF and PNG types are accepted.';
                $error=true;
            }
    
        if(!$error){move_uploaded_file($tmp, 'upload/payment/'.$image_name);}
            }else { $image_name=$data['payment_item']['image_url'];$error=false;}



        $this->form_validation->set_rules('installment_id', 'installment id', 'required');
        $this->form_validation->set_rules('deposit_slip_no', 'deposit slip no', 'required');
        $this->form_validation->set_rules('payment_type', 'payment_type', 'required');
        $this->form_validation->set_rules('deposit_date', 'deposit date', 'required');
        $this->form_validation->set_rules('deposit_amount', 'deposit amount', 'required');        
        $this->form_validation->set_rules('bankname', 'bankname', 'required');
        $this->form_validation->set_rules('branchname', 'branchname', 'required');
        
       
        if ($this->form_validation->run() === FALSE)
        {
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('payment/edit', $data);
                $this->load->view('templates/footer');
            }
        else
        {
            
            $this->payment_model->set_payment($id,$image_name);
            $this->load->view('payment/success');
            $person_id = base64_encode($data['payment_item']['personal_id']);
            // redirect('payment/get_payment_info_by_personid/'.$person_id);
                redirect('person/view/'.$person_id);
            }
    }
    
    public function delete()
    {
            $id = $this->uri->segment(3);
            $id = base64_decode($id);
            if (empty($id))
            {
                show_404();
            }
                    
            $allowance_item = $this->allowance_model->get_allowance_by_id($id);        
            $this->allowance_model->delete_allowance($id);        
            redirect( base_url() . 'index.php/allowance');        
        }
    
    
}