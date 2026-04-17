<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Testimonials extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Testimonial_model', 'testimonial_model');
        $this->load->model('Page_model', 'page_model');
    }

    public function index()
    {
        $this->data['testimonials']=$this->testimonial_model->get_all();
        $this->data['title']=$this->page_model->get(25);
        $this->data['active_menu'] = 'testimonials';
        $this->data['site_content'] = 'testimonials';
        $this->load->view('web/content', $this->data);
    }
}