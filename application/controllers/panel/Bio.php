<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bio extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Bio_model', 'bio_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables 
        $this->data['bioDescImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_bio_name'] = TRUE;
        $controller_config['disable_bio_title'] = FALSE;
        $controller_config['disable_bio_slugtitle'] = FALSE;
        $controller_config['disable_bio_languages'] = TRUE;
        $controller_config['disable_bio_subtitle'] = TRUE;
        $controller_config['disable_bio_short_desc'] = FALSE;
        $controller_config['disable_bio_description'] = FALSE;
        $controller_config['disable_bio_description_img'] = FALSE;
        $controller_config['disable_bio_person_is'] = TRUE;
        $controller_config['disable_bio_additional_description_img'] = FALSE;

        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/bio/all', 'refresh');
    }

    public function all()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        //Bios list view
        $filter = array();
        $this->form_validation->set_rules('filterBioCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterBioTitle', 'title', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('filterBioTitle');
            if ($this->input->post('filterBioCreatedAt') != '') {
                $filterBioCreatedAt = explode('-', $this->input->post('filterBioCreatedAt'));
                if (!empty($filterBioCreatedAt[0])) {
                    $filterBioCreatedAt[0] = str_replace('/', '-', $filterBioCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterBioCreatedAt[0]);
                }
                if (!empty($filterBioCreatedAt[1])) {
                    $filterBioCreatedAt[1] = str_replace('/', '-', $filterBioCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterBioCreatedAt[1]);
                }
            }
        }
        $this->data['bios'] = $this->bio_model->get_all($filter);
        $this->data['active_menu'] = 'bio';
        $this->data['site_content'] = 'bios';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        //add bio
        $current_language = $this->language_model->get_language($lang);
        if ($this->data['controller_config']['disable_bio_name'] != TRUE) {
            $this->form_validation->set_rules('bioName', 'name', 'trim|required');
        }
        if ($this->data['controller_config']['disable_bio_title'] != TRUE) {
            $this->form_validation->set_rules('bioTitle', 'title', 'trim|required');
        }
        if ($this->data['controller_config']['disable_bio_slugtitle'] != TRUE) {
            $this->form_validation->set_rules('bioSlugTitle', 'slug title', 'trim|required|is_unique[bio.title_slug]');
        }
        $this->form_validation->set_rules('bioSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('bioShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('bioDescription', ' description', 'trim');
        if ($this->data['controller_config']['disable_bio_person_is'] != TRUE)
            $this->form_validation->set_rules('bioPersonIs', ' type', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['name'] = $this->input->post('bioTitle');
            $input_data['title_slug'] = $this->input->post('bioSlugTitle');
            $input_data['subtitle'] = $this->input->post('bioSubtitle');
            $input_data['short_desc'] = $this->input->post('bioShortDesc');
            $input_data['description'] = $this->input->post('bioDescription');
            $input_data['person_is'] = $this->input->post('bioPersonIs');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/bio';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            $image_fields = ['bioDescImg' => 'desc_img', 'additional_img' => 'additional_img'];


            foreach ($image_fields as $field_name => $db_field) {
                if (!empty($_FILES[$field_name]) && $_FILES[$field_name]['error'] == 0) {
                    $file_info = ['field_name' => $field_name, 'file' => &$_FILES[$field_name]];
                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);

                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data[$db_field] = $file_name;
                    } else {
                        $this->data[$field_name . 'Error'] = $upload_result['error_msg'];
                        $no_error = FALSE;
                    }
                }
            }


            if ($no_error == TRUE) {
                $bio_id = $this->bio_model->add($input_data);
                if ($bio_id <= 0) {
                    $no_error = FALSE;
                }
            }

            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/bio/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'bio';
        $this->data['site_content'] = 'add_bio';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        //edit bio based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_bio = $this->bio_model->get($id);
            $bio = $parent_bio;
        } else if ($id > 0 && $lang > 0) {
            $parent_bio = $this->bio_model->get($id);
            if ($parent_bio) {
                $language_parent = $id;
                $bio = $this->bio_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/bio/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_bio_name'] = FALSE;
            $this->data['controller_config']['disable_bio_title'] = TRUE;
            $this->data['controller_config']['disable_bio_slugtitle'] = TRUE;
            $this->data['controller_config']['disable_bio_subtitle'] = TRUE;
            $this->data['controller_config']['disable_bio_short_desc'] = TRUE;
            $this->data['controller_config']['disable_bio_person_is'] = TRUE;
            $this->data['controller_config']['disable_bio_description_img'] = TRUE;
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_bio || !$current_language) {
            redirect('panel/bio/all', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $bio_languages = $this->bio_model->get_languages($id);
        if ($this->data['controller_config']['disable_bio_name'] != TRUE) {
            $this->form_validation->set_rules('bioName', 'name', 'trim|required');
        }
        if ($this->data['controller_config']['disable_bio_title'] != TRUE) {
            $this->form_validation->set_rules('bioTitle', 'title', 'trim|required');
        }
        if ($this->data['controller_config']['disable_bio_slugtitle'] != TRUE) {
            if (!$bio || empty($bio->title_slug) || $bio->title_slug != $this->input->post('bioSlugTitle')) {
                $this->form_validation->set_rules('bioSlugTitle', 'slug title', 'trim|required|is_unique[bio.title_slug]');
            }
        }
        $this->form_validation->set_rules('bioSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('bioShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('bioDescription', ' description', 'trim');
        if ($this->data['controller_config']['disable_bio_person_is'] != TRUE) {
            $this->form_validation->set_rules('bioPersonIs', ' type', 'trim|required');
        }
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            // $input_data['name'] = $this->input->post('bioName');
            $input_data['name'] = $this->input->post('bioTitle');
            $input_data['title_slug'] = $this->input->post('bioSlugTitle');
            $input_data['subtitle'] = $this->input->post('bioSubtitle');
            $input_data['short_desc'] = $this->input->post('bioShortDesc');
            $input_data['description'] = $this->input->post('bioDescription');
            $input_data['person_is'] = $this->input->post('bioPersonIs');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/bio';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['bioDescImg']) && $_FILES['bioDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'bioDescImg', 'file' => &$_FILES['bioDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/bio/' . $bio->desc_img) && !empty($bio->desc_img)) {
                        unlink('./assets/uploads/bio/' . $bio->desc_img);
                        unlink('./assets/uploads/bio/thumb_' . $bio->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['bioDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if (!empty($_FILES['additional_img']) && $_FILES['additional_img']['error'] == 0) {
                $file_info = array('field_name' => 'additional_img', 'file' => &$_FILES['additional_img']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/bio/' . $bio->additional_img) && !empty($bio->additional_img)) {
                        unlink('./assets/uploads/bio/' . $bio->additional_img);
                        unlink('./assets/uploads/bio/thumb_' . $bio->additional_img);
                    }
                    $input_data['additional_img'] = $file_name;
                } else {
                    $this->data['additional_imgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($bio) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->bio_model->add($input_data, $bio->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->bio_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/bio/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['bio_languages'] = explode(',', $bio_languages->languages);
        $this->data['bio'] = $bio;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'bio';
        $this->data['site_content'] = 'edit_bio';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_desc_img($id, $lang = '1')
    {
        //edit bio based on language
        if ($id > 0 && $lang == '1') {
            $bio = $this->bio_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $bio = $this->bio_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/bio/all', 'refresh');
        }
        if (file_exists('./assets/uploads/bio/' . $bio->desc_img) && !empty($bio->desc_img)) {
            unlink('./assets/uploads/bio/' . $bio->desc_img);
            unlink('./assets/uploads/bio/thumb_' . $bio->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->bio_model->add($input_data, $bio->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/bio/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete_adddesc_img($id, $lang = '1')
    {
        //edit bio based on language
        if ($id > 0 && $lang == '1') {
            $bio = $this->bio_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $bio = $this->bio_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/bio/all', 'refresh');
        }
        if (file_exists('./assets/uploads/bio/' . $bio->additional_img) && !empty($bio->additional_img)) {
            unlink('./assets/uploads/bio/' . $bio->additional_img);
            unlink('./assets/uploads/bio/thumb_' . $bio->additional_img);
        }
        $input_data['additional_img'] = '';
        $this->bio_model->add($input_data, $bio->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/bio/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id)
    {
        if ($id > 0) {
            $this->bio_model->disable($id);
        }
        $this->session->set_flashdata('success', 'Bio deleted successfully.');
        redirect('panel/bio/all', 'refresh');
    }
}
