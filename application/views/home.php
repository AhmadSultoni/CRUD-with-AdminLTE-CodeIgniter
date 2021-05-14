<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        var intervalKordinat;
        show_grafik();
        // getNewAsset();
        // getTotTiketBaru();
        // getTotTiketProgress();
        // getTotTiketClosed();
        // getTotTiketMasuk();

        // getTopOpenTicket();
        // getTopClosedTicket();
                
        // intervalKordinat = setInterval(function () {
        //   getTotTiketBaru();
        //   getTotTiketProgress();
        //   getTotTiketClosed();
        //   getTotTiketMasuk();

        //   getTopOpenTicket();
        //   getTopClosedTicket();        
        // }, 5000); // update setiap 5 detik
        
        function getNewAsset()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getNewAsset",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_new_aset').animate({ opacity: "show" }, "slow");
              $('#isi_new_aset').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTopClosedTicket()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTopClosedTicket",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_closed').animate({ opacity: "show" }, "slow");
              $('#isi_closed').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTotTiketProgress()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotTiketProgress",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotTiketProgress').animate({ opacity: "show" }, "slow");
              $('#txtTotTiketProgress').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTotTiketBaru()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotTiketBaru",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert(ok);
              $('#txtTiketBaru').animate({ opacity: "show" }, "slow");
              $('#txtTiketBaru').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
                // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTotTiketClosed()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotTiketClosed",
            cache 	: false,
            beforeSend: function() {
                // NProgress.start();
            },
            success : function(ok){
                // alert(ok);
              $('#txtTotTiketClosed').animate({ opacity: "show" }, "slow");
              $('#txtTotTiketClosed').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
              // NProgress.done();
            }
          })
        }
        
        function getTotTiketMasuk()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotTiketMasuk",
            cache 	: false,
            beforeSend: function() {
                // NProgress.start();
            },
            success : function(ok){
                // alert(ok);
              $('#txtTotTiketMasuk').animate({ opacity: "show" }, "slow");
              $('#txtTotTiketMasuk').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function show_grafik(){
          Highcharts.setOptions({
            colors: ['#50B432', '#DDDF00', '#ED561B', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
          });
          var myChart = Highcharts.chart('myChart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Top 10 of Sales '
            },
            xAxis: {
                categories: ['Cat Interior', 'Cat Exterior', 'Cat Base']
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                pie: {
                    size: '100%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        connectorShape: 'fixedOffset',
                        format: '<b>{point.name}</b>: {point.y}'
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                colorByPoint: true,
                data: [{
                  name:'Cat Interior',
                  y:180
                },{
                  name:'Cat Exterior',
                  y:22
                },{
                  name:'Cat Base',
                  y:5
                }]
            }]
          });
        }
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
      <?=$app_name;?>			
			<small>Sales Management System</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<section class="content">
		 <div class="row">
			      <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="txtTiketBaru">180</h3>
    
                  <p>Barang A</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-square-o"></i>
                </div>
                <a href="<?=base_url();?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3 id="txtTotTiketProgress">12</h3>
    
                  <p>Barang B</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cogs"></i>
                </div>
                <a href="<?=base_url();?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 id="txtTotTiketClosed">20</h3>
    
                  <p>Barang C</p>
                </div>
                <div class="icon">
                  <i class="fa fa-puzzle-piece"></i>
                </div>
                <a href="<?=base_url();?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 id="txtTotTiketMasuk">212</h3>
    
                  <p>Total Penjualan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-barcode"></i>
                </div>
                <a href="<?=base_url();?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
		</div>
		
		<div class="row">			
			
			<div class="col-md-6 col-sm-12 col-xs-12">
          <div class="box box-primary-">
              <div class="box-header with-border">
                <h3 class="box-title">Top 10 Chart of Sales</h3>
                <!-- <p>Status : <font color="red">OPEN</font></p> -->
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                </div>
              </div>
              
              <div class="box-body">
                  <ul class="products-list product-list-in-box" id="myChart">
                  
                  </ul>
              </div>
              
              <!-- <div class="box-footer text-center">
                <a href="<?=base_url();?>app/develop" class="uppercase">View All</a>
              </div>  -->
          </div>
      </div>

      <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="box box-primary-">
              <div class="box-header with-border">
                <h3 class="box-title">Top 10 Sales</h3>
                <!-- <p>Status : <font color="green">CLOSED</font></p> -->
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                </div>
              </div>
              
              <div class="box-body">
                  <ul class="products-list product-list-in-box" id="isi_new_aset">
                  
                  </ul>
              </div>
              
              <!-- <div class="box-footer text-center">
                <a href="<?=base_url();?>app/develop" class="uppercase">View All</a>
              </div>  -->
          </div>
      </div>                                  

		</div>				
    	
	</section>

</div>