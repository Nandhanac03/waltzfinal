<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Policy extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Policy_model', 'policy_model');

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
        $controller_config['disable_news_add'] = TRUE;

        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/policy/all', 'refresh');
    }

    public function all()
    {
        $policy= $this->policy_model->get_all();
        $this->data['policy']= $policy;
        $this->data['active_menu'] = 'privacy_policy';
        $this->data['site_content'] = 'policy';
        $this->load->view('panel/content', $this->data);
    }
    public function add($lang = 1)
    {
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

            // echo"<pre>";print_r($input_data);exit;
            if ($no_error == TRUE) {
                $policy = $this->policy_model->add($input_data);
                if ($policy <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/policy/all', 'refresh');
            }
        }
        $this->data['active_menu'] = 'privacy_policy';
        $this->data['site_content'] = 'add_policy';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        $language_parent = '';
        if ($id > 0) {
            $policy = $this->policy_model->get($id);
        }

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        if (!$policy || empty($policy->title_slug) || $policy->title_slug != $this->input->post('slugTitle')) {
            $this->form_validation->set_rules('slugTitle', 'slug_title', 'trim|required|is_unique[privacy_policy.title_slug]');
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
                if ($policy) {
                    $this->policy_model->add($input_data, $policy->id);
                } else {
                    $this->policy_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/policy/all', 'refresh');
            }
        }

        $this->data['policy'] = $policy;
        $this->data['active_menu'] = 'privacy_policy';
        $this->data['site_content'] = 'edit_policy';
        $this->load->view('panel/content', $this->data);
    }
}
