<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Cards extends MY_Controller {

	public function index()
	{
        $this->verify_login();

        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_subject("Card Loan");
        $crud->set_table('card_loans');
        $crud->columns('multiverseid', 'card_id', 'loaned_to_user_id');
        $crud->fields('search', 'card_id', 'loaned_to_user_id', 'amount', 'user_id');

        $crud->display_as('card_id','Name');
        $crud->display_as('loaned_to_user_id','Loaned to');
        $crud->display_as('multiverseid','Card.');

        $state = $crud->getState();
        $crud->unset_fields('loan_date', 'return_date');


        if ($state==='add' OR $state==='edit')
        {
            $crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
            $crud->unset_fields('status', 'loan_date', 'return_date');
        }


        $crud->where('user_id',$this->session->userdata('user_id'));
        $crud->where('status', 0);

        $crud->set_relation('card_id', 'cards', 'card_set');
        $crud->set_relation('loaned_to_user_id', 'users', 'username');

        // show card image
        $crud->callback_column('multiverseid', array($this,'showImage'));
        $crud->callback_add_field('search', array($this,'showSearch'));

        // show labeled status
        $crud->callback_column('status', array($this,'showStatus'));

        // toggle status
        $crud->add_action('Cards are returned', '', 'cards/returnCards', 'fa fa-undo');


        $output = $crud->render();

        $this->add_stylesheet($output->css_files, FALSE);
        $this->add_script($output->js_files, TRUE, 'head');

        $this->mViewData['cards'] = (array)$output;

        $this->render('cards', 'with_breadcrumb');
	}

    function showImage($value, $row) {
        $query = $this->db->query("
                                SELECT multiverseid, amount 
                                FROM cards c
                                LEFT JOIN card_loans cl
                                ON c.id = cl.card_id
                                WHERE cl.id = {$row->id}
                                ");

        foreach ($query->result() as $row)
        {
            return "<div class='mtg-img' style='cursor:pointer;' href='http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={$row->multiverseid}&type=card'><img style='width:50px;' src='http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid={$row->multiverseid}&type=card'> x {$row->amount}";
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

    function showSearch($value, $row) {


        return "<input type='text' id='field-search' class='form-control'> ( Use this to filter the cards )";
    }

    public function returnCards($id)
    {
        $now = date("Y-m-d H:i:s");
        $res = $this->db->query("UPDATE card_loans SET status = !status, return_date = '{$now}' WHERE id = {$id}");
        redirect(site_url(strtolower('cards')));
    }

    /**
     * This page renders the cards loaned from other users
     */
    public function loaned()
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

    public function getcards()
    {
        $cardname = $_POST['search'];

        $res = $this->db->query("SELECT * FROM cards WHERE card_set LIKE('%{$cardname}%')");

        $cards = [];

        foreach ($res->result() as $row)
        {
            $card['id'] = $row->id;
            $card['name'] = $row->card_set;
            $cards[] = $card;
        }

        print json_encode($cards);
        exit();


    }

}
