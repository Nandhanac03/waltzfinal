<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Page_file_model', 'page_file_model');
        $this->load->model('Page_file_description_model', 'page_file_description_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables 
        $this->data['pageDescImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_page_menu'] = FALSE;
        $controller_config['disable_page_add'] = true;
        $controller_config['disable_page_list'] = false;
        $controller_config['disable_page_delete'] = FALSE;
        $controller_config['disable_page_subtitle'] = FALSE;
        $controller_config['disable_page_short_desc'] = FALSE;
        $controller_config['disable_page_seo'] = true;
        $controller_config['disable_page_languages'] = FALSE;
        $controller_config['disable_page_description'] = false;
        $controller_config['disable_page_description_img'] = false;
        $controller_config['disable_page_status'] = FALSE;
        $controller_config['disable_pr_document'] = FALSE;

        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        $this->data['menus'] = $this->menu_model->get_all();
        $this->data['pages'] = $this->page_model->get_all();
        $this->data['active_menu'] = 'page';
        $this->data['site_content'] = 'list_pages';
        $this->load->view('panel/content', $this->data);
    }

    public function all()
    {
        //Pages list view
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        $menus = $this->menu_model->get_all();
        $filter = array();
        $this->form_validation->set_rules('filterPageMenu', 'menu', 'trim');
        $this->form_validation->set_rules('filterPageCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterPageTitle', 'title', 'trim');
        $filter['language'] = 1;
        $filter['active'] = 1;
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('filterPageTitle');
            $filter['menu'] = $this->input->post('filterPageMenu');
            if ($this->input->post('filterPageCreatedAt') != '') {
                $filterPageCreatedAt = explode('-', $this->input->post('filterPageCreatedAt'));
                if (!empty($filterPageCreatedAt[0])) {
                    $filterPageCreatedAt[0] = str_replace('/', '-', $filterPageCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterPageCreatedAt[0]);
                }
                if (!empty($filterPageCreatedAt[1])) {
                    $filterPageCreatedAt[1] = str_replace('/', '-', $filterPageCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterPageCreatedAt[1]);
                }
            }
        }
        $this->data['pages'] = $this->page_model->get_all_for_panel($filter);

        if ($menus) {
            $menu_array =   [];
            foreach ($menus as $menu_rec) {
                $menu_array[$menu_rec->id]  =   $menu_rec->title;
            }
        }
        $this->data['menus'] = $menus;
        $this->data['menu_array'] = $menu_array;
        //echo '<pre>'; print_r($this->data['menus']); exit;
        $this->data['active_menu'] = 'page';
        $this->data['site_content'] = 'pages';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        // echo '<pre>';
        // print_r($_POST);
        // exit;
        //add page
        $current_language = $this->language_model->get_language($lang);
        $menus = $this->menu_model->get_all();
        if ($this->data['controller_config']['disable_page_menu'] != TRUE)
            $this->form_validation->set_rules('pageMenu', 'menu', 'trim|required');
        $this->form_validation->set_rules('pageTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('pageSlugTitle', 'slug title', 'trim|required|is_unique[pages.title_slug]');
        $this->form_validation->set_rules('pageSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('pageShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('pageDescription', 'description', 'trim');
        $this->form_validation->set_rules('pageSeoTitle', 'Title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('pageSeoMetaKeywords', 'Meta Keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('pageSeoMetaDescription', 'Meta Description', 'trim|min_length[3]|max_length[160]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            
            $input_data['menu'] = $this->input->post('pageMenu');
            $input_data['title'] = $this->input->post('pageTitle');
            $input_data['title_slug'] = $this->input->post('pageSlugTitle');
            $input_data['subtitle'] = $this->input->post('pageSubtitle');
            $input_data['short_desc'] = $this->input->post('pageShortDesc');
            $input_data['description'] = $this->input->post('pageDescription');
            $input_data['seo_title'] = $this->input->post('pageSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('pageSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('pageSeoMetaDescription');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = 1;
            $input_data['active'] = 1;
            //    echo"<pre>";print_r($input_data);exit;
            $config = array();
            $config['upload_path'] = 'assets/uploads/page';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageBannerImg']) && $_FILES['pageBannerImg']['error'] == 0) {
                $file_info = array('field_name' => 'pageBannerImg', 'file' => &$_FILES['pageBannerImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['banner_img'] = $file_name;
                } else {
                    $this->data['pageBannerImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
           
            $config = array();
            $config['upload_path'] = 'assets/uploads/page';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageDescImg']) && $_FILES['pageDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'pageDescImg', 'file' => &$_FILES['pageDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['pageDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            
            // if($_FILES){
            //     echo"<pre>";print_r($_FILES);exit;
            // }
            $config = array();
            $config['upload_path'] = 'assets/uploads/page';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageDescBrandImg']) && $_FILES['pageDescBrandImg']['error'] == 0) {
                $file_info = array('field_name' => 'pageDescBrandImg', 'file' => &$_FILES['pageDescBrandImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['brand_desc_img'] = $file_name;
                } else {
                    $this->data['pageDescBrandImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

          
            

            // echo"working2";exit;
            if ($no_error == TRUE) {

                // echo "working1";
                // exit;
                $page_id = $this->page_model->add($input_data);

                //upload document files
                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');

                if (!empty($_FILES['pageDocumentFile']['name'][0])) {

                    $file_count = count($_FILES['pageDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['pageDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['pageDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['pageDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['pageDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['pageDocumentFile']['size'][$i];
                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);
                        // echo '<pre>';print_r( $upload_result);exit;
                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array();
                            $input_data['page_id'] = $page_id;
                            $input_data['file'] = $file_name;
                            $input_data['file_for'] = "O";
                            $input_data['file_type'] = "O";
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $file_id = $this->page_file_model->add($input_data);
                            // echo '<pre>';print_r( $input_data);exit;
                            if ($file_id > 0) {
                                $input_data = array();
                                $input_data['title'] = 'Document';
                                $input_data['file_id'] = $file_id;
                                $input_data['language'] = $lang;
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $this->page_file_description_model->add($input_data);
                            }
                        }
                    }
                }


                if ($page_id <= 0) {
                    $no_error = FALSE;
                }
            }
            

            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/page/all', 'refresh');
            }
        }
        $this->data['menus'] = $menus;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'page';
        $this->data['site_content'] = 'add_page';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = '1')
    {

        //edit page based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_page = $this->page_model->get_for_panel($id);
            $page = $parent_page;
        } else if ($id > 0 && $lang > 0) {
            $parent_page = $this->page_model->get_for_panel($id);
            if ($parent_page) {
                $language_parent = $id;
                $page = $this->page_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/page/', 'refresh');
        }
        //echo '<pre>'; print_r($page); exit;
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_page_description_img'] = TRUE;
            $this->data['controller_config']['disable_page_seo'] = TRUE;
            $this->data['controller_config']['disable_page_menu'] = TRUE;
        }

        $menus = $this->menu_model->get_all();
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_page || !$current_language) {
            redirect('panel/page/', 'refresh');
        }


        $page_documents = $this->page_file_model->get_file_based_page($id,true);

        // echo '<pre>';print_r($page_documents);exit;
       

        $filter = array();
        $filter['status'] = 1;
        $filter['for_news'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $page_languages = $this->page_model->get_languages($id);
        if ($this->data['controller_config']['disable_page_menu'] != TRUE)
            $this->form_validation->set_rules('pageMenu', 'Menu', 'trim|required');
        $this->form_validation->set_rules('pageTitle', 'Title', 'trim|required');
        if (!$page || empty($page->title_slug) || $page->title_slug != $this->input->post('pageSlugTitle')) {
            //$this->form_validation->set_rules('pageSlugTitle', 'Slugtitle', 'trim|required|is_unique[pages.title_slug]');
        }
        $this->form_validation->set_rules('pageSlugTitle', 'Slugtitle', 'trim|required');
        $this->form_validation->set_rules('pageSubtitle', 'Subtitle', 'trim');
        $this->form_validation->set_rules('pageShortDesc', 'Short Description', 'trim');
        $this->form_validation->set_rules('pageDescription', ' Description', 'trim');
        $this->form_validation->set_rules('pageSeoTitle', 'Title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('pageSeoMetaKeywords', 'Meta Keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('pageSeoMetaDescription', 'Meta Description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('pageStatus', 'pageStatus', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('pageTitle');
            $input_data['title_slug'] = $this->input->post('pageSlugTitle');
            $input_data['subtitle'] = $this->input->post('pageSubtitle');
            $input_data['short_desc'] = $this->input->post('pageShortDesc');
            $input_data['description'] = $this->input->post('pageDescription');
            $input_data['menu'] = $this->input->post('pageMenu');
            $input_data['seo_title'] = $this->input->post('pageSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('pageSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('pageSeoMetaDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = $this->input->post('pageStatus');
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/page';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 500;
            // $config['max_width']=680;
            // $config['max_height']=780;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageDescImg']) && $_FILES['pageDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'pageDescImg', 'file' => &$_FILES['pageDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/page/' . $page->desc_img) && !empty($page->desc_img)) {
                        unlink('./assets/uploads/page/' . $page->desc_img);
                        unlink('./assets/uploads/page/thumb_' . $page->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['pageDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/page';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 50;
            // $config['max_width']=370;
            // $config['max_height']=228;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageDescBrandImg']) && $_FILES['pageDescBrandImg']['error'] == 0) {
                $file_info = array('field_name' => 'pageDescBrandImg', 'file' => &$_FILES['pageDescBrandImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['brand_desc_img'] = $file_name;
                } else {
                    $this->data['pageDescBrandImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            //upload document files
            $config = array();
            $config['upload_path'] = 'assets/uploads/document';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['pageDocumentFile']['name'][0])) {
                $file_count = count($_FILES['pageDocumentFile']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $_FILES['documentFile']['name'] = &$_FILES['pageDocumentFile']['name'][$i];
                    $_FILES['documentFile']['type'] = &$_FILES['pageDocumentFile']['type'][$i];
                    $_FILES['documentFile']['tmp_name'] = &$_FILES['pageDocumentFile']['tmp_name'][$i];
                    $_FILES['documentFile']['error'] = &$_FILES['pageDocumentFile']['error'][$i];
                    $_FILES['documentFile']['size'] = &$_FILES['pageDocumentFile']['size'][$i];
                    $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                    $upload_result = file_upload($file_info, $config);
                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data = array();
                        $input_data['page_id'] = $id;
                        $input_data['file'] = $file_name;
                        $input_data['file_for'] = "O";
                        $input_data['file_type'] = "O";
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $file_id = $this->page_file_model->add($input_data);
                        if ($file_id > 0) {
                            $input_data = array();
                            $input_data['title'] = 'Document';
                            $input_data['file_id'] = $file_id;
                            $input_data['language'] = $lang;
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $this->page_file_description_model->add($input_data);
                        }
                    } else {
                        echo $upload_result['error_msg'];
                        exit;
                    }
                }
            }


            if ($no_error == TRUE) {
                if ($page) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->page_model->add($input_data, $page->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->page_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/page/', 'refresh');
            }
        }
        $this->data['page_languages'] = explode(',', $page_languages->languages);
        $this->data['page'] = $page;
        $this->data['page_documents'] = $page_documents;

        $this->data['menus'] = $menus;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'page';
        $this->data['site_content'] = 'edit_page';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_desc_img($id, $lang = '1')
    {
        //edit page based on language
        if ($id > 0 && $lang == '1') {
            $page = $this->page_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $page = $this->page_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/page/all', 'refresh');
        }
        if (file_exists('./assets/uploads/page/' . $page->desc_img) && !empty($page->desc_img)) {
            unlink('./assets/uploads/page/' . $page->desc_img);
            unlink('./assets/uploads/page/thumb_' . $page->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->page_model->add($input_data, $page->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/page/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete_brand_desc_img($id, $lang = '1')
    {
        //edit page based on language
        if ($id > 0 && $lang == '1') {
            $page = $this->page_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $page = $this->page_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/page/all', 'refresh');
        }
        if (file_exists('./assets/uploads/page/' . $page->brand_desc_img) && !empty($page->brand_desc_img)) {
            unlink('./assets/uploads/page/' . $page->brand_desc_img);
            unlink('./assets/uploads/page/thumb_' . $page->brand_desc_img);
        }
        $input_data['brand_desc_img'] = '';
        $this->page_model->add($input_data, $page->id);
        $this->session->set_flashdata('success', 'Brand Image deleted successfully.');
        redirect('panel/page/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete($id, $lang = '1')
    {
        if ($id > 0) {
            $this->page_model->disable($id);
        }
        $this->session->set_flashdata('success', 'Page deleted successfully.');
        redirect('panel/page/all', 'refresh');
    }
    public function delete_page_document($id, $file_id, $lang = 1)
    {
        // echo 'inside';
        // exit;
        $filter = array();
        $filter['file_id'] = $file_id;
        $filter['page_id'] = $id;
        $file_info = $this->page_file_model->get_file($filter);
        if ($file_info) {
            if ($file_info->file_type == 'O') {
                if (file_exists('./assets/uploads/document/' . $file_info->file) && !empty($file_info->file)) {
                    unlink('./assets/uploads/document/' . $file_info->file);
                }
            }
            $this->page_file_model->delete_file($file_id);
            $this->page_file_description_model->delete_file_description($file_id, $lang);
            $this->session->set_flashdata('success', 'Document deleted successfully.');
        }
        redirect('panel/page/edit/' . $id . '/' . $lang, 'refresh');
    }
}
