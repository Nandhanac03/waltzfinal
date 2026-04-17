<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_variant extends CO_Panel_Controller
{

    function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_variant_model', 'product_variant_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Product_attribute_model', 'product_attribute_model');
        $this->load->model('Product_attribute_value_model', 'product_attribute_value_model');
        $this->load->model('Product_property_model', 'product_property_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['fileProductError'] = '';
        $this->data['fileProductLargeError'] = '';
        $this->data['productDocumentError'] = '';
        $this->data['productCoverImgError'] = '';
        $this->data['productBackCoverImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_pr_qty_per_unty'] = TRUE;
        $controller_config['disable_pr_manufacturer_retail_price'] = TRUE;
        $controller_config['disable_pr_cover_img'] = TRUE;
        $controller_config['disable_pr_unit_price'] = FALSE;
        $controller_config['disable_pr_units_in_stock'] = FALSE;
        $controller_config['disable_pr_discount'] = FALSE;
        $controller_config['disable_pr_selling_price'] = FALSE;
        $controller_config['disable_pr_attributes'] = FALSE;
        $controller_config['disable_pr_sku'] = TRUE;
        $controller_config['disable_pr_status'] = FALSE;
        $controller_config['disable_pr_languages'] = TRUE;
        $controller_config['disable_pr_code'] = TRUE;
        $this->data['controller_config'] = $controller_config;
        $this->data['active_menu_group'] = 'product_variant';

    }

    public function add($id = '', $lang = 1)
    {
        $product = $this->product_model->get($id, '', FALSE);
        if (!$product) {
            redirect('panel/product/all', 'refresh');
        }
        $all_variants = $this->product_variant_model->get_all($id, 1, false, false);
        if($all_variants){
            foreach ($all_variants as $key=>$variant){
                $filter=array();
                $filter['product_id']=$id;
                $filter['variant_id']=$variant->id;
                $all_properties = $this->product_property_model->get_all($filter);
                $all_variants[$key]->attributes=array();
                if($all_properties) {
                    foreach ($all_properties as $property) {
                        $variant_property=array();
                        $attribute = $this->product_attribute_model->get($property->attribute_id);
                        $attribute_value = $this->product_attribute_value_model->get($property->attribute_value_id);
                        $variant_property['attribute']=$attribute->title;
                        $variant_property['attribute_value']=$attribute_value->attribute_value;
                        array_push($all_variants[$key]->attributes,$variant_property);
                    }
                }
            }
        }
        //add product
        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    if($attribute->id==1){
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim|required');
                    }else {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim');
                    }
                }
            }
        }

        $this->form_validation->set_rules('productQuantityPerUnit', 'quantity per unit', 'trim');
        if ($this->data['controller_config']['disable_pr_unit_price'] != TRUE)
            $this->form_validation->set_rules('productUnitPrice', 'unit price', 'trim|required|numeric|greater_than_equal_to[0]');
        if ($this->data['controller_config']['disable_pr_selling_price'] != TRUE)
            $this->form_validation->set_rules('productSellingPrice', 'selling price', 'trim|required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productManufacturerRetailPrice', 'manufacturer retail price', 'trim');
        $this->form_validation->set_rules('productUnitsInStock', 'in stock', 'trim|is_natural');
        $this->form_validation->set_rules('productDiscount', 'discount', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productSKU', 'SKU', 'trim');
        if ($this->form_validation->run() === TRUE) {
            if($this->check_product_variant_exits($id)){
                $this->session->set_flashdata('error', 'Product variant already exists.');
                redirect('panel/product_variant/add/' . $id . '/' .  $lang, 'refresh');
            }
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['product_id'] = $id;
            $input_data['sku'] = '';
            $input_data['quantity_per_unit'] = $this->input->post('productQuantityPerUnit');
            $input_data['unit_price'] = $this->input->post('productUnitPrice');
            $input_data['selling_price'] = $this->input->post('productSellingPrice');
            $input_data['manufacturer_retail_price'] = $this->input->post('productManufacturerRetailPrice');
            $input_data['discount'] = $this->input->post('productDiscount');
            $input_data['units_in_stock'] = $this->input->post('productUnitsInStock');
            $input_data['sku'] = $this->input->post('productSKU');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['updated_by'] = '';
            $input_data['updated_at'] = '';
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['productCoverImg']) && $_FILES['productCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productCoverImg', 'file' => &$_FILES['productCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_cover'] = $file_name;
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $variant_id = $this->product_variant_model->add($input_data);
            if ($variant_id > 0) {
                $this->save_product_property($id, $variant_id);
                $product_code = $product->product_code . '-' . $variant_id;
                $input_data = array();
                $input_data['product_code'] = $product_code;
                $this->product_variant_model->update($input_data, $id);
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/product_variant/add/' . $id . '/' .  $lang, 'refresh');
            }
        }
        $html_product_attributes = $this->generate_attributes();
        $this->data['html_product_attributes'] = $html_product_attributes;
        $this->data['current_language'] = $current_language;
        $this->data['id'] = $id;
        $this->data['product'] = $product;
        $this->data['all_variants'] = $all_variants;
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'product_variant';
        $this->data['site_content'] = 'add_product_variant';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $variant_id = '', $lang = 1)
    {
        $product = $this->product_model->get($id, '', FALSE);
        if (!$product) {
            redirect('panel/product/all', 'refresh');
        }
        //edit product details
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_variant_product = $this->product_variant_model->get($variant_id, '', FALSE);
            $product_variant = $parent_variant_product;
        } else if ($id > 0 && $lang > 0) {
            $parent_variant_product = $this->product_variant_model->get($variant_id, '', FALSE);
            if ($parent_variant_product) {
                $language_parent = $variant_id;
                $product_variant = $this->product_variant_model->get_by_parent($variant_id, $lang, FALSE);
            }
        } else {
            redirect('panel/product/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_variant_product || !$current_language) {
            redirect('panel/product/all', 'refresh');
        }
        if ($lang != 1) {
            $this->data['controller_config']['disable_pr_qty_per_unty'] = TRUE;
            $this->data['controller_config']['disable_pr_manufacturer_retail_price'] = TRUE;
            $this->data['controller_config']['disable_pr_cover_img'] = TRUE;
            $this->data['controller_config']['disable_pr_unit_price'] = TRUE;
            $this->data['controller_config']['disable_pr_units_in_stock'] = TRUE;
            $this->data['controller_config']['disable_pr_discount'] = TRUE;
            $this->data['controller_config']['disable_pr_selling_price'] = TRUE;
            $this->data['controller_config']['disable_pr_attributes'] = TRUE;
            $this->data['controller_config']['disable_pr_related_product'] = TRUE;
            $this->data['controller_config']['disable_pr_status'] = TRUE;
            $this->data['controller_config']['disable_pr_sku'] = TRUE;
            $this->data['controller_config']['disable_pr_languages'] = TRUE;
        }

        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $product_languages = $this->product_variant_model->get_languages($id);
        $tmp_product_attributes_value = $this->product_property_model->get_attributes_value($id);
        $product_attributes_value = array();
        if ($tmp_product_attributes_value) {
            $product_attributes_value = explode(',', $tmp_product_attributes_value->attributes_value);
        }
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    if($attribute->id==1){
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim|required');
                    }else {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim');
                    }
                }
            }
        }
        $this->form_validation->set_rules('productQuantityPerUnit', 'quantity per unit', 'trim');
        if ($this->data['controller_config']['disable_pr_unit_price'] != TRUE)
            $this->form_validation->set_rules('productUnitPrice', 'unit price', 'trim|required|numeric|greater_than_equal_to[0]');
        if ($this->data['controller_config']['disable_pr_selling_price'] != TRUE)
            $this->form_validation->set_rules('productSellingPrice', 'selling price', 'trim|required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productManufacturerRetailPrice', 'manufacturer retail price', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productUnitsInStock', 'in stock', 'trim|is_natural');
        $this->form_validation->set_rules('productDiscount', 'discount', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productSKU', 'SKU', 'trim');
        $this->form_validation->set_rules('productSatus', 'status', 'trim');
        if ($this->form_validation->run() === TRUE) {
            if($this->check_product_variant_exits($id)){
                $this->session->set_flashdata('error', 'Same product variant exists.');
                redirect('panel/product_variant/edit/' . $id . '/' . $variant_id . '/' . $lang, 'refresh');
            }
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['sku'] = '';
            $input_data['quantity_per_unit'] = $this->input->post('productQuantityPerUnit');
            $input_data['unit_price'] = $this->input->post('productUnitPrice');
            $input_data['selling_price'] = $this->input->post('productSellingPrice');
            $input_data['manufacturer_retail_price'] = $this->input->post('productManufacturerRetailPrice');
            $input_data['discount'] = $this->input->post('productDiscount');
            $input_data['units_in_stock'] = $this->input->post('productUnitsInStock');
            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['productCoverImg']) && $_FILES['productCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productCoverImg', 'file' => &$_FILES['productCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_cover'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product_variant->product_cover) && !empty($product->product_cover)) {
                        unlink('./assets/uploads/product/' . $product_variant->product_cover);
                        unlink('./assets/uploads/product/thumb_' . $product_variant->product_cover);
                    }
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($product) {
                $input_data['updated_by'] = time();
                $input_data['updated_at'] = $_SESSION['user_id'];
                $this->product_variant_model->update($input_data, $product_variant->id);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->product_variant_model->add($input_data);
            }
            if ($id > 0) {
                $this->save_product_property($product->id, $parent_variant_product->id);
                if ($this->input->post('productStatus') == 'Y') {
                    $this->activate_product($id);
                } else if ($this->input->post('productStatus') == 'N') {
                    $this->deactivate_product($id);
                }
            } else {
                $no_error = FALSE;
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/product_variant/edit/' . $id . '/' . $variant_id . '/' . $lang, 'refresh');
            }
        }
        $this->data['product_attributes_value'] = $product_attributes_value;
        $html_product_attributes = $this->generate_attributes();
        $this->data['html_product_attributes'] = $html_product_attributes;
        $this->data['product_languages'] = explode(',', $product_languages->languages);
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['parent_variant_product'] = $parent_variant_product;
        $this->data['product_variant'] = $product_variant;
        $this->data['active_menu'] = 'product_variant';
        $this->data['site_content'] = 'edit_product_variant';
        $this->load->view('panel/content', $this->data);
    }


    public function delete_cover_img($id, $lang = '1')
    {
        //edit product based on language
        if ($id > 0 && $lang == '1') {
            $product_variant = $this->product_varaint_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $product_variant = $this->product_varaint_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/product/all', 'refresh');
        }
        if (file_exists('./assets/uploads/product/' . $product_variant->product_cover) && !empty($product_variant->product_cover)) {
            unlink('./assets/uploads/product/' . $product_variant->product_cover);
            unlink('./assets/uploads/product/thumb_' . $product_variant->product_cover);
        }
        $input_data['product_cover'] = '';
        $this->product_varaint_model->update($input_data, $product_variant->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/product_variant/edit/' . $product_variant->product_id . '/' . $id . '/' . $lang, 'refresh');
    }

    private function generate_attributes()
    {
        $attribute_generated = '';
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $key=>$attribute) {
                $all_attributes[$key]->is_required=0;
                if($attribute->id==1){
                    $all_attributes[$key]->is_required=1;
                }
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    $this->data['attribute'] = $attribute;
                    $this->data['attribute_values'] = $attribute_values;
                    $attribute_generated .= $this->load->view('panel/generate_product_attribute', $this->data, TRUE);
                }
            }
        }
        return $attribute_generated;
    }
    private function check_product_variant_exits($product_id)
    {
        $filter=array();
        $filter['product_id']=$product_id;
        $all_properties = $this->product_property_model->get_all($filter);
        $all_attributes = $this->product_attribute_model->get_all();
        $variant_exits=true;
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_value_id = $this->input->post('productAttribute' . $attribute->id);
                if($all_properties) {
                    foreach ($all_properties as $all_property) {
                        if ($attribute_value_id != $all_property->attribute_value_id) {
                            $variant_exits=false;
                            break;
                        }
                    }
                }else{
                    $variant_exits=false;
                }
            }
        }
        return $variant_exits;
    }
    private function save_product_property($product_id, $product_variant_id = '')
    {
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    $attribute_value_id = $this->input->post('productAttribute' . $attribute->id);
                    if ($attribute_value_id) {
                        $input_data = array();
                        $input_data['attribute_id'] = $attribute->id;
                        $input_data['attribute_value_id'] = $attribute_value_id;
                        $input_data['product_id'] = $product_id;
                        $input_data['variant_id'] = $product_variant_id;
                        $input_data['active'] = 1;
                        $product_property = $this->product_property_model->check_property_exists($attribute->id, '', $product_id);
                        if ($product_property) {
                            if ($product_property->attribute_value_id != $attribute_value_id) {
                                $input_data['updated_by'] = $_SESSION['user_id'];
                                $input_data['updated_at'] = time();
                                $this->product_property_model->update($input_data, $product_property->id);
                            }
                        } else {
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['created_at'] = time();
                            $this->product_property_model->add($input_data);
                        }
                    } else {
                        $this->product_property_model->remove_variant($product_id, $attribute->id);
                    }
                }
            }
        }
    }

    public function activate_product($id)
    {
        $this->product_model->enable($id);
        $this->session->set_flashdata('success', 'Enabled successfully.');
    }

    public function deactivate_product($id)
    {
        $this->product_model->disable($id);
        $this->session->set_flashdata('success', 'Disabled successfully.');
    }
}
