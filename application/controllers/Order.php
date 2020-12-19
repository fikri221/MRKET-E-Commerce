<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

    private $id;

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if($role != 'admin')
        {
            redirect();
            return;
        }
    }

    public function index($page = null)
    {
        $data['title']  = 'Admin: Daftar Order';
        $data['content'] = $this->order->select(
            ['orders.id_user', 'orders.date', 'orders.invoice', 
            'orders.total', 'orders.name', 'orders.status'],
        )
        ->paginate($page)
        ->get();
        $data['total_rows']  = $this->order->count();
        $data['pagination']  = $this->order->makePagination(
            base_url('order'), 2, $data['total_rows']
        );
        $data['page']   = 'pages/order/index';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('order'));
        }

        $keyword = $this->session->userdata('keyword');
        $data['title']      = 'Admin: Daftar Order';
        $data['content']	= $this->order->select(
            ['orders.id_user', 'orders.date', 'orders.invoice', 
            'orders.total', 'orders.name', 'orders.status'],
        )
        ->like('orders.invoice', $keyword)
        ->paginate($page)
        ->get(); // utk mendapatkan banyak data dari hasil query
        $data['total_rows'] = $this->order->like('orders.invoice', $keyword)->count(); // hitung semua data
        $data['pagination'] = $this->order->makePagination(
            base_url('order/search'), 3, $data['total_rows']
        );
        $data['page']       = 'pages/order/index';

        $this->view($data);
    }

    public function detail($invoice)
    {
        $data['order'] = $this->order->where('invoice', $invoice)->first();
        if(!$data['order'])
        {
            $this->session->set_flashdata('warning', 'Daftar Order masih kosong');
            redirect(base_url('order'));
        }

        $this->order->table = 'orders_detail';
        $data['order_detail'] = $this->order->select([
            'orders_detail.id_orders', 'orders_detail.id_product', 
            'orders_detail.qty', 'orders_detail.subtotal', 'product.title', 
            'product.image', 'product.price'
        ])
        ->join('product')
        ->where('orders_detail.id_orders', $data['order']->id)
        ->get();

        if($data['order']->status !== 'waiting')
        {
            $this->order->table = 'orders_confirm';
			$data['order_confirm']	= $this->order->where('id_orders', $data['order']->id)->first();
        }

        $data['page']   = 'pages/order/detail';

        $this->view($data);
    }

    public function edit($id = null)
    {
        if (!$_POST) {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
			redirect(base_url("order/detail/$id"));
		}

        if($this->order->where('id', $id)->update(['status' => $this->input->post('status')]))
        {
            $this->session->set_flashdata('success', 'Data Berhasil Diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Diperbarui!');
        }
        
        redirect(base_url("order/detail/$id"));
    }

}

/* End of file Order.php */

?>