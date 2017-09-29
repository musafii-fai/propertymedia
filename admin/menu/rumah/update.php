<?php 
    if ($admin["role"] != "super_admin") {
        echo "<script> window.location.href = '?menu=rumah'; </script>";
    }
?>

<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/property/admin/">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="<?php echo $backRedirect; ?>">Rumah</a>
    </li>
    <li class="breadcrumb-item active">Update</li>
</ol>

<?php 
    $model = new Model_mysqli();
    $model->setTable("rumah");
    $modelBlok = new Model_mysqli();
    $modelBlok->setTable("rumah_blok");


    $action = explode("/", $_GET["menu"]); // check url palng akhir
    $getById = $model->getById($action[2]);

    if ($getById == null) {
        echo "<span class='text-danger'>Data yang anda pilih tidak ada.!!</span><br><br>";
    }

    if (isset($_POST["btnSimpan"])) {
        $file_photo = $_FILES["photo"];
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $kategori = $_POST["kategori"];
        $harga = $_POST["harga"];
        $lokasi = $_POST["lokasi"];

        if (!isset($_POST["blok"]) && !isset($_POST["jumlah"])) {
            $errorBlokJumlah = Helper::spanDanger("Eit..etiss..!!<br>Blok dan jumlah rumah belum di isi..<br>Silahkan klik tombol tambah warna hijau di atas.!");
        } else {
            $blok = $_POST["blok"];
            $jumlah = $_POST["jumlah"];

            $data = array(
                        "nama"          =>  trim($nama),
                        "kategori_id"   =>  $kategori,
                        "harga"         =>  $harga,
                        "lokasi"        =>  $lokasi,
                    );

            $file_name = explode(".",$file_photo["name"]);
            $file_name = sha1(uniqid()).".".end($file_name);
            $path = "upload/rumah/".basename($file_name);
            $imageFileType = pathinfo($path,PATHINFO_EXTENSION);
              
            if ($file_photo["tmp_name"] !== "") {
                $allowType = array("jpg","jpeg","png","gif");
                if (!in_array($imageFileType,$allowType)) {
                    $errorPhoto = Helper::spanDanger("Format gambar tidak di boleh kan...")."<br>";
                    $errorPhoto .= Helper::spanDanger("yang di bolehkan adalah jpg,jpeg,png dan gif.!");
                } else {
                    if ($file_photo["size"] > (2010 * 1024)) {
                        $errorPhoto = Helper::spanDanger("Ukuran gambar ke gedean.! <br>");
                        $errorPhoto = Helper::spanDanger("Max 2 mb saja.!");
                    } else {
                        if (file_exists("upload/rumah/".$getById["photo"]) && $getById["photo"]) {
                            unlink("upload/rumah/".$getById["photo"]);
                        }

                        $data["photo"] = $file_name;
                        move_uploaded_file($file_photo["tmp_name"],$path);
                    }
                }
            }

            if(!isset($errorPhoto)) {
                if (!empty(trim($nama)) && !empty(trim($lokasi))) {   
                    $update = $model->update($id,$data);
                    if($update){
                        $modelBlok->deleteWhere(array("rumah_id" => $id));
                        for ($i=0; $i < count($blok); $i++) { 
                            $dataBlok = array(
                                            "rumah_id"  =>  $id,
                                            "blok"  =>  $blok[$i],
                                            "jumlah"    =>  $jumlah[$i],
                                        );
                            $modelBlok->insert($dataBlok);
                        }
                        echo "<script> alert('Update data berhasil di prosess.'); </script>";
                        echo "<script> document.location.href = '".$backRedirect."' </script>";
                    }
                } else {
                    $errorFormData = "<span class='text-danger'>Nama atau Lokasi tidak boleh kosong..!</span>";
                    $errorFormData .=  "<br><br>";
                }
            }
        }
    }

    // var_dump($_POST);

?>

