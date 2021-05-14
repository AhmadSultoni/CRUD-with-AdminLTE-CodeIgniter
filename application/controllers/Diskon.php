<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon extends CI_Controller {
    
    function __construct(){
        parent::__construct();
    }

    public function index(){
		$cek = $this->session->userdata('login_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');
			$d['barang'] 	= $this->app_model->getBarang();

			$d['id'] 	    = $this->session->userdata('id_user');
			$d['nama'] 		= $this->session->userdata('nama_user');
			$d['jabatan']	= $this->session->userdata('level_user');

			$this->template->display('diskon/home',$d);
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
		$cek = $this->session->userdata('login_sukses');
		if(!empty($cek)){
			$param = $this->input->post("cari");

			$sql = "";
			$sql .= "SELECT A0.KDBRG,b0.NMBRG,A0.DISCN FROM mdis A0
					 LEFT JOIN mbrg b0 on b0.KDBRG=a0.KDBRG
					 WHERE A0.KDBRG IS NOT NULL";
			if ($param!='') {
				$sql .= " AND b0.NMBRG LIKE '%$param%'";
			}
			$sql .=" ORDER BY A0.KDBRG";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('diskon/load_data',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/sales');
				</script>
			<?
		}
	}

	function simpan(){
		if(!isset($_POST)){
			show_404();
		}	
		
		$kode 	= $this->input->post('kode');
		$diskon = $this->input->post('diskon');		

		$sql  = "";
		$sql .= "SELECT * FROM mdis WHERE KDBRG='$kode'";
		$stmt = $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()<=0) {
			$sql = "";
			$sql .= "INSERT INTO mdis(KDBRG,DISCN) 
					 VALUES('$kode','$diskon')";

			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "simpan_ok";
			}else{
				echo "simpan_no";
			}			
		}else{
			$sql = "";
			$sql .= "UPDATE mdis SET DISCN='$diskon'
					 WHERE KDBRG='$kode'";
			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "edit_ok";
			}else{
				echo "edit_no";
			}
			
		}					
	}

	function hapus(){
		if(!isset($_POST)){
			show_404();
		}	
			
		$kode 	= $this->input->post('kode');

		$sql 	= "";
		$sql   .= "DELETE FROM mdis WHERE KDBRG='$kode'";

		$this->app_model->manualQuery($sql);
		$this->load_data();
	}
}