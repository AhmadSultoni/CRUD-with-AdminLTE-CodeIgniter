<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	
	public function index()
	{	
		$id		= $this->session->userdata('id_user');
		$cek 	= $this->session->userdata('login_sukses');

		$d['judul']		= $this->config->item('lisensi_app');
		$d['perusahaan']= $this->config->item('nama_perusahaan');
		$d['footer'] 	= $this->config->item('copyright');
		$d['app_name'] 	= $this->config->item('app_name');
		$d['deskripsi'] = $this->config->item('app_fullname');

		if(!empty($cek)){			
			$d['id'] 	    = $this->session->userdata('id_user');
			$d['nama'] 		= $this->session->userdata('nama_user');
			$d['jabatan']	= $this->session->userdata('level_user');

			$this->template->display('home',$d);				
		}else{			
			$this->load->view('auth/index', $d);
		}
	}	

	function auth_user(){
		if(!isset($_POST)){
			show_404();
		}

		$username 	= $this->input->post('txtUsername');
		$pwd 		= $this->input->post('txtPwd');

		$sql 	= "";
		$sql 	= " SELECT * FROM user A
					WHERE A.username='$username' AND A.pwd='$pwd'";
		$stmt 	= $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()>0) {			
			foreach($stmt->result_array() as $row){
				$sess_data['login_sukses'] 	= true;
				$sess_data['id_user'] 		= $row['id'];
				$sess_data['nama_user'] 	= $row['username'];
				$sess_data['level_user'] 	= $row['level'];
				
				$this->session->set_userdata($sess_data);
			}			

			$d['judul']		= $this->config->item('lisensi_app');
			$d['company']	= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name']	= $this->config->item('app_name');
			$d['app_name_child'] = $this->config->item('app_name_child');			

			// redirect('app','refresh');
			header('location:'.base_url().'');

		}else{
			$this->session->set_flashdata('msg', 'Username atau Password yang anda masukkan salah');			
			header('location:'.base_url().'');
		}
	}	
	
	function develop(){
		$d['judul']		= $this->config->item('lisensi_app');
		$d['perusahaan']= $this->config->item('nama_perusahaan');
		$d['deskripsi'] = $this->config->item('app_fullname');
		$d['footer'] 	= $this->config->item('copyright');
		$d['app_name'] 	= $this->config->item('app_name');
		
		$d['id'] 	    = $this->session->userdata('id_user');	
		$d['nama'] 		= $this->session->userdata('nama_user');
		$d['jabatan']     = $this->session->userdata('level_user');
		// $d['open_tic']  = $this->app_model->getTotNewTicket();
			
		$this->template->display('develop',$d);
	}

	function logout(){
		$cek = $this->session->userdata('login_sukses');
		if(!empty($cek))
		{			
			$this->session->sess_destroy();
			header('location:'.base_url().'');
		}
		else{
			header('location:'.base_url().'');
		}
	}

}