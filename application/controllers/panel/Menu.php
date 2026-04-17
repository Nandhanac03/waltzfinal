<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        //loading models
        $this->load->model('Menu_model', 'menu_model');
        $this->load->model('Language_model', 'language_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_menu_add'] = true;
        $controller_config['disable_menu_delete'] = FALSE;

        $controller_config['disable_menu_parent'] = FALSE;
        $controller_config['disable_menu_languages'] = FALSE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index() {
        redirect('panel/menu/all', 'refresh');
    }

    public function add($lang = 1) {
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language) {
            redirect('panel/menu/all', 'refresh');
        }
        $menus = $this->menu_model->get_all();
        $menu_order = $this->menu_model->num_rows+1;
        $this->form_validation->set_rules('parentMenu', 'parent menu', 'trim');
        $this->form_validation->set_rules('menuTitle', 'title', 'trim|required|is_unique[menu.title]');
        $this->form_validation->set_rules('menuSlugTitle', 'slug title', 'trim|required|is_unique[article.title_slug]');

        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['parent_id'] = !empty($this->input->post('parentMenu')) ? $this->input->post('parentMenu') : '';
            $input_data['title'] = $this->input->post('menuTitle');
            $input_data['title_slug'] = $this->input->post('menuSlugTitle');
            $input_data['menu_order'] = $menu_order;
            $input_data['language'] = $lang;
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $no_error = TRUE;
            $menu_id = $this->menu_model->add($input_data);
            $parent_menus = $this->menu_model->get_all(TRUE);
            if($parent_menus) {
                $menu_order = 0;
                foreach ($parent_menus as $parent_menu_item) {
                    $menu_order++;
                    $input_data = array();
                    $input_data['menu_order'] = $menu_order;
                    $this->menu_model->update($input_data, $parent_menu_item->id, 1);
                    $this->update_order($parent_menu_item->id);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/menu/all', 'refresh');
            }
        }
        $this->data['menus'] = $menus;
        $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'menu';
        $this->data['site_content'] = 'add_menu';
        $this->load->view('panel/content', $this->data);
    }

    public function edit($id, $lang = 1) {
        if ($id > 0 && $lang == '1') {
            $parent_menu = $this->menu_model->get($id);
            $menu = $parent_menu;
        } else if ($id > 0 && $lang > 0) {
            $parent_menu = $this->menu_model->get($id);
            if ($parent_menu) {
                $menu = $this->menu_model->get_by_lang_parent($id, $lang);
            }
        } else {
            redirect('panel/menu/all', 'refresh');
        }
        //disabling feature based on language
        if ($lang != 1) {
            $this->data['controller_config']['disable_menu_parent'] = TRUE;
        }
        $menu_order = 0;
        $current_language = $this->language_model->get_language($lang);
        if (!$parent_menu || !$current_language) {
            redirect('panel/menu/all', 'refresh');
        }
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $menus = $this->menu_model->get_all();
        $menu_languages = $this->menu_model->get_languages($id);
        $this->form_validation->set_rules('parentMenu', 'parent menu', 'trim');
        if (!$menu || empty($menu->title) || $menu->title != $this->input->post('menuTitle')) {
            $this->form_validation->set_rules('menuTitle', 'title', 'trim|required');
        }
        $this->form_validation->set_rules('menuSlugTitle', 'slug_title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['title'] = $this->input->post('menuTitle');
            $input_data['title_slug'] = $this->input->post('menuSlugTitle');
            $input_data['parent_id'] = $this->input->post('parentMenu');
            $input_data['language'] = $lang;
            if ($lang != 1) {
                $input_data['language_parent'] = $parent_menu->id;
                $input_data['menu_order'] = '';
            } else {
                $input_data['menu_order'] = $menu_order;
                $input_data['language_parent'] = '';
            }
            $input_data['active'] = 1;
            if ($menu) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->menu_model->update($input_data, $menu->id, $lang);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->menu_model->add($input_data);
            }
            if ($lang == 1) {
                $parent_menus = $this->menu_model->get_all(TRUE);
                if ($parent_menus) {
                    foreach ($parent_menus as $parent_menu_item) {
                        $menu_order++;
                        $input_data = array();
                        $input_data['menu_order'] = $menu_order;
                        $this->menu_model->update($input_data, $parent_menu_item->id, 1);
                        $this->update_order($parent_menu_item->id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/menu/edit/' . $id . '/' . $lang, 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['menu_languages'] = explode(',', $menu_languages->languages);
        $this->data['languages'] = $languages;
        $this->data['menus'] = $menus;
        $this->data['parent_menu'] = $parent_menu;
        $this->data['id'] = $id;
        $this->data['menu'] = $menu;
        $this->data['active_menu'] = 'menu';
        $this->data['site_content'] = 'edit_menu';
        $this->load->view('panel/content', $this->data);
    }

    public function all() {
        $parent_menus = $this->menu_model->get_all(TRUE);
        $all_menus = $this->menu_model->get_all();
        //echo $all_menus[0]->title; echo '<pre>'; print_r($all_menus); exit;
        $this->data['menu_count'] = $this->menu_model->num_rows;
        $this->data['menu_items'] = '';
        if ($parent_menus) {
            $i = 1;
            foreach ($parent_menus as $parent_menu) {
                $this->data['sl_no'] = $i;
                $this->data['menu_id'] = $parent_menu->id;
                $this->data['title'] = $parent_menu->title;
                $this->data['menu_order'] = $parent_menu->menu_order;
                $this->data['menu_items'] .= $this->load->view('panel/menu_item', $this->data, TRUE);
                $this->data['menu_items'] .= $this->get_child_menu($parent_menu->id, $i);
                $i++;
            }
        }
        if ($_POST) {
            foreach ($all_menus as $menu) {
                $input_data = array();
                $input_data['menu_order'] = $this->input->post('menu_order_' . $menu->id);
                $this->menu_model->update($input_data, $menu->id);
            }
            $parent_menus = $this->menu_model->get_all(TRUE);
            if($parent_menus) {
                $menu_order = 0;
                foreach ($parent_menus as $parent_menu_item) {
                    $menu_order++;
                    $input_data = array();
                    $input_data['menu_order'] = $menu_order;
                    $this->menu_model->update($input_data, $parent_menu_item->id, 1);
                    $this->update_order($parent_menu_item->id);
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/menu/all', 'refresh');
        }
        $this->data['menus'] = $parent_menus;
        $this->data['active_menu'] = 'menu';
        $this->data['site_content'] = 'menu';
        $this->load->view('panel/content', $this->data);
    }

    public function get_child_menu($parent_id, $sl_no) {
        $menu_items = '';
        if ($parent_id > 0) {
            $menus = $this->menu_model->get_by_parent($parent_id);
            if ($menus) {
                $i = 1;
                foreach ($menus as $menu) {
                    $this->data['sl_no'] = $sl_no . '.' . $i;
                    $this->data['menu_id'] = $menu->id;
                    $this->data['title'] = $menu->title;
                    $this->data['menu_order'] = $menu->menu_order;
                    $menu_items .= $this->load->view('panel/menu_item', $this->data, TRUE);
                    $menu_items .= $this->get_child_menu($menu->id, $this->data['sl_no']);
                    $i++;
                }
            }
        }
        return $menu_items;
    }

    private function update_order($parent_id) {
        if ($parent_id > 0) {
            $menus = $this->menu_model->get_by_parent($parent_id);
            if ($menus) {
                $i = 1;
                foreach ($menus as $menu) {
                    $input_data = array();
                    $input_data['menu_order'] = $i;
                    $this->menu_model->update($input_data, $menu->id);
                    $this->update_order($menu->id);
                    $i++;
                }
            }
        }
    }

    public function delete($id) {
        if ($id > 0) {
            $menu = $this->menu_model->get($id);
            if ($menu) {
                $this->menu_model->disable($id);
                $menu_order = 0;
                $parent_menus = $this->menu_model->get_all(TRUE);
                if ($parent_menus) {
                    foreach ($parent_menus as $parent_menu_item) {
                        $menu_order++;
                        $input_data = array();
                        $input_data['menu_order'] = $menu_order;
                        $this->menu_model->update($input_data, $parent_menu_item->id, 1);
                        $this->update_order($parent_menu_item->id);
                    }
                }
            }
        }
        $this->session->set_flashdata('success', 'Deleted successfully.');
        redirect('panel/menu/all', 'refresh');
    }

}
