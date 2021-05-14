<style>
    .img-tengah img {
        border:3px solid #ddd;
        width:100px;
        padding:2px;
        display:block;
        margin:auto;
    }
</style>
<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        $('.img-file').click(function(){
            // var isi = $(this).html();
            var isi = $(this).attr("data-id");
            var judul = $(this).attr("title");
            // alert(isi);
            $('#div-zoom-foto').attr('src',isi);
            $('.modal-title').html(judul);
            $('#form-zoom').modal({
                show: true,
                keyboard:false,
                backdrop:false
            })
        })
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>            
            <?php 
                foreach($data->result_array() as $isi){
                    // echo $isi['EMP_NAME'];
                } 
            ?>
            Employee Detail  
			<!-- <small>Document Control Management System</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Employee</li>
			<li class="active">Employee Detail</li>
		</ol>
	</section>

	<section class="content">		
		<div class="row">
            <?php foreach($data->result_array() as $isi){ ?>
			<div class="col-md-4 col-sm-12 col-xs-12">
                <div class="box box-widget widget-user">                    
                    <div class="widget-user-header bg-aqua-active" style="background: url('<?=base_url();?>asset/dist/img/bc.jpg') right center;">
                        <!-- <h3 class="widget-user-username"><?=$isi['EMP_NAME'];?></h3>
                        <h5 class="widget-user-desc"><?=$isi['TITLE_NAME'];?></h5> -->
                    </div>
                    <div class="widget-user-image">                        
                        <img class="img-circle" src="<?=base_url();?>asset/foto/<?=$isi['EMP_PHOTO'];?>" alt="User Avatar">
                    </div>
                    <div class="box-footer"><br>
                        <h3 class="widget-user-username text-center"><?=$isi['EMP_NAME'];?></h3>
                        <!-- <h5 class="widget-user-desc text-center"><?=$isi['TITLE_NAME'];?></h5> -->

                        <!-- <h3 class="profile-username text-center"><?=$isi['EMP_NAME'];?></h3> -->
                        <p class="text-muted text-center"><?=$isi['TITLE_NAME'];?></p>
                    </div>
                </div>                

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>                    
                    <div class="box-body">                        
                        <strong><i class="fa fa-home margin-r-5"></i> Address as Identity Card</strong>
                        <p class="text-muted"><?=$isi['EMP_ADDR_CARD'];?></p>
                        <hr>

                        <strong><i class="fa fa-institution  margin-r-5"></i> Currently Address</strong>
                        <p class="text-muted"><?=$isi['EMP_ADDR_CURRENT'];?></p>
                        <hr>

                        <strong><i class="fa fa-phone margin-r-5"></i> Phone Number</strong>
                        <p class="text-muted">
                            <a href="tel:<?=$isi['EMP_MOBILE_NUMBER'];?>"><?=$isi['EMP_MOBILE_NUMBER'];?> - <?=$isi['EMP_PHONE_NUMBER'];?></a>
                        </p>
                        <hr>

                        <strong><i class="fa fa-phone margin-r-5"></i> Emergency Number</strong>
                        <p class="text-muted">
                            <a href="tel:<?=$isi['EMP_EMERGENCY_NUMBER'];?>"><?=$isi['EMP_EMERGENCY_NUMBER'];?></a>
                        </p>
                        <hr>

                        <strong><i class="fa fa-phone margin-r-5"></i> Emergency Name & Status</strong>
                        <p class="text-muted">
                            <?=$isi['EMP_EMERGENCY_NAME'].' - '.$isi['EMP_EMERGENCY_STATUS'];?>
                        </p>
                        <hr>

                        <strong><i class="fa fa-bookmark-o margin-r-5"></i> Identity Card</strong>
                        <p>
                            <img class="img-file" src="<?=base_url();?>asset/dist/img/credit/ektp.png" data-id="<?=base_url();?>asset/file_ktp/<?=$isi['FILE_KTP'];?>" title="KTP" width="51px" height="32px" style="cursor:pointer;">
                            <img class="img-file" src="<?=base_url();?>asset/dist/img/credit/kk.png" data-id="<?=base_url();?>asset/file_kk/<?=$isi['FILE_KK'];?>" title="Kartu Keluarga" width="51px" height="32px" style="cursor:pointer;">
                            <img class="img-file" src="<?=base_url();?>asset/dist/img/credit/bpjs_tk.png" data-id="<?=base_url();?>asset/file_bpjs_tk/<?=$isi['FILE_BPJS_TK'];?>" title="BPJS Ketenagakerjaan" width="51px" height="32px" style="cursor:pointer;">
                            <img class="img-file" src="<?=base_url();?>asset/dist/img/credit/bpjs_kes.png" data-id="<?=base_url();?>asset/file_bpjs_kes/<?=$isi['FILE_BPJS_KES'];?>" title="BPJS Kesehatan" width="51px" height="32px" style="cursor:pointer;">                        
                            <img class="img-file" src="<?=base_url();?>asset/dist/img/credit/npwp.png" data-id="<?=base_url();?>asset/file_npwp/<?=$isi['FILE_NPWP'];?>" title="NPWP" width="51px" height="32px" style="cursor:pointer;">
                        </p>                                                
                    </div>
                <!-- /.box -->
                </div>
            </div>            

            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#information" data-toggle="tab">Personal Information</a></li>
                        <li><a href="#family" data-toggle="tab">Family</a></li>
                        <li><a href="#education" data-toggle="tab">Education</a></li>
                        <li><a href="#skill" data-toggle="tab">Skill & Interest</a></li>
                        <li><a href="#training" data-toggle="tab">Training</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Personal Information -->
                        <div class="active tab-pane" id="information">
                            <ul class="timeline timeline-inverse">
                                <li>
                                    <i class="fa fa-building bg-green"></i>
                                    <div class="timeline-item">
                                        <!-- <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span> -->
                                        <h3 class="timeline-header no-border"><a href="#">Company</a> : <?=$isi['COMPANY'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-bank bg-yellow"></i>
                                    <div class="timeline-item">                                        
                                        <h3 class="timeline-header no-border"><a href="#">Directorate</a> : <?=$isi['DIRECTORATE'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-newspaper-o bg-aqua"></i>
                                    <div class="timeline-item">                                        
                                        <h3 class="timeline-header no-border"><a href="#">Division</a> : <?=$isi['DIV_NAME'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-sitemap bg-blue"></i>
                                    <div class="timeline-item">                                        
                                        <h3 class="timeline-header no-border"><a href="#">Department</a> : <?=$isi['DEPT_NAME'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-qrcode bg-red"></i>
                                    <div class="timeline-item">                                        
                                        <h3 class="timeline-header no-border"><a href="#">Section</a> : <?=$isi['SECTION_NAME'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-signal bg-purple"></i>
                                    <div class="timeline-item">                                        
                                        <h3 class="timeline-header no-border"><a href="#">Job Level</a> : <?=$isi['JOB_LEVEL'];?></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-angle-double-up bg-grey"></i>
                                </li>                            
                            </ul>
                        </div>
                        <!-- Family -->
                        <div class="tab-pane" id="family">                           
                            
                        </div>
                        
                        <!-- Education -->
                        <div class="tab-pane" id="education">
                            
                        </div>                                               
                    </div>
                </div>
            </div>
            <?php } ?>
		</div>	<!-- end row -->			    	
    </section>
    
    <!-- form zoom -->
	<div class="modal fade" id="form-zoom" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog" style="width:500px;height:300px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Zoom Foto</h4>
				</div>
				<div class="modal-body">
					<img id="div-zoom-foto" src="" alt="" width="100%">
				</div>
				<!-- <div class="modal-footer">					
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-times-circle"></i> Tutup</button>
				</div> -->
			</div>
		</div>
	</div>

</div>