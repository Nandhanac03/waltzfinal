<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_inquiry extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Product_inquiry_model', 'product_inquiry_model');
        $this->load->model('Product_model', 'product_model');      
    }

    public function index() {
        redirect('panel/product_inquiry/all', 'refresh');
    }

    public function all() {
        //Inquiries list view
        $filter = array();
        $this->form_validation->set_rules('filterInquiryCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterInquiryTitle', 'title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['title'] = $this->input->post('filterInquiryTitle');
            if ($this->input->post('filterInquiryCreatedAt') != '') {
                $filterInquiryCreatedAt = explode('-', $this->input->post('filterInquiryCreatedAt'));
                if (!empty($filterInquiryCreatedAt[0])) {
                    $filterInquiryCreatedAt[0] = str_replace('/', '-', $filterInquiryCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterInquiryCreatedAt[0]);
                }
                if (!empty($filterInquiryCreatedAt[1])) {
                    $filterInquiryCreatedAt[1] = str_replace('/', '-', $filterInquiryCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterInquiryCreatedAt[1]);
                }
            }
        }
        $this->data['inquiries'] = $this->product_inquiry_model->get($filter);
        $this->data['active_menu'] = 'product_inquiry';
        $this->data['site_content'] = 'inquiries';
        $this->load->view('panel/content', $this->data);
    }

    public function view($id) {
        $filter = array();
        $filter['inquiry_id'] = $id;
        $inquiry = $this->product_inquiry_model->get($filter, true);
        if ($id < 0 || !$inquiry) {
            redirect('panel/product_inquiry/all', 'refresh');
        }        
        $inquiry_products = '';
        if ($inquiry->products) {
            $filter = array();
            $filter['products'] = $inquiry->products;
            $inquiry_products = $this->product_model->get_by_lang($filter);
        }
        $this->data['inquiry'] = $inquiry;        
        $this->data['inquiry_products'] = $inquiry_products;
        $this->data['active_menu'] = 'product_inquiry';
        $this->data['site_content'] = 'view_inquiry';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id) {
        if ($id > 0) {
            $this->product_inquiry_model->disable($id);
        }
        $this->session->set_flashdata('success', 'Inquiry deleted successfully.');
        redirect('panel/product_inquiry/all', 'refresh');
    }

}
