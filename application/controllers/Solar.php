<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solar extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Page_model', 'page_model');
    }

    public function index()
    {
        $this->data['solacontent'] = $this->page_model->get(8);
        $applications = $this->page_model->get(9);
        $content = $applications->short_desc;

        $content = preg_replace('/^.*?<li>/', '', $content);
        
        $applications->available_solar_solutions = explode('<li>', $content);

        if (empty($applications->available_solar_solutions[0])) {
            array_shift($applications->available_solar_solutions);
        }

        // echo "<pre>";
        // print_r($applications);
        // exit;


        $this->data['applications'] = $applications;
        $this->data['active_menu'] = 'solar';
        $this->data['site_content'] = 'solar';
        $this->load->view('web/content', $this->data);
    }
}
