<?php

class News extends CI_Controller {

    public function __construct() {
                parent::__construct();
                $this->load->model('News_Model');
                $this->load->helper('url_helper');
    }

    public function index() {
        $data['news_item'] = $this->News_Model->get_news();
        $data['title'] = $data['news_item'][0]['title'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = 'crime') {
        $data['news_item'] = $this->News_Model->get_news($slug);
        $data['title'] = $data['news_item']['title'];
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/form');
            $this->load->view('templates/footer');
        } else {
            $this->News_Model->set_news();
            $this->load->view('news/success');
        }
    }
}

?>