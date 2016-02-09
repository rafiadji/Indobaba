<div id="resiModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Resi Anda</h4>
			</div>
			<?php $tokoo = $this->db->query("SELECT * FROM view_checkout WHERE NO_TRANS = '$tk->NO_TRANS' GROUP BY ID_TOKO")->result();
				foreach ($tokoo as $tko) :?>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
						<h3><?=$tko->NM_TOKO?></h3>
						<table class="table table-striped table-bordered">
							<tr>
								<td>Ongkir</td>
								<td>Resi</td>
							</tr>
						
						<?php $resi = $this->db->query("SELECT * FROM view_checkout WHERE ID_TOKO = '$tko->ID_TOKO' AND NO_TRANS = '$tk->NO_TRANS'")->result();
								foreach ($resi as $rs) :?>
								<?php if(!empty($rs->RESI)) : ?>
								<tr>
									<td><?php echo strtoupper($rs->NAMA_KURIR).' - '.$rs->PAKET_YANG_DIAMBIL; ?></td>
									<td><?=$rs->RESI?></td>
								</tr>
								<?php endif;?>
						<?php endforeach;?>
						</table>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>