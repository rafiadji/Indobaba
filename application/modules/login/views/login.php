
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
					<h2 class="bordered">Masuk Akun</h2>
					<p>Masukkan username dan password Anda dengan benar</p>

					<form action="<?php echo base_url();?>login/loginAkun/" method="POST" class="login-form cf-style-1">
						<div class="field-row">
                            <label>Username</label>
                            <input type="text" name="username" class="le-input">
                        </div>
                        <div class="field-row">
                            <label>Password</label>
                            <input type="password" name="password" class="le-input">
                        </div>
                        <div class="field-row">
                            <p>Belum punya akun ?, daftar <a href="<?php echo base_url('user_register') ?>">disini</a> </p>
                            <p>Lupa password klik <a href="<?php echo base_url('login/lupaPassword') ?>">disini</a></p>
                        </div>
                        <div class="buttons-holder">
                            <button type="submit" class="le-button huge">Masuk Akun</button>
                        </div>
					</form>

				</section>
			</div>

		</div>
	</div>
</main>
<?php echo $code ?>