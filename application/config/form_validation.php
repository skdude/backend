<?php

/**
 * Config file for form validation
 * http://www.codeigniter.com/user_guide/libraries/form_validation.html (Under section "Creating Sets of Rules")
 */

$config = array(

	/** Example: **/
	'login/index' => array(
        array(
            'field'		=> 'username',
            'label'		=> 'Username',
            'rules'		=> 'required',
        ),
        array(
            'field'		=> 'password',
            'label'		=> 'Password',
            'rules'		=> 'required',
        ),
	),

    'register/index' => array(
        array(
            'field'		=> 'username',
            'label'		=> 'Username',
            'rules'		=> 'required',
        ),
        array(
            'field'		=> 'email',
            'label'		=> 'Email',
            'rules'		=> 'required',
        ),
        array(
            'field'		=> 'password',
            'label'		=> 'Password',
            'rules'		=> 'required',
        ),
    ),

    // Admin User Update Info
    'profile/account_update_info' => array(
        array(
            'field'		=> 'email',
            'label'		=> 'Email',
            'rules'		=> 'required',
        ),
    ),

    // Admin User Change Password
    'profile/account_change_password' => array(
        array(
            'field'		=> 'new_password',
            'label'		=> 'New Password',
            'rules'		=> 'required',
        ),
        array(
            'field'		=> 'retype_password',
            'label'		=> 'Retype Password',
            'rules'		=> 'required|matches[new_password]',
        ),
    ),
);

/**
 * Google reCAPTCHA settings
 * https://www.google.com/recaptcha/
 */
$config['recaptcha'] = array(
	'site_key'		=> '',
	'secret_key'	=> '',
);
