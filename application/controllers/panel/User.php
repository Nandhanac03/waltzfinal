<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CO_Core_Controller
{

    function __construct()
    {
        parent::__construct();
        //loading model
        $this->load->model('Profile_model', 'profile_model');
        $this->load->model('Country_model', 'country_model');
        //configuration
        $controller_config = array();
        $controller_config['disable_add_user'] = FALSE;
        $controller_config['disable_first_name'] = FALSE;
        $controller_config['disable_last_name'] = FALSE;
        $controller_config['disable_company'] = FALSE;
        $controller_config['disable_address'] = FALSE;
        $controller_config['disable_city'] = FALSE;
        $controller_config['disable_district'] = FALSE;
        $controller_config['disable_state'] = FALSE;
        $controller_config['disable_country'] = FALSE;
        $controller_config['disable_postal_code'] = FALSE;
        $controller_config['disable_phone'] = FALSE;
        $controller_config['disable_fax'] = FALSE;
        $controller_config['disable_username'] = FALSE;
        $controller_config['disable_group'] = FALSE;
        $controller_config['disable_status'] = FALSE;
        $controller_config['disable_lm_user_permissions'] = TRUE;
        $this->data['controller_config'] = $controller_config;

        // globally change the error delimiters
        $this->form_validation->set_error_delimiters('<div class="error-text">', '</div>');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('panel/user/login');
        } else {

            if (!$this->ion_auth->in_group('customer')) {
                redirect('panel/user');
            } else {
                //redirect them to the dashboard
                redirect('panel/dashboard/');
            }
        }
    }

    public function login()
    {
        if ($this->ion_auth->logged_in()) {
            //redirect them to the dashboard
            redirect('panel/dashboard/');
        }
        //validate form input
        $validationRules = array(array('field' => 'identity', 'label' => 'Username', 'rules' => 'trim|strtolower|required'), array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'));
        $this->form_validation->set_rules($validationRules);
        if ($this->form_validation->run() === TRUE) {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                if ($this->ion_auth->in_group('customer')) {
                    $this->ion_auth->logout();
                    $this->session->set_flashdata('error', 'Invalid username or password.');
                    redirect('/panel/user/login', 'refresh');
                }
                //if the login is successful
                redirect('panel/dashboard', 'refresh');
            } else {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('/panel/user/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        $this->load->view('panel/login', $this->data);
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('identity', 'username', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();
            if (empty($identity)) {
                $this->session->set_flashdata('error', 'Username not found');
                redirect("panel/user/forgot_password", 'refresh');
            }
            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                // $this->session->set_flashdata('success', "Verification code sent successfully.");
                redirect("panel/user/login", 'refresh');
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                // $this->session->set_flashdata('error', "Error occured.");
                redirect("panel/user/forgot_password", 'refresh');
            }
        }
        $this->load->view('panel/forgot_password', $this->data);
    }

    public function reset_password($code = NULL)
    {
        if (!$code) {
            redirect("error_pages/show_404", 'refresh');
        }
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('regPassword', 'new password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[regConfirmPassword]');
            $this->form_validation->set_rules('regConfirmPassword', 'confirm password', 'required');
            if ($this->form_validation->run() === TRUE) {
                $identity = $user->{$this->config->item('identity', 'ion_auth')};
                //do we have a valid request?
                if ($user->id != $this->input->post('regUsername')) {
                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($identity);
                    $this->session->set_flashdata('error', 'Invalid recovery code.');
                    redirect("panel/user/forgot_password", 'refresh');
                } else {
                    //finally change the password
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('regConfirmPassword'));
                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('success', $this->ion_auth->messages());
                        redirect("panel/user/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('error', $this->ion_auth->errors());
                        redirect('panel/user/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("panel/user/forgot_password", 'refresh');
        }
        $this->data['code'] = $code;
        $this->data['user'] = $user;
        $this->load->view('panel/recovery_password', $this->data);
    }

    public function change_password()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $this->form_validation->set_rules('regOldPassword', 'old password', 'required');
        $this->form_validation->set_rules('regPassword', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[regConfirmPassword]');
        $this->form_validation->set_rules('regConfirmPassword', 'confirm password', 'required');
        if ($this->form_validation->run() === TRUE) {
            $identity = $this->session->userdata('identity');
            $change = $this->ion_auth->change_password($identity, $this->input->post('regOldPassword'), $this->input->post('regPassword'));
            if ($change) {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect('panel/user/change_password', 'refresh');
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('panel/user/change_password', 'refresh');
            }
        }
        $this->data['site_content'] = 'change_password';
        $this->load->view('panel/content', $this->data);
    }

    public function accounts()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $this->data['active_menu'] = 'accounts';
        //list the users
        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $this->data['site_content'] = 'accounts';
        $this->load->view('panel/content', $this->data);
    }

    public function add_account()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $countries = $this->country_model->get_countries();
        $tables = $this->config->item('tables', 'ion_auth');
        $groups = $this->ion_auth->groups()->result_array();
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        //validate form input
        if ($this->data['controller_config']['disable_first_name'] != true)
            $this->form_validation->set_rules('regFirstName', 'first name', 'trim|required');
        if ($this->data['controller_config']['disable_last_name'] != true)
            $this->form_validation->set_rules('regLastName', 'last name', 'trim|required');
        if ($this->data['controller_config']['disable_username'] != true)
            $this->form_validation->set_rules('regUsername', 'username', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
        $this->form_validation->set_rules('regEmail', 'email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('regPhone', 'phone', 'trim');
        $this->form_validation->set_rules('regCompany', 'company', 'trim');
        $this->form_validation->set_rules('regPassword', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[regConfirmPassword]');
        $this->form_validation->set_rules('regConfirmPassword', 'confirm password', 'required');
        if ($this->data['controller_config']['disable_group'] != true)
            $this->form_validation->set_rules('regGroups[]', 'group', 'trim|required');
        $this->form_validation->set_rules('regAddress', 'address', 'trim');
        $this->form_validation->set_rules('regCity', 'city', 'trim');
        $this->form_validation->set_rules('regState', 'state', 'trim');
        $this->form_validation->set_rules('regCountry', 'country', 'trim');
        $this->form_validation->set_rules('regPostalCode', 'zip/postal code', 'trim');
        $this->form_validation->set_rules('regFax', 'fax', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('regEmail'));
            $username = !empty($this->input->post('regUsername')) ? $this->input->post('regUsername') : mt_rand(1, 9999) . time();
            $identity = ($identity_column === 'email') ? $email : $username;
            $password = $this->input->post('regPassword');
            $additional_data = ['first_name' => $this->input->post('regFirstName'), 'last_name' => $this->input->post('regLastName'), 'company' => $this->input->post('regCompany'), 'phone' => $this->input->post('regPhone'),];
        }
        if ($id = $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            //Update the groups user belongs to
            $this->ion_auth->remove_from_group('', $id);
            $groupData = $this->input->post('regGroups');
            if (isset($groupData) && !empty($groupData)) {
                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }
            }
            if (empty($this->input->post('regUsername'))) {
                $input_data = array();
                $username = 'U' . mt_rand(1, 9999) . $id;
                $input_data['username'] = $username;
                $this->ion_auth->update($id, $input_data);
            }
            $input_data = array();
            $input_data['user_id'] = $id;
            $input_data['address'] = $this->input->post('regAddress');
            $input_data['city'] = $this->input->post('regCity');
            $input_data['state'] = $this->input->post('regState');
            $input_data['country'] = $this->input->post('regCountry');
            $input_data['po_box'] = $this->input->post('regPostalCode');
            $input_data['fax'] = $this->input->post('regFax');
            $input_data['created_at'] = time();
            $input_data['created_by'] = $id;
            $input_data['updated_at'] = '';
            $input_data['updated_by'] = '';
            $input_data['active'] = 1;
            $this->profile_model->add($input_data);
            $this->session->set_flashdata('success', 'Account Added Successfully');
            redirect("panel/user/add_account", 'refresh');
        }
        $this->data['countries'] = $countries;
        $this->data['groups'] = $groups;
        $this->data['active_menu'] = 'accounts';
        $this->data['site_content'] = 'add_account';
        $this->load->view('panel/content', $this->data);
    }

    public function edit_account($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $countries = $this->country_model->get_countries();
        $tables = $this->config->item('tables', 'ion_auth');
        $user = $this->ion_auth->user($id)->row();
        if (!$id || empty($id) || empty($user)) {
            redirect('panel/user/accounts', 'refresh');
        }
        $profile = $this->profile_model->get_profile($user->id);
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $userGroups = array();
        foreach ($currentGroups as $currentGroup) {
            array_push($userGroups, $currentGroup->id);
        }
        //validate form input
        if ($this->data['controller_config']['disable_first_name'] != true)
            $this->form_validation->set_rules('regFirstName', 'first name', 'trim|required');
        if ($this->data['controller_config']['disable_last_name'] != true)
            $this->form_validation->set_rules('regLastName', 'last name', 'trim|required');
        if ($this->data['controller_config']['disable_group'] != true)
            $this->form_validation->set_rules('regGroups[]', 'group', 'trim|required');
        if ($this->data['controller_config']['disable_status'] != true)
            $this->form_validation->set_rules('regStatus', 'status', 'trim|required');
        $this->form_validation->set_rules('regPhone', 'phone', 'trim');
        $this->form_validation->set_rules('regCompany', 'company', 'trim');
        if (isset($_POST) && empty($_POST)) {

            if ($this->input->post('regUsername') != $user->username && $this->data['controller_config']['disable_username'] != true) {
                $this->form_validation->set_rules('regUsername', 'username', 'trim|required|is_unique[' . $tables['users'] . '.username]');
            }
            if ($this->input->post('regEmail') === $user->email) {
                $this->form_validation->set_rules('regEmail', 'email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
            }
            if ($this->input->post('regPassword') || $this->input->post('regConfirmPassword')) {
                $this->form_validation->set_rules('regPassword', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[regConfirmPassword]');
                $this->form_validation->set_rules('regConfirmPassword', 'confirm password', 'required');
            }
        }
        $this->form_validation->set_rules('regAddress', 'address', 'trim');
        $this->form_validation->set_rules('regCity', 'city', 'trim');
        $this->form_validation->set_rules('regState', 'state', 'trim');
        $this->form_validation->set_rules('regCountry', 'country', 'trim');
        $this->form_validation->set_rules('regPostalCode', 'zip/postal code', 'trim');
        $this->form_validation->set_rules('regFax', 'fax', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('regEmail'));
            $username = $this->input->post('regUsername');
            $data = ['first_name' => $this->input->post('regFirstName'), 'last_name' => $this->input->post('regLastName'), 'company' => $this->input->post('regCompany'), 'phone' => $this->input->post('regPhone'), 'email' => $email, 'username' => $username];
            //update the password if it was posted
            if ($this->input->post('regPassword')) {
                $data['password'] = $this->input->post('regPassword');
            }
            //check to see if we are updating the user
            if ($this->ion_auth->update($user->id, $data)) {
                //Update the groups user belongs to
                $this->ion_auth->remove_from_group('', $id);
                $groupData = $this->input->post('regGroups');
                if (isset($groupData) && !empty($groupData)) {
                    foreach ($groupData as $grp) {
                        $this->ion_auth->add_to_group($grp, $id);
                    }
                }
                if ($this->input->post('regStatus') == 'A') {
                    $this->ion_auth->activate($id);
                } else {
                    $this->ion_auth->deactivate($id);
                }
                $input_data = array();
                $input_data['address'] = $this->input->post('regAddress');
                $input_data['city'] = $this->input->post('regCity');
                $input_data['state'] = $this->input->post('regState');
                $input_data['country'] = $this->input->post('regCountry');
                $input_data['po_box'] = $this->input->post('regPostalCode');
                $input_data['fax'] = $this->input->post('regFax');
                $this->profile_model->update($input_data, $profile->id);
                //redirect them back to the admin page if admin, or to the base url if non admin
                $this->session->set_flashdata('success', 'Account Information Successfully Updated');
                redirect("panel/user/accounts", 'refresh');
            } else {
                //redirect them back to the admin page if admin, or to the base url if non admin
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect("panel/user/edit_account/" . $id, 'refresh');
            }
        }
        //pass the user to the view
        $this->data['profile'] = $profile;
        $this->data['countries'] = $countries;
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['userGroups'] = $userGroups;
        $this->data['active_menu'] = 'accounts';
        $this->data['site_content'] = 'edit_account';
        $this->load->view('panel/content', $this->data);
    }

    public function ajax_get_customer()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if ($this->ion_auth->logged_in()) {
            $filter['search_user'] = trim($this->input->post('search_customer'));
            $users = $this->profile_model->get_profiles($filter);
            $result = array();
            if ($users) {
                foreach ($users as $user) {
                    $user_groups = $this->ion_auth->get_users_groups($user->user_id)->result();
                    $user_group_array = array();
                    foreach ($user_groups as $user_group) {
                        array_push($user_group_array, $user_group->id);
                    }
                    if (in_array('2', $user_group_array)) {
                        $customer_result = array();
                        $customer_result['id'] = $user->user_id;
                        $customer_result['text'] = $user->first_name . ' ' . $user->last_name;
                        array_push($result, $customer_result);
                    }
                }
            }
            echo json_encode($result);
        }
    }

    public function groups()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $groups = $this->ion_auth->groups()->result_array();
        $this->data['groups'] = $groups;
        $this->data['active_menu'] = 'groups';
        $this->data['site_content'] = 'groups';
        $this->load->view('panel/content', $this->data);
    }

    public function add_group()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        //validate form input
        $this->form_validation->set_rules('regGroupName', 'Group Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('regGroupDesc', 'Group Description', 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('regGroupName'), $this->input->post('regGroupDesc'));
            if ($new_group_id) {
                //check to see if we are creating the group
                //redirect them back to the admin page
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect("panel/user/groups", 'refresh');
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            }
        }
        $this->data['active_menu'] = 'groups';
        $this->data['site_content'] = 'add_group';
        $this->load->view('panel/content', $this->data);
    }

    public function edit_group($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $group = $this->ion_auth->group($id)->row();
        if (!$id || empty($id) || empty($group)) {
            redirect('panel/user/groups', 'refresh');
        }
        //validate form input
        $this->form_validation->set_rules('regGroupName', 'Group Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('regGroupDesc', 'Group Description', 'trim|required');
        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['regGroupName'], array('description' => $_POST['regGroupDesc']));
                if ($group_update) {
                    $this->session->set_flashdata('success', $this->lang->line('edit_group_saved'));
                    redirect("panel/user/groups", 'refresh');
                } else {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                }
            }
        }
        $this->data['group'] = $group;
        $this->data['active_menu'] = 'groups';
        $this->data['site_content'] = 'edit_group';
        $this->load->view('panel/content', $this->data);
    }

    public function permissions()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $permissions = $this->ion_auth_acl->permissions('full');
        $this->data['permissions'] = $permissions;
        $this->data['active_menu'] = 'permissions';
        $this->data['site_content'] = 'permissions';
        $this->load->view('panel/content', $this->data);
    }

    public function add_permission()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $this->form_validation->set_rules('regPermissionKey', 'Key', 'required|trim|is_unique[permissions.perm_key]');
        $this->form_validation->set_rules('regPermissionName', 'Name', 'required|trim');
        $this->form_validation->set_message('required', 'Please enter a %s');
        if ($this->form_validation->run() === TRUE) {
            $new_permission_id = $this->ion_auth_acl->create_permission($this->input->post('regPermissionKey'), $this->input->post('regPermissionName'));
            if ($new_permission_id) {
                //check to see if we are creating the permission
                //redirect them back to the admin page
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect("panel/user/permissions", 'refresh');
            }
        }
        $this->data['active_menu'] = 'permissions';
        $this->data['site_content'] = 'add_permission';
        $this->load->view('panel/content', $this->data);
    }

    public function edit_permission($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $permission = $this->ion_auth_acl->permission($id);
        if (!$id || empty($id) || empty($permission)) {
            redirect("panel/user/permissions", 'refresh');
        }
        if ($permission->perm_key != $this->input->post('regPermissionKey')) {
            $this->form_validation->set_rules('regPermissionKey', 'Key', 'required|trim|is_unique[permissions.perm_key]');
        }
        $this->form_validation->set_rules('regPermissionName', 'Name', 'required|trim');
        $this->form_validation->set_message('required', 'Please enter a %s');
        if ($this->form_validation->run() === TRUE) {
            $additional_data = array('perm_name' => $this->input->post('regPermissionName'));
            $update_permission = $this->ion_auth_acl->update_permission($id, $this->input->post('regPermissionKey'), $additional_data);
            if ($update_permission) {
                //check to see if we are creating the permission
                //redirect them back to the admin page
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect("panel/user/permissions", 'refresh');
            }
        }
        $this->data['permission'] = $permission;
        $this->data['active_menu'] = 'permissions';
        $this->data['site_content'] = 'edit_permission';
        $this->load->view('panel/content', $this->data);
    }

    public function delete_permission($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        if (!$id || empty($id)) {
            redirect("panel/user/permissions", 'refresh');
        } else {
            if ($this->ion_auth_acl->remove_permission($id)) {
                $this->session->set_flashdata('success', 'Permission Deleted Successfully');
            }
        }
        redirect("panel/user/permissions", 'refresh');
    }

    public function user_permissions($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $user = $this->ion_auth->user($id)->row();
        if (!$id || empty($id) || empty($user)) {
            redirect('panel/user/accounts', 'refresh');
        }
        if (isset($_POST) && !empty($_POST)) {
            foreach ($this->input->post() as $k => $v) {
                if (substr($k, 0, 12) == 'uPermission_') {
                    $permission_id = str_replace("uPermission_", "", $k);
                    if ($v == "X")
                        $this->ion_auth_acl->remove_permission_from_user($id, $permission_id);
                    else
                        $this->ion_auth_acl->add_permission_to_user($id, $permission_id, $v);
                }
            }
            $this->session->set_flashdata('success', "User Permission Updated Successfully");
            redirect("panel/user/accounts", 'refresh');
        }
        $user_groups = $this->ion_auth_acl->get_user_groups($id);
        $this->data['user_id'] = $id;
        $this->data['user'] = $user;
        $this->data['permissions'] = $this->ion_auth_acl->permissions('full', 'perm_key');
        $this->data['group_permissions'] = $this->ion_auth_acl->get_group_permissions($user_groups);
        $this->data['users_permissions'] = $this->ion_auth_acl->build_acl($id);
        $this->data['active_menu'] = 'accounts';
        $this->data['site_content'] = 'user_permissions';
        $this->load->view('panel/content', $this->data);
    }

    public function group_permissions($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('panel/user/login', 'refresh');
        }
        $group = $this->ion_auth->group($id)->row();
        if (!$id || empty($id) || empty($group)) {
            redirect('panel/user/groups', 'refresh');
        }
        if (isset($_POST) && !empty($_POST)) {
            foreach ($this->input->post() as $k => $v) {
                if (substr($k, 0, 12) == 'uPermission_') {
                    $permission_id = str_replace("uPermission_", "", $k);
                    if ($v == "X")
                        $this->ion_auth_acl->remove_permission_from_group($id, $permission_id);
                    else
                        $this->ion_auth_acl->add_permission_to_group($id, $permission_id, $v);
                }
            }
            $this->session->set_flashdata('success', "Group Permission Updated Successfully");
            redirect("panel/user/groups", 'refresh');
        }
        $this->data['permissions'] = $this->ion_auth_acl->permissions('full', 'perm_key');
        $this->data['group_permissions'] = $this->ion_auth_acl->get_group_permissions($id);
        $this->data['group'] = $group;
        $this->data['active_menu'] = 'groups';
        $this->data['site_content'] = 'group_permissions';
        $this->load->view('panel/content', $this->data);
    }

    /**
     * Activate the user
     * @param int $id The user ID
     * @param string|bool $code The activation code
     */
    public function activate($id, $code = FALSE)
    {
        $activation = FALSE;
        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else {
            redirect("error_pages/show_404", 'refresh');
        }
        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("panel/user/login", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("pane/user/forgot_password", 'refresh');
        }
    }

    public function logout()
    {
        //log the user out
        $this->ion_auth->logout();
        //redirect them to the login page
        redirect('/panel/user/login', 'refresh');
    }

    public function email_link($user_id)
    {
        if ($user_id) {

            $character = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
            $length = 80;
            $new_character = '';
            for ($i = 0; $i < $length; $i++) {
                $new_character .= $character[rand(0, strlen($character) - 1)];
            }
        }
        echo $new_character;
        exit;
    }
}
