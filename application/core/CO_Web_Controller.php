<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CO_Web_Controller extends CO_Core_Controller
{

    function __construct()
    {
        parent::__construct();
        if (empty($_SESSION['web_guest_id'])) {
            $_SESSION['web_guest_id'] = mt_rand(1, 9999) . date('dm');
        }
        if (empty($_SESSION['web_user_type'])) {
            // if web user type is G then guest user 
            // if web user type is C then customer 
            $_SESSION['web_user_type'] = 'G';
        }
        //checking user is customer
        if (!$this->ion_auth->in_group('customer')) {
            $_SESSION['web_user_type'] = 'G';
        }

        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 1;
        }
        $this->data['web_alert'] = $this->web_alert();
        $this->general();
        $this->change_language();
    }

    private function web_alert()
    {
        if ($this->session->flashdata('web_error')) {
            return '<div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> ' . $this->session->flashdata('web_error') . '</div>';
        } else if ($this->session->flashdata('web_success')) {
            return '<div class="alert alert-success alert-dismissible fade show">
              
            <strong>Success!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . $this->session->flashdata('web_success') . '</div>';
        } else if ($this->session->flashdata('web_info')) {
            return '<div class="alert alert-info alert-dismissible fade show">
              
            <strong>Info!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' . $this->session->flashdata('web_success') . '</div>';
        } else if ($this->session->flashdata('web_warning')) {
            return '<div class="alert alert-warning alert-dismissible fade show">
              
            <strong>Warning!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> ' . $this->session->flashdata('web_success') . '</div>';
        }
        return '';
    }

    private function general()
    {
        //getting common data
        $this->form_validation->set_error_delimiters('<div class="error-text">', '</div>');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Social_model', 'social_model');
        $this->load->model('Article_model', 'article_model');
        $this->load->model('file_model', 'file_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Career_model', 'career_model');
        $this->load->model('Album_model', 'album_model');
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Bio_model', 'bio_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Solution_category_model', 'solution_category_model');

        $this->load->model('settings_model');
        $this->data['common_contact'] = $this->contact_model->get_by_lang(1, $_SESSION['lang']);
        $this->data['web_languages'] = $this->language_model->get_languages();
        $this->data['settings'] = $this->settings_model->get(1); // This is to get copyright
        $this->data['logo'] = $this->album_model->get(2);
        $this->data['menus'] = $this->menu_model->get_by_parent(0);
        $this->data['header_services'] = $this->article_model->get_all();
        $this->data['header_products'] = $this->product_model->get_all_product();
        $this->data['services'] = $this->bio_model->get_all();
        $this->data['services'] = $this->bio_model->get_all();
        $this->data['products'] = $this->product_model->get_all_product();
        $allsolution_categories  = $this->solution_category_model->get_all();

        $this->data['allsolution_categories'] = $allsolution_categories;

        // echo "<pre>";
        // print_r($this->data['services']);
        // exit;
        
        $this->data['footer_des'] = $this->page_model->get(13);
        $this->data['com_email'] = $this->page_model->get(16);
        $this->data['ukphone'] = $this->page_model->get(15);
        $this->data['uaephone'] = $this->page_model->get(14);

        // echo "<pre>";
        // print_r($this->data['ukphone']);
        // exit;


        $this->data['social_facebook'] = $this->social_model->get_socialmedia(1);
        $this->data['social_instagram'] = $this->social_model->get_socialmedia(2);
        $this->data['social_twitter'] = $this->social_model->get_socialmedia(4);
        $this->data['social_linkedin'] = $this->social_model->get_socialmedia(5);
        // echo"<pre>";print_r($this->data['logo']);exit;


        // echo"<pre>";print_r($this->data['footer_des']);exit;
    }


    /**
     * function to change website language
     * @return bool
     */
    function change_language()
    {

        $this->load->model('Language_model', 'language_model');
        $this->load->model('Label_model', 'label_model');
        if (!empty($this->input->get('lang'))) {
            if ($this->input->get('lang') == 'en') {
                $_SESSION['lang'] = 1;
            } else if ($this->input->get('lang') == 'ar') {
                $_SESSION['lang'] = 2;
            }
        } else if (empty($_SESSION['lang'])) {
            $_SESSION['lang'] = 1;
        }

        $language = $this->language_model->get_language($_SESSION['lang']);
        $language = ($language) ? strtolower($language->name) : "english";
        $this->session->set_userdata('site_lang', $language);

        // multilanguage support
        $web_labels = $this->label_model->get_all_by_lang($_SESSION['lang']);
        $this->data['web_labels'] = array();
        if ($web_labels) {
            foreach ($web_labels as $web_label) {
                $this->data['web_labels'][$web_label->keyword] = $web_label->title;
            }
        }
    }
    // function ajax_newsletter(){
    //     if($_POST){
    //         echo"<pre>";print_r($_POST);exit;
    //         echo"Success";
    //     }
    // }
}
