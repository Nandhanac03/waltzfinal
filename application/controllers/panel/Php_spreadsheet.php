<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 99999);
set_time_limit(999999999);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Php_spreadsheet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model', 'brand_model');
        $this->load->model('Product_attribute_model', 'product_attribute_model');
        $this->load->model('Product_attribute_value_model', 'product_attribute_value_model');
        $this->load->model('Product_category_model', 'product_category_model');
        $this->load->model('Product_property_model', 'product_property_model');
        $this->load->model('Product_model', 'product_model');
        set_time_limit(300);
    }

    public function index()
    {
        redirect('php_spreasheet/read');
    }

    public function import()
    {
//        echo phpinfo();
//        exit;
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
        // $arr_file = explode('.', $_FILES['upload_file']['name']);
        $file = "./assets/uploads/excel/products.xlsx";
        $arr_file = explode('.', $file);
        $extension = end($arr_file);
        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        // $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        echo '<pre>';
        print_r($sheetData);
        exit;
        if ($sheetData) {
            $i = 0;
            foreach ($sheetData as $sheetRow) {
                $i++;
                if ($i == 1 || trim($sheetRow[7])=='') {
                    continue;
                }
                $cover_img_file = '';
                $cover_img_thumb_file = '';
                $cover_img = trim($sheetRow['12']);
                if ($cover_img) {
                    $img_extension = explode('.', $cover_img);
                    if (count($img_extension) > 0) {
                        $img_extension = strtolower(end($img_extension));
                        if ($img_extension == 'jpg' || $img_extension == 'png') {
                            $data = file_get_contents($cover_img);
                            $file_name = date('ymdhis') . rand(0, 9999) . '.' . $img_extension;
                            $cover_img_file = $file_name;
                            $file = './assets/uploads/product/' . $file_name;
                            file_put_contents($file, $data);
                            $thumb_cover_img = trim($sheetRow['11']);
                            if ($thumb_cover_img) {
                                $thumb_img_extension = explode('.', $thumb_cover_img);
                                $thumb_img_extension = strtolower(end($thumb_img_extension));
                                if ($img_extension == $thumb_img_extension && count($thumb_img_extension) > 0) {
                                    $data = file_get_contents($thumb_cover_img);
                                    $file_name = 'thumb_' . $file_name;
                                    $cover_img_thumb_file = $file_name;
                                    $file = './assets/uploads/product/' . $file_name;
                                    file_put_contents($file, $data);
                                } else {
                                    $file_name = 'thumb_' . $file_name;
                                    $cover_img_thumb_file = $file_name;
                                    $file = './assets/uploads/product/' . $file_name;
                                    file_put_contents($file, $data);
                                }
                            } else {
                                $file_name = 'thumb_' . $file_name;
                                $cover_img_thumb_file = $file_name;
                                $file = './assets/uploads/product/' . $file_name;
                                file_put_contents($file, $data);
                            }
                        }
                    }
                }
                $input_data = array();
                $category_id = '';
                $category_title = $this->db->escape_str(trim(strtolower($sheetRow[1])));
                $sub_category_title = $this->db->escape_str(trim(strtolower($sheetRow[2])));
                $category = $this->product_category_model->check_category_exists($category_title, 1);
                if ($category_title) {
                    if ($category) {
                        $category_id = $category->id;
                    } else {
                        $input_data = array();
                        $input_data['parent_id'] = '';
                        $input_data['title'] = $this->db->escape_str(trim($sheetRow[1]));
                        $input_data['category_order'] = 0;
                        $input_data['language'] = 1;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $category_id = $this->product_category_model->add($input_data);
                    }
                }
                $sub_category = $this->product_category_model->check_category_exists($sub_category_title, 1);
                if ($sub_category_title) {
                    if ($sub_category) {
                        $category_id = $sub_category->id;
                    } else {
                        $input_data = array();
                        $input_data['parent_id'] = $category_id;
                        $input_data['title'] = $this->db->escape_str(trim($sheetRow[2]));
                        $input_data['category_order'] = 0;
                        $input_data['language'] = 1;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $category_id = $this->product_category_model->add($input_data);
                    }
                }
                $brand_name = $this->db->escape_str(trim(strtolower($sheetRow[5])));
                $brand_id = '';
                if ($brand_name) {
                    $brand = $this->brand_model->check_brand_exists($brand_name, 1);
                    if ($brand) {
                        $brand_id = $brand->id;
                    } else {
                        $input_data = array();
                        $input_data['brand_name'] = trim($sheetRow[5]);
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['language'] = 1;
                        $input_data['active'] = 1;
                        $brand_id = $this->brand_model->add($input_data);
                    }
                }
                $input_data = array();
                $input_data['category_id'] = $category_id;
                $input_data['brand_id'] = $brand_id;
                $input_data['sku'] = trim($sheetRow[6]);
                $input_data['product_name'] = $this->db->escape_str(trim($sheetRow[7]));
                $input_data['title'] = $this->db->escape_str(trim($sheetRow[9]));
                $input_data['title_slug'] = $this->db->escape_str(trim($sheetRow[9]));
                $input_data['description'] = $this->db->escape_str(trim($sheetRow[10]));
                $input_data['product_cover'] = $cover_img_file;
                $input_data['quantity_per_unit'] = trim($sheetRow[8]);
                $input_data['units_in_stock'] = trim($sheetRow[13]);
                $input_data['unit_price'] = trim($sheetRow[14]);
                $input_data['discount'] = trim($sheetRow[15]);
                $input_data['selling_price'] = trim($sheetRow[16]);
                $input_data['language'] = 1;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                $product_id = $this->product_model->add($input_data);
                $product_code = 'P' . date('y') . rand(0, 99) . $product_id;
                $input_data = array();
                $input_data['product_code'] = $product_code;
                $this->product_model->update($input_data, $product_id);
                $attribute_title = "Product Sub Group";
                $attribute_id = '';
                $attribute = $this->product_attribute_model->check_attribute_exists($attribute_title, 1);
                if ($attribute) {
                    $attribute_id = $attribute->id;
                } else {
                    $input_data = array();
                    $input_data['parent_id'] = '';
                    $input_data['title'] = $this->db->escape_str($attribute_title);
                    $input_data['attribute_order'] = 0;
                    $input_data['language'] = 1;
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $attribute_id = $this->product_attribute_model->add($input_data);
                }
                $attribute_value_id = '';
                $attribute_value_title = $this->db->escape_str(trim(strtolower($sheetRow[3])));
                if ($attribute_value_title) {
                    $attribute_value = $this->product_attribute_value_model->check_attribute_value_exists($attribute_value_title, $attribute_id, 1);
                    if ($attribute_value) {
                        $attribute_value_id = $attribute_value->id;
                    } else {
                        $input_data = array();
                        $input_data['attribute_id'] = $attribute_id;
                        $input_data['attribute_value'] =  $this->db->escape_str(trim($sheetRow[3]));
                        $input_data['language'] = 1;
                        $input_data['value_order'] = 0;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = '1';
                        $attribute_value_id = $this->product_attribute_value_model->add($input_data);
                    }
                    $input_data = array();
                    $input_data['attribute_id'] = $attribute_id;
                    $input_data['attribute_value_id'] = $attribute_value_id;
                    $input_data['product_id'] = $product_id;
                    $input_data['active'] = 1;
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['created_at'] = time();
                    $this->product_property_model->add($input_data);
                }
                $attribute_title = "Special Group";
                $attribute_id = '';
                $attribute = $this->product_attribute_model->check_attribute_exists($attribute_title, 1);
                if ($attribute) {
                    $attribute_id = $attribute->id;
                } else {
                    $input_data = array();
                    $input_data['parent_id'] = '';
                    $input_data['title'] = $this->db->escape_str($attribute_title);
                    $input_data['attribute_order'] = 0;
                    $input_data['language'] = 1;
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $attribute_id = $this->product_attribute_model->add($input_data);
                }
                $attribute_value_id = '';
                $attribute_value_title = $this->db->escape_str(trim(strtolower($sheetRow[4])));
                if ($attribute_value_title) {
                    $attribute_value = $this->product_attribute_value_model->check_attribute_value_exists($attribute_value_title, $attribute_id, 1);
                    if ($attribute_value) {
                        $attribute_value_id = $attribute_value->id;
                    } else {
                        $input_data = array();
                        $input_data['attribute_id'] = $attribute_id;
                        $input_data['attribute_value'] = $this->db->escape_str(trim($sheetRow[4]));
                        $input_data['language'] = 1;
                        $input_data['value_order'] = 0;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = '1';
                        $attribute_value_id = $this->product_attribute_value_model->add($input_data);
                    }
                    $input_data = array();
                    $input_data['attribute_id'] = $attribute_id;
                    $input_data['attribute_value_id'] = $attribute_value_id;
                    $input_data['product_id'] = $product_id;
                    $input_data['active'] = 1;
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['created_at'] = time();
                    $this->product_property_model->add($input_data);
                }
            }
        }
        // }
    }

    public function slugify($input, $word_delimiter = '-')
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, '-'));
        $slug = preg_replace("/[\/_|+ -]+/", $word_delimiter, $slug);
        return $slug;
    }

}
