<script type="text/javascript">
    $('.pilih_data').click(do_pilih_data);

    function do_pilih_data(){
      	// alert('Pilih');
		var baris   = $(this).closest('.baris');
        var no      = $('.col_id',baris).html();
		var nama    = $('.col_nama',baris).html();
		var harga   = $('.col_harga',baris).html();
		var kemas   = $('.col_kemas',baris).html();
		var diskon   = $('.col_diskon',baris).html();
		var diskon_rp = 0;

		diskon_rp = (harga*diskon)/100
            	
		$('#txtNamaBarang').val(nama);
        $('#txtKodeBarang').val(no);
		$('#txtHarga').val(harga);
		$('#txtKemas').val(kemas);
		$('#txtDiskonRp').val(diskon_rp);
		$('#txtDiskon').val(diskon);
        $('#txtJumlah').focus();
      	$('#form-show-barang').modal('hide');
    }
</script>
<table id="tabel_data" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th width="1%" style="display:none-;">Kode Barang</th>	
			<th width="60%">Nama Barang</th>
			<th width="10px">Kemas</th>
            <th width="10px">Harga</th>
			<th width="5px">Diskon</th>
			<th width="1%">Pilih</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;		
		if ($data->num_rows()>0) {
			foreach ($data->result_array() as $db) {
				$i++;				
				?>
				<tr class="baris">
					<td class="col_no" align="center"><?=$i;?></td>
					<td class="col_id" style="display:none-;"><?=$db['KDBRG'];?></td>
					<td class="col_nama"><?=$db['NMBRG'];?></td>
					<td class="col_kemas"><?=$db['KEMAS'];?></td>
                    <td class="col_harga"><?=$db['HARGA'];?></td>
					<td class="col_diskon"><?=$db['DISCN'];?></td>
					<td align="center">
						<button title="Pilih" class="pilih_data btn btn-sm btn-info btn-flat"><i class="fa fa-check"></i></button>						
					</td>
				</tr>
				<?php
			}
		}
	?>
	</tbody>
</table>