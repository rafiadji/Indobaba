<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST">

            <div class="form-group">

				<label>No Rekening</label>

				<input type="text" class="form-control" name="NO_REKENING" value="<?php echo $tampil->NO_REKENING;?>"/>

			</div>

			<div class="form-group">

				<label>Bank</label>

				<select name="ID_BANK" class="form-control">

					<option value="">Pilih Bank</option>

					<?php foreach ($bank as $row):?>

					<option value="<?=$row->ID_BANK?>" <?php if($tampil->ID_BANK == $row->ID_BANK): echo "selected";endif;?>><?=$row->BANK?></option>

					<?php endforeach; ?>

				</select>

			</div>

			 <div class="form-group">

				<label>Atas Nama</label>

				<input type="text" class="form-control" name="ATAS_NAMA"  value="<?=$tampil->ATAS_NAMA?>"/>

			</div>

        </form>	
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" name="simpan" value="Simpan" class="btn btn-info btn-lg">
		</div>
	</div>
</div>
