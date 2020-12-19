<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder_model extends MY_Model {

    public $table = 'orders';
    protected $perPage = 5;

    public function getDefaultValues()
    {
        return [
            'id_orders'         => '',
            'account_name'      => '',
            'account_number'    => '',
            'nominal'           => '',
            'note'              => '',
            'image'             => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'account_name',
                'label' => 'Nama Pemilik Rekening',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'account_number',
                'label' => 'Nomor Rekening',
                'rules' => 'trim|required|max_length[50]',
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal Pembayaran',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'note',
                'label' => 'Catatan',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'image',
                'label' => 'Bukti Pembayaran',
                'rules' => 'callback_image_required',
            ]
        ];
        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/confirm',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|jpeg|JPG|png|PNG|gif',
            'max_size'          => 1024,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $this->load->library('upload', $config);

        if($this->upload->do_upload($fieldName))
        {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

}

/* End of file Myorder_model.php */

?>