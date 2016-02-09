<?php if($tampilkomentar): ?>
<?php foreach($tampilkomentar as $row): ?>
<div class="item">
	<?php if($row->LEVEL == 2){
		$background = "bg-danger";
		$gambar = $this->diskusi->tampil_gambar($row->ID_TOKO);
        if($gambar != ""){
             $ikongambar = "upload/profil/$gambar";
        }
        else{
            $ikongambar = "assets/images/home/store-icon.png";
        }

	}
	else{
		
		$background = "bg-info";
		  $ikongambar = "assets/images/home/logo.png";
	}
	?>
    <img src="<?php echo base_url().$ikongambar ?>" alt="user image" class="online" style="border: none;"/>
    <p class="message <?php echo $background; ?>" style="padding: 10px;">
        <a href="#" class="name">
            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i ><?PHP echo $row->TGL_PESAN;?></small>
            <?php if($row->LEVEL == 2){
				echo $nmtoko;
			}
			else{
				echo "Anda";
			}
			?>
        </a>
       <?PHP echo $row->ISI_PESAN;?>
    </p>
</div>
<?php endforeach;?>
<?php else: ?>
<div class="well well-sm">
	Tidak ada pesan masuk.
</div>
<?php endif; ?>

        <script>

          $( document ).ready(function() {

    var element = document.getElementById("result");

    element.scrollTop = element.scrollHeight;

          });

        </script>