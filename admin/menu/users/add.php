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
      <a href="?menu=users">Users</a>
    </li>
    <li class="breadcrumb-item active">Tambah Data</li>
</ol>

<?php 
    $model = new Model_mysqli();
    $model->setTable("users");

    if (isset($_POST["btnSimpan"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $file_photo = $_FILES["photo"];
        $role = $_POST["role"];

           
    
        $checkEmail = $model->getByWhere(array("email" => $email));
        if ($checkEmail) {
            $errorFormData = "<span class='text-danger'>Opps, Email Sudah Terdaftar..!</span>";
            $errorFormData .=  "<br><br>";
        } else {
            $data = array(
                        "nama"  =>  trim($nama),
                        "email"   =>  $email,
                        "password"   =>  md5($password),
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
                    if ($file_photo["size"] > (2000 * 1024)) {
                        $error = Helper::spanDanger("Ukuran gambar ke gedean..");
                    } else {
                        $data["photo"] = $file_name;
                        move_uploaded_file($file_photo["tmp_name"],$path);
                    }
                }
            }
            if(!isset($error)) {
                if (!empty(trim($nama)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($role))) { 
                        $tambah = $model->insert($data);
                        if($tambah){
                            // echo $tambah."<br>";
                            echo "<script> alert('Data berhasil di simpan'); </script>";
                            echo "<script> document.location.href = '?menu=users' </script>";
                        }            } else {
                    $errorFormData = "<span class='text-danger'>Nama, email, password atau role tidak boleh kosong..!</span>";
                    $errorFormData .=  "<br><br>";
                }
            }
        }
    }

?>

<div class="card border-light mb-3">
    <div class="card-header text-info"> Form <i class="fa fa-plus"></i> Tambah Data</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo isset($nama) ? $nama : ""; ?>" placeholder="Nama User" required>
                        <div id="errorFirstname"></div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : ""; ?>" placeholder="Email" required>
                        <div id="errorEmail"></div>
                        <div id="errorCheckEmail"></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : ""; ?>" placeholder="Password" required>
                        <div id="errorPassword"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="labelPhoto">Photo</label>
                        <input type="file" class="form-control" id="inputPhoto" name="photo">
                        <div><?php echo isset($error) ? $error : ""; ?></div>
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select name="role" class="form-control" id="inputRole" required>
                        <option value="">--Pilih Role--</option>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                      </select>
                      <div id="errorRole"></div>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" name="btnSimpan" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a href="?menu=users" class="btn btn-warning btn-lg"><i class="fa fa-ban"></i> Batal</a>
        </form>
    </div>
</div>