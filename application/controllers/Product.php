<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Product_file_model', 'product_file_model');
        $this->load->model('File_model', 'file_model');

    }

    public function index($slug = '')
    {
        redirect('product/info/');
    }

    public function info($slug = '')
    {
        if ($slug) {

            $product = $this->product_model->get_by_slug($slug);
            if ($product) {
                $product = $product[0];
            $this->data['product'] = $product;

                $product_id = $product->id;
                $product_description = $product->description;
                if ($product_description != '') {
                    // Replace <ul>
                    if (strpos($product_description, "<ul>") !== false) {
                        $product_description = str_replace("<ul>", '<ul class="list-group">', $product_description);
                    }
    
                    // Replace <li>
                    if (strpos($product_description, "<li>") !== false) {
                        $product_description = str_replace(
                            '<li>',
                            '<li class="list-group-item"><span class="pbmit-icon-list-icon"><i class="pbmit-solaar-icon pbmit-solaar-icon-verified"></i></span><span class="pbmit-icon-list-text">',
                            $product_description
                        );
    
                        $product_description = str_replace("</li>", '</span></li>', $product_description);
                    }
    
                    $this->data['product']->formatted_desc = $product_description;
                }

                $product_images = $this->product_file_model->get_files(array('product_id' => $product_id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1));
                $this->data['product_images'] = $product_images;
                $product_documents = $this->product_file_model->get_files(array('product_id' => $product_id, 'file_for' => 'O', 'file_type' => 'O', 'active' => 1));
                $this->data['product_documents'] = $product_documents;
            }

        } else {
            redirect(base_url(''));
        }
        // echo '<pre>';print_r($this->data['product']);exit;
        $this->data['banners'] = $this->file_model->get_all(3);

        $this->data['active_menu'] = 'product';
        $this->data['site_content'] = 'product';
        $this->load->view('web/content', $this->data);
    }
}
