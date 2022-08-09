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
        $email = $data['email'];
        $pass = $data['password'];
        $query = $this->db->query("SELECT * FROM `signup` 
                          WHERE email = '$email' AND password = '$pass'");               
        $flag = $query->result_array();

        if($flag != NULL) {
            $this->load->helper('cookie');
            $rand = crypt($data['email'],rand(10,10000)); //crackable easily

            setcookie('token',$rand,time()+300,'/');
            print_r($_COOKIE['token']);
            die(); 
            //$this->db->insert()  ///continuation
            return $flag;
        }else{
            die('wrong pass');
        }
    }

}