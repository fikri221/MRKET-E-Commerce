<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
    }

    public function sortBy($sort, $page = null)
    {
        $data['title']  = 'Belanja';
        $data['content'] = $this->shop->select(
            ['product.id', 'product.title AS product_title', 'product.image', 
            'product.description', 'product.price', 'product.is_available', 
            'category.slug', 'category.title AS category_title'],
        )
        ->join('category')
        ->where('product.is_available', 1)
        ->orderBy('product.price', $sort)
        ->paginate($page)
        ->get();
        $data['total_rows']  = $this->shop->where('product.is_available', 1)->count();
        $data['pagination']  = $this->shop->makePagination(
            base_url("shop/sortBy/$sort"), 4, $data['total_rows']
        );
        $data['page']   = 'pages/home/index';

        $this->view($data);
    }

    public function category($category, $page = null)
    {
        $data['title']  = 'Belanja';
        $data['content'] = $this->shop->select(
            ['product.id', 'product.title AS product_title', 'product.image', 
            'product.description', 'product.price', 'product.is_available', 
            'category.slug', 'category.title AS category_title'],
        )
        ->join('category')
        ->where('product.is_available', 1)
        ->where('category.slug', $category)
        ->paginate($page)
        ->get();
        $data['total_rows']  = $this->shop->where('product.is_available', 1)
                                ->where('category.slug', $category)->join('category')->count();
        $data['pagination']  = $this->shop->makePagination(
            base_url("shop/category/$category"), 4, $data['total_rows']
        );
        $data['category'] = ucwords(str_replace('-', ' ', $category));
        $data['page']   = 'pages/home/index';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        }

        $keyword = $this->session->userdata('keyword');
        $data['title']      = 'Pencarian: Produk';
        $data['content']	= $this->shop->select(
            ['product.id', 'product.title AS product_title', 'product.image', 
            'product.description', 'product.price', 'product.is_available', 
            'category.slug', 'category.title AS category_title'],
        )
        ->join('category')
        ->like('product.title', $keyword)
        ->orLike('product.description', $keyword)
        ->paginate($page)
        ->get(); // utk mendapatkan banyak data dari hasil query
        $data['total_rows'] = $this->shop->like('product.title', $keyword)->orLike('description', $keyword)->count(); // hitung semua data
        $data['pagination'] = $this->shop->makePagination(
            base_url('shop/search'), 3, $data['total_rows']
        );
        $data['page']       = 'pages/home/index';

        $this->view($data);
    }

}

/* End of file Shop.php */
