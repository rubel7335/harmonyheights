<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->helper('captcha');
            $this->load->library('session');
            $date = date('H:i:s', time());
            $this->session->set_userdata('session_started',$date);
            $this->load->model('login_model');
            $this->load->model('person_model');
            $this->load->model('nominee_model');
            $this->load->model('notice_model');
            $this->load->model('payment_model');  
           // $this->load->model('branch_model');             
           // $this->load->model('designation_model');
            $this->load->library('form_validation');
            $this->load->helper(array('form', 'url')); 
            $this->form_validation->set_error_delimiters('<div class="errorMessgae">', '</div>');
            
        }

        public function index(){   
            $session_started= $this->session->userdata('session_started');   
              $config = array(
                    'img_path'      => 'captcha_images/',
                    'img_url'       => base_url().'captcha_images/',
                    'img_width'     => '150',
                    'img_height'    => 50,
                    'word_length'   => 4,
                    'font_size'     => 18
                );
                $data['invaliduser'] = "";
                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captchaImg'] = $captcha['image'];
                $data['images']     = $this->login_model->get_slider(); 
                $data['notices']     = $this->notice_model->get_notices(); 
            
                foreach($data['images'] as $name) {
                              $firstImage =$name['image_title'];
                                break; 
                            }
                $data['firstImage'] = $firstImage;             
                $this->load->view('templates/header');
                $this->load->view('login/index',$data);
                $this->load->view('templates/footer');
        }

        public function noticeview($id = NULL){        
            $data['title'] = 'Notice';
            $id = base64_decode($id);
            $data['notice_item'] = $this->notice_model->get_notice($id);  
            $this->load->library('pdf');
            exit;
            $html = $this->load->view('notice/generatepdf', $data, true);        
            $this->pdf->createPDF($html, 'mypdf', false);
        }

        public function verifyuser(){
           // echo "Invalid attempt".$invalid_attempt = $this->session->userdata('invalid_attempt'); 
            $this->load->helper('form');
            $this->load->library('form_validation');      
            $data['images']     = $this->login_model->get_slider(); 
            $data['notices']     = $this->notice_model->get_notices(); 
            
            foreach($data['images'] as $name) {
                              $firstImage =$name['image_title'];
                                break; 
                            }
            $data['firstImage'] = $firstImage;
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[12]',array('required' => 'You must provide a valid %s.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]|callback_valid_pass');
            $this->form_validation->set_rules('captchatext', 'Captchatext', 'trim|required|callback_captcha_check'); 
            if ($this->form_validation->run() === FALSE)
            {
               // $this->view_login_index();
                                $config = array(
                    'img_path'      => 'captcha_images/',
                    'img_url'       => base_url().'captcha_images/',
                    'img_width'     => '150',
                    'img_height'    => 50,
                    'word_length'   => 4,
                    'font_size'     => 18
                );
                $data['invaliduser'] = "";
                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captchaImg'] = $captcha['image'];
                
                $this->load->view('templates/header');
                $this->load->view('login/index',$data);
                $this->load->view('templates/footer');
            }
            if ($this->form_validation->run() === TRUE)
            {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $login_attempt = $this->session->userdata('invalid_attempt'); 
            
            $data['user_item']      =$this->login_model->check_user($username);   // Get users detail using username 
            $userexist              =$data['user_item']['username'];
            
          //  $branch_id              =$data['user_item']['branch_id'];
          //  $designation_id         =$data['user_item']['designation_id'];  
            $userpass               =$data['user_item']['password'];
            $password_cng_flg       =$data['user_item']['password_cng_flag'];
            $lock_unlock            =$data['user_item']['lock_unlock'];
            $password_creation_date =$data['user_item']['password_creation_time'];
            
         //   $bank_branch['bank_branch'] = $this->branch_model->get_branch_fi_by_branchID($branch_id);      // Get branch name using branch id
         //   $fi_id            =$bank_branch['bank_branch']['fi_id'];
         //   $branch_name      =$bank_branch['bank_branch']['branch_name'];
           // $login_attempts   =$data['user_item']['login_attempts'];

            $date1 = new DateTime("now");                                            
            $result = substr($password_creation_date, 0, 10);
            $date2 = new DateTime($result);
            $interval = $date1->diff($date2);
           // echo "difference " . $interval->days . " days ";
            $days_interval = $interval->days;
          //  $login_attempt = 0;

        if($userexist){// user exist
                if($lock_unlock){// unlocked
                                    if (password_verify($password, $userpass)) {//valid user
                                            $data['invaliduser'] = "";
                                            $userID             =$data['user_item']['username'];
                                            $personal_id        =$data['user_item']['personal_id'];
                                           // $username           =$data['user_item']['fullname'];
                                            $usercat            =$data['user_item']['user_cat_id'];
                                            $password_cng_flg   =$data['user_item']['password_cng_flag'];
                                           // $password_creation_time  =$data['user_item']['password_creation_time'];
                                            $data['allowed_pages_id'] = $this->login_model->usercat_pages_id($usercat); 
                                            //var_dump($data['allowed_pages_id'] );
                                           // exit;
                                            $data['allowed_pages'] = $this->login_model->get_users_page($data['allowed_pages_id']);
                                            //  var_dump($data);
                                            //   exit;
                                            $this->session->set_userdata('userID',$personal_id);
                                            $this->session->set_userdata('username',$userID);
                                            $this->session->set_userdata('usercat',$usercat); 
                                            $this->session->set_userdata('password_cng_flg',$password_cng_flg); 
                                            $this->session->set_userdata('pages',$data['allowed_pages']);
                                            $this->session->set_userdata('password_creation_date',$password_creation_date);                                            
                                            $this->session->set_userdata('days_interval',$days_interval);
                                          //  $this->session->set_userdata('branch_name',$branch_name);
                                            $this->session->unset_userdata('invalid_attempt');
                                            $pages = $this->session->userdata('pages'); 
                                           // echo $_SESSION['login_time'] = time();
                                            $data['username']=$userID;
                                           // $data['full_name']=$username;
                                            $data['usercat']=$usercat;
                                            $data['pages']=$pages;
                                            $data['password_creation_date']=$password_creation_date;
                                            $data['days_interval']=$days_interval;
                                          
                                        // echo "No of days from pass creation date ". $days_interval;
                                        // echo $session_id=session_id ( );   										
                                        // if($days_interval>=30){
                                        //      redirect( base_url() . 'changepassword');
                                        // }
                                        // if($days_interval<=30){
                                            $logintime = date('Y-m-d H:i:s');                                            
                                            $this->session->set_userdata('last_login_timestamp',$logintime);
                                            $this->session->set_userdata('peronal_id',$personal_id);
                                        //$this->login_model->set_logintime_ip($userID);
                                           // redirect('home');
                                            
                                            $id= $personal_id;
                                            
                                            $data['person_id'] = $id;
                                            $data['person_item'] = $this->person_model->get_person($id); 
                                            //var_dump($data);
                                            $data['nominees']  = $this->nominee_model->get_nominee_by_perid($id);
                                            $data['payments']  = $this->payment_model->get_allpayments_bypersonid($id);
                                            $data['installments']  = $this->payment_model->get_all_installments();
                                            $data['roles']  = $this->person_model->get_roles();
                                            $data['person_roles']  = $this->person_model->get_person_roles($id);
                                            $data['user_categories']  = $this->person_model->get_user_categories();
        
                                            if (empty($data['person_item']))
                                            {
                                                show_404();
                                            }

                                            $data['title'] = $data['person_item']['fullname']; 
                                            $this->load->view('templates/header');
                                            $this->load->view('templates/menu');
                                            $this->load->view('person/view', $data);
                                            $this->load->view('templates/footer');

                                    } 
                                    if(!(password_verify($password, $userpass))){//invalid pass   
                                     //   echo "attempt:".$login_attempt = $login_attempt+1;
                                        $login_attempt= $login_attempt+1;
                                        $this->session->unset_userdata('invalid_attempt');
                                        $this->session->set_userdata('invalid_attempt',$login_attempt);  
                                        if($login_attempt>3){
                                            echo "ID is locked! Contact with Administrator. Please try again after 5 minutes";
                                                $this->login_model->lock_user($username,$login_attempt);                                                
                                                $config = array(
                                                'img_path'      => 'captcha_images/',
                                                'img_url'       => base_url().'captcha_images/',
                                                'img_width'     => '150',
                                                'img_height'    => 50,
                                                'word_length'   => 4,
                                                'font_size'     => 18
                                                );
                                                $captcha = create_captcha($config);
                                                $this->session->unset_userdata('captchaCode');
                                                $this->session->set_userdata('captchaCode',$captcha['word']);
                                                $this->session->unset_userdata('invalid_attempt');
                                                $data['captchaImg'] = $captcha['image'];    
                                               // $this->generate_captcha();
                                                $data['invaliduser'] = "ID is locked! Contact with Administrator";  
                                               // $invaliduser="ID is locked! Contact with Administrator";
                                                redirect(base_url()."login/index/");
                                                //redirect( base_url() . 'login');
                                                /*
                                                $this->load->view('templates/header');
                                                $this->load->view('login/index', $data);
                                                $this->load->view('templates/footer');*/
                                                 
                                                 
                                        }
                                        if($login_attempt<=3){
                                     // echo "aTTEMPT:". $login_attempt=$login_attempt+1;
                                      //$this->login_model->invalid_attempt_flag_update($username,$login_attempts);                                             
                                                $config = array(
                                                'img_path'      => 'captcha_images/',
                                                'img_url'       => base_url().'captcha_images/',
                                                'img_width'     => '150',
                                                'img_height'    => 50,
                                                'word_length'   => 4,
                                                'font_size'     => 18
                                                );
                                                $captcha = create_captcha($config);
                                                $this->session->unset_userdata('captchaCode');
                                                $this->session->set_userdata('captchaCode',$captcha['word']);
                                                $data['captchaImg'] = $captcha['image'];    
                                               // $this->generate_captcha();
                                                $data['invaliduser'] = "Invalid username or password";                                                
                                                $this->load->view('templates/header');
                                                $this->load->view('login/index', $data);
                                                $this->load->view('templates/footer');
                                        }
                                    }  
                }
                if(!$lock_unlock){//Locked
                    $config = array(
                    'img_path'      => 'captcha_images/',
                    'img_url'       => base_url().'captcha_images/',
                    'img_width'     => '150',
                    'img_height'    => 50,
                    'word_length'   => 4,
                    'font_size'     => 18
                );
                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captchaImg'] = $captcha['image'];         
              //  $this->generate_captcha();
                $data['invaliduser'] = "ID is locked! Contact with Administrator";               
                $this->load->view('templates/header');
                $this->load->view('login/index', $data);
                $this->load->view('templates/footer');
                }
            }
        if(!$userexist){//user not exist
            
                    $config = array(
                    'img_path'      => 'captcha_images/',
                    'img_url'       => base_url().'captcha_images/',
                    'img_width'     => '150',
                    'img_height'    => 50,
                    'word_length'   => 4,
                    'font_size'     => 18
                );
                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captchaImg'] = $captcha['image'];        
              //  $this->generate_captcha();
                $data['invaliduser'] = "Invalid Username or Password";
                $this->load->view('templates/header');
                $this->load->view('login/index', $data);
                $this->load->view('templates/footer');
            }
            }            
        }
        public function view_login_index(){
                            $config = array(
                    'img_path'      => 'captcha_images/',
                    'img_url'       => base_url().'captcha_images/',
                    'img_width'     => '150',
                    'img_height'    => 50,
                    'word_length'   => 4,
                    'font_size'     => 18
                );
                $data['invaliduser'] = "";
                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captchaImg'] = $captcha['image'];
                
                $this->load->view('templates/header');
                $this->load->view('login/index',$data);
                $this->load->view('templates/footer');
              
        }
        public function generate_captcha(){
             $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 18
        );
            $data['invaliduser'] = "";
            $captcha = create_captcha($config);
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode',$captcha['word']);
            $data['captchaImg'] = $captcha['image'];
        }
        public function refresh(){
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        echo $captcha['image'];
    }
        function valid_pass() {            
            $inputPassword = $this->input->post('password');
            $this->form_validation->set_message('valid_pass','Password is not valid'); 
            if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $inputPassword))
                return FALSE;
            return TRUE;
        }
        public function captcha_check()
        {
          $inputCaptcha = $this->input->post('captchatext');
          if($inputCaptcha==$this->session->userdata('captchaCode'))
          {
            return TRUE;
          }
          else
          {
            $this->form_validation->set_message('captcha_check', 'Wrong captcha code');
            return FALSE;
          }
        }
}

