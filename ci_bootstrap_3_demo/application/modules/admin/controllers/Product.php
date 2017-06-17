<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

	public function index()
	{
		redirect('product/post');
	}

	// Grocery CRUD - Blog Posts
	public function post()
	{
		$crud = $this->generate_crud('products');
		$crud->columns('name', 'category_id', 'image_url', 'tags', 'description', 'price', 'active');
		$crud->set_field_upload('image_url', UPLOAD_BLOG_POST);
		$crud->set_relation('category_id', 'products_categories', 'title');
		$crud->set_relation_n_n('tags', 'products_tags_link', 'products_tags', 'products_id', 'tag_id', 'title');

        $crud->add_action('Toggle active', '', 'admin/product/toggle_visibility', 'fa fa-toggle-on');
        $state = $crud->getState();
//		if ($state==='add')
//		{
//			$crud->field_type('author_id', 'hidden', $this->mUser->id);
//			$this->unset_crud_fields('status');
//		}
//		else
//		{
//			$crud->set_relation('author_id', 'admin_users', '{first_name} {last_name}');
//		}

		$this->mPageTitle = 'Products';
		$this->render_crud();
	}

	// Grocery CRUD - Blog Categories
	public function category()
	{
		$crud = $this->generate_crud('products_categories');
		$crud->columns('title');
		$this->mPageTitle = 'Products Categories';
		$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Sort Order', 'product/category_sortable');
		$this->render_crud();
	}
	
	// Sortable - Blog Categories
	public function category_sortable()
	{
		$this->load->library('sortable');
		$this->sortable->init('products_category_model');
		$this->mViewData['content'] = $this->sortable->render('{title}', 'product/category');
		$this->mPageTitle = 'Product Categories';
		$this->render('general');
	}

	// Grocery CRUD - Blog Tags
	public function tag()
	{
		$crud = $this->generate_crud('products_tags');
		$this->mPageTitle = 'product Tags';
		$this->render_crud();
	}

	public function toggle_visibility($id)
    {
        $this->load->model('products_model');
        $res = $this->products_model->toggleProductVisibility($id);

        redirect(site_url(strtolower('admin/product/post')));
    }
}
