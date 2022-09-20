<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class Masuk extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
  
    //Menampilkan data kontak
    function index_get() {
       
        $response       = new stdClass();
        $kode_meja = $this->get('kode_meja');
        // $nama_pelanggan = "8";

        
        $this->db->select('*');
        $this->db->from('meja');
        $this->db->where('kode_meja', $kode_meja);
        $masuk  = $this->db->get()->row();

        if ($masuk){
                $response->success = 1;
                $response->masuk = $masuk;
                $response->message = "Selamat Datang di Restoran Kami.";
                die(json_encode($response));
        }
        else{
                $response->success = 0;
                $response->message = "Nomor Meja Salah";
                die(json_encode($response));
        }

    }
       
       
    
}
/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */