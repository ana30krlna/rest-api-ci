<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data mahasiswa
    function index_get() {
        $npm = $this->get('npm');
        if ($npm == '') {
            $mahasiswa = $this->db->get('mahasiswa')->result();
        } else {
            $this->db->where('npm', $npm);
            $mahasiswa = $this->db->get('mahasiswa')->result();
        }
        $this->response($mahasiswa, 200);
    }

    //Mengirim atau menambah data mahasiswa
	function index_post() {
        $data = array(
                    'npm' => $this->post('npm'),
                    'nama' => $this->post('nama'),
                    'jurusan' => $this->post('jurusan'));
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // Memperbarui data mahasiswa
    function index_put() {
        $npm = $this->put('npm');
        $data = array(
                    'npm' => $this->put('npm'),
                    'nama' => $this->put('nama'),
                    'jurusan' => $this->put('jurusan'));
        $this->db->where('npm', $npm);
        $update = $this->db->update('mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // Menghapus salah satu data mahasiswa
    function index_delete() {
        $npm = $this->delete('npm');
        $this->db->where('npm', $npm);
        $delete = $this->db->delete('mahasiswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
}
?>