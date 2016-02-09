



<form method="POST" action="<?php echo base_url();?>admin_kategori/editSubKategoriSubmit/<?php echo $id;?>">

<?php foreach($tampil as $row): ?>

    <table>

        <tr>

            <td>Nama Kategori</td>

            <td><input type="text" name="nama_subkategori" value="<?php echo $row->SUB_KATEGORI;?>"></td>

            

        </tr>

        <tr>

            <td>Kategori</td>

            <td>

                

                <select name="kategori">

                    <?php foreach($kategori as $row_kategori): ?>

                        <option value="<?php echo $row_kategori->ID_KATEGORI?>" <?php if($row_kategori->ID_KATEGORI == $row->ID_KATEGORI): echo "selected"; endif; ?>><?php echo $row_kategori->KATEGORI;?></option>

                    <?php endforeach;?>

                </select>

                

            </td>

        </tr>

       

        <tr>

            <td></td>

            <td><input type="submit" name="simpan_kategori" value="Simpan"></td>

        </tr>

    </table>

<?php endforeach;?>

</form>