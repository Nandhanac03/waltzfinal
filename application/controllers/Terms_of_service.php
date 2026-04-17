<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Terms_of_service extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Terms_model', 'terms_model');

        $this->data['inner_banner'] = $this->file_model->get_file('', 4);
    }

    public function index()
    {
        $this->data['terms'] = $this->terms_model->get(1);
        // echo"<pre>";print_r($this->data['terms']);exit;
        $this->data['active_menu'] = 'terms_of_service';
        $this->data['site_content'] = 'terms_of_service';
        $this->load->view('web/content', $this->data);
    }
}
