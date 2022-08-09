<?php

class Auth_Model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function signup(){
        $this->load->helper('url');

        $data = array(
            "username" => $this->input->post('username'),
            "email" => $this->input->post('email'),
            "password" => $this->input->post('password')
        );

        return $this->db->insert('signup',$data);
    }

    public function signin() {
        $data = array(
            "email" => $this->input->post('email'),
            "password" => $this->input->post('password')
        );

        return $query = $this->db->query("SELECT * FROM `signup` 
                                          WHERE '$data[email]' AND '$data[password]'");
    }

}