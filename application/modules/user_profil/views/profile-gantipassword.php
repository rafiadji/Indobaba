<div class="col-md-12">

		<div class="panel panel-default">

			<div class="panel-body">

				<h4>Ganti Password</h4>

				<hr/>
				<form method="POST" action="<?php echo base_url();?>/user_profil/gantipasswordUpdate">
				<div class="form-group">

					<label>Password Lama</label>

					<input type="password" class="le-input" name="passlama" value="">

				</div>

				<div class="form-group">

					<label>Password Baru</label>

					<input type="password" class="le-input" name="passbaru" value="">

				</div>

				<div class="form-group">

					<label>Ulangi Password Baru</label>

					<input type="password" class="le-input" name="passbaruulangi" value="">

				</div>

				<div class="form-group">

					<input type="submit" name="simpan" class="btn btn-default" value="Simpan">

				</div>
				</form>
			</div>

		</div>

	</div>