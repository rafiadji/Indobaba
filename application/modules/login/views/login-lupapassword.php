
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
					<h2 class="bordered">Lupa Password</h2>
					<p>Masukkan email Anda untuk mereset password</p>

					<form action="<?php echo base_url();?>login/kirimEmailPass/" method="POST" class="login-form cf-style-1">
						<div class="field-row">
                            <label>Email</label>
                            <input type="text" name="email" class="le-input">
                        </div>
                        <div class="field-row">
                            <p>Sudah punya akun ?, login <a href="<?php echo base_url('user_register') ?>">disini</a> </p>
                            <p>Belum punya akun ?, daftar <a href="<?php echo base_url('user_register') ?>">disini</a> </p>
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