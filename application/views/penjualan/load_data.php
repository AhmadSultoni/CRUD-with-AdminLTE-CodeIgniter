<table id="tabel_data" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th width="5px">No. Invoice</th>
      <th width="5px">Tanggal</th>
      <th width="5px">Grand Total</th>      
      <!-- <th width="5px">Action</th> -->
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
            <td class="col_nip"><a href="<?=base_url()?>penjualan/show_detail/<?=$db['no_invoice']?>""><?=$db['no_invoice'];?></a></td>
            <td class="col_nip"><?=$db['tanggal'];?></td>            
            <td class="col_nama"><?=$db['grand_total'];?></td>                    
          </tr>
        <?php
        }
      }else{
        ?>
        <tr>
          <td colspan="6"><font color="red">no data found</font></td>
        </tr>
        <?php
      }
    ?>
  </tbody>          
</table>