<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Register extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
        $this->add_stylesheet("/assets/dist/admin/adminlte.min.css");
        $this->load->library('ion_auth');

        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();
        if ($form->validate())
        {
//			// passed validation
            $identity = $this->input->post('username');
            $password = $this->input->post('password');
            $email    = $this->input->post('email');

            if ($this->ion_auth->register($identity, $password, $email))
            {
                // login succeed
                $messages = $this->ion_auth->messages();
                $this->system_message->set_success($messages);
                redirect('login/index?registered');
            }
            else
            {
                // login failed
                $errors = $this->ion_auth->errors();
                $this->system_message->set_error($errors);
                refresh();
            }
        }

        // display form when no POST data, or validation failed
        $this->mViewData['form'] = $form;
        $this->mBodyClass = 'login-page';
        $this->render('register', 'empty');
	}
    
}
