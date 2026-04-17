<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact_us extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_model', 'contact_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('File_model', 'file_model');
        $this->data['inner_banner'] = $this->file_model->get_file('', 4);
    }

    public function index()
    {

        $this->data['sendmsg'] = $this->page_model->get(9);
        $this->data['workingtgr'] = $this->page_model->get(8);
        // echo"<pre>";print_r($this->data['contact']);exit;
        $this->data['active_menu'] = 'contact';
        $this->data['site_content'] = 'contact_us';
        $this->load->view('web/content', $this->data);
    }

    public function send()
    {
        $this->form_validation->set_rules('contact_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('contact_message', 'Message', 'trim|required');
        $this->form_validation->set_rules('contact_phone', 'Phone', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // reCAPTCHA validation
        $captcha = $this->getCaptcha($this->input->post('g-recaptcha-response'));
        if (!$captcha->success || $captcha->score < 0.5) {
            echo json_encode(['status' => 'error', 'message' => 'reCAPTCHA failed']);
            return;
        }

        // Email setup
        $this->load->library('email');
        $config_mail = config_item('MAIL');
        $email_setting = [
            'protocol'    => $config_mail['ENABLE_SMTP'] ? 'smtp' : 'mail',
            'smtp_host'   => $config_mail['SMTP_HOST'],
            'smtp_user'   => $config_mail['SMTP_EMAIL'],
            'smtp_pass'   => $config_mail['SMTP_PASSWORD'],
            'smtp_port'   => $config_mail['SMTP_PORT'],
            'smtp_crypto' => $config_mail['SMTP_SECURE'],
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        ];
        $this->email->initialize($email_setting);

        $contact_name    = $this->input->post('contact_name');
        $contact_email   = $this->input->post('contact_email');
        $contact_phone   = $this->input->post('contact_phone');
        $contact_subject = $this->input->post('contact_subject');
        $contact_message = $this->input->post('contact_message');

        $subject = config_item('WEBSITE_TITLE') . " | Contact from " . $contact_name;
        $common_contact = $this->contact_model->get_by_lang(1, $_SESSION['lang']);

        // $mail_to = $common_contact->email;
        $mail_to = 'anakha@virtualsystechnologies.com';

        // echo '<pre>';print_r($mail_to);exit;

        $body = "
    <h3>New Contact Message</h3>
    <p><strong>Name:</strong> {$contact_name}</p>
    <p><strong>Email:</strong> {$contact_email}</p>
    <p><strong>Phone:</strong> {$contact_phone}</p>
    <p><strong>Subject:</strong> {$contact_subject}</p>
    <p><strong>Message:</strong><br>{$contact_message}</p>
    ";

        $this->email->from($config_mail['FROM_EMAIL'], $config_mail['FROM_NAME']);
        $this->email->reply_to($contact_email, $contact_name);
        $this->email->to($mail_to);
        $this->email->subject($subject);
        $this->email->message($body);

        if ($this->email->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Your message has been sent successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->email->print_debugger()]);
        }
    }

    public function getCaptcha($token)
    {
        $secret = config_item('SECRET_KEY');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$token}");
        return json_decode($response);
    }
}
