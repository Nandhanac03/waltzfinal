<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CO_Core_Controller extends CI_Controller
{

    // declaring public variable array for sending data to view
    public $data = array();
    public $panel_settings;

    // setting default values in the data variable
    function __construct()
    {
        parent::__construct();
        $this->data['site_content'] = '';
        $this->data['active_menu'] = '';
        $this->data['active_menu_group'] = '';
        $this->data['error'] = '';
        $this->data['alert'] = $this->alertMessage();
        $this->data['website_title'] = config_item('WEBSITE_TITLE');
        if (!isset($_SESSION['previous_url']))
            $_SESSION['previous_url'] = '';
        //loading panel settings
        $this->load->model('settings_model');
        $this->panel_settings = $this->settings_model->get(1);
        $this->data['panel_setting'] = $this->panel_settings;
        
        // $this->load->model('Menu_model', 'menu_model');
        // $all_menus = $this->menu_model->get_all();
        // //$this->data['top_menu_array'] = $all_menus;
        // $service_menu   =   "";
        // foreach($all_menus as $menu_rec){
        //     if($menu_rec->id==1){
        //         $this->data['service_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==2){
        //         $this->data['products_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==3){
        //         $this->data['clients_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==4){
        //         $this->data['brands_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==5){
        //         $this->data['vi7events_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==6){
        //         $this->data['valletti_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==7){
        //         $this->data['carbee_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==8){
        //         $this->data['idawam_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==9){
        //         $this->data['vi7_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==11){
        //         $this->data['home_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==12){
        //         $this->data['terms_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==13){
        //         $this->data['privacy_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==14){
        //         $this->data['contact_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==15){
        //         $this->data['vi7_group_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==16){
        //         $this->data['get_in_touch_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==17){
        //         $this->data['useful_links_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==18){
        //         $this->data['service_solutions_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==19){
        //         $this->data['product_solutions_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==20){
        //         $this->data['car_wash_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==21){
        //         $this->data['gallery_menu']   =   $menu_rec->title;
        //     }
        //     if($menu_rec->id==22){
        //         $this->data['car_care_menu']   =   $menu_rec->title;
        //     }
        // }
    }

    // error message based on sesssion flashdata of codeigniter
    public function alertMessage()
    {

        if ($this->session->flashdata('error')) {
            return '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
            <button class="close" aria-hidden="true" type="button" data-dismiss="alert">
            <span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> ' . $this->session->flashdata('error') . '</div>';
        } else if ($this->session->flashdata('success')) {
            return '<div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
            <button class="close" aria-hidden="true" type="button" data-dismiss="alert">
            <span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> ' . $this->session->flashdata('success') . '</div>';
        } else if ($this->session->flashdata('info')) {
            return '<div class="alert alert-info alert-dismissible fade show mt-2 mb-2" role="alert">
            <button class="close" aria-hidden="true" type="button" data-dismiss="alert">
            <span aria-hidden="true">&times;</span></button>
            <strong>Info!</strong> ' . $this->session->flashdata('info') . '</div>';
        } else if ($this->session->flashdata('warning')) {
            return '<div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
            <button class="close" aria-hidden="true" type="button" data-dismiss="alert">
            <span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> ' . $this->session->flashdata('warning') . '</div>';
        }
        return '';
    }

    /**
     * @return array A CSRF key-value pair
     */
    public function get_csrf_nonce()
    {

        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }

    /**
     * @return bool Whether the posted CSRF token matches
     */
    public function valid_csrf_nonce()
    {

        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return TRUE;
        }

        return FALSE;
    }
}
