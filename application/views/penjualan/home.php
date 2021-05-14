<script type="text/javascript">
    $(window).on("load", function() {
        // alert('Halaman Siap');
        load_data();

		$('#btnBatal').click(function(){
			window.history.back();
		})

        function load_data(){
      		// var cari = $('#txtCari').val();

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>rekap/load_data_tmp',
				// data : {'cari':cari},
				cache: false,
				beforeSend: function() {
				  	NProgress.start();
				},
				success : function(ok){					
					$('#isiDataTmp').animate({ opacity: "show" }, "slow");
					$('#isiDataTmp').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},
				complete : function(){
					NProgress.done();
				}	
			})
		}		

        $('#btnBrowseBarang').click(function(){
            load_view_barang('');
			$('.modal-title').html("Data Barang");	
			$('#form-show-barang').modal({
				show: true,
				keyboard:false,
				backdrop:false
			})            
		})

        $('#txtCariBarang').keyup(function(){
			var isi = $(this).val();
			load_view_barang(isi);                   
		})

        function load_view_barang(cari){
			var url  = "<?=base_url();?>rekap/load_data_barang";              
			
			$.ajax({
				type    : "POST",
				url     : url,
				data    : {"cari":cari},
				cache   : false,
				beforeSend: function() {
					// Display_Load();
				},
				success : function(result){
					// alert(result);
					$('#isiDataBarang').animate({ opacity: "show" }, "slow");
					$('#isiDataBarang').html(result);
					
					// Hide_Load();
				},
				error:function(event, textStatus, errorThrown) {
					// alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},        
				complete: function() {
					// Hide_Load();
				}
			})
        }

        $('#btnAdd').click(function() {
			simpan_add();
		})

        $('#txtJumlah').keyup(function(){
            hitung_sub_total();
        })

        $('#txtHarga').change(function(){
            hitung_sub_total();
        })

        function hitung_sub_total(){
            var harga  = $('#txtHarga').val();
			var diskon = $('#txtDiskonRp').val();
            var jumlah = $('#txtJumlah').val();
            var hasil = 0;

            if(harga!='' && jumlah!='' && diskon!=''){
                hasil = (harga-diskon)*jumlah;
                $('#txtSubTotal').val(hasil);
            }else{
                $('#txtSubTotal').val('0');
            }
        }

		function simpan_add(){
            var no_fak      = $('#txtNoFak').val();
			var tgl         = $('#txtTanggal').val();
            var kobar	    = $('#txtKodeBarang').val();
            var nabar    	= $('#txtNamaBarang').val();
			var kemas    	= $('#txtKemas').val();
            var harga       = $('#txtHarga').val();
			var diskon 		= $('#txtDiskon').val();
			var diskon_rp 	= $('#txtDiskonRp').val();
			var jumlah      = $('#txtJumlah').val();
            var sub_total   = $('#txtSubTotal').val();

			if (no_fak.length==0) {
				alert('No. Faktur tidak boleh kosong !!!');
				$('#txtNoFak').focus();
				return false;
            }            
			if (tgl.length==0) {
				alert('Tanggal tidak boleh kosong !!!');
				$('#txtTanggal').focus();
				return false;
            }
            if (kobar.length==0) {
				alert('Kode Barang tidak boleh kosong !!!');
				$('#txtKodeBarang').focus();
				return false;
            }
            if (jumlah.length==0) {
				alert('Jumlah tidak boleh 0 !!!');
				$('#txtJumlah').focus();
				return false;
            } 
            if (sub_total.length==0) {
				alert('Subtotal masih 0 !!!');
				// $('#txtNIP').focus();
				return false;
            }            

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>rekap/simpan_tmp',
				data : {"kobar":kobar,"nabar":nabar,"kemas":kemas,"harga":harga,"diskon":diskon,"diskon_rp":diskon_rp,"jumlah":jumlah,"sub_total":sub_total},
				cache: false,
				success : function(result){
					// alert(result);
					// if (result=='simpan_ok'){
					// 	message('Informasi','Data berhasil disimpan','success',no_reg);						
					// }else if (result=='simpan_no'){
					// 	message('Oops..','Data gagal disimpan','warning',no_reg);
					// }else if(result=='simpan_ilegal'){
					// 	message('Oops..','Data sudah ada','warning',no_reg);
					// }
                    load_data();
                    bersih();
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				}
			})
		}

        $('#btnSimpan').click(function() {
			simpan();
		})		

		function simpan(){
            var no_fak      = $('#txtNoFak').val();
			var tgl         = $('#txtTanggal').val();
            var grand_total	= $('#txtGrandTotal').html();
            
			// alert(no_fak+'-'+tgl+'-'+grand_total);                        			
            // return false;
			// if (no_reg.length==0) {
			// 	alert('No. Registrasi tidak boleh kosong !!!');
			// 	$('#txtNoReg').focus();
			// 	return false;
            // }
			if (no_fak.length==0) {
				alert('No. Faktur tidak boleh kosong !!!');
				$('#txtNoFak').focus();
				return false;
            }            
			if (tgl.length==0) {
				alert('Tanggal tidak boleh kosong !!!');
				$('#txtTanggal').focus();
				return false;
            }           
            if (grand_total.length==0) {
				alert('Transaksi masih kosong !!!');
				// $('#txtNIP').focus();
				return false;
            }            

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>rekap/simpan',
				data : {"no_fak":no_fak,"tgl":tgl,"grand_total":grand_total},
				cache: false,
				success : function(result){
					// alert(result);
					if (result=='simpan_ok'){
						message('Informasi','Data berhasil disimpan','success');						
					}else if (result=='simpan_no'){
						message('Oops..','Data gagal disimpan','warning');
					}else if(result=='simpan_ilegal'){
						message('Oops..','Data dengan No. Faktur '+'#'+no_fak+'#'+' sudah ada!','warning');
					}			
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				}
			})
		}

        function message(judul,pesan,tipe) {
		    swal({
				title: judul,
				text: pesan,
				type: tipe,
				showCancelButton: false,
				// confirmButtonColor: "#DD6B55",
				confirmButtonText: "OK",
				closeOnConfirm: false
		    },
		    function(isConfirm){
		    	// window.history.go(-1);
		    	window.location.replace('/sales/rekap');
				//window.open('<?=base_url();?>pembayaran/print/'+no_reg,'_blank','width=400,height=600');		      
		    });
		}

        function bersih() { 
            $('#txtKodeBarang').val('');
            $('#txtNamaBarang').val('');
            $('#txtHarga').val('');
			$('#txtKemas').val('');
			$('#txtDiskon').val('');
			$('#txtDiskonRp').val('');
			$('#txtJumlah').val('');
            $('#txtSubTotal').val('0');
            $('#btnAdd').focus();
        }		
		
    })			
</script>

<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Input Data Penjualan
			<!-- <small>Version 2.0</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-edit"></i> Penjualan</a></li>
			<li><a href="<?=base_url();?>penjualan"> List Penjualan</a></li>
			<li class="active">Input Data</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-sm-12">
                <div class="box box-stable">
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <h3 class="box-title"></h3>                            
                        </div>
                    </div> -->
                    <div class="box-body">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="txtNoFak">No. Faktur :</label>
								<input type="text" class="form-control input-sm" id="txtNoFak" maxlength="10"/>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="txtTanggal">Tanggal :</label>                        
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control input-sm datepicker" id="txtTanggal" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">    
            <div class="col-md-12 col-sm-12">
                <div class="box box-stable">
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <h3 class="box-title"></h3>                            
                        </div>
                    </div> -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtKodeBarang">Barang :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" id="txtNamaBarang" readonly/>
                                        <input type="hidden" class="form-control input-sm" id="txtKodeBarang" readonly/>           
                                        <div class="input-group-btn">
                                            <button type="button" title="Browse Data Barang" class="btn btn-flat btn-sm btn-primary" id="btnBrowseBarang">...</button>
                                        </div>                                        
                                    </div>
                                </div>                                
                            </div>
							<div class="col-xs-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtKemas">Kemas :</label>
                                    <input type="text" class="form-control input-sm" id="txtKemas" readonly/>
                                </div>
                            </div>                         
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtHarga">Harga :</label>
                                    <input type="text" class="form-control input-sm" id="txtHarga" readonly/>
                                </div>
                            </div>
							<div class="col-xs-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtDiskon">Diskon Rupiah :</label>
                                    <input type="text" class="form-control input-sm" id="txtDiskonRp" readonly/>
									<input type="hidden" class="form-control input-sm" id="txtDiskon" readonly/>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtJumlah">Jumlah :</label>
                                    <input type="number" class="form-control input-sm" id="txtJumlah" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="txtSubTotal">Subtotal :</label>
									<div class="input-group">
										<input type="number" class="form-control input-sm" id="txtSubTotal" value="0" readonly/>
                                        <div class="input-group-btn">
                                            <button type="button" title="Add Item Barang" class="btn btn-flat btn-sm btn-primary" id="btnAdd"><i class="fa fa-plus"></i></button>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">                                               
                                <div class="table-responsive">
                                    <div id="isiDataTmp" style="margin-top:5px;"></div>
                                </div>                                     
                            </div>
                        </div>                                               						        	
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="buton" class="btn btn-info btn-flat btn-sm" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Simpan</button>
									<!-- <a class="btn btn-success btn-flat" href="<?=base_url();?>pembayaran/print/<?=$no_reg;?>"></a> -->
                                    <button type="button" class="btn btn-warning btn-flat btn-sm" id="btnBatal"><i class="fa fa-sm fa-mail-reply"></i> Kembali</button>                            
                                </div>
                            </div>                                      
                        </div>                        
                    </div>
                </div>
            </div>            
        </div>                  			 
	</section>       

    <!-- form show barang -->
	<div class="modal fade" id="form-show-barang" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog" style="width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Barang :</label>
                                <div class="input-group" style="width:100%;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="txtCariBarang" style="width:100%;" placeholder="Cari Nama Barang..." />
                                </div>                          
                            </div>
                        </div>
                    </div>
					<div class="table-responsive">
                        <div id="isiDataBarang" style="margin-top:5px;"></div>
                    </div>									    
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end form show barang -->	

	<!-- form hapus -->
	<div class="modal fade" id="form-hapus-tmp" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog custom-modal-del">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
				        <label class="control-label">Yakin data akan dihapus...?</label>
			            <input type="hidden" class="form-control" id="txt_kode_hapus" size="5" readonly />
				    </div>				    
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-info btn-flat" id="btnHapusTmp"><i class="fa fa-sm fa-trash-o"></i> Hapus</button>
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>	

</div>