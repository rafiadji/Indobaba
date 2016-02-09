<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<form action="<?php echo base_url('admin_widget/tambahHalamanSubmit')?>" method="POST">
				<div class="form-group">
					<label>Halaman</label>
					<select class="form-control" name="id_halaman">
						<?php foreach($halaman as $data_halaman): ?>
						<option value="<?php echo $data_halaman->ID; ?>"><?php echo $data_halaman->NAMA_MENU; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Type</label>
					<select class="form-control" name="type">
						<option value="1">Tentang Indobaba</option>
						<option value="2">Belanja di Indobaba</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" value="tambah" class="btn btn-default"/>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>Tentang Indobaba</h4>
			<?php if($widget_1): ?>
			<ol>
			<?php foreach($widget_1 as $data_widget_1): ?>
				<li><?php echo $data_widget_1->NAMA_MENU ?> <a href="<?php echo base_url('admin_widget/hapusHalaman/'.$data_widget_1->ID_WIDGET) ?>" onClick="return confirm('Hapus menu <?php echo $data_widget_1->NAMA_MENU ?> ?')">( Hapus )</a></li>
			<?php endforeach; ?>
			</ol>
			<?php else: ?>
			Tidak ada data
			<?php endif; ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>Belanja Di Indobaba</h4>
			<?php if($widget_2): ?>
			<ol>
			<?php foreach($widget_2 as $data_widget_2): ?>
				<li><?php echo $data_widget_2->NAMA_MENU ?> <a href="<?php echo base_url('admin_widget/hapusHalaman/'.$data_widget_2->ID_WIDGET) ?>" onClick="return confirm('Hapus menu <?php echo $data_widget_2->NAMA_MENU ?> ?')">( Hapus )</a></li>
			<?php endforeach; ?>
			</ol>
			<?php else: ?>
			Tidak ada data
			<?php endif; ?>
		</div>
	</div>
</div>