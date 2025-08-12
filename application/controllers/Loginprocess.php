<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginprocess extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('utility_helper');
            $this->load->helper('captcha');
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));            
            $this->load->library('form_validation');
        }

        public function index(){
        if($this->input->post('submit')){
            $this->form_validation->set_rules('username', 'Username', 'required',array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]|callback_password_check');
            
            if ($this->form_validation->run() == FALSE)
            {    
                    $this->load->view('login/index');
            }
            else
            {          
                    $inputUsername = $this->input->post('username');
                    $inputPassword = $this->input->post('password');
                    $this->load->view('login/index');
            }
            $inputCaptcha  = $this->input->post('captcha');

            /*
            $sessCaptcha   = $this->session->userdata('captchaCode'); 
            if($inputCaptcha === $sessCaptcha){
                echo 'Captcha code matched.';
            }else{
                echo 'Captcha code was not match, please try again.';
            }             
            */
        }
    }
        public function refresh(){
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 16
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        echo $captcha['image'];
    }
    
}

