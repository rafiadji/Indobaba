<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Riwayat Pembelian</h4>
      </div>
      <div class="modal-body">
      <form id="cok" method="POST">
            <?php 
    $pjs=0;
    $tg=0;
    $aslitot=0;
    foreach ($toko as $tok) {
     ?>
    <div class="panel panel-default">
      <div class="panel-body">
      <?php if($tok->STS_TAMPIL==0){ ?>
      <a href="#" onclick="detailBatal('<?php echo $id; ?>',<?php echo $tok->ID_TOKO; ?>)" class="btn btn-warning">Lihat Detail</a>
      <?php } ?>
      <h3><?php echo $tok->NM_TOKO ?></h3>
      <?php if($tok->STATUS_TERSEDIA==1)
        { ?>
      <input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">
        <?php } ?>
      <div class="form-group">
        <p><?php echo $tok->ALAMAT_TOKO ?> ( <?php echo $tok->NO_TELP_TOKO ?> )</p>
        
      </div>
      <hr/>
      <?php
      $datanya = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();
      $tot_harga=0;
      $tot_ongkir=0;
      $pj_tot=0;
      $web_tot=0;
      $ongkir=0;
      $ongkirbatal=0;
      $ku_web=0;
      $ku_pj=0;
      $tot_harga2=0;
      $tot_asli=0;
      ?>
      
      <p>Bila Tersedia Sebagian : 
        <?php
        if($tok->STATUS_TERSEDIA==1)
        {
          echo "Kirim yang tersedia";
        }
        else if($tok->STATUS_TERSEDIA==0)
        {
          echo "Batalkan Transaksi";
        }
        ?>
      </p>
      
      <?php foreach($datanya as $deta){
      ?>
        <h4>Info Penerima</h4>
        Nama : <?php echo $deta->NAMA_PENERIMA; ?><BR>
        Alamat : <?php echo $deta->ALAMAT_PENERIMA; ?><BR>
        Telp : <?php echo $deta->NO_HP_PENERIMA; ?><br><br>
      <?php
      $ongkirsemuaasli=0;
      $ongkirsemuapalsu=0;
      $variable = $this->db->query("SELECT * FROM view_trans_batal GROUP BY ID_ONGKIR")->result();
      foreach ($variable as $key ) 
      {
      $haha = $this->db->query("SELECT COUNT(*) AS A FROM view_trans_batal WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->row();
      if($haha->A>0)
      {
        $ongkirsemuaasli+=$key->HARGA_ONGKIR;
          $ongkirsemuapalsu+=$key->HARGA_ONGKIR;

        $lala=$this->db->query("SELECT * FROM view_trans_batal WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();
      ?>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jumlah Dipesan</th>
            <th>Berat Satuan</th>
            <th>Total Berat</th>
            <th>Harga Satuan</th>
            <?php if($tok->STATUS_TERSEDIA==1){ ?>
            <th>Stok Tersedia</th>
            <?php } ?>
            <th>Total Harga Dipesan</th>
            <th>Keu WEB</th>
            <th>Keu PJ</th>
          </tr>
            </thead>
             <tbody>
            <?php 
            $no = 1;
            $tot_web=0;
            $tot_pj=0;
            $tot_akh=0;
            $tot_akh_ongkir=0;
            $tot_akh2=0;
            $totalasli=0;
            foreach($lala as $detail){ ?>
            <tr>
              <td><?php echo $no++; ?></td>
            <td><?php echo $detail->NM_PRODUK; ?></td>
            <td><?php echo $detail->QTY; ?></td>
            <td><?php echo konversiGram($detail->BERAT_PRODUK); ?></td>
            <td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY_TERSEDIA); ?></td>
            <td><?php echo formatRp($detail->HARGA_PER); ?></td>
            <?php if($tok->STATUS_TERSEDIA==1){ 
              $tp = "text";
              $dp = "";
            }
            else
            {
              $tp = "hidden";
              $dp ="style='display:none;'";
            }?>
            <td <?php echo $dp; ?>>
            <?php 
            if($key->STS_TANGGAP==1)
            {
              $read = "readonly=''";
            }
            else
            {
              $read = "";
            }
            ?>
              <input type="<?php echo $tp; ?>" value="<?php echo $detail->QTY_TERSEDIA; ?>" id="qtytersedia[]" class="qtysedia<?php echo $detail->ID_CART; ?> nuaa" onkeyup="qtysedia(<?php echo $detail->QTY; ?>,<?php echo $detail->ID_CART; ?>)"  name="qtytersedia<?php echo $tok->ID_TOKO ?>[]" <?php echo $read; ?> required/>  
            </td>
            <?php
             $totharga2 = $detail->HARGA_PER*$detail->QTY_TERSEDIA; 
            ?>
            <td><?php 
            $tot_akh2 += $totharga2;
            echo formatRp($totharga2); 
            ?></td>
            <td>
            <?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
                $keuntungan1 =($keu->KEUNTUNGAN_UKM/100)*$totharga2;
                $tot_web+=$keuntungan1;
                echo formatRp($keuntungan1);
            ?>
            </td>
            <td>
            <?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
                $keuntungan2 =($keu->KEUNTUNGAN_PJ/100)*$totharga2;
                $tot_pj+=$keuntungan2;
                echo formatRp($keuntungan2);
            ?>
            </td>
            <?php  $asli = $detail->HARGA_PER*$detail->QTY;  $totalasli+=$asli;  //echo $asli; ?>
            
            <input type="hidden" value="<?php echo $detail->ID_CART; ?>" id="cart" class="cart[]" name="cart<?php echo $tok->ID_TOKO ?>[]" required/>
          <tr>
            <?php } ?>
             </tbody>
             <tfoot>
              <tr>
                <?php if($tok->STATUS_TERSEDIA==1){ ?>
                <td colspan="7">Jumlah</td>
                <?php }
                else{ ?>
                <td colspan="6">Jumlah</td>
                <?php } ?>
                <td><?php $tot_harga2+=$tot_akh2; echo formatRp($tot_akh2);?></td>
                <td><?php $ku_web += $tot_web; echo formatRp($tot_web); ?></td>
                <td><?php $ku_pj += $tot_pj; echo formatRp($tot_pj);  ?></td>
                <?php $tot_asli += $totalasli; //echo $totalasli;  ?>
                
                
              </tr>
              <tr>
                <?php if($tok->STATUS_TERSEDIA==1){ ?>
                <td colspan="10" style="color:black;font-size:12pt">
                <?php }
                else{ ?>
                <td colspan="8" style="color:black;font-size:12pt">
                <?php } ?>
                <b>
                Ongkir <?php echo strtoupper($key->NAMA_KURIR)." - ".$key->PAKET_YANG_DIAMBIL; ?>
              <?php if($tok->STATUS_TERSEDIA==1)
            { ?>
              <input type="hidden" name="ongkir[]" value="<?php echo $key->ID_ONGKIR; ?>">
              <?php } ?><?php 
              $ongkir+=$key->HARGA_ONGKIR; 
              $ongkirbatal+=$key->HARGA_ONGKIR; 
              ?>
                <?php
              echo "(".formatRp($key->HARGA_ONGKIR).")";
               ?>
               </b>

                
               </td>
              </tr>
             </tfoot>
            </table>
        </table>
        <br>
             <?php
         }
    }
    $okr = $ongkirsemuaasli-$ongkirsemuapalsu;
    ?>
            

    <hr/>
    
      <?php 
      }
      ?>

            <div class="row">
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Total Ongkir
                  </div>
                  <div class="panel-body">
                    <h2><?php  
                    echo formatRp($ongkir); ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Tagihan Untuk pembeli
                  </div>
                  <div class="panel-body">
                    <h2><?php 
                    $tg+=$tot_harga2+$ongkir;
                    echo formatRp($tot_harga2+$ongkir); ?></h2>
                  </div>
                </div>
              </div>
          <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Dibayar Ke UKM
                  </div>
                  <div class="panel-body">
                    <h2><?php echo formatRp(($tot_harga2+$ongkir)-($ku_web+$ku_pj)); ?></h2>
                  </div>
                </div>
              </div>
              <?php 
                $aslitot+=$tot_asli+$ongkir+$okr;
               ?>
            </div>
            
      </div>
    </div>
    <?php
    }
    ?>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>