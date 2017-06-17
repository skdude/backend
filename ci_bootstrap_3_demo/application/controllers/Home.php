<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

	public function index()
	{
	    $this->load->model('blog_post_model');


        $res = $this->blog_post_model->get_blogPosts();

        if($res){
            $this->mViewData['blogposts'] = $res;
            $this->render('home', 'with_breadcrumb');

        } else {

            echo "Fail";

        }


	}
}
