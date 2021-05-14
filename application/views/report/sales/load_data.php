<script type="text/javascript">
    
</script>
<table id="tabel_data" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th width="1%">No</th>     
      <th width="1%">No. Faktur</th>
      <th width="5px">Tgl. Faktur</th>
      <th width="150px">Nama Barang</th>
      <th width="1%">Qty</th>
      <th width="5px">Harga</th>
      <th width="5px">Diskon</th>
      <th width="5px">Sub Total</th>
      <th width="5px">Grand Total</th>      
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
            <td class="col_id"><?=$db['Nofak'];?></td>            
            <td class="col_date"><?=$db['Tgfak'];?></td>
            <td class="col_user_nik"><?=$db['NMBRG'];?></td>
            <td class="col_user"><?=$db['qty'];?></td>
            <td class="col_cate_id" align="right">Rp. <?=number_format($db['HARGA'],0,'.','.');?></td>
            <td class="col_cate_name" align="right">Rp. <?=number_format($db['discn'],0,'.','.');?></td>
            <td class="col_desc" align="right">Rp. <?=number_format($db['SubTotal'],0,'.','.');?></td>            
            <td class="col_desc" align="right">Rp. <?=number_format($db['Ttlfak'],0,'.','.');?></td>            
          </tr>
        <?php
        }
      }
    ?>
  </tbody>          
</table>