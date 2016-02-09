<div class="col-md-3" id="daftar">
		<h4>Daftar</h4>
		<div class="list-phpgroup" style="display:inherit;" >
		  <?php foreach($tampiltoko as $row):?>

               <a href ="#" class="list-group-item <?php if($this->session->userdata('idtokochat') == $row->ID_TOKO){ echo 'active';}?>" onclick="ukm(<?php echo $row->ID_TOKO;?>,'<?php echo $row->NM_TOKO;?>')";><?php echo $row->NM_TOKO ;if($this->diskusi->updatebintang($row->ID_TOKO) == "1"): ?> <span class="label label-danger pull-right"><i class="fa fa-star"></i></span> <?php endif;?></a>
                <!--<span class="label label-danger pull-right" id="bintang_keci<?php echo $row->ID_TOKO;?>"></span>
-->
                <?php endforeach;?>
		</div>
		<hr />
    </div>