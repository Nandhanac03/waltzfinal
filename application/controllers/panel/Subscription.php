<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Subscription extends CO_Panel_Controller
{

    public function __construct()
    {
        parent::__construct();
        //loading models
        $this->load->model('Newsletter_model', 'newsletter_model');

        //loading helpers
        $this->load->helper('file_upload');
        $this->load->helper('image_upload');
        //declaring variables
        $this->data['albumImgError'] = '';
        $this->data['fileAlbumError'] = '';
        //configuration
        $controller_config = array();
        $controller_config['disable_album_add'] = FALSE;
        $controller_config['disable_album_delete'] = FALSE;
        $controller_config['disable_album_file_edit'] = FALSE;
        $controller_config['disable_album_file_delete'] = FALSE;
        $controller_config['disable_album_file_subtitle'] = TRUE;
        $controller_config['disable_album_file_short_desc'] = TRUE;
        $controller_config['disable_album_file_languages'] = FALSE;
        $controller_config['disable_album_file_browse'] = FALSE;
        $controller_config['disable_album_file_button_name'] = TRUE;
        $controller_config['disable_album_file_link'] = TRUE;
        $this->data['controller_config'] = $controller_config;
    }

    public function index()
    {
        redirect('panel/subscription/all', 'refresh');
    }

    public function all()
    {
        $subscribed_emails = $this->newsletter_model->get_all();
        // echo "<pre>";print_r($subscribed_emails);exit;

        $this->data['emails'] = $subscribed_emails;
        $this->data['active_menu'] = 'subscription';
        $this->data['site_content'] = 'subscription';
        $this->load->view('panel/content', $this->data);
    }
    public function downloadExcel()
    {
        //original excel download code in Candidate panel
        $data = $this->newsletter_model->get_all();

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl.No.');
        $sheet->setCellValue('B1', 'Email Id');

        $sheet->getColumnDimension('A')->setWidth(8); // Sl.No.
        $sheet->getColumnDimension('B')->setWidth(40); // Email Id

        $sheet->getStyle('A1')->applyFromArray($styleArray);
        $sheet->getStyle('B1')->applyFromArray($styleArray);


        $styleColArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $styleDownloadArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'font' => [
                'color' => [
                    'argb' => '0000FF',
                ]
            ]
        ];

        $row = 2;
        if ($data) {
            foreach ($data as $key => $value) {
                $sheet->setCellValue('A' . ($key + $row), $key + 1); // Sl.No.
                $sheet->setCellValue('B' . ($key + $row), $value->email); // Email Id

                $sheet->getStyle('A' . ($key + $row))->applyFromArray($styleColArray); //Sl No Align Center
                $sheet->getStyle('B' . ($key + $row))->getAlignment()->setWrapText(true); //Email Align Center

            }
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'subscribed-email-list-' . date('d-m-Y') . '-' . rand(10, 100);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output'); // download file

    }
}
