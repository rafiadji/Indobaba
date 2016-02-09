<div id="bayarModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pilih pembayaran</h4>
			</div>
			<div class="modal-body">
				<?php
				$bayar = $tot_tag[$l-1] + $tk->KODE_UNIK;
				$cek_saldo = $this->db->query("SELECT * FROM mp_akun WHERE ID_AKUN = '$auth'")->row();
				if($cek_saldo->SALDO >= $bayar):?>
				<button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#tnysaldoModal">Saldo (saldo anda : <?=formatrp($cek_saldo->SALDO)?>)</button>
				<?php endif;?>
				<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#buktiModal">Transfer bank</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<div id="tnysaldoModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Apa anda yakin ingin membayar dengan saldo ?</h4>
			</div>
			<div class="modal-body">
				jika anda tidak jadi menggunakan saldo silahkan klik tombol "Transfer Bank"
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success saldo">Ya, saya yakin</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buktiModal">Transfer bank</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var NO_TRANS = <?=$tk->NO_TRANS?>;
	var bayar = <?=$bayar?>;
	$(document).ready(function(){
		$(".saldo").click(function(){
			$.ajax({
				type:"POST",
				url:"<?=site_url('user_checkout/bayar_saldo');?>",
				data:"NO_TRANS="+NO_TRANS+"&bayar="+bayar,
				success:function() {
					location.reload();
				}
			})
		})
	})
</script>
<?php include('bukti_modal.php'); ?>