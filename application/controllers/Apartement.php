<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apartement extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		} else if ($level != 1) {
			redirect(base_url());
		}
	}
	public function index()
	{
		$data['list'] = $this->m_general->gDataJ('tiket', 'destinasi', 'id_destinasi')->result();
		$this->load->view('src/header', $data);
		$this->load->view('apartement/index', $data);
		$this->load->view('src/footer');
	}
	public function add()
	{
		$data['title'] = "Tambah Destinasi";
		if (!empty($this->input->post())) {
			$insert = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if ($foto !== "") {
				$path = 'assets/images/apartement/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '0';
				$config['overwrite'] = false;
				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$upload_data = $this->upload->data();
				$insert['foto'] = $upload_data['file_name'];
			} else {
				$insert['foto'] = 'default.png';
			}
			$in = $this->m_general->iData('tiket', $insert);
			if ($in) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Destinasi berhasil ditambahkan</div>');
				redirect('apartement');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['destinasi'] = $this->m_general->gDataA('destinasi')->result();
		$this->load->view('src/header', $data);
		$this->load->view('apartement/add', $data);
		$this->load->view('src/footer');
	}
	public function edit($id_tiket)
	{
		$data['title'] = "Edit Destinasi";
		if (!empty($this->input->post())) {
			$update = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if (!empty($foto)) {
				if ($foto !== "") {
					$path = 'assets/images/apartement/';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';
					$config['overwrite'] = false;
					$this->load->library('upload', $config);
					$this->upload->do_upload('foto');
					$upload_data = $this->upload->data();
					$update['foto'] = $upload_data['file_name'];
				} else {
					$update['foto'] = 'default.png';
				}
			}
			$up = $this->m_general->uData('tiket', $update, array('id_tiket' => $id_tiket));
			if ($up) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Apartemen berhasil diupdate</div>');
				redirect('apartement');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['destinasi'] = $this->m_general->gDataA('destinasi')->result();
		$data['detail'] = $this->m_general->gDataW('tiket', array('id_tiket' => $id_tiket))->row();
		$this->load->view('src/header', $data);
		$this->load->view('apartement/edit', $data);
		$this->load->view('src/footer');
	}
	public function delete($id_tiket)
	{
		$del = $this->m_general->dData('tiket', array('id_tiket' => $id_tiket));
		if ($del) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Destinasi berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
		}
		redirect('apartement');
	}
}
