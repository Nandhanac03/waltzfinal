<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Socialmedia extends CO_Panel_Controller {

    function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Social_model', 'social_model');
        //configuration
        $controller_config = array();        
        $controller_config['disable_socialmedia_add'] = true;
        $controller_config['disable_socialmedia_delete'] = FALSE;        
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        $this->all();
    }

    public function all() {
        $socialmedias = $this->social_model->get_socialmedias();
        $this->data['socialmedias'] = $socialmedias;
        $this->data['active_menu'] = 'socialmedia';
        $this->data['site_content'] = 'socialmedia';
        $this->load->view('panel/content', $this->data);
    }

    public function add() {
        $this->form_validation->set_rules('name', 'name', 'trim|required|is_unique[socialmedia.name]|alpha');
        $this->form_validation->set_rules('url', 'url', 'trim|required|strtolower|callback_validate_url');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['name'] = $this->input->post('name');
            $input_data['url'] = $this->input->post('url');
            $input_data['status'] = '1';
            $input_data['created_at'] = date('Y-m-d H:i:s');
            $this->social_model->add($input_data);
            $this->session->set_flashdata('success', 'Socialmedia created successfully.');
            redirect('/panel/socialmedia/all', 'refresh');
        }
        $this->data['active_menu'] = 'socialmedia';
        $this->data['site_content'] = 'add_socialmedia';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id) {
        $this->data['image_error'] = '';
        $socialmedia = $this->social_model->get_socialmedia($id);
        if (!$socialmedia || !isset($id) || empty($id)) {
            redirect('panel/socialmedia/all');
        }
        if ($socialmedia->name != $this->input->post('name')) {
            $this->form_validation->set_rules('name', 'name', 'trim|required|is_unique[socialmedia.name]|alpha');
        }
        $this->form_validation->set_rules('url', 'url', 'trim|required|strtolower|callback_validate_url');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['name'] = $this->input->post('name');
            $input_data['url'] = $this->input->post('url');
            $input_data['status'] = $this->input->post('status') == 'A' ? '1' : '0';
            $this->social_model->update($input_data, $id);
            $this->session->set_flashdata('success', 'Social Media updated successfully.');
            redirect('/panel/socialmedia/all', 'refresh');
        }
        $this->data['socialmedia'] = $socialmedia;
        $this->data['active_menu'] = 'socialmedia';
        $this->data['site_content'] = 'edit_socialmedia';
        $this->load->view('panel/content', $this->data);
    }

    function validate_url($url) {
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_url', 'The entered url is not valid');
            return FALSE;
        }
    }

}
