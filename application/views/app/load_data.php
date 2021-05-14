<style>
    .col_nama img{
        border-radius:50%;
    }
</style>
<script>
    $('.col_nama img').click(function(){
        // var isi = $(this).html();
        var isi = $(this).closest('tr').find("img").attr("src");
        // alert(isi);
        $('#div-zoom-foto').attr('src',isi);
        $('#form-zoom').modal({
            show: true,
            keyboard:false,
            backdrop:false
        })
    })
</script>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th style="display:none;">NIK</th>
            <th width="50%">Employee Name</th>      
            <th width="5px">Department</th>  
            <th width="5px">Job Title</th>
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
                <td class="col_nik" style="display:none;"><?=$db['EMP_NIK'];?></td>
                <td class="col_nama"><img src="<?=base_url();?>asset/foto/<?=$db['EMP_PHOTO'];?>" alt="" width="35" height="35" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;<a href="<?=base_url().'app/show_detail/'.$db['EMP_NIK'];?>"><?=$db['EMP_NIK'];?></a> - <?=$db['EMP_NAME'];?></td>
                <td class="col_dept"><?=$db['DEPT_NAME'];?></td>
                <td class="col_title"><?=$db['TITLE_NAME'];?></td>                                        
            </tr>
            <?php
            }
        }else{
            ?>
            <tr>
            <td colspan="8"><font color="red">no data found</font></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>