<main id="authentication" class="inner-bottom-md">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<?php if($this->session->flashdata('notif')): ?>

					<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

						<i class="fa fa-check"></i>

						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

						<?php echo $this->session->flashdata('notif'); ?>

					</div>

				<?php endif; ?>

			</div>

			<div class="col-md-12">

				<h1 class="bordered">Daftar akun</h1>

				<p>Gratis daftar akun selamanya</p>

				<form action="<?php echo base_url();?>user_register/registerSubmit" method="POST" class="login-form cf-style-1">

				<div class="row">

					<div class="col-md-6">

						<section class="section sign-in inner-right-xs">

							<div class="field-row">

                            <label>Username <span style="color:red">*</span></label>

                            <input type="text" name="username" class="le-input"/>

                        </div>

                        <div class="field-row">

                            <label>Password <span style="color:red">*</span></label>

                            <input type="password" name="pass1" class="le-input">

                        </div>

						<div class="field-row">

                            <label>Ulangi Password <span style="color:red">*</span></label>

                            <input type="password" name="pass2" class="le-input">

                        </div>

						<div class="field-row">

                            <label>Nama <span style="color:red">*</span></label>

                            <input type="text" name="nama" class="le-input">

                        </div>

						<div class="field-row">

                            <label>No. HP</label>

                            <input type="text" name="hp" class="le-input">

                            <p class="text-muted">Kami jaga informasi No HP Anda</p>

                        </div>

                        <div class="field-row">

                            <label>Email <span style="color:red">*</span></label>

                            <input type="text" name="email" class="le-input">

                        </div>

						</section>

					</div>

					<div class="col-md-6">

						<section class="section sign-in inner-left-xs">

							 <div class="field-row">

                            <label>Provinsi <span style="color:red">*</span></label>

                            <select name="provinsi" id="prov" class="le-input">

				                <option value="pilih">-Pilih Provinsi-</option>

				                <?php foreach($tampilprov as $row): ?>

				                <option value="<?php echo $row->ID_PROVINSI;?>"><?php echo $row->PROVINSI;?></option>

				                <?php endforeach;?>

			           		</select>

                        </div>

						<div class="field-row">

                            <label>Kota <span style="color:red">*</span></label>

                            <select name="kota" id="kota" class="le-input">

				                <option value="pilih">-Pilih Kota/kabupaten-</option>

				            </select>

                        </div>

						<div class="field-row">

                            <label>Kecamatan <span style="color:red">*</span></label>

                            <select name="kecamatan" id="kecam" class="le-input">

					                <option value="pilih">-Pilih Kecamatan-</option>

					            </select>

                        </div>

						<div class="field-row">

                            <label>Alamat</label>

                          	<textarea name="alamat" class="le-input"></textarea>

                        </div>

						<div class="field-row">

                            <label>Kelurahan</label>

                           <input type="text" name="kelurahan" class="le-input" value="">

                        </div>

                        <div class="form-group">

								<?php echo $recaptcha;?>

							</div>

						</section>

					</div>

				</div>

				<div class="buttons-holder">

                    <button type="submit" class="le-button huge">Daftar Sekarang</button>

                </div>

				</form>

			</div>



		</div>

	</div>

</main>

<?php echo $code; ?>

<script type="text/javascript">

$(function() {

     $("#prov").change(function(){

        var idprov = $(this).val();

        //window.alert(idprov);

         $.ajax({

            type: "GET",

            dataType: "html",

            url: '<?php echo base_url()."user_register/getKota";?>',

            data: "idprov="+idprov,

            success: function(msg){

                 if(msg == ''){

                         $("#kota").html('<option value="">--Pilih Provinsi--</option>');

                         $("#kacam").html('<option value="">--Pilih Kota--</option>');

                 }else{

                           $("#kota").html(msg);                                                       

                 }

                 //getAjaxAlamat();                                                        

             }

         });

        

     });

      $("#kota").change(function(){

        var idkota = $(this).val();

        //window.alert(idprov);

         $.ajax({

            type: "GET",

            dataType: "html",

            url: '<?php echo base_url()."user_register/getKecam";?>',

            data: "idkota="+idkota,

            success: function(msg){

                 if(msg == ''){

                         $("#kota").html('<option value="">--Piliih Provinsi--</option>');

                         $("#kacam").html('<option value="">--Pilih Kota--</option>');

                 }else{

                           $("#kecam").html(msg);                                                       

                 }

                 //getAjaxAlamat();                                                        

             }

         });

        

     });

});

</script>



