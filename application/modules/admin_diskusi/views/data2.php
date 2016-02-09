<div style="width:100%;height:450px;overflow: scroll;" id="polo">
            <?php foreach($tampilkomentar as $row): ?>
                <?PHP if($row->LEVEL == 2): ?>
                    <div style="width:100%; float:left">
                    <div style="min-height: 50px;border: 1px solid #E0EDFF;float: right;min-width: 25%;padding: 20px;    background-color: #FFFFFF;border-radius: 8px;margin-left:5px">
                       <label><?php echo $nmtoko;?></label> </br>
                        <?PHP echo $row->ISI_PESAN;?> </br></br>
                        <p style="font-size:9pt;"><i><label>Tanggal dan Waktu : </label> <?PHP echo $row->TGL_PESAN;?></i></p>
                    </div>
                    </div>
                <?php endif;?>
                 <?PHP if($row->LEVEL == 1): ?>
                    <div style="width:100%; float:left">
                    <div style="min-height: 50px;border: 1px solid #E0EDFF;float: left;min-width: 25%;padding: 20px;background-color: #E0EDFF;border-radius: 8px;margin-right:5px">
                       <label>Anda</label> </br>
                        <?PHP echo $row->ISI_PESAN;?> </br></br>
                        <p style="font-size:9pt;"><i><label>Tanggal dan Waktu : </label> <?PHP echo $row->TGL_PESAN;?></i></p>
                    </div>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
<script>
    $( document ).ready(function() {
    var element = document.getElementById("polo");
    element.scrollTop = element.scrollHeight;
    
   
});
</script>