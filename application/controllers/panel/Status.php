<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models

        $this->load->model('Status_model', 'status_model');
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
        $controller_config['disable_status_slug_title'] = FALSE;
        $controller_config['disable_album_file_button_name'] = TRUE;
        $controller_config['disable_album_file_link'] = TRUE;
        $controller_config['disable_news_type'] = TRUE;
        $controller_config['disable_news_save_draft'] = TRUE;
        $controller_config['disable_news_published_at'] = TRUE;
        $controller_config['disable_news_created_at'] = TRUE;
        $controller_config['disable_status_add'] = true;
        $controller_config['disable_bio_description_img'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/status/all', 'refresh');
    }

    public function all()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        $filter=array();
        $this->form_validation->set_rules('filterNewsTitle', 'filterNewsTitle', 'trim');
        if ($this->form_validation->run() === true) {
            // echo"workgin";exit;
            $title= $this->input->post('filterNewsTitle');
            $filterNewsPublishedAt= $this->input->post('filterNewsPublishedAt');
            if ($this->input->post('filterNewsTitle') != '') {
                $filter['title'] = $title;
            }
           
        }
        $status=$this->status_model->get_all($filter);
        // echo"<pre>";print_r($status);exit;
        $this->data['status']= $status;
        $this->data['active_menu'] = 'status';
        $this->data['site_content'] = 'status';
        $this->load->view('panel/content', $this->data);
    }
    public function add()
    {
        $this->form_validation->set_rules('statusTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('statusSlugTitle', 'slug title', 'trim|required|is_unique[article.title_slug]');
        $this->form_validation->set_rules('statusCounter', 'counter', 'trim');


        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('statusTitle');
            $input_data['slug_title'] = $this->input->post('statusSlugTitle');
            $input_data['count'] = $this->input->post('statusCounter');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            
            if ($no_error == TRUE) {
                // echo "<pre>";print_r("workgin");exit;
                $status_id = $this->status_model->add($input_data);
                if ($status_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/status/all', 'refresh');
            }
        }

        $this->data['active_menu'] = 'status';
        $this->data['site_content'] = 'add_status';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        $status = $this->status_model->get($id);
        if (!$status) {
            redirect('panel/status/all', 'refresh');
        }
    
        $this->form_validation->set_rules('statusTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('statusCounter', 'counter', 'trim');
    
        if ($this->form_validation->run() === TRUE) {
    
            $input_data = array();
            $no_error = TRUE;
    
            $input_data['title'] = $this->input->post('statusTitle');
            $input_data['slug_title'] = $this->input->post('statusSlugTitle');
            $input_data['count'] = $this->input->post('statusCounter');
            $input_data['updated_at'] = time();
            $input_data['updated_by'] = $_SESSION['user_id'];
    
            // ✅ IMAGE UPLOAD START
            $config['upload_path'] = './assets/uploads/status/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
    
            if (!empty($_FILES['bioDescImg']['name'])) {
    
                $file_info = array(
                    'field_name' => 'bioDescImg',
                    'file' => $_FILES['bioDescImg']
                );
    
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
    
                if (!$upload_result['error']) {
    
                    $file_name = $upload_result['file_name'];
    
                    // ✅ DELETE OLD IMAGE
                    if (!empty($status->image)) {
                        if (file_exists('./assets/uploads/status/' . $status->image)) {
                            unlink('./assets/uploads/status/' . $status->image);
                        }
                        if (file_exists('./assets/uploads/status/thumb_' . $status->image)) {
                            unlink('./assets/uploads/status/thumb_' . $status->image);
                        }
                    }
    
                    $input_data['image'] = $file_name;
    
                } else {
                    $this->data['bioDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            // ✅ IMAGE UPLOAD END
    
            // ✅ SAVE DATA
            if ($no_error == TRUE) {
                $this->status_model->add($input_data, $status->id);
    
                $this->session->set_flashdata('success', 'Updated successfully.');
                redirect('panel/status/all', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Image upload failed.');
            }
        }
    
        $this->data['status'] = $status;
        $this->data['active_menu'] = 'status';
        $this->data['site_content'] = 'edit_status';
        $this->data['bioDescImgError'] = '';
    
        $this->load->view('panel/content', $this->data);
    }
    public function delete_cover_img($id)
    {
        if ($id > 0) {
            $status = $this->status_model->get($id);
            if ($status && !empty($status->image)) {
                if (file_exists('./assets/uploads/status/' . $status->image)) {
                    unlink('./assets/uploads/status/' . $status->image);
                }
                if (file_exists('./assets/uploads/status/thumb_' . $status->image)) {
                    unlink('./assets/uploads/status/thumb_' . $status->image);
                }
                $this->status_model->add(['image' => ''], $id);
                $this->session->set_flashdata('success', 'Image deleted successfully.');
            }
        }
        redirect('panel/status/edit/' . $id);
    }
}
