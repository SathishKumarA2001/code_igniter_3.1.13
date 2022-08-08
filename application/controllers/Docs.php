<?php


class Docs extends CI_Controller {

    public function show($page){
        if(!file_exists(APPPATH.'views/docs/'.$page.'.php')){
            die("Couldn't find the page you are looking for");
        }
        $data['title'] = "Form Validation";
        $head['data'] = "Testing";
        $this->load->view('templates/header',$data);
        $this->load->view('docs/'.$page,$head);
        $this->load->view('templates/footer',$data);
    }

}

?>