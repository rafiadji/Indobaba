<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Masukan Jumlah Yang Tersedia</h4>
      </div>
      <form id="simpan">
      <input type="hidden" name="id" value="<?php echo $transaksi; ?>">
      <input type="hidden" name="id_toko" value="<?php echo $id_toko; ?>">
      <div class="modal-body">
       <table border="1">
                <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>QTY</th>
                  <th>Berat @</th>
                  <th>Harga @</th>
                  <th>QTY Tersedia</th>
                </tr>
                <?php 
                $no=1;
                foreach ($tampil as $detail) { ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $detail->NM_PRODUK; ?></td>
                    <td><?php echo $detail->QTY; ?></td>
                    <td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY); ?></td>
                    <td><?php echo formatRp($detail->HARGA_PER); ?></td>
                    <td>
                    <input type="text" name="tersedia[]">
                    <input type="hidden" name="id_produk[]" value="<?php echo $detail->ID_PRODUK; ?>">
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  
                </tr>
              </table>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Simpan" class="btn btn-success">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
    <?php $g=base64_encode_fix($transaksi); ?>
    <script type="text/javascript">
       $("#simpan").submit( function() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/updateRealisasi'); ?>",
            cache :false,
            data: $( "#simpan" ).serialize(),
            success : function(msg) {
              alert("Berhasil.");
              //window.location.reload();
            },
            error : function() {
               
            }
        });
    return false;
    });
    </script>
  </div>
</div>
