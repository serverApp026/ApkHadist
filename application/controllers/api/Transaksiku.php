<?php
// header("HTTP/1.1 200 OK");
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE,PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

require APPPATH . 'libraries/REST_Controller.php';

class Transaksiku extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('transaksi_model');
    }

    //Menampilkan data transaksi
    function index_get() {
        
              $this->db->select('transaksi.*,
        produk.nama_produk, produk.gambar');
              $this->db->from('transaksi');
              $this->db->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
        //END JOIN 
              $this->db->where('status_bayar', 'Belum Bayar');
              $transaksi  = $this->db->get()->result();
       
        
        $this->response(["transaksi" => $transaksi], 200); //untuk membuat data menjadi array produk
    }

    function index_post() {
        $response       = new stdClass();
        
        $np = $this->post('np');
        $ip = $this->post('ip');
        $jml = $this->post('jml');
        $hrg = $this->post('hrg');
        $st = $this->post('st');
        $km = $this->post('km');
        $kT = $this->post('kT');

  // here i would like use foreach:
       
        $data = array('nama_pelanggan'                  => $np,
                      'id_produk'                       => $ip,
                      'kodeTrans'                       => $kT,
                      'harga'                           => $hrg,
                      'jumlah'                          => $jml,
                      'total_harga'                     => $st,
                      'kode_meja'                       => $km,
                      'Status_bayar'		        => 'Belum Bayar',
		      'status_pesanan'		        => 'Belum Proses',
                      'tanggal_transaksi'               => date('Y-m-d H:i:s')
                        );
        
        $insert = $this->db->insert('transaksi', $data);
        if ($insert) {
                $response->success = 1;
                $response->message = "Transaksi Berhasil!!!!";
                die(json_encode($response));
        } else {
                $response->success = 0;
                $response->message = "Transaksi Gagal!!!";
                die(json_encode($response));
        }
        
    
        
     }

//     function index_delete() {
//         $response       = new stdClass();
//         $id_transaksi   = $this->delete('id');

//         if ($id_transaksi === null){
//                 $response->success = 0;
//                 $response->message = "Gagal Di Hapus";
//                 die(json_encode($response));
                
        
//         }else{
                
//                 if ($this->transaksi_model->deleteT($id_transaksi) > 0) {
//                         $response->success = 1;
//                         $response->message = "Data Berhasil di Hapus";
//                         die(json_encode($response));
//                 } else {
//                         $response->success = 0;
//                         $response->message = "Gagal Di Hapus Id tidak ada";
//                         die(json_encode($response));
//                 }
//         }
//      }


}