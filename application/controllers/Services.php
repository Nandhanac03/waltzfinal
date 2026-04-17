<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CO_Web_Controller
{
    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Bio_model', 'bio_model');
    }

    public function index()
    {
        redirect('services/info/');
    }
    public function info($slug = '')
    {
        if ($slug) {
            $this->data['service'] = $this->bio_model->get_by_slug($slug);
            $this->data['services'] = $this->bio_model->get_all();

            // echo '<pre>';print_r($this->data['services']);exit;

            $desc = $this->data['service']->description;
            if ($desc != '') {
                // Replace <ul>
                if (strpos($desc, "<ul>") !== false) {
                    $desc = str_replace("<ul>", '<ul class="list-group">', $desc);
                }

                // Replace <li>
                if (strpos($desc, "<li>") !== false) {
                    $desc = str_replace(
                        "<li>",
                        '<li class="list-group-item"><span class="pbmit-icon-list-icon"><i class="pbmit-base-icon-tick-1"></i></span><span class="pbmit-icon-list-text">',
                        $desc
                    );

                    $desc = str_replace("</li>", '</span></li>', $desc);
                }

                $this->data['service']->formatted_desc = $desc;
            }
        } else {
            redirect(base_url(''));
        }
        $this->data['active_menu'] = 'service';
        $this->data['site_content'] = 'service';
        $this->load->view('web/content', $this->data);
    }
}
