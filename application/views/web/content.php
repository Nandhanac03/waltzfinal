<?php

$this->load->view('web/common/master_page');

if ($active_menu == 'home') {
    $this->load->view('web/common/homeheader');
} else {
    $this->load->view('web/common/header');
}

if (!empty(trim($site_content))) {
    $this->load->view('web/' . $site_content);
}

$this->load->view('web/common/script');
$this->load->view('web/common/footer');

?> 