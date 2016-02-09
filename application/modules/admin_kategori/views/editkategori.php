



<form method="POST" action="<?php echo base_url();?>admin_kategori/editKategoriSubmit/<?php echo $id;?>">



    <table>

        <tr>

            <td>Nama Kategori</td>

            <td><input type="text" name="nama_kategori" value="<?php echo $tampil->KATEGORI;?>"></td>

            

        </tr>

       

        <tr>

            <td></td>

            <td><input type="submit" name="simpan_kategori" value="Simpan"></td>

        </tr>

    </table>

</form>