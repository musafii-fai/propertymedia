<!-- Breadcrumbs -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/property/admin/">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="?menu=users">Users</a>
    </li>
    <li class="breadcrumb-item active">Profile</li>
</ol>

<?php 
    $model = new Model_mysqli();
    $model->setTable("users");

    
    $id = $admin["id"];
    $getById = $model->getById($id);

    if ($getById == null) {
        echo "<span class='text-danger'>Data yang anda pilih tidak ada.!!</span><br><br>";
    }

    if (isset($_POST["btnSimpan"])) {
        $id = $admin["id"];
        $nama = $_POST["nama"];
        $passwordSekarang = $_POST["passwordSekarang"];
        $passwordBaru = $_POST["passwordBaru"];
        $confirmPassword = $_POST["confirmPassword"];
        $file_photo = $_FILES["photo"];

        $data = array(
                    "nama"  =>  trim($nama),
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
                if ($file_photo["size"] > (2000 * 1024)) {
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
            if (!empty(trim($nama))) {   
                 if (!empty(trim($passwordSekarang))) {
                    if (md5($passwordSekarang) != $admin["password"]) {
                        $errorPasswordSekarang = Helper::spanDanger("Password Sekarang Salah.!");
                    } else {
                        if (empty(trim($passwordBaru)) && empty(trim($confirmPassword))) {
                            $errorPasswordBaru = Helper::spanDanger("Password Baru atau Confirm Password tidak boleh kosong.!!");
                        } else {
                            if ($confirmPassword != $passwordBaru) {
                                $errorPasswordBaru = Helper::spanDanger("Opps, Password Baru atau Confirm Password tidak sama.!!");
                            } else {
                                $data["password"] = md5($passwordBaru);
                                $update = $model->update($id,$data);
                                if($update){
                                    echo "<script> alert('Data berhasil di update'); </script>";
                                    echo "<script> document.location.href = '?menu=users/profile' </script>";
                                }
                            }
                        }
                    } 
                } else {
                    if (!empty(trim($passwordBaru)) || !empty(trim($confirmPassword))) {
                        $errorPasswordSekarang = Helper::spanDanger("Password Sekarang harus di isi.!");
                    } else {
                        $update = $model->update($id,$data);
                        if($update){
                            echo "<script> alert('Profile berhasil di update'); </script>";
                            echo "<script> document.location.href = '?menu=users/profile' </script>";
                        }
                    }
                }
            } else {
                $errorFormData = "<span class='text-danger'>Nama atau role tidak boleh kosong..!</span>";
                $errorFormData .=  "<br><br>";
            }
        }
    }

?>

<div class="card border-success mb-3">
    <div class="card-header text-info"><i class="fa fa-user"></i> Profile</div>
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
                    </div>
                    <div class="form-group">
                        <label>Password Sekarang</label>
                        <input type="password" class="form-control" name="passwordSekarang" placeholder="Password">
                        <div><?php echo isset($errorPasswordSekarang) ? $errorPasswordSekarang : ""; ?></div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Password Baru</label>
                          <input type="password" class="form-control" name="passwordBaru" placeholder="Password">
                        </div>
                        <div class="col-md-6">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password">
                        </div>
                      </div>
                      <div><?php echo isset($errorPasswordBaru) ? $errorPasswordBaru : ''; ?></div>
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
                </div>
            </div>
            <hr>
            <button type="submit" name="btnSimpan" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo $backRedirect; ?>" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Batal</a>
        </form>
    </div>
</div>