<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Faq_model', 'faq_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_album_add'] = FALSE;
        $controller_config['disable_album_delete'] = FALSE;
        $controller_config['disable_album_file_edit'] = FALSE;
        $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_album_file_subtitle'] = TRUE;
        $controller_config['disable_album_file_short_desc'] = TRUE;
        $controller_config['disable_album_file_languages'] = FALSE;
        $controller_config['disable_album_file_browse'] = FALSE;
        $controller_config['disable_album_file_button_name'] = TRUE;
        $controller_config['disable_album_file_link'] = TRUE;
        $controller_config['disable_news_type'] = TRUE;
        $controller_config['disable_news_save_draft'] = TRUE;
        $controller_config['disable_news_published_at'] = TRUE;
        $controller_config['disable_news_created_at'] = TRUE;
        // $controller_config['disable_faq_status'] = false;
        
        
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/faq/all', 'refresh');
    }

    public function all()
    {
        // if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        // }
        $filter=array();
        $this->form_validation->set_rules('filterNewsTitle', 'filterNewsTitle', 'trim');
        if ($this->form_validation->run() === true) {
            // echo"workgin";exit;
            $title= $this->input->post('filterNewsTitle');
            $filterNewsPublishedAt= $this->input->post('filterNewsPublishedAt');
            if ($this->input->post('filterNewsTitle') != '') {
                $filter['title'] = $title;
            }
            // echo"<pre>";print_r($filter);exit;
           
        }
        $faq= $this->faq_model->get_all_for_panel($filter);
        // echo"<pre>";print_r($faq);exit;
        $this->data['faqs'] = $faq;
        $this->data['active_menu'] = 'faq';
        $this->data['site_content'] = 'faq';
        $this->load->view('panel/content', $this->data);
    }
    public function add($lang = 1)
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('slugTitle', 'slugTitle', 'trim|required|is_unique[faq.title_slug]');
        $this->form_validation->set_rules('shortDesc', 'shortDesc', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;

            if ($no_error == TRUE) {
                $faq_id = $this->faq_model->add($input_data);
                if ($faq_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/faq/all', 'refresh');
            }
        }
        $this->data['active_menu'] = 'faq';
        $this->data['site_content'] = 'add_faq';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        $language_parent = '';
        if ($id > 0) {
            $faq = $this->faq_model->get_for_panel($id);
        }
        // echo"<pre>";print_r($faq);exit;
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        if (!$faq || empty($faq->title_slug) || $faq->title_slug != $this->input->post('slugTitle')) {
            $this->form_validation->set_rules('slugTitle', 'slug_title', 'trim|required|is_unique[faq.title_slug]');
        }
        $this->form_validation->set_rules('shortDesc', 'short_desc', 'trim');
        $this->form_validation->set_rules('faqStatus', 'faqStatus', 'trim');

        if ($this->form_validation->run() === TRUE) {
            // echo"<pre>";print_r($faq);exit;
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = $this->input->post('faqStatus');
            
            if ($no_error == TRUE) {
                if ($faq) {
                    $this->faq_model->add($input_data, $faq->id);
                } else {
                    $this->faq_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/faq/all', 'refresh');
            }
        }

        $this->data['faq'] = $faq;
        $this->data['active_menu'] = 'faq';
        $this->data['site_content'] = 'edit_faq';
        $this->load->view('panel/content', $this->data);
    }
}
