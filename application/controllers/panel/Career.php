<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Career extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Career_model', 'career_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['careerDescImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_career_short_desc'] = TRUE;
        $controller_config['disable_career_languages'] = FALSE;
        $controller_config['disable_career_description_img'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/career/all', 'refresh');
    }

    public function all() {
        //Careers list view
        $filter = array();
        $this->form_validation->set_rules('filterCareerCreatedAt', 'status', 'trim');
        $this->form_validation->set_rules('filterCareerTitle', 'title', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('filterCareerTitle');
            if ($this->input->post('filterCareerCreatedAt') != '') {
                $filterCareerCreatedAt = explode('-', $this->input->post('filterCareerCreatedAt'));
                if (!empty($filterCareerCreatedAt[0])) {
                    $filterCareerCreatedAt[0] = str_replace('/', '-', $filterCareerCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterCareerCreatedAt[0]);
                }
                if (!empty($filterCareerCreatedAt[1])) {
                    $filterCareerCreatedAt[1] = str_replace('/', '-', $filterCareerCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterCareerCreatedAt[1]);
                }
            }
        }
        $this->data['careers'] = $this->career_model->get_all($filter);
        $this->data['active_menu'] = 'career';
        $this->data['site_content'] = 'careers';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add career
        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('careerTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('careerShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('careerDescription', ' description', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('careerTitle');
            $input_data['short_desc'] = $this->input->post('careerShortDesc');
            $input_data['description'] = $this->input->post('careerDescription');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = 1;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/career';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['careerDescImg']) && $_FILES['careerDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'careerDescImg', 'file' => &$_FILES['careerDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['careerDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                $career_id = $this->career_model->add($input_data);
                if ($career_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/career/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'career';
        $this->data['site_content'] = 'add_career';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = '1') {
        //edit career based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_career = $this->career_model->get($id);
            $career = $parent_career;
        } else if ($id > 0 && $lang > 0) {
            $parent_career = $this->career_model->get($id);
            if ($parent_career) {
                $language_parent = $id;
                $career = $this->career_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/career/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_career || !$current_language) {
            redirect('panel/career/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_career_description_img'] = TRUE;
        }
        $languages = $this->language_model->get_languages(array('site_flag' => 1, 'status' => 1));
        $career_languages = $this->career_model->get_languages($id);
        $this->form_validation->set_rules('careerTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('careerShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('careerDescription', 'description', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('careerTitle');
            $input_data['short_desc'] = $this->input->post('careerShortDesc');
            $input_data['description'] = $this->input->post('careerDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/career';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['careerDescImg']) && $_FILES['careerDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'careerDescImg', 'file' => &$_FILES['careerDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/career/' . $career->desc_img) && !empty($career->desc_img)) {
                        unlink('./assets/uploads/career/' . $career->desc_img);
                        unlink('./assets/uploads/career/thumb_' . $career->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['careerDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($career) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->career_model->add($input_data, $career->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->career_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/career/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['career_languages'] = explode(',', $career_languages->languages);
        $this->data['career'] = $career;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'career';
        $this->data['site_content'] = 'edit_career';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_desc_img($id, $lang = '1') {
        //edit career based on language
        if ($id > 0 && $lang == '1') {
            $career = $this->career_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $career = $this->career_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/career/all', 'refresh');
        }
        if (file_exists('./assets/uploads/career/' . $career->desc_img) && !empty($career->desc_img)) {
            unlink('./assets/uploads/career/' . $career->desc_img);
            unlink('./assets/uploads/career/thumb_' . $career->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->career_model->add($input_data, $career->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/career/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $career = $this->career_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->career_model->disable($id);
                $this->career_model->disable('', $id);
            }
        }
        $this->session->set_flashdata('success', 'Career deleted successfully.');
        redirect('panel/career/all', 'refresh');
    }

}
