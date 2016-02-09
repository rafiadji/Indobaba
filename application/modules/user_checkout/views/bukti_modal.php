<div id="buktiModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload bukti pembayaran</h4>
			</div>
			<div class="modal-body">
				
			<form action="<?=base_url();?>user_checkout/bukti_checkout" enctype="multipart/form-data" method="POST">
				<input type="hidden" class="form-control" name="NO_TRANS" value="<?php echo $tk->NO_TRANS; ?>"/>
				<input type="hidden" class="form-control" name="TOT_TRANSFER" value="<?=$tot_tag[$l-1] + $tk->KODE_UNIK?>"/>
				<div class="">
					<label>ID Transaksi :</label>
					<p><?php echo $tk->ID_TRANS ?></p>
					<input type="hidden" name="KODE_UNIK" value="<?php echo $tk->KODE_UNIK ?>"/>
				</div>
				<div class="form-group">
					<label>Rekening Atas Nama</label>
					<input type="text" class="form-control" name="ATAS_NAMA"/>
				</div>
				<div class="form-group">
					<label>Tanggal Transfer</label>
					<input type="text" id="datepicker" class="form-control" name="TGL_TRANSFER"/>
				</div>
				<div class="form-group">
					<label>No. Rekening Pengirim</label>
					<input type="text" class="form-control" name="NO_REKENING"/>
				</div>
				<div class="form-group">
					<label>Rekening Tujuan</label>
					<select name="BANK_TUJUAN" class="form-control">
					<?php
						$rekening = $this->db->query("SELECT * FROM view_rekening WHERE LEVEL='1'")->result();
						foreach($rekening as $row):
					?>
					<option value="<?php echo $row->ID_REKENING ?>"><?php echo $row->BANK ?> - <?php echo $row->NO_REKENING ?></option>
					<?php endforeach; ?>
					<input type="hidden" name="NAMA_BANK" value="<?php echo $row->BANK ?>" />
					</select>
				</div>
				
				<div class="form-group">
					<label>Foto Bukti Pembayaran</label>
					<input type="file" class="form-control" name="filebukti"/>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-success" >Kirim</button>
			</div>
			</form>
			</div>
		</div>
	</div>
</div>