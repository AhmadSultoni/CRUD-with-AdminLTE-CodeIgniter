<script type="text/javascript">
	$(window).on("load", function() {
		
		load_data();

		$('#btnTambah').click(function(){
			bersih();
			$('.modal-title').html("Tambah Data");	
			$('#form-input').modal({
				show: true,
				keyboard:false,
				backdrop:false
			})			
		})

		$('#btnSimpan').click(function() {
			simpan();
		})		

		function simpan(){
			var kode  = $('#cboBarang').val();
			var harga = $('#txtHarga').val();

			if (harga.length==0 || harga=='') {
				alert('Harga tidak boleh kosong !!!');
				$('#txtharga').focus();
				return false;
			}

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>harga/simpan',
				data : {"kode":kode,"harga":harga},
				cache: false,
				success : function(result){
					// alert(result);
					if (result=='simpan_ok'){
						swal('Informasi','Data berhasil disimpan','success');
					}else if (result=='simpan_no'){
						swal('Oops..','Data gagal disimpan','warning');
					}else if (result=='edit_ok') {
						swal('Informasi','Data berhasil diedit','success');
					}else if(result=='edit_no'){
						swal('Oops..','Data gagal diedit','warning');
					}
					load_data('');
					$('#form-input').modal('hide');
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				}
			})
		}

		function load_data(){
			var cari = $('#txtCari').val();
			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>harga/load_data',
				data : {'cari':cari},
				cache: false,
				beforeSend: function() {
				  	NProgress.start();
				},
				success : function(ok){
					// alert(ok);
					$('#isiData').animate({ opacity: "show" }, "slow");
					$('#isiData').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},
				complete : function(){
					NProgress.done();
				}	
			})
		}

		$('#txtCari').keyup(function(){
			var isi = $(this).val();
			if (isi!='') {
				load_data();
			}else{
				load_data();
			}
		})

		function bersih(){
			$('#cboKode').val('');
			$('#txtHarga').val('');
			$('#cboKode').focus();
		}

	})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Harga			
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-files-o"></i> Master</a></li>
			<li class="active">Data Harga</li>
		</ol>
	</section>

	<section class="content">		
		<div class="box box-stable">
			<div class="box-header with-border">
	          <h3 class="box-title"></h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
	          </div>
	        </div>
	        <div class="box-body">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<button class="btn btn-sm btn-info btn-flat" id="btnTambah"><i class="fa fa-plus"></i> Tambah Data</button>
					</div>			
					<div class="col-md-4 col-sm-12">
						<div class="form-group has-feedback">							
							<input type="text" id="txtCari" class="form-control input-sm pull-right"  placeholder="Cari Nama..."/>			          	
							<span class="fa fa-search form-control-feedback"></span>
						</div>
					</div>
				</div>
	        	<div class="table-responsive">
	        		<div id="isiData" style="margin-top:5px;"></div>
	        	</div>
	        </div> 		    
	  	</div>	 
	</section>

	<!-- Form input data -->
	<div class="modal modal-default fade" id="form-input" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label" for="cboBarang">Barang :</label>
                        <select class="form-control select2-" id="cboBarang">
                            <?php		                      			
                                foreach ($barang as $kode_barang => $nama_barang) {										
                                    echo "<option value='$kode_barang'>$nama_barang</option>";
                                }
                            ?>
                        </select>
						<input type="hidden" class="form-control" id="txtKode" size="5"/>
					</div>					
					<div class="form-group">
						<label class="control-label" for="txtHarga">Harga :</label>
						<input type="number" class="form-control" id="txtHarga" size="5"/>
					</div>
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-info btn-flat" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>	
	<!-- end form input data -->

	<!-- form hapus -->
	<div class="modal fade" id="form-hapus" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog" style="width:300px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
				        <label class="control-label">Yakin data akan dihapus...?</label>
			            <input type="hidden" class="form-control" id="txtid_hapus" size="5"/>
				    </div>				    
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-info btn-flat" id="btnHapus"><i class="fa fa-sm fa-trash-o"></i> Hapus</button>
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
	
</div>