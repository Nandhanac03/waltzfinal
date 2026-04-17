<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Terms extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Terms_model', 'terms_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_album_add'] = true;
        $controller_config['disable_album_delete'] = FALSE;
        $controller_config['disable_album_file_edit'] = FALSE;
        $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_album_file_subtitle'] = TRUE;
        $controller_config['disable_album_file_short_desc'] = TRUE;
        $controller_config['disable_album_file_languages'] = FALSE;
        $controller_config['disable_album_file_browse'] = FALSE;
        $controller_config['disable_album_file_button_name'] = TRUE;
        $controller_config['disable_album_file_link'] = TRUE;
        $controller_config['disable_news_add'] = TRUE;

        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/subscription/all', 'refresh');
    }

    public function all()
    {
        $terms= $this->terms_model->get_all();
        // echo"<pre>";print_r($terms);exit;
        $this->data['terms'] = $terms;
        $this->data['active_menu'] = 'terms_of_service';
        $this->data['site_content'] = 'terms';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        // if($_POST){
            // }
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('slugTitle', 'slugTitle', 'trim|required|is_unique[terms_of_services.title_slug]');
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
                    $faq_id = $this->terms_model->add($input_data);
                    if ($faq_id <= 0) {
                        $no_error = FALSE;
                    }
                }
                // echo"working";exit;
                if ($no_error == FALSE) {
                    $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
                } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/terms/all', 'refresh');
            }
        }
        $this->data['active_menu'] = 'terms_of_service';
        $this->data['site_content'] = 'add_terms';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        $language_parent = '';
        if ($id > 0) {
            $terms = $this->terms_model->get($id);
        }
        
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        if (!$terms || empty($terms->title_slug) || $terms->title_slug != $this->input->post('slugTitle')) {
            $this->form_validation->set_rules('slugTitle', 'slug_title', 'trim|required|is_unique[terms_of_services.title_slug]');
        }
        $this->form_validation->set_rules('shortDesc', 'short_desc', 'trim');
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
                if ($terms) {
                    $this->terms_model->add($input_data, $terms->id);
                } else {
                    $this->terms_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/terms/all', 'refresh');
            }
        }

        $this->data['terms'] = $terms;
        $this->data['active_menu'] = 'terms_of_service';
        $this->data['site_content'] = 'edit_terms';
        $this->load->view('panel/content', $this->data);
    }

}
