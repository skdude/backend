<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class CardsLoaned extends MY_Controller {

	public function index()
	{
        $this->verify_login();

        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_subject("Card Loan");
        $crud->set_table('card_loans');
        $crud->columns('multiverseid', 'card_id', 'user_id', 'amount', 'status');

        $crud->display_as('card_id','Card');
        $crud->display_as('user_id','Loaned from');
        $crud->display_as('multiverseid','Card Image');

        $state = $crud->getState();
        $crud->unset_fields('loan_date', 'return_date');

        if ($state==='add' OR $state==='edit')
        {
            $crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
            $crud->unset_fields('status', 'loan_date', 'return_date');
        }


        $crud->where('loaned_to_user_id',$this->session->userdata('user_id'));
        $crud->where('status', 0);

        $crud->set_relation('card_id', 'cards', 'card_set');
        $crud->set_relation('user_id', 'users', 'username');

        // show card image
        $crud->callback_column('multiverseid', array($this,'showImage'));
        $crud->callback_field('multiverseid', array($this,'showImage'));

        // show labeled status
        $crud->callback_column('status', array($this,'showStatus'));

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_edit();

        $output = $crud->render();

        $this->add_stylesheet($output->css_files, FALSE);
        $this->add_script($output->js_files, TRUE, 'head');

        $this->mViewData['cards'] = (array)$output;

        $this->render('cards_loaned', 'with_breadcrumb');
	}

    function showImage($value, $row) {
        $query = $this->db->query("
                                SELECT multiverseid 
                                FROM cards c
                                LEFT JOIN card_loans cl
                                ON c.id = cl.card_id
                                WHERE cl.id = {$row->id}
                                ");

        foreach ($query->result() as $row)
        {
            return "<img style='width:100px;' src='http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={$row->multiverseid}&type=card'>";
        }

        return "No image to display";
    }

    function showStatus($value, $row) {
        if ($row->status == 1):
            return "<span class='label label-success'>returned</span>";
        else:
            return "<span class='label label-warning'>not returned</span>";
        endif;

        return "no status";
    }

    public function returnCards($id)
    {
        $now = date("Y-m-d H:i:s");
        $res = $this->db->query("UPDATE card_loans SET status = !status, return_date = '{$now}' WHERE id = {$id}");
        redirect(site_url(strtolower('cards')));
    }

}
