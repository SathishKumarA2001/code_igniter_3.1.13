<?php

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
    }

    public function index() {
        $this->load->helper('form');
        $this->load->view('auth/signup');
    }

    public function signup() {
        $this->load->helper('form','url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required',
                                            array('required'=>'Its essential'));
                                            
        if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/signup');
        } else {
                $this->Auth_Model->signup();
                $this->load->view('auth/success');
        }
    }
}