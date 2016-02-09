<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div id="daftar" style="display:none">
</div>
 <div class="col-md-9">
 <div class="box box-success">
                                <div class="box-body chat" id="result" style="overflow:scroll;height:430px">
                             
                                 
                                    
                                </div><!-- /.chat -->
                                <div class="box-footer" id="form" style="display:none">
                                    <div class="form-group">
			                           <label>Jawaban</label>
			                           <textarea name="tanyaa" class="form-control" id="tanyaa"></textarea>
			                            <input type="hidden" id="ukmm" value=0>
			                            <input type="hidden" id="nmukmm">
			                       </div>
			                       <div class="form-group">
			                           <input type="submit" onclick="simpan()" class="btn btn-default" name="tanya" value="Tanya">
			                       </div>
                                </div>
                            </div>   

    </div>

<script>

$( document ).ready(function() {
    menu();
    setInterval(function(){ menu(); }, 5000);
	setInterval(function(){

		if ($("#ukmm").val() > 0) {

			 //ukm ($("#ukmm").val(),$("#nmukmm").val()); 
             autoupdatemessage($("#ukmm").val(),$("#nmukmm").val());

		}
        

	 }, 5000);

});
function menu(){

     $.ajax({

            type: "POST",

            dataType: "html",

            url: '<?php echo base_url()?>admin_diskusi/menu/',

            success: function(data){

                 $("#daftar").html(data).show();

                  //$("#form").show();

             }

         });
}
function autoupdatemessage(idtoko,nmtoko){
     $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>admin_diskusi/autoupdatemessage/',
             data: "idtoko="+idtoko,
            success: function(data){
                if(data == 1){
                    ukm(idtoko,nmtoko);
                }else{
                    clearInterval();
                }
             }

         });

}

function ukm (e,r) {

    var idtoko = e;

    var nmtoko = r;

    $("#ukmm").val(e);

    $("#nmukmm").val(e);

     $.ajax({

            type: "POST",

            dataType: "html",

            url: '<?php echo base_url()?>admin_diskusi/data/',

            data: "idtoko="+idtoko+"&nmtoko="+nmtoko,

            success: function(data){

				 $("#result").html(data).show();

                  $("#form").show();
                  menu();

             }

         });

     

 }

   function simpan() {
    var pesan =  $("#tanyaa").val();
     var idtoko =  $("#ukmm").val();
      var nmtoko =  $("#nmukmm").val();
    if (pesan == "") {
        alert("Tidak boleh kosong");
    }
    else{
       // alert(pesan);
          $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>admin_diskusi/tambahpesan/',
            data: "pesan="+pesan+"&idtoko="+idtoko,
            success: function(data){
				  $.ajax({
					type: "POST",
					dataType: "html",
					url: '<?php echo base_url()?>admin_diskusi/update_bintang_toko/',
					data: "idtoko="+idtoko,
					success: function(data){
						   ukm(idtoko,nmtoko);
						    $('#tanyaa').val('');
					 }
				 });
             }
         });
    }
   }
</script>

