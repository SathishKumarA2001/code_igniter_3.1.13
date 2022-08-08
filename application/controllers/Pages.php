<?php

class Pages extends CI_Controller {

    public function view($page='home'){
        if (!file_exists(APPPATH.'/views/pages/'.$page.'.php')){
            die("Couldn't find the page you are looking for");
        }
        $data['title'] = ucfirst($page);
        $this->load->view('templates/header',$data);
        $this->load->view('pages/'.$page,$data);
        $this->load->view('templates/footer',$data);
    }
    
}

?>