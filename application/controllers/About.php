<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Label_model', 'label_model');
        $this->load->model('File_model', 'file_model');
        $this->load->model('Page_file_model', 'page_file_model');
        $this->load->model('Page_file_description_model', 'page_file_description_model');
        $this->load->model('Status_model', 'status_model');
        $this->load->model('Status_model', 'status_model');
        $this->load->model('Brand_model', 'brand_model');

    }

    public function index()
    {

        // $this->data['aboutwdwe'] = $this->page_model->get_all();

        $this->data['about'] = $this->page_model->get(3);
        $this->data['vision'] = $this->page_model->get(4);
        $this->data['mission'] = $this->page_model->get(5);
        $this->data['core_value'] = $this->page_model->get(6);
        // $this->data['label'] = $this->page_model->get(11);

        // $this->data['processlabel'] = $this->page_model->get(12);


        $this->data['process'] = $this->brand_model->get_all();


        // echo '<pre>';print_r($this->data['aboutwdwe']);exit;

        $this->data['status'] = $this->status_model->get_all();
        $this->data['clients'] = $this->file_model->get_all(2);
        $Marquee = $this->page_model->get(1);
        $Marquee->short_desc  = str_replace(['<ul>', '</ul>'], '',  $Marquee->short_desc);
        $Marquee->short_desc  = str_replace('</li>', '',  $Marquee->short_desc);
        $marqueeArray = explode('<li>',  $Marquee->short_desc);
        $marqueeArray = array_filter(array_map('trim', $marqueeArray));
        $this->data['marqueeArray'] = $marqueeArray;

        $this->data['active_menu'] = 'about';
        $this->data['site_content'] = 'about';
        $this->load->view('web/content', $this->data);
    }
}
