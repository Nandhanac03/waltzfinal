<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mailer extends CO_Panel_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mail_content_model', 'mail_content_model');
        $this->load->model('Mail_send_model', 'mail_send_model');
        $this->load->model('Mail_sample_model', 'mail_sample_model');
        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        $this->data['mailerLogoErr'] = '';
    }

    public function index() {
        redirect('panel/mailer/sent', 'refresh');
    }

    public function sent() {
        $filter = array();
        $this->form_validation->set_rules('filterMailerCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterMailerTitle', 'title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['subject'] = $this->input->post('filterMailerSubject');
            if ($this->input->post('filterMailerCreatedAt') != '') {
                $filterMailerCreatedAt = explode('-', $this->input->post('filterMailerCreatedAt'));
                if (!empty($filterMailerCreatedAt[0])) {
                    $filter['from_created_at'] = strtotime($filterMailerCreatedAt[0]);
                }
                if (!empty($filterMailerCreatedAt[1])) {
                    $filter['to_created_at'] = strtotime($filterMailerCreatedAt[1]);
                }
            }
        }
        $this->data['mail_contents'] = $this->mail_content_model->get_all($filter);
        $this->data['active_menu'] = 'mail_sent';
        $this->data['site_content'] = 'mail_sent';
        $this->load->view('panel/content', $this->data);
    }

    public function compose() {
        //compose mail
        $this->form_validation->set_rules('mailerRecipient', 'recipients', array('trim', 'required', array('recipient_callable', function($recipients) {
                    if ($recipients) {
                        $recipients = explode(';', $recipients);
                        foreach ($recipients as $recipient) {
                            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                                return FALSE;
                            }
                        }
                    }
                    return TRUE;
                })), array('recipient_callable' => 'Invalid email address'));
        $this->form_validation->set_rules('mailerSubject', 'subject', 'trim|required');
        $this->form_validation->set_rules('mailerLink', 'link', 'trim');
        $this->form_validation->set_rules('mailerTitle', 'title', 'trim');
        $this->form_validation->set_rules('mailerContent', 'content', 'trim|required');
        $this->form_validation->set_rules('mailerTemplate', 'template', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $input_data = array();
            $no_error = TRUE;
            //begin in db transaction mode
            $this->db->trans_begin();
            $recipients = $this->input->post('mailerRecipient');
            $input_data['subject'] = $this->input->post('mailerSubject');
            $input_data['title'] = $this->input->post('mailerTitle');
            $input_data['content'] = $this->input->post('mailerContent');
            $input_data['link'] = $this->input->post('mailerLink');
            $input_data['template'] = $this->input->post('mailerTemplate');
            $input_data['logo'] = '';
            $input_data['created_at'] = time();
            $input_data['created_by'] = $_SESSION['user_id'];
            $input_data['active'] = 1;
            $config = array();
            $config['upload_path'] = 'assets/uploads/tmp';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
            $config['maintain_ratio'] = TRUE;
            if (!empty($_FILES['mailerLogo']) && $_FILES['mailerLogo']['error'] == 0) {
                $file_info = array('field_name' => 'mailerLogo', 'file' => &$_FILES['mailerLogo']);
                $upload_result = image_resize_upload($file_info, $config, 200);
                if (!$upload_result['error']) {
                    $file_name = $upload_result['file_name'];
                    $file_path = $config['upload_path'] . '/' . $file_name;
                    $file_type = pathinfo($file_path, PATHINFO_EXTENSION);
                    $file_data = file_get_contents($file_path);
                    $base64_file = 'data:image/' . $file_type . ';base64,' . base64_encode($file_data);
                    $input_data['logo'] = $base64_file;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                } else {
                    $this->data['mailerLogoErr'] = $upload_result['error_msg'];
                    $no_error = FALSE;
                }
            }
            $content_id = $this->mail_content_model->add($input_data);
            if ($content_id > 0) {
                $recipients = explode(';', $recipients);
                foreach ($recipients as $recipient) {
                    $input_data1 = array();
                    $input_data1['content_id'] = $content_id;
                    $input_data1['email'] = $recipient;
                    $input_data1['mail_send_count'] = 0;
                    $input_data1['mail_status'] = 'P';
                    $input_data1['created_at'] = time();
                    $input_data1['created_by'] = $_SESSION['user_id'];
                    $input_data1['active'] = 1;
                    $send_id = $this->mail_send_model->add($input_data1);
                }
            } else {
                $no_error = FALSE;
            }
            if ($this->input->post('mailerSample') == 'Y') {
                $input_data2 = array();
                $input_data2['subject'] = $this->input->post('mailerSubject');
                $input_data2['title'] = $this->input->post('mailerTitle');
                $input_data2['content'] = $this->input->post('mailerContent');
                $input_data2['link'] = $this->input->post('mailerLink');
                $input_data2['logo'] = $input_data['logo'];
                $input_data2['created_at'] = time();
                $input_data2['created_by'] = $_SESSION['user_id'];
                $input_data2['active'] = 1;
                $this->mail_sample_model->add($input_data2);
            }
            if ($this->db->trans_status() === FALSE || $no_error == FALSE) {
                //db transaction rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Something went wrong, Please try again.');
            } else {
                //db transaction commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Saved successfully.');
                redirect('panel/mailer/sent', 'refresh');
            }
        }
        $mail_templates = array();
        $template_dir = glob('assets/mail_template/*');
        if ($template_dir) {
            $i = 0;
            foreach ($template_dir as $template) {
                $tmp_split_dir = explode('/', $template);
                $mail_templates[$i]['template'] = $tmp_split_dir[count($tmp_split_dir) - 1];
                $mail_templates[$i]['template_name'] = ucwords(strtolower(str_replace('_', ' ', $tmp_split_dir[count($tmp_split_dir) - 1])));
                $i++;
            }
        }
        $this->data['mail_templates'] = $mail_templates;
        $this->data['active_menu'] = 'mail_compose';
        $this->data['site_content'] = 'mail_compose';
        $this->load->view('panel/content', $this->data);
    }

    public function sample() {
        $filter = array();
        $this->form_validation->set_rules('filterMailerCreatedAt', 'created at', 'trim');
        $this->form_validation->set_rules('filterMailerTitle', 'title', 'trim');
        if ($this->form_validation->run() === TRUE) {
            //filter the result based on search
            $filter['subject'] = $this->input->post('filterMailerSubject');
            if ($this->input->post('filterMailerCreatedAt') != '') {
                $filterMailerCreatedAt = explode('-', $this->input->post('filterMailerCreatedAt'));
                if (!empty($filterMailerCreatedAt[0])) {
                    $filter['from_created_at'] = strtotime($filterMailerCreatedAt[0]);
                }
                if (!empty($filterMailerCreatedAt[1])) {
                    $filter['to_created_at'] = strtotime($filterMailerCreatedAt[1]);
                }
            }
        }
        $this->data['mail_contents'] = $this->mail_content_model->get_all($filter);
        $this->data['active_menu'] = 'mail_sample';
        $this->data['site_content'] = 'mail_sample';
        $this->load->view('panel/content', $this->data);
    }

    public function delete($id, $lang = '1') {
        if ($id > 0 && $lang == '1') {
            $mailer = $this->mail_content_model->get($id);
            if ($id > 0 && $lang > 0) {
                $this->mail_content_model->disable($id);
                $this->mail_content_model->disable('', $id);
            }
        }
        $this->session->set_flashdata('success', 'Mailer deleted successfully.');
        redirect('panel/mailer/all', 'refresh');
    }

    public function preview() {
        $this->data['mail_title'] = $this->input->post('mail_title');
        $this->data['mail_link'] = $this->input->post('mail_link');
        $this->data['mail_template'] = $this->input->post('mail_template');
        $this->data['mail_subject'] = $this->input->post('mail_subject');
        $this->data['mail_content'] = $this->input->post('mail_content');
        $config = array();
        $config['upload_path'] = 'assets/uploads/tmp';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = config_item('MAX_IMG_FILE_SIZE');
        $config['maintain_ratio'] = TRUE;
        if (!empty($_FILES['mail_logo']) && $_FILES['mail_logo']['error'] == 0) {
            $file_info = array('field_name' => 'mail_logo', 'file' => &$_FILES['mail_logo']);
            $upload_result = image_resize_upload($file_info, $config, 200);
            if (!$upload_result['error']) {
                $file_name = $upload_result['file_name'];
                $file_path = $config['upload_path'] . '/' . $file_name;
                $file_type = pathinfo($file_path, PATHINFO_EXTENSION);
                $file_data = file_get_contents($file_path);
                $base64_file = 'data:image/' . $file_type . ';base64,' . base64_encode($file_data);
                $this->data['mail_logo'] = $base64_file;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        }
        $this->data['template_path'] = './assets/mail_template/' . $this->input->post('mail_template') . '/index.php';
        $this->load->view('panel/mail_preview', $this->data);
    }

}
