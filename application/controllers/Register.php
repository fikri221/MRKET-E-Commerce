<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller 
{

    // untuk mengecek terlebih dahulu user sudah login / belum
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $is_login = $this->session->userdata('is_login');

        // cek apakah user sudah login
        if($is_login)
        {
            redirect(base_url());
            return;
        }
    }
    
    // jika blm login, maka akses kehalaman utama
    public function index()
    {
        if(!$_POST)
        {
            $input = (object) $this->register->getDefaultValues();
        } else{
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->register->validate()) 
        {
            $data['title']  = 'Register';
            $data['input']  = $input;
            $data['page']   = 'pages/auth/register';
            $this->view($data);
            return; // ketika sudah memuat view maka proses berhenti
        }

        if($this->register->run($input))
        {
            $this->session->set_flashdata('success', 'Registrasi berhasil!');     
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal!');
            redirect(base_url('/register'));
        }
    }

}

/* End of file Controllername.php */


?>