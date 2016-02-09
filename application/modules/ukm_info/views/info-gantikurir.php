
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
        			<div class="well well-sm">
        				Pilih kurir yang mendukung pengiriman dari tempat anda
        			</div>
        			
        			<form method="POST">
                    <table class="table table-border table-striped">
                    	
                    	<tr>
                    		<td>
                    			<input type="checkbox" <?php if($kurir->JNE==1) echo 'checked'; ?> name="jne" value="jne"/>
                    		</td>
                    		<td>
                    			<img style="width:100px" src="<?php echo base_url('assets/images/ekspedisi/jne.png') ?>"/>
                    		</td>
                    		<td>
                    			Nugraha Eka Kurir
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>
                    			<input type="checkbox" <?php if($kurir->POS==1) echo 'checked'; ?> name="pos" value="pos"/>
                    		</td>
                    		<td>
                    			<img style="width:100px" src="<?php echo base_url('assets/images/ekspedisi/pos.png') ?>"/>
                    		</td>
                    		<td>
                    			Pos Indonesia
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>
                    			<input type="checkbox" <?php if($kurir->TIKI==1) echo 'checked'; ?> name="tiki" value="tiki"/>
                    		</td>
                    		
							<td>
                    			<img style="width:100px" src="<?php echo base_url('assets/images/ekspedisi/tiki.png') ?>"/>
                    		</td>
                    		<td>
                    			Satu Titipan Kilat
                    		</td>
                    	</tr>
                    </table>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-default btn-lg">

                </form>
        		</div>
        	</div>
                
        </div>