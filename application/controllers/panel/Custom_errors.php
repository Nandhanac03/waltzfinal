<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Custom_errors extends CO_Panel_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect('panel/pages/show_404');
    }

    public function show_404() {
        $this->data['site_content'] = 'error_404';
        $this->load->view('panel/content', $this->data);
    }

    public function show_403() {
        $this->data['site_content'] = 'error_403';
        $this->load->view('panel/content', $this->data);
    }

}
