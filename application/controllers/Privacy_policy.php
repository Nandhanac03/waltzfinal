<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Privacy_policy extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Policy_model', 'policy_model');
        $this->data['inner_banner'] = $this->file_model->get_file('', 4);
    }

    public function index()
    {
        $this->data['privacy_policy'] = $this->policy_model->get(1);
        // echo"<pre>";print_r($this->data['privacy_policy']);exit;
        $this->data['active_menu'] = 'privacy_policy';
        $this->data['site_content'] = 'privacy_policy';
        $this->load->view('web/content', $this->data);
    }
}
