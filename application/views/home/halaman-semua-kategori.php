<div class="container">
	<div class="row">
		<?php foreach($tampilkategori as $kategori): ?>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<h1><?php echo $kategori->KATEGORI ?></h1>
						<ul>
							<?php foreach($this->db->query('select * from mp_sub_kategori WHERE ID_KATEGORI="'.$kategori->ID_KATEGORI.'"')->result() as $row_sub):?>
                            <li><?php $link = setPermalink($row_sub->ID_SUB_KATEGORI,$row_sub->SUB_KATEGORI);echo anchor("home_controller/kategori/$link",$row_sub->SUB_KATEGORI);?></li>
                        	<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
