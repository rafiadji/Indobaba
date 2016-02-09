
<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

	<?php endif; ?>


<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<?php echo anchor("ukm_info/tambahRekening/","Tambah Rekening",array("class" => "btn btn-primary btn-lg btn-block"));?>

				</div>
				<table class="table table-bordered" id="example1">
			<thead>
            <tr>
                <th>Nama Bank</th>

                <th>No Rekening</th>
				
				<th>Atas Nama</th>

                <th>Aksi</th>
            </tr>
            </thead>
			<tbody>
            <?php foreach($tampil as $row):?>

                <tr>
                    <td><?php echo $this->infomodel->nama_bank($row->ID_BANK);?></td>
                    <td><?php echo $row->NO_REKENING;?></td>
					<td><?php echo $row->ATAS_NAMA;?></td>
                    <td>
                    	<div class="btn-group">
                    		<?php echo anchor("ukm_info/editRekening/$row->ID_REKENING","<i class='fa fa-pencil'></i> Edit",array("class" => "btn btn-info"));?>
                    		<?php echo anchor("ukm_info/hapusRekening/$row->ID_REKENING","<i class='fa fa-trash'></i> Hapus",array("class" => "btn btn-danger",'onClick' => "return confirm('Hapus Rekening $row->NO_REKENING ?')"));?>
                       	</div>
                    </td>                

                </tr>

            <?php endforeach;?>
			</tbody>
        </table>
			</div>
		</div>
        
</div>
<script type="text/javascript">

    $(function() {

        $("#example1").dataTable();

    });

</script>