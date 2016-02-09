<?php $ft = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$ss->NO_TRANS'")->row(); ?>
<div id="buktiModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Bukti pembayaran</h4>
			</div>
			<div class="modal-body">
				<?php if(!empty($ft->FT_BUKTI)):?>
				<img src="<?php echo site_url('assets/images/bukti/'.$ft->FT_BUKTI)?>" width="565"/>
				<?php else:?>
				data foto tidak ada 
				<?php endif;?>
			</div>
		</div>
	</div>
</div>