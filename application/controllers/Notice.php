<?php
class Notice extends CI_Controller {
 
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
        $this->load->model('notice_model');
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
    public function index() {
        $data['notices'] = $this->notice_model->get_notices();
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('notice/index', $data);
        $this->load->view('templates/footer');
    }

    // Function to create a new notice
    public function create() {
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('notice/create');
        $this->load->view('templates/footer');
    }

    // Function to insert a new notice
    public function insert() {
        $data = array(
            'title' => $this->input->post('title'),
            'details' => $this->input->post('details'),
            'status' => $this->input->post('status')
        );

        $this->notice_model->insert_notice($data);
        redirect('notice');
    }

    // Function to view a notice by ID
    public function view($id) {
        $data['notice'] = $this->notice_model->get_notice_by_id($id);
        var_dump($data['notice'] );
       
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('notice/view', $data);
        $this->load->view('templates/footer');
    }

    // Function to edit a notice by ID
    public function edit($id) {
        $data['notice'] = $this->notice_model->get_notice_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/menu');
        $this->load->view('notice/edit', $data);
        $this->load->view('templates/footer');
    }

    // Function to update a notice by ID
    public function update($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'details' => $this->input->post('details'),
            'status' => $this->input->post('status')
        );
        // var_dump($data );
        
        $this->notice_model->update_notice($id, $data);
        redirect('notice');
    }

    // Function to delete a notice by ID
    public function delete($id) {
        $this->notice_model->delete_notice($id);
        redirect('notice');
    }

}