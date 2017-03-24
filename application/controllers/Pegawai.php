<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{
		$this->load->model('pegawai_model');
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama'/**/, 'Nama'/*nama harus diisi*/, /*merupakan syarat*/'trim|required');
		$this->form_validation->set_rules('nip'/**/, 'Nip'/*nama harus diisi*/, /*merupakan syarat*/'trim|required|numeric|max_length[15]');
		$this->form_validation->set_rules('tanggallahir'/**/, 'Tanggal Lahir'/*nama harus diisi*/, /*merupakan syarat*/'trim|required');
		$this->form_validation->set_rules('alamat'/**/, 'Alamat'/*nama harus diisi*/, /*merupakan syarat*/'trim|required');
		$this->load->model('pegawai_model');	
		if($this->form_validation->run()==FALSE)
		{

			$this->load->view('tambah_pegawai_view');

		}else{
			$this->pegawai_model->insertPegawai();
			$this->load->view('tambah_pegawai_sukses');
			echo '<script type="text/javascript">alert("Data Berhasil di Tambahkan!!")</script>';
				redirect(site_url(), 'refresh');

		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'Nip', 'trim|required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');


		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('pegawai_model');
		$data['pegawai']=$this->pegawai_model->getPegawai($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_pegawai_view',$data);

		}else
		{
			$this->pegawai_model->updateById($id);
			//$this->load->view('edit_pegawai_sukses');
			echo '<script type="text/javascript">alert("Data Berhasil di Update!!")</script>';
				redirect(site_url(), 'refresh');
			//redirect('pegawai');

		}
	}

	public function delete_peg()
	{
			$id = $this->uri->segment(3);
			$this->load->model('Pegawai_Model');
			$result= $this->Pegawai_Model->delete_peg($id);
			if ($result == true) 
			{
				echo '<script type="text/javascript">alert("Hapus Berhasil!!")</script>';
				redirect(site_url(), 'refresh');
			}
			else
			{
				echo '<script type="text/javascript">alert("Hapus Gagal!!")</script>';
				redirect(site_url(), 'refresh');
			}
			//redirect('pegawai');

	}
	
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>