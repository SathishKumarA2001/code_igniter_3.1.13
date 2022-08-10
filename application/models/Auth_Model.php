<?php

class Auth_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('My_Cookie_Model');
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
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $query = $this->db->query("SELECT * FROM `signup` 
                          WHERE email = '$email' AND password = '$pass'");               
        $flag = $query->result_array();

        if($flag != NULL) {
            //set cookie at first signIn
            $cookie = get_cookie('session_id');
            if(!isset($cookie)) {
                $set = $this->My_Cookie_Model->My_setCookie($email);
                if($set){
                    return $flag;
                }
            }
            // //Refresh cookie token while in session --> Halt coz of Security Bug 
            // if(isset($cookie)) {
            //     $set = $this->My_Cookie_Model->My_refreshToken();
            //     if($set){
            //         return $flag;
            //     }
            // }

        } else {
            die('wrong password');
        }
    }

}