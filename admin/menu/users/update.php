<?php 
    if ($admin["role"] != "super_admin") {
        echo "<script> window.location.href = '?menu=users'; </script>";
    }
?>

<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/property/admin/">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="<?php echo $backRedirect; ?>">Users</a>
    </li>
    <li class="breadcrumb-item active">Update Data</li>
</ol>

<?php 
    $model = new Model_mysqli();
    $model->setTable("users");

    $action = explode("/", $_GET["menu"]); // check url palng akhir
    $getById = $model->getById($action[2]);

    if ($getById == null) {
        echo "<span class='text-danger'>Data yang anda pilih tidak ada.!!</span><br><br>";
    }

    if (isset($_POST["btnSimpan"])) {
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $password = $_POST["password"];
        $file_photo = $_FILES["photo"];
        $role = $_POST["role"];

        $data = array(
                    "nama"  =>  trim($nama),
                    // "password"   =>  $password,
                    "role"    =>  $role,
                );

        $file_name = explode(".",$file_photo["name"]);
        $file_name = sha1(uniqid()).".".end($file_name);
        $path = "upload/users/".basename($file_name);
        $imageFileType = pathinfo($path,PATHINFO_EXTENSION);
          
        if ($file_photo["tmp_name"] !== "") {
            $allowType = array("jpg","jpeg","png","gif");
            if (!in_array($imageFileType,$allowType)) {
                $error = Helper::spanDanger("Format gambar tidak di boleh kan...")."<br>";
                $error .= Helper::spanDanger("yang di bolehkan adalah jpg,jpeg,png dan gif..");
            } else {
                if ($file_photo["size"] > (1000 * 1024)) {
                    $error = Helper::spanDanger("Ukuran gambar ke gedean..");
                } else {
                    if (file_exists("upload/users/".$getById["photo"]) && $getById["photo"]) {
                        unlink("upload/users/".$getById["photo"]);
                    }

                    $data["photo"] = $file_name;
                    move_uploaded_file($file_photo["tmp_name"],$path);
                }
            }
        }

        if(!isset($error)) {
            if (!empty(trim($nama)) && !empty(trim($role))) {   
                if (!empty(trim($password))) {
                    $data["password"] = md5($password);
                }

                $update = $model->update($id,$data);
                if($update){
                    // echo $update."<br>";
                    echo "<script> alert('Data berhasil di simpan'); </script>";
                    echo "<script> document.location.href = '".$backRedirect."' </script>";
                }
            } else {
                $errorFormData = "<span class='text-danger'>Nama atau role tidak boleh kosong..!</span>";
                $errorFormData .=  "<br><br>";
            }
        }
    }

?>

<div class="card border-light mb-3">
    <div class="card-header text-info"> Form <i class="fa fa-edit"></i> Update Data</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $getById["id"]; ?>">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $getById['nama']; ?>" placeholder="Nama User" required>
                        <div id="errorFirstname"></div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" disabled value="<?php echo $getById['email']; ?>" placeholder="Email">
                        <div id="errorEmail"></div>
                        <div id="errorCheckEmail"></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div id="errorPassword"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Photo</label>
                        <br>
                        <?php $img = $getById["photo"] == "" ? "img/user_image.png" : "upload/users/".$getById["photo"]; ?>
                        <img src="<?php echo $img; ?>" class="img-responsive img-thumbnail" style="width:100px; height:100px;">
                    </div>
                    <div class="form-group">
                        <label id="labelPhoto">Ganti Photo</label>
                        <input type="file" class="form-control" id="inputPhoto" name="photo">
                        <div><?php echo isset($error) ? $error : ""; ?></div>
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select name="role" class="form-control" id="inputRole" required>
                        <option value="">--Pilih Role--</option>
                        <option value="admin" <?php echo $getById['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="super_admin" <?php echo $getById['role'] == 'super_admin' ? 'selected' : ''; ?>>Super Admin</option>
                      </select>
                      <div id="errorRole"></div>
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