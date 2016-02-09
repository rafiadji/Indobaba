<div class="panel panel-default" style="background-color: rgba(158, 158, 158, 0.08);">
	<div class="panel-body">
		<h4 align="center"><b><i>Riwayat Saldo Saya</i></b></h4>
		<hr/>
		<!-- <div class="row">
				<div class="form-group" style="float: left; margin-left: 15px;">
				<table>
					<tr>
					<td style="padding:10px">Pilih status</td>
					<td>
						<select name="order_tab" class="form-control col-md-8" id="order_tab">
							<option value="1">Orderan baru</option>
							<option value="2">Orderan ditanggapi</option>
							<option value="4">Orderan tidak valid</option>
							<option value="3">Orderan berhasil</option>
							<option value="5">Orderan kadaluwarsa</option>
						</select>
					</td>
					</tr>
				</table>
					
				</div>	
		</div> -->
		<div class="row loading_order" style="display: none;">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<img src="<?php echo base_url('assets/loading.gif')?>" style="width:300px; left:100px;" class="loading_order"/>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="notifikasi" style="display: none">
				</div>
			</div>
		</div>
		<div class="row">
			<div class=" col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Transaksi</th>
							<th>Tanggal</th>
							<th>Saldo di Transaksi ini</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if($tampil): $i = 1;?>
							<?php foreach($tampil as $row): ?>
								<tr>
									<td><?=$i?></td>
									<td><?=$row->ID_TRANS?></td>
									<td><?=$row->TGL_TRANS?></td>
									<td><?=$row->SALDO?></td>
									<td><a href="<?php echo base_url().'user_riwayat_saldo/detailsaldo/'.$row->NO_TRANS;?>" target="_blank" class="btn btn-success">Detail</a></td>
								</tr>
							<?php $i++; endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>