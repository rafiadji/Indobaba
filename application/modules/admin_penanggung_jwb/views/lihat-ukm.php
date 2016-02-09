<table id="example1" class="table table-bordered table-striped">

        <thead>

        	<tr>

				<th>

					Nama UKM

				</th>

				<th>

					Aksi

				</th>

			</tr>

        </thead>

       <?php if($ukm): ?>

	<?php foreach($ukm as $data_ukm): ?>
	<tr>
		<td>
			<?php echo $data_ukm->NM_TOKO ?>
		</td>
		<td>
			<div class="btn-group">
				<a href="<?php echo base_url('admin_ukm/editUkm/'.base64_encode_fix($data_ukm->ID_TOKO)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Detail</a>
			</div>
		</td>
	</tr>

	<?php endforeach; ?>

	<?php endif; ?>

        </table>
        <script type="text/javascript">
        	$(function() {

        $("#example1").dataTable();

    });
        </script>