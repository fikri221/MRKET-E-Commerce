<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    private $id;

    function __construct()
    {
        parent::__construct();
    }

    public function index($page = null)
    {
        $data['title']  = 'Homepage';
        $data['content'] = $this->home->select(
            ['product.id', 'product.title AS product_title', 'product.image', 
            'product.description', 'product.price', 'product.is_available', 
            'category.slug', 'category.title AS category_title'],
        )
        ->join('category')
        ->where('product.is_available', 1)
        ->paginate($page)
        ->get();
        $data['total_rows']  = $this->home->where('product.is_available', 1)->count();
        $data['pagination']  = $this->home->makePagination(
            base_url('home'), 2, $data['total_rows']
        );
        $data['page']   = 'pages/home/index';

        $this->view($data);
    }

    public function detail($id)
    {
        $data['order'] = $this->home->where('id', $id)->first();
        if(!$data['order'])
        {
            $this->session->set_flashdata('warning', 'Detail produk tidak ada');
            redirect(base_url('home'));
        }
        $this->home->table = 'rating';
        $data['rate'] = $this->home->select(
            ['rating.id_rating', 'rating.id_product', 'rating.ratings'],
        )
        ->join('product')
        ->where('rating.id_product', $data['order']->id)
        ->get();

        // total_rows digunakan untuk menghitung banyak baris pada suatu row
        $data['total_rows']  = $this->home->select(['rating.ratings'])
                                    ->where('rating.id_product', $data['order']->id)->count();

        $data['page']   = 'pages/home/detail';

        $this->view($data);
    }
}

?>