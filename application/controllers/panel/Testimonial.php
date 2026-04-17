<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Testimonial extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Testimonial_model', 'testimonial_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //configuration
        $controller_config = array();
        $controller_config['disable_testimonial_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
        $this->data['author_img_note']="Recommended image dimension 400 x 400px. Supports jpg, jpeg and png.";
    }

    public function index()
    {
        redirect('panel/testimonial/all', 'refresh');
    }

    public function all()
    {
        //Testimonials list view
        $filter = array();
        $this->form_validation->set_rules('filterTestimonialCreatedAt', 'Status', 'trim');
        $filter['language'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('filterTestimonialTitle');
            if ($this->input->post('filterTestimonialCreatedAt') != '') {
                $filterTestimonialCreatedAt = explode('-', $this->input->post('filterTestimonialCreatedAt'));
                if (!empty($filterTestimonialCreatedAt[0])) {
                    $filterTestimonialCreatedAt[0] = str_replace('/', '-', $filterTestimonialCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterTestimonialCreatedAt[0]);
                }
                if (!empty($filterTestimonialCreatedAt[1])) {
                    $filterTestimonialCreatedAt[1] = str_replace('/', '-', $filterTestimonialCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterTestimonialCreatedAt[1]);
                }
            }
        }
        $this->data['testimonials'] = $this->testimonial_model->get_all($filter);
        $this->data['active_menu'] = 'testimonial';
        $this->data['site_content'] = 'testimonial';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        //add testimonial
        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('testimonialStatement', 'Statement', 'trim|required|max_length[500]');
        $this->form_validation->set_rules('testimonialStatementBy', ' Description', 'trim|max_length[50]');
        $this->form_validation->set_rules('testimonialDesignation', ' Designation', 'trim|max_length[90]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['statement'] = $this->input->post('testimonialStatement');
            $input_data['statement_by'] = $this->input->post('testimonialStatementBy');
            $input_data['designation'] = $this->input->post('testimonialDesignation');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;

            $config = array();
            $config['upload_path'] = 'assets/uploads/testimonials';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['testimonialAuthorImg']) && $_FILES['testimonialAuthorImg']['error'] == 0) {
                $file_info = array('field_name' => 'testimonialAuthorImg', 'file' => &$_FILES['testimonialAuthorImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['testimonialAuthorImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $testimonial_id = $this->testimonial_model->add($input_data);
            if ($testimonial_id <= 0) {
                $no_error = FALSE;
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/testimonial/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'testimonial';
        $this->data['site_content'] = 'add_testimonial';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        //edit testimonial based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_testimonial = $this->testimonial_model->get($id);
            $testimonial = $parent_testimonial;
        } else if ($id > 0 && $lang > 0) {
            $parent_testimonial = $this->testimonial_model->get($id);
            if ($parent_testimonial) {
                $language_parent = $id;
                $testimonial = $this->testimonial_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/testimonial/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_testimonial || !$current_language) {
            redirect('panel/testimonial/all', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $testimonial_languages = $this->testimonial_model->get_languages($id);
        $this->form_validation->set_rules('testimonialStatement', 'Statement', 'trim|required|max_length[500]');
        $this->form_validation->set_rules('testimonialStatementBy', ' Description', 'trim|max_length[50]');
        $this->form_validation->set_rules('testimonialDesignation', ' Designation', 'trim|max_length[90]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['statement'] = $this->input->post('testimonialStatement');
            $input_data['statement_by'] = $this->input->post('testimonialStatementBy');
            $input_data['designation'] = $this->input->post('testimonialDesignation');
            $input_data['language'] = $lang;
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/testimonials';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 500;
            // $config['max_width'] = 680;
            // $config['max_height'] = 560;
            if (!empty($_FILES['testimonialAuthorImg']) && $_FILES['testimonialAuthorImg']['error'] == 0) {
                $file_info = array('field_name' => 'testimonialAuthorImg', 'file' => &$_FILES['testimonialAuthorImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/testimonials/' . $testimonial->desc_img) && !empty($testimonial->desc_img)) {
                        unlink('./assets/uploads/testimonials/' . $testimonial->desc_img);
                        unlink('./assets/uploads/testimonials/thumb_' . $testimonial->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['testimonialAuthorImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($testimonial) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->testimonial_model->add($input_data, $testimonial->id);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->testimonial_model->add($input_data);
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/testimonial/all', 'refresh');
            }
        }
        $this->data['testimonial_languages'] = explode(',', $testimonial_languages->languages);
        $this->data['testimonial'] = $testimonial;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'testimonial';
        $this->data['site_content'] = 'edit_testimonial';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id, $lang = '1')
    {
        if ($id > 0 && $lang == '1') {
            $testimonial = $this->testimonial_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->testimonial_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Testimonial deleted successfully.');
        redirect('panel/testimonial/all', 'refresh');
    }

    public function delete_desc_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $testimonial = $this->testimonial_model->get($id, $lang);
        } else {
            redirect('panel/testimonial/all', 'refresh');
        }
        if (file_exists('./assets/uploads/testimonials/' . $testimonial->desc_img) && !empty($testimonial->desc_img)) {
            unlink('./assets/uploads/testimonials/' . $testimonial->desc_img);
            unlink('./assets/uploads/testimonials/thumb_' . $testimonial->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->testimonial_model->add($input_data, $testimonial->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/testimonial/edit/' . $testimonial->id . '/' . $lang, 'refresh');
    }
}
