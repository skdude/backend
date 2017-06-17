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

    public function products()
    {
        $this->verify_login();

        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('products');

        $crud->columns('name', 'category_id', 'image_url', 'tags', 'description', 'price', 'active');
        $crud->set_field_upload('image_url', UPLOAD_BLOG_POST);
        $crud->set_relation('category_id', 'products_categories', 'title');
        $crud->set_relation_n_n('tags', 'products_tags_link', 'products_tags', 'products_id', 'tag_id', 'title');

        $crud->where('products.id',$this->session->userdata('user_id'));

        $output = $crud->render();

        $this->add_stylesheet($output->css_files, FALSE);
        $this->add_script($output->js_files, TRUE, 'head');

        $this->mViewData['products'] = (array)$output;

        $this->render('products', 'with_breadcrumb');
    }


}
