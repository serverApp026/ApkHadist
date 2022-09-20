<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class Deletet extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
  
    //Menampilkan data kontak
    function index_get() {
        $response = new stdClass();
        $id_transaksi =  $this->get('id');
        $this->db->delete('transaksi' ,['id_transaksi'=> $id_transaksi, 'status_pesanan'=>'Belum Proses']);
        $ida = $this->db->affected_rows();
        
        if ($id_transaksi === null){
            $response->success = 0;
            $response->message = "Data Gagal di Hapus";
            die(json_encode($response));
            
    
        }else{
            
            if ($ida > 0) {
                    $response->success = 1;
                    $response->message = "Data Berhasil di Hapus";
                    die(json_encode($response));
            } else {
                    $response->success = 0;
                    $response->message = "Data Gagal di Hapus. Karena Pesanan Anda Sudah diproses";
                    die(json_encode($response));
            }
        }
    }
       
       
    
}
/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */