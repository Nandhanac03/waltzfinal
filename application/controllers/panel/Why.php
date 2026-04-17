<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Why extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Why_model', 'why_model');

        //configuration
        $controller_config = array();
        // $controller_config['disable_album_add'] = FALSE;
        // $controller_config['disable_album_delete'] = FALSE;
        // $controller_config['disable_album_file_edit'] = FALSE;
        // $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_slug_title'] = true;
        $controller_config['disable_short_description'] = false;
        $controller_config['disable_news_type'] = TRUE;
        $controller_config['disable_news_save_draft'] = TRUE;
        $controller_config['disable_news_published_at'] = TRUE;
        $controller_config['disable_news_created_at'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/why/all', 'refresh');
    }

    public function all()
    {
        $filter=array();
        $this->form_validation->set_rules('filterNewsTitle', 'filterNewsTitle', 'trim');
        if ($this->form_validation->run() === true) {
            // echo"workgin";exit;
            $title= $this->input->post('filterNewsTitle');
            $filterNewsPublishedAt= $this->input->post('filterNewsPublishedAt');
            if ($this->input->post('filterNewsTitle') != '') {
                $filter['title'] = $title;
            }
            
        }
        // echo"<pre>";print_r($filter);exit;
        $why_work_with_us = $this->why_model->get_all_for_panel($filter);
        // echo"<pre>";print_r($why_work_with_us);exit;
        $this->data['why_work_with_us'] = $why_work_with_us;
        $this->data['active_menu'] = 'why_work_with_us';
        $this->data['site_content'] = 'why';
        $this->load->view('panel/content', $this->data);
    }
    public function add($lang = 1)
    {
        // if ($_POST) {
        //     echo "<pre>";
        //     print_r($_POST);
        //     exit;
        // }
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('slugTitle', 'slugTitle', 'trim|is_unique[article.title_slug]');
        $this->form_validation->set_rules('shortDesc', 'shortDesc', 'trim');
        if ($this->form_validation->run() === TRUE) {
            // echo"<pre>";print_r($this->input->post('blogSubtitle'));exit;
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            // echo "wokring.";exit;
            if ($no_error == TRUE) {
                $blog_id = $this->why_model->add($input_data);
                if ($blog_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/why/all', 'refresh');
            }
        }
        // $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'why_work_with_us';
        $this->data['site_content'] = 'add_why';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        $language_parent = '';
        if ($id > 0) {
            $current_why = $this->why_model->get_for_panel($id);
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        if (!$current_why || empty($current_why->title_slug) || $current_why->title_slug != $this->input->post('slugTitle')) {
            $this->form_validation->set_rules('slugTitle', 'slug_title', 'trim|is_unique[why_work_with_us.title_slug]');
        }
        $this->form_validation->set_rules('shortDesc', 'short_desc', 'trim');
        $this->form_validation->set_rules('whyStatus', 'whyStatus', 'trim');
        if ($this->form_validation->run() === TRUE) {
            // echo"<pre>";print_r($current_why);exit;
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = $this->input->post('whyStatus');

            if ($no_error == TRUE) {
                if ($current_why) {
                    $this->why_model->add($input_data, $current_why->id);
                } else {
                    $this->why_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/why/all', 'refresh');
            }
        }

        $this->data['why'] = $current_why;
        $this->data['active_menu'] = 'why_work_with_us';
        $this->data['site_content'] = 'edit_why';
        $this->load->view('panel/content', $this->data);
    }
}
