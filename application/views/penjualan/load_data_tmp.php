<script type="text/javascript">

	$('.hapus_data').click(hapus);

	function hapus(){
        var baris 	  = $(this).closest('.baris');  
        var kobar    = $('.col_kobar',baris).html();

        $('#form-hapus-tmp input[id="txt_kode_hapus"]').val(kobar);

        $('.modal-title').html("Konfirmasi");  
        $('#form-hapus-tmp').modal({
          	show: true,
          	keyboard:false,
          	backdrop:false
        })       
    }
    
    $('#btnHapusTmp').click(function(){
		doHapus();
    })

	function doHapus(){
		var kobar 	 = $('#txt_kode_hapus').val();
        $.ajax({
          url   : "<?=base_url();?>rekap/hapus_tmp",
          type  : "POST",
          data  : {"kobar":kobar},
          success : function(data){
            // swal('Informasi','Data berhasil dihapus','success');
            $('#isiDataTmp').html(data);
            $("#form-hapus-tmp").modal("hide");
          }
        })
    }

</script>
<table id="tabel_data" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="1%">No</th>
            <th width="5px">Kode Barang</th>
			<th width="20%">Nama Barang</th>
			<th width="5px">Kemasan</th>
			<th width="1%">Qty</th>
            <th width="5px">Harga</th>
			<th width="2px">Diskon %</th>
			<th width="5px">Diskon/Rp</th>
            <th width="5px">Sub Total</th>
			<th width="1%">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		$tot_grand = 0;
		if ($data->num_rows()>0) {
			foreach ($data->result_array() as $db) {
				$i++;				
				?>
				<tr class="baris">
					<td class="col_no" align="center"><?=$i;?></td>
                    <td class="col_kobar"><?=$db['Kdbrg'];?></td>
					<td class="col_nama_biaya"><?=$db['Nmbrg'];?></td>
                    <td align="right" class="col_jml"><?=$db['Kemas'];?></td>
					<td align="center" class="col_jml"><?=$db['Qty'];?></td>
					<td align="center" class="col_jml"><?=$db['Harga'];?></td>
					<td align="center" class="col_jml"><?=$db['Discn'];?></td>
					<td align="center" class="col_jml"><?=$db['HrgDisc'];?></td>
                    <td align="right" class="col_subtotal" style="display:none;"><?=$db['Total'];?></td>
					<td align="right-" class="col_subtotal_view">Rp. <?=number_format($db['Total'],0,'.','.');?></td>
					<td align="center">
						<a href="#" class="hapus_data">
							<i class="fa fa-trash-o"></i>
						</a>
					</td>
					<?
					$tot_grand=$tot_grand+$db['Total'];
					?>
				</tr>				
				<?php
			}
				?>
				<tr>
					<td colspan="8" style="font-weight:bold;font-size:14pt;">Grand Total :</td>
					<td align="right" colspan="2" style="display:none;" id="txtGrandTotal"><?=$tot_grand;?></td>
					<td align="right" colspan="2" style="font-weight:bold;font-size:14pt;">Rp. <?=number_format($tot_grand,0,',','.');?></td>
				</tr>
				<?php
		}else{
            ?>
            <tr>
              <td colspan="10"><font color="red">no data found</font></td>
            </tr>
            <?php
        }
	?>
	</tbody>
</table>