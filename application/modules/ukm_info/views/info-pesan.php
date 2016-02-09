

<div class="col-md-12">
		<div class="box box-success">
	        <div class="box-header">
	            <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
	        </div>
	        <div class="box-body chat" id="result" style="overflow:auto;height:430px">
	     
	         
	            
	        </div><!-- /.chat -->
	        <div class="box-footer">
	            <div class="input-group">
	                <input id="tanyaa" name="tanyaa" class="form-control" placeholder="Masukkan Pesan..."/>
	                <div class="input-group-btn">
	                    <input type="submit" name="tanya" class="btn btn-default" value="Kirim" onclick="simpan()" id="simpan">
	                </div>
	            </div>
	        </div>
	    </div>
</div>

<script>
$( document ).ready(function() {
		/*$("#tanyaa").keyup(function(event){
				if(event.keyCode == 13 && $("#tanyaa").val() != " "){
						var pesan =  $("#tanyaa").val();
						if (pesan == "") {
								alert("halo");
						}
						else{
								simpan();
						}
		}
   });*/
		ukm();
		updatepesan();
		autoupdatemessage();
		setInterval(function(){ autoupdatemessage(); }, 30000);


});
function autoupdatemessage(){
	 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/autoupdatemessage/',
            success: function(data){
				if(data == 1){
					alert(data);
					ukm();
					updatepesan();
				}else{
					clearInterval();
				}
             }     

         });

}
function updatepesan(){
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/update_bintang/',
            success: function(data){
				// $("#result").html(data).show();
             }

         });

}

function ukm () {

     $.ajax({

            type: "POST",

            dataType: "html",

            url: '<?php echo base_url()?>ukm_info/tampil_pesan/',

            success: function(data){

				//$("#loadingcari").fadeIn();

				 $("#result").html(data).show();

				 //$("#loadingcari").fadeOut();

             }

         });

     

 }

  function simpan() {

    var pesan =  $("#tanyaa").val();

    if (pesan == "" ) {

        alert("Tidak boleh kosong");

    }

    else{

        //alert(pesan);

          $.ajax({

            type: "POST",

            dataType: "html",

            url: '<?php echo base_url()?>ukm_info/tambah_pesan/',

            data: "pesan="+pesan,

            success: function(data){
				 $.ajax({
					type: "POST",
					dataType: "html",
					url: '<?php echo base_url()?>ukm_info/update_bintangg_admin/',
					success: function(msg){
						    ukm();
						    $('#tanyaa').val('');
					 }
				 });
             }

         });

    }

    

   }

</script>

       