<?php

class News extends CI_Controller {

    public function __construct() {
                parent::__construct();
                $this->load->model('News_Model');
                $this->load->helper('url_helper');
    }

    public function index() {
        $data['news'] = $this->News_Model->get_news();
        $data['title'] = 'News archive';

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

}

?>