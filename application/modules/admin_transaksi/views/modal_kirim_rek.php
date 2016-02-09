<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kirim Ke Rekening</h4>
      </div>
      <form id="rekening">
          <input type="hidden" name="toko" value="<?php echo $id_toko; ?>">
          <input type="hidden" name="trans" value="<?php echo $id_trans; ?>">
      <?php $cek = $this->db->query("SELECT * FROM mp_kirim_rekening WHERE ID_TRANSAKSI='$id_trans' AND ID_TOKO='$id_toko'")->row(); ?>
      <div class="modal-body">
      <div class="form-group">
          <label>Bank Tujuan</label>
          <select name="bank_tujuan" class="form-control">
          <?php 
          $bank = $this->db->query("SELECT * FROM view_rekening WHERE ID_PEMILIK='$id_toko'")->result(); 
          foreach ($bank as $ba) 
          {
          ?>
            <option <?php if($cek){ if($cek->ID_REKENING==$ba->ID_REKENING) echo "selected=''"; } ?> value="<?php echo $ba->ID_REKENING; ?>"><?php  echo $ba->ATAS_NAMA." - ".$ba->BANK ?> ( <?php  echo $ba->NO_REKENING ?> )</option>
          <?php
          }
          ?>
          </select>
      </div>
      </div>
      <div class="modal-footer">
        <a href="#" onclick="do_kirim_rek()" class="btn btn-success">Kirim</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
      <script type="text/javascript">
        function do_kirim_rek(id_toko,id_trans) {
        $.ajax( {
                type :"POST",
                url :"<?php echo site_url('admin_transaksi/do_kirim_rek'); ?>",
                cache :false,
                data:$("#rekening").serialize(),
                success : function(msg) {
                  alert("Success");
                  window.location.reload();
                },
                error : function() {
                   alert("Error");
                }
            });
        return false;
      }
      </script>
    </div>
  </div>
</div>