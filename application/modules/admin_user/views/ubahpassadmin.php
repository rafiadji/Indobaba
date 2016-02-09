<form method="POST" action="<?=base_url()?>/admin_user/ubahpasswordAdminsubmit">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Password Lama</label>
				<input type="password" class="form-control" name="PASSWORDLM" value="" />
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="PASSWORD" value="" />
			</div>
			<div class="form-group">
				<label>Confrim Password</label>
				<input type="password" class="form-control" name="PASSWORD2" value="" />
			</div>
			<input type="submit" class="btn btn-default btn-lg" value="Simpan" />
		</div>
	</div>
</div>
</form>