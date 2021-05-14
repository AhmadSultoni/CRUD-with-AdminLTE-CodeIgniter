<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model {
	/**
	 * @author : toni
	 * @date : 31 Juli 2015 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/

	function __construct(){
		parent::__construct();
	}
	
	// query otomatis dengan active record
	public function getAllData($tabel){
		return $this->db->get($tabel);
	}

	public function getAllDataLimited($tabel,$limit,$offset){
		return $this->db->get($tabel,$limit,$offset);
	}

	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
	
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function getKodeBarang()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(KDBRG,4)) as KDBRG from mbrg");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->KDBRG)+1;
				$kd = sprintf("%04s", $tmp);
			}
		}
		else
		{
			$kd = "0001";
		}	
		return $kd;
	}				

	function generated_no_faktur(){
		$sql 	= "";
		$sql 	= "SELECT MAX(no_invoice) AS 'no_invoice' FROM t_jual_h";
		$stmt 	= $this->db->query($sql);
		$no_fak ='';
		$tglnow = date("Ym");

		if ($stmt->num_rows()>0) {
			foreach ($stmt->result_array() as $db) {
				$no_fak = $db['no_invoice'];
			}
			$tgl=substr($no_fak,3,6);
			$noUrut = (int) substr($no_fak,11,4);
			if ($tgl == $tglnow){
				$noUrut=$noUrut+1;
			}
			else{
				$noUrut="1";
			}
		}else{
			$noUrut="1";
		}		
		
		$char 	= "INV".$tglnow."-";
		$newID 	= $char . sprintf("%04s", $noUrut); // FAK1907-0001
		return $newID;
	}	

	public function getCurrentDate($key=null){
		$sql 	= "SELECT YEAR(NOW()) AS TAHUN,
				   MONTH(NOW()) AS BULAN,DAY(NOW()) AS TGL";
		$stmt 	= $this->db->query($sql);
		foreach($stmt->result_array() as $row){
			$thn = $row['TAHUN'];
			$bln_ = $row['BULAN'];
			switch ($bln_) {
				case '1':
					$bln = 'Januari';
					break;
				case '2':
					$bln = 'Februari';
					break;
				case '3':
					$bln = 'Maret';
					break;
				case '4':
					$bln = 'April';
					break;
				case '5':
					$bln = 'Mei';
					break;
				case '6':
					$bln = 'Juni';
					break;
				case '7':
					$bln = 'Juli';
					break;
				case '8':
					$bln = 'Agustus';
					break;
				case '9':
					$bln = 'September';
					break;
				case '10':
					$bln = 'Oktober';
					break;
				case '11':
					$bln = 'November';
					break;
				case '12':
					$bln = 'Desember';
					break;
				default:
					# code...
					break;
			}
			$tgl = $row['TGL'];
		}
		switch ($key) {
			case 'THN':
				$hasil = $thn;		
				break;
			case 'BLN':
				$hasil = $bln;		
				break;
			case 'TGL':
				$hasil = $tgl;		
				break;
			default:
				$hasil = $tgl.' '.$bln.' '.$thn;
				break;
		}

		return $hasil;
	}	
	

	public function getBarang(){
		$sql 	= "SELECT *
				   FROM mbrg
				   ORDER BY KDBRG";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['KDBRG']] = $data['NMBRG'];
		}
		return $arr;
	}	
	
	
}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */