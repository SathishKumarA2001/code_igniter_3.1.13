<?php

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->helper('form');
        $this->load->view('auth/signup');
    }

    public function signup() {

        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required',
                                            array('required'=>'Its essential'));
                                            
        if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/signup');
        } else {
            $data['msg'] = 0;
            if(!$this->Auth_Model->signup()) {
                $data['msg'] = -1;
                $this->load->view('auth/signup',$data);
            }else {
                $data['msg'] = 1;
                $this->load->view('auth/signin',$data);
            }
        }
    }

    public function signin() {

        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required',
                                            array('required'=>'Its essential'));
                                            
        if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/signin');
        } else {
                $this->Auth_Model->signin();
                $this->load->view('auth/success');
        }
    }

}