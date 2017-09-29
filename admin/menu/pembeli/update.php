<?php 
    $model = new Model_mysqli();
    $model->setTable("pembeli");

    $action = explode("/", $_GET["menu"]); // check url palng akhir
    $getById = $model->getById($action[2]);

    if (( $admin["role"] == "admin" && $admin["id"] != $getById["user_id"])) {
        echo "<script> window.location.href = '?menu=pembeli'; </script>";
    }
?>

<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/property/admin/">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="<?php echo $backRedirect; ?>">Data Pembeli</a>
    </li>
    <li class="breadcrumb-item active">Update Data</li>
</ol>


<?php 

    if (isset($_POST["btnSimpan"])) {
        $id = $_POST["id"];
        $nama_pembeli = $_POST["nama_pembeli"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $umur = $_POST["umur"];
        $pekerjaan = $_POST["pekerjaan"];
        $alamat = $_POST["alamat"];
    
        $data = array(
                    "nama"  	=>  trim($nama_pembeli),
                    "jenis_kelamin"   =>  $jenis_kelamin,
                    "umur"    	=>  $umur,
                    "pekerjaan"	=>	$pekerjaan,
                    "alamat"	=>	$alamat,
                );

        if (!empty(trim($nama_pembeli)) && !empty(trim($jenis_kelamin)) && !empty(trim($umur)) && !empty(trim($pekerjaan)) && !empty(trim($alamat)) ) { 
                $Update = $model->update($id,$data);
                if($Update){
                    echo "<script> alert('Data berhasil di simpan'); </script>";
                    echo "<script> document.location.href = '".$backRedirect."' </script>";
                }            } else {
            $errorFormData = Helper::spanDanger("Nama, Jenis kelamin, Umur, Pekerjaan atau Alamat tidak boleh kosong..!");
            $errorFormData .=  "<br><br>";
        }
    }

    if ($getById == null) {
        echo "<span class='text-danger'>Data yang anda pilih tidak ada.!!</span><br><br>";
    }


?>

<div class="card border-light mb-3">
    <div class="card-header text-success"> Form <i class="fa fa-plus"></i> Update Data</div>
    <div class="card-body">
        <form action="" method="post">
            <div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
            <div class="row">
                <div class="col-md-6">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $getById["id"]; ?>">
						<label>Nama</label>
						<input type="text" name="nama_pembeli"  value="<?php echo $getById["nama"]; ?>" required class="form-control">
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jenis_kelamin" required class="form-control">
									<option value="">--Pilih Jenis Kelamin--</option>
									<option value="laki-laki" <?php echo $getById["jenis_kelamin"] == "laki-laki" ? "selected" : ""; ?>>Laki - laki</option>
									<option value="perempuan" <?php echo $getById["jenis_kelamin"] == "perempuan" ? "selected" : ""; ?>>Perempuan</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Umur</label>
								<input type="number" name="umur" value="<?php echo $getById["umur"]; ?>" min="0" max="200" required class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Pekerjaan</label>
						<input type="text" name="pekerjaan" value="<?php echo $getById["pekerjaan"]; ?>" required class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" id="alamat" rows="4" required class="form-control"><?php echo $getById["alamat"]; ?></textarea>
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