<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading library
        $this->load->library('image_lib');
        //loading models
        $this->load->model('Album_model', 'album_model');
        $this->load->model('File_model', 'file_model');
        $this->load->model('File_description_model', 'file_description_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Blog_model', 'blog_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration 
        $controller_config = array();
        $controller_config['disable_blog_type'] = true;
        $controller_config['disable_blog_save_draft'] = true;
        $controller_config['disable_blog_seo'] = false;
        $controller_config['disable_blog_canonical_url'] = TRUE;
        $controller_config['disable_blog_short_description'] = TRUE;
        $controller_config['disable_blog_seo'] = TRUE;
        $controller_config['disable_blog_brand_img'] = TRUE;
        $controller_config['disable_blog_area'] = TRUE;
        $controller_config['disable_blog_date'] = TRUE;
        $controller_config['disable_blog_description'] = TRUE;



        $this->data['cover_img_note'] = "Recommended image dimension 600 x 450px. Supports jpg, jpeg and png.";
        $this->data['author_img_note'] = "Recommended image dimension 600 x 600px. Supports jpg, jpeg and png.";
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/blog/all', 'refresh');
    }

    public function all()
    {
        // if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        // }
        $filter = array();
        $this->form_validation->set_rules('filterNewsTitle', 'filterNewsTitle', 'trim');
        if ($this->form_validation->run() === true) {
            // echo"workgin";exit;
            $title = $this->input->post('filterNewsTitle');
            $filterNewsPublishedAt = $this->input->post('filterNewsPublishedAt');
            if ($this->input->post('filterNewsTitle') != '') {
                $filter['title'] = $title;
            }
            if ($this->input->post('filterNewsPublishedAt') != '') {
                $filterNewsPublishedAt = explode('-', $this->input->post('filterNewsPublishedAt'));
                if (!empty($filterNewsPublishedAt[0])) {
                    $filterNewsPublishedAt[0] = str_replace('/', '-', $filterNewsPublishedAt[0]);
                    $filter['from_created_at'] = strtotime($filterNewsPublishedAt[0]);
                }
                if (!empty($filterNewsPublishedAt[1])) {
                    $filterNewsPublishedAt[1] = str_replace('/', '-', $filterNewsPublishedAt[1]);
                    $filter['to_created_at'] = strtotime($filterNewsPublishedAt[1]);
                }
                // $filter['filterNewsPublishedAt'] = $filterNewsPublishedAt;
            }
            // echo"<pre>";print_r($filter);exit;
        }
        $blogs = $this->blog_model->get_all_for_panel($filter);
        // echo "<pre>";print_r($blogs);exit;
        $this->data['blogs'] = $blogs;
        $this->data['active_menu'] = 'blog';
        $this->data['site_content'] = 'blog';
        $this->load->view('panel/content', $this->data);
    }
    public function add($lang = 1)
    {
        // $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('blogTitle', 'title', 'trim|required|max_length[120]');
        $this->form_validation->set_rules('blogSlugTitle', 'slug title', 'trim|required|is_unique[article.title_slug]');
        $this->form_validation->set_rules('blogSubtitle', 'subtitle', 'trim|max_length[30]');
        $this->form_validation->set_rules('blogArea', 'blogArea', 'trim');
        $this->form_validation->set_rules('project_date', 'Project Date', 'trim');
        $this->form_validation->set_rules('blogShortDesc', 'short description', 'trim|max_length[400]');
        $this->form_validation->set_rules('blogDescription', 'description', 'trim|max_length[10000]');
        $this->form_validation->set_rules('blogSeoTitle', 'blogSeoTitle', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('blogSeoMetaKeywords', 'blogSeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('blogSeoMetaDescription', 'blogSeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('blogSeoCanonicalUrl', 'blogSeoCanonicalUrl', 'trim');
        if ($this->form_validation->run() === TRUE) {

            // echo"<pre>";print_r($this->input->post());exit;
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('blogTitle');
            $input_data['title_slug'] = $this->input->post('blogSlugTitle');
            $input_data['subtitle'] = $this->input->post('blogSubtitle');
            $input_data['additional_info'] = $this->input->post('blogArea');
            $input_data['project_date'] = $this->input->post('project_date');
            $input_data['short_desc'] = $this->input->post('blogShortDesc');
            $input_data['description'] = $this->input->post('blogDescription');
            $input_data['seo_title'] = $this->input->post('blogSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('blogSeoMetaKeywords');
            $input_data['seo_meta_description	'] = $this->input->post('blogSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('blogSeoCanonicalUrl');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;

            $config = array();
            $config['upload_path'] = 'assets/uploads/blog';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 500;
            // $config['max_width'] = 680;
            // $config['max_height'] = 560;

            if (!empty($_FILES['blogDescImg']) && $_FILES['blogDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'blogDescImg', 'file' => &$_FILES['blogDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                // echo"<pre>";print_r($upload_result);exit;
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['blogDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            if (!empty($_FILES['blogBrandImg']) && $_FILES['blogBrandImg']['error'] == 0) {
                $file_info = array('field_name' => 'blogBrandImg', 'file' => &$_FILES['blogBrandImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                // echo"<pre>";print_r($upload_result);exit;
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['brand_img'] = $file_name;
                } else {
                    $this->data['blogBrandImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            // echo "wokring.";exit;
            if ($no_error == TRUE) {
                $blog_id = $this->blog_model->add($input_data);
                if ($blog_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/blog/all', 'refresh');
            }
        }
        $this->data['active_menu'] = 'blog';
        $this->data['site_content'] = 'add_blog';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        // echo $id;exit;
        $language_parent = '';
        if ($id > 0) {
            $current_blog = $this->blog_model->get_for_panel($id);
        } else {
            redirect('panel/blog/all', 'refresh');
        }

        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;

        $this->form_validation->set_rules('blogTitle', 'title', 'trim|required|max_length[120]');
        if (!$current_blog || empty($current_blog->title_slug) || $current_blog->title_slug != $this->input->post('blogSlugTitle')) {
            $this->form_validation->set_rules('blogSlugTitle', 'slug title', 'trim|required|is_unique[blog.title_slug]');
        }
        $this->form_validation->set_rules('blogSubtitle', 'subtitle', 'trim|max_length[30]');
        $this->form_validation->set_rules('blogArea', 'blogArea', 'trim');
        $this->form_validation->set_rules('project_date', 'Project Date', 'trim');
        $this->form_validation->set_rules('blogShortDesc', 'short_description', 'trim|max_length[400]');
        $this->form_validation->set_rules('blogDescription', 'description', 'trim|max_length[10000]');
        $this->form_validation->set_rules('blogSeoTitle', 'blogSeoTitle', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('blogSeoMetaKeywords', 'blogSeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('blogSeoMetaDescription', 'blogSeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('blogSeoCanonicalUrl', 'blogSeoCanonicalUrl', 'trim');
        $this->form_validation->set_rules('blogStatus', 'blogStatus', 'trim');

        if ($this->form_validation->run() === true) {
            $input_data = array();
            $no_error = TRUE;
            // $current_id=$this->input->post('id');
            $input_data['title'] = $this->input->post('blogTitle');
            $input_data['title_slug'] = $this->input->post('blogSlugTitle');
            $input_data['subtitle'] = $this->input->post('blogSubtitle');
            $input_data['additional_info'] = $this->input->post('blogArea');
            $input_data['project_date'] = $this->input->post('project_date');
            $input_data['short_desc'] = $this->input->post('blogShortDesc');
            $input_data['description'] = $this->input->post('blogDescription');
            $input_data['seo_title'] = $this->input->post('blogSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('blogSeoMetaKeywords');
            $input_data['seo_meta_description	'] = $this->input->post('blogSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('blogSeoCanonicalUrl');
            $input_data['language'] = $lang;
            $input_data['active'] = $this->input->post('blogStatus');

            $config = array();
            $config['upload_path'] = 'assets/uploads/blog';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            // $config['max_size'] = 500;
            // $config['max_width'] = 680;
            // $config['max_height'] = 560;
            if (!empty($_FILES['blogDescImg']) && $_FILES['blogDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'blogDescImg', 'file' => &$_FILES['blogDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/blog/' . $current_blog->desc_img) && !empty($current_blog->desc_img)) {
                        unlink('./assets/uploads/blog/' . $current_blog->desc_img);
                        unlink('./assets/uploads/blog/thumb_' . $current_blog->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['blogDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            if (!empty($_FILES['blogBrandImg']) && $_FILES['blogBrandImg']['error'] == 0) {
                $file_info = array('field_name' => 'blogBrandImg', 'file' => &$_FILES['blogBrandImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                // echo"<pre>";print_r($upload_result);exit;
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['brand_img'] = $file_name;
                } else {
                    $this->data['blogBrandImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            if ($no_error == TRUE) {
                if ($current_blog) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->blog_model->add($input_data, $current_blog->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->blog_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/blog/all', 'refresh');
            }
        }

        $this->data['blog'] = $current_blog;
        $this->data['active_menu'] = 'blog';
        $this->data['site_content'] = 'edit_blog';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_cover_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $blog = $this->blog_model->get($id, $lang);
        } else {
            redirect('panel/blog/all', 'refresh');
        }
        if (file_exists('./assets/uploads/blog/' . $blog->desc_img) && !empty($blog->desc_img)) {
            unlink('./assets/uploads/blog/' . $blog->desc_img);
            unlink('./assets/uploads/blog/thumb_' . $blog->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->blog_model->update($input_data, $blog->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/blog/edit/' . $blog->id . '/' . $lang, 'refresh');
    }

    public function delete_brand_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $blog = $this->blog_model->get($id, $lang);
        } else {
            redirect('panel/blog/all', 'refresh');
        }
        if (file_exists('./assets/uploads/blog/' . $blog->brand_img) && !empty($blog->brand_img)) {
            unlink('./assets/uploads/blog/' . $blog->brand_img);
            unlink('./assets/uploads/blog/thumb_' . $blog->brand_img);
        }
        $input_data['brand_img'] = '';
        $this->blog_model->update($input_data, $blog->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/blog/edit/' . $blog->id . '/' . $lang, 'refresh');
    }

    public function delete($id)
    {
        $blog = $this->blog_model->get($id);
        $blog_image = $blog->desc_img;
        $go_forward = null;
        if ($this->blog_model->delete_blog($id)) {
            if (file_exists('./assets/uploads/blog/' . $blog_image) && !empty($blog_image)) {
                unlink('./assets/uploads/blog/' . $blog_image);
                unlink('./assets/uploads/blog/thumb_' . $blog_image);
                $go_forward = true;
            } elseif (empty($blog_image)) {
                $go_forward = true;
            } else {
                $go_forward = false;
            }
        } else {
            $go_forward = false;
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'Blog deleted successfully.');
            redirect('panel/blog/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
    }
}
