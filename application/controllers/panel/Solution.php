<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solution extends CO_Panel_Controller
{

    function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Solution_model', 'solution_model');
        $this->load->model('Solution_file_model', 'solution_file_model');
        $this->load->model('Solution_file_description_model', 'solution_file_description_model');
        $this->load->model('Language_model', 'language_model');
        $this->load->model('Bio_model', 'bio_model');
        $this->load->model('Profile_model', 'profile_model');
        $this->load->model('Country_model', 'country_model');
        $this->load->model('Solution_category_model', 'solution_category_model');
        $this->load->model('Solution_additional_info_model', 'solution_additional_info_model');

        //loading helpers 
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['filesolutionError'] = '';
        $this->data['filesolutionLargeError'] = '';
        $this->data['solutionDocumentError'] = '';
        $this->data['solutionCoverImgError'] = '';
        $this->data['solutionBackCoverImgError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_pr_title'] = FALSE;
        $controller_config['disable_pr_slugtitle'] = FALSE;
        $controller_config['disable_pr_languages'] = FALSE;
        $controller_config['disable_pr_subtitle'] = TRUE;
        $controller_config['disable_pr_short_desc'] = FALSE;
        $controller_config['disable_pr_additonal_info'] = true;
        $controller_config['disable_pr_cover_img'] = FALSE;
        $controller_config['disable_pr_back_cover_img'] = TRUE;
        $controller_config['disable_pr_document'] = FALSE;
        $controller_config['disable_pr_images'] = FALSE;
        $controller_config['disable_pr_img_languages'] = TRUE;
        $controller_config['disable_pr_img_file_description'] = TRUE;
        $controller_config['disable_pr_img_file_lg'] = FALSE;
        $controller_config['disable_pr_sku'] = TRUE;
        $controller_config['disable_pr_author'] = TRUE;
        $controller_config['disable_pr_additonal_info_city'] = TRUE;

        $controller_config['disable_pr_status'] = FALSE; 
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/solution/all');
    }

    public function all()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);

        // echo"<pre>";print_r($_POST);exit;
        //solution list view
        // echo"<pre>";print_r($categories);exit;
        $filter = array();
        $filter['language_id'] = 1;
        $this->form_validation->set_rules('filtersolutionCreatedAt', 'created_at', 'trim');
        $this->form_validation->set_rules('filtersolutionTitle', 'title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['solution_title'] = $this->input->post('filtersolutionTitle');
            $solution_created_at = $this->input->post('filtersolutionCreatedAt');
            if ($this->input->post('filtersolutionStatus')) {
                $filter['active'] = $this->input->post('filtersolutionStatus') == 'Y' ? 1 : '';
            }
            if ($solution_created_at != '') {
                $filtersolutionCreatedAt = explode('-', $solution_created_at);
                if (!empty($filtersolutionCreatedAt[0])) {
                    $filtersolutionCreatedAt[0] = str_replace('/', '-', $filtersolutionCreatedAt[0]);
                    $filter['from_created_at'] = strtotime($filtersolutionCreatedAt[0]);
                }
                if (!empty($filtersolutionCreatedAt[1])) {
                    $filtersolutionCreatedAt[1] = str_replace('/', '-', $filtersolutionCreatedAt[1]);
                    $filter['to_created_at'] = strtotime($filtersolutionCreatedAt[1]);
                }
            }
        }
        // echo "<pre>";
        // print_r($filter);
        // exit;
        $solutions = $this->solution_model->get_all_solution($filter);
        $this->data['active_menu'] = 'solution';
        $this->data['solutions'] = $solutions;

        $this->data['site_content'] = 'solution';
        $this->load->view('panel/content', $this->data);
    }

    public function add($lang = 1)
    {
        //    echo '<pre>';
        //    print_r($_POST);
        //    exit;

        //add solution



        $current_language = $this->language_model->get_language($lang);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $this->form_validation->set_rules('solutionCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('solutionName', 'name', 'trim|required');

        $solution_category = $this->solution_category_model->get_all();

        $this->form_validation->set_rules('solutionSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('solutionSubtitle', 'subtitle', 'trim');
        $this->form_validation->set_rules('solutionShortDesc', 'short description', 'trim');
        $this->form_validation->set_rules('solutionDescription', 'description', 'trim');

        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['sku'] = '';
            $input_data['title'] = $this->input->post('solutionName');
            $input_data['category_id'] = $this->input->post('solutionCategory');
            $input_data['title_slug'] = $this->input->post('solutionSlugTitle');
            $input_data['subtitle'] = $this->input->post('solutionSubtitle');
            $input_data['short_desc'] = $this->input->post('solutionShortDesc');
            $input_data['description'] = $this->input->post('solutionDescription');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['updated_by'] = '';
            $input_data['updated_at'] = '';
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            $input_data['note'] = $this->input->post('solutionNote');

            // echo"<pre>";print_r($input_data);exit;

            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['solutionCoverImg']) && $_FILES['solutionCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'solutionCoverImg', 'file' => &$_FILES['solutionCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['cover_img'] = $file_name;
                } else {
                    $this->data['solutionCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            } else {
                $no_error = TRUE;
            }

            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['solutionBackCoverImg']) && $_FILES['solutionBackCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'solutionBackCoverImg', 'file' => &$_FILES['solutionBackCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['additional_img'] = $file_name;
                } else {
                    $this->data['solutionBackCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            } else {
                $no_error = TRUE;
            }


            if ($no_error == true) {
                $id = $this->solution_model->add($input_data);
            }
            if ($id > 0) {


                $file_count = $this->input->post('solutionFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/solution';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['solutionFile_' . $i]) && $_FILES['solutionFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'solutionFile_' . $i, 'file' => &$_FILES['solutionFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['solution_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                // echo '<pre>';print_r($input_data);exit;
                                $file_id = $this->solution_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('solutionFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['language'] = $lang;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->solution_file_description_model->add($input_data);
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
                // if (!empty($_FILES['solutionDocumentFile']['name'][0])) {
                //     $file_count = count($_FILES['solutionDocumentFile']['name']);
                //     for ($i = 0; $i < $file_count; $i++) {
                //         $_FILES['documentFile']['name'] = &$_FILES['solutionDocumentFile']['name'][$i];
                //         $_FILES['documentFile']['type'] = &$_FILES['solutionDocumentFile']['type'][$i];
                //         $_FILES['documentFile']['tmp_name'] = &$_FILES['solutionDocumentFile']['tmp_name'][$i];
                //         $_FILES['documentFile']['error'] = &$_FILES['solutionDocumentFile']['error'][$i];
                //         $_FILES['documentFile']['size'] = &$_FILES['solutionDocumentFile']['size'][$i];
                //         $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                //         $upload_result = file_upload($file_info, $config);

                //         if (!$upload_result['error']) {
                //             $file_name = $upload_result['file_name'];
                //             $input_data = array();
                //             $input_data['solution_id'] = $id;
                //             $input_data['file'] = $file_name;
                //             $input_data['file_for'] = "O";
                //             $input_data['file_type'] = "O";
                //             $input_data['created_at'] = time();
                //             $input_data['created_by'] = $_SESSION['user_id'];
                //             $input_data['active'] = 1;
                //             $file_id = $this->solution_file_model->add($input_data);
                //             if ($file_id > 0) {
                //                 $input_data = array();
                //                 $input_data['title'] = 'Document';
                //                 $input_data['file_id'] = $file_id;
                //                 $input_data['language'] = $lang;
                //                 $input_data['created_at'] = time();
                //                 $input_data['created_by'] = $_SESSION['user_id'];
                //                 $input_data['active'] = 1;
                //                 $this->solution_file_description_model->add($input_data);
                //             }
                //         } else {
                //             echo $upload_result['error_msg'];
                //             exit;
                //         }
                //     }
                // }

                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');

                // Initialize error array
                $solutionDocumentError = array();

                if (!empty($_FILES['solutionDocumentFile']['name'][0])) {
                    $file_count = count($_FILES['solutionDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['solutionDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['solutionDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['solutionDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['solutionDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['solutionDocumentFile']['size'][$i];

                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);

                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array(
                                'solution_id' => $id,
                                'file'        => $file_name,
                                'file_for'    => "O",
                                'file_type'   => "O",
                                'created_at'  => time(),
                                'created_by'  => $_SESSION['user_id'],
                                'active'      => 1
                            );
                            $file_id = $this->solution_file_model->add($input_data);

                            if ($file_id > 0) {
                                $input_data = array(
                                    'title'      => 'Document',
                                    'file_id'    => $file_id,
                                    'language'   => $lang,
                                    'created_at' => time(),
                                    'created_by' => $_SESSION['user_id'],
                                    'active'     => 1
                                );
                                $this->solution_file_description_model->add($input_data);
                            }
                        } else {
                            // Define error handler if not already defined
                            if (!function_exists('getUploadErrorMessage')) {
                                function getUploadErrorMessage($error_code)
                                {
                                    switch ($error_code) {
                                        case UPLOAD_ERR_OK:
                                            return 'There is no error, the file uploaded successfully.';
                                        case UPLOAD_ERR_INI_SIZE:
                                            return 'The uploaded file exceeds the maximum allowed size. Maximum size is ' . config_item('MAX_IMG_FILE_SIZE_MSG');
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
                            }

                            // Store error for this file
                            $solutionDocumentError[] = array(
                                'file_name'     => $_FILES['documentFile']['name'],
                                'error_message' => getUploadErrorMessage($_FILES['documentFile']['error'])
                            );

                            $this->data['solutionDocumentError'] = $solutionDocumentError;
                            $no_error = FALSE;
                        }
                    }
                } else {
                    $no_error = TRUE;
                }

                if ($id && !empty($_POST['cityName']) && !empty($_POST['percentage'])) {
                    $cityNames = $_POST['cityName'];
                    $percentages = $_POST['percentage'];

                    $count = count($cityNames);

                    for ($i = 0; $i < $count; $i++) {
                        if (empty($cityNames[$i]) || empty($percentages[$i])) {
                            continue;
                        }

                        $new_input = array();
                        $new_input['solution_id'] = $id;
                        $new_input['language'] = $current_language->id;
                        $new_input['title'] = $cityNames[$i];
                        $new_input['count'] = (int)$percentages[$i];
                        $new_input['created_at'] = time();
                        $new_input['created_by'] = $_SESSION['user_id'];

                        // Make sure this is INSERT, not UPDATE
                        $this->solution_additional_info_model->add($new_input);
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
                redirect('panel/solution/all', 'refresh');
            }
        }
        $solution_category = $this->solution_category_model->get_all();

        $this->data['solution_category'] = $solution_category;

        // echo '<pre>';
        // print_r($solution_category);
        // exit;

        $this->data['current_language'] = $current_language;
        $this->data['languages'] = $languages;
        $this->data['active_menu'] = 'solution';
        $this->data['site_content'] = 'add_solution';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_add_solution_file($id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax add solution file
        $solution = $this->solution_model->get($id);
        $current_language = $this->language_model->get_language($lang);
        if (!$current_language || !$solution || $id < 0 || $lang < 0) {
            echo 'Something went wrong, Please try again.';
        } else if (!empty($_FILES['solutionFileUpdateBrowse'])) {
            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['solutionFileUpdateBrowse']) && $_FILES['solutionFileUpdateBrowse']['error'] == 0) {
                $file_info = array('field_name' => 'solutionFileUpdateBrowse', 'file' => &$_FILES['solutionFileUpdateBrowse']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if ($upload_result['error']) {
                    echo $upload_result['error_msg'];
                } else {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['solution_id'] = $id;
                    $input_data['file'] = $file_name;
                    $input_data['file_for'] = "IG";
                    $input_data['file_type'] = "I";
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $input_data['active'] = 1;
                    $file_id = $this->solution_file_model->add($input_data);
                    $title = $this->input->post('solutionFileUpdateTitle');
                    $input_data = array();
                    $input_data['title'] = $title;
                    if ($this->solution_file_description_model->get_file_description($file_id, $lang)) {
                        $input_data['updated_at'] = time();
                        $input_data['updated_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->solution_file_description_model->update($input_data, $file_id, $lang);
                    } else {
                        $input_data['file_id'] = $file_id;
                        $input_data['language'] = $lang;
                        $input_data['created_at'] = time();
                        $input_data['created_by'] = $_SESSION['user_id'];
                        $input_data['active'] = 1;
                        $this->solution_file_description_model->add($input_data);
                    }
                    echo TRUE;
                }
            }
        } else {
            echo 'File required.';
        }
    }

    public function ajax_get_solution_files()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax get all solution files
        $id = $this->input->post('solution_id');
        $lang = $this->input->post('language_id');
        $solution_images = $this->solution_file_model->get_files(array('solution_id' => $id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $this->data['solution_images'] = $solution_images;
        $this->load->view('panel/ajax/ajax_solution_files.php', $this->data);
    }

    public function edit($id, $lang = 1)
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit;

        if (!$id) {
            redirect('panel/solution/all', 'refresh');
        }

        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        $solution_images = $this->solution_file_model->get_files(array('solution_id' => $id, 'file_for' => 'IG', 'file_type' => 'I', 'active' => 1, 'language' => $lang));
        $solution_documents = $this->solution_file_model->get_files(array('solution_id' => $id, 'file_for' => 'O', 'file_type' => 'O', 'active' => 1, 'language' => $lang));
        $this->data['solution_images'] = $solution_images;
        $this->data['solution_documents'] = $solution_documents;
        $this->data['solution_additional_info'] = $this->solution_additional_info_model->get_by_solution_id($id, $lang);
        // echo '<pre>';print_r( $this->data['solution_additional_info']);exit;
        $current_language = $this->language_model->get_language($lang);

        $solution = $this->solution_model->get($id);
        $filter = array();

        $this->form_validation->set_rules('solutionName', 'Name', 'trim|required');
        $this->form_validation->set_rules('solutionSlugTitle', 'slug title', 'trim');
        $this->form_validation->set_rules('solutionSubtitle', 'Subtitle', 'trim');
        $this->form_validation->set_rules('solutionShortDesc', 'Short Description', 'trim');
        $this->form_validation->set_rules('solutionDescription', ' Description', 'trim');
        $this->form_validation->set_rules('solutionCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('solutionSeoTitle', 'seo title', 'trim|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('solutionSeoMetaKeywords', 'meta keywords', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('solutionSeoMetaDescription', 'meta description', 'trim|min_length[3]|max_length[160]');
        $this->form_validation->set_rules('solutionSeoCanonicalUrl', 'canonical url', 'trim');
        // $this->form_validation->set_rules('solutionHomeDisplay', 'home_display', 'trim');
        //print_r($_POST);
        //exit;
        if ($this->form_validation->run() === TRUE) {
            //begin in db transaction mode
            $this->db->trans_begin();
            $no_error = TRUE;
            $input_data = array();
            $input_data['title'] = $this->input->post('solutionName');
            // $input_data['title'] = $this->input->post('solutionTitle');
            $input_data['title_slug'] = $this->input->post('solutionSlugTitle');
            $input_data['subtitle'] = $this->input->post('solutionSubtitle');
            $input_data['short_desc'] = $this->input->post('solutionShortDesc');
            $input_data['description'] = $this->input->post('solutionDescription');
            $input_data['category_id'] = $this->input->post('solutionCategory');
            $input_data['note'] = $this->input->post('solutionNote');

            if (isset($_POST['solutionStatus'])) {
                if ($_POST['solutionStatus'] == 'Y') {
                    $solution_status = 1;
                } else {
                    $solution_status = 0;
                }
            }
            $input_data['language'] = $lang;
            $input_data['active'] = $solution_status;
            $config = array();

            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['solutionCoverImg']) && $_FILES['solutionCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'solutionCoverImg', 'file' => &$_FILES['solutionCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['cover_img'] = $file_name;
                    if (file_exists('./assets/uploads/solution/' . $solution->cover_img) && !empty($solution->cover_img)) {
                        unlink('./assets/uploads/solution/' . $solution->cover_img);
                        unlink('./assets/uploads/solution/thumb_' . $solution->cover_img);
                    }
                } else {
                    $this->data['solutionCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_PR_IMG_FILE_SIZE');
            // $config['max_width'] = 400;
            // $config['max_height'] = 400;
            if (!empty($_FILES['solutionBackCoverImg']) && $_FILES['solutionBackCoverImg']['error'] == 0) {
                $file_info = array('field_name' => 'solutionBackCoverImg', 'file' => &$_FILES['solutionBackCoverImg']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data['additional_img'] = $file_name;
                } else {
                    $this->data['solutionBackCoverImgError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }

            $input_data['seo_title'] = $this->input->post('solutionSeoTitle');
            $input_data['seo_meta_keywords'] = $this->input->post('solutionSeoMetaKeywords');
            $input_data['seo_meta_description'] = $this->input->post('solutionSeoMetaDescription');
            $input_data['seo_canonical_url'] = $this->input->post('solutionSeoCanonicalUrl');
            if ($no_error == true) {
                if ($solution) {
                    $input_data['updated_by'] = time();
                    $input_data['updated_at'] = $_SESSION['user_id'];
                    $this->solution_model->update($input_data, $solution->id);
                } else {
                    $input_data['created_at'] = time();
                    $input_data['created_by'] = $_SESSION['user_id'];
                    $this->solution_model->add($input_data);
                }
            }
            if ($id > 0) {

                $file_count = $this->input->post('solutionFilesCount');
                if ($file_count > 0) {
                    $config = array();
                    $config['upload_path'] = 'assets/uploads/solution';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
                    for ($i = 1; $i <= $file_count; $i++) {
                        if (!empty($_FILES['solutionFile_' . $i]) && $_FILES['solutionFile_' . $i]['error'] == 0) {
                            $file_info = array('field_name' => 'solutionFile_' . $i, 'file' => &$_FILES['solutionFile_' . $i]);
                            $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                            if (!$upload_result['error']) {
                                $file_name = $upload_result['file_name'];
                                $input_data = array();
                                $input_data['solution_id'] = $id;
                                $input_data['file'] = $file_name;
                                $input_data['file_for'] = "IG";
                                $input_data['file_type'] = "I";
                                $input_data['created_at'] = time();
                                $input_data['created_by'] = $_SESSION['user_id'];
                                $input_data['active'] = 1;
                                $file_id = $this->solution_file_model->add($input_data);
                                if ($file_id > 0) {
                                    $input_data = array();
                                    $input_data['title'] = $this->input->post('solutionFileTitle_' . $i);
                                    $input_data['file_id'] = $file_id;
                                    $input_data['created_at'] = time();
                                    $input_data['created_by'] = $_SESSION['user_id'];
                                    $input_data['active'] = 1;
                                    $this->solution_file_description_model->add($input_data);
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
                // if (!empty($_FILES['solutionDocumentFile']['name'][0])) {
                //     $file_count = count($_FILES['solutionDocumentFile']['name']);
                //     for ($i = 0; $i < $file_count; $i++) {
                //         $_FILES['documentFile']['name'] = &$_FILES['solutionDocumentFile']['name'][$i];
                //         $_FILES['documentFile']['type'] = &$_FILES['solutionDocumentFile']['type'][$i];
                //         $_FILES['documentFile']['tmp_name'] = &$_FILES['solutionDocumentFile']['tmp_name'][$i];
                //         $_FILES['documentFile']['error'] = &$_FILES['solutionDocumentFile']['error'][$i];
                //         $_FILES['documentFile']['size'] = &$_FILES['solutionDocumentFile']['size'][$i];
                //         $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                //         $upload_result = file_upload($file_info, $config);
                //         if (!$upload_result['error']) {
                //             $file_name = $upload_result['file_name'];
                //             $input_data = array();
                //             $input_data['solution_id'] = $id;
                //             $input_data['file'] = $file_name;
                //             $input_data['file_for'] = "O";
                //             $input_data['file_type'] = "O";
                //             $input_data['created_at'] = time();
                //             $input_data['created_by'] = $_SESSION['user_id'];
                //             $input_data['active'] = 1;
                //             $file_id = $this->solution_file_model->add($input_data);
                //             if ($file_id > 0) {
                //                 $input_data = array();
                //                 $input_data['title'] = 'Document';
                //                 $input_data['file_id'] = $file_id;
                //                 $input_data['language'] = $lang;
                //                 $input_data['created_at'] = time();
                //                 $input_data['created_by'] = $_SESSION['user_id'];
                //                 $input_data['active'] = 1;
                //                 $this->solution_file_description_model->add($input_data);
                //             }
                //         } else {
                //             echo $upload_result['error_msg'];
                //             exit;
                //         }
                //     }
                // }

                $config = array();
                $config['upload_path'] = 'assets/uploads/document';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');

                // Initialize error array
                $solutionDocumentError = array();

                if (!empty($_FILES['solutionDocumentFile']['name'][0])) {
                    $file_count = count($_FILES['solutionDocumentFile']['name']);
                    for ($i = 0; $i < $file_count; $i++) {
                        $_FILES['documentFile']['name'] = &$_FILES['solutionDocumentFile']['name'][$i];
                        $_FILES['documentFile']['type'] = &$_FILES['solutionDocumentFile']['type'][$i];
                        $_FILES['documentFile']['tmp_name'] = &$_FILES['solutionDocumentFile']['tmp_name'][$i];
                        $_FILES['documentFile']['error'] = &$_FILES['solutionDocumentFile']['error'][$i];
                        $_FILES['documentFile']['size'] = &$_FILES['solutionDocumentFile']['size'][$i];

                        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
                        $upload_result = file_upload($file_info, $config);

                        if (!$upload_result['error']) {
                            $file_name = $upload_result['file_name'];
                            $input_data = array(
                                'solution_id' => $id,
                                'file'        => $file_name,
                                'file_for'    => "O",
                                'file_type'   => "O",
                                'created_at'  => time(),
                                'created_by'  => $_SESSION['user_id'],
                                'active'      => 1
                            );
                            $file_id = $this->solution_file_model->add($input_data);

                            if ($file_id > 0) {
                                $input_data = array(
                                    'title'      => 'Document',
                                    'file_id'    => $file_id,
                                    'language'   => $lang,
                                    'created_at' => time(),
                                    'created_by' => $_SESSION['user_id'],
                                    'active'     => 1
                                );
                                $this->solution_file_description_model->add($input_data);
                            }
                        } else {
                            // Define error handler if not already defined
                            if (!function_exists('getUploadErrorMessage')) {
                                function getUploadErrorMessage($error_code)
                                {
                                    switch ($error_code) {
                                        case UPLOAD_ERR_OK:
                                            return 'There is no error, the file uploaded successfully.';
                                        case UPLOAD_ERR_INI_SIZE:
                                            return 'The uploaded file exceeds the maximum allowed size. Maximum size is ' . config_item('MAX_IMG_FILE_SIZE_MSG');
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
                            }

                            // Store error for this file
                            $solutionDocumentError[] = array(
                                'file_name'     => $_FILES['documentFile']['name'],
                                'error_message' => getUploadErrorMessage($_FILES['documentFile']['error'])
                            );

                            $this->data['solutionDocumentError'] = $solutionDocumentError;
                            $no_error = FALSE;
                        }
                    }
                }

                if ($id && !empty($_POST['cityName']) && !empty($_POST['percentage']) && !empty($_POST['record_id'])) {
                    $cityNames = $_POST['cityName'];
                    $percentages = $_POST['percentage'];
                    $recordIds = $_POST['record_id'];

                    $count = count($cityNames);

                    for ($i = 0; $i < $count; $i++) {
                        if (empty($cityNames[$i]) || empty($percentages[$i])) {
                            continue;
                        }

                        $new_input = array(
                            'solution_id' => $id,
                            'language' => $current_language->id,
                            'title' => $cityNames[$i],
                            'count' => (int)$percentages[$i],
                            'updated_at' => time(),
                            'updated_by' => $_SESSION['user_id']
                        );

                        if ($recordIds[$i] === 'new') {
                            // New record
                            $new_input['created_at'] = time();
                            $new_input['created_by'] = $_SESSION['user_id'];
                            $this->solution_additional_info_model->add($new_input);
                        } else {
                            // Update existing record
                            $this->solution_additional_info_model->update($recordIds[$i], $new_input);
                        }
                    }
                }
            } 
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/solution/all', 'refresh');
            }
        }
        $current_language = $this->language_model->get_language($lang);
        $this->data['current_language'] = $current_language;

        $solution_category = $this->solution_category_model->get_all();

        $this->data['solution_category'] = $solution_category;


        // echo '<pre>';
        // print_r($solution);
        // exit;

        $this->data['id'] = $id;
        $this->data['lang'] = $lang;
        $this->data['languages'] = $languages;
        $this->data['solution'] = $solution;
        $this->data['active_menu'] = 'solution';
        $this->data['site_content'] = 'edit_solution';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_solution_document($id, $file_id, $lang = 1)
    {
        $filter = array();
        $filter['file_id'] = $file_id;
        $filter['solution_id'] = $id;
        $file_info = $this->solution_file_model->get_file($filter);
        if ($file_info) {
            if ($file_info->file_type == 'O') {
                if (file_exists('./assets/uploads/document/' . $file_info->file) && !empty($file_info->file)) {
                    unlink('./assets/uploads/document/' . $file_info->file);
                }
            }
            $this->solution_file_model->delete_file($file_id);
            $this->solution_file_description_model->delete_file_description($file_id, $lang);
            $this->session->set_flashdata('success', 'Document deleted successfully.');
        }
        redirect('panel/solution/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function edit_file($id, $file_id, $lang = 1)
    {
        $solution = $this->solution_model->get($id);
        $current_language = $this->language_model->get_language($lang);
        $solution_file = $this->solution_file_model->get_solution_files($file_id);
        $filter = array();
        $filter['status'] = 1;
        $filter['for_site'] = 1;
        $languages = $this->language_model->get_languages($filter);
        if (!$current_language || !$solution_file || !$solution || $id < 0 || $file_id < 0) {
            redirect('panel/solution/all', 'refresh');
        }
        $file_desc_languages = $this->solution_file_description_model->get_languages($file_id);
        $solution_file_desc = $this->solution_file_description_model->get_file_description($file_id, $lang);
        $this->form_validation->set_rules('fileTitle', 'Title', 'trim');
        $this->form_validation->set_rules('fileDescription', 'Description', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $input_data['file_id'] = $solution_file->id;
            $input_data['title'] = $this->input->post('fileTitle');
            $input_data['description'] = $this->input->post('fileDescription');
            $input_data['language'] = $lang;
            $input_data['active'] = 1;
            if ($solution_file_desc) {
                $input_data['updated_at'] = time();
                $input_data['updated_by'] = $_SESSION['user_id'];
                $this->solution_file_description_model->update($input_data, $solution_file_desc->id);
            } else {
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $this->solution_file_description_model->add($input_data);
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['filesolution']) && $_FILES['filesolution']['error'] == 0) {
                $file_info = array('field_name' => 'filesolution', 'file' => &$_FILES['filesolution']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['file'] = $file_name;
                    if (file_exists('./assets/uploads/solution/' . $solution_file->file) && !empty($solution_file->file)) {
                        unlink('./assets/uploads/solution/' . $solution_file->file);
                        unlink('./assets/uploads/solution/thumb_' . $solution_file->file);
                    }
                    $this->solution_file_model->update($input_data, $solution_file->id);
                } else {
                    $this->data['filesolutionError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $config = array();
            $config['upload_path'] = 'assets/uploads/solution';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            if (!empty($_FILES['filesolutionLarge']) && $_FILES['filesolutionLarge']['error'] == 0) {
                $file_info = array('field_name' => 'filesolutionLarge', 'file' => &$_FILES['filesolutionLarge']);
                $upload_result = image_upload($file_info, $config, FALSE, TRUE);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $input_data = array();
                    $input_data['file_lg'] = $file_name;
                    if (file_exists('./assets/uploads/solution/' . $solution_file->file_lg) && !empty($solution_file->file_lg)) {
                        unlink('./assets/uploads/solution/' . $solution_file->file_lg);
                        unlink('./assets/uploads/solution/thumb_' . $solution_file->file_lg);
                    }
                    $this->solution_file_model->update($input_data, $solution_file->id);
                } else {
                    $this->data['filesolutionLargeError'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $this->session->set_flashdata('success', 'Saved successfully.');
            redirect('panel/solution/edit_file/' . $solution->id . '/' . $solution_file->id . '/' . $current_language->id, 'refresh');
        }
        $this->data['current_language'] = $current_language;
        $this->data['file_desc_languages'] = is_array($file_desc_languages) ? $file_desc_languages : array();
        $this->data['solution_file_desc'] = $solution_file_desc;
        $this->data['solution'] = $solution;
        $this->data['languages'] = $languages;
        $this->data['solution_file'] = $solution_file;
        $this->data['active_menu'] = 'solution';
        $this->data['site_content'] = 'edit_solution_file';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_cover_img($id, $lang = '1')
    {
        //edit solution based on language
        if ($id > 0 && $lang == '1') {
            $solution = $this->solution_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $solution = $this->solution_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/solution/all', 'refresh');
        }
        if (file_exists('./assets/uploads/solution/' . $solution->cover_img) && !empty($solution->cover_img)) {
            unlink('./assets/uploads/solution/' . $solution->cover_img);
            unlink('./assets/uploads/solution/thumb_' . $solution->cover_img);
        }
        $input_data['cover_img'] = '';
        $this->solution_model->update($input_data, $solution->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/solution/edit/' . $id . '/' . $lang, 'refresh');
    }

    public function ajax_delete_solution_file($id, $lang = 1)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        //ajax delete_solution file
        if ($id > 0 && $lang > 0) {
            $file_id = $this->input->post('deletesolutionFileId');
            $filter = array();
            $filter['file_id'] = $file_id;
            $filter['solution_id'] = $id;
            $file_info = $this->solution_file_model->get_file($filter);
            if ($file_info) {
                if ($file_info->file_type == 'I') {
                    if (file_exists('./assets/uploads/solution/' . $file_info->file) && !empty($file_info->file)) {
                        unlink('./assets/uploads/solution/' . $file_info->file);
                        unlink('./assets/uploads/solution/thumb_' . $file_info->file);
                    }
                }
                $this->solution_file_model->delete_file($file_id);
                $this->solution_file_description_model->delete_file_description($file_id, $lang);
                echo TRUE;
            }
        }
    }

    public function delete_solution($id)
    {
        $solution = $this->solution_model->get_solution_without_status($id);
        $go_forward = null;

        if ($solution) {
            if ($this->solution_model->delete_solution($id)) {
                $go_forward = true;
            }
        } else {
            $go_forward = false;
        }
        if ($go_forward) {
            $this->session->set_flashdata('success', 'solution deleted successfully.');
            redirect('panel/solution/all', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
        }
    }

    public function ajax_update_solution_document_title()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $doc_id = $this->input->post('doc_id');
        $title  = $this->input->post('title');

        if ($doc_id && $title !== '') {
            $update = [
                'title'      => $title,
                'updated_at' => time(),
                'updated_by' => $_SESSION['user_id'],
            ];
            $this->solution_file_description_model->update($update, $doc_id);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'error' => 'Invalid input']));
        }
    }

    public function delete_back_cover_img($id, $lang = '1')
    {
        //edit solution based on language
        if ($id > 0 && $lang == '1') {
            $solution = $this->solution_model->get($id);
        } else if ($id > 0 && $lang > 0) {
            $solution = $this->solution_model->get_by_parent($id, $lang);
        } else {
            redirect('panel/solution/all', 'refresh');
        }
        if (file_exists('./assets/uploads/solution/' . $solution->additional_img) && !empty($solution->additional_img)) {
            unlink('./assets/uploads/solution/' . $solution->additional_img);
            unlink('./assets/uploads/solution/thumb_' . $solution->additional_img);
        }
        $input_data['additional_img '] = '';
        $this->solution_model->update($input_data, $solution->id);
        $this->session->set_flashdata('success', 'Image deleted successfully.');
        redirect('panel/solution/edit/' . $id . '/' . $lang, 'refresh');
    }
}
