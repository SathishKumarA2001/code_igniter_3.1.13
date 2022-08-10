<?php

class My_Cookie_Model extends CI_Model {
    public function __construct(){
        $this->load->database();
        $this->load->helper('cookie');
    }

    function My_setCookie($email) {
        
        $session_id = md5(crypt($email,rand(10,10000))); //crackable easily
        $token    = md5(crypt($session_id,rand(90,94598594))); //crackable easily

        $data = array(
                'session_id' => $session_id,
                'token'      => $token,
                'session_time'=> time()+3000000000,
        );

        if($this->db->insert('session',$data)){  //Inserting into session table;
            setcookie('session_id',$session_id,time()+3000000000,'/');
            return True;
        } else {
            die('SetCookie failed');
        }
    
    }

// Security flaw in this module : "One can hijack a user session by the victim old session_id"

// function My_refreshToken(){

//     $session_id = get_cookie('session_id');
//     $query = $this->db->query("SELECT * FROM `session` WHERE `session_id`= '$session_id' LIMIT 1");
//     $row = $query->row(0);
//     $time_span = strtotime($row->session_time);
//     $time_check = time();
//     if($time_check > $time_span){
//         $token    = md5(crypt($session_id,rand(90,94598594))); //crackable easily
//         $this->db->where('session_id',$session_id);
//         $data = array(
//             'session_id' => $session_id,    
//             'token'=>$token,
//             );
//         if($this->db->replace('session',$data)) {  
//             setcookie('session_id',$session_id,time()+3000000000,'/');
//             return True;
//         }else{
//             print_r($this->db->error());
//             die('session refresh token error');
//         }
//     }
// }

}