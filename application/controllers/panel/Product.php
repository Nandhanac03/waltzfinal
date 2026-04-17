<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CO_Panel_Controller
{

    function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Brand_model', 'brand_model');
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_category_model', 'product_category_model');
        $this->load->model('Product_file_model', 'product_file_model');
        $this->load->model('Product_file_description_model', 'product_file_description_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Product_group_model', 'product_group_model');
        $this->load->model('Product_attribute_model', 'product_attribute_model');
        $this->load->model('Product_attribute_value_model', 'product_attribute_value_model');
        $this->load->model('Product_property_model', 'product_property_model');
        $this->load->model('Bio_model', 'bio_model');
        $this->load->model('Product_cart_model', 'product_cart_model');
        $this->load->model('Profile_model', 'profile_model');
        $this->load->model('Country_model', 'country_model');
        $this->load->model('Product_shipping_charge_model', 'product_shipping_charge_model');
        $this->load->model('Product_order_model', 'product_order_model');
        $this->load->model('Product_order_details_model', 'product_order_details_model');
        $this->load->model('Product_order_payment_model', 'product_order_payment_model');
        $this->load->model('product_order_property_model', 'product_order_property_model');
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
        $controller_config['disable_pr_title'] = FALSE;
        $controller_config['disable_pr_slugtitle'] = FALSE;
        $controller_config['disable_pr_note'] = FALSE;
        $controller_config['disable_pr_languages'] = FALSE;
        $controller_config['disable_pr_category'] = true;
        $controller_config['disable_pr_brand'] = TRUE;
        $controller_config['disable_pr_code'] = TRUE;
        $controller_config['disable_pr_subtitle'] = TRUE;
        $controller_config['disable_pr_short_desc'] = FALSE;
        $controller_config['disable_pr_additonal_info'] = true;
        $controller_config['disable_pr_qty_per_unty'] = TRUE;
        $controller_config['disable_pr_manufacturer_retail_price'] = TRUE;
        $controller_config['disable_pr_cover_img'] = FALSE;
        $controller_config['disable_pr_back_cover_img'] = TRUE;
        $controller_config['disable_pr_document'] = FALSE;
        $controller_config['disable_pr_group'] = TRUE;
        $controller_config['disable_pr_images'] = FALSE;
        $controller_config['disable_pr_img_languages'] = TRUE;
        $controller_config['disable_pr_img_file_description'] = TRUE;
        $controller_config['disable_pr_img_file_lg'] = FALSE;
        $controller_config['disable_pr_unit_price'] = true;
        $controller_config['disable_pr_units_in_stock'] = true;
        $controller_config['disable_pr_discount'] = true;
        $controller_config['disable_pr_selling_price'] = true;
        $controller_config['disable_pr_attributes'] = true;
        $controller_config['disable_pr_related_product'] = true;
        $controller_config['disable_pr_isbn'] = TRUE;
        $controller_config['disable_pr_sku'] = TRUE;
        $controller_config['disable_pr_author'] = TRUE;
        $controller_config['disable_pr_illustrator'] = TRUE;
        $controller_config['disable_pr_status'] = FALSE;
        $controller_config['disable_pr_binding'] = TRUE;
        $controller_config['disable_pr_no_pages'] = TRUE;
        $controller_config['disable_pr_variant'] = TRUE;
        $controller_config['disable_pr_seo'] = TRUE;
        $controller_config['disable_pr_canonical_url'] = true;
        $controller_config['disable_pr_home_display'] = true;
        $this->data['controller_config'] = $controller_config;

        $this->data['active_menu_group'] = 'product';
        $parent_categories = $this->product_category_model->get_all(TRUE);
        $this->data['product_categories'] = $this->get_all_categories($parent_categories);
    }

    public function index()
    {
        redirect('panel/product/all');
    }

    public function all()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        // echo"<pre>";print_r($_POST);exit;
        //product list view
        $categories = $this->product_category_model->get_all();
        // echo"<pre>";print_r($categories);exit;
        $brands = $this->brand_model->get_all();
        $filter = array();
        $filter['language_id'] = 1;
        $this->form_validation->set_rules('filterProductCategory', 'type', 'trim');
        $this->form_validation->set_rules('filterProductCreatedAt', 'created_at', 'trim');
        $this->form_validation->set_rules('filterProductTitle', 'title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['category_id'] = $this->input->post('filterProductCategory');
            $filter['brand_id'] = $this->input->post('filterProductBrand');
            $filter['product_title'] = $this->input->post('filterProductTitle');
            $product_created_at = $this->input->post('filterProductCreatedAt');
            if ($this->input->post('filterProductStatus')) {
                $filter['active'] = $this->input->post('filterProductStatus') == 'Y' ? 1 : '';
            }
            if ($product_created_at != '') {
                $filterProductCreatedAt = explode('-', $product_created_at);
                if (!empty($filterProductCreatedAt[0])) {
                    $filterProductCreatedAt[0] = str_replace('/', '-', $filterProductCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filterProductCreatedAt[0]);
                }
                if (!empty($filterProductCreatedAt[1])) {
                    $filterProductCreatedAt[1] = str_replace('/', '-', $filterProductCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filterProductCreatedAt[1]);
                }
            }
        }
        // echo "<pre>";
        // print_r($filter);
        // exit;
        $products = $this->product_model->get_all_product($filter);
        $this->data['brands'] = $brands;
        $this->data['products'] = $products;
        $this->data['categories'] = $categories;;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'product';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_get_products_list()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $filter['search_product'] = trim($this->input->post('search_product'));
        $products = $this->product_model->get_by_lang($filter);
        $result = array();
        if ($products) {
            foreach ($products as $product) {
                $produt_result = array();
                $produt_result['id'] = $product->id;
                $produt_result['text'] = $product->product_name;
                array_push($result, $produt_result);
            }
        }
        echo json_encode($result);
    }

    public function add($lang = 1)
    {
        //  if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        //  }
        //add product
        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $categories = $this->product_category_model->get_all();

        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    if ($attribute->id == 1) {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim|required');
                    } else {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim');
                    }
                }
            }
        }
        if ($this->data['controller_config']['disable_pr_category'] != TRUE)
            $this->form_validation->set_rules('productCategory', 'category', 'trim');
        $this->form_validation->set_rules('productName', 'name', 'trim|required');

        $this->form_validation->set_rules('productSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('productSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('productShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('productDescription', 'description', 'trim');

        $this->form_validation->set_rules('productSeoTitle', 'seo title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('productSeoMetaKeywords', 'meta keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoMetaDescription', 'meta description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoCanonicalUrl', 'canonical url', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['sku'] = '';
            $input_data['product_name'] = $this->input->post('productName');
            // $input_data['title'] = $this->input->post('productTitle');
            $input_data['title_slug'] = $this->input->post('productSlugTitle');
            $input_data['subtitle'] = $this->input->post('productSubtitle');
            $input_data['short_desc'] = $this->input->post('productShortDesc');
            $input_data['description'] = $this->input->post('productDescription');
            $input_data['note'] = $this->input->post('productNote');

            $input_data['seo_title'] = $this->input->post('productSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('productSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('productSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('productSeoCanonicalUrl');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['updated_by'] = '';
            $input_data['updated_at'] = '';
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            // echo"<pre>";print_r($input_data);exit;

            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
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

            if ($no_error == true) {
                $id = $this->product_model->add($input_data);
            }
            if ($id > 0) {
                // $this->save_product_property($id);
                $product_code = 'P' . date('y') . rand(0, 99) . $id;
                $input_data = array();
                $input_data['product_code'] = $product_code;
                $this->product_model->update($input_data, $id);
                $file_count = $this->input->post('productFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/product';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['productFile_' . $i]) && $_FILES['productFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'productFile_' . $i, 'file' => &$_FILES['productFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['product_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->product_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('productFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['language'] = $lang;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->product_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
                }

                //upload document files
                // $config = array();
                // $config['upload_path'] = 'assets/uploads/document';
                // $config['allowed_types'] = 'pdf';
                // $config['encrypt_name'] = TRUE;
                // $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                // if (!empty($_FILES['productDocumentFile']['name'][0])) {
                //     $file_count = count($_FILES['productDocumentFile']['name']);
                //     for ($i = 0; $i < $file_count; $i++) {
                //         $_FILES['documentFile']['name'] = &$_FILES['productDocumentFile']['name'][$i];
                //         $_FILES['documentFile']['type'] = &$_FILES['productDocumentFile']['type'][$i];
                //         $_FILES['documentFile']['tmp_name'] = &$_FILES['productDocumentFile']['tmp_name'][$i];
                //         $_FILES['documentFile']['error'] = &$_FILES['productDocumentFile']['error'][$i];
                //         $_FILES['documentFile']['size'] = &$_FILES['productDocumentFile']['size'][$i];
                //         $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                //         $upload_result = file_upload($file_info, $config);
                //         if (!$upload_result['error']) {
                //             $file_name = $upload_result['file_name'];
                //             $input_data = array();
                //             $input_data['product_id'] = $id;
                //             $input_data['file'] = $file_name;
                //             $input_data['file_for'] = "O";
                //             $input_data['file_type'] = "O";
                //             $input_data['created_at'] = time();
                //             $input_data['created_by'] = $_SESSION['user_id'];
                //             $input_data['active'] = 1;
                //             $file_id = $this->product_file_model->add($input_data);
                //             if ($file_id > 0) {
                //                 $input_data = array();
                //                 $input_data['title'] = 'Document';
                //                 $input_data['file_id'] = $file_id;
                //                 $input_data['language'] = $lang;
                //                 $input_data['created_at'] = time();
                //                 $input_data['created_by'] = $_SESSION['user_id'];
                //                 $input_data['active'] = 1;
                //                 $this->product_file_description_model->add($input_data);
                //             }
                //         }
                //     }
                // }

                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');

                // Initialize error array
                $productDocumentError = array();

                if (!empty($_FILES['productDocumentFile']['name'][0])) {
                    $file_count = count($_FILES['productDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['productDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['productDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['productDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['productDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['productDocumentFile']['size'][$i];

                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);

                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array(
                                'product_id' => $id,
                                'file' => $file_name,
                                'file_for' => "O",
                                'file_type' => "O",
                                'created_at' => time(),
                                'created_by' => $_SESSION['user_id'],
                                'active' => 1
                            );
                            $file_id = $this->product_file_model->add($input_data);

                            if ($file_id > 0) {
                                $input_data = array(
                                    'title' => 'Document',
                                    'file_id' => $file_id,
                                    'language' => $lang,
                                    'created_at' => time(),
                                    'created_by' => $_SESSION['user_id'],
                                    'active' => 1
                                );
                                $this->product_file_description_model->add($input_data);
                            }
                        } else {

                            function getUploadErrorMessage($error_code)
                            {
                                switch ($error_code) {
                                    case UPLOAD_ERR_OK:
                                        return 'There is no error, the file uploaded successfully.';
                                    case UPLOAD_ERR_INI_SIZE:
                                        return 'The uploaded file exceeds the maximum allowed size. maximux size is'.config_item('MAX_IMG_FILE_SIZE_MSG');
                                    case UPLOAD_ERR_FORM_SIZE:
                                        return 'The uploaded file exceeds the maximum size specified in the form.';
                                    case UPLOAD_ERR_PARTIAL:
                                        return 'The uploaded file was only partially uploaded.';
                                    case UPLOAD_ERR_NO_FILE:
                                        return 'No file was uploaded.';
                                    case UPLOAD_ERR_NO_TMP_DIR:
                                        return 'Missing a temporary folder.';
                                    case UPLOAD_ERR_CANT_WRITE:
                                        return 'Failed to write file to disk.';
                                    case UPLOAD_ERR_EXTENSION:
                                        return 'File upload stopped by a PHP extension.';
                                    default:
                                        return 'Unknown upload error.';
                                }
                            }
                            // Store error for this file
                            $productDocumentError[] = array(
                                'file_name' => $_FILES['documentFile']['name'],
                                'error_message' => getUploadErrorMessage($_FILES['documentFile']['error'])
                            );

                            $this->data['productDocumentError'] = $productDocumentError;
                            // echo '<pre>';print_r($productDocumentError);exit;
                            $no_error = FALSE;
                        }
                    }
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
                redirect('panel/product/all', 'refresh');
            }
        }
        $this->data['categories'] = $categories;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'add_product';
        $this->load->view('panel/content', $this->data);
    }
    public function add_bckup_05_08_2024($lang = 1)
    {
        // if($_POST){
        //     echo"<pre>";print_r($_POST);exit;
        // }
        //add product
        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $categories = $this->product_category_model->get_all();
        $brands = $this->brand_model->get_all();
        $product_groups = $this->product_group_model->get_all();
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $attribute) {
                $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                if ($attribute_values) {
                    if ($attribute->id == 1) {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim|required');
                    } else {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim');
                    }
                }
            }
        }
        $filter = array();
        $filter['person_is'] = 'A';
        $authors = $this->bio_model->get_all($filter);
        $filter = array();
        $filter['person_is'] = 'I';
        $illustrators = $this->bio_model->get_all($filter);
        if ($this->data['controller_config']['disable_pr_category'] != TRUE)
            $this->form_validation->set_rules('productCategory', 'category', 'trim');
        $this->form_validation->set_rules('productName', 'name', 'trim|required');
        $this->form_validation->set_rules('productTitle', 'title', 'trim');
        //$this->form_validation->set_rules('productSlugTitle', 'slug title', 'trim|is_unique[product.title_slug]');
        $this->form_validation->set_rules('productSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('productSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('productShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('productDescription', 'description', 'trim');
        $this->form_validation->set_rules('productAdditonalInfo', 'additonal information', 'trim');
        $this->form_validation->set_rules('productBinding', 'binding', 'trim');
        $this->form_validation->set_rules('productNoPages', 'no. of pages', 'trim|is_natural');
        $this->form_validation->set_rules('productQuantityPerUnit', 'quantity per unit', 'trim');
        if ($this->data['controller_config']['disable_pr_unit_price'] != TRUE)
            $this->form_validation->set_rules('productUnitPrice', 'unit price', 'trim|numeric|greater_than_equal_to[0]');
        if ($this->data['controller_config']['disable_pr_selling_price'] != TRUE)
            $this->form_validation->set_rules('productSellingPrice', 'selling price', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productManufacturerRetailPrice', 'manufacturer retail price', 'trim');
        $this->form_validation->set_rules('productUnitsInStock', 'in stock', 'trim|is_natural');
        $this->form_validation->set_rules('productNote', 'note', 'trim');
        $this->form_validation->set_rules('productAvailable', 'product available', 'trim');
        $this->form_validation->set_rules('productDiscount', 'discount', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productBrand', 'brand', 'trim');
        $this->form_validation->set_rules('productGroup[]', 'group', 'trim');
        $this->form_validation->set_rules('productAuthor', 'author', 'trim');
        $this->form_validation->set_rules('productHomeDisplay', 'home_display', 'trim');
        $this->form_validation->set_rules('productIllustrator', 'illustrator', 'trim');
        $this->form_validation->set_rules('productISBN', 'ISBN', 'trim');
        $this->form_validation->set_rules('productSKU', 'SKU', 'trim');
        $this->form_validation->set_rules('productRelated[]', 'related products', 'trim');
        $this->form_validation->set_rules('productSeoTitle', 'seo title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('productSeoMetaKeywords', 'meta keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoMetaDescription', 'meta description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoCanonicalUrl', 'canonical url', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['sku'] = '';
            $input_data['product_name'] = $this->input->post('productName');
            $input_data['title'] = $this->input->post('productTitle');
            $input_data['title_slug'] = $this->input->post('productSlugTitle');
            $input_data['subtitle'] = $this->input->post('productSubtitle');
            $input_data['short_desc'] = $this->input->post('productShortDesc');
            $input_data['description'] = $this->input->post('productDescription');
            $input_data['additonal_info'] = $this->input->post('productAdditonalInfo');
            $input_data['binding'] = $this->input->post('productBinding');
            $input_data['no_of_pages'] = $this->input->post('productNoPages');
            // $input_data['category_id'] = $this->input->post('productCategory');
            $input_data['category_id'] = $this->input->post('productCategory');
            $input_data['home_display'] = $this->input->post('productHomeDisplay');
            if (empty($input_data['home_display'])) {
                $input_data['home_display'] = 0;
            }
            $tmp_product_group = $this->input->post('productGroup[]');
            if ($tmp_product_group) {
                $tmp_product_group = implode(',', $tmp_product_group);
            } else {
                $tmp_product_group = '';
            }
            $input_data['product_group'] = $tmp_product_group;
            $input_data['brand_id'] = $this->input->post('productBrand');
            $input_data['quantity_per_unit'] = $this->input->post('productQuantityPerUnit');
            $input_data['unit_price'] = $this->input->post('productUnitPrice');
            $input_data['selling_price'] = $this->input->post('productSellingPrice');
            $input_data['manufacturer_retail_price'] = $this->input->post('productManufacturerRetailPrice');
            $input_data['discount'] = $this->input->post('productDiscount');
            $input_data['units_in_stock'] = $this->input->post('productUnitsInStock');
            $input_data['ranking'] = '';
            $input_data['note'] = $this->input->post('productNote');
            $input_data['author'] = $this->input->post('productAuthor');
            $input_data['illustrator'] = $this->input->post('productIllustrator');
            $input_data['isbn'] = $this->input->post('productISBN');
            $input_data['sku'] = $this->input->post('productSKU');
            $related_product = $this->input->post('productRelated[]');
            if ($related_product) {
                $related_product = implode(',', $related_product);
            }
            $input_data['related_product'] = $related_product;
            $input_data['seo_title'] = $this->input->post('productSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('productSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('productSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('productSeoCanonicalUrl');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['updated_by'] = '';
            $input_data['updated_at'] = '';
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            // echo"<pre>";print_r($input_data);exit;
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 2040;
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
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
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['productBackCoverImg']) && $_FILES['productBackCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productBackCoverImg', 'file' => &$_FILES['productBackCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_back_cover'] = $file_name;
                } else {
                    $this->data['productBackCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == true) {
                $id = $this->product_model->add($input_data);
            }
            if ($id > 0) {
                // $this->save_product_property($id);
                $product_code = 'P' . date('y') . rand(0, 99) . $id;
                $input_data = array();
                $input_data['product_code'] = $product_code;
                $this->product_model->update($input_data, $id);
                $file_count = $this->input->post('productFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/product';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['productFile_' . $i]) && $_FILES['productFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'productFile_' . $i, 'file' => &$_FILES['productFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['product_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->product_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('productFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['language'] = $lang;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->product_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
                    //upload document files
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/documents';
                    $config['allowed_types'] = 'pdf';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    if (!empty($_FILES['productDocumentFile']['name'][0])) {
                        $file_count = count($_FILES['productDocumentFile']['name']);
                        for ($i = 0; $i < $file_count; $i++) {
                            $_FILES['documentFile']['name'] = &$_FILES['productDocumentFile']['name'][$i];
                            $_FILES['documentFile']['type'] = &$_FILES['productDocumentFile']['type'][$i];
                            $_FILES['documentFile']['tmp_name'] = &$_FILES['productDocumentFile']['tmp_name'][$i];
                            $_FILES['documentFile']['error'] = &$_FILES['productDocumentFile']['error'][$i];
                            $_FILES['documentFile']['size'] = &$_FILES['productDocumentFile']['size'][$i];
                            $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                            $upload_result = file_upload($file_info, $config);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['product_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "O";
                                $input_data['file_type'] = "O";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->product_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = 'Document';
                                    $input_data['file_id'] = $file_id;
                                    $input_data['language'] = $lang;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->product_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
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
                redirect('panel/product/all', 'refresh');
            }
        }
        $html_product_attributes = $this->generate_attributes();
        $this->data['html_product_attributes'] = $html_product_attributes;
        $this->data['product_groups'] = $product_groups;
        $this->data['brands'] = $brands;
        $this->data['categories'] = $categories;
        $this->data['authors'] = $authors;
        $this->data['illustrators'] = $illustrators;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'add_product';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        

        //edit product details
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_product = $this->product_model->get($id, '', FALSE);
            $product = $parent_product;
        } else if ($id > 0 && $lang > 0) {
            $parent_product = $this->product_model->get($id, '', FALSE);
            if ($parent_product) {
                $language_parent = $id;
                $product = $this->product_model->get_by_parent($id, $lang, FALSE);
            }
        } else {
            redirect('panel/product/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_product || !$current_language) {
            redirect('panel/product/all', 'refresh');
        }
        if ($lang != 1) {
            $this->data['controller_config']['disable_pr_category'] = TRUE;
            $this->data['controller_config']['disable_pr_title'] = TRUE;
            $this->data['controller_config']['disable_pr_brand'] = TRUE;
            $this->data['controller_config']['disable_pr_code'] = TRUE;
            $this->data['controller_config']['disable_pr_slugtitle'] = TRUE;
            $this->data['controller_config']['disable_pr_qty_per_unty'] = TRUE;
            $this->data['controller_config']['disable_pr_manufacturer_retail_price'] = TRUE;
            $this->data['controller_config']['disable_pr_cover_img'] = TRUE;
            $this->data['controller_config']['disable_pr_back_cover_img'] = TRUE;
            $this->data['controller_config']['disable_pr_document'] = TRUE;
            $this->data['controller_config']['disable_pr_group'] = TRUE;
            $this->data['controller_config']['disable_pr_images'] = TRUE;
            $this->data['controller_config']['disable_pr_unit_price'] = TRUE;
            $this->data['controller_config']['disable_pr_units_in_stock'] = TRUE;
            $this->data['controller_config']['disable_pr_discount'] = TRUE;
            $this->data['controller_config']['disable_pr_selling_price'] = TRUE;
            $this->data['controller_config']['disable_pr_attributes'] = TRUE;
            $this->data['controller_config']['disable_pr_related_product'] = TRUE;
            $this->data['controller_config']['disable_pr_status'] = TRUE;
            $this->data['controller_config']['disable_pr_isbn'] = TRUE;
            $this->data['controller_config']['disable_pr_sku'] = TRUE;
            $this->data['controller_config']['disable_pr_seo'] = FALSE;
        }

        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $product_languages = $this->product_model->get_languages($id);
        $categories = $this->product_category_model->get_all();
        $product_images = $this->product_file_model->get_files(array('product_id' => $id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $product_documents = $this->product_file_model->get_files(array('product_id' => $id, 'file_for' => 'O', 'file_type' => 'O', 'active' => 1, 'language' => $lang));
        $tmp_product_attributes_value = $this->product_property_model->get_attributes_value($id);
        $this->data['product_images'] = $product_images;
        $this->data['product_documents'] = $product_documents;

        $filter = array();
        $filter['person_is'] = 'A';
        $authors = $this->bio_model->get_all($filter);
        $filter = array();
        $filter['person_is'] = 'I';
        $illustrators = $this->bio_model->get_all($filter);
        if ($this->data['controller_config']['disable_pr_category'] != TRUE)
            $this->form_validation->set_rules('productCategory', 'Category', 'trim');
        // $this->form_validation->set_rules('productBrand', 'Brand', 'trim');
        $this->form_validation->set_rules('productName', 'Name', 'trim|required');
        $this->form_validation->set_rules('productSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('productSubtitle', 'Subtitle', 'trim');
        $this->form_validation->set_rules('productShortDesc', 'Short Description', 'trim');
        $this->form_validation->set_rules('productDescription', ' Description', 'trim');

        $this->form_validation->set_rules('productSeoTitle', 'seo title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('productSeoMetaKeywords', 'meta keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoMetaDescription', 'meta description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoCanonicalUrl', 'canonical url', 'trim');
        // $this->form_validation->set_rules('productHomeDisplay', 'home_display', 'trim');
        //print_r($_POST);
        //exit;
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['product_name'] = $this->input->post('productName');
            // $input_data['title'] = $this->input->post('productTitle');
            $input_data['title_slug'] = $this->input->post('productSlugTitle');
            $input_data['subtitle'] = $this->input->post('productSubtitle');
            $input_data['short_desc'] = $this->input->post('productShortDesc');
            $input_data['description'] = $this->input->post('productDescription');
            $input_data['note'] = $this->input->post('productNote');

            if ($lang != 1) {
                $input_data['language_parent'] = $language_parent;
            } else {
                $input_data['language_parent'] = '';
            }
            if (isset($_POST['productStatus'])) {
                if ($_POST['productStatus'] == 'Y') {
                    $product_status = 1;
                } else {
                    $product_status = 0;
                }
            }
            $input_data['language'] = $lang;
            $input_data['active'] = $product_status;
            $config = array();

            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['productCoverImg']) && $_FILES['productCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productCoverImg', 'file' => &$_FILES['productCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_cover'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product->product_cover) && !empty($product->product_cover)) {
                        unlink('./assets/uploads/product/' . $product->product_cover);
                        unlink('./assets/uploads/product/thumb_' . $product->product_cover);
                    }
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            $input_data['seo_title'] = $this->input->post('productSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('productSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('productSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('productSeoCanonicalUrl');
            if ($no_error == true) {
                if ($product) {
                    $input_data['updated_by'] = time();
                    $input_data['updated_at'] = $_SESSION['user_id'];
                    $this->product_model->update($input_data, $product->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->product_model->add($input_data);
                }
            }
            if ($id > 0) {

                $this->save_product_property($parent_product->id);
                $file_count = $this->input->post('productFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/product';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['productFile_' . $i]) && $_FILES['productFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'productFile_' . $i, 'file' => &$_FILES['productFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['product_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->product_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('productFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->product_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
                }
                //upload document files
                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');

                // Initialize error array
                $productDocumentError = array();

                if (!empty($_FILES['productDocumentFile']['name'][0])) {
                    $file_count = count($_FILES['productDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['productDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['productDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['productDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['productDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['productDocumentFile']['size'][$i];

                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);

                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array(
                                'product_id' => $id,
                                'file' => $file_name,
                                'file_for' => "O",
                                'file_type' => "O",
                                'created_at' => time(),
                                'created_by' => $_SESSION['user_id'],
                                'active' => 1
                            );
                            $file_id = $this->product_file_model->add($input_data);

                            if ($file_id > 0) {
                                $input_data = array(
                                    'title' => 'Document',
                                    'file_id' => $file_id,
                                    'language' => $lang,
                                    'created_at' => time(),
                                    'created_by' => $_SESSION['user_id'],
                                    'active' => 1
                                );
                                $this->product_file_description_model->add($input_data);
                            }
                        } else {

                            function getUploadErrorMessage($error_code)
                            {
                                switch ($error_code) {
                                    case UPLOAD_ERR_OK:
                                        return 'There is no error, the file uploaded successfully.';
                                    case UPLOAD_ERR_INI_SIZE:
                                        return 'The uploaded file exceeds the maximum allowed size. maximux size is'.config_item('MAX_IMG_FILE_SIZE_MSG');
                                    case UPLOAD_ERR_FORM_SIZE:
                                        return 'The uploaded file exceeds the maximum size specified in the form.';
                                    case UPLOAD_ERR_PARTIAL:
                                        return 'The uploaded file was only partially uploaded.';
                                    case UPLOAD_ERR_NO_FILE:
                                        return 'No file was uploaded.';
                                    case UPLOAD_ERR_NO_TMP_DIR:
                                        return 'Missing a temporary folder.';
                                    case UPLOAD_ERR_CANT_WRITE:
                                        return 'Failed to write file to disk.';
                                    case UPLOAD_ERR_EXTENSION:
                                        return 'File upload stopped by a PHP extension.';
                                    default:
                                        return 'Unknown upload error.';
                                }
                            }
                            // Store error for this file
                            $productDocumentError[] = array(
                                'file_name' => $_FILES['documentFile']['name'],
                                'error_message' => getUploadErrorMessage($_FILES['documentFile']['error'])
                            );

                            $this->data['productDocumentError'] = $productDocumentError;
                            // echo '<pre>';print_r($productDocumentError);exit;
                            $no_error = FALSE;
                        }
                    }
                }
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
                redirect('panel/product/all', 'refresh');
            }
        }
        $this->data['product_languages'] = explode(',', $product_languages->languages);
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['product'] = $product;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'edit_product';
        $this->load->view('panel/content', $this->data);
    }
    public function edit_bckup_05_08_2024($id, $lang = 1)
    {
        //edit product details
        $language_parent = '';
        if ($id > 0 && $lang == '1') {
            $parent_product = $this->product_model->get($id, '', FALSE);
            $product = $parent_product;
        } else if ($id > 0 && $lang > 0) {
            $parent_product = $this->product_model->get($id, '', FALSE);
            if ($parent_product) {
                $language_parent = $id;
                $product = $this->product_model->get_by_parent($id, $lang, FALSE);
            }
        } else {
            redirect('panel/product/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_product || !$current_language) {
            redirect('panel/product/all', 'refresh');
        }
        if ($lang != 1) {
            $this->data['controller_config']['disable_pr_category'] = TRUE;
            $this->data['controller_config']['disable_pr_title'] = TRUE;
            $this->data['controller_config']['disable_pr_brand'] = TRUE;
            $this->data['controller_config']['disable_pr_code'] = TRUE;
            $this->data['controller_config']['disable_pr_slugtitle'] = TRUE;
            $this->data['controller_config']['disable_pr_qty_per_unty'] = TRUE;
            $this->data['controller_config']['disable_pr_manufacturer_retail_price'] = TRUE;
            $this->data['controller_config']['disable_pr_cover_img'] = TRUE;
            $this->data['controller_config']['disable_pr_back_cover_img'] = TRUE;
            $this->data['controller_config']['disable_pr_document'] = TRUE;
            $this->data['controller_config']['disable_pr_group'] = TRUE;
            $this->data['controller_config']['disable_pr_images'] = TRUE;
            $this->data['controller_config']['disable_pr_unit_price'] = TRUE;
            $this->data['controller_config']['disable_pr_units_in_stock'] = TRUE;
            $this->data['controller_config']['disable_pr_discount'] = TRUE;
            $this->data['controller_config']['disable_pr_selling_price'] = TRUE;
            $this->data['controller_config']['disable_pr_attributes'] = TRUE;
            $this->data['controller_config']['disable_pr_related_product'] = TRUE;
            $this->data['controller_config']['disable_pr_status'] = TRUE;
            $this->data['controller_config']['disable_pr_isbn'] = TRUE;
            $this->data['controller_config']['disable_pr_sku'] = TRUE;
            $this->data['controller_config']['disable_pr_seo'] = FALSE;
        }
        $product_groups = $this->product_group_model->get_all();
        $brands = $this->brand_model->get_all();
        $related_products = '';
        if ($parent_product->related_product) {
            $filter = array();
            $filter['product_id'] = $parent_product->related_product;
            $related_products = $this->product_model->get_all_product($filter);
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $product_languages = $this->product_model->get_languages($id);
        $categories = $this->product_category_model->get_all();
        $product_images = $this->product_file_model->get_files(array('product_id' => $id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $product_documents = $this->product_file_model->get_files(array('product_id' => $id, 'file_for' => 'O', 'file_type' => 'O', 'active' => 1, 'language' => $lang));
        $tmp_product_attributes_value = $this->product_property_model->get_attributes_value($id);
        $product_attributes_value = array();
        if ($tmp_product_attributes_value) {
            $product_attributes_value = explode(',', $tmp_product_attributes_value->attributes_value);
        }
        $all_attributes = $this->product_attribute_model->get_all();
        if ($this->data['controller_config']['disable_pr_attributes'] != TRUE) {
            if ($all_attributes) {
                foreach ($all_attributes as $attribute) {
                    $attribute_values = $this->product_attribute_value_model->get_by_attribute($attribute->id);
                    if ($attribute->id == 1) {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim|required');
                    } else {
                        $this->form_validation->set_rules('productAttribute' . $attribute->id, $attribute->title, 'trim');
                    }
                }
            }
        }
        $filter = array();
        $filter['person_is'] = 'A';
        $authors = $this->bio_model->get_all($filter);
        $filter = array();
        $filter['person_is'] = 'I';
        $illustrators = $this->bio_model->get_all($filter);
        if ($this->data['controller_config']['disable_pr_category'] != TRUE)
            $this->form_validation->set_rules('productCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('productBrand', 'Brand', 'trim');
        $this->form_validation->set_rules('productName', 'Name', 'trim|required');
        $this->form_validation->set_rules('productTitle', 'Title', 'trim');
        // if (!$product || empty($product->title_slug) || $product->title_slug != $this->input->post('productSlugTitle')) {
        //     $this->form_validation->set_rules('productSlugTitle', 'Slug Title', 'trim|is_unique[product.title_slug]');
        // }
        $this->form_validation->set_rules('productSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('productSubtitle', 'Subtitle', 'trim');
        $this->form_validation->set_rules('productShortDesc', 'Short Description', 'trim');
        $this->form_validation->set_rules('productDescription', ' Description', 'trim');
        $this->form_validation->set_rules('productAdditonalInfo', ' additonal information', 'trim');
        $this->form_validation->set_rules('productBinding', ' binding', 'trim');
        $this->form_validation->set_rules('productNoPages', ' no. of pages', 'trim|is_natural');
        $this->form_validation->set_rules('productQuantityPerUnit', 'quantity per unit', 'trim');
        if ($this->data['controller_config']['disable_pr_unit_price'] != TRUE)
            $this->form_validation->set_rules('productUnitPrice', 'unit price', 'trim|required|numeric|greater_than_equal_to[0]');
        if ($this->data['controller_config']['disable_pr_selling_price'] != TRUE)
            $this->form_validation->set_rules('productSellingPrice', 'selling price', 'trim|required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productManufacturerRetailPrice', 'manufacturer Retail Price', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productUnitsInStock', 'In Stock', 'trim|is_natural');
        $this->form_validation->set_rules('productNote', 'Note', 'trim');
        $this->form_validation->set_rules('productAvailable', 'Product Available', 'trim');
        $this->form_validation->set_rules('productDiscount', 'Discount', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('productBrand', 'Brand', 'trim');
        $this->form_validation->set_rules('productGroup[]', 'Group', 'trim');
        $this->form_validation->set_rules('productAuthor', 'Author', 'trim');
        $this->form_validation->set_rules('productIllustrator', 'Illustrator', 'trim');
        $this->form_validation->set_rules('productISBN', 'ISBN', 'trim');
        $this->form_validation->set_rules('productSKU', 'SKU', 'trim');
        $this->form_validation->set_rules('productSatus', 'Status', 'trim');
        $this->form_validation->set_rules('productRelated[]', 'Related Products', 'trim');
        $this->form_validation->set_rules('productSeoTitle', 'seo title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('productSeoMetaKeywords', 'meta keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoMetaDescription', 'meta description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('productSeoCanonicalUrl', 'canonical url', 'trim');
        $this->form_validation->set_rules('productHomeDisplay', 'home_display', 'trim');
        //print_r($_POST);
        //exit;
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['product_name'] = $this->input->post('productName');
            $input_data['title'] = $this->input->post('productTitle');
            $input_data['title_slug'] = $this->input->post('productSlugTitle');
            $input_data['subtitle'] = $this->input->post('productSubtitle');
            $input_data['short_desc'] = $this->input->post('productShortDesc');
            $input_data['description'] = $this->input->post('productDescription');
            $input_data['additonal_info'] = $this->input->post('productAdditonalInfo');
            $input_data['binding'] = $this->input->post('productBinding');
            $input_data['no_of_pages'] = $this->input->post('productNoPages');
            $input_data['note'] = $this->input->post('productNote');
            $input_data['author'] = $this->input->post('productAuthor');
            $input_data['illustrator'] = $this->input->post('productIllustrator');
            $input_data['isbn'] = $this->input->post('productISBN');
            $input_data['sku'] = $this->input->post('productSKU');
            $related_product = $this->input->post('productRelated[]');
            $input_data['home_display'] = $this->input->post('productHomeDisplay');
            if (empty($input_data['home_display'])) {
                $input_data['home_display'] = 0;
            }
            if ($related_product) {
                $related_product = implode(',', $related_product);
            }
            $input_data['related_product'] = $related_product;
            $input_data['sku'] = '';
            $input_data['category_id'] = $this->input->post('productCategory');
            $tmp_product_group = $this->input->post('productGroup[]');
            if ($tmp_product_group) {
                $tmp_product_group = implode(',', $tmp_product_group);
            } else {
                $tmp_product_group = '';
            }
            $input_data['product_group'] = $tmp_product_group;
            $input_data['brand_id'] = $this->input->post('productBrand');
            $input_data['quantity_per_unit'] = $this->input->post('productQuantityPerUnit');
            $input_data['unit_price'] = $this->input->post('productUnitPrice');
            $input_data['selling_price'] = $this->input->post('productSellingPrice');
            $input_data['manufacturer_retail_price'] = $this->input->post('productManufacturerRetailPrice');
            $input_data['discount'] = $this->input->post('productDiscount');
            $input_data['units_in_stock'] = $this->input->post('productUnitsInStock');
            $input_data['ranking'] = '';
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
            $config['max_size'] = 500;
            $config['max_width'] = 400;
            $config['max_height'] = 400;
            if (!empty($_FILES['productCoverImg']) && $_FILES['productCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productCoverImg', 'file' => &$_FILES['productCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_cover'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product->product_cover) && !empty($product->product_cover)) {
                        unlink('./assets/uploads/product/' . $product->product_cover);
                        unlink('./assets/uploads/product/thumb_' . $product->product_cover);
                    }
                } else {
                    $this->data['productCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['productBackCoverImg']) && $_FILES['productBackCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'productBackCoverImg', 'file' => &$_FILES['productBackCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['product_back_cover'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product->product_back_cover) && !empty($product->product_back_cover)) {
                        unlink('./assets/uploads/product/' . $product->product_back_cover);
                        unlink('./assets/uploads/product/thumb_' . $product->product_back_cover);
                    }
                } else {
                    $this->data['productBackCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $input_data['seo_title'] = $this->input->post('productSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('productSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('productSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('productSeoCanonicalUrl');
            if ($no_error == true) {
                if ($product) {
                    $input_data['updated_by'] = time();
                    $input_data['updated_at'] = $_SESSION['user_id'];
                    $this->product_model->update($input_data, $product->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->product_model->add($input_data);
                }
            }
            if ($id > 0) {
                $this->save_product_property($parent_product->id);
                $file_count = $this->input->post('productFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/product';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['productFile_' . $i]) && $_FILES['productFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'productFile_' . $i, 'file' => &$_FILES['productFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['product_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->product_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('productFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->product_file_description_model->add($input_data);
                                }
                            }
                        }
                    }
                }
                //upload document files
                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                if (!empty($_FILES['productDocumentFile']['name'][0])) {
                    $file_count = count($_FILES['productDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['productDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['productDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['productDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['productDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['productDocumentFile']['size'][$i];
                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);
                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array();
                            $input_data['product_id'] = $id;
                            $input_data['file'] = $file_name;
                            $input_data['file_for'] = "O";
                            $input_data['file_type'] = "O";
                            $input_data['created_at'] = time();
                            $input_data['created_by'] = $_SESSION['user_id'];
                            $input_data['active'] = 1;
                            $file_id = $this->product_file_model->add($input_data);
                            if ($file_id > 0) {
                                $input_data = array();
                                $input_data['title'] = 'Document';
                                $input_data['file_id'] = $file_id;
                                $input_data['language'] = $lang;
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $this->product_file_description_model->add($input_data);
                            }
                        } else {
                            echo $upload_result['error_msg'];
                            exit;
                        }
                    }
                }
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
                redirect('panel/product/all', 'refresh');
            }
        }
        $this->data['related_products'] = $related_products;
        $this->data['product_attributes_value'] = $product_attributes_value;
        $html_product_attributes = $this->generate_attributes();
        $this->data['html_product_attributes'] = $html_product_attributes;
        $this->data['product_groups'] = $product_groups;
        $this->data['categories'] = $categories;
        $this->data['authors'] = $authors;
        $this->data['illustrators'] = $illustrators;
        $this->data['brands'] = $brands;
        $this->data['product_languages'] = explode(',', $product_languages->languages);
        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['parent_product'] = $parent_product;
        $this->data['product'] = $product;
        $this->data['product_images'] = $product_images;
        $this->data['product_documents'] = $product_documents;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'edit_product';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_add_product_file($id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax add product file
        $product = $this->product_model->get($id);
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language || !$product || $id < 0 || $lang < 0) {
            echo 'Something went wrong, Please try again.';
        } else if (!empty($_FILES['productFileUpdateBrowse'])) {
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['productFileUpdateBrowse']) && $_FILES['productFileUpdateBrowse']['error'] == 0) {
                $file_info = array('field_name' => 'productFileUpdateBrowse', 'file' => &$_FILES['productFileUpdateBrowse']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if ($upload_result['error']) {
                    echo $upload_result['error_msg'];
                } else {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['product_id'] = $id;
                    $input_data['file'] = $file_name;
                    $input_data['file_for'] = "IG";
                    $input_data['file_type'] = "I";
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $file_id = $this->product_file_model->add($input_data);
                    $title = $this->input->post('productFileUpdateTitle');
                    $input_data = array();
                    $input_data['title'] = $title;
                    if ($this->product_file_description_model->get_file_description($file_id, $lang)) {
                        $input_data['updated_at'] = time();
                        $input_data['updated_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->product_file_description_model->update($input_data, $file_id, $lang);
                    } else {
                        $input_data['file_id'] = $file_id;
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->product_file_description_model->add($input_data);
                    }
                    echo TRUE;
                }
            }
        } else {
            echo 'File required.';
        }
    }

    public function ajax_get_product_files()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax get all product files
        $id = $this->input->post('product_id');
        $lang = $this->input->post('language_id');
        $product_images = $this->product_file_model->get_files(array('product_id' => $id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $this->data['product_images'] = $product_images;
        $this->load->view('panel/ajax/ajax_product_files.php', $this->data);
    }

    public function ajax_delete_product_file($id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax delete_product file
        if ($id > 0 && $lang > 0) {
            $file_id = $this->input->post('deleteProductFileId');
            $filter = array();
            $filter['file_id'] = $file_id;
            $filter['product_id'] = $id;
            $file_info = $this->product_file_model->get_file($filter);
            if ($file_info) {
                if ($file_info->file_type == 'I') {
                    if (file_exists('./assets/uploads/product/' . $file_info->file) && !empty($file_info->file)) {
                        unlink('./assets/uploads/product/' . $file_info->file);
                        unlink('./assets/uploads/product/thumb_' . $file_info->file);
                    }
                }
                $this->product_file_model->delete_file($file_id);
                $this->product_file_description_model->delete_file_description($file_id, $lang);
                echo TRUE;
            }
        }
    }

    public function edit_file($id, $file_id, $lang = 1)
    {
        $product = $this->product_model->get($id);
        $current_language = $this->language_model->get_language($lang);
        $product_file = $this->product_file_model->get_product_file($file_id);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        if (!$current_language || !$product_file || !$product || $id < 0 || $file_id < 0) {
            redirect('panel/product/all', 'refresh');
        }
        $file_desc_languages = $this->product_file_description_model->get_languages($file_id);
        $product_file_desc = $this->product_file_description_model->get_file_description($file_id, $lang);
        $this->form_validation->set_rules('fileTitle', 'Title', 'trim');
        $this->form_validation->set_rules('fileDescription', 'Description', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['file_id'] = $product_file->id;
            $input_data['title'] = $this->input->post('fileTitle');
            $input_data['description'] = $this->input->post('fileDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            if ($product_file_desc) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->product_file_description_model->update($input_data, $product_file_desc->id);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->product_file_description_model->add($input_data);
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['fileProduct']) && $_FILES['fileProduct']['error'] == 0) {
                $file_info = array('field_name' => 'fileProduct', 'file' => &$_FILES['fileProduct']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['file'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product_file->file) && !empty($product_file->file)) {
                        unlink('./assets/uploads/product/' . $product_file->file);
                        unlink('./assets/uploads/product/thumb_' . $product_file->file);
                    }
                    $this->product_file_model->update($input_data, $product_file->id);
                } else {
                    $this->data['fileProductError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/product';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['fileProductLarge']) && $_FILES['fileProductLarge']['error'] == 0) {
                $file_info = array('field_name' => 'fileProductLarge', 'file' => &$_FILES['fileProductLarge']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['file_lg'] = $file_name;
                    if (file_exists('./assets/uploads/product/' . $product_file->file_lg) && !empty($product_file->file_lg)) {
                        unlink('./assets/uploads/product/' . $product_file->file_lg);
                        unlink('./assets/uploads/product/thumb_' . $product_file->file_lg);
                    }
                    $this->product_file_model->update($input_data, $product_file->id);
                } else {
                    $this->data['fileProductLargeError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product/edit_file/' . $product->id . '/' . $product_file->id . '/' . $current_language->id, 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['file_desc_languages'] = is_array($file_desc_languages) ? $file_desc_languages : array();
        $this->data['product_file_desc'] = $product_file_desc;
        $this->data['product'] = $product;
        $this->data['languages'] = $languages;
        $this->data['product_file'] = $product_file;
        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'edit_product_file';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_cover_img($id, $lang = '1')
    {
        //edit product based on language
        if ($id > 0 && $lang == '1') {
            $product = $this->product_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $product = $this->product_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/product/all', 'refresh');
        }
        if (file_exists('./assets/uploads/product/' . $product->product_cover) && !empty($product->product_cover)) {
            unlink('./assets/uploads/product/' . $product->product_cover);
            unlink('./assets/uploads/product/thumb_' . $product->product_cover);
        }
        $input_data['product_cover'] = '';
        $this->product_model->update($input_data, $product->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/product/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete_back_cover_img($id, $lang = '1')
    {
        //edit product based on language
        if ($id > 0 && $lang == '1') {
            $product = $this->product_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $product = $this->product_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/product/all', 'refresh');
        }
        if (file_exists('./assets/uploads/product/' . $product->product_back_cover) && !empty($product->product_back_cover)) {
            unlink('./assets/uploads/product/' . $product->product_back_cover);
            unlink('./assets/uploads/product/thumb_' . $product->product_back_cover);
        }
        $input_data['product_back_cover'] = '';
        $this->product_model->update($input_data, $product->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/product/edit/' . $id . '/' . $lang, 'refresh');
    }

    private function generate_attributes()
    {
        $attribute_generated = '';
        $all_attributes = $this->product_attribute_model->get_all();
        if ($all_attributes) {
            foreach ($all_attributes as $key => $attribute) {
                $all_attributes[$key]->is_required = 0;
                if ($attribute->id == 1) {
                    $all_attributes[$key]->is_required = 1;
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

    private function save_product_property($product_id)
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

    public function delete_product_document($id, $file_id, $lang = 1)
    {
        $filter = array();
        $filter['file_id'] = $file_id;
        $filter['product_id'] = $id;
        $file_info = $this->product_file_model->get_file($filter);
        if ($file_info) {
            if ($file_info->file_type == 'O') {
                if (file_exists('./assets/uploads/document/' . $file_info->file) && !empty($file_info->file)) {
                    unlink('./assets/uploads/document/' . $file_info->file);
                }
            }
            $this->product_file_model->delete_file($file_id);
            $this->product_file_description_model->delete_file_description($file_id, $lang);
            $this->session->set_flashdata('success', 'Document deleted successfully.');
        }
        redirect('panel/product/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function delete_product_large_img($id, $file_id, $lang = 1)
    {
        $filter = array();
        $filter['file_id'] = $file_id;
        $filter['product_id'] = $id;
        $file_info = $this->product_file_model->get_file($filter);
        if ($file_info) {
            if ($file_info->file_type == 'I') {
                if (file_exists('./assets/uploads/product/' . $file_info->file_lg) && !empty($file_info->file)) {
                    unlink('./assets/uploads/product/' . $file_info->file_lg);
                    unlink('./assets/uploads/product/thumb_' . $file_info->file_lg);
                }
            }
            $input_data = array();
            $input_data['file_lg'] = '';
            $this->product_file_model->update($input_data, $file_info->id);
            $this->session->set_flashdata('success', 'Large image deleted successfully.');
        }
        redirect('panel/product/edit/' . $id . '/' . $lang, 'refresh');
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

    public function checkout($user_id = '', $lang = 1)
    {
        $current_language = $this->language_model->get_language($lang);
        $customer_type = 'RU';
        $filter = array();
        $filter['created_by'] = $user_id;
        $filter['customer_type'] = 'RU';
        $filter['units_in_stock'] = 1;
        $cart_products = $this->product_cart_model->get_all($filter);
        $profile = '';
        if ($user_id && $customer_type == 'RU') {
            $profile = $this->profile_model->get_profile($user_id);
        }
        $profile_country = '';
        if ($profile) {
            if ($profile->country > 0) {
                $profile_country = $this->country_model->get_country($profile->country);
            }
        }
        $countries = $this->country_model->get_countries();
        $shipping_charge = $this->product_shipping_charge_model->get(2);
        $vat = $this->panel_settings->vat;
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('company_name', 'Company', 'trim|required');
        if (!empty($_POST['createaccount']))
            $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        else
            $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('address2', 'Apartment', 'trim');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('district','district','trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('postal_code', 'Zip/Postal Code', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('fax', 'Fax', 'trim   ');
        if (!empty($_POST['ship_diff_address'])) {
            $this->form_validation->set_rules('ship_first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('ship_last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('ship_company_name', 'Company', 'trim|required');
            $this->form_validation->set_rules('ship_email_address', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('ship_address', 'Address', 'trim|required');
            $this->form_validation->set_rules('ship_address2', 'Apartment', 'trim');
            $this->form_validation->set_rules('ship_city', 'City', 'trim|required');
            //$this->form_validation->set_rules('ship_district','District','trim|required');
            $this->form_validation->set_rules('ship_state', 'State', 'trim|required');
            $this->form_validation->set_rules('ship_country', 'Country', 'trim|required');
            $this->form_validation->set_rules('ship_postal_code', 'Zip/Postal Code', 'trim|required');
            $this->form_validation->set_rules('ship_phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('ship_fax', 'Fax', 'trim');
        }
        if (!empty($_POST['createaccount']) && !$this->ion_auth->logged_in()) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        }
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $error_msg = '';
            $cart_user_id = $user_id;
            $guest_checkout = 'N';
            if ($customer_type != 'RU') {
                $guest_checkout = 'Y';
            }

            $input_data = array();
            $input_data['customer_id'] = $user_id;
            $input_data['guest_checkout'] = $guest_checkout;
            $input_data['order_ref_no'] = '';
            $input_data['billing_first_name'] = $this->input->post('first_name');
            $input_data['billing_last_name'] = $this->input->post('last_name');
            $input_data['billing_email'] = $this->input->post('email_address');
            $input_data['billing_address'] = $this->input->post('address');
            $input_data['billing_address_2'] = $this->input->post('address2');
            $input_data['billing_company'] = $this->input->post('company_name');
            $input_data['billing_city'] = $this->input->post('city');
            $input_data['billing_district'] = $this->input->post('district');
            $input_data['billing_state'] = $this->input->post('state');
            $input_data['billing_country'] = $this->input->post('country');
            if ($input_data['billing_country'] > 0) {
                $input_data['billing_country_id'] = $this->input->post('country');
                $billing_country = $this->country_model->get_country($input_data['billing_country_id']);
                if ($billing_country) {
                    $input_data['billing_country'] = $billing_country->name;
                }
            }
            $input_data['shipping_phone'] = $this->input->post('ship_phone');
            $input_data['shipping_fax'] = $this->input->post('ship_fax');
            $input_data['shipping_postal_code'] = $this->input->post('ship_postal_code');
            $input_data['billing_phone'] = $this->input->post('phone');
            $input_data['billing_fax'] = $this->input->post('fax');
            $input_data['billing_postal_code'] = $this->input->post('postal_code');
            if (!empty($_POST['ship_diff_address'])) {
                $input_data['shipping_first_name'] = $this->input->post('ship_first_name');
                $input_data['shipping_last_name'] = $this->input->post('ship_last_name');
                $input_data['shipping_email'] = $this->input->post('ship_email_address');
                $input_data['shipping_address'] = $this->input->post('ship_address');
                $input_data['shipping_address_2'] = $this->input->post('ship_address2');
                $input_data['shipping_company'] = $this->input->post('ship_company_name');
                $input_data['shipping_city'] = $this->input->post('ship_city');
                $input_data['shipping_district'] = $this->input->post('ship_district');
                $input_data['shipping_state'] = $this->input->post('ship_state');
                $input_data['shipping_country'] = $this->input->post('ship_country');
                if ($input_data['shipping_country'] > 0) {
                    $input_data['shipping_country_id'] = $this->input->post('shipping_country');
                    $ship_country = $this->country_model->get_country($input_data['shipping_country_id']);
                    if ($ship_country) {
                        $input_data['shipping_country'] = $ship_country->name;
                    }
                }
                $input_data['shipping_phone'] = $this->input->post('ship_phone');
                $input_data['shipping_fax'] = $this->input->post('ship_fax');
                $input_data['shipping_postal_code'] = $this->input->post('ship_postal_code');
            } else {
                $input_data['shipping_first_name'] = $this->input->post('first_name');
                $input_data['shipping_last_name'] = $this->input->post('last_name');
                $input_data['shipping_email'] = $this->input->post('email_address');
                $input_data['shipping_address'] = $this->input->post('address');
                $input_data['shipping_address_2'] = $this->input->post('address2');
                $input_data['shipping_company'] = $this->input->post('company_name');
                $input_data['shipping_city'] = $this->input->post('city');
                $input_data['shipping_district'] = $this->input->post('district');
                $input_data['shipping_state'] = $this->input->post('state');
                $input_data['shipping_country_id'] = $this->input->post('country');
                $input_data['shipping_country'] = $this->input->post('country');
                if ($input_data['shipping_country'] > 0) {
                    $input_data['shipping_country_id'] = $this->input->post('country');
                    $ship_country = $this->country_model->get_country($input_data['shipping_country_id']);
                    if ($ship_country) {
                        $input_data['shipping_country'] = $ship_country->name;
                    }
                }
                $input_data['shipping_phone'] = $this->input->post('phone');
                $input_data['shipping_fax'] = $this->input->post('fax');
                $input_data['shipping_postal_code'] = $this->input->post('postal_code');
            }
            $input_data['order_status'] = 'P';
            $input_data['note'] = '';
            $input_data['created_at'] = time();
            if ($customer_type == 'RU') {
                $input_data['created_by'] = $user_id;
            }
            $input_data['active'] = 1;
            $input_data['direct_order'] = 1;
            $order_id = $this->product_order_model->add($input_data);
            if ($order_id > 0) {
                $input_data = array();
                $input_data['order_ref_no'] = 'O' . date('y') . rand(0, 99) . $order_id;
                $this->product_order_model->update($input_data, $order_id);
                if ($cart_products) {
                    $sub_total = 0;
                    foreach ($cart_products as $cart_product) {
                        $input_data = array();
                        $input_data['order_id'] = $order_id;
                        $input_data['product_id'] = $cart_product->id;
                        $input_data['unit_price'] = $cart_product->unit_price;
                        $input_data['discount'] = $cart_product->discount;
                        $input_data['selling_price'] = $cart_product->selling_price;
                        $input_data['quantity'] = $cart_product->cart_quantity;
                        $input_data['total'] = $cart_product->selling_price * $cart_product->cart_quantity;
                        $sub_total += $input_data['total'];
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $user_id;
                        $input_data['active'] = 1;
                        $order_details_id = $this->product_order_details_model->add($input_data);
                        $input_data = array();
                        $units_in_stock = $cart_product->units_in_stock > 0 ? $cart_product->units_in_stock : 0;
                        $units_in_stock -= $cart_product->cart_quantity;
                        $units_in_stock = $units_in_stock > 0 ? $units_in_stock : 0;
                        $input_data['units_in_stock'] = $units_in_stock;
                        $this->product_model->update($input_data, $cart_product->id);
                        if ($order_details_id > 0) {
                            $filter = array();
                            $filter['product_id'] = $cart_product->id;
                            $product_properties = $this->product_property_model->get_all_product_properties($filter);
                            if ($product_properties) {
                                foreach ($product_properties as $product_property) {
                                    $input_data = array();
                                    $input_data['order_details_id'] = $order_details_id;
                                    $input_data['attribute_id'] = $product_property->attribute_id;
                                    $input_data['attribute'] = $product_property->attribute_title;
                                    $input_data['attribute_value_id'] = $product_property->attribute_value_id;
                                    $input_data['attribute_value'] = $product_property->attribute_value;
                                    $input_data['created_at'] = time();
                                    $input_data['active'] = 1;
                                    $order_product_property_id = $this->product_order_property_model->add($input_data);
                                    if (!$order_product_property_id) {
                                        $no_error = FALSE;
                                    }
                                }
                            }
                            $this->product_cart_model->remove($cart_product->cart_id, $cart_user_id, $customer_type);
                        } else {
                            $no_error = FALSE;
                        }
                    }
                    $vat_amount = $sub_total * ($vat / 100);
                    $grand_total = $sub_total + $vat_amount;
                    if (!empty($_POST['shipping_charge'])) {
                        $grand_total += $shipping_charge->rate;
                    }
                    $input_data = array();
                    $input_data['order_id'] = $order_id;
                    $input_data['payment_type_id'] = 1;
                    $input_data['sub_total'] = $sub_total;
                    $input_data['vat'] = $vat;
                    $input_data['vat_amount'] = $vat_amount;
                    $input_data['shipping_charge'] = $shipping_charge->rate;
                    $input_data['grand_total'] = $grand_total;
                    $input_data['payment_status'] = 'S';
                    $input_data['note'] = 'Admin self order.';
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['created_at'] = time();
                    $input_data['active'] = 1;
                    $order_payment_id = $this->product_order_payment_model->add($input_data);
                    if (!$order_payment_id) {
                        $no_error = FALSE;
                    }
                } else {
                    $no_error = FALSE;
                    $error_msg = 'Cart is empty.';
                }
            } else {
                $no_error = FALSE;
            }
            if ($no_error == TRUE) {
                $this->db->trans_commit();
                $this->mail_order($order_id);
                $this->session->set_flashdata('success', 'Order placed successfully.');
                redirect('panel/product_order/view/' . $order_id);
            } else {
                if ($error_msg == '') {
                    $error_msg = 'Order placing unsuccessful.';
                }
                $this->session->set_flashdata('error', $error_msg);
                $this->db->trans_rollback();
                redirect('panel/product/checkout/' . $user_id);
            }
        }
        $this->data['user_id'] = $user_id;
        $this->data['profile_country'] = $profile_country;
        $this->data['current_language'] = $current_language;
        $this->data['vat'] = $vat;
        $this->data['shipping_charge'] = $shipping_charge;
        $this->data['countries'] = $countries;
        $this->data['cart_products'] = $cart_products;
        $this->data['profile'] = $profile;
        $this->data['active_menu'] = 'direct_order';
        $this->data['site_content'] = 'product_checkout';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_get_cart_products()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $user_id = $this->input->post('user_id');
        $customer_type = 'RU';
        $filter = array();
        $filter['created_by'] = $user_id;
        $filter['customer_type'] = $customer_type;
        $cart_products = $this->product_cart_model->get_by_lang($filter, 1, false);
        $shipping_charge = $this->product_shipping_charge_model->get(2);
        $this->data['shipping_charge'] = $shipping_charge;
        $this->data['cart_products'] = $cart_products;
        $this->load->view('panel/ajax/ajax_get_cart_products', $this->data);
    }

    public function ajax_add_cart()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $id = $this->input->post('product_id');
        $product = $this->product_model->get($id);
        if (!$product) {
            echo 'Invalid product';
            exit;
        }
        $user_id = $this->input->post('user_id');
        $customer_type = 'RU';
        $filter = array();
        $filter['product_id'] = $product->id;
        $filter['created_by'] = $user_id;
        $filter['customer_type'] = $customer_type;
        $check_product_in_cart = $this->product_cart_model->get_by_product($filter);
        $unit_stock_required = 1;
        if ($product->units_in_stock < $unit_stock_required) {
            echo 'Out of stock.';
            exit;
        }
        $input_data = array();
        $input_data['product_id'] = $product->id;
        $input_data['quantity'] = $unit_stock_required;
        $input_data['customer_type'] = $customer_type;
        $input_data['active'] = 1;
        if ($check_product_in_cart) {
            $input_data['updated_by'] = $user_id;
            $input_data['updated_at'] = time();
            $this->product_cart_model->update($input_data, $check_product_in_cart->cart_id);
        } else {
            $input_data['created_by'] = $user_id;
            $input_data['created_at'] = time();
            $this->product_cart_model->add($input_data);
        }
        echo true;
    }

    public function ajax_update_cart_product()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $customer_type = 'RU';
        $filter = array();
        $filter['created_by'] = $user_id;
        $filter['customer_type'] = $customer_type;
        $filter['product_id'] = $product_id;
        $cart_product = $this->product_cart_model->get_by_lang($filter, 1, true);
        if ($cart_product && $user_id > 0 && $product_id > 0) {
            $product = $this->product_model->get($cart_product->id);
            if (!$product) {
                echo 'Cart update failed.';
            }
            $unit_stock_required = $this->input->post('unit_stock_required');
            if ($product->units_in_stock < $unit_stock_required) {
                echo 'Required quantity not available for the product.';
                exit;
            }
            $input_data = array();
            $input_data['product_id'] = $product->id;
            if ($unit_stock_required <= 0) {
                $unit_stock_required = 1;
            }
            $input_data['quantity'] = $unit_stock_required;
            $input_data['customer_type'] = $customer_type;
            $input_data['active'] = 1;
            $input_data['updated_by'] = $user_id;
            $input_data['updated_at'] = time();
            $this->product_cart_model->update($input_data, $cart_product->cart_id, $customer_type);
            echo true;
        } else {
            echo 'Cart update failed.';
        }
    }

    public function ajax_remove_cart_product()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $customer_type = 'RU';
        if ($user_id > 0 && $product_id > 0) {
            $this->product_cart_model->remove($product_id, $user_id, $customer_type);
            echo true;
        } else {
            echo 'Cart product removing failed.';
        }
    }

    public function mail_order($id)
    {
        $filter = array();
        $filter['id'] = $id;
        $order = $this->product_order_model->get_order($filter);
        if (!$order) {
            return false;
        }
        $profile = $this->profile_model->get_profile($order->customer_id);
        $country = '';
        if ($profile->country > 0) {
            $country = $this->country_model->get_country($profile->country);
        }
        $this->data['contact'] = $this->contact_model->get_by_lang(1);
        $this->data['profile'] = $profile;
        $this->data['country'] = $country;
        $product_order_items = '';
        $order_payment = $this->product_order_payment_model->get($order->id);
        $filter = array();
        $filter['order_id'] = $id;
        $order_details = $this->product_order_details_model->get_all($filter);
        if ($order_details && $order && $order_payment) {
            $this->data['order'] = $order;
            $this->data['order_payment'] = $order_payment;
            $this->data['order_item_sl_no'] = 0;
            $this->data['order_items_count'] = $this->product_order_details_model->num_rows;
            foreach ($order_details as $order_detail) {
                $this->data['order_item_sl_no']++;
                $this->data['order_detail'] = $order_detail;
                $order_product = $this->product_model->get($order_detail->product_id);
                $this->data['order_product'] = $order_product;
                $filter = array();
                $filter['order_details_id'] = $order_detail->id;
                $order_product_properties = $this->product_order_property_model->get_all($filter);
                $this->data['order_product_properties'] = $order_product_properties;
                $product_order_items .= $this->load->view('mail_template/order/order_list', $this->data, TRUE);
            }
            $this->data['order_items'] = $product_order_items;
            $mail_template = $this->load->view('mail_template/order/index', $this->data, true);
            $this->load->library('email');
            $email_setting = array('mailtype' => 'html');
            $this->email->initialize($email_setting);
            $mail_from = $this->panel_settings->order_email;
            $mail_to = $order->billing_email;
            $this->email->from($mail_from, config_item('WEBSITE_TITLE'));
            $this->email->to($mail_to);
            $subject = "Order - $order->order_ref_no placed.";
            $this->email->subject($subject);
            $this->email->message($mail_template);
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function admin_mail_order($id)
    {
        $filter = array();
        $filter['id'] = $id;
        $order = $this->product_order_model->get_order($filter);
        if (!$order) {
            return false;
        }
        $profile = $this->profile_model->get_profile($order->customer_id);
        $country = '';
        if ($profile->country > 0) {
            $country = $this->country_model->get_country($profile->country);
        }
        $this->data['contact'] = $this->contact_model->get_by_lang(1);
        $this->data['profile'] = $profile;
        $this->data['country'] = $country;
        $product_order_items = '';
        $order_payment = $this->product_order_payment_model->get($order->id);
        $filter = array();
        $filter['order_id'] = $id;
        $order_details = $this->product_order_details_model->get_all($filter);
        if ($order_details && $order && $order_payment) {
            $this->data['order'] = $order;
            $this->data['order_payment'] = $order_payment;
            $this->data['order_item_sl_no'] = 0;
            $this->data['order_items_count'] = $this->product_order_details_model->num_rows;
            foreach ($order_details as $order_detail) {
                $this->data['order_item_sl_no']++;
                $this->data['order_detail'] = $order_detail;
                $order_product = $this->product_model->get($order_detail->product_id);
                $this->data['order_product'] = $order_product;
                $filter = array();
                $filter['order_details_id'] = $order_detail->id;
                $order_product_properties = $this->product_order_property_model->get_all($filter);
                $this->data['order_product_properties'] = $order_product_properties;
                $product_order_items .= $this->load->view('mail_template/order/order_list', $this->data, TRUE);
            }
            $this->data['order_items'] = $product_order_items;
            $mail_template = $this->load->view('mail_template/order/index', $this->data, true);
            $this->load->library('email');
            $email_setting = array('mailtype' => 'html');
            $this->email->initialize($email_setting);
            $mail_from = $_SESSION['email'];
            $mail_to = $this->panel_settings->order_email;
            $this->email->from($mail_from, config_item('WEBSITE_TITLE'));
            $this->email->to($mail_to);
            $subject_user_info = '';
            $subject_user_info .= $profile->first_name . ' ' . $profile->last_name;
            $subject_user_info .= '<' . $profile->email . '>';
            $subject = "Order - $order->order_ref_no placed by $subject_user_info.";
            $this->email->subject($subject);
            $this->email->message($mail_template);
            if ($this->email->send()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_all_categories($categories, $sl_no = '')
    {
        $category_items = array();
        if ($categories) {
            $i = 1;
            if ($sl_no) {
                $sl_no .= '.';
            }
            foreach ($categories as $category) {
                $tmp_category_item = array();
                $tmp_category_item['sl_no'] = $sl_no . $i;
                $tmp_category_item['category_id'] = $category->id;
                $tmp_category_item['title'] = $category->title;
                $tmp_category_item['category_order'] = $category->category_order;
                array_push($category_items, $tmp_category_item);
                $chid_categories = $this->product_category_model->get_by_parent($category->id);
                if ($chid_categories) {
                    $child_category_items = $this->get_all_categories($chid_categories, $tmp_category_item['sl_no']);
                    if ($child_category_items) {
                        foreach ($child_category_items as $child_category_item) {
                            array_push($category_items, $child_category_item);
                        }
                    }
                }
                $i++;
            }
        }
        return $category_items;
    }
    public function delete_product($id)
    {
        $product = $this->product_model->get_product_without_status($id);
        $go_forward = null;

        if ($product) {
            if ($this->product_model->delete_product($id)) {
                $go_forward = true;
            }
        } else {
            $go_forward = false;
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'Product deleted successfully.');
            redirect('panel/product/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
    }

    public function ajax_update_product_document_title()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $doc_id = $this->input->post('doc_id');
        $title = $this->input->post('title');

        if ($doc_id && $title !== null) {
            $update_data = [
                'title' => $title,
                'updated_at' => time(),
                'updated_by' => $_SESSION['user_id'],
            ];

            $this->product_file_description_model->update($update_data, $doc_id);


            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true]));
        } else {
            // ❌ Send JSON failure response
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false]));
        }
    }
}
