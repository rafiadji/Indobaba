<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" name="simpan" value="Simpan" class="btn btn-default btn-lg"/>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Provinsi</label>
				<select name="provinsi" class="form-control" id="prov">
					<option value="pilih">-Pilih Provinsi-</option>
					<?php foreach($tampilprov as $row): ?>
						<option value="<?php echo $row->ID_PROVINSI;?>" <?php if($tampil->ID_PROVINSI == $row->ID_PROVINSI):echo "selected"; endif;?>><?php echo $row->PROVINSI;?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>Kota</label>
				<select name="kota" class="form-control" id="kota">
					<option value="pilih">-Pilih Kota/kabupaten-</option>
				</select>
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<select name="kecamatan" class="form-control" id=kecam>
						<option value="pilih">-Pilih Kecamatan-</option>
				</select>
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="text" class="form-control" name="harga_ekspedisi" value="<?php echo $tampil->HARGA?>" class="form-control">
			</div>
		</div>
	</div>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
        $.ajax({
			type:"POST",
			url:"<?=site_url('admin_ekspedisi/dapatKota');?>",
			data:'idprov='+<?=$tampil->ID_PROVINSI?>+'&idkota='+<?=$tampil->ID_KOTA?>,
			success:function(data) {
				$("#kota").html(data);
			}
		});
         $.ajax({
			type:"POST",
			url:"<?=site_url('admin_ekspedisi/dapatKecamatan');?>",
			data:'idkota='+<?=$tampil->ID_KOTA?>+'&idkecamatan='+<?=$tampil->ID_KECAMATAN?>,
			success:function(data) {
				$("#kecam").html(data);
			}
		});
    });
    $(function() {
     $("#prov").change(function(){
        var idprov = $(this).val();
        //window.alert(idprov);
         $.ajax({
            type: "GET",
            dataType: "html",
            url: '<?php echo base_url()."admin_ekspedisi/getKota";?>',
            data: "idprov="+idprov,
            success: function(msg){
                 if(msg == ''){
                         $("#kota").html('<option value="">--Pilih Provinsi--</option>');
                         $("#kacam").html('<option value="">--Pilih Kota--</option>');
                 }else{
                           $("#kota").html(msg);                                                       
                 }
                 //getAjaxAlamat();                                                        
             }
         });
        
     });
      $("#kota").change(function(){
        var idkota = $(this).val();
        //window.alert(idprov);
         $.ajax({
            type: "GET",
            dataType: "html",
            url: '<?php echo base_url()."admin_ekspedisi/getKecam";?>',
            data: "idkota="+idkota,
            success: function(msg){
                 if(msg == ''){
                         $("#kota").html('<option value="">--Piliih Provinsi--</option>');
                         $("#kacam").html('<option value="">--Pilih Kota--</option>');
                 }else{
                           $("#kecam").html(msg);                                                       
                 }
                 //getAjaxAlamat();                                                        
             }
         });
        
     });
});
</script>