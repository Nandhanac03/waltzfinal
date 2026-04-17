<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_order extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_order_model', 'product_order_model');
        $this->load->model('Product_order_payment_model', 'product_order_payment_model');
        $this->load->model('Product_order_details_model', 'product_order_details_model');
        $this->load->model('product_order_property_model', 'product_order_property_model');
    }

    public function index() {
        $this->all();
    }

    public function all() {
        //news list view
        $filter = array();
        $this->form_validation->set_rules('filterOrderRefNo', 'language', 'trim');
        $this->form_validation->set_rules('filterOrderStatus', 'status', 'trim');
        $this->form_validation->set_rules('filterOrderedAt', 'order', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['order_ref_no'] = $this->input->post('filterOrderRefNo');
            $filter['order_status'] = $this->input->post('filterOrderStatus');
            $filter['payment_status'] = $this->input->post('filterPaymentStatus');
            $filter['order_status'] = $this->input->post('filterOrderStatus');
            if ($this->input->post('filterOrderedAt') != '') {
                $filterOrderedAt = explode('-', $this->input->post('filterOrderedAt'));
                if (!empty($filterOrderedAt[0])) {
                    $filterOrderedAt[0] = str_replace('/', '-', $filterOrderedAt[0]);
                    $filter['from_ordered_at'] = strtotime($filterOrderedAt[0]);
                }
                if (!empty($filterOrderedAt[1])) {
                    $filterOrderedAt[1] = str_replace('/', '-', $filterOrderedAt[1]);
                    $filter['to_ordered_at'] = strtotime($filterOrderedAt[1]);
                }
            }
        }
        $this->data['orders'] = $this->product_order_model->get_orders($filter);
        $this->data['active_menu'] = 'product_order';
        $this->data['site_content'] = 'product_order';
        $this->load->view('panel/content', $this->data);
    }

    public function view($id) {
        $product_order_items = '';
        $filter = array();
        $filter['id'] = $id;
        $order = $this->product_order_model->get_order($filter);
        $order_payment = $this->product_order_payment_model->get($order->id);
        $filter = array();
        $filter['order_id'] = $id;
        $order_details = $this->product_order_details_model->get_all($filter);
        if ($order_details) {
            $this->data['order_item_sl_no'] = 0;
            foreach ($order_details as $order_detail) {
                $this->data['order_item_sl_no']++;
                $this->data['order_detail'] = $order_detail;
                $order_product = $this->product_model->get($order_detail->product_id);
                $this->data['order_product'] = $order_product;
                $filter = array();
                $filter['order_details_id'] = $order_detail->id;
                $order_product_properties = $this->product_order_property_model->get_all($filter);
                $this->data['order_product_properties'] = $order_product_properties;
                $product_order_items .= $this->load->view('panel/view_product_order_item', $this->data, TRUE);
            }
        }
        $this->form_validation->set_rules('orderStatus', 'order status', 'trim|required');
        $this->form_validation->set_rules('paymentStatus', 'payment status', 'trim|required');
        $this->form_validation->set_rules('orderNote', 'note', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['payment_status'] = $this->input->post('paymentStatus');
            $this->product_order_payment_model->update($input_data,$order_payment->id);
            $input_data = array();
            $input_data['order_status'] = $this->input->post('orderStatus');
            $input_data['note'] = $this->input->post('orderNote');
            $this->product_order_model->update($input_data, $id);
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_order/all', 'refresh');
        }
        $this->data['product_order_items'] = $product_order_items;
        $this->data['order'] = $order;
        $this->data['order_payment'] = $order_payment;
        $this->data['active_menu'] = 'product_order';
        $this->data['site_content'] = 'view_product_order';
        $this->load->view('panel/content', $this->data);
    }

}
