
<?php
class Logout extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('utility_helper');
        $this->load->model('category_model');
        $this->load->library('session');
        $this->load->helper('url_helper');
    }
 
    public function index()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('usercat');
        $this->session->unset_userdata('pages');
        $this->session->unset_userdata('userID');
        
        $this->session->unset_userdata('password_cng_flg');
        $this->session->unset_userdata('password_creation_date');
        $this->session->unset_userdata('days_interval');
        $this->session->unset_userdata('branch_name');   
        $this->session->unset_userdata('invalid_attempt');


        $this->session->sess_destroy();
        redirect('login','refresh');
    }
 

}
