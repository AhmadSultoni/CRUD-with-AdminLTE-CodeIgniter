<script type="text/javascript">
	$(window).on("load", function() {
		// $('#txtNama').focus();
		
		load_data();		

		$('#btnRefresh').click(function(){
            $('#tgl1').val('');
            $('#tgl2').val('');
            $('#cboStatus').val('');
            load_data();
		})

		$('#btnPrint').click(function() {
			window.print();
        })
        
        $('#tgl1,#tgl2,#cboStatus').change(function(){
            load_data();
        })

		function load_data(){            
			var tgl1  	= $('#tgl1').val();
			var tgl2  	= $('#tgl2').val();
            var custom  = $('#txtCari').val();
            // alert(tgl1+' - '+tgl2+' - '+status);
			$.ajax({
				type : 'POST',
				url  : '<?=base_url();?>rep_sales/load_data',
				data : {'tgl1':tgl1,'tgl2':tgl2,'custom':custom},
				cache: false,
				beforeSend: function() {
			        NProgress.start();
			    },
				success : function(ok){					
					$('#isiData').animate({ opacity: "show" }, "slow");
					$('#isiData').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					// alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
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

	})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Laporan Data Penjualan
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-pie-chart"></i> Laporan</a></li>
			<li class="active">Data Penjualan</li>
		</ol>
	</section>

	<section class="content">		
		<div class="box box-info">
			<div class="box-header with-border">
	          <h3 class="box-title"></h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
	          </div>
	        </div>
	        <div class="box-body">
				<div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="tgl1">From:</label>                        
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control input-sm datepicker" id="tgl1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="tgl1">To:</label>                        
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control input-sm datepicker" id="tgl2" />
                            </div>
                        </div>
                    </div>                    
                    <div class="col-sm-8">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="txtCari" style="color:#fff-;">Pencarian</label>
                            <!-- <button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button> -->
                            <input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:100%;" placeholder="Cari Nama Barang..."/>
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div>					
                </div>
				
				<div class="row">
					<div class="col-sm-2">
					<div class="form-group">
						<button type="buton" class="btn btn-success btn-flat btn-sm" id="btnRefresh"><i class="fa fa-sm fa-refresh"></i> Refresh</button>
						<!-- <button type="button" class="btn btn-warning btn-flat pull-right-" id="btnBatal"><i class="fa fa-sm fa-mail-reply"></i> Kembali</button>                             -->
					</div>
					</div>
				</div>              
	        	<div>
	        		<div id="isiData" style="margin-top:5px;"></div>
	        	</div>
	        </div> 		    
	  	</div>	 
	</section>
		
</div>