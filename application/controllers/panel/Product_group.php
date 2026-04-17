<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_group extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Product_group_model', 'product_group_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_add_pr_group'] = TRUE;
        $controller_config['disable_delete_pr_group'] = TRUE;
        $controller_config['disable_delete_pr_group_order'] = TRUE;
        $controller_config['disable_languages_pr_group'] = FALSE;
        $controller_config['disable_parent_pr_group'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/product_group/all');
    }

    public function add($lang = 1) {
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/product_group/all', 'refresh');
        }
        $groups = $this->product_group_model->get_all();
        $group_order = $this->product_group_model->num_rows+1;
        $this->form_validation->set_rules('parentGroup', 'parent group', 'trim');
        $this->form_validation->set_rules('groupTitle', 'title', 'trim|required|is_unique[product_group.title]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = !empty($this->input->post('parentGroup')) ? $this->input->post('parentGroup') : '';
            $input_data['title'] = $this->input->post('groupTitle');
            $input_data['group_order'] = $group_order;
            $input_data['language'] = $lang;
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $no_error = TRUE;
            $group_id = $this->product_group_model->add($input_data);
            if ($group_id <= 0) {
                $no_error = FALSE;
            }
            if ($lang == 1) {
                $parent_groups = $this->product_group_model->get_all(TRUE);
                if ($parent_groups) {
                    $group_order=0;
                    foreach ($parent_groups as $parent_group_iten) {
                        $group_order++;
                        $input_data = array();
                        $input_data['group_order'] = $group_order;
                        $this->product_group_model->update($input_data, $parent_group_iten->id, 1);
                        $this->update_order($parent_group_iten->id);
                    }
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/product_group/all', 'refresh');
            }
        }
        $this->data['groups'] = $groups;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'product_group';
        $this->data['site_content'] = 'add_product_group';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        if ($id > 0 && $lang == '1') {
            $parent_group = $this->product_group_model->get($id);
            $group = $parent_group;
        } else if ($id > 0 && $lang > 0) {
            $parent_group = $this->product_group_model->get($id);
            if ($parent_group) {
                $group = $this->product_group_model->get_by_lang_parent($id, $lang);
            }
        } else {
            redirect('panel/product_group/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_parent_pr_group'] = TRUE;
        }
        $group_order = 0;
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_group || !$current_language) {
            redirect('panel/product_group/all', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $groups = $this->product_group_model->get_all();
        $group_languages = $this->product_group_model->get_languages($id);
        $this->form_validation->set_rules('parentGroup', 'parent group', 'trim');
        if (!$group || empty($group->title) || $group->title != $this->input->post('groupTitle')) {
            $this->form_validation->set_rules('groupTitle', 'title', 'trim|required|is_unique[product_group.title]');
        }
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = $this->input->post('parentGroup');
            $input_data['title'] = $this->input->post('groupTitle');
            $input_data['language'] = $lang;
            $input_data['group_order'] = $parent_group->group_order;
            if ($lang != 1) {
                $input_data['language_parent'] = $parent_group->id;
            } else {
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            if ($group) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->product_group_model->update($input_data, $group->id, $lang);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->product_group_model->add($input_data);
            }
            if ($lang == 1) {
                $parent_groups = $this->product_group_model->get_all(TRUE);
                if ($parent_groups) {
                    $group_order=0;
                    foreach ($parent_groups as $parent_group_iten) {
                        $group_order++;
                        $input_data = array();
                        $input_data['group_order'] = $group_order;
                        $this->product_group_model->update($input_data, $parent_group_iten->id, 1);
                        $this->update_order($parent_group_iten->id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_group/all', 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['group_languages'] = explode(',', $group_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['groups'] = $groups;
        $this->data['parent_group'] = $parent_group;
        $this->data['id'] = $id;
        $this->data['group'] = $group;
        $this->data['active_menu'] = 'product_group';
        $this->data['site_content'] = 'edit_product_group';
        $this->load->view('panel/content', $this->data);
    }

    public function all() {
        $parent_groups = $this->product_group_model->get_all(TRUE);
        $all_groups = $this->product_group_model->get_all();
        $this->data['group_items'] = '';
        $this->data['group_count'] = $this->product_group_model->num_rows;
        if ($parent_groups) {
            $i = 1;
            foreach ($parent_groups as $parent_group) {
                $this->data['sl_no'] = $i;
                $this->data['group_id'] = $parent_group->id;
                $this->data['title'] = $parent_group->title;
                $this->data['group_order'] = $parent_group->group_order;
                $this->data['group_items'] .= $this->load->view('panel/product_group_item', $this->data, TRUE);
                $this->data['group_items'] .= $this->get_child_group($parent_group->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_groups as $group) {
                $input_data = array();
                $input_data['group_order'] = $this->input->post('group_order_' . $group->id);
                $this->product_group_model->update($input_data, $group->id);
            }
            $group_order = 0;
            $parent_groups = $this->product_group_model->get_all(TRUE);
            foreach ($parent_groups as $parent_group_iten) {
                $group_order++;
                $input_data = array();
                $input_data['group_order'] = $group_order;
                $this->product_group_model->update($input_data, $parent_group_iten->id, 1);
                $this->update_order($parent_group_iten->id);
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/product_group/all', 'refresh');
        }
        $this->data['groups'] = $parent_groups;
        $this->data['active_menu'] = 'product_group';
        $this->data['site_content'] = 'product_group';
        $this->load->view('panel/content', $this->data);
    }

    public function get_child_group($parent_id, $sl_no) {
        $group_items = '';
        if ($parent_id > 0) {
            $groups = $this->product_group_model->get_by_parent($parent_id);
            if ($groups) {
                $i = 1;
                foreach ($groups as $group) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['group_id'] = $group->id;
                    $this->data['title'] = $group->title;
                    $this->data['group_order'] = $group->group_order;
                    $group_items .= $this->load->view('panel/product_group_item', $this->data, TRUE);
                    $group_items .= $this->get_child_group($group->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $group_items;
    }

    private function update_order($parent_id) {
        if ($parent_id > 0) {
            $groups = $this->product_group_model->get_by_parent($parent_id);
            if ($groups) {
                $i = 1;
                foreach ($groups as $group) {
                    $input_data = array();
                    $input_data['group_order'] = $i;
                    $this->product_group_model->update($input_data, $group->id);
                    $this->update_order($group->id);
                    $i++;
                }
            }
        }
    }

    public function delete($id) {
        if ($id > 0) {
            $group = $this->product_group_model->get($id);
            if ($group) {
                $this->product_group_model->disable($id);
                $group_order = 0;
                $parent_groups = $this->product_group_model->get_all(TRUE);
                if ($parent_groups) {
                    foreach ($parent_groups as $parent_group_iten) {
                        $group_order++;
                        $input_data = array();
                        $input_data['group_order'] = $group_order;
                        $this->product_group_model->update($input_data, $parent_group_iten->id, 1);
                        $this->update_order($parent_group_iten->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/product_group/all', 'refresh');
    }

}
