<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Userguide extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Userguide_model', 'userguide_model');
        $this->load->model('Language_model', 'language_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        
        //configuration
        $controller_config = array();
        $controller_config['disable_userguide_add'] = FALSE;
        $controller_config['disable_userguide_delete'] = FALSE;
        $controller_config['disable_userguide_languages'] = FALSE;
        
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/userguide/all', 'refresh');
    }

    public function all()
    {
        $filter = array();
        $this->form_validation->set_rules('filterTitle', 'Title', 'trim');
        if ($this->form_validation->run() === true) {
            $title = $this->input->post('filterTitle');
            if ($title != '') {
                $filter['title'] = $title;
            }
        }
        
        $filter['language'] = 1;
        $userguides = $this->userguide_model->get_all_for_panel($filter);
        
        $this->data['userguides'] = $userguides;
        $this->data['active_menu'] = 'userguide';
        $this->data['site_content'] = 'userguides';
        $this->load->view('panel/content', $this->data);
    }

    public function view()
    {
        $filter = array();
        $filter['language'] = 1;
        $filter['active'] = 1;
        $userguides = $this->userguide_model->get_all($filter);
        
        $this->data['userguides'] = $userguides;
        $this->data['active_menu'] = 'userguide_view';
        $this->data['site_content'] = 'view_userguide';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        $current_language = $this->language_model->get_language($lang);
        
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('slugTitle', 'Slug Title', 'trim|required|is_unique[userguide.title_slug]');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['subtitle'] = $this->input->post('subtitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['description'] = $this->input->post('description');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;

            if ($no_error == TRUE) {
                $userguide_id = $this->userguide_model->add($input_data);
                if ($userguide_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/userguide/all', 'refresh');
            }
        }
        
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'userguide';
        $this->data['site_content'] = 'add_userguide';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        $language_parent = '';
        if ($id > 0 && $lang == 1) {
            $userguide = $this->userguide_model->get_for_panel($id);
        } else if ($id > 0 && $lang > 1) {
            $parent_userguide = $this->userguide_model->get_for_panel($id);
            if ($parent_userguide) {
                $language_parent = $id;
                $userguide = $this->userguide_model->get_by_parent($id, $lang);
            }
        }

        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $userguide_languages = $this->userguide_model->get_languages($id);

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        if (!$userguide || empty($userguide->title_slug) || $userguide->title_slug != $this->input->post('slugTitle')) {
            $this->form_validation->set_rules('slugTitle', 'Slug Title', 'trim|required|is_unique[userguide.title_slug]');
        }
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('title');
            $input_data['title_slug'] = $this->input->post('slugTitle');
            $input_data['subtitle'] = $this->input->post('subtitle');
            $input_data['short_desc'] = $this->input->post('shortDesc');
            $input_data['description'] = $this->input->post('description');
            $input_data['updated_at'] = time();
            $input_data['updated_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = $this->input->post('status');
            
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            }

            if ($no_error == TRUE) {
                if ($userguide) {
                    $this->userguide_model->add($input_data, $userguide->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->userguide_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/userguide/all', 'refresh');
            }
        }

        $this->data['userguide'] = $userguide;
        $this->data['languages'] = $languages;
        $this->data['userguide_languages'] = explode(',', ($userguide_languages ? $userguide_languages->languages : ''));
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'userguide';
        $this->data['site_content'] = 'edit_userguide';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id)
    {
        if ($id > 0) {
            $this->userguide_model->disable($id);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        }
        redirect('panel/userguide/all', 'refresh');
    }
}
