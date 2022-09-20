<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class jkajian extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
              $jkajian  = $this->db->get('jkajian')->result();
        } else {

            $this->db->where('id', $id);
            $jkajian = $this->db->get('jkajian')->result();
           
        }

        //$this->response($produk, 200);
        $this->response(["jkajian" => $jkajian], 200); //untuk membuat data menjadi array produk
    }

    

}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */