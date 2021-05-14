<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    
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
            
			$d['id'] 	    = $this->session->userdata('id_user');
			$d['nama'] 		= $this->session->userdata('nama_user');
			$d['jabatan']	= $this->session->userdata('level_user');

			$this->template->display('barang/home',$d);
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
			$sql .= "SELECT * FROM mbrg A0
					 WHERE KDBRG IS NOT NULL";
			if ($param!='') {
				$sql .= " AND A0.NMBRG LIKE '%$param%'";
			}
			$sql .=" ORDER BY A0.KDBRG";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('barang/load_data',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/sales');
				</script>
			<?
		}
	}

	function getKode(){
		$kode = $this->app_model->getKodeBarang();
		echo $kode;
	}

	function simpan(){
		if(!isset($_POST)){
			show_404();
		}	
		
		$kode 	= $this->input->post('kode');
		$nama 	= $this->input->post('nama');
		$kemas 	= $this->input->post('kemas');				

		$sql  = "";
		$sql .= "SELECT * FROM mbrg WHERE KDBRG='$kode'";
		$stmt = $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()<=0) {
			$sql = "";
			$sql .= "INSERT INTO mbrg(KDBRG,NMBRG,KEMAS) 
					 VALUES('$kode','$nama','$kemas')";

			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "simpan_ok";
			}else{
				echo "simpan_no";
			}			
		}else{
			$sql = "";
			$sql .= "UPDATE mbrg SET NMBRG='$nama',KEMAS='$kemas'
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
		$sql   .= "DELETE FROM mbrg WHERE KDBRG='$kode'";

		$this->app_model->manualQuery($sql);
		$this->load_data();
	}
}