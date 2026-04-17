<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Panel_Controller extends CO_Core_Controller {

    function __construct() {

        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('panel/user/login');
        }
        //checking user is not customer
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->in_group('customer')) {
                redirect('error_pages/show_403');
            }
        }
        // globally change the error delimiters
        $this->form_validation->set_error_delimiters('<div class="error-text">', '</div>');
    }

    public function check_has_permission($keys) {

        if ($keys) {
            if (is_array($keys)) {
                foreach ($keys as $key) {
                    if ($this->ion_auth_acl->is_allowed($key) == FALSE && $this->ion_auth_acl->is_inherited($key) == FALSE) {
                        redirect('panel/custom_errors/show_403');
                        break;
                    }
                }
            } else {
                if ($this->ion_auth_acl->is_allowed($keys) == FALSE && $this->ion_auth_acl->is_inherited($keys) == FALSE) {
                    redirect('panel/custom_errors/show_403');
                }
            }
        }
    }

    public function has_permission($key) {

        if ($this->ion_auth_acl->is_allowed($key) == FALSE && $this->ion_auth_acl->is_inherited($key) == FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
