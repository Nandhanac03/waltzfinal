<?php
//upload document files
$config = array();
$config['upload_path'] = 'assets/uploads/documents';
$config['allowed_types'] = 'pdf';
$config['encrypt_name'] = TRUE;
$config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
if (!empty($_FILES['pageDocumentFile']['name'][0])) {
    $file_count = count($_FILES['pageDocumentFile']['name']);
    for ($i = 0; $i < $file_count; $i++) {
        $_FILES['documentFile']['name'] = &$_FILES['pageDocumentFile']['name'][$i];
        $_FILES['documentFile']['type'] = &$_FILES['pageDocumentFile']['type'][$i];
        $_FILES['documentFile']['tmp_name'] = &$_FILES['pageDocumentFile']['tmp_name'][$i];
        $_FILES['documentFile']['error'] = &$_FILES['pageDocumentFile']['error'][$i];
        $_FILES['documentFile']['size'] = &$_FILES['pageDocumentFile']['size'][$i];
        $file_info = array('field_name' => 'documentFile', 'file' => &$_FILES['documentFile']);
        $upload_result = file_upload($file_info, $config);
        if (!$upload_result['error']) {
            $file_name = $upload_result['file_name'];
            $input_data = array();
            $input_data['page_id'] = $id;
            $input_data['file'] = $file_name;
            $input_data['file_for'] = "O";
            $input_data['file_type'] = "O";
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $file_id = $this->page_file_model->add($input_data);
            if ($file_id > 0) {
                $input_data = array();
                $input_data['title'] = 'Document';
                $input_data['file_id'] = $file_id;
                $input_data['language'] = $lang;
                $input_data['created_at'] = time();
                $input_data['created_by'] = $_SESSION['user_id'];
                $input_data['active'] = 1;
                $this->page_file_description_model->add($input_data);
            }
        }
    }
}
