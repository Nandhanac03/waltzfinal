<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CO_Panel_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        //checking user has permission
        //$this->check_has_permission('dashboard');
        $this->data['active_menu'] = 'dashboard';
        $this->data['site_content'] = 'dashboard';
        $this->load->view('panel/content', $this->data);
    }

}
