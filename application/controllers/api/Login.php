<?php

use SebastianBergmann\Environment\Console;
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE,PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

require APPPATH . 'libraries/REST_Controller.php';

class Login extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
  
    //Menampilkan data kontak
//     function index_get() {
//         $response = new stdClass();
//         $email = $this->get('email');
//         $password =sha1($this->get('password'));
       
//         $user  = $this->db->query("SELECT * FROM users WHERE email='$email' and password='$password'");
//         $hasil = $user->result_array();
        
//         if ($user->num_rows() >= 0){
//                 $response->success = 1;
//                 $response->message = "Selamat datang ".$hasil[0]['nama'];
//                 $response->nama = $hasil[0]['nama'];
//                 $response->email = $hasil[0]['email'];
//                 $response->telepon = $hasil[0]['telepon'];
//                 die(json_encode($response));
//         }
//         else{
//                 $response->success = 0;
//                 $response->message = "Email atau password salah";
//                 die(json_encode($response));
//         }
        
//         }

//Menampilkan data kontak
        function index_get() {
            $response       = new stdClass();
        //     $email = 'member1@gmail.com';
        //      $password = '10061997';
        //      $akses_level = 'Member';
             $email = $this->get('email');
             $password = $this->get('password');
             $akses_level = $this->get('akses_level');
             
             $this->db->select('*');
             $this->db->from('users');
             $this->db->where(array('email' => $email,
                                     'akses_level' => $akses_level,
                                     'password' => sha1($password)));
             $masuk  = $this->db->get()->row();
     
             if ($masuk){
                     $response->success = 1;
                     $response->masuk = $masuk;
                     $response->message = "Selamat Datang di APlikasi kami.";
                     die(json_encode($response));
             }
             else{
                     $response->success = 0;
                     $response->message = "email atau password salah";
                     die(json_encode($response));
             }
    }
       
   //daftar
   function index_post() {
    $response       = new stdClass();

    $nama           = $this->post('nama');
    $email          = $this->post('email');
    $password       = sha1($this->post('password'));
    $image         = 'Default.jpg';
    $telepon        = $this->post('telepon');
    
    $data = array('nama'             => $nama,
                  'email'            => $email,
                  'password'         => $password,
                  'image'            => $image,
                  'akses_level'      => 'Member',
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