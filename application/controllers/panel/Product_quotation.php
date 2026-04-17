<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_quotation extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model', 'profile_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_quotation_model', 'product_quotation_model');
        $this->load->model('Product_quotation_details_model', 'product_quotation_details_model');
        $this->load->model('Product_quotation_property_model', 'product_quotation_property_model');
    }

    public function index() {
        $this->all();
    }

    public function all() {
        //news list view
        $filter = array();
        $this->form_validation->set_rules('filterOrderRefNo', 'language', 'trim');
        $this->form_validation->set_rules('filterOrderStatus', 'status', 'trim');
        $this->form_validation->set_rules('filterOrderedAt', 'ordered at', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['quotation_ref_no'] = $this->input->post('filterOrderRefNo');
            $filter['quotation_status'] = $this->input->post('filterOrderStatus');
            $filter['payment_status'] = $this->input->post('filterPaymentStatus');
            $filter['quotation_status'] = $this->input->post('filterOrderStatus');
            if ($this->input->post('filterOrderedAt') != '') {
                $filterOrderedAt = explode('-', $this->input->post('filterOrderedAt'));
                if (!empty($filterOrderedAt[0])) {
                    $filterOrderedAt[0] = str_replace('/', '-', $filterOrderedAt[0]);
                    $filter['from_quotationed_at'] = strtotime($filterOrderedAt[0]);
                }
                if (!empty($filterOrderedAt[1])) {
                    $filterOrderedAt[1] = str_replace('/', '-', $filterOrderedAt[1]);
                    $filter['to_quotationed_at'] = strtotime($filterOrderedAt[1]);
                }
            }
        }
        $this->data['quotations'] = $this->product_quotation_model->get_quotations($filter);
        $this->data['active_menu'] = 'product_quotation';
        $this->data['site_content'] = 'product_quotation';
        $this->load->view('panel/content', $this->data);
    }

    public function view($id) {
        $product_quotation_items = '';
        $filter = array();
        $filter['id'] = $id;
        $quotation = $this->product_quotation_model->get_quotation($filter);
        if (!$quotation) {
            redirect('panel/product_quotation/all');
        }
        $this->data['quotation'] = $quotation;
        $profile = $this->profile_model->get_profile($quotation->customer_id);
        $filter = array();
        $filter['quotation_id'] = $id;
        $quotation_details = $this->product_quotation_details_model->get_all($filter);
        if ($quotation_details) {
            $this->data['quotation_item_sl_no'] = 0;
            foreach ($quotation_details as $quotation_detail) {
                $this->data['quotation_item_sl_no']++;
                $this->data['quotation_detail'] = $quotation_detail;
                $quotation_product = $this->product_model->get($quotation_detail->product_id);
                $this->data['quotation_product'] = $quotation_product;
                $filter = array();
                $filter['quotation_details_id'] = $quotation_detail->id;
                $quotation_properties = $this->product_quotation_property_model->get_all($filter);
                $this->data['quotation_properties'] = $quotation_properties;
                $product_quotation_items .= $this->load->view('panel/view_product_quotation_item', $this->data, TRUE);
            }
        }
        $this->form_validation->set_rules('quotationStatus', 'order status', 'trim|required');
        $this->form_validation->set_rules('quotationNote', 'note', 'trim');
        if ($this->form_validation->run() === TRUE) {
            if ($quotation->quotation_status == 'P') {
                $filter = array();
                $filter['quotation_id'] = $id;
                $quotation_details = $this->product_quotation_details_model->get_all($filter);
                if ($quotation_details) {
                    foreach ($quotation_details as $quotation_detail) {
                        $selling_price = $this->input->post('qp_unit_price' . $quotation_detail->id);
                        $selling_price = $selling_price > 0 ? $selling_price : 0;
                        $input_data = array();
                        $input_data['selling_price'] = $selling_price;
                        $input_data['total'] = $selling_price * $quotation_detail->quotation_quantity;
                        $this->product_quotation_details_model->update($input_data, $quotation_detail->id);
                    }
                }
            }
            $input_data = array();
            $input_data['quotation_status'] = $this->input->post('quotationStatus');
            $input_data['note'] = $this->input->post('quotationNote');
            $this->product_quotation_model->update($input_data, $id);
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_quotation/view/' . $id, 'refresh');
        }
        $this->data['product_quotation_items'] = $product_quotation_items;
        $this->data['profile'] = $profile;
        $this->data['active_menu'] = 'product_quotation';
        $this->data['site_content'] = 'view_product_quotation';
        $this->load->view('panel/content', $this->data);
    }

}
