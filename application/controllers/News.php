<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('File_model', 'file_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('News_model', 'news_model');
    }

    public function index()
    {
        $news = $this->news_model->get_all_news();
        // print_r($this->data['portfolios']);
        // echo "<pre>";
        // print_r($news);
        // exit;

        $this->data['news'] = $news;
        $this->data['active_menu'] = 'news';
        $this->data['site_content'] = 'news';
        $this->load->view('web/content', $this->data);
    }
}
