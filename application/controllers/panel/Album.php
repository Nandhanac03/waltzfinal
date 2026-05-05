<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Album extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Album_model', 'album_model');
        $this->load->model('File_model', 'file_model');
        $this->load->model('File_description_model', 'file_description_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_album_add'] = true;
        $controller_config['disable_album_delete'] = true;
        $controller_config['disable_album_file_edit'] = FALSE;
        $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_album_file_subtitle'] = false;
        $controller_config['disable_album_file_short_desc'] = false;
        $controller_config['disable_album_file_languages'] = FALSE;
        $controller_config['disable_album_file_browse'] = FALSE;
        $controller_config['disable_album_file_button_name'] = TRUE;
        $controller_config['disable_album_file_link'] = TRUE;
        $controller_config['disable_album_file_desc'] = false;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/album/all', 'refresh');
    }

    public function all()
    {
        $albums = $this->album_model->get_all();
        $this->data['albums'] = $albums;
        $this->data['active_menu'] = 'album';
        $this->data['site_content'] = 'album';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        //add album
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/album/all', 'refresh');
        }
        $this->form_validation->set_rules('albumTitle', 'Title', 'trim|required|is_unique[album.title]');
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['title'] = $this->input->post('albumTitle');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $album_id = $this->album_model->add($input_data);
            $config = array();
            $config['upload_path'] = 'assets/uploads/album';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if ($album_id > 0 && !empty($_FILES['albumFile']['name'][0])) {
                $file_count = count($_FILES['albumFile']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $_FILES['albumImgFile']['name'] = &$_FILES['albumFile']['name'][$i];
                    $_FILES['albumImgFile']['type'] = &$_FILES['albumFile']['type'][$i];
                    $_FILES['albumImgFile']['tmp_name'] = &$_FILES['albumFile']['tmp_name'][$i];
                    $_FILES['albumImgFile']['error'] = &$_FILES['albumFile']['error'][$i];
                    $_FILES['albumImgFile']['size'] = &$_FILES['albumFile']['size'][$i];
                    $file_info = array('field_name' => 'albumImgFile', 'file' => &$_FILES['albumImgFile']);
                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data = array();
                        $input_data['parent_id'] = $album_id;
                        $input_data['file'] = $file_name;
                        $input_data['file_for'] = "A";
                        $input_data['file_type'] = "I";
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        if ($album_id == 2) {
                            $max_order = $this->file_model->get_max_order($album_id, $lang);
                            $input_data['order'] = $max_order + 1;
                        }
                        $file_id = $this->file_model->add($input_data);
                        if ($file_id > 0) {
                            $this->album_model->set_album_cover($album_id, $file_name);
                            $input_data = array();
                            $input_data['title'] = '';
                            $input_data['file_id'] = $file_id;
                            $input_data['language'] = $lang;
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $this->file_description_model->add($input_data);
                        } else {
                            $no_error = FALSE;
                        }
                    }
                }
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Album created successfully.');
                redirect('panel/album/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'album';
        $this->data['site_content'] = 'add_album';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {

        if($id == 3){
            // $controller_config['disable_album_file_edit'] = FALSE;
            $this->data['controller_config']['disable_album_file_edit'] = false;
        }

        //add album
        $album = $this->album_model->get($id);
        $current_language = $this->language_model->get_language($lang);
        // $album_files = $this->file_model->get_all($id, $lang, 'I', 'A');
        $album_files = $this->file_model->get_all_by_giri($id, $lang, 'I', 'A');
        // echo"<pre>";print_r($album_files);exit;
        if (!$current_language || !$album || $id < 0) {
            redirect('panel/album/all', 'refresh');
        }
        if ($this->input->post('albumTitle') != $album->title) {
            $this->form_validation->set_rules('albumTitle', 'Title', 'trim|required|is_unique[album.title]');
        } else {
            $this->form_validation->set_rules('albumTitle', 'Title', 'trim|required');
        }
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            if ($this->input->post('albumTitle') != $album->title) {
                $input_data['title'] = $this->input->post('albumTitle');
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                $this->album_model->add($input_data, $id);
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/album';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if ($id > 0 && !empty($_FILES['albumFile']['name'][0])) {
                $file_count = count($_FILES['albumFile']['name']);
                // echo $file_count;exit;
                for ($i = 0; $i < $file_count; $i++) {
                    $x=$i;
                    $_FILES['albumImgFile']['name'] = &$_FILES['albumFile']['name'][$i];
                    $_FILES['albumImgFile']['type'] = &$_FILES['albumFile']['type'][$i];
                    $_FILES['albumImgFile']['tmp_name'] = &$_FILES['albumFile']['tmp_name'][$i];
                    $_FILES['albumImgFile']['error'] = &$_FILES['albumFile']['error'][$i];
                    $_FILES['albumImgFile']['size'] = &$_FILES['albumFile']['size'][$i];
                    $file_info = array('field_name' => 'albumImgFile', 'file' => &$_FILES['albumImgFile']);
                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data = array();
                        $input_data['parent_id'] = $id;
                        $input_data['file'] = $file_name;
                        $input_data['file_for'] = "A";
                        $input_data['file_type'] = "I";
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        if ($id == 2) {
                            $max_order = $this->file_model->get_max_order($id, $lang);
                            $input_data['order'] = $max_order + 1;
                        }
                        $file_id = $this->file_model->add($input_data);
                        if ($file_id > 0) {
                            // echo"wprl";exit;
                            $this->album_model->set_album_cover($id, $file_name);
                            $input_data = array();
                            $input_data['title'] = '';
                            $input_data['file_id'] = $file_id;
                            $input_data['language'] = $lang;
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $this->file_description_model->add($input_data);
                        } else {
                            // echo"failed";exit;
                            $no_error = FALSE;
                        }
                    }
                }
            } else {
                $no_error = FALSE;
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Album created successfully.');
                redirect('panel/album/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['album'] = $album;
        $this->data['album_files'] = $album_files;
        $this->data['active_menu'] = 'album';
        $this->data['site_content'] = 'edit_album';
        $this->load->view('panel/content', $this->data);
    }

    public function edit_file($album_id, $id, $lang = 1)
    {
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_album_file_browse'] = TRUE;
        }
        $album = $this->album_model->get($album_id);
       
        $current_language = $this->language_model->get_language($lang);
        $album_parent_file = $this->file_model->get_file($id, $album_id, 'I', 'A', true, 1);
        $album_file = $this->file_model->get_file($id, $album_id, 'I', 'A', true, $lang);
        if (!$album_file && $this->data['controller_config']['disable_album_file_browse']) {
            $album_file = $album_parent_file;
        }
        if($album_id!=2){
            $this->data['controller_config']['disable_album_file_desc'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        if (!$current_language || !$album_parent_file || !$album || $id < 0) {
            redirect('panel/album/all', 'refresh');
        }
        $file_desc_languages = $this->file_description_model->get_languages($id);
        $album_file_desc = $this->file_description_model->get_file_description('', $id, $lang);
        $this->form_validation->set_rules('fileTitle', 'Title', 'trim');
        $this->form_validation->set_rules('fileSubtitle', 'Subtitle', 'trim');
        $this->form_validation->set_rules('fileShortDesc', 'Short Description', 'trim');
        $this->form_validation->set_rules('fileDescription', 'Description', 'trim');
        $this->form_validation->set_rules('fileLink', 'Link', 'trim');
        $this->form_validation->set_rules('fileButtonName', 'Button Name', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['file_id'] = $album_file->id;
            $input_data['title'] = $this->input->post('fileTitle');
            $input_data['subtitle'] = $this->input->post('fileSubtitle');
            $input_data['short_desc'] = $this->input->post('fileShortDesc');
            $input_data['description'] = $this->input->post('fileDescription');
            $input_data['link'] = $this->input->post('fileLink');
            $input_data['button_name'] = $this->input->post('fileButtonName');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            if ($album_file_desc) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->file_description_model->update($input_data, $album_file_desc->id);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->file_description_model->add($input_data);
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/album';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['fileAlbum']) && $_FILES['fileAlbum']['error'] == 0) {
                $file_info = array('field_name' => 'fileAlbum', 'file' => &$_FILES['fileAlbum']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['file'] = $file_name;
                    $input_data['language'] = $lang;
                    if ($lang != 1) {
                        $input_data['language_parent'] = $album_parent_file->id;
                    }
                    if (file_exists('./assets/uploads/album/' . $album_file->file) && !empty($album_file->file)) {
                        unlink('./assets/uploads/album/' . $album_file->file);
                        unlink('./assets/uploads/album/thumb_' . $album_file->file);
                    }
                    if ($album_file) {
                        $this->file_model->update($input_data, $album_file->id);
                    } else {
                        $input_data['parent_id'] = $album_id;
                        $input_data['file_for'] = "A";
                        $input_data['file_type'] = "I";
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->file_model->add($input_data);
                    }
                } else {
                    $this->data['fileAlbumError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            if ($album_id == 2) {
                $new_order = $this->input->post('fileOrder');
                $old_order = $album_file->order;

                if ($new_order != $old_order) {
                    $swapping_file = $this->file_model->get_file_by_order($album_id, $new_order, $lang);
                    if ($swapping_file) {
                        $this->file_model->update(['order' => $old_order], $swapping_file->id);
                    }
                    $this->file_model->update(['order' => $new_order], $album_file->id);
                }
            }

            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/album/edit_file/' . $album->id . '/' . $album_file->id . '/' . $current_language->id, 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['file_desc_languages'] = explode(',', $file_desc_languages->languages);
        $this->data['album_file_desc'] = $album_file_desc;
        $this->data['album'] = $album;
        $this->data['languages'] = $languages;
        $this->data['album_parent_file'] = $album_parent_file;
        $this->data['album_file'] = $album_file;
        if ($album_id == 2) {
            $this->data['total_files'] = count($this->file_model->get_all($album_id, $lang, 'I', 'A'));
        }
        $this->data['active_menu'] = 'album';
        $this->data['site_content'] = 'edit_file';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_file($album_id, $id)
    {
        if ($id > 0 && $album_id > 0) {
            $album = $this->album_model->get($id);
            $album_file = $this->file_model->get_file($id, $album_id, 'I', 'A');
            if ($album_file) {
                $this->file_model->delete_file($id, $album_id, 'I', 'A');
                $this->file_description_model->delete_file_description($id);
                if (file_exists('./assets/uploads/album/' . $album_file->file) && !empty($album_file->file)) {
                    unlink('./assets/uploads/album/' . $album_file->file);
                    unlink('./assets/uploads/album/thumb_' . $album_file->file);
                }
                $album_cover_file = $this->file_model->get_file('', $album_id, 'I', 'A');
                if ($album_cover_file) {
                    $this->album_model->set_album_cover($album_id, $album_cover_file->file);
                }
            }
        }
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/album/edit/' . $album_id, 'refresh');
    }

    public function delete($id)
    {
        if ($id > 0) {
            $album = $this->album_model->get($id);
            if ($album) {
                $this->album_model->delete_album($id);
                $album_files = $this->file_model->get_all($id, '', 'I', 'A');
                if ($album_files) {
                    foreach ($album_files as $album_file) {
                        $this->file_model->delete_file($id, $album_file->parent_id, 'I', 'A');
                        $this->file_description_model->delete_file_description($album_file->id);
                        if (file_exists('./assets/uploads/album/' . $album_file->file) && !empty($album_file->file)) {
                            unlink('./assets/uploads/album/' . $album_file->file);
                            unlink('./assets/uploads/album/thumb_' . $album_file->file);
                        }
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Album deleted successfully.');
        redirect('panel/album/all', 'refresh');
    }
}
