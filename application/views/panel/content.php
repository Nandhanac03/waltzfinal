<?php

$this->load->view('panel/common/master_page');
$this->load->view('panel/common/header');
$this->load->view('panel/common/side_menu');
if (!empty(trim($site_content))) {
    $this->load->view('panel/' . $site_content);
}
$this->load->view('panel/common/script');
$this->load->view('panel/common/footer');
?>