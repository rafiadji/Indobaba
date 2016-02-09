
<main id="authentication" class="inner-bottom-md">
	<div class="container">
		<div class="row">
			<div class="col-sm-offset-4 col-md-5">
				<?php if($this->session->flashdata('notif')): ?>
<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
<?php endif; ?>
				<section class="section sign-in inner-right-xs">
					<h2 class="bordered">Reset Password</h2>
					<p>Berhasil !, sekarang Anda dapat mereset password Anda</p>

					<form action="<?php echo base_url();?>login/resetPasswordSubmit/" method="POST" class="login-form cf-style-1">
						<div class="field-row">
                            <label>Password Baru</label>
                            <input type="password" name="pass_bar" class="le-input">
                        </div>
                        <div class="field-row">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="pass_bar_con" class="le-input">
                        </div>
                        <div class="buttons-holder">
                            <button type="submit" class="le-button huge">Submit</button>
                        </div>
					</form>

				</section>
			</div>

		</div>
	</div>
</main>