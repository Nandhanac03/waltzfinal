<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Company_model', 'company_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        $this->data['companyImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_company_img'] = FALSE;
        $controller_config['disable_company_img_delete'] = FALSE;
        $controller_config['disable_company_link'] = FALSE;
        $controller_config['disable_company_description'] = FALSE;
        $controller_config['disable_company_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/company/all', 'refresh');
    }

    public function all() {
        //Companys list view
        $filter = array();
        $this->form_validation->set_rules('filterCompanyCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterCompanyName', 'name', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['company_name'] = $this->input->post('filterCompanyName');
            if ($this->input->post('filterCompanyCreatedAt') != '') {
                $filterCompanyCreatedAt = explode('-', $this->input->post('filterCompanyCreatedAt'));
                if (!empty($filterCompanyCreatedAt[0])) {
                    $filterCompanyCreatedAt[0] = str_replace('/', '-', $filterCompanyCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterCompanyCreatedAt[0]);
                }
                if (!empty($filterCompanyCreatedAt[1])) {
                    $filterCompanyCreatedAt[1] = str_replace('/', '-', $filterCompanyCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterCompanyCreatedAt[1]);
                }
            }
        }
        $this->data['companys'] = $this->company_model->get_all($filter);
        $this->data['active_menu'] = 'company';
        $this->data['site_content'] = 'company';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add company
        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('companyName', 'name', 'trim|required');
        $this->form_validation->set_rules('companyDescription', 'description', 'trim');
        $this->form_validation->set_rules('companyLink', 'link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['company_name'] = $this->input->post('companyName');
            $input_data['description'] = $this->input->post('companyDescription');
            $input_data['link'] = $this->input->post('companyLink');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/company';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['companyImg']) && $_FILES['companyImg']['error'] == 0) {
                $file_info = array('field_name' => 'companyImg', 'file' => &$_FILES['companyImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['company_img'] = $file_name;
                } else {
                    $this->data['companyImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                $company_id = $this->company_model->add($input_data);
                if ($company_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/company/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'company';
        $this->data['site_content'] = 'add_company';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        //edit company based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_company = $this->company_model->get($id);
            $company = $parent_company;
        } else if ($id > 0 && $lang > 0) {
            $parent_company = $this->company_model->get($id);
            if ($parent_company) {
                $language_parent = $id;
                $company = $this->company_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/company/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_company || !$current_language) {
            redirect('panel/company/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_company_img'] = TRUE;
            $this->data['controller_config']['disable_company_link'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $company_languages = $this->company_model->get_languages($id);
        $this->form_validation->set_rules('companyName', 'name', 'trim|required');
        $this->form_validation->set_rules('companyDescription', 'description', 'trim');
        $this->form_validation->set_rules('companyLink', 'link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['company_name'] = $this->input->post('companyName');
            $input_data['description'] = $this->input->post('companyDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $input_data['link'] = $this->input->post('companyLink');
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/company';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['companyImg']) && $_FILES['companyImg']['error'] == 0) {
                $file_info = array('field_name' => 'companyImg', 'file' => &$_FILES['companyImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/company/' . $company->company_img) && !empty($company->company_img)) {
                        unlink('./assets/uploads/company/' . $company->company_img);
                        unlink('./assets/uploads/company/thumb_' . $company->company_img);
                    }
                    $input_data['company_img'] = $file_name;
                } else {
                    $this->data['companyImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($company) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->company_model->add($input_data, $company->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->company_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/company/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['company_languages'] = explode(',', $company_languages->languages);
        $this->data['company'] = $company;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'company';
        $this->data['site_content'] = 'edit_company';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_company_img($id, $lang = '1') {
        //edit company based on language
        if ($id > 0 && $lang == '1') {
            $company = $this->company_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $company = $this->company_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/company/all', 'refresh');
        }
        if (file_exists('./assets/uploads/company/' . $company->company_img) && !empty($company->company_img)) {
            unlink('./assets/uploads/company/' . $company->company_img);
            unlink('./assets/uploads/company/thumb_' . $company->company_img);
        }
        $input_data['company_img'] = '';
        $this->company_model->add($input_data, $company->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/company/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $company = $this->company_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->company_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Company deleted successfully.');
        redirect('panel/company/all', 'refresh');
    }

}
