<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distributor extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Distributor_model', 'distributor_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Country_model', 'country_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_distributor_languages'] = TRUE;
        $controller_config['disable_distributor_name'] = FALSE;
        $controller_config['disable_distributor_address'] = FALSE;
        $controller_config['disable_distributor_email'] = TRUE;
        $controller_config['disable_distributor_phone'] = FALSE;
        $controller_config['disable_distributor_fax'] = TRUE;
        $controller_config['disable_distributor_city'] = TRUE;
        $controller_config['disable_distributor_state'] = TRUE;
        $controller_config['disable_distributor_country'] = FALSE;
        $controller_config['disable_distributor_website'] = FALSE;
        $controller_config['disable_distributor_map'] = FALSE;
        $this->data['controller_config'] = $controller_config;
        //decalaring
        $countries = array();
        $country = new stdClass();
        $country->id = 1;
        $country->name = 'BAHRAIN';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 2;
        $country->name = 'EGYPT';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 3;
        $country->name = 'JORDAN';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 4;
        $country->name = 'KSA';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 5;
        $country->name = 'KUWAIT';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 6;
        $country->name = 'OMAN';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 7;
        $country->name = 'QATAR';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 8;
        $country->name = 'UAE';
        array_push($countries, $country);
        $country = new stdClass();
        $country->id = 9;
        $country->name = 'USA';
        array_push($countries, $country);
        $this->data['countries'] = $countries;
    }

    public function index() {
        redirect('panel/distributor/all', 'refresh');
    }

    public function all() {
        //Distributors list view
        $filter = array();
        $this->data['distributors'] = $this->distributor_model->get_all($filter);
        $this->data['active_menu'] = 'distributor';
        $this->data['site_content'] = 'distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1) {
        //add distributor
        $current_language = $this->language_model->get_language($lang);
        // $countries = $this->country_model->get_countries();
        $this->form_validation->set_rules('distributorName', 'Name', 'trim');
        $this->form_validation->set_rules('distributorAddress', 'Address', 'trim');
        $this->form_validation->set_rules('distributorEmail', 'Email', 'trim');
        $this->form_validation->set_rules('distributorPhone', 'Phone', 'trim');
        $this->form_validation->set_rules('distributorFax', 'Fax', 'trim');
        $this->form_validation->set_rules('distributorCity', 'City', 'trim');
        $this->form_validation->set_rules('distributorState', 'State', 'trim');
        $this->form_validation->set_rules('distributorCountry', 'Country', 'trim');
        $this->form_validation->set_rules('distributorWebsite', 'Country', 'trim');
        $this->form_validation->set_rules('distributorMap', 'Map', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['full_name'] = $this->input->post('distributorName');
            $input_data['address'] = $this->input->post('distributorAddress');
            $input_data['email'] = $this->input->post('distributorEmail');
            $input_data['phone'] = $this->input->post('distributorPhone');
            $input_data['fax'] = $this->input->post('distributorFax');
            $input_data['city'] = $this->input->post('distributorCity');
            $input_data['state'] = $this->input->post('distributorState');
            $input_data['country'] = $this->input->post('distributorCountry');
            $input_data['website'] = $this->input->post('distributorWebsite');
            $input_data['map'] = $this->input->post('distributorMap');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $distributor_id = $this->distributor_model->add($input_data);
            if ($distributor_id <= 0) {
                $no_error = FALSE;
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/distributor/all', 'refresh');
            }
        }
        //$this->data['countries'] = $countries;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'distributor';
        $this->data['site_content'] = 'add_distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        //edit distributor based on language
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_distributor = $this->distributor_model->get($id);
            $distributor = $parent_distributor;
        } else if ($id > 0 && $lang > 0) {
            $parent_distributor = $this->distributor_model->get($id);
            if ($parent_distributor) {
                $language_parent = $id;
                $distributor = $this->distributor_model->get_by_parent($id, $lang);
            }
        } else {
            redirect('panel/distributor/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_distributor || !$current_language) {
            redirect('panel/distributor/all', 'refresh');
        }
        if ($lang != 1) {
            $controller_config['disable_distributor_email'] = FALSE;
            $controller_config['disable_distributor_phone'] = FALSE;
            $controller_config['disable_distributor_fax'] = FALSE;
            $controller_config['disable_distributor_city'] = FALSE;
            $controller_config['disable_distributor_state'] = FALSE;
            $controller_config['disable_distributor_country'] = FALSE;
            $controller_config['disable_distributor_website'] = FALSE;
            $controller_config['disable_distributor_map'] = FALSE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        //$countries = $this->country_model->get_countries();
        $distributor_languages = $this->distributor_model->get_languages($id);
        $this->form_validation->set_rules('distributorName', 'Name', 'trim');
        $this->form_validation->set_rules('distributorAddress', 'Address', 'trim');
        $this->form_validation->set_rules('distributorEmail', 'Email', 'trim');
        $this->form_validation->set_rules('distributorPhone', 'Phone', 'trim');
        $this->form_validation->set_rules('distributorFax', 'Fax', 'trim');
        $this->form_validation->set_rules('distributorCity', 'City', 'trim');
        $this->form_validation->set_rules('distributorState', 'State', 'trim');
        $this->form_validation->set_rules('distributorCountry', 'Country', 'trim');
        $this->form_validation->set_rules('distributorMap', 'Map', 'trim');
        $this->form_validation->set_rules('distributorWebsite', 'Map', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['full_name'] = $this->input->post('distributorName');
            $input_data['address'] = $this->input->post('distributorAddress');
            $input_data['email'] = $this->input->post('distributorEmail');
            $input_data['phone'] = $this->input->post('distributorPhone');
            $input_data['fax'] = $this->input->post('distributorFax');
            $input_data['city'] = $this->input->post('distributorCity');
            $input_data['state'] = $this->input->post('distributorState');
            $input_data['country'] = $this->input->post('distributorCountry');
            $input_data['website'] = $this->input->post('distributorWebsite');
            $input_data['map'] = $this->input->post('distributorMap');
            $input_data['updated_at'] = time();
            $input_data['updated_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['language_parent'] = $language_parent;
            $input_data['active'] = 1;
            if ($distributor) {
                $this->distributor_model->update($input_data, $distributor->id);
            } else {
                $this->distributor_model->add($input_data);
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/distributor/edit/' . $id . '/' . $lang, 'refresh');
            }
        }
        $this->data['distributor_languages'] = explode(',', $distributor_languages->languages);
        $this->data['distributor'] = $distributor;
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        //$this->data['countries'] = $countries;
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['active_menu'] = 'distributor';
        $this->data['site_content'] = 'edit_distributor';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $distributor = $this->distributor_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->distributor_model->disable($id);
            }
        }
        $this->session->set_flashdata('success', 'Distributor deleted successfully.');
        redirect('panel/distributor/all', 'refresh');
    }

}
