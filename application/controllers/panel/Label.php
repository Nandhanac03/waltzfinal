<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Label extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Label_model', 'label_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_label_parent'] = TRUE;
        $controller_config['disable_label_keyword'] = FALSE;
        $controller_config['disable_label_languages'] = FALSE;
        $controller_config['disable_label_add'] = FALSE;
        $controller_config['disable_label_edit'] = FALSE;
        $controller_config['disable_label_delete'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/label/all', 'refresh');
    }

    public function add($lang = 1) {
        $label_order = 0;
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/label/all', 'refresh');
        }
        $labels = $this->label_model->get_all();
        $this->form_validation->set_rules('parentLabel', 'parent label', 'trim');
        $this->form_validation->set_rules('labelTitle', 'title', 'trim|required|is_unique[label.title]');
        $this->form_validation->set_rules('labelKeyword', 'keyword', 'trim|required|strtoupper|alpha_dash|is_unique[label.keyword]');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = !empty($this->input->post('parentLabel')) ? $this->input->post('parentLabel') : '';
            $input_data['title'] = $this->input->post('labelTitle');
            $input_data['keyword'] = $this->input->post('labelKeyword');
            $input_data['label_order'] = $label_order;
            $input_data['language'] = $lang;
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $no_error = TRUE;
            $label_id = $this->label_model->add($input_data);
            $label_order = 0;
            $parent_labels = $this->label_model->get_all(TRUE);
            foreach ($parent_labels as $parent_label_item) {
                $label_order++;
                $input_data = array();
                $input_data['label_order'] = $label_order;
                $this->label_model->update($input_data, $parent_label_item->id, 1);
                $this->update_order($parent_label_item->id);
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/label/add', 'refresh');
            }
        }
        $this->data['labels'] = $labels;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'label';
        $this->data['site_content'] = 'add_label';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        if ($id > 0 && $lang == '1') {
            $parent_label = $this->label_model->get($id);
            $label = $parent_label;
        } else if ($id > 0 && $lang > 0) {
            $parent_label = $this->label_model->get($id);
            if ($parent_label) {
                $label = $this->label_model->get_by_lang_parent($id, $lang);
            }
        } else {
            redirect('panel/label/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_label_parent'] = TRUE;
            $this->data['controller_config']['disable_label_keyword'] = TRUE;
        }
        $label_order = 0;
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_label || !$current_language) {
            redirect('panel/label/all', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $labels = $this->label_model->get_all();
        $label_languages = $this->label_model->get_languages($id);
        $this->form_validation->set_rules('parentLabel', 'parent label', 'trim');
        if (!$label || empty($label->title) || strtolower($label->title) != strtolower($this->input->post('labelTitle'))) {
            if ($lang == '1') {
                $this->form_validation->set_rules('labelTitle', 'title', 'trim|required|is_unique[label.title]');
            } else {
                $this->form_validation->set_rules('labelTitle', 'title', 'trim');
            }
        }
        if ($this->data['controller_config']['disable_label_keyword'] != true) {
            if (!$label || empty($label->keyword) || strtolower($label->keyword) != strtolower($this->input->post('labelKeyword'))) {
                $this->form_validation->set_rules('labelKeyword', 'keyword', 'trim|required|strtoupper|is_unique[label.keyword]');
            }
        }
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['title'] = $this->input->post('labelTitle');
            if ($this->data['controller_config']['disable_label_keyword'] != true) {
                $input_data['keyword'] = $this->input->post('labelKeyword');
            }
            $input_data['parent_id'] = $this->input->post('parentLabel');
            $input_data['language'] = $lang;
            if ($lang != 1) {
                $input_data['language_parent'] = $parent_label->id;
                $input_data['label_order'] = '';
            } else {
                $input_data['label_order'] = $label_order;
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            if ($label) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->label_model->update($input_data, $label->id, $lang);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->label_model->add($input_data);
            }
            if ($lang == 1) {
                $parent_labels = $this->label_model->get_all(TRUE);
                if ($parent_labels) {
                    foreach ($parent_labels as $parent_label_item) {
                        $label_order++;
                        $input_data = array();
                        $input_data['label_order'] = $label_order;
                        $this->label_model->update($input_data, $parent_label_item->id, 1);
                        $this->update_order($parent_label_item->id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/label/edit/' . $id . '/' . $lang, 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['label_languages'] = explode(',', $label_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['labels'] = $labels;
        $this->data['parent_label'] = $parent_label;
        $this->data['id'] = $id;
        $this->data['label'] = $label;
        $this->data['active_menu'] = 'label';
        $this->data['site_content'] = 'edit_label';
        $this->load->view('panel/content', $this->data);
    }

    public function all() {
        $all_labels = $this->label_model->get_all();
        $parent_labels = $this->label_model->get_all(TRUE);
        $parent_labels_num_rows=$this->label_model->num_rows;
        $this->data['label_items'] = '';
        if ($parent_labels) {
            $i = 1;
            foreach ($parent_labels as $parent_label) {
                $this->data['sl_no'] = $i;
                $this->data['label_count'] = $parent_labels_num_rows;
                $this->data['label_id'] = $parent_label->id;
                $this->data['title'] = $parent_label->title;
                $this->data['label_order'] = $parent_label->label_order;
                $this->data['keyword'] = $parent_label->keyword;
                $this->data['label_items'] .= $this->load->view('panel/label_item', $this->data, TRUE);
                $this->data['label_items'] .= $this->get_child_label($parent_label->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_labels as $label) {
                $input_data = array();
                $input_data['label_order'] = $this->input->post('label_order_' . $label->id);
                $this->label_model->update($input_data, $label->id);
            }
            $label_order = 0;
            $parent_labels = $this->label_model->get_all(TRUE);
            foreach ($parent_labels as $parent_label_item) {
                $label_order++;
                $input_data = array();
                $input_data['label_order'] = $label_order;
                $this->label_model->update($input_data, $parent_label_item->id, 1);
                $this->update_order($parent_label_item->id);
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/label/all', 'refresh');
        }
        $this->data['labels'] = $parent_labels;
        $this->data['active_menu'] = 'label';
        $this->data['site_content'] = 'label';
        $this->load->view('panel/content', $this->data);
    }

    public function get_child_label($parent_id, $sl_no) {
        $label_items = '';
        if ($parent_id > 0) {
            $labels = $this->label_model->get_by_parent($parent_id);
            $labels_num_rows = $this->label_model->num_rows;
            if ($labels) {
                $i = 1;
                foreach ($labels as $label) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['label_count'] = $labels_num_rows;
                    $this->data['label_id'] = $label->id;
                    $this->data['title'] = $label->title;
                    $this->data['label_order'] = $label->label_order;
                    $this->data['keyword'] = $label->keyword;
                    $label_items .= $this->load->view('panel/label_item', $this->data, TRUE);
                    $label_items .= $this->get_child_label($label->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $label_items;
    }

    private function update_order($parent_id) {
        if ($parent_id > 0) {
            $labels = $this->label_model->get_by_parent($parent_id);
            if ($labels) {
                $i = 1;
                foreach ($labels as $label) {
                    $input_data = array();
                    $input_data['label_order'] = $i;
                    $this->label_model->update($input_data, $label->id);
                    $this->update_order($label->id);
                    $i++;
                }
            }
        }
    }

    public function delete($id) {
        if ($id > 0) {
            $label = $this->label_model->get($id);
            if ($label) {
                $this->label_model->disable($id);
                $label_order = 0;
                $parent_labels = $this->label_model->get_all(TRUE);
                if ($parent_labels) {
                    foreach ($parent_labels as $parent_label_item) {
                        $label_order++;
                        $input_data = array();
                        $input_data['label_order'] = $label_order;
                        $this->label_model->update($input_data, $parent_label_item->id, 1);
                        $this->update_order($parent_label_item->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/label/all', 'refresh');
    }

}
