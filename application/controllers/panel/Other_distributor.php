<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Other_distributor extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Other_distributor_model', 'other_distributor_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //decalaring variables
        $this->data['otherDistributorImgError'] = '';
        $this->data['distributor_categories'] =array('b'=>'Books','a'=>'Audio Books','e'=>'E-Books','i'=>'Interactive Books');
        
        //configuration
        $controller_config = array();
        $controller_config['disable_other_distributor_img'] = FALSE;
        $controller_config['disable_other_distributor_link'] = FALSE;
        $controller_config['disable_other_distributor_description'] = TRUE;
        $controller_config['disable_other_distributor_category'] = FALSE;
        $controller_config['disable_other_distributor_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/otherDistributor/all', 'refresh');
    }

    public function all() {
        //Other distributors list view
        $filter = array();
        $this->form_validation->set_rules('filterOtherDistributorCreatedAt', 'Status', 'trim');
        $this->form_validation->set_rules('otherDistributorTitle', 'Title', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('otherDistributorTitle');
            if ($this->input->post('otherDistributorCreatedAt') != '') {
                $filterOtherDistributorCreatedAt = explode('-', $this->input->post('otherDistributorCreatedAt'));
                if (!empty($filterOtherDistributorCreatedAt[0])) {
                    $filterOtherDistributorCreatedAt[0] = str_replace('/', '-', $filterOtherDistributorCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterOtherDistributorCreatedAt[0]);
                }
                if (!empty($filterOtherDistributorCreatedAt[1])) {
                    $filterOtherDistributorCreatedAt[1] = str_replace('/', '-', $filterOtherDistributorCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterOtherDistributorCreatedAt[1]);
                }
            }
        }
        $this->data['otherDistributors'] = $this->other_distributor_model->get_all($filter);
        $this->data['active_menu'] = 'other_distributor';
        $this->data['site_content'] = 'other_distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add other distributor
        $current_language = $this->language_model->get_language($lang);
        if($this->data['controller_config']['disable_other_distributor_category']!=true)
        $this->form_validation->set_rules('otherDistributorCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('otherDistributorTitle', 'Title', 'trim|required');
        $this->form_validation->set_rules('otherDistributorDescription', ' Description', 'trim');
        $this->form_validation->set_rules('otherDistributorLink', ' Link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['category'] = $this->input->post('otherDistributorCategory');
            $input_data['title'] = $this->input->post('otherDistributorTitle');
            $input_data['description'] = $this->input->post('otherDistributorDescription');
            $input_data['link'] = $this->input->post('otherDistributorLink');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/distributor';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['otherDistributorImg']) && $_FILES['otherDistributorImg']['error'] == 0) {
                $file_info = array('field_name' => 'otherDistributorImg', 'file' => &$_FILES['otherDistributorImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['distributor_img'] = $file_name;
                } else {
                    $this->data['otherDistributorImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                $other_distributor_id = $this->other_distributor_model->add($input_data);
                if ($other_distributor_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/other_distributor/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'other_distributor';
        $this->data['site_content'] = 'add_other_distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        //edit other distributor based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_otherDistributor = $this->other_distributor_model->get($id);
            $otherDistributor = $parent_otherDistributor;
        } else if ($id > 0 && $lang > 0) {
            $parent_otherDistributor = $this->other_distributor_model->get($id);
            if ($parent_otherDistributor) {
                $language_parent = $id;
                $otherDistributor = $this->other_distributor_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/other_distributor/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_otherDistributor || !$current_language) {
            redirect('panel/other_distributor/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_other_distributor_img'] = TRUE;
            $this->data['controller_config']['disable_other_distributor_link'] = TRUE;
            $this->data['controller_config']['disable_other_distributor_category'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $other_distributor_languages = $this->other_distributor_model->get_languages($id);
        if($this->data['controller_config']['disable_other_distributor_category']!=true)
        $this->form_validation->set_rules('otherDistributorCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('otherDistributorTitle', 'Title', 'trim|required');
        $this->form_validation->set_rules('otherDistributorDescription', 'Description', 'trim');
        $this->form_validation->set_rules('otherDistributorLink', ' Link', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['category'] = $this->input->post('otherDistributorCategory');
            $input_data['title'] = $this->input->post('otherDistributorTitle');
            $input_data['description'] = $this->input->post('otherDistributorDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $input_data['link'] = $this->input->post('otherDistributorLink');
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/distributor';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['otherDistributorImg']) && $_FILES['otherDistributorImg']['error'] == 0) {
                $file_info = array('field_name' => 'otherDistributorImg', 'file' => &$_FILES['otherDistributorImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/distributor/' . $otherDistributor->distributor_img) && !empty($otherDistributor->distributor_img)) {
                        unlink('./assets/uploads/distributor/' . $otherDistributor->distributor_img);
                        unlink('./assets/uploads/distributor/thumb_' . $otherDistributor->distributor_img);
                    }
                    $input_data['distributor_img'] = $file_name;
                } else {
                    $this->data['otherDistributorImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($otherDistributor) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->other_distributor_model->add($input_data, $otherDistributor->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->other_distributor_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/other_distributor/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['other_distributor_languages'] = explode(',', $other_distributor_languages->languages);
        $this->data['otherDistributor'] = $otherDistributor;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'other_distributor';
        $this->data['site_content'] = 'edit_other_distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_other_distributor_img($id, $lang = '1') {
        //edit other distributor based on language
        if ($id > 0 && $lang == '1') {
            $otherDistributor = $this->other_distributor_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $otherDistributor = $this->other_distributor_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/other_distributor/all', 'refresh');
        }
        if (file_exists('./assets/uploads/distributor/' . $otherDistributor->distributor_img) && !empty($otherDistributor->distributor_img)) {
            unlink('./assets/uploads/distributor/' . $otherDistributor->distributor_img);
            unlink('./assets/uploads/distributor/thumb_' . $otherDistributor->distributor_img);
        }
        $input_data['distributor_img'] = '';
        $this->other_distributor_model->add($input_data, $otherDistributor->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/other_distributor/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $otherDistributor = $this->other_distributor_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->other_distributor_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/other_distributor/all', 'refresh');
    }

}
