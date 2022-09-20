<?php
header('Access-Control-Allow-Origin: origin-list');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

require APPPATH . 'libraries/REST_Controller.php';

class Daftar extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

  
    //daftar
    function index_post() {
        $response       = new stdClass();

        $nama           = $this->post('nama');
        $email          = $this->post('email');
        $password       = sha1($this->post('password'));
        $image         = $this->post('image');
        $telepon        = $this->post('telepon');
        $akses_level        = $this->post('akses_level');
        
        $data = array('nama'             => $nama,
                      'email'            => $email,
                      'password'         => $password,
                      'image'            => $image,
                      'akses_level'      => $akses_level,
                      'telepon'          => $telepon
                //       'tanggal_daftar'   => date('Y-m-d H:i:s')
                        );
        
        $insert = $this->db->insert('users', $data);
        if ($insert) {
                $response->success = 1;
                $response->message = "Registrasi Berhasil. Silahkan Login!!!!";
                die(json_encode($response));
        } else {
                $response->success = 0;
                $response->message = "Registrasi Gagal. Silahkan Coba Lagi!!!";
                die(json_encode($response));
        }
       
        
        }
       
       
    
}
/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */