<?php error_reporting(0); ?>
<div class="container">
<div class="row">
    		<div class="col-md-12">
    			<div class="desk-produk">
	    			<h4>Cek Resi</h4>
    			</div>
    		</div>
    	</div>
	<div class="row">
	<div class="col-md-9">
	<input type="text" id="resi"/>
	<a href="#" onclick="resi()" class="btn btn-success">Cek Resi</a>
	<br>
	<div id="tampil"></div>
	</div>
</div>
<script type="text/javascript">
	function resi()
	{
		$.ajax({
			type:"POST",
			url:"<?php echo site_url('user_checkout/docekresi'); ?>",
			data:"resi="+$("#resi").val(),
			success:function(html){
				$("#tampil").html(html).show();
			}
		});
	}
</script>