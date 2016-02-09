<?php foreach($tampilkomentar as $row): ?>
<div class="item">
	<?php if($row->LEVEL == 2){
         $gambar = $this->infomodel-> tampil_gambar();
        if($gambar != ""){
             $ikongambar = "upload/profil/$gambar";
        }
        else{
            $ikongambar = "assets/images/home/store-icon.png";
        }
       
		$background = "bg-info";
	}
	else{
        $ikongambar = "assets/images/home/logo.png";
		$background = "bg-danger";
	}
	?>
    <img src="<?php echo base_url().$ikongambar; ?>" alt="user image" class="online" style="border: none;"/>
    <p class="message <?php echo $background; ?>" style="padding: 10px;">
        <a href="#" class="name">
            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i ><?PHP echo $row->TGL_PESAN;?></small>
            <?php if($row->LEVEL == 2){
				echo "Anda";
			}
			else{
				echo "Admin Indobaba";
			}
			?>
        </a>
       <?PHP echo strip_tags($row->ISI_PESAN);?>
    </p>
</div>

            <?php endforeach;?>

        <script>

          $( document ).ready(function() {

    var element = document.getElementById("result");

    element.scrollTop = element.scrollHeight;

          });

        </script>