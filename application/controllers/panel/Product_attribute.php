<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_attribute extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Product_attribute_model', 'product_attribute_model');
        $this->load->model('Product_attribute_value_model', 'product_attribute_value_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_add_attribute'] = TRUE;
        $controller_config['disable_delete_attribute'] = TRUE;
        $controller_config['disable_parent_attribute'] = TRUE;
        $controller_config['disable_attribute_order'] = FALSE;
        $controller_config['disable_languages_attribute'] = FALSE;
        $controller_config['disable_attr_value_languages'] = FALSE;
        $controller_config['disable_attr_value_order'] = FALSE;
        $controller_config['disable_delete_attr_value'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        $this->all();
    }

    public function add($lang = 1)
    {
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/product_attribute/all', 'refresh');
        }
        $attributes = $this->product_attribute_model->get_all();
        $attribute_order = $this->product_attribute_model->num_rows+1;
        $this->form_validation->set_rules('parentAttribute', 'Parent Attribute', 'trim');
        $this->form_validation->set_rules('attributeTitle', 'Title', 'trim|required|is_unique[product_attribute.title]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = !empty($this->input->post('parentAttribute')) ? $this->input->post('parentAttribute') : '';
            $input_data['title'] = $this->input->post('attributeTitle');
            $input_data['attribute_order'] = $attribute_order;
            $input_data['language'] = $lang;
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $no_error = TRUE;
            $attribute_id = $this->product_attribute_model->add($input_data);
            if ($lang == 1) {
                $parent_attributes = $this->product_attribute_model->get_all(TRUE);
                if ($parent_attributes) {
                    $attribute_order = 0;
                    foreach ($parent_attributes as $parent_attribute_iten) {
                        $attribute_order++;
                        $input_data = array();
                        $input_data['attribute_order'] = $attribute_order;
                        $this->product_attribute_model->update($input_data, $parent_attribute_iten->id, 1);
                        $this->update_order($parent_attribute_iten->id);
                    }
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/product_attribute/all', 'refresh');
            }
        }
        $this->data['attributes'] = $attributes;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'add_product_attribute';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1)
    {
        if ($id > 0 && $lang == '1') {
            $parent_attribute = $this->product_attribute_model->get($id);
            $attribute = $parent_attribute;
        } else if ($id > 0 && $lang > 0) {
            $parent_attribute = $this->product_attribute_model->get($id);
            if ($parent_attribute) {
                $attribute = $this->product_attribute_model->get_by_lang_parent($id, $lang);
            }
        } else {
            redirect('panel/product_attribute/all', 'refresh');
        }
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_attribute || !$current_language) {
            redirect('panel/product_attribute/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_parent_attribute'] = TRUE;
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $attributes = $this->product_attribute_model->get_all();
        $attribute_languages = $this->product_attribute_model->get_languages($id);
        $this->form_validation->set_rules('parentAttribute', 'Parent Attribute', 'trim');
        if (!$attribute || empty($attribute->title) || $attribute->title != $this->input->post('attributeTitle')) {
            $this->form_validation->set_rules('attributeTitle', 'Title', 'trim|required|is_unique[product_attribute.title]');
        }
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = $this->input->post('parentAttribute');
            $input_data['title'] = $this->input->post('attributeTitle');
            $input_data['language'] = $lang;
            $input_data['attribute_order'] = $parent_attribute->attribute_order;
            if ($lang != 1) {
                $input_data['language_parent'] = $parent_attribute->id;
            } else {
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            if ($attribute) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->product_attribute_model->update($input_data, $attribute->id, $lang);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->product_attribute_model->add($input_data);
            }
            if ($lang == 1) {
                $parent_attributes = $this->product_attribute_model->get_all(TRUE);
                if ($parent_attributes) {
                    $attribute_order = 0;
                    foreach ($parent_attributes as $parent_attribute_iten) {
                        $attribute_order++;
                        $input_data = array();
                        $input_data['attribute_order'] = $attribute_order;
                        $this->product_attribute_model->update($input_data, $parent_attribute_iten->id, 1);
                        $this->update_order($parent_attribute_iten->id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_attribute/all', 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['attribute_languages'] = explode(',', $attribute_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['attributes'] = $attributes;
        $this->data['parent_attribute'] = $parent_attribute;
        $this->data['id'] = $id;
        $this->data['attribute'] = $attribute;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'edit_product_attribute';
        $this->load->view('panel/content', $this->data);
    }

    public function all()
    {
        $parent_attributes = $this->product_attribute_model->get_all(TRUE);
        $all_attributes = $this->product_attribute_model->get_all();
        $this->data['attribute_count'] = $this->product_attribute_model->num_rows;
        $this->data['attribute_items'] = '';
        if ($parent_attributes) {
            $i = 1;
            foreach ($parent_attributes as $parent_attribute) {
                $this->data['sl_no'] = $i;
                $this->data['attribute_id'] = $parent_attribute->id;
                $this->data['title'] = $parent_attribute->title;
                $this->data['attribute_order'] = $parent_attribute->attribute_order;
                $this->data['attribute_items'] .= $this->load->view('panel/product_attribute_item', $this->data, TRUE);
                $this->data['attribute_items'] .= $this->get_child_attribute($parent_attribute->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_attributes as $attribute) {
                $input_data = array();
                $input_data['attribute_order'] = $this->input->post('attribute_order_' . $attribute->id);
                $this->product_attribute_model->update($input_data, $attribute->id);
            }
            $attribute_order = 0;
            $parent_attributes = $this->product_attribute_model->get_all(TRUE);
            foreach ($parent_attributes as $parent_attribute_iten) {
                $attribute_order++;
                $input_data = array();
                $input_data['attribute_order'] = $attribute_order;
                $this->product_attribute_model->update($input_data, $parent_attribute_iten->id, 1);
                $this->update_order($parent_attribute_iten->id);
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_attribute/all', 'refresh');
        }
        $this->data['attributes'] = $parent_attributes;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'product_attribute';
        $this->load->view('panel/content', $this->data);
    }

    public function get_child_attribute($parent_id, $sl_no)
    {
        $attribute_items = '';
        if ($parent_id > 0) {
            $attributes = $this->product_attribute_model->get_by_parent($parent_id);
            if ($attributes) {
                $i = 1;
                foreach ($attributes as $attribute) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['attribute_id'] = $attribute->id;
                    $this->data['title'] = $attribute->title;
                    $this->data['attribute_order'] = $attribute->attribute_order;
                    $attribute_items .= $this->load->view('panel/product_attribute_item', $this->data, TRUE);
                    $attribute_items .= $this->get_child_attribute($attribute->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $attribute_items;
    }

    private function update_order($parent_id)
    {
        if ($parent_id > 0) {
            $attributes = $this->product_attribute_model->get_by_parent($parent_id);
            if ($attributes) {
                $i = 1;
                foreach ($attributes as $attribute) {
                    $input_data = array();
                    $input_data['attribute_order'] = $i;
                    $this->product_attribute_model->update($input_data, $attribute->id);
                    $this->update_order($attribute->id);
                    $i++;
                }
            }
        }
    }

    public function delete($id)
    {
        if ($id > 0) {
            $attribute = $this->product_attribute_model->get($id);
            if ($attribute) {
                $this->product_attribute_model->disable($id);
                $attribute_order = 0;
                $parent_attributes = $this->product_attribute_model->get_all(TRUE);
                if ($parent_attributes) {
                    foreach ($parent_attributes as $parent_attribute_iten) {
                        $attribute_order++;
                        $input_data = array();
                        $input_data['attribute_order'] = $attribute_order;
                        $this->product_attribute_model->update($input_data, $parent_attribute_iten->id, 1);
                        $this->update_order($parent_attribute_iten->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/product_attribute/all', 'refresh');
    }

    public function add_value($id, $lang = 1)
    {
        $attribute = $this->product_attribute_model->get($id);
        if (!$attribute || $id < 0) {
            redirect('panel/product_attribute/all_value', 'refresh');
        }
        $filter = array();
        $filter['lang'] = 1;
        $filter['attribute_id'] = $id;
        $all_attribute_values = $this->product_attribute_value_model->get_all($filter);
        $filter = array();
        $filter['parent_only'] = true;
        $filter['lang'] = 1;
        $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
        $value_order = $this->product_attribute_value_model->num_rows;
        $this->form_validation->set_rules('attributeValue', 'Value', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            if ($this->product_attribute_value_model->check_value_exists($this->input->post('attributeValue'), $id) != TRUE) {
                $input_data = array();
                $input_data['attribute_id'] = $id;
                $input_data['attribute_value'] = $this->input->post('attributeValue');
                $input_data['language'] = $lang;
                $input_data['value_order'] = $value_order;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['active'] = '1';
                $this->product_attribute_value_model->add($input_data);
                if ($lang == 1) {
                    $value_order = 0;
                    $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
                    if($parent_attribute_values) {
                        foreach ($parent_attribute_values as $parent_attribute_value) {
                            $value_order++;
                            $input_data = array();
                            $input_data['value_order'] = $value_order;
                            $this->product_attribute_value_model->update($input_data, $parent_attribute_value->id, 1);
                            $this->update_order_attr_value($parent_attribute_value->id);
                        }
                    }
                }
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('/panel/product_attribute/all_value/' . $attribute->id, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Value already exists.');
                redirect('/panel/product_attribute/add_value/' . $id, 'refresh');
            }
        }
        $this->data['attribute'] = $attribute;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'add_product_attribute_value';
        $this->load->view('panel/content', $this->data);
    }

    public function edit_value($id, $value_id, $lang = 1)
    {
        $attribute = $this->product_attribute_model->get($id);
        if ($id > 0 && $value_id > 0 && $lang == '1' && $attribute) {
            $parent_attribute_value = $this->product_attribute_value_model->get($value_id);
            $attribute_value = $parent_attribute_value;
        } else if ($id > 0 && $value_id > 0 && $lang > 0 && $attribute) {
            $parent_attribute_value = $this->product_attribute_value_model->get($value_id);
            if ($parent_attribute_value) {
                $attribute_value = $this->product_attribute_value_model->get_by_lang_parent($value_id, $lang);
            }
        } else {
            redirect('panel/product_attribute/all', 'refresh');
        }
        $value_order = 0;
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_attribute_value || !$current_language) {
            redirect('panel/product_attribute/all_value', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $filter = array();
        $filter['parent_only'] = true;
        $filter['lang'] = 1;
        $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
        $value_languages = $this->product_attribute_value_model->get_languages($value_id);
        $this->form_validation->set_rules('attributeValue', 'Value', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            if ($this->product_attribute_value_model->check_value_exists($this->input->post('attributeValue'), $id, $lang) != TRUE || $this->input->post('attributeValue') == $attribute_value->attribute_value) {
                $input_data = array();
                $input_data['attribute_value'] = $this->input->post('attributeValue');
                if ($lang != 1) {
                    $input_data['attribute_id'] = '';
                    $input_data['language_parent'] = $parent_attribute_value->id;
                    $input_data['value_order'] = '';
                } else {
                    $input_data['attribute_id'] = $id;
                    $input_data['value_order'] = $value_order;
                    $input_data['language_parent'] = '';
                }
                $input_data['language'] = $lang;
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $input_data['active'] = '1';
                if ($attribute_value) {
                    $input_data['updated_at'] = time();
                    $input_data['updated_by'] = $_SESSION['user_id'];
                    $this->product_attribute_value_model->update($input_data, $attribute_value->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->product_attribute_value_model->add($input_data);
                }
                if ($lang == 1) {
                    $value_order = 0;
                    $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
                    if($parent_attribute_values) {
                        foreach ($parent_attribute_values as $parent_attribute_value) {
                            $value_order++;
                            $input_data = array();
                            $input_data['value_order'] = $value_order;
                            $this->product_attribute_value_model->update($input_data, $parent_attribute_value->id, 1);
                            $this->update_order_attr_value($parent_attribute_value->id);
                        }
                    }
                }
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('/panel/product_attribute/all_value/' . $id . '/' . $value_id, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Value already exists.');
                redirect('/panel/product_attribute/all_value/' . $id . '/' . $value_id, 'refresh');
            }
        }
        $this->data['value_languages'] = explode(',', $value_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['current_language'] = $current_language;
        $this->data['attribute'] = $attribute;
        $this->data['attribute_value'] = $attribute_value;
        $this->data['parent_attribute_value'] = $parent_attribute_value;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'edit_product_attribute_value';
        $this->load->view('panel/content', $this->data);
    }

    public function all_value($id)
    {
        $attribute = $this->product_attribute_model->get($id);
        if (!$attribute) {
            redirect('panel/product_attribute/all');
        }
        $this->data['value_items'] = '';
        $filter = array();
        $filter['parent_only'] = true;
        $filter['lang'] = 1;
        $filter['attribute_id'] = $id;
        $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
        $filter = array();
        $filter['lang'] = 1;
        $filter['attribute_id'] = $id;
        $this->data['attribute_id'] = $id;
        $all_attribute_values = $this->product_attribute_value_model->get_all($filter);
        $all_attribute_values_num_rows = $this->product_attribute_value_model->num_rows;
        if ($parent_attribute_values) {
            $i = 1;
            foreach ($parent_attribute_values as $parent_attribute_value) {
                $this->data['sl_no'] = $i;
                $this->data['value_count'] = $all_attribute_values_num_rows;
                $this->data['value_id'] = $parent_attribute_value->id;
                $this->data['attribute_value'] = $parent_attribute_value->attribute_value;
                $this->data['value_order'] = $parent_attribute_value->value_order;
                $this->data['value_items'] .= $this->load->view('panel/product_attribute_value_item', $this->data, TRUE);
                $this->data['value_items'] .= $this->get_child_attr_value($parent_attribute_value->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_attribute_values as $all_attribute_value) {
                $input_data = array();
                $input_data['value_order'] = $this->input->post('value_order' . $all_attribute_value->id);
                $this->product_attribute_value_model->update($input_data, $all_attribute_value->id);
            }
            $value_order = 0;
            $filter = array();
            $filter['parent_only'] = true;
            $filter['lang'] = 1;
            $parent_attribute_values = $this->product_attribute_value_model->get_all($filter);
            foreach ($parent_attribute_values as $parent_attribute_value) {
                $value_order++;
                $input_data = array();
                $input_data['value_order'] = $value_order;
                $this->product_attribute_value_model->update($input_data, $parent_attribute_value->id, 1);
                $this->update_order_attr_value($parent_attribute_value->id);
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_attribute/all_value/' . $id, 'refresh');
        }
        $this->data['attribute'] = $attribute;
        $this->data['active_menu'] = 'product_attribute';
        $this->data['site_content'] = 'product_attribute_value';
        $this->load->view('panel/content', $this->data);
    }

    public function get_child_attr_value($parent_id, $sl_no)
    {
        $value_items = '';
        if ($parent_id > 0) {
            $filter['parent_id'] = $parent_id;
            $values = $this->product_attribute_value_model->get_all($filter);
            $values_num_rows = $this->product_attribute_value_model->num_rows;
            if ($values) {
                $i = 1;
                foreach ($values as $value) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['value_count'] = $values_num_rows;
                    $this->data['value_id'] = $value->id;
                    $this->data['attribute_value'] = $value->attribute_value;
                    $this->data['value_order'] = $value->value_order;
                    $value_items .= $this->load->view('panel/product_attribute_value_item', $this->data, TRUE);
                    $value_items .= $this->get_child_attr_value($value->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $value_items;
    }

    private function update_order_attr_value($parent_id)
    {
        if ($parent_id > 0) {
            $filter = array();
            $filter['parent_id'] = $parent_id;
            $attr_values = $this->product_attribute_value_model->get_all($filter);
            if ($attr_values) {
                $i = 1;
                foreach ($attr_values as $attr_value) {
                    $input_data = array();
                    $input_data['value_order'] = $i;
                    $this->product_attribute_value_model->update($input_data, $attr_value->id);
                    $this->update_order_attr_value($attr_value->id);
                    $i++;
                }
            }
        }
    }

    public function delete_attr_value($id, $attribute_id)
    {
        if ($id > 0) {
            $menu = $this->product_attribute_value_model->get($id);
            if ($menu) {
                $this->product_attribute_value_model->disable($id);
                $value_order = 0;
                $filter = array();
                $filter['lang'] = 1;
                $filter['parent_only'] = true;
                $parent_attr_values = $this->product_attribute_value_model->get_all(TRUE);
                if ($parent_attr_values) {
                    foreach ($parent_attr_values as $parent_attr_value) {
                        $value_order++;
                        $input_data = array();
                        $input_data['value_order'] = $value_order;
                        $this->product_attribute_value_model->update($input_data, $parent_attr_value->id, 1);
                        $this->update_order_attr_value($parent_attr_value->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/product_attribute/all_value/' . $attribute_id, 'refresh');
    }

}
