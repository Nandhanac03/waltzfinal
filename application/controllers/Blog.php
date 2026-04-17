<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Page_model', 'page_model');
        $this->load->model('File_model', 'file_model');
        $this->load->model('Blog_model', 'blog_model');
        $this->data['inner_banner'] = $this->file_model->get_file('', 4);
    }

    public function index()
    {
        $this->data['recent_posts_title'] = $this->page_model->get(10);
        $this->data['blogs'] = $this->blog_model->get_all();
        $this->data['active_menu'] = 'blog';
        $this->data['site_content'] = 'blog';
        $this->load->view('web/content', $this->data);
    }

    public function info($slug_title)
    {
        if ($slug_title) {
            $blog = $this->blog_model->get_by_slug($slug_title);
            if (!$blog) {
                redirect('blog', 'refresh');
            } else {
                $this->data['blog'] = $blog;
            }
        }
        $this->data['active_menu'] = 'blog_details';
        $this->data['site_content'] = 'blog_details';
        $this->load->view('web/content', $this->data);
    }
}
