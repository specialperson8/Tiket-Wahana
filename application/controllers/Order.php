<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function apartements()
	{
		if (isset($_GET['id_destinasi'])) {
			$data['list'] = $this->m_general->gDataJW('tiket', 'destinasi', 'id_destinasi', array('tiket.id_destinasi' => $_GET['id_destinasi']))->result();
		} else {

			$data['list'] = $this->m_general->gDataJ('tiket', 'destinasi', 'id_destinasi')->result();
		}
		$data['destinasi'] = $this->m_general->gDataA('destinasi')->result();
		$this->load->view('src/header', $data);
		$this->load->view('apartements', $data);
		$this->load->view('src/footer');
	}
	public function make($id_tiket)
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		}
		$data['detail'] = $this->m_general->gDataJW('tiket', 'destinasi', 'id_destinasi', array('id_tiket' => $id_tiket))->row();
		$this->load->view('src/header', $data);
		$this->load->view('make', $data);
		$this->load->view('src/footer');
	}
	function processOrder($id_tiket)
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		}
		if (!empty($this->input->post())) {
			$insert = $this->input->post();
			$insert['id_user'] = $this->session->userdata('id_user');
			$insert['id_tiket'] = $id_tiket;
			$paket = $this->input->post('paket');
			$jumlah = $this->input->post('jumlah_paket');
			$detail = $this->m_general->gDataJW('tiket', 'destinasi', 'id_destinasi', array('id_tiket' => $id_tiket))->row();
			if ($paket == 'orang') {

				$harga = $detail->harga;
			} elseif ($paket == 'orang') {

				$harga = $detail->harga;
			}


			$insert['total_bayar'] = $jumlah * $harga;
			//$insert['tgl_pesan'] = date('Y-m-d');
			$in = $this->m_general->iData('transaksi', $insert);
			if ($in) {
				$kode_booking = "BK-" . str_pad($in, 4, "0", STR_PAD_LEFT);
				$up = $this->m_general->uData('transaksi', array('kode_booking' => $kode_booking), array('id_transaksi' => $in));
				redirect('order/payment/' . $in);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
				redirect('order/make/' . $id_tiket);
			}
		}
	}
	public function payment($id_transaksi)
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		}
		$data['detail'] = $this->m_general->gDataW('transaksi', array('id_transaksi' => $id_transaksi))->row();
		$this->load->view('src/header', $data);
		$this->load->view('payment', $data);
		$this->load->view('src/footer');
	}
	public function my()
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		}
		$id_user = $this->session->userdata('id_user');
		$data['list'] = $this->m_general->gDataJW('transaksi', 'tiket', 'id_tiket', array('id_user' => $id_user), 'id_transaksi')->result();
		$this->load->view('src/header', $data);
		$this->load->view('myorder', $data);
		$this->load->view('src/footer');
	}
	public function detail($id_transaksi)
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		}
		if (isset($_FILES['bukti_transfer']['name'])) {
			$bukti_transfer = $_FILES['bukti_transfer']['name'];
			if (!empty($bukti_transfer)) {
				if ($bukti_transfer !== "") {
					$path = 'assets/images/bukti_transfer/';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';
					$config['overwrite'] = false;
					$this->load->library('upload', $config);
					$this->upload->do_upload('bukti_transfer');
					$upload_data = $this->upload->data();
					$update['bukti_transfer'] = $upload_data['file_name'];
					$update['status_pembayaran'] = 'proses_verifikasi';
					$up = $this->m_general->uData('transaksi', $update, array('id_transaksi' => $id_transaksi));
				}
			}
		}
		$data['detail'] = $this->m_general->gPesanan($id_transaksi)->row();
		if ($data['detail']->paket == 'orang') {
			$data['paket'] = 'orang';
		} elseif ($data['detail']->paket == 'orang') {
			$data['paket'] = 'orang';
		}
		$data['checkout'] = date('Y-m-d', strtotime("+" . $data['detail']->orang . " day", strtotime($data['detail']->tgl_booking)));
		$this->load->view('src/header', $data);
		$this->load->view('detail_order', $data);
		$this->load->view('src/footer');
	}
	public function verification()
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		} else if ($level != 1) {
			redirect(base_url());
		}
		$data['list'] = $this->m_general->gListPesanan('id_transaksi')->result();
		$this->load->view('src/header', $data);
		$this->load->view('order_verification', $data);
		$this->load->view('src/footer');
	}
	public function verification_detail($id_transaksi, $status = '')
	{
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!$user && !$level) {
			redirect('account/login');
		} else if ($level != 1) {
			redirect(base_url());
		}
		if ($status !== '') {
			if ($status == 'accept') {
				$update['status_pembayaran'] = 'sudah_dibayar';
				$update['nomor_pesanan'] = $this->input->post('nomor_pesanan');
			} else {
				$update['status_pembayaran'] = 'ditolak';
			}
			$up = $this->m_general->uData('transaksi', $update, array('id_transaksi' => $id_transaksi));
			if ($up) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran berhasil diverifikasi</div>');
				redirect('order/verification');
			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['detail'] = $this->m_general->gPesanan($id_transaksi)->row();
		if ($data['detail']->paket == 'orang') {
			$data['paket'] = 'orang';
		} elseif ($data['detail']->paket == 'orang') {
		}
		$data['checkout'] = date('Y-m-d', strtotime("+" . $data['detail']->orang . " day", strtotime($data['detail']->tgl_booking)));
		$this->load->view('src/header', $data);
		$this->load->view('verification_detail', $data);
		$this->load->view('src/footer');
	}
}
