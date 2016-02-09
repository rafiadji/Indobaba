<div class="row">
<?php if($rekening) : ?>
<form method="POST" action="<?=base_url();?>/admin_rekening/ubahRekeningpj">
<div class="col-md-12">
	<input type="hidden" class="form-control" name="ID_PEMILIK" value="<?=$id_penanggung_jwb?>"/>
	<input type="hidden" class="form-control" name="ID_REKENING" value="<?=$rekening->ID_REKENING?>"/>
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Edit Rekening Penanggung Jawab" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_penanggung_jwb') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Informasi Rekening UKM</h4>
			<hr />
			<div class="form-group">
				<label>No Rekening</label>
				<input type="text" class="form-control" name="NO_REKENING" value="<?=$rekening->NO_REKENING?>"/>
			</div>
			<div class="form-group">
				<label>Bank</label>
				<select name="ID_BANK" class="form-control">
					<option value="">Pilih Bank</option>
					<?php foreach ($bank as $row):?>
					<option value="<?=$row->ID_BANK?>" <?php if ($rekening->ID_BANK == $row->ID_BANK) {echo "selected";}?>><?=$row->BANK?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
</div>
</form>
<?php else :?>
<form method="POST" action="<?=base_url();?>/admin_rekening/tambahRekeningpj">
<div class="col-md-12">
	<input type="hidden" class="form-control" name="ID_PEMILIK" value="<?=$id_penanggung_jwb?>"/>
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah Rekening Penanggung Jawab" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_penanggung_jwb') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Informasi Rekening UKM</h4>
			<hr />
			<div class="form-group">
				<label>No Rekening</label>
				<input type="text" class="form-control" name="NO_REKENING"/>
			</div>
			<div class="form-group">
				<label>Bank</label>
				<select name="ID_BANK" class="form-control">
					<option value="">Pilih Bank</option>
					<?php foreach ($bank as $row):?>
					<option value="<?=$row->ID_BANK?>"><?=$row->BANK?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
</div>
</form>
<?php endif;?>
</div>