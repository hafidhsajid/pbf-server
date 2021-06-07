<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transaksi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('transaksi')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('transaksi')->result();
        }
        $this->response($kontak, 200);
    }
    function index_post() {
        $data = array(
                    'id_customer'           => $this->post('id_customer'),
                    'id_layanan'          => $this->post('id_layanan'),
                    'status'    => $this->post('status'));
        $insert = $this->db->insert('transaksi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    	//Memperbarui data kontak yang telah ada
	function index_put() {
        $id = $this->put('id');
        $data = array(
            'id'           => $this->put('id'),
            'id_customer'           => $this->put('id_customer'),
            'id_layanan'          => $this->put('id_layanan'),
            'status'    => $this->put('status'));
        $this->db->where('id', $id);
        $update = $this->db->update('transaksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('transaksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	


    //Masukan function selanjutnya disini
}
?>