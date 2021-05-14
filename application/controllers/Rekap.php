<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->helper('terbilang_helper');
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

			$this->template->display('penjualan/home',$d);
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
        $cek     = $this->session->userdata('login_sukses');
        $ses_id = $this->session->userdata('id_user');

		if(!empty($cek)){
			$param = $this->input->post("cari");

			$sql = "";
			$sql .= "SELECT a0.no_invoice,a0.tanggal,a0.grand_total FROM t_jual_h a0                     
                     ORDER BY a0.no_invoice";			

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('penjualan/load_data',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/sales');
				</script>
			<?
		}
    }
    
    function load_data_tmp(){
        $cek     = $this->session->userdata('login_sukses');
        $ses_id  = $this->session->userdata('id_user');

		if(!empty($cek)){
			$sql = "";
			$sql .= "SELECT * FROM ttmp";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('penjualan/load_data_tmp',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/sales');
				</script>
			<?
		}
	}

	function load_data_barang(){
		$cari 	= $this->input->post("cari");

		$sql 	= "";
		$sql	= "SELECT * FROM vw_barang
				   WHERE KDBRG IS NOT NULL";
		if ($cari!='') {
			$sql .=" AND NMBRG LIKE '%$cari%'";
		}

		$d['data'] = $this->app_model->manualQuery($sql);
		$this->load->view('penjualan/load_data_barang',$d);
	}			

	function simpan(){
		if(!isset($_POST)){
			show_404();
		}

		$no_fak 	 = $this->input->post('no_fak');
		$tgl 		 = $this->input->post('tgl');
		$grand_total = $this->input->post('grand_total');                	

		$sql  = "";
		$sql .= "SELECT * FROM hdfr WHERE Nofak='$no_fak'";
		$stmt = $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()<=0) {
			// $terbilang = terbilang_rupiah($grand_total);
			$sql = "";
			$sql .= "INSERT INTO hdfr(Nofak,Tgfak,Ttlfak) 
					 VALUES('$no_fak','$tgl','$grand_total')";
			$exec = $this->app_model->manualQuery($sql);

			$sql2 = "";
			$sql2 = "SELECT * FROM ttmp";
			$q   = $this->app_model->manualQuery($sql2);
            $_kobar   ='';
            $_jml     ='';
			// $_subtotal='';
			$_harga   ='';
			$_diskon  ='';
			if($q->num_rows()>0){				 
				foreach ($q->result_array() as $db) {
					$_kobar     ='';
					$_harga     ='';
					$_jml       ='';
					$_diskon    ='';
					// $_subtotal  ='';
					$_kobar     = $db['Kdbrg'];
					$_harga		= $db['Harga'];
					$_jml       = $db['Qty'];
					$_diskon    = $db['HrgDisc'];
					// $_subtotal  = $db['sub_total'];

					$sql3 = "";
					$sql3 .= "INSERT INTO dtfr(Nofak,Kdbrg,qty,harga,discn) 
							  VALUES('$no_fak','$_kobar','$_jml','$_harga','$_diskon')";

					$ex_q = $this->app_model->manualQuery($sql3);
				}
			}			

			if ($exec) {				
				$this->empty_tmp();
				echo "simpan_ok";
			}else{
				echo "simpan_no";
			}			
		}else{
			echo "simpan_ilegal";
		}					
	}	

	function empty_tmp(){
		$sql 	= "";
		$sql   .= "DELETE FROM ttmp";

		$this->app_model->manualQuery($sql);
	}
	
	function simpan_tmp(){
		if(!isset($_POST)){
			show_404();
		}
		
		$kobar 	    = $this->input->post('kobar');
		$nabar 	    = $this->input->post('nabar');
		$kemas 	    = $this->input->post('kemas');
		$harga 	    = $this->input->post('harga');
		$diskon 	= $this->input->post('diskon');
		$diskon_rp 	= $this->input->post('diskon_rp');
		$jml        = $this->input->post('jumlah');
		$sub_total 	= $this->input->post('sub_total');

		$sql  = "";
		$sql .= "SELECT * FROM ttmp WHERE Kdbrg='$kobar'";
		$stmt = $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()<=0) {
			$sql 	= "";
			$sql 	.= "INSERT INTO ttmp(Kdbrg,Nmbrg,Kemas,Qty,Harga,Discn,HrgDisc,Total) 
					 	VALUES('$kobar','$nabar','$kemas','$jml','$harga','$diskon','$diskon_rp','$sub_total')";

			$exec 	= $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "simpan_ok";
			}else{
				echo "simpan_no";
			}			
		}else{
			$sql = "";
			$sql .= "UPDATE ttmp SET Qty=Qty+1, Total=Total+$sub_total
					 WHERE Kdbrg='$kobar'";

			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "edit_ok";
			}else{
				echo "edit_no";
			}
		}					
	}	

	function hapus_tmp(){
		if(!isset($_POST)){
			show_404();
		}	
			
		$kobar 	= $this->input->post('kobar');

		$sql 	= "";
		$sql   .= "DELETE FROM ttmp WHERE Kdbrg='$kobar'";

		$this->app_model->manualQuery($sql);
		$this->load_data_tmp();
	}
}
