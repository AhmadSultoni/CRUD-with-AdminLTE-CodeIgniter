<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url();?>/asset/images/avatar.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p><?=$nama;?></p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pencarian..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview-">
          <a href="<?php echo base_url();?>app">
            <i class="fa fa-dashboard"></i> <span>Home</span>
            <!-- <i class="fa fa-angle-left pull-right"></i> -->
          </a>          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Master Data</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>barang"><i class="fa fa-circle-o text-yellow ajax"></i> Data Barang</a></li>
            <li><a href="<?php echo base_url();?>harga"><i class="fa fa-circle-o text-yellow ajax"></i> Data Harga</a></li>
            <li><a href="<?php echo base_url();?>diskon"><i class="fa fa-circle-o text-yellow ajax"></i> Data Diskon</a></li>            
          </ul>
        </li>
        <li class="treeview-">
          <a href="<?php echo base_url();?>rekap">
            <i class="fa fa-tags"></i>
            <span>Penjualan</span>
            <!-- <i class="fa fa-angle-left pull-right"></i> -->
          </a>          
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Laporan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>rep_sales"><i class="fa fa-circle-o text-yellow"></i> Penjualan</a></li>
          </ul>
        </li>
      </ul>
    </section>
</aside>