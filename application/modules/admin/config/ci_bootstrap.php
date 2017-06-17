<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

// Menu
$menu['home'] = array(
                    'name'		=> 'Home',
                    'url'		=> '',
                    'icon'		=> 'fa fa-home',
                );

$menu['user'] = array(
    'name'		=> 'Users',
    'url'		=> 'user',
    'icon'		=> 'fa fa-users',
    'children'  => array(
        'List'			=> 'user',
        'Create'		=> 'user/create',
        'User Groups'	=> 'user/group',
    )
);

$menu['blog'] = array(
        'name'		=> 'Blog',
        'url'		=> 'blog',
        'icon'		=> 'ion ion-edit',	// can use Ionicons instead of FontAwesome
        'children'  => array(
            'Blog Posts'		=> 'blog/post',
            'Blog Categories'	=> 'blog/category',
            'Blog Tags'			=> 'blog/tag',
        )
);

$menu['product'] = array(
    'name'		=> 'Product',
    'url'		=> 'product',
    'icon'		=> 'ion ion-cube',	// can use Ionicons instead of FontAwesome
    'children'  => array(
        'Product'		        => 'product/post',
        'Product Categories'	=> 'product/category',
        'Product Tags'			=> 'product/tag',
    )
);

$menu['cover_photo'] = array(
        'name'		=> 'Cover Photos',
        'url'		=> 'cover_photo',
        'icon'		=> 'ion ion-image',	// can use Ionicons instead of FontAwesome
    );

$menu['admin_panel'] = array (
    'name'		=> 'Admin Panel',
    'url'		=> 'panel',
    'icon'		=> 'fa fa-cog',
    'children'  => array(
        'Admin Users'			=> 'panel/admin_user',
        'Create Admin User'		=> 'panel/admin_user_create',
        'Admin User Groups'		=> 'panel/admin_user_group',
        'Admin Group Rights'	=> 'panel/rights',
    )
);

$menu['util'] = array(
    'name'		=> 'Utilities',
    'url'		=> 'util',
    'icon'		=> 'fa fa-cogs',
    'children'  => array(
        'Database Versions'		=> 'util/list_db',
        'Settings'		=> 'util/settings',
    )
);

$menu['logout'] = array(
    'name'		=> 'Sign Out',
    'url'		=> 'panel/logout',
    'icon'		=> 'fa fa-sign-out',
);



$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'Elektro Kuppens',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),
	
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'
		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => $menu,

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'util'						=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-blue',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-yellow',
			'staff'		=> 'skin-green',
			'Kuppens'   => 'skin-yellow',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff', 'Kuppens'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Github Repo',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_admin';