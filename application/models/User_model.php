<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    public function getDefaultValues()
    {
        // hanya kolom yg akan dimunculkan saja
        return [
            'name'      => '',
            'email'     => '',
            'role'      => '',
            'is_active' => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email|callback_unique_email',
                'errors'=> [
                    'is_unique' => 'This %s already exist.'
                ]
            ],
            [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'required'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/user',
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

    public function deleteImage($fileName)
    {
        if(file_exists("./images/user/$fileName"))
        {
            unlink("./images/user/$fileName");
        }
    }

}

/* End of file ModelName.php */
?>