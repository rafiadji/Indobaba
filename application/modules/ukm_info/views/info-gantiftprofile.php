<div class="container">

<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

<?php endif; ?>

<div class="row">

		<div class="col-md-3">

		<h4>Panel Akun</h4>

		<hr />

		<div class="list-group">

		  <a href="<?php echo base_url('ukm_info') ?>" class="list-group-item"><i class="fa fa-user"></i> Akun Profil</a>

		  <a href="<?php echo base_url('ukm_info/gantipassword') ?>" class="list-group-item"><i class="fa fa-unlock"></i> Ganti Password</a>

		  <a href="<?php echo base_url('login/logout_ukm') ?>" class="list-group-item"><i class="fa fa-lock"></i> Keluar</a>

		</div>

	

</div>

<div class="col-md-6">

	<h4>Informasi Toko Anda</h4>

		<hr />

    <form method="POST" enctype="multipart/form-data" >

         <table class="table table-bordered">

            <tr>

                <td><img src="<?php echo base_url();?>upload/profil/<?php echo $tampil->FT_PROFIL;?>" style="width:150px;"></td>

                <td><input type="file" name="userfile"></td>

            </tr>

            <tr>

                <td></td>

                <td><input type="submit" name="simpan" value="Simpan" class="btn btn-success"></td>

            </tr>

         </table>

    </form>

</div>

</div>