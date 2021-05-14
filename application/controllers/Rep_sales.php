<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_sales extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		$cek = $this->session->userdata('login_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');					

			$d['id'] 	    = $this->session->userdata('id_user');
			$d['nama'] 		= $this->session->userdata('nama_user');
			$d['jabatan']	= $this->session->userdata('level_user');

			$this->template->display('report/sales/home',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/sales');
				</script>
			<?
		}
	}

	function load_data(){
		$tgl1 = $this->input->post("tgl1");
		$tgl2 = $this->input->post("tgl2");
		$custom = $this->input->post("custom");
        
		$sql = "";
		$sql .= "SELECT * FROM vw_sales A0
				 WHERE Nofak IS NOT NULL";
		if ($tgl1!='' && $tgl2!='') {
			$sql .= " AND (Tgfak between '$tgl1' AND '$tgl2')";
		}		
		if ($custom!='') {
			$sql .= " AND NMBRG LIKE '%$custom%'";
		}
		$sql .=" ORDER BY A0.Nofak DESC";

		// var_dump($sql);
		// exit();

		$d['data'] = $this->app_model->manualQuery($sql);
		$d['nik']  = $this->session->userdata('id_user');
		$this->load->view('report/sales/load_data',$d);
	}	
}