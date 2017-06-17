<?php 

class Products_tag_model extends MY_Model {

	public function get_by_post_id($post_id)
	{
		$this->db->select($this->_table.'.*');
		$this->db->join('products_tags_link', $this->_table.'.id = products_tags_link.tag_id', 'RIGHT');
		$this->db->where('products_tags_link.product_id', $post_id);
		$query = $this->db->get($this->_table);
		return $query->result();
	}
}