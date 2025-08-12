<?php
class Changepassword extends CI_Controller {
 
    public function __construct()    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->model('changepassword_model');
        $this->load->model('login_model');
        $this->load->helper('url_helper');
        $is_loggedIn = $this->session->userdata('username');
        if(empty($is_loggedIn)){
            redirect('login');
        }
    }

    public function index()    {
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 18
        );

        
        $userID  =$this->session->userdata('userID');
        $captcha = create_captcha($config);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        $data['captchaImg'] = $captcha['image'];
        $this->load->view('templates/header');        
        $this->load->view('templates/menu');
        $this->load->view('changepassword/index', $data);
        $this->load->view('templates/footer');
    }

    public function updateuserpass(){
            $this->load->helper('form');
            $this->load->library('form_validation');
            //check whether this password is exist for this user
           // $this->form_validation->set_rules('current_password', 'Current password', 'trim|required|min_length[8]|max_length[16]|callback_valid_current_pass|callback_current_pass_check');
            $this->form_validation->set_rules('new_password', 'New password', 'trim|required|min_length[8]|max_length[16]|callback_valid_new_pass');
            $this->form_validation->set_rules('retype_password', 'Retype password', 'trim|required|min_length[8]|max_length[16]|callback_valid_retype_pass|callback_retype_pass_check');
            $this->form_validation->set_rules('captchatext', 'Captchatext', 'trim|required|callback_captcha_check'); 
            if ($this->form_validation->run() === FALSE)
            {
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
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('changepassword/index',$data);
                $this->load->view('templates/footer');
            }
            if ($this->form_validation->run() === TRUE)
            {  
                $userID  =$this->session->userdata('userID');                
                $data['user_item'] = $this->changepassword_model->update_user_pass($userID);
                redirect('/logout/index', 'refresh');
            }            
        }

    public function current_pass_check(){
            $current_password = $this->input->post('current_password');  
            $userID  =$this->session->userdata('userID');
            $data['user_item'] = $this->changepassword_model->check_user($userID);            
            $userexist        =$data['user_item']['username'];
            $userpass         =$data['user_item']['password'];         
            $password_cng_flg =$data['user_item']['password_cng_flag'];
            $login_attempts   =$data['user_item']['login_attempts'];
            $lock_unlock      =$data['user_item']['lock_unlock'];            
            
            
            if (password_verify($current_password, $userpass)) {
                return TRUE;
            }
            else
            {
              $this->form_validation->set_message('current_pass_check', 'Incorrect password');
              return FALSE;
            }
    }
    
    public function valid_current_pass() {            
            $inputPassword = $this->input->post('current_password');
            $this->form_validation->set_message('valid_current_pass','Current Password is not valid'); 
            if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $inputPassword))
                return FALSE;
            return TRUE;
        }
    
    public function valid_new_pass() {            
            $new_password = $this->input->post('new_password');
            $this->form_validation->set_message('valid_new_pass','New Password is not valid'); 
            if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $new_password))
            return FALSE;
            return TRUE;

           
        }
    
    public function valid_retype_pass(){            
            $retype_password = $this->input->post('retype_password');
            $this->form_validation->set_message('valid_retype_pass','Retype Password is not valid'); 
            if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $retype_password))
                return FALSE;
            return TRUE;
        }
    
  

    public function captcha_check(){
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
    
    public function retype_pass_check()        {
          $new_password = $this->input->post('new_password');
          $retype_password = $this->input->post('retype_password');
          if($new_password==$retype_password)
          {
            return TRUE;
          }
          else
          {
            $this->form_validation->set_message('retype_pass_check', 'Password mismatch');
            return FALSE;
          }
        }     
}