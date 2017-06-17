<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Profile extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_builder');
        $this->load->library('ion_auth');

        $this->verify_login();
    }

    // Account Settings
    public function index()
    {

        $this->mViewData['user'] = $this->mUser;


        $this->render('profile', 'with_breadcrumb');
    }

    // Submission of Update Info form
    public function account_update_info()
    {

        // Update Info form
        $form1 = $this->form_builder->create_form('profile/account_update_info', true);
        $form1->set_rule_group('profile/account_update_info');

        if ($form1->validate()):
            $data = $this->input->post();

            if($form1->uploadImage('profile_image', UPLOAD_USER)):
                $data['profile_image'] = $_FILES['profile_image']['name'];

                if ($this->ion_auth->update($this->session->userdata('user_id'), $data))
                {
                    $messages = $this->ion_auth->messages();
                    $this->system_message->set_success($messages);
                }
                else
                {
                    $errors = $this->ion_auth->errors();
                    $this->system_message->set_error($errors);
                }
            endif;
        endif;

        $this->mViewData['form1'] = $form1;
        $this->render('profile/update', 'with_breadcrumb');
    }

    // Submission of Change Password form
    public function account_change_password()
    {
        $data = array('password' => $this->input->post('new_password'));
        if ($this->ion_auth->update($this->session->userdata('user_id'), $data))
        {
            $messages = $this->ion_auth->messages();
            $this->system_message->set_success($messages);
        }
        else
        {
            $errors = $this->ion_auth->errors();
            $this->system_message->set_error($errors);
        }

        redirect('profile');
    }
}

