<?php 

class Products_model extends MY_Model {

	public $belongs_to = array(
		'category' => array(
			'model'			=> 'product_category_model',
			'primary_key'	=> 'category_id'
		)
	);
	
	protected $where = array('status' => 'show');
	protected $order_by = array('name', 'ASC');
	protected $upload_fields = array('image_url' => UPLOAD_BLOG_POST);
	
	// Append tags
	protected function callback_after_get($result)
	{
		$this->load->model('product_tag_model', 'tags');
		$result = parent::callback_after_get($result);

		if ( !empty($result) )
			$result->tags = $this->tags->get_by_post_id($result->id);
		
		return $result;
	}

	public function toggleProductVisibility($id)
    {

        $res = $this->db->query("UPDATE products SET active = !active WHERE id = {$id}");

//        $this->db->where('id', $id);
//        $this->db->update('products', $data);
//
//        $query = $this->db->update('products');
//        $res   = $query->result();
        return $res;
    }

    public function get_blogPosts(){


        $query = $this->db->get('products');
        $res   = $query->result();
        return $res;

    }
}