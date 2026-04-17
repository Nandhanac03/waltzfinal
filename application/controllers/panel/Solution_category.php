<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solution_category extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Solution_category_model', 'solution_category_model');
        $this->load->model('Solution_model', 'solution_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_add_category'] = FALSE;
        $controller_config['disable_delete_category'] = FALSE;
        $controller_config['disable_parent_category'] = FALSE;
        $controller_config['disable_solution_category_seo'] = true;
        $controller_config['disable_category_order'] = FALSE;
        $controller_config['disable_languages_category'] = FALSE;
        $controller_config['disable_category_canonical_url'] = TRUE;
        $controller_config['disable_categoryShortDesc'] = true;
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['categoryCoverImgError'] = '';
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        $this->all();
    }

    public function all()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        $parent_categories = $this->solution_category_model->get_all_for_panel(true);
        // echo '<pre>';
        // print_r($parent_categories);
        // exit;
        $all_categories = $this->solution_category_model->get_all();
        $this->data['category_count'] = $this->solution_category_model->num_rows;
        $this->data['category_items'] = '';
        if ($parent_categories) {
            $i = 1;
            foreach ($parent_categories as $parent_category) {
                $this->data['sl_no'] = $i;
                $this->data['category_id'] = $parent_category->id;
                $this->data['title'] = $parent_category->title;
                $this->data['active'] = $parent_category->active;
                $this->data['category_order'] = $parent_category->category_order;
                $this->data['category_items'] .= $this->load->view('panel/solution_category_item', $this->data, TRUE);
                $this->data['category_items'] .= $this->get_child_category($parent_category->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_categories as $category) {
                $input_data = array();
                $input_data['category_order'] = $this->input->post('category_order_' . $category->id);
                $this->solution_category_model->update($input_data, $category->id);
            }
            $category_order = 0;
            $parent_categories = $this->solution_category_model->get_all(TRUE);
            foreach ($parent_categories as $parent_category_item) {
                $category_order++;
                $input_data = array();
                $input_data['category_order'] = $category_order;
                $this->solution_category_model->update($input_data, $parent_category_item->id, 1);
                $this->update_order($parent_category_item->id);
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/solution_category/all', 'refresh');
        }
        $this->data['categories'] = $this->get_all_categories($parent_categories);
        $this->data['active_menu'] = 'solution_category';
        $this->data['site_content'] = 'solution_category';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {

        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/solution_category/all', 'refresh');
        }
        $categories = $this->solution_category_model->get_all();
        $parent_categories = $this->solution_category_model->get_all(TRUE);
        $category_order = $this->solution_category_model->num_rows + 1;
        $this->form_validation->set_rules('parentCategory', 'parent category', 'trim');
        $this->form_validation->set_rules('categoryTitle', 'Title', 'trim|required|is_unique[solution_category.title]');
        $this->form_validation->set_rules('categorySlugTitle', 'categorySlugTitle', 'trim|required|is_unique[solution_category.title_slug]');
        $this->form_validation->set_rules('categoryShortDesc', 'categoryShortDesc', 'trim');
        $this->form_validation->set_rules('categorySeoTitle', 'categorySeoTitle', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('categorySeoMetaKeywords', 'categorySeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('categorySeoMetaDescription', 'categorySeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('categorySeoCanonicalUrl', 'categorySeoCanonicalUrl', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = !empty($this->input->post('parentCategory')) ? $this->input->post('parentCategory') : '';
            $input_data['title'] = $this->input->post('categoryTitle');
            $input_data['title_slug'] = $this->input->post('categorySlugTitle');
            $input_data['short_desc'] = $this->input->post('categoryShortDesc');
            $input_data['seo_title'] = $this->input->post('categorySeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('categorySeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('categorySeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('categorySeoCanonicalUrl');
            $input_data['category_order'] = $category_order;
            $input_data['language'] = $lang;
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;

            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['categoryCoverImg']) && $_FILES['categoryCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'categoryCoverImg', 'file' => &$_FILES['categoryCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['description'] = $file_name;
                } else {
                    $this->data['categoryCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $no_error = TRUE;
            $category_id = $this->solution_category_model->add($input_data);
            if ($lang == 1) {
                $parent_categories = $this->solution_category_model->get_all(TRUE);
                if ($parent_categories) {
                    $category_order = 0;
                    foreach ($parent_categories as $parent_category_item) {
                        $category_order++;
                        $input_data = array();
                        $input_data['category_order'] = $category_order;
                        $this->solution_category_model->update($input_data, $parent_category_item->id, 1);
                        $this->update_order($parent_category_item->id);
                    }
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/solution_category/all', 'refresh');
            }
        }
        $this->data['categories'] = $this->get_all_categories($parent_categories);
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'solution_category';
        $this->data['site_content'] = 'add_solution_category';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        if ($id > 0 && $lang == '1') {
            $parent_category = $this->solution_category_model->get_for_panel($id);
            $category = $parent_category;
        } else if ($id > 0 && $lang > 0) {
            $parent_category = $this->solution_category_model->get_for_panel($id);
            if ($parent_category) {
                $category = $this->solution_category_model->get_by_lang_parent($id, $lang);
            }
        } else {
            redirect('panel/solution_category/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_category || !$current_language) {
            redirect('panel/solution_category/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_parent_category'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $categories = $this->solution_category_model->get_all();
        $category_languages = $this->solution_category_model->get_languages($id);
        $parent_categories = $this->solution_category_model->get_all(TRUE);
        $this->form_validation->set_rules('parentCategory', 'Parent Category', 'trim');
        if (!$category || empty($category->title) || $category->title != $this->input->post('categoryTitle')) {
            $this->form_validation->set_rules('categoryTitle', 'Title', 'trim|required|is_unique[solution_category.title]');
        }
        if (!$category || empty($category->title_slug) || $category->title_slug != $this->input->post('categorySlugTitle')) {
            $this->form_validation->set_rules('categorySlugTitle', 'categorySlugTitle', 'trim|required|is_unique[solution_category.title_slug]');
        }
        if (!$category || empty($category->short_desc) || $category->short_desc != $this->input->post('categoryShortDesc')) {
            $this->form_validation->set_rules('categoryShortDesc', 'categoryShortDesc', 'trim');
        }
        if (!$category || empty($category->seo_title) || $category->seo_title != $this->input->post('categorySeoTitle')) {
            $this->form_validation->set_rules('categorySeoTitle', 'categorySeoTitle', 'trim|min_length[3]|max_length[60]');
        }
        if (!$category || empty($category->seo_meta_keywords) || $category->seo_meta_keywords != $this->input->post('categorySeoMetaKeywords')) {
            $this->form_validation->set_rules('categorySeoMetaKeywords', 'categorySeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        }
        if (!$category || empty($category->seo_meta_description) || $category->seo_meta_description != $this->input->post('categorySeoMetaDescription')) {
            $this->form_validation->set_rules('categorySeoMetaDescription', 'categorySeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        }
        if (!$category || empty($category->seo_canonical_url) || $category->seo_canonical_url != $this->input->post('categorySeoCanonicalUrl')) {
            $this->form_validation->set_rules('categorySeoCanonicalUrl', 'categorySeoCanonicalUrl', 'trim');
        }
        if (!$category || empty($category->active) || $category->active != $this->input->post('categoryStatus')) {
            $this->form_validation->set_rules('categoryStatus', 'categoryStatus', 'trim');
        }
        // if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        // }
        if ($this->form_validation->run() === TRUE) {
            // echo "workgin";
            // exit;
            $input_data = array();
            $input_data['parent_id'] = $this->input->post('parentCategory');
            $input_data['title'] = $this->input->post('categoryTitle');
            $input_data['title_slug'] = $this->input->post('categorySlugTitle');
            $input_data['short_desc'] = $this->input->post('categoryShortDesc');
            $input_data['seo_title'] = $this->input->post('categorySeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('categorySeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('categorySeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('categorySeoCanonicalUrl');
            $input_data['active'] = $this->input->post('categoryStatus');
            $input_data['language'] = $lang;
            $input_data['category_order'] = $parent_category->category_order;

            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['categoryCoverImg']) && $_FILES['categoryCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'categoryCoverImg', 'file' => &$_FILES['categoryCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['description'] = $file_name;
                } else {
                    $this->data['categoryCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            if ($lang != 1) {
                $input_data['language_parent'] = $parent_category->id;
            } else {
                $input_data['language_parent'] = '';
            }
            // $input_data['active'] = 1;
            if ($category) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->solution_category_model->update($input_data, $category->id, $lang);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->solution_category_model->add($input_data);
            }
            if ($lang == 1) {
                $parent_categories = $this->solution_category_model->get_all(TRUE);
                if ($parent_categories) {
                    $category_order = 0;
                    foreach ($parent_categories as $parent_category_item) {
                        $category_order++;
                        $input_data = array();
                        $input_data['category_order'] = $category_order;
                        $this->solution_category_model->update($input_data, $parent_category_item->id, 1);
                        $this->update_order($parent_category_item->id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/solution_category/all', 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['category_languages'] = explode(',', $category_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['categories'] = $this->get_all_categories($parent_categories);
        $this->data['parent_category'] = $parent_category;
        $this->data['id'] = $id;
        $this->data['category'] = $category;
        $this->data['active_menu'] = 'solution_category';
        $this->data['site_content'] = 'edit_solution_category';
        $this->load->view('panel/content', $this->data);
    }


    public function get_child_category($parent_id, $sl_no)
    {
        $category_items = '';
        if ($parent_id > 0) {
            $categories = $this->solution_category_model->get_by_parent($parent_id);
            if ($categories) {
                $i = 1;
                foreach ($categories as $category) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['category_id'] = $category->id;
                    $this->data['title'] = $category->title;
                    $this->data['category_order'] = $category->category_order;
                    $category_items .= $this->load->view('panel/solution_category_item', $this->data, TRUE);
                    $category_items .= $this->get_child_category($category->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $category_items;
    }

    private function update_order($parent_id)
    {
        if ($parent_id > 0) {
            $categories = $this->solution_category_model->get_by_parent($parent_id);
            if ($categories) {
                $i = 1;
                foreach ($categories as $category) {
                    $input_data = array();
                    $input_data['category_order'] = $i;
                    $this->solution_category_model->update($input_data, $category->id);
                    $this->update_order($category->id);
                    $i++;
                }
            }
        }
    }

    public function delete($id)
    {
        if ($id > 0) {
            $category = $this->solution_category_model->get($id);
            if ($category) {
                $this->solution_category_model->disable($id);
                $category_order = 0;
                $parent_categories = $this->solution_category_model->get_all(TRUE);
                if ($parent_categories) {
                    foreach ($parent_categories as $parent_category_item) {
                        $category_order++;
                        $input_data = array();
                        $input_data['category_order'] = $category_order;
                        $this->solution_category_model->update($input_data, $parent_category_item->id, 1);
                        $this->update_order($parent_category_item->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/solution_category/all', 'refresh');
    }

    public function get_all_categories($categories, $sl_no = '')
    {
        $category_items = array();
        if ($categories) {
            $i = 1;
            if ($sl_no) {
                $sl_no .= '.';
            }
            foreach ($categories as $category) {
                $tmp_category_item = array();
                $tmp_category_item['sl_no'] = $sl_no . $i;
                $tmp_category_item['category_id'] = $category->id;
                $tmp_category_item['title'] = $category->title;
                $tmp_category_item['category_order'] = $category->category_order;
                array_push($category_items, $tmp_category_item);
                $chid_categories = $this->solution_category_model->get_by_parent($category->id);
                if ($chid_categories) {
                    $child_category_items = $this->get_all_categories($chid_categories, $tmp_category_item['sl_no']);
                    if ($child_category_items) {
                        foreach ($child_category_items as $child_category_item) {
                            array_push($category_items, $child_category_item);
                        }
                    }
                }
                $i++;
            }
        }
        return $category_items;
    }

    public function delete_category($id)
    {
        $category = $this->solution_category_model->get($id);
        $solution_category_id = $category->id;
        $solution = $this->solution_model->get_solution_by_category($id);
        $go_forward = null;
        if ($solution) {
            $this->session->set_flashdata('error', 'solutions are still in this category. You must first eliminate all solutions before you can delete it.');
            redirect('panel/solution_category/all', 'refresh');
        } else {
            if ($this->solution_category_model->delete_category($id)) {
                $go_forward = true;
            } else {
                $go_forward = false;
            }
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'solution Category deleted successfully.');
            redirect('panel/solution_category/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
        // echo"<pre>";print_r($solution);exit;
    }


    public function delete_cover_img($id, $lang = '1')
    {
        //edit solution based on language
        if ($id > 0 && $lang == '1') {
            $solution = $this->solution_category_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $solution = $this->solution_category_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/solution_category/all', 'refresh');
        }
        if (file_exists('./assets/uploads/solution/' . $solution->description) && !empty($solution->description)) {
            unlink('./assets/uploads/solution/' . $solution->description);
            unlink('./assets/uploads/solution/thumb_' . $solution->description);
        }
        $input_data['description'] = '';
        $this->solution_category_model->update($input_data, $solution->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/solution_category/edit/' . $id . '/' . $lang, 'refresh');
    }
}
