<?php
class Cart extends MY_Controller{

    public $cart;
    function index(){

        $this->load->model('cart_model');
        $data['items'] = $this->cart_model->get_products();
        $this->load->view('cart', $data);

    }

    function insert(){

        $this->load->model('cart_model');
        $product = $this->cart_model->insert_product($this->input->post('id'));
        $item = array(
            'id'=> $this->input->post('id'),
            'qty'=>$this->input->post('qunatity'),
            'price'=> $product->price,
            'name'=>$product->name
        );
        $this->cart->insert($item);
        redirect('cart');

    }



}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>