

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

					
					<div id="tb">

					

					</div>

				</div>

			</div>
<script type="text/javascript">

    $(function() {

        $("#example1").dataTable();

    });

    do_tabel(<?php echo $status;?>);
    setInterval(function(){ do_tabel(<?php echo $status;?>); }, 20000);

    function do_tabel(t)

	{

		 $.ajax( {

              type :"POST",

              url :"<?php echo site_url('ukm_info/tabel') ?>",

              cache :false,

              data: "st="+t,

              success : function(msg) {

                  $("#tb").html(msg).show();

              },

              error : function() {

                  //$('#data_s3').replaceWith('Error');

              }

          });

	}

	function status()

	{

		 $.ajax( {

              type :"POST",

              url :"<?php echo site_url('ukm_info/tabel') ?>",

              cache :false,

              data: "st=" + $("#st").val() ,

              success : function(msg) {

				$("#loadingcari").fadeIn();

                  $("#tb").html(msg).show();

				  $("#loadingcari").fadeOut();

              },

              error : function() {

                  //$('#data_s3').replaceWith('Error');

              }

          });

	}

</script>

</div>