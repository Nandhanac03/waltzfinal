<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Advertisement extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Advertisement_model', 'advertisement_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['advertisementImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_advertisement_add'] = FALSE;
        $controller_config['disable_advertisement_delete'] = TRUE;
        $controller_config['disable_advertisement_description'] = FALSE;
        $controller_config['disable_advertisement_link'] = FALSE;
        $controller_config['disable_advertisement_button_name'] = FALSE;
        $controller_config['disable_advertisement_img'] = FALSE;
        $controller_config['disable_advertisement_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/advertisement/all', 'refresh');
    }

    public function all() {
        //Advertisements list view
        $filter = array();
        $this->form_validation->set_rules('filterAdvertisementCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterAdvertisementTitle', 'title', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['advertisement_title'] = $this->input->post('filterAdvertisementTitle');
            if ($this->input->post('filterAdvertisementCreatedAt') != '') {
                $filterAdvertisementCreatedAt = explode('-', $this->input->post('filterAdvertisementCreatedAt'));
                if (!empty($filterAdvertisementCreatedAt[0])) {
                    $filterAdvertisementCreatedAt[0] = str_replace('/', '-', $filterAdvertisementCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterAdvertisementCreatedAt[0]);
                }
                if (!empty($filterAdvertisementCreatedAt[1])) {
                    $filterAdvertisementCreatedAt[1] = str_replace('/', '-', $filterAdvertisementCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterAdvertisementCreatedAt[1]);
                }
            }
        }
        $this->data['advertisements'] = $this->advertisement_model->get_all($filter);
        $this->data['active_menu'] = 'advertisement';
        $this->data['site_content'] = 'advertisement';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add advertisement

        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('advertisementTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('advertisementDescription', 'description', 'trim');
        $this->form_validation->set_rules('advertisementLink', 'link', 'trim');
        $this->form_validation->set_rules('advertisementButtonName', 'button name', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['advertisement_title'] = $this->input->post('advertisementTitle');
            $input_data['description'] = $this->input->post('advertisementDescription');
            $input_data['link'] = $this->input->post('advertisementLink');
            $input_data['button_name'] = $this->input->post('advertisementButtonName');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/web_ad';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['advertisementImg']) && $_FILES['advertisementImg']['error'] == 0) {
                $file_info = array('field_name' => 'advertisementImg', 'file' => &$_FILES['advertisementImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['advertisement_img'] = $file_name;
                } else {
                    $this->data['advertisementImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                $advertisement_id = $this->advertisement_model->add($input_data);
                if ($advertisement_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/advertisement/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'advertisement';
        $this->data['site_content'] = 'add_advertisement';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        //edit advertisement based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_advertisement = $this->advertisement_model->get($id);
            $advertisement = $parent_advertisement;
        } else if ($id > 0 && $lang > 0) {
            $parent_advertisement = $this->advertisement_model->get($id);
            if ($parent_advertisement) {
                $language_parent = $id;
                $advertisement = $this->advertisement_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/advertisement/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_advertisement || !$current_language) {
            redirect('panel/advertisement/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $controller_config['disable_advertisement_link'] = TRUE;
            $controller_config['disable_advertisement_img'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $advertisement_languages = $this->advertisement_model->get_languages($id);
        $this->form_validation->set_rules('advertisementTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('advertisementDescription', 'description', 'trim');
        $this->form_validation->set_rules('advertisementLink', 'link', 'trim');
        $this->form_validation->set_rules('advertisementButtonName', 'button name', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['advertisement_title'] = $this->input->post('advertisementTitle');
            $input_data['description'] = $this->input->post('advertisementDescription');
            $input_data['link'] = $this->input->post('advertisementLink');
            $input_data['button_name'] = $this->input->post('advertisementButtonName');
            $input_data['language'] = $lang;
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/web_ad';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['advertisementImg']) && $_FILES['advertisementImg']['error'] == 0) {
                $file_info = array('field_name' => 'advertisementImg', 'file' => &$_FILES['advertisementImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/web_ad/' . $advertisement->advertisement_img) && !empty($advertisement->advertisement_img)) {
                        unlink('./assets/uploads/web_ad/' . $advertisement->advertisement_img);
                        unlink('./assets/uploads/web_ad/thumb_' . $advertisement->advertisement_img);
                    }
                    $input_data['advertisement_img'] = $file_name;
                } else {
                    $this->data['advertisementImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($advertisement) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->advertisement_model->add($input_data, $advertisement->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->advertisement_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/advertisement/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['advertisement_languages'] = explode(',', $advertisement_languages->languages);
        $this->data['advertisement'] = $advertisement;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'advertisement';
        $this->data['site_content'] = 'edit_advertisement';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_advertisement_img($id, $lang = '1') {
        //edit advertisement based on language
        if ($id > 0 && $lang == '1') {
            $advertisement = $this->advertisement_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $advertisement = $this->advertisement_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/advertisement/all', 'refresh');
        }
        if (file_exists('./assets/uploads/web_ad/' . $advertisement->advertisement_img) && !empty($advertisement->advertisement_img)) {
            unlink('./assets/uploads/web_ad/' . $advertisement->advertisement_img);
            unlink('./assets/uploads/web_ad/thumb_' . $advertisement->advertisement_img);
        }
        $input_data['advertisement_img'] = '';
        $this->advertisement_model->add($input_data, $advertisement->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/advertisement/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $this->advertisement_model->disable($id);
        }
        $this->session->set_flashdata('success', 'Advertisement deleted successfully.');
        redirect('panel/advertisement/all', 'refresh');
    }

}
