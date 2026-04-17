<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CO_Web_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('File_model', 'file_model');
        $this->load->model('Page_model', 'page_model');
        $this->load->model('Settings_model', 'settings_model');
        $this->load->model('Status_model', 'status_model');
        $this->load->model('Testimonial_model', 'testimonial_model');
        $this->load->model('Brand_model', 'brand_model');
        $this->load->model('Bio_model', 'bio_model');
        $this->load->model('Blog_model', 'blog_model');
        $this->load->model('Solution_category_model', 'solution_category_model');


        //loading library
        $this->load->library('email');
    }

    public function index()
    {
        $this->data['banners'] = $this->file_model->get_all(1);
        $this->data['status'] = $this->status_model->get_all();
        $this->data['clients'] = $this->file_model->get_all_by_order(2);
        $home_product = $this->file_model->get_all(4);

//         echo"<pre>";
// print_r($home_product);
// exit;
        // Sort by `link` ascending
        usort($home_product, function ($a, $b) {
            return $a->order <=> $b->order;
        });
        

        $this->data['home_products'] = $home_product;

        // $Marquee = $this->page_model->get(1);
        // $Marquee->short_desc  = str_replace(['<ul>', '</ul>'], '',  $Marquee->short_desc);
        // $Marquee->short_desc  = str_replace('</li>', '',  $Marquee->short_desc);
        // $marqueeArray = explode('<li>',  $Marquee->short_desc);
        // $marqueeArray = array_filter(array_map('trim', $marqueeArray));
        // $this->data['marqueeArray'] = $marqueeArray;
        // $this->data['process'] = $this->brand_model->get_all();
        // $this->data['processlabel'] = $this->page_model->get(12);
        // $this->data['projectlabel'] = $this->page_model->get(13);


        $this->data['solution'] = $this->page_model->get(1);
        $this->data['ourservice'] = $this->page_model->get(2);
        $this->data['ourproduct'] = $this->page_model->get(7);
        $this->data['customers'] = $this->page_model->get(10);

        

        // $this->data['about_count'] = $this->page_model->get(3);
        // $this->data['about_vision'] = $this->page_model->get(4);
        // $this->data['about_mission'] = $this->page_model->get(5);
        // $this->data['about_core'] = $this->page_model->get(6);

        $this->data['services'] = $this->bio_model->get_all();
        $this->data['projects'] = $this->blog_model->get_all();

        $solution_categories  = $this->solution_category_model->get_all();


        $solution_categories = $this->solution_category_model->get_all();

        $childrenOfOnWheels = [];
        $finalCategories    = [];

        // First collect children of "On Wheels" (parent_id = 1)
        foreach ($solution_categories as $cat) {
            if ($cat->parent_id == 1 && $cat->active == 1) {
                $childrenOfOnWheels[] = $cat;
            }
        }

        // Sort children by category_order
        usort($childrenOfOnWheels, function ($a, $b) {
            return $a->category_order <=> $b->category_order;
        });

        // Add them first
        $finalCategories = $childrenOfOnWheels;

        // Now add remaining top-level categories (excluding On Wheels itself)
        foreach ($solution_categories as $cat) {
            if (
                $cat->parent_id == 0 &&
                $cat->id != 1 && // exclude "On Wheels"
                $cat->active == 1
            ) {
                $finalCategories[] = $cat;
            }
        }


        // echo '<pre>';
        // print_r($solution_categories);
        // exit;

        // $parents = array_column($solution_categories, 'parent_id');
        // $final_categories = [];
        // foreach ($solution_categories as $category) {
        //     if (in_array($category->id, $parents)) {
        //         continue; // skip parent categories
        //     }
        //    $final_categories[] = $category;
        // }

        // echo '<pre>';print_r($final_categories);exit;

        $this->data['final_categories'] = $finalCategories;
        $this->data['active_menu'] = 'home';
        $this->data['site_content'] = 'home';
        $this->load->view('web/content', $this->data);
    }

    // public function contact_form()
    // {
    //     $settings = $this->settings_model->get(1);
    //     $contact_email = $this->data['settings']->contact_email;
    //     $response_arr['error'] = true;
    //     if ($_POST) {
    //         // echo"<pre>";print_r($_POST);exit;
    //         $name = $_POST['first_name'] . " " . $_POST['last_name'];
    //         $email = $_POST['email'];
    //         $phone = $_POST['phone'];
    //         $message = $_POST['message'];
    //         // $this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
    //         // $this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
    //         // $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    //         // $this->form_validation->set_rules('phone', 'phone', 'trim');
    //         // $this->form_validation->set_rules('message', 'message', 'trim');
    //         if (trim($_POST['first_name']) != '' && trim($_POST['last_name']) != '' && trim($_POST['email']) != '' && trim($_POST['phone']) != '') {
    //             // if ($this->form_validation->run() === true) {
    //             $msg = '';
    //             $msg .= '<style>* {box-sizing: border-box;}body {margin: 0;padding: 0;}a[x-apple-data-detectors] {color: inherit !important;text-decoration: inherit !important;}#MessageViewBody a {color: inherit;text-decoration: none;}p {line-height: inherit}.desktop_hide,.desktop_hide table {mso-hide: all;display: none;max-height: 0px;overflow: hidden;}.image_block img+div {display: none;}@media (max-width:660px) {.desktop_hide table.icons-inner,.social_block.desktop_hide .social-table {display: inline-block !important;}.icons-inner {text-align: center;}.icons-inner td {margin: 0 auto;}.image_block img.big,.row-content {width: 100% !important;}.mobile_hide {display: none;}.stack .column {width: 100%;display: block;}.mobile_hide {min-height: 0;max-height: 0;max-width: 0;overflow: hidden;font-size: 0px;}.desktop_hide,.desktop_hide table {display: table !important;max-height: none !important;}.row-4 .column-1 .block-2.text_block td.pad {padding: 25px 0 0 !important;}}</style>';

    //             $msg .= '<table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">';
    //             $msg .= '	<tbody><tr><td class="column column-1" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #f2f7f9; padding-left: 25px; padding-right: 25px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">';
    //             $msg .= '<table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"><tr><td class="pad" style="width:100%;padding-right:0px;padding-left:0px;"><div class="alignment" align="center" style="line-height:10px"><a href="' . base_url("/") . '" target="_blank" style="outline:none" tabindex="-1"><img src="' . base_url("assets/web/images/logo.png") . '" style="display: block; height: auto; border: 0; width: 189px; max-width: 100%;" width="189" alt="Logo" title="Logo"></a></div>';
    //             $msg .= '</td></tr></table></td><td class="column column-2" width="50%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; background-color: #f2f7f9; padding-left: 25px; padding-right: 25px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">';
    //             $msg .= '<table class="empty_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">';
    //             $msg .= '<tr><td class="pad"><div></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table>';
    //             $msg .= '<table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">';
    //             $msg .= '<tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 40px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">';

    //             $msg .= '<table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">';
    //             $msg .= '<tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-radius: 0; color: #000000; width: 640px;" width="640">';
    //             $msg .= '<tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">';
    //             $msg .= '<table class="divider_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">';
    //             $msg .= '<tr><td class="pad"><div class="alignment" align="center"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">';
    //             $msg .= '<tr><td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;"><span>&#8202;</span></td></tr></table></div></td></tr></table>';
    //             $msg .= '<table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">';
    //             $msg .= '<tr><td class="pad" style="padding-top:30px;"><div style="font-family: sans-serif"><div class style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 24px; color: #555555; line-height: 2;">';
    //             $msg .= '<p style="margin: 0; font-size: 14px; mso-line-height-alt: 36px;"><span style="font-size:18px;">Name:</span>' . $name . '</p><p style="margin: 0; font-size: 14px; mso-line-height-alt: 36px;"><span style="font-size:18px;">Email:</span>' . $email . '</p><p style="margin: 0; font-size: 14px; mso-line-height-alt: 36px;"><span style="font-size:18px;">Contact No:</span>' . $phone . '</p><p style="margin: 0; font-size: 14px; mso-line-height-alt: 36px;"><span style="font-size:18px;">Message:</span>' . nl2br($message) . '</p></div></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table>';


    //             $this->email->from($email, $name);
    //             $this->email->to($contact_email);

    //             $this->email->subject('Enquiry from ' . $name . ' on ' . date("d-m-y", time()));
    //             $this->email->message($msg);

    //             $sent = $this->email->send();
    //             if ($sent) {
    //                 echo json_encode(['success' => true]);
    //             } else {
    //                 echo json_encode(['fail' => true]);
    //             }
    //         } else {
    //             if (trim($_POST['first_name']) == '') {
    //                 $response_arr['first_name_error'] = "First Name Required";
    //             }
    //             if (trim($_POST['last_name']) == '') {
    //                 $response_arr['last_name_error'] = "Last Name Required";
    //             }
    //             if (trim($_POST['phone']) == '') {
    //                 $response_arr['phone_error'] = "Phone Number Required";
    //             }
    //             if (trim($_POST['email']) == '') {
    //                 $response_arr['email_error'] = "Email Required";
    //             }
    //             echo json_encode($response_arr);
    //         }
    //     }
    // }
}
