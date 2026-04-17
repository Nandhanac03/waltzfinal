<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_contact_delete'] = TRUE;
        $controller_config['disable_contact_add'] = TRUE;
        $controller_config['disable_contact_languages'] = FALSE;
        $controller_config['disable_contact_name'] = false;
        $controller_config['disable_contact_address'] = FALSE;
        $controller_config['disable_contact_email'] = FALSE;
        $controller_config['disable_contact_phone'] = FALSE;
        $controller_config['disable_contact_fax'] = TRUE;
        $controller_config['disable_contact_working_hours'] = TRUE;
        $controller_config['disable_contact_map'] = TRUE;
        $controller_config['disable_contact_iframe_code'] = TRUE;
        $controller_config['disable_contact_telecommunication'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/contact/all', 'refresh');
    }

    public function all() {
        //Contacts list view
        $filter = array();
        $filter['language']=1;
        $this->data['contacts'] = $this->contact_model->get_all($filter);
        // echo"<pre>";print_r($this->data['contacts']);exit;
        $this->data['active_menu'] = 'contact';
        $this->data['site_content'] = 'contact';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add contact
        $current_language = $this->language_model->get_language($lang);
        $this->form_validation->set_rules('contactName', 'name', 'trim');
        $this->form_validation->set_rules('contactAddress', 'address', 'trim');
        $this->form_validation->set_rules('contactEmail', 'email', 'trim');
        $this->form_validation->set_rules('contactPhone', 'phone', 'trim');
        $this->form_validation->set_rules('contactFax', 'fax', 'trim');
        $this->form_validation->set_rules('contactWorkHour', 'working hours', 'trim');
        $this->form_validation->set_rules('contactMap', 'map', 'trim');
        $this->form_validation->set_rules('location_iframe', 'location_iframe', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['full_name'] = $this->input->post('contactName');
            $input_data['address'] = $this->input->post('contactAddress');
            $input_data['email'] = $this->input->post('contactEmail');
            $input_data['phone'] = $this->input->post('contactPhone');
            $input_data['fax'] = $this->input->post('contactFax');
            $input_data['work_hour'] = $this->input->post('contactWorkHour');
            $input_data['map'] = $this->input->post('contactMap');
            $input_data['location_iframe'] = $this->input->post('location_iframe');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            
            $contact_id = $this->contact_model->add($input_data);
            if ($contact_id <= 0) {
                $no_error = FALSE;
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/contact/all', 'refresh');
            }
        }
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'contact';
        $this->data['site_content'] = 'add_contact';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        // if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        // }
        //edit contact based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_contact = $this->contact_model->get($id);
            $contact = $parent_contact;
        } else if ($id > 0 && $lang > 0) {
            $parent_contact = $this->contact_model->get($id);
            if ($parent_contact) {
                $language_parent = $id;
                $contact = $this->contact_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/contact/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_contact || !$current_language) {
            redirect('panel/contact/all', 'refresh');
        }
        if ($lang != 1) {
            $this->data['controller_config']['disable_contact_email'] = TRUE;
            $this->data['controller_config']['disable_contact_phone'] = TRUE;
            $this->data['controller_config']['disable_contact_fax'] = TRUE;
            $this->data['controller_config']['disable_contact_working_hours'] = TRUE;
            $this->data['controller_config']['disable_contact_map'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $contact_languages = $this->contact_model->get_languages($id);
        $this->form_validation->set_rules('contactName', 'name', 'trim');
        $this->form_validation->set_rules('contactAddress', 'address', 'trim');
        $this->form_validation->set_rules('contactEmail', 'email', 'trim');
        $this->form_validation->set_rules('contactPhone', 'phone', 'trim|min_length[10]');
        $this->form_validation->set_rules('contactFax', 'fax', 'trim|min_length[10]');
        $this->form_validation->set_rules('contactWorkHour', 'working hours', 'trim');
        $this->form_validation->set_rules('contactMap', 'map', 'trim');
        $this->form_validation->set_rules('location_iframe', 'location_iframe', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['full_name'] = $this->input->post('contactName');
            $input_data['address'] = $this->input->post('contactAddress');
            $input_data['email'] = $this->input->post('contactEmail');
            $input_data['phone'] = $this->input->post('contactPhone');
            $input_data['fax'] = $this->input->post('contactFax');
            $input_data['work_hour'] = $this->input->post('contactWorkHour');
            $input_data['map'] = $this->input->post('contactMap');
            $input_data['location_iframe'] = $this->input->post('location_iframe');
            $input_data['language'] = $lang;
            $input_data['language_parent'] = 1;
            $input_data['active'] = 1;
            // echo"<pre>";print_r($input_data);exit;
            if ($contact) {
                // print_r($input_data);exit;
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->contact_model->update($input_data, $contact->id);
                // print_r($this->db->last_query());    exit;
            } else {
                // echo"working2";exit;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->contact_model->add($input_data);
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                // redirect('panel/contact/edit/' . $id . '/' . $lang, 'refresh');
                redirect('panel/contact/all', 'refresh');
            }
        }
        $this->data['contact_languages'] = explode(',', $contact_languages->languages);
        $this->data['contact'] = $contact;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'contact';
        $this->data['site_content'] = 'edit_contact';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $contact = $this->contact_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->contact_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Contact deleted successfully.');
        redirect('panel/contact/all', 'refresh');
    }

}
