<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// image upload
if (!function_exists('file_upload')) {

    function file_upload($file_info, $config) {

        $CI = &get_instance();
        $CI->load->library('upload');
        $check_file = check_file($file_info['file'], $config);
        if (!$check_file['error']) {
            $CI->upload->initialize($config, TRUE);
            if (!$CI->upload->do_upload($file_info['field_name'])) {
                $data = array('file_name' => '',
                    'error_msg' => $CI->upload->display_errors('' . $file_info['file']['name'] . ' - ', ''),
                    'error' => TRUE);
            } else {
                $upload_data = $CI->upload->data();
                $file_name = $upload_data['file_name'];
                $data = array('file_name' => $file_name, 'error_msg' => '', 'error' => FALSE);
            }
        } else {
            $data = array('file_name' => '', 'error_msg' => $check_file['error_msg'], 'error' => $check_file['error']);
        }

        return $data;
    }

}
if (!function_exists('check_file')) {

    function check_file($file, $config) {

        $error = FALSE;
        $error_msg = '';
        if ($file['error'] != 0) {
            $error_msg = 'No file selected.';
            $error = TRUE;
        }
        if ($error != TRUE && !empty($config['allowed_types'])) {
            $config['allowed_types'] = explode('|', $config['allowed_types']);
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $config['allowed_types'])) {
                $error_msg = 'The file type you are attempting to upload is not allowed.';
                $error = TRUE;
            }
        }
        $data = array('error_msg' => $error_msg, 'error' => $error);

        return $data;
    }

}