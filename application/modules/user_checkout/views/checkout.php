<div class="panel panel-default" style="background-color: rgba(158, 158, 158, 0.08);">
	<div class="panel-body">
		<h4 align="center"><b><i>Transaksi Saya</i></b></h4>
		<hr/>
		<div class="row">
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
		</div>
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
					<thead class="headerdata">
					</thead>
					<tbody class="outdata">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var order_tab = $("#order_tab").val();
		$.ajax({
			type:"POST",
			dataType : "json",
			url:"<?=site_url('user_checkout/checkout_tabl');?>",
			data:"order_tab="+order_tab,
			beforeSend:function(){
				$('.outdata').empty();
				$('.headerdata').empty();
				$('.desk-produk').empty();
				$('.desk-produk').hide();
				$(".loading_order").show();
			},
			complete:function(){
				$(".loading_order").hide();
			},
			success:function(html) {
				// var str_header = '<tr>'+
									// '<th>No</th>'+
									// '<th>Transaksi</th>'+
									// '<th>Tanggal</th>'+
									// '<th>Status Bayar</th>'+
									// '<th>Total bayar</th>'+
									// '<th>Aksi</th>'+
								// '</tr>';
				// $('.headerdata').append(str_header);
				// var str_notif = '<div style="border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;" class="desk-produk">'+
									// '<h4>Orderan Baru</h4>'+
			    					// '<br/>'+
			    					// 'Dibawah ini adalah transaksi belanja anda yang belum di konfirmasi pembayarannya oleh Indobaba. Bila anda telah melakukan pembayaran silahkan konfirmasi pembayaran anda'+
			    				// '</div>';
		    	// $('#notifikasi').show();			
		    	// $('#notifikasi').append(str_notif);			
				// if (html.status == 'yes'){
					// for (var i=0; i < html.data.length; i++) {
						// var str =	'<tr>'+
										// '<td>'+(i+1)+'</td>'+
										// '<td>'+html.data[i].ID_TRANS+'</td>'+
										// '<td>'+html.data[i].TGL_TRANS+' '+html.data[i].WKT_TRANS+'</td>'+
										// '<td>'+html.data[i].STS_BAYAR+'</td>'+
										// '<td>'+html.data[i].TOT_BAY+'</td>'+
										// '<td><a href="<?php echo base_url().'user_checkout/detailcheckout/';?>'+html.data[i].NO_TRANS+'" target="_blank" class="btn btn-success">Detail</a></td>'+
									// '</tr>';
						// $('.outdata').append(str);
					// };
				// }
				// else if(html.status == 'no'){
					// var str =	'<tr>'+
									// '<td colspan=7><center>Tidak ada transaksi</center></td>'+
								// '</tr>';
					// $('.outdata').append(str);
				// }
			}
		});
		
		$("#order_tab").change(function(){
			var order_tab = $("#order_tab").val();
			$.ajax({
				type:"POST",
				dataType : "json",
				url:"<?=site_url('user_checkout/checkout_tabl');?>",
				data:"order_tab="+order_tab,
				beforeSend:function(){
					$('.outdata').empty();
					$('.headerdata').empty();
					$('.desk-produk').empty();
					$('.desk-produk').hide();
					$(".loading_order").show();
				},
				complete:function(){
					$(".loading_order").hide();
				},
				success:function(html) {
					if (order_tab == 1){
						var str_notif = '<div style="border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;" class="desk-produk">'+
											'<h4><i>Orderan Baru</i></h4>'+
				    						'<br/>'+
				    						'Dibawah ini adalah transaksi belanja anda yang belum di konfirmasi pembayarannya oleh Indobaba. Bila anda telah melakukan pembayaran silahkan konfirmasi pembayaran anda.'+
				    					'</div>';
					}else if(order_tab == 2){
						var str_notif = '<div class="desk-produk">'+
											'<h4>Orderan Ditanggapi</h4>'+
				    						'<br/>'+
				    						'Transaksi anda sudah dilihat oleh admin atau penjual. '+
				    					'</div>';
					}else if(order_tab == 3){
						var str_notif = '<div class="desk-produk">'+
											'<h4>Transaksi Berhasil</h4>'+
				    						'<br/>'+
				    						'Transaksi anda telah selesai'+
				    					'</div>';
					}else if(order_tab == 4){
						var str_notif = '<div class="desk-produk">'+
											'<h4>Orderan Tidak Valid</h4>'+
				    						'<br/>'+
				    						'Pembayaran yang anda lakukan tidak valid. Silahkan melakukan pembayaran'+
				    					'</div>';
					}else if(order_tab == 5){
						var str_notif = '<div class="desk-produk">'+
											'<h4>Orderan kadaluwarsa</h4>'+
				    						'<br/>'+
				    						'Transkasi anad kadaluwarsa'+
				    					'</div>';
					}
					
					$('#notifikasi').show();
					$('#notifikasi').append(str_notif);
					if (order_tab == 1){
						var str_header ='<tr>'+
											'<th>No</th>'+
											'<th>ID Transaksi</th>'+
											'<th>Tanggal</th>'+
											'<th>Status Bayar</th>'+
											'<th>Total bayar</th>'+
											'<th>Aksi</th>'+
										'</tr>';
					}
					else if (order_tab == 4 || order_tab == 5){
						var str_header ='<tr>'+
											'<th>No</th>'+
											'<th>ID Transaksi</th>'+
											'<th>Tanggal</th>'+
											'<th>Total bayar</th>'+
											'<th>Aksi</th>'+
										'</tr>';
					}
					else{
						var str_header ="<tr style='background-color:white'>"+
											'<th>No</th>'+
											'<th>ID Transaksi</th>'+
											'<th>Tanggal</th>'+
											'<th>Tanggapan Toko</th>'+
											'<th>Resi</th>'+
											'<th>Total bayar</th>'+
											'<th>Aksi</th>'+
										'</tr>';
					}
					
					$('.headerdata').append(str_header);
					if (html.status == 'yes'){
						for (var i=0; i < html.data.length; i++) {
							if (order_tab == 1) {
								var str =	'<tr>'+
												'<td>'+(i+1)+'</td>'+
												'<td>'+html.data[i].ID_TRANS+'</td>'+
												'<td>'+html.data[i].TGL_TRANS+' '+html.data[i].WKT_TRANS+'</td>'+
												'<td>'+html.data[i].STS_BAYAR+'</td>'+
												'<td>'+html.data[i].TOT_BAY+'</td>'+
												'<td><a href="<?php echo base_url().'user_checkout/detailcheckout/';?>'+html.data[i].NO_TRANS+'" target="_blank" class="btn btn-success">Detail</a></td>'+
											'</tr>';
							}
							else if (order_tab == 4 || order_tab == 5) {
								var str =	'<tr>'+
												'<td>'+(i+1)+'</td>'+
												'<td>'+html.data[i].ID_TRANS+'</td>'+
												'<td>'+html.data[i].TGL_TRANS+' '+html.data[i].WKT_TRANS+'</td>'+
												'<td>'+html.data[i].TOT_BAY+'</td>'+
												'<td><a href="<?php echo base_url().'user_checkout/detailcheckout/';?>'+html.data[i].NO_TRANS+'" target="_blank" class="btn btn-success">Detail</a></td>'+
											'</tr>';
							}
							else{
								var str =	"<tr style='font-size:13px;text-align:center;background-color:white'>"+
												'<td>'+(i+1)+'</td>'+
												'<td>'+html.data[i].ID_TRANS+'</td>'+
												'<td>'+html.data[i].TGL_TRANS+' '+html.data[i].WKT_TRANS+'</td>'+
												'<td>'+html.data[i].STS_TANGGAP+' dari '+html.data[i].JUM_TOKO+' toko</td>'+
												'<td>'+html.data[i].STS_RESI+' dari '+html.data[i].JUM_TOKO+' toko</td>'+
												'<td>'+html.data[i].TOT_BAY+'</td>'+
												'<td><a href="<?php echo base_url().'user_checkout/detailcheckout/';?>'+html.data[i].NO_TRANS+'" target="_blank" class="btn btn-success">Detail</a></td>'+
											'</tr>';
							}
							$('.outdata').append(str);
						};
					}
					else if(html.status == 'no'){
						var str =	'<tr>'+
										'<td colspan=7><center>Tidak ada transaksi</center></td>'+
									'</tr>';
						$('.outdata').append(str);
					}
				}
			});
		});
	})
</script>