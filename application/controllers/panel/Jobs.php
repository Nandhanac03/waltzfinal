<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Album_model', 'album_model');
        $this->load->model('File_model', 'file_model');
        $this->load->model('File_description_model', 'file_description_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Candidate_model', 'candidate_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration
        $controller_config = array();
        // $controller_config['disable_album_add'] = FALSE;
        // $controller_config['disable_album_delete'] = FALSE;
        // $controller_config['disable_album_file_edit'] = FALSE;
        // $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_jobs_location'] = false;
        $controller_config['disable_jobs_sector'] = false;
        $controller_config['disable_jobs_short_description'] = true;
        $controller_config['disable_jobs_description'] = FALSE;
        $controller_config['disable_jobs_description_img'] = true;
        $controller_config['disable_album_file_link'] = false;
        $controller_config['disable_jobs_canonical_url'] = true;
        $controller_config['disable_news_type'] = TRUE;
        $controller_config['disable_news_save_draft'] = TRUE;
        $controller_config['disable_jobs_seo'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/jobs/all', 'refresh');
    }

    public function all()
    {
        // $filter=array();
        // echo"<pre>";print_r($_POST);exit;
        $filter=array();
        $this->form_validation->set_rules('filterNewsTitle', 'filterNewsTitle', 'trim');
        $this->form_validation->set_rules('filterNewsPublishedAt', 'filterNewsPublishedAt', 'trim');
        if ($this->form_validation->run() === true) {
            // echo"workgin";exit;
            $title= $this->input->post('filterNewsTitle');
            $filterNewsPublishedAt= $this->input->post('filterNewsPublishedAt');
            if ($this->input->post('filterNewsTitle') != '') {
                $filter['title'] = $title;
            }
            if ($this->input->post('filterNewsPublishedAt') != '') {
                $filterNewsPublishedAt = explode('-', $this->input->post('filterNewsPublishedAt'));
                if (!empty($filterNewsPublishedAt[0])) {
                    $filterNewsPublishedAt[0] = str_replace('/', '-', $filterNewsPublishedAt[0]);
                    $filter['from_created_at'] = strtotime($filterNewsPublishedAt[0]);
                }
                if (!empty($filterNewsPublishedAt[1])) {
                    $filterNewsPublishedAt[1] = str_replace('/', '-', $filterNewsPublishedAt[1]);
                    $filter['to_created_at'] = strtotime($filterNewsPublishedAt[1]);
                }
                // $filter['filterNewsPublishedAt'] = $filterNewsPublishedAt;
            }
        }
        $jobs = $this->jobs_model->get_all_for_panel($filter);
        // echo "<pre>";
        // print_r($jobs);
        // exit;
        $this->data['jobs'] = $jobs;
        $this->data['active_menu'] = 'jobs';
        $this->data['site_content'] = 'jobs';
        $this->load->view('panel/content', $this->data);
    }
    public function add($lang = 1)
    {
        $this->form_validation->set_rules('jobsTitle', 'jobsTitle', 'trim|required|max_length[120]');
        $this->form_validation->set_rules('jobsSlugTitle', 'jobsSlugTitle', 'trim|required|is_unique[article.title_slug]');
        $this->form_validation->set_rules('jobsLocation', 'jobsLocation', 'trim|max_length[30]');
        $this->form_validation->set_rules('jobsSector', 'jobsSector', 'trim|max_length[30]');
        $this->form_validation->set_rules('jobsShortDesc', 'jobsShortDesc', 'trim');
        $this->form_validation->set_rules('jobsDescription', 'jobsDescription', 'trim|max_length[2000]');
        $this->form_validation->set_rules('jobsSeoTitle', 'jobsSeoTitle', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('jobsSeoMetaKeywords', 'jobsSeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('jobsSeoMetaDescription', 'jobsSeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('jobsSeoCanonicalUrl', 'jobsSeoCanonicalUrl', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('jobsTitle');
            $input_data['title_slug'] = $this->input->post('jobsSlugTitle');
            $input_data['location'] = $this->input->post('jobsLocation');
            $input_data['sector'] = $this->input->post('jobsSector');
            $input_data['short_desc'] = $this->input->post('jobsShortDesc');
            $input_data['description'] = $this->input->post('jobsDescription');
            $input_data['seo_title'] = $this->input->post('jobsSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('jobsSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('jobsSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('jobsSeoCanonicalUrl');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/jobs';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 500;
            $config['max_width']=550;
            $config['max_height']=550;
            if (!empty($_FILES['jobsDescImg']) && $_FILES['jobsDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'jobsDescImg', 'file' => &$_FILES['jobsDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                // echo"<pre>";print_r($upload_result);exit;
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['jobsDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            // echo "wokring.";exit;
            if ($no_error == TRUE) {
                $blog_id = $this->jobs_model->add($input_data);
                if ($blog_id <= 0) {
                    $no_error = FALSE;
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/jobs/all', 'refresh');
            }
        }
        // $this->data['current_language'] = $current_language;
        $this->data['active_menu'] = 'jobs';
        $this->data['site_content'] = 'add_jobs';
        $this->load->view('panel/content', $this->data);
    }
    public function edit($id, $lang = 1)
    {
        if ($id > 0) {
            $current_job = $this->jobs_model->get_for_panel($id);
        } else {
            redirect('panel/jobs/all', 'refresh');
        }

        $this->form_validation->set_rules('jobsTitle', 'title', 'trim|required|max_length[120]');
        if (!$current_job || empty($current_job->title_slug) || $current_job->title_slug != $this->input->post('jobsSlugTitle')) {
            $this->form_validation->set_rules('jobsSlugTitle', 'slug title', 'trim|required|is_unique[jobs.title_slug]');
        }
        $this->form_validation->set_rules('jobsLocation', 'jobsLocation', 'trim|max_length[30]');
        $this->form_validation->set_rules('jobsSector', 'jobsSector', 'trim|max_length[30]');
        $this->form_validation->set_rules('jobsShortDesc', 'jobsShortDesc', 'trim');
        $this->form_validation->set_rules('jobsDescription', 'jobsDescription', 'trim|max_length[2000]');
        $this->form_validation->set_rules('jobsSeoTitle', 'jobsSeoTitle', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('jobsSeoMetaKeywords', 'jobsSeoMetaKeywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('jobsSeoMetaDescription', 'jobsSeoMetaDescription', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('jobsSeoCanonicalUrl', 'jobsSeoCanonicalUrl', 'trim');
        $this->form_validation->set_rules('jobsStatus', 'jobsStatus', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            $input_data['title'] = $this->input->post('jobsTitle');
            $input_data['title_slug'] = $this->input->post('jobsSlugTitle');
            $input_data['location'] = $this->input->post('jobsLocation');
            $input_data['sector'] = $this->input->post('jobsSector');
            $input_data['short_desc'] = $this->input->post('jobsShortDesc');
            $input_data['description'] = $this->input->post('jobsDescription');
            $input_data['seo_title'] = $this->input->post('jobsSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('jobsSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('jobsSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('jobsSeoCanonicalUrl');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['language'] = $lang;
            $input_data['active'] = $this->input->post('jobsStatus');;

            $config = array();
            $config['upload_path'] = 'assets/uploads/jobs';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 500;
            $config['max_width']=550;
            $config['max_height']=550;
            if (!empty($_FILES['jobsDescImg']) && $_FILES['jobsDescImg']['error'] == 0) {
                $file_info = array('field_name' => 'jobsDescImg', 'file' => &$_FILES['jobsDescImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);

                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    if (file_exists('./assets/uploads/jobs/' . $current_job->desc_img) && !empty($current_job->desc_img)) {
                        unlink('./assets/uploads/jobs/' . $current_job->desc_img);
                        unlink('./assets/uploads/jobs/thumb_' . $current_job->desc_img);
                    }
                    $input_data['desc_img'] = $file_name;
                } else {
                    $this->data['jobsDescImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            if ($no_error == TRUE) {
                if ($current_job) {
                    $this->jobs_model->add($input_data, $current_job->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->jobs_model->add($input_data);
                }
            }
            if ($no_error == FALSE) {
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/jobs/all', 'refresh');
            }
        }

        $this->data['job'] = $current_job;
        $this->data['active_menu'] = 'jobs';
        $this->data['site_content'] = 'edit_jobs';
        $this->load->view('panel/content', $this->data);
    }
    public function delete_cover_img($id, $lang = '1')
    {
        //edit news based on language
        if ($id > 0 && $lang == '1') {
            $jobs = $this->jobs_model->get($id, $lang);
        } else {
            redirect('panel/jobs/all', 'refresh');
        }
        if (file_exists('./assets/uploads/jobs/' . $jobs->desc_img) && !empty($jobs->desc_img)) {
            unlink('./assets/uploads/jobs/' . $jobs->desc_img);
            unlink('./assets/uploads/jobs/thumb_' . $jobs->desc_img);
        }
        $input_data['desc_img'] = '';
        $this->jobs_model->update($input_data, $id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/jobs/edit/' . $jobs->id, 'refresh');
    }
    public function delete($id){
        $job = $this->jobs_model->get_for_panel($id);
        $job_id=$job->id;
        $candidates=$this->candidate_model->get_by_job_id($job_id);
        $go_forward=null;
        if($candidates){
            $this->session->set_flashdata('error', 'Candidates who applied for this job opening are still in the system. You must first eliminate all candidates who have applied for this position before you can delete it.
            ');
            redirect('panel/jobs/all', 'refresh');
        }else{
            if($this->jobs_model->delete_job($id)){
                $go_forward=true;
            }else{
                $go_forward=false;
            }
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'Job deleted successfully.');
            redirect('panel/jobs/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
        // echo"<pre>";print_r($candidates);exit;
    }
}