<div class="card border-light mb-3">
    <div class="card-header text-success"> Form <i class="fa fa-plus"></i> Update Data</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Photo</label>
                                <br>
                                <?php $img = $getById["photo"] == "" ? "img/omah_omahan.png" : "upload/rumah/".$getById["photo"]; ?>
                                <img src="<?php echo $img; ?>" class="img-responsive img-thumbnail" style="width:100px; height:100px;">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label id="labelPhoto">Ganti Photo</label>
                                <input type="file" class="form-control" id="inputPhoto" name="photo">
                                <div><?php echo isset($error) ? $error : ""; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="id" value="<?php echo $getById["id"]; ?>">
                        <input type="text" class="form-control" name="nama" value="<?php echo $getById["nama"]; ?>" placeholder="Nama Rumah" required>
                        <div><?php echo isset($errorNama) ? $errorNama : ""; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="kategori" required class="form-control">
                            <option value="">--Pilih Type Rumah--</option>
                            <?php 
                                $modelKategori = new Model_mysqli();
                                $modelKategori->setTable("rumah_kategori");

                                $result = $modelKategori->findData(false,false,array("type" => "ASC"));
                            ?>
                            <?php foreach($result as $val) : ?>
                                    <option value="<?php echo $val['id']; ?>" <?php echo $getById["kategori_id"] == $val["id"] ? "selected" : ""; ?>><?php echo $val["type"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" value="<?php echo $getById["harga"]; ?>" required placeholder="Harga">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Lokasi</label>
                      <textarea name="lokasi" class="form-control" rows="3" required placeholder="Lokasi Perumahan"><?php echo $getById["lokasi"]; ?></textarea>
                    </div>

                    <label>Blok & Jumlah Rumah</label> 
                    <button type="button" id="btnAddBlokJumlah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                    <div class="card">
                        <div class="card-body">
                            <div id="errorBlokJumlah"><?php echo isset($errorBlokJumlah) ? $errorBlokJumlah : ""; ?></div>
                            <div id="contentWrap">
                                <?php 
                                    $resultBlok = $modelBlok->findData(false,array("rumah_id" => $getById["id"]));
                                    foreach ($resultBlok as $val) {
                                 ?>
                                <div class="input-group" style="margin-bottom: 10px;" id="field-1">
                                    <input type="text" name="blok[]" value="<?php echo $val["blok"]; ?>" class="form-control" id="blok" placeholder="Blok Rumah">
                                    <input type="number" name="jumlah[]" value="<?php echo $val["jumlah"]; ?>" min="0" class="form-control" id="jumlah" placeholder="Jumlah Rumah">
                                    <span style="background-color: #dc3545;" class="input-group-addon btn btn-outline-danger remove" id="btnRemove"><i class="fa fa-times"></i></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <hr>
            <button type="submit" name="btnSimpan" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo $backRedirect; ?>" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Batal</a>
        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        /* for blok & jumlah rumah */
        no = 0;
        $("#btnAddBlokJumlah").click(function() {
            no++;
            inputGroup = $('<div class="input-group" style="margin-bottom: 10px;" id="field-'+no+'">');
            blok = $(' <input type="text" name="blok[]" class="form-control" id="blok" placeholder="Blok Rumah" required>');
            jumlah = $('<input type="number" name="jumlah[]" min="0" class="form-control" id="jumlah" placeholder="Jumlah Rumah"> required');
            spanRemove = $('<span style="background-color: #dc3545;" class="input-group-addon btn btn-outline-danger remove" id="btnRemove"><i class="fa fa-times"></i></span>');

            inputGroup.append(blok);
            inputGroup.append(jumlah);
            inputGroup.append(spanRemove);

            $("#contentWrap").append(inputGroup);

            $("#errorBlokJumlah").html("");
        });

        $("#contentWrap").on("click","span.remove",function(event) {
            event.preventDefault();
            $(this).parent().remove();
        });

    });

</script>