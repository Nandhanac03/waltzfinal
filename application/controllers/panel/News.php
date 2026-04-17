<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CO_Panel_Controller
{

    function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Newsroom_model', 'newsroom_model');
        $this->load->model('News_model', 'news_model');
        $this->load->model('News_file_model', 'news_file_model');
        $this->load->model('News_file_description_model', 'news_file_description_model');
        $this->load->model('Language_model', 'language_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['newsCoverImgError'] = '';

        //configuration
        $controller_config = array();

        $controller_config['disable_news_add'] = FALSE;
        $controller_config['disable_news_subtitle'] = false;
        $controller_config['disable_news_location'] = TRUE;
        $controller_config['disable_news_published_at'] = false;
        $controller_config['disable_news_save_draft'] = TRUE;
        $controller_config['disable_news_link'] = true;
        $controller_config['disable_news_short_desc'] = false;

        $controller_config['disable_news_type'] = TRUE;
        $controller_config['disable_news_contact'] = TRUE;
        $controller_config['disable_news_featured_images'] = TRUE;
        $controller_config['disable_news_multimedia_images'] = TRUE;
        $controller_config['disable_news_video_link'] = TRUE;
        $controller_config['disable_news_cover_image'] = TRUE;
        $controller_config['disable_news_brand_image'] = TRUE;
        $controller_config['disable_news_seo'] = TRUE;
        $controller_config['disable_news_save_publish'] = TRUE;
        $controller_config['disable_news_languages'] = TRUE;
        $controller_config['disable_news_status'] = false;
        $controller_config['disable_news_created_at'] = TRUE;
        $this->data['controller_config'] = $controller_config;
        $this->data['cover_img_note']="Recommended image dimension 1000 x 700px. Supports jpg, jpeg and png.";
        $this->data['secondary_img_note']="Recommended image dimension 1000 x 700px. Supports jpg, jpeg and png.";

    }

    public function index()
    {
        redirect('panel/news/all');
    }

    public function all()
    {
        //news list view
        $filter = array();
        $filter['status'] = 1;
        $filter['for_news'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $this->form_validation->set_rules('filterNewsType', 'type', 'trim');
        $this->form_validation->set_rules('filterNewsStatus', 'status', 'trim');
        $this->form_validation->set_rules('filterNewsPublishedAt', 'published at', 'trim');
        $this->form_validation->set_rules('filterNewsCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterNewsTitle', 'title', 'trim');
        // if($_POST){
        // }
        //filter the result based on search
        $filter = array();
        $filter['language_id'] = 1;
        if ($this->form_validation->run() === TRUE) {
            $filter['news_room_type'] = $this->input->post('filterNewsType');
            $filter['news_status'] = $this->input->post('filterNewsStatus');
            $filter['news_title'] = $this->input->post('filterNewsTitle');
            if ($this->input->post('filterNewsPublishedAt') != '') {
                $filterNewsPublishedAt = explode('-', $this->input->post('filterNewsPublishedAt'));
                if (!empty($filterNewsPublishedAt[0])) {
                    $filterNewsPublishedAt[0] = str_replace('/', '-', $filterNewsPublishedAt[0]);
                    $filter['from_published_at'] = strtotime($filterNewsPublishedAt[0]);
                }
                if (!empty($filterNewsPublishedAt[1])) {
                    $filterNewsPublishedAt[1] = str_replace('/', '-', $filterNewsPublishedAt[1]);
                    $filter['to_published_at'] = strtotime($filterNewsPublishedAt[1]);
                }
            }
            if ($this->input->post('filterNewsCreatedAt') != '') {
                $filterNewsCreatedAt = explode('-', $this->input->post('$filterNewsCreatedAt'));
                if (!empty($filterNewsCreatedAt[0])) {
                    $filterNewsCreatedAt[0] = str_replace('/', '-', $filterNewsCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterNewsCreatedAt[0]);
                }
                if (!empty($filterNewsCreatedAt[1])) {
                    $filterNewsCreatedAt[1] = str_replace('/', '-', $filterNewsCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterNewsCreatedAt[1]);
                }
            }
            // echo("workgin");exit;
        }
        $this->data['all_news'] = $this->news_model->get_all_news($filter);
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'news';
        $this->data['site_content'] = 'news';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        //add news
        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_news'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $this->form_validation->set_rules('newsType', 'type', 'trim|required');
        $this->form_validation->set_rules('newsTitle', 'title', 'trim|required');
        $this->form_validation->set_rules('newsSlugTitle', 'slug title', 'trim|required|is_unique[news.title_slug]');
        $this->form_validation->set_rules('newsSubtitle', 'description', 'trim|max_length[1000]');
        $this->form_validation->set_rules('newsShortDesc', 'job description link', 'trim|max_length[100]');
        $this->form_validation->set_rules('newsLocation', 'location', 'trim');
        $this->form_validation->set_rules('newsLink', 'link', 'trim');
        if ($this->data['controller_config']['disable_news_published_at'] != TRUE)
            $this->form_validation->set_rules('newsPublishedAt', 'published at', 'trim|required');
        $this->form_validation->set_rules('newsDescription', 'description', 'trim|required');
        // $this->form_validation->set_rules('newsContact', 'contact', 'trim');
        $this->form_validation->set_rules('newsSeoTitle', 'Title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('newsSeoMetaKeywords', 'Meta Keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('newsSeoMetaDescription', 'Meta Description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('newsStatus', 'status', 'trim');
        // echo "<pre>"; print_r(form_error()); echo "</pre>";
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data1 = array();
            $input_data1['type'] = $this->input->post('newsType');
            $input_data1['active'] = 1;
            $newsroom_id = $this->newsroom_model->add($input_data1);
            if ($newsroom_id > 0) {
                $input_data2 = array();
                $input_data2['newsroom'] = $newsroom_id;
                $input_data2['title'] = $this->input->post('newsTitle');
                $input_data2['title_slug'] = $this->input->post('newsSlugTitle');
                $input_data2['subtitle'] = $this->input->post('newsSubtitle');
                $input_data2['short_desc'] = $this->input->post('newsShortDesc');
                $input_data2['description'] = $this->input->post('newsDescription');
                $input_data2['location'] = $this->input->post('newsLocation');
                $input_data2['link'] = $this->input->post('newsLink');
                $input_data2['contact'] = $this->input->post('newsContact');
                $input_data2['seo_title'] = $this->input->post('newsSeoTitle');
                $input_data2['seo_meta_keywords'] = $this->input->post('newsSeoMetaKeywords');
                $input_data2['seo_meta_description'] = $this->input->post('newsSeoMetaDescription');
                $tmp_published_at = str_replace('/', '-', $this->input->post('newsPublishedAt'));
                $input_data2['published_at'] = strtotime($tmp_published_at);
                $input_data2['status'] = $this->input->post('newsStatus');
                $input_data2['created_at'] = time();
                $input_data2['created_by'] = $_SESSION['user_id'];
                $input_data2['language'] = $lang;
                $input_data2['active'] = 1;
                $config = array();
                $config['upload_path'] = 'assets/uploads/news';
                $config['allowed_types'] = 'png|jpeg|jpg';
                $config['encrypt_name'] = TRUE;
                // $config['max_size'] = 500;
                // $config['max_width'] = 1024;
                // $config['max_height'] = 769;
                if (!empty($_FILES['newsCoverImg']) && $_FILES['newsCoverImg']['error'] == 0) {
                    $file_info = array('field_name' => 'newsCoverImg', 'file' => &$_FILES['newsCoverImg']);
                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data2['news_cover'] = $file_name;
                    } else {
                        $this->data['newsCoverImgError'] = $upload_result['error_msg'];
                        $no_error = FALSE;
                    }
                }
                if (!empty($_FILES['newsBrandImg']) && $_FILES['newsBrandImg']['error'] == 0) {
                    $file_info = array('field_name' => 'newsBrandImg', 'file' => &$_FILES['newsBrandImg']);
                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                    if (!$upload_result['error']) {
                        $file_name = $upload_result['file_name'];
                        $input_data2['secondary_img'] = $file_name;
                    } else {
                        $this->data['newsBrandImgError'] = $upload_result['error_msg'];
                        $no_error = FALSE;
                    }
                }

                if ($no_error == true) {
                    $news_id = $this->news_model->add($input_data2);
                }
                if ($news_id > 0) {
                    $news_code = 'P' . date('y') . rand(0, 99) . $news_id;
                    $input_data = array();
                    $input_data['news_code'] = $news_code;
                    $this->news_model->update($input_data, $news_id);
                    //featured image upload
                    $file_count = $this->input->post('newsFeaturedFilesCount');
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/news';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['featuredFile_' . $i]) && $_FILES['featuredFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'featuredFile_' . $i, 'file' => &$_FILES['featuredFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['newsroom'] = $newsroom_id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "FI";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->news_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('featuredFileTitle_' . $i);
                                    $input_data['description'] = $this->input->post('featuredFileDesc_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['language'] = $lang;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->news_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
                    //multimedia image upload
                    if ($this->input->post('newsType') == 'M') {
                        $file_count = $this->input->post('newsMultimediaFilesCount');
                        if ($file_count > 0) {
                            $file_count = $this->input->post('newsMultimediaFilesCount');
                            $config = array();
                            $config['upload_path'] = 'assets/uploads/news';
                            $config['allowed_types'] = 'png|jpeg|jpg';
                            $config['encrypt_name'] = TRUE;
                            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                            for ($i = 1; $i <= $file_count; $i++) {
                                if (!empty($_FILES['multimediaFile_' . $i]) && $_FILES['multimediaFile_' . $i]['error'] == 0) {
                                    $file_info = array('field_name' => 'multimediaFile_' . $i, 'file' => &$_FILES['multimediaFile_' . $i]);
                                    $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                                    if (!$upload_result['error']) {
                                        $file_name = $upload_result['file_name'];
                                        $input_data = array();
                                        $input_data['newsroom'] = $newsroom_id;
                                        $input_data['file'] = $file_name;
                                        $input_data['file_for'] = "MI";
                                        $input_data['file_type'] = "I";
                                        $input_data['created_at'] = time();
                                        $input_data['created_by'] = $_SESSION['user_id'];
                                        $input_data['active'] = 1;
                                        $file_id = $this->news_file_model->add($input_data);
                                        if ($file_id > 0) {
                                            $input_data = array();
                                            $input_data['title'] = $this->input->post('multimediaFileTitle_' . $i);
                                            $input_data['file_id'] = $file_id;
                                            $input_data['language'] = $lang;
                                            $input_data['created_at'] = time();
                                            $input_data['created_by'] = $_SESSION['user_id'];
                                            $input_data['active'] = 1;
                                            $this->news_file_description_model->add($input_data);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //add press video link
                    if ($this->input->post('newsType') == 'PV') {
                        if (!empty($this->input->post('newsPressVideoLink'))) {
                            $input_data = array();
                            $input_data['newsroom'] = $newsroom_id;
                            $input_data['file'] = $this->input->post('newsPressVideoLink');
                            $input_data['file_for'] = "NV";
                            $input_data['file_type'] = "L";
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $this->news_file_model->add($input_data);
                        }
                    }
                } else {
                    $no_error = FALSE;
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
                // $news_status = $this->input->post('newsStatus') == 'P' ? 'Published' : 'Drafted';
                // $this->session->set_flashdata('success', 'News ' . $news_status . ' successfully.');
                $this->session->set_flashdata('success', 'Career added successfully.');
                redirect('panel/news/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'news';
        $this->data['site_content'] = 'add_news';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($newsroom_id, $lang = 1)
    {

        //edit news details
        $lang_en_news = $this->news_model->get_news_by_newsroom_for_panel($newsroom_id, 1);
        $news = $this->news_model->get_news_by_newsroom_for_panel($newsroom_id, $lang);
        $current_language = $this->language_model->get_language($lang);
        $newsroom = $this->newsroom_model->get_newsroom($newsroom_id);
        if (!$newsroom_id || empty($newsroom_id) || empty($lang_en_news) || empty($current_language) || empty($newsroom)) {
            redirect('panel/news/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_news_type'] = TRUE;

            $this->data['controller_config']['disable_news_contact'] = TRUE;
            $this->data['controller_config']['disable_news_featured_images'] = TRUE;
            $this->data['controller_config']['disable_news_multimedia_images'] = TRUE;
            $this->data['controller_config']['disable_news_video_link'] = TRUE;
            $this->data['controller_config']['disable_news_cover_image'] = TRUE;
            $this->data['controller_config']['disable_news_seo'] = TRUE;
            $this->data['controller_config']['disable_news_save_publish'] = TRUE;
            $this->data['controller_config']['disable_news_link'] = TRUE;

            // $this->data['controller_config']['disable_news_published_at'] = TRUE;
            // $this->data['controller_config']['disable_news_save_draft'] = TRUE;
            // $this->data['controller_config']['disable_news_location'] = TRUE;
        }
        $news_languages = $this->news_model->get_news_languages($newsroom_id);
        $multimedia_images = $this->news_file_model->get_files(array('newsroom' => $newsroom_id, 'file_for' => 'MI', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $featured_images = $this->news_file_model->get_files(array('newsroom' => $newsroom_id, 'file_for' => 'FI', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $news_video_link = $this->news_file_model->get_files(array('newsroom' => $newsroom_id, 'file_for' => 'NV', 'file_type' => 'L', 'active' => 1));
        if ($news_video_link) {
            $news_video_link = $news_video_link[0];
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_news'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $this->form_validation->set_rules('newsType', 'type', 'trim|required');
        $this->form_validation->set_rules('newsTitle', 'title', 'trim|required');
        if (!$news || empty($news->title_slug) || $news->title_slug != $this->input->post('newsSlugTitle')) {
            $this->form_validation->set_rules('newsSlugTitle', 'slug title', 'trim|required|is_unique[news.title_slug]');
        }
        $this->form_validation->set_rules('newsSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('newsShortDesc', 'short description', 'trim|max_length[100]');
        $this->form_validation->set_rules('newsLink', 'link', 'trim');
        $this->form_validation->set_rules('newsLocation', 'location', 'trim');
        $this->form_validation->set_rules('newsStatus', 'newsStatus', 'trim');
        if ($this->data['controller_config']['disable_news_published_at'] != TRUE)
            $this->form_validation->set_rules('newsPublishedAt', 'published at', 'trim|required');
        $this->form_validation->set_rules('newsDescription', 'description', 'trim|required');
        // $this->form_validation->set_rules('newsContact', 'contact', 'trim');
        $this->form_validation->set_rules('newsSeoTitle', 'Title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('newsSeoMetaKeywords', 'Meta Keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('newsSeoMetaDescription', 'Meta Description', 'trim|min_length[3]|max_length[160]');
        // if ($this->data['controller_config']['disable_news_save_draft'] != TRUE)
        //     $this->form_validation->set_rules('newsStatus', 'Status', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data1 = array();
            $input_data1['type'] = $this->input->post('newsType');
            $this->newsroom_model->update($input_data1, $newsroom_id);
            $input_data2 = array();
            $input_data2['newsroom'] = $newsroom_id;
            $input_data2['title'] = $this->input->post('newsTitle');
            $input_data2['title_slug'] = $this->input->post('newsSlugTitle');
            $input_data2['subtitle'] = $this->input->post('newsSubtitle');
            $input_data2['short_desc'] = $this->input->post('newsShortDesc');
            $input_data2['description'] = $this->input->post('newsDescription');
            $input_data2['link'] = $this->input->post('newsLink');
            $input_data2['location'] = $this->input->post('newsLocation');
            $input_data2['contact'] = $this->input->post('newsContact');
            $input_data2['language'] = $lang;
            $input_data2['seo_title'] = $this->input->post('newsSeoTitle');
            $input_data2['seo_meta_keywords'] = $this->input->post('newsSeoMetaKeywords');
            $input_data2['seo_meta_description'] = $this->input->post('newsSeoMetaDescription');
            $input_data2['active'] = $this->input->post('newsStatus');

            $tmp_published_at = str_replace('/', '-', $this->input->post('newsPublishedAt'));
            $input_data2['published_at'] = strtotime($tmp_published_at);
            $input_data2['status'] = $this->input->post('newsStatus');

            $config = array();
            $config['upload_path'] = 'assets/uploads/news';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 500;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 769;
            if (!empty($_FILES['newsCoverImg']) && $_FILES['newsCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'newsCoverImg', 'file' => &$_FILES['newsCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data2['news_cover'] = $file_name;
                    if (file_exists('./assets/uploads/news/' . $news->news_cover) && !empty($news->news_cover)) {
                        unlink('./assets/uploads/news/' . $news->news_cover);
                        unlink('./assets/uploads/news/thumb_' . $news->news_cover);
                    }
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if (!empty($_FILES['newsBrandImg']) && $_FILES['newsBrandImg']['error'] == 0) {
                $file_info = array('field_name' => 'newsBrandImg', 'file' => &$_FILES['newsBrandImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data2['secondary_img'] = $file_name;
                    if (file_exists('./assets/uploads/news/' . $news->secondary_img) && !empty($news->secondary_img)) {
                        unlink('./assets/uploads/news/' . $news->secondary_img);
                        unlink('./assets/uploads/news/thumb_' . $news->secondary_img);
                    }
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($news) {
                $input_data2['updated_at'] = time();
                $input_data2['updated_by'] = $_SESSION['user_id'];
                $this->news_model->update($input_data2, $news->id);
            } else {
                $input_data2['created_at'] = time();
                $input_data2['created_by'] = $_SESSION['user_id'];
                $this->news_model->add($input_data2);
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/news';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            //update press video link
            if (!$news_video_link && !empty($this->input->post('newsPressVideoLink'))) {
                $input_data3 = array();
                $input_data3['newsroom'] = $newsroom_id;
                $input_data3['file'] = $this->input->post('newsPressVideoLink');
                $input_data3['file_for'] = "NV";
                $input_data3['file_type'] = "L";
                $input_data3['created_at'] = time();
                $input_data3['created_by'] = $_SESSION['user_id'];
                $input_data3['active'] = 1;
                $file_id = $this->news_file_model->add($input_data3);
                if ($file_id == FALSE) {
                    $no_error = FALSE;
                }
            } else if (!empty($this->input->post('newsPressVideoLink')) && $this->input->post('newsPressVideoLink') != $news_video_link->file) {
                $input_data3 = array();
                $input_data3['newsroom'] = $newsroom_id;
                $input_data3['file'] = $this->input->post('newsPressVideoLink');
                $input_data3['file_for'] = "NV";
                $input_data3['file_type'] = "L";
                $input_data3['created_at'] = time();
                $input_data3['created_by'] = $_SESSION['user_id'];
                $input_data3['active'] = 1;
                $file_id = $this->news_file_model->update($input_data3, $news_video_link->id);
                if ($file_id == FALSE) {
                    $no_error = FALSE;
                }
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->db->trans_commit();
                // $news_status = $this->input->post('newsStatus') == 'P' ? 'Published' : 'Drafted';
                // $this->session->set_flashdata('success', 'News ' . $news_status . ' successfully.');
                $this->session->set_flashdata('success', 'Project saved successfully.');
                redirect('panel/news/all', 'refresh');
            }
        }
        $this->data['news_languages'] = explode(',', $news_languages->languages);
        $this->data['newsroom_id'] = $newsroom_id;
        $this->data['language_id'] = $lang;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['newsroom'] = $newsroom;
        $this->data['news'] = $news;
        $this->data['multimedia_images'] = $multimedia_images;
        $this->data['featured_images'] = $featured_images;
        $this->data['news_video_link'] = $news_video_link;
        $this->data['active_menu'] = 'news';
        $this->data['site_content'] = 'edit_news';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_multimedia_file_description($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax update multimedia file description
        if ((!empty($this->input->post('multimedia_file_id')) && $this->input->post('multimedia_file_id') > 0) && $newsroom_id > 0 && $lang > 0) {
            $file_id = $this->input->post('multimedia_file_id');
            $title = $this->input->post('multimediaFileTitle');
            $input_data = array();
            $input_data['title'] = $title;
            if ($this->news_file_description_model->get_news_file_description($file_id, $lang, $newsroom_id)) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                if ($this->news_file_description_model->update($input_data, $file_id)) {
                    echo TRUE;
                } else {
                    echo 'File title update failed.';
                }
            } else if (!empty($this->input->post('multimediaFileTitle'))) {
                $input_data['file_id'] = $file_id;
                $input_data['newsroom'] = $newsroom_id;
                $input_data['language'] = $lang;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                if ($this->news_file_description_model->add($input_data)) {
                    echo TRUE;
                } else {
                    echo 'File title update failed.';
                }
            }
        } else {
            echo 'Something went wrong, Please try again.';
        }
    }

    function ajax_add_multimedia_file($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax add multimedia file
        if (empty($newsroom_id) || empty($lang)) {
            echo 'Something went wrong, Please try again.';
        } else if (!empty($_FILES['multimediaFileUpdateBrowse'])) {
            $config = array();
            $config['upload_path'] = 'assets/uploads/news';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['multimediaFileUpdateBrowse']) && $_FILES['multimediaFileUpdateBrowse']['error'] == 0) {
                $file_info = array('field_name' => 'multimediaFileUpdateBrowse', 'file' => &$_FILES['multimediaFileUpdateBrowse']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if ($upload_result['error']) {
                    echo $upload_result['error_msg'];
                } else {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['newsroom'] = $newsroom_id;
                    $input_data['file'] = $file_name;
                    $input_data['file_for'] = "MI";
                    $input_data['file_type'] = "I";
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $file_id = $this->news_file_model->add($input_data);
                    $title = $this->input->post('multimediaFileUpdateTitle');
                    $input_data = array();
                    $input_data['title'] = $title;
                    if ($this->news_file_description_model->get_news_file_description($file_id, $newsroom_id, $lang)) {
                        $input_data['updated_at'] = time();
                        $input_data['updated_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->news_file_description_model->update($input_data, $file_id);
                    } else {
                        $input_data['file_id'] = $file_id;
                        $input_data['newsroom'] = $newsroom_id;
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->news_file_description_model->add($input_data);
                    }
                    echo TRUE;
                }
            }
        } else {
            echo 'File required.';
        }
    }

    function ajax_get_multimedia_files()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax get all multimedia files
        $newsroom_id = $this->input->post('newsroom_id');
        $lang = $this->input->post('language_id');
        $multimedia_images = $this->news_file_model->get_files(array('newsroom' => $newsroom_id, 'file_for' => 'MI', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $this->data['multimedia_images'] = $multimedia_images;
        $this->load->view('panel/ajax/ajax_multimedia_files.php', $this->data);
    }

    function ajax_delete_multimedia_file($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax delete_multimedia file
        if ($newsroom_id > 0 && $lang > 0) {
            $file_id = $this->input->post('deleteMultimediaFileId');
            $filter = array();
            $filter['file_id'] = $file_id;
            $filter['newsroom'] = $newsroom_id;
            $file_info = $this->news_file_model->get_file($filter);
            if ($file_info) {
                if ($file_info->file_type == 'I') {
                    if (file_exists('./assets/uploads/news/' . $file_info->file) && !empty($file_info->file)) {
                        unlink('./assets/uploads/news/' . $file_info->file);
                        unlink('./assets/uploads/news/thumb_' . $file_info->file);
                    }
                }
                $this->news_file_model->delete_file($file_id);
                $this->news_file_description_model->delete_file_description($file_id, $lang, $newsroom_id);
                echo TRUE;
            }
        }
    }

    function ajax_add_featured_file($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax to add featured file
        if (!empty($_FILES['featuredFileUpdateBrowse']) && $newsroom_id > 0 && $lang > 0) {
            $config = array();
            $config['upload_path'] = 'assets/uploads/news';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['featuredFileUpdateBrowse']) && $_FILES['featuredFileUpdateBrowse']['error'] == 0) {
                $file_info = array('field_name' => 'featuredFileUpdateBrowse', 'file' => &$_FILES['featuredFileUpdateBrowse']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if ($upload_result['error']) {
                    echo $upload_result['error_msg'];
                } else {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['newsroom'] = $newsroom_id;
                    $input_data['file'] = $file_name;
                    $input_data['file_for'] = "FI";
                    $input_data['file_type'] = "I";
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $file_id = $this->news_file_model->add($input_data);
                    $title = $this->input->post('featuredFileUpdateTitle');
                    $input_data = array();
                    $input_data['title'] = $title;
                    $input_data['description'] = $this->input->post('featuredFileUpdateDesc');
                    if ($this->news_file_description_model->get_news_file_description($file_id, $lang, $newsroom_id)) {
                        $input_data['updated_at'] = time();
                        $input_data['updated_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->news_file_description_model->update($input_data, $file_id);
                    } else {
                        $input_data['file_id'] = $file_id;
                        $input_data['newsroom'] = $newsroom_id;
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->news_file_description_model->add($input_data);
                    }
                    echo TRUE;
                }
            } else {
                echo 'File required.';
            }
        } else {
            echo 'Something went wrong, Please try again.';
        }
    }

    public function ajax_featured_file_description($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax to update file description
        if ((!empty($this->input->post('featured_file_id')) && $this->input->post('featured_file_id') > 0) && $newsroom_id > 0 && $lang > 0) {
            $file_id = $this->input->post('featured_file_id');
            $title = $this->input->post('featuredFileTitle');
            $input_data = array();
            $input_data['title'] = $title;
            $input_data['description'] = $this->input->post('featuredFileDesc');
            if ($this->news_file_description_model->get_news_file_description($file_id, $lang, $newsroom_id)) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                if ($this->news_file_description_model->update($input_data, $file_id)) {
                    echo TRUE;
                } else {
                    echo 'File title update failed.';
                }
            } else {
                $input_data['file_id'] = $file_id;
                $input_data['newsroom'] = $newsroom_id;
                $input_data['language'] = $lang;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                if ($this->news_file_description_model->add($input_data)) {
                    echo TRUE;
                } else {
                    echo 'File title update failed.';
                }
            }
        } else {
            echo 'Something went wrong, Please try again.';
        }
    }

    function ajax_get_featured_files()
    {
        //ajax to get all the featured files
        $newsroom_id = $this->input->post('newsroom_id');
        $lang = $this->input->post('language_id');
        $featured_images = $this->news_file_model->get_files(array('newsroom' => $newsroom_id, 'file_for' => 'FI', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $this->data['featured_images'] = $featured_images;
        $this->load->view('panel/ajax/ajax_featured_files.php', $this->data);
    }

    function ajax_delete_featured_file($newsroom_id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax to delete the featured file
        if ($newsroom_id > 0 && $lang > 0) {
            $file_id = $this->input->post('deleteFeaturedFileId');
            $filter = array();
            $filter['file_id'] = $file_id;
            $filter['newsroom'] = $newsroom_id;
            $file_info = $this->news_file_model->get_file($filter);
            if ($file_info) {
                if ($file_info->file_type == 'I') {
                    if (file_exists('./assets/uploads/news/' . $file_info->file) && !empty($file_info->file)) {
                        unlink('./assets/uploads/news/' . $file_info->file);
                        unlink('./assets/uploads/news/thumb_' . $file_info->file);
                    }
                }
                $this->news_file_model->delete_file($file_id);
                $this->news_file_description_model->delete_file_description($file_id, $lang, $newsroom_id);
                echo TRUE;
            }
        }
    }

    public function delete_cover_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $news = $this->news_model->get_news($id, $lang);
        } else {
            redirect('panel/news/all', 'refresh');
        }
        if (file_exists('./assets/uploads/news/' . $news->news_cover) && !empty($news->news_cover)) {
            unlink('./assets/uploads/news/' . $news->news_cover);
            unlink('./assets/uploads/news/thumb_' . $news->news_cover);
        }
        $input_data['news_cover'] = '';
        $this->news_model->update($input_data, $news->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/news/edit/' . $news->newsroom . '/' . $lang, 'refresh');
    }

    public function delete_brand_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $news = $this->news_model->get_news($id, $lang);
        } else {
            redirect('panel/news/all', 'refresh');
        }
        if (file_exists('./assets/uploads/news/' . $news->secondary_img) && !empty($news->secondary_img)) {
            unlink('./assets/uploads/news/' . $news->secondary_img);
            unlink('./assets/uploads/news/thumb_' . $news->secondary_img);
        }
        $input_data['secondary_img'] = '';
        $this->news_model->update($input_data, $news->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/news/edit/' . $news->newsroom . '/' . $lang, 'refresh');
    }

    public function delete($id)
    {
        $project = $this->news_model->get_news_without_status($id);
        $go_forward = null;
        if ($project) {
            if ($this->news_model->delete_news($id)) {
                $go_forward = true;
            } else {
                $go_forward = false;
            }
        } else {
            $go_forward = false;
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'Project deleted successfully.');
            redirect('panel/news/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
    }
}
