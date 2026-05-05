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


        $this->load->model('Settings_model', 'settings_model');

        $this->data['inner_banner'] = $this->file_model->get_file('', 4);
    }

    public function index()
    {
      
      $this->data['sendmsg'] = $this->page_model->get(9);
        $this->data['workingtgr'] = $this->page_model->get(8);
        $this->data['panel'] = $this->settings_model->get(1);
// print_r($this->data['panel']);
// exit;
        // echo"<pre>";print_r($this->data['contact']);exit;
        $this->data['active_menu'] = 'contact';
        $this->data['site_content'] = 'contact_us';
        $this->load->view('web/content', $this->data);
    }

    public function send()
    {


// print_r($_POST);
// exit;


        $this->form_validation->set_rules('contact_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('contact_message', 'Message', 'trim|required');
        $this->form_validation->set_rules('contact_phone', 'Phone', 'trim|required');

        // if ($this->form_validation->run() === FALSE) {
        //     echo json_encode(['status' => 'error', 'message' => validation_errors()]);
        //     return;
        // }


        $settings = $this->settings_model->get(1); // create if not exists

$emails = [];
foreach ($settings as $row) {
    if (filter_var($row->value, FILTER_VALIDATE_EMAIL)) {
        $emails[] = $row->value;
    }
}

// print_r($settings);
// exit;


        // reCAPTCHA validation
        $captcha = $this->getCaptcha($this->input->post('g-recaptcha-response'));

        if (!$captcha) {
            echo json_encode(['status' => 'error', 'message' => 'Unable to connect to reCAPTCHA service. Please try again later.']);
            return;
        }

        if (!$captcha->success || (isset($captcha->score) && $captcha->score < 0.3)) {
            $error_msg = 'reCAPTCHA failed';
            if (isset($captcha->{'error-codes'})) {
                $error_msg .= ': ' . implode(', ', $captcha->{'error-codes'});
            }
            echo json_encode(['status' => 'error', 'message' => $error_msg, 'score' => isset($captcha->score) ? $captcha->score : 'N/A']);
            return;
        }

        // Email setup
        $this->load->library('email');
        $config_mail = config_item('MAIL');
        $email_setting = [
            'protocol'    => $config_mail['ENABLE_SMTP'] ? 'smtp' : 'mail',
            'smtp_host'   => $config_mail['SMTP_HOST'],
            'smtp_user'   => $config_mail['SMTP_USER'],
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

        $mail_to = $common_contact->email;
      	

        $body = '
        <div style="background:#f5f7fa; padding:30px; font-family:Arial, sans-serif;">
            <div style="max-width:600px; margin:auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
        
                <div style="background:#4e73df; padding:20px; text-align:center; color:#ffffff;">
                    <h2 style="margin:0; font-weight:600;">New Contact Message</h2>
                </div>
        
                <div style="padding:25px; color:#333333; font-size:15px; line-height:1.6;">
                    
                    <p><strong style="color:#4e73df;">Name:</strong> ' . $contact_name . '</p>
                    <p><strong style="color:#4e73df;">Email:</strong> ' . $contact_email . '</p>
                    <p><strong style="color:#4e73df;">Phone:</strong> ' . $contact_phone . '</p>
                    <p><strong style="color:#4e73df;">Subject:</strong> ' . $contact_subject . '</p>
        
                    <div style="margin-top:20px; padding:15px; background:#f1f3f5; border-left:4px solid #4e73df; border-radius:6px;">
                        <p style="margin:0;"><strong style="color:#4e73df;">Message:</strong><br>' . nl2br($contact_message) . '</p>
                    </div>
        
                </div>
        
                <div style="background:#f0f0f0; padding:15px; text-align:center; font-size:13px; color:#888;">
                    This message was sent from the contact form on <strong>' . config_item("WEBSITE_TITLE") . '</strong>.
                </div>
        
            </div>
        </div>
        ';



        $this->email->from($config_mail['FROM_EMAIL'], $config_mail['FROM_NAME']);
        $this->email->cc('nandhana@virtualsystechnologies.com');
        $this->email->to($mail_to);
        // $this->email->to($emails);
      //  $this->email->cc('nandhana@virtualsystechnologies.com');



        $this->email->subject($subject);
        $this->email->message($body);

        if ($this->email->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Your message has been sent successfully!']);
        } else {
            $debug_info = strip_tags($this->email->print_debugger());
            echo json_encode(['status' => 'error', 'message' => 'Error occured while contacting. Details: ' . substr($debug_info, 0, 300)]);
        }
    }

    public function getCaptcha($token)
    {
        $secret = config_item('SECRET_KEY');
        $url = "https://www.google.com/recaptcha/api/siteverify";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => $secret,
            'response' => $token
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response);
    }
}
