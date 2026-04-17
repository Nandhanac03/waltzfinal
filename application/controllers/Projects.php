<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models 
        $this->load->model('Status_model', 'status_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Blog_model', 'blog_model');
        $this->load->model('Album_model', 'album_model');

    }

    public function index()
    {
        $projects = $this->blog_model->get_all();
        $clientslogs = $this->file_model->get_all(3);
        $ouralbum = $this->album_model->get(3);

        // echo "<pre>";
        // print_r($projects);
        // exit;
        $this->data['ouralbum'] = $ouralbum;
        $this->data['clientslogs'] = $clientslogs;
        $this->data['projects'] = $projects;
        $this->data['active_menu'] = 'project';
        $this->data['site_content'] = 'project';
        $this->load->view('web/content', $this->data);
    }
    public function info($slug)
    {
        if ($slug) {
            $project = $this->blog_model->get_by_slug($slug);
            if (empty($project)) {
                redirect('projects');
            }
        } else {
            redirect('projects');
        }
        // echo "<pre>";
        // print_r($project);
        // exit;
        $this->data['project'] = $project;
        $this->data['active_menu'] = 'project';
        $this->data['site_content'] = 'project_details';
        $this->load->view('web/content', $this->data);
    }
}
