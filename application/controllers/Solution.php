<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solution extends CO_Web_Controller
{
    function __construct()
    {
        parent::__construct();
        // loading models
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Solution_model', 'solution_model');
        $this->load->model('Solution_category_model', 'solution_category_model');
        $this->load->model('Solution_additional_info_model', 'solution_additional_info_model');
        $this->load->model('Solution_file_model', 'solution_file_model');
    }

    public function index()
    {
        redirect('solution/info/');
    }
    public function info($slug = '')
    {
        if ($slug) {
            $this->data['solution_banner'] = $this->file_model->get_all(5);

            $allsolution = $this->solution_model->get_by_slug($slug);


            $solution = $this->solution_model->get_by_slug($slug);
            if (empty($solution)) {
                redirect(base_url(''));
            }
            $solution = $solution[0];

            $this->data['solution'] = $solution;
            $solution_id = $solution->id;
            $solution_images = $this->solution_file_model->get_files(array('solution_id' => $solution_id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1));
            $this->data['solution_images'] = $solution_images;
            $solution_documents = $this->solution_file_model->get_files(array('solution_id' => $solution_id, 'file_for' => 'O', 'file_type' => 'O', 'active' => 1));
            $this->data['solution_documents'] = $solution_documents;


            $formatted_description = $solution->description;
            if ($formatted_description != '') {
                // Check if content contains <ul>
                if (strpos($formatted_description, "<ul>") !== false) {
                    // Replace <ul>
                    $formatted_description = str_replace("<ul>", '<ul class="list-group">', $formatted_description);

                    // Replace <li> with new icon + text structure
                    if (strpos($formatted_description, "<li>") !== false) {
                        $formatted_description = preg_replace(
                            '/<li>(.*?)(<\/li>)/',
                            '<li class="list-group-item"><span class="pbmit-icon-list-icon"><i
                                                        class="pbmit-solaar-icon pbmit-solaar-icon-verified"></i></span><span
                                                    class="pbmit-icon-list-text">$1</li>',
                            $formatted_description
                        );
                    }
                } else {
                    // Wrap non-list content in a formatted div
                    $formatted_description = '<div class="formatted-text">' . $formatted_description . '</div>';
                }
            }
            $solution->formatted_description = $formatted_description;


            // Process short description
            $formatted_short_desc = $solution->short_desc;
            if ($formatted_short_desc != '') {
                // Check if content contains <ul>
                if (strpos($formatted_short_desc, "<ul>") !== false) {
                    // Replace <ul>
                    $formatted_short_desc = str_replace("<ul>", '<ul class="list-group">', $formatted_short_desc);

                    // Replace <li> with new icon + text structure
                    if (strpos($formatted_short_desc, "<li>") !== false) {
                        $formatted_short_desc = preg_replace(
                            '/<li>(.*?)(<\/li>)/',
                            '<li class="list-group-item"><span class="pbmit-icon-list-icon"><i
                                                        class="pbmit-solaar-icon pbmit-solaar-icon-verified"></i></span><span
                                                    class="pbmit-icon-list-text">$1</li>',
                            $formatted_short_desc
                        );
                    }
                } else {
                    // Wrap non-list content in a formatted div
                    $formatted_short_desc = '<div class="formatted-text">' . $formatted_short_desc . '</div>';
                }
            }
            $solution->formatted_short_desc = $formatted_short_desc;

            $solution->formatted_short_desc = $formatted_short_desc;


            $solution_additional_info = $this->solution_additional_info_model->get_by_solution_id($solution_id);
            $this->data['solution_additional_info'] = $solution_additional_info;

            // echo '<pre>';print_r($solution_images);exit;

            $category_id = $solution->category_id;

            $solution_category = $this->solution_category_model->get($category_id);

            $this->data['site_content'] = 'solutionchild';


            // if ($solution_category->parent_id) {
            //     $this->data['site_content'] = 'solutionchild';
            // } else {

            //     $this->data['site_content'] = 'solution';
            // }
        } else {
            redirect(base_url(''));
        }

        $this->data['active_menu'] = 'solution';
        $this->load->view('web/content', $this->data);
    }
}
