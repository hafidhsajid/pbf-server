<?php
header('Access-Control-Allow-Origin: *');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('user')->result();
        }
        $this->response($kontak, 200);
    }
    function index_post() {
        $data = array(
                    'user'           => $this->post('user'),
                    'password'          => $this->post('password'),
                    'level'    => $this->post('level'));
        $insert = $this->db->insert('user', $data);
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
            'user'           => $this->put('user'),
            'password'          => $this->put('password'),
            'level'    => $this->put('level'));
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	


    //Masukan function selanjutnya disini
}
?>