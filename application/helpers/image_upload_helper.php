<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// image upload
if (!function_exists('image_upload')) {

    function image_upload($file_info, $config, $thumb_maintain_ratio = FALSE, $create_thumb = FALSE, $thumb_width = 250, $thumb_height = 250) {

        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->load->library('image_lib');
        $check_file = check_image($file_info['file'], $config);
        if (!$check_file['error']) {
            $CI->upload->initialize($config, TRUE);
            if (!$CI->upload->do_upload($file_info['field_name'])) {
                $image = array('file_name' => '', 'thumb_path' => '',
                    'error_msg' => $CI->upload->display_errors('' . $file_info['file']['name'] . ' - ', ''),
                    'error' => TRUE);
            } else {
                $upload_data = $CI->upload->data();
                if ($create_thumb == TRUE) {
                    $thumb_config['source_image'] = $upload_data['full_path'];
                    $thumb_config['new_image'] = 'thumb_' . $upload_data['file_name'];
                    $thumb_config['image_library'] = 'gd2';
                    $thumb_config['create_thumb'] = FALSE;
                    if ($thumb_maintain_ratio == TRUE) {
                        $thumb_config['maintain_ratio'] = TRUE;
                    }
                    if ($upload_data['image_width'] > $thumb_width) {
                        $thumb_config['width'] = $thumb_width;
                    }
                    if ($upload_data['image_height'] > $thumb_height) {
                        $thumb_config['height'] = $thumb_height;
                    }
                    $CI->image_lib->initialize($thumb_config);
                    $CI->image_lib->resize();
                    $CI->image_lib->clear();
                }
                $file_name = $upload_data['file_name'];
                $image = array('file_name' => $file_name, 'error_msg' => '', 'error' => FALSE);
            }
        } else {
            $image = array('file_name' => '', 'error_msg' => $check_file['error_msg'], 'error' => $check_file['error']);
        }

        return $image;
    }

}
if (!function_exists('image_resize_upload')) {

    function image_resize_upload($file_info, $config, $width = 600, $height = 500, $thumb_maintain_ratio = FALSE, $create_thumb = FALSE, $thumb_width = 250, $thumb_height = 250) {

        $CI = &get_instance();
        $CI->load->library('upload');
        $CI->load->library('image_lib');
        $check_file = check_image($file_info['file'], $config);
        if (!$check_file['error']) {
            $CI->upload->initialize($config, TRUE);
            if (!$CI->upload->do_upload($file_info['field_name'])) {
                $image = array('file_name' => '',
                    'error_msg' => $CI->upload->display_errors('' . $file_info['file']['name'] . ' - ', ''),
                    'error' => TRUE);
            } else {
                $upload_data = $CI->upload->data();
                $resize_config['source_image'] = $upload_data['full_path'];
                $resize_config['image_library'] = 'gd2';
                $resize_config['maintain_ratio'] = !empty($config['maintain_ratio'])?:FALSE;
                if ($upload_data['image_width'] > $width) {
                    $resize_config['width'] = $width;
                }
                if ($upload_data['image_height'] > $height) {
                    $resize_config['height'] = $height;
                }
                $CI->image_lib->initialize($resize_config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $file_name = $upload_data['file_name'];
                if ($create_thumb == TRUE) {
                    $thumb_config['source_image'] = $upload_data['full_path'];
                    $thumb_config['new_image'] = 'thumb_' . $upload_data['full_path'];
                    $thumb_config['image_library'] = 'gd2';
                    if ($thumb_maintain_ratio == TRUE) {
                        $thumb_config['maintain_ratio'] = TRUE;
                    }
                    if ($upload_data['image_width'] > $thumb_width) {
                        $thumb_config['width'] = $thumb_width;
                    }
                    if ($upload_data['image_height'] > $thumb_height) {
                        $thumb_config['height'] = $thumb_height;
                    }
                    $CI->image_lib->initialize($thumb_config);
                    $CI->image_lib->resize();
                    $CI->image_lib->clear();
                }
                $image = array('file_name' => $file_name, 'error_msg' => '', 'error' => FALSE);
            }
        } else {
            $image = array('file_name' => '', 'error_msg' => $check_file['error_msg'], 'error' => $check_file['error']);
        }

        return $image;
    }

}
if (!function_exists('check_image')) {

    function check_image($file, $config) {

        $error = FALSE;
        $error_msg = '';
        $image_info = '';
        if ($file['error'] == 4) {
            $error_msg = 'No file selected.';
            $error = TRUE;
        }
        if ($file['error'] != 4) {
            $image_info = getimagesize($file['tmp_name']);
        }
        if ($error != TRUE && !empty($config['allowed_types'])) {
            $config['allowed_types'] = explode('|', $config['allowed_types']);
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $config['allowed_types'])) {
                $error_msg = 'The file type you are attempting to upload is not allowed.';
                $error = TRUE;
            }
        }
        if ($error != TRUE && !empty($config['max_size'])) {
            if ($file['size'] > ($config['max_size'] * 1024)) {
                $error_msg = "The file you are attempting to upload is too large.";
                $error = TRUE;
            }
        }
        if ($error != TRUE && !empty($config['min_width']) && $image_info) {
            if ($config['min_width'] > $image_info[0]) {
                $error_msg = "The image you are attempting to upload doesn't fit into the allowed dimensions.";
                $error = TRUE;
            }
        }
        if ($error != TRUE && !empty($config['min_height']) && $image_info) {
            if ($config['min_height'] > $image_info[1]) {
                $error_msg = "The image you are attempting to upload doesn't fit into the allowed dimensions.";
                $error = TRUE;
            }
        }
        if ($error != TRUE && !empty($config['max_width']) && $image_info) {
            if ($config['max_width'] < $image_info[0]) {
                $error_msg = "The image you are attempting to upload doesn't fit into the allowed dimensions.";
                $error = TRUE;
            }
        }
        if ($error != TRUE && !empty($config['max_height']) && $image_info) {
            if ($config['max_height'] < $image_info[1]) {
                $error_msg = "The image you are attempting to upload doesn't fit into the allowed dimensions.";
                $error = TRUE;
            }
        }
        $return_result = array('error_msg' => $error_msg, 'error' => $error);

        return $return_result;
    }

}