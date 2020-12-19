<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    private $id;

    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');
        if(!$is_login)
        {
            redirect();
            return;
        }
    }

    public function index($input = null, $input_name = null)
    {
        //Override table dari model
        $this->checkout->table = 'cart';

        $data['title']      = 'Checkout';
        $data['cart']       = $this->checkout->select([
            'cart.id', 'cart.qty', 'cart.subtotal', 
            'product.title AS product_title', 'product.image', 'product.price'
        ])
        ->join('product')
        ->where('cart.id_user', $this->id)
        ->get();

        if(!$data['cart'])
        {
            $this->session->set_flashdata('warning', 'Keranjang belanja masih kosong');
            redirect(base_url());
        } 

        //Override table dari model
        $this->checkout->table = 'user';
        $data['profile'] = $this->checkout->where('id', $this->id)->first();

        $data['input_name'] = $data['profile'];
        $data['input'] = $input ? $input : $input_name ? $input_name : (object) $this->checkout->getDefaultValues();

        $data['page']       = 'pages/checkout/index';

        return $this->view($data);
    }

    public function create($id = null)
    {
        if(!$_POST)
        {
            redirect(base_url());
        } else{
            $input = (object) $this->input->post(null, true);
            $input_name = (object) $this->input->post(null, true);
        }

        if (!$this->checkout->validate()) {
            return $this->index($input, $input_name);
        }

        $total = $this->db->select_sum('subtotal')
                    ->where('id_user', $this->id)
                    ->get('cart')
                    ->row()
                    ->subtotal;

        $data = [
            'id_category'   => $this->id,
            'date'      => date('Y-m-d'),
            'invoice'   => $this->id.date('YmdHis'),
            'total'     => $total,
            'name'      => $input_name->name,
            'address'   => $input->address,
            'phone'     => $input->phone,
            'status'    => 'waiting'
        ];

        if ($order = $this->checkout->create($data)) {
            $cart = $this->db->where('id_user', $this->id)
                        ->get('cart')->result_array();

            foreach($cart as $row)
            {
                $row['id_orders'] = $order;
                unset($row['id'], $row['id_user']);
                $this->db->insert('orders_detail', $row);
            }

            $this->db->delete('cart', ['id_user' => $this->id]);

            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            
            $data['title']      = 'Checkout Success';
            $data['content']    = (object) $data;
            $data['page']       = 'pages/checkout/success';
            
            $this->view($data);
        } else {
            $this->session->set_flashdata('error', 'Data gagal disimpan');
            return $this->index($input, $input_name);
        }
    }

}

/* End of file Checkout.php */

?>