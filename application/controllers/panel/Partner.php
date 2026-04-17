<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Partner extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Partner_model', 'partner_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        $this->data['partnerImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_partner_img'] = FALSE;
        $controller_config['disable_partner_img_delete'] = TRUE;
        $controller_config['disable_partner_link'] = TRUE;
        $controller_config['disable_partner_description'] = TRUE;
        $controller_config['disable_partner_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/partner/all', 'refresh');
    }

    public function all() {
        //Partners list view
        $filter = array();
        $this->form_validation->set_rules('filterPartnerCreatedAt', 'Status', 'trim');
        $this->form_validation->set_rules('filterPartnerName', 'Name', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['partner_name'] = $this->input->post('filterPartnerName');
            if ($this->input->post('filterPartnerCreatedAt') != '') {
                $filterPartnerCreatedAt = explode('-', $this->input->post('filterPartnerCreatedAt'));
                if (!empty($filterPartnerCreatedAt[0])) {
                    $filterPartnerCreatedAt[0] = str_replace('/', '-', $filterPartnerCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterPartnerCreatedAt[0]);
                }
                if (!empty($filterPartnerCreatedAt[1])) {
                    $filterPartnerCreatedAt[1] = str_replace('/', '-', $filterPartnerCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterPartnerCreatedAt[1]);
                }
            }
        }
        $this->data['partners'] = $this->partner_model->get_all($filter);
        $this->data['active_menu'] = 'partner';
        $this->data['site_content'] = 'partner';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add partner
        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('partnerName', 'Name', 'trim|required');
        $this->form_validation->set_rules('partnerDescription', ' Description', 'trim');
        $this->form_validation->set_rules('partnerLink', ' Link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['partner_name'] = $this->input->post('partnerName');
            $input_data['description'] = $this->input->post('partnerDescription');
            $input_data['link'] = $this->input->post('partnerLink');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/partner';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['partnerImg']) && $_FILES['partnerImg']['error'] == 0) {
                $file_info = array('field_name' => 'partnerImg', 'file' => &$_FILES['partnerImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['partner_img'] = $file_name;
                } else {
                    $this->data['partnerImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                $partner_id = $this->partner_model->add($input_data);
                if ($partner_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/partner/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'partner';
        $this->data['site_content'] = 'add_partner';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        //edit partner based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_partner = $this->partner_model->get($id);
            $partner = $parent_partner;
        } else if ($id > 0 && $lang > 0) {
            $parent_partner = $this->partner_model->get($id);
            if ($parent_partner) {
                $language_parent = $id;
                $partner = $this->partner_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/partner/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_partner || !$current_language) {
            redirect('panel/partner/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_partner_img'] = TRUE;
            $this->data['controller_config']['disable_partner_link'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $partner_languages = $this->partner_model->get_languages($id);
        $this->form_validation->set_rules('partnerName', 'Name', 'trim|required');
        $this->form_validation->set_rules('partnerDescription', 'Description', 'trim');
        $this->form_validation->set_rules('partnerLink', ' Link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['partner_name'] = $this->input->post('partnerName');
            $input_data['description'] = $this->input->post('partnerDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $input_data['link'] = $this->input->post('partnerLink');
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/partner';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['partnerImg']) && $_FILES['partnerImg']['error'] == 0) {
                $file_info = array('field_name' => 'partnerImg', 'file' => &$_FILES['partnerImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/partner/' . $partner->partner_img) && !empty($partner->partner_img)) {
                        unlink('./assets/uploads/partner/' . $partner->partner_img);
                        unlink('./assets/uploads/partner/thumb_' . $partner->partner_img);
                    }
                    $input_data['partner_img'] = $file_name;
                } else {
                    $this->data['partnerImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($partner) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->partner_model->add($input_data, $partner->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->partner_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/partner/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['partner_languages'] = explode(',', $partner_languages->languages);
        $this->data['partner'] = $partner;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'partner';
        $this->data['site_content'] = 'edit_partner';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_partner_img($id, $lang = '1') {
        //edit partner based on language
        if ($id > 0 && $lang == '1') {
            $partner = $this->partner_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $partner = $this->partner_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/partner/all', 'refresh');
        }
        if (file_exists('./assets/uploads/partner/' . $partner->partner_img) && !empty($partner->partner_img)) {
            unlink('./assets/uploads/partner/' . $partner->partner_img);
            unlink('./assets/uploads/partner/thumb_' . $partner->partner_img);
        }
        $input_data['partner_img'] = '';
        $this->partner_model->add($input_data, $partner->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/partner/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $partner = $this->partner_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->partner_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Partner deleted successfully.');
        redirect('panel/partner/all', 'refresh');
    }

}
