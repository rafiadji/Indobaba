<div class="row">
<form method="POST" action="">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php if($tampilEkspedisi):?>
			<input type="submit" name="simpan" value="Simpan" class="btn btn-default btn-lg">
			<?php endif;?>
			<a href="<?php echo base_url("admin_ukm/ekspedisiUkm/$id_encode") ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<?php if($tampilEkspedisi):?>
				<label>Pilih Ekspedisi</label>
				<select name="ekspedisi" class="form-control">
                <?php foreach($tampilEkspedisi as $row):?>
                    <option value = "<?php echo $row->ID_EKSPEDISI;?>"><?php echo $row->NAMA_EKSPEDISI;?></option>
                <?php endforeach;?>
                </select>
				<?php else:?>
				<p style="color:red">Ekspedisi telah terpilih semua.</p>
				<?php endif;?>
			</div>
          
			
		</div>
	</div>
</div>
</form>
</div>