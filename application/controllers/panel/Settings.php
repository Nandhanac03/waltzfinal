<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Settings_model', 'settings_model');
        $this->load->model('Product_shipping_charge_model', 'product_shipping_charge_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_setting_vat'] = TRUE;
        $controller_config['disable_setting_order_email'] = TRUE;
        $controller_config['disable_setting_quotation_email'] = TRUE;
        $controller_config['disable_setting_call_us'] = TRUE;
        $controller_config['disable_setting_contact_email'] = FALSE;
        $controller_config['disable_setting_shipping_charge'] = TRUE;
        $controller_config['disable_setting_copyright'] = true;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
 
        $settings = $this->settings_model->get(1);
        $this->form_validation->set_rules('settingVat', 'VAT', 'trim');
        $this->form_validation->set_rules('settingContactEmail', 'contact email', 'trim');
        $this->form_validation->set_rules('settingOrderEmail', 'order email', 'trim');
        $this->form_validation->set_rules('settingQuotationEmail', 'quotation email', 'trim');
        $this->form_validation->set_rules('settingCallUs', 'call us', 'trim');
        $this->form_validation->set_rules('shippingCharge', 'shipping charge', 'trim');
        $this->form_validation->set_rules('copyRight', 'copy right', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['vat'] = $this->input->post('settingVat');
            $input_data['contact_email'] = $this->input->post('settingContactEmail');
            $input_data['order_email'] = $this->input->post('settingOrderEmail');
            $input_data['quotation_email'] = $this->input->post('settingQuotationEmail');
            $input_data['call_us'] = $this->input->post('settingCallUs');
            $input_data['copyright'] = $this->input->post('copyRight');
            $this->settings_model->update($input_data, 1);

            $input_data = array();
            $input_data['rate'] = $this->input->post('shippingCharge');
            $this->product_shipping_charge_model->update($input_data, 2);
            $this->session->set_flashdata('success', 'Updated Successfully.');
            redirect('panel/settings');
        }
        $shipping_charge = $this->product_shipping_charge_model->get(2);
        $this->data['shipping_charge'] = $shipping_charge;
        $this->data['settings'] = $settings;
        $this->data['active_menu'] = 'settings';
        $this->data['site_content'] = 'settings';
        $this->load->view('panel/content', $this->data);
    }
}
