<?php 
    if ($admin["role"] != "super_admin") {
        echo "<script> window.location.href = '?menu=rumah_kategori'; </script>";
    }
?>

<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/property/admin/">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="<?php echo $backRedirect; ?>">Rumah Kategori</a>
    </li>
    <li class="breadcrumb-item active">Update Data</li>
</ol>


<?php 
    $model = new Model_mysqli();
    $model->setTable("rumah_kategori");

    if (isset($_POST["btnSimpan"])) {
        $id = $_POST["id"];
        $type = $_POST["type"];
        $luas = $_POST["luas"];
        $description = $_POST["description"];
    
        $data = array(
                    "type"  =>  trim($type),
                    "luas"   =>  $luas,
                    "description"    =>  $description,
                );

        if (!empty(trim($type)) && !empty(trim($luas)) && !empty(trim($description)) ) { 
            $Update = $model->update($id,$data);
            if($Update){
                echo "<script> alert('Data berhasil di simpan'); </script>";
                echo "<script> document.location.href = '".$backRedirect."' </script>";
            }           
        } else {
            $errorFormData = Helper::spanDanger("Type, luas, atau description tidak boleh kosong..!");
            $errorFormData .=  "<br><br>";
        }
    }

        $action = explode("/", $_GET["menu"]); // check url palng akhir
        $getById = $model->getById($action[2]);

        if ($getById == null) {
            echo "<span class='text-danger'>Data yang anda pilih tidak ada.!!</span><br><br>";
        }


?>

<div class="card border-success mb-3">
    <div class="card-header text-success"> Form <i class="fa fa-plus"></i> Update Data</div>
    <div class="card-body">
        <form action="" method="post">
            <div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $getById["id"]; ?>">
                        <div class="form-row">
                            <div class="col-md-2">
                                <label>Type</label>
                            </div>
                            <div class="col-md-10">
                                <i class="text-info">*contoh: 21, 21/60, 21/72, 36, 36/60, 36/72 dll.</i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="type" value="<?php echo $getById["type"]; ?>" placeholder="Type Rumah   *contoh: 21/60" required>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-2">
                                <label>Luas</label>
                            </div>
                            <div class="col-md-10">
                                <i class="text-info">*contoh: 6m x 3,5m = 21 m2, 6m x 10m = 60 m2 dll.</i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="luas" value="<?php echo $getById["luas"]; ?>" placeholder="Luas Rumah   *contoh: 6m x 10m = 60 m2" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Penjelasan Ringkas Type Rumah"><?php echo $getById["description"]; ?></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" name="btnSimpan" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo $backRedirect; ?>" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Batal</a>
        </form>
    </div>
</div>