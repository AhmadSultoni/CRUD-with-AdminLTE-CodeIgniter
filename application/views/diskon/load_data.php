<script type="text/javascript">    
    $('.edit').click(edit);

    function edit(){
        var baris   = $(this).closest('.baris');
        var kode    = $('.col_kode',baris).html();  
        var nama    = $('.col_nama',baris).html();
        var diskon   = $('.col_diskon',baris).html();        
        
        // alert(tipe);
        $('#form-input select[id="cboBarang"]').val(kode);     
        $('#form-input input[id="txtDiskon"]').val(diskon);

        $('.modal-title').html("Edit Data");  
        $('#form-input').modal({
          show: true,
          keyboard:false,
          backdrop:false
        })
      
    }

    $('.delete').click(hapus);

    function hapus(){
        var baris = $(this).closest('.baris');  
        var kode  = $('.col_kode',baris).html();
        $('#form-hapus input[id="txtid_hapus"]').val(kode);

        $('.modal-title').html("Konfirmasi");  
        $('#form-hapus').modal({
          show: true,
          keyboard:false,
          backdrop:false
        })       
    }
    
    $('#btnHapus').click(function(){
      hapus_data();
    })

    function hapus_data(){
        var kode  = $("#txtid_hapus").val();

        $.ajax({
          url   : "<?=base_url();?>diskon/hapus",
          type  : "POST",
          data  : {"kode":kode},
          success : function(data){
            swal('Informasi','Data berhasil dihapus','success');
            $('#isiData').html(data);
            $("#form-hapus").modal("hide");
          }
        })
    }
</script>
<table id="tabel_data" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th width="1%">Kode Barang</th>
      <th width="70%">Nama Barang</th>      
      <th width="5px">Diskon (%)</th>
      <th width="5px">Action</th>
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
            <td class="col_kode"><?=$db['KDBRG'];?></td>            
            <td class="col_nama"><?=$db['NMBRG'];?></td>
            <td class="col_diskon"><?=$db['DISCN'];?></td>
            <td align="center">            
              <button title="Edit Data" class="edit btn btn-sm btn-info btn-flat" href="#"><i class="fa fa-sm fa-pencil"></i></button>
              <button title="Hapus Data" class="delete btn btn-sm btn-warning btn-flat" href="#"><i class="fa fa-sm fa-trash-o"></i></button>
            </td>
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