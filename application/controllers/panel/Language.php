<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Language extends CO_Panel_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Language_model', 'language_model');
        $this->load->helper('image_upload');
        $this->data['image_error'] = '';
    }

    public function index() {
        redirect('panel/language/all');
    }

    public function add() {
        $this->form_validation->set_rules('lname', 'name', 'trim|required|is_unique[language.name]');
        $this->form_validation->set_rules('lcode', 'code', 'trim|required|is_unique[language.code]|strtolower');
        $this->form_validation->set_rules('lang_for[]', 'language for', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $config['upload_path'] = 'assets/uploads/flag';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $img_width = 64;
            $img_height = 64;
            $file_error = '';
            if ($_FILES['lflag']['error'] != 4 && $_FILES['lflag']['name'] != '') {
                $file_info = array('field_name' => 'lflag', 'file' => &$_FILES['lflag']);
                $upload_result = image_resize_upload($file_info, $config, $img_width, $img_height);
                if ($upload_result['error']) {
                    $file_error .= $upload_result['error_msg'];
                    $this->data['image_error'] = $file_error;
                }
            }
            $input_data = array();
            if ($this->data['image_error'] == '') {
                $input_data['name'] = $this->input->post('lname');
                $input_data['code'] = $this->input->post('lcode');
                $input_data['direction'] = $this->input->post('ldirection') == 1 ? 'ltr' : 'rtl';
                $lang_for = $this->input->post('lang_for');
                if (in_array('S', $lang_for)) {
                    $input_data['for_site'] = 1;
                }
                if (in_array('N', $lang_for)) {
                    $input_data['for_news'] = 1;
                }
                if (!empty($upload_result['file_name'])) {
                    $input_data['flag'] = $upload_result['file_name'];
                }
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['status'] = '1';
                $input_data['active'] = 1;
                $this->language_model->add($input_data);
                $this->session->set_flashdata('success', 'Language created successfully.');
                redirect('/panel/language/all', 'refresh');
            }
        }
        $this->data['active_menu'] = 'language';
        $this->data['site_content'] = 'add_language';
        $this->load->view('panel/content', $this->data);
    }

    public function all() {
        $filter = array();
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'language';
        $this->data['site_content'] = 'languages';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id) {
        $language = $this->language_model->get_language($id);
        if (!$language || !isset($id) || empty($id)) {
            redirect('panel/language/all');
        }
        $this->form_validation->set_rules('lname', 'name', 'trim|required');
        $this->form_validation->set_rules('lang_for[]', 'language for', 'trim|required');
        if ($language->code != $this->input->post('lcode')) {
            $this->form_validation->set_rules('lcode', 'code', 'trim|required|strtolower|is_unique[language.code]');
        }
        if ($this->form_validation->run() === TRUE) {
            $config['upload_path'] = 'assets/uploads/flag';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $img_width = 64;
            $img_height = 64;
            $file_error = '';
            if ($_FILES['lflag']['error'] != 4 && $_FILES['lflag']['name'] != '') {
                $file_info = array('field_name' => 'lflag', 'file' => &$_FILES['lflag']);
                $upload_result = image_resize_upload($file_info, $config, $img_width, $img_height);
                if ($upload_result['error']) {
                    $file_error .= $upload_result['error_msg'];
                    $this->data['image_error'] = $file_error;
                }
            }
            $input_data = array();
            if ($this->data['image_error'] == '') {
                if (!empty($upload_result['file_name'])) {
                    $input_data['flag'] = $upload_result['file_name'];
                }
                $input_data['name'] = $this->input->post('lname');
                $input_data['code'] = $this->input->post('lcode');
                $input_data['direction'] = $this->input->post('ldirection') == 1 ? 'ltr' : 'rtl';
                $input_data['status'] = $this->input->post('lstatus') == 'A' ? '1' : '0';
                $lang_for = $this->input->post('lang_for');
                if (in_array('S', $lang_for)) {
                    $input_data['for_site'] = 1;
                } else {
                    $input_data['for_site'] = '';
                }
                if (in_array('N', $lang_for)) {
                    $input_data['for_news'] = 1;
                } else {
                    $input_data['for_news'] = '';
                }
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                $this->language_model->update($input_data, $id);
                $this->session->set_flashdata('success', 'Language updated successfully.');
                redirect('/panel/language/all', 'refresh');
            }
        }
        $this->data['language'] = $language;
        $this->data['active_menu'] = 'language';
        $this->data['site_content'] = 'edit_language';
        $this->load->view('panel/content', $this->data);
    }

    public function view($id) {
        $language = $this->language_model->get_language($id);
        if (!$language || !isset($id) || empty($id)) {
            redirect('panel/language/all');
        }
        $this->data['language'] = $language;
        $this->data['active_menu'] = 'language';
        $this->data['site_content'] = 'view_language';
        $this->load->view('panel/content', $this->data);
    }

}
