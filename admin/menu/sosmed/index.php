<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Settings Sosial Media</li>
</ol>

<?php 
	$modelAbout = new Model_mysqli();
	$modelAbout->setTable("info_about");


	if (isset($_POST["btnSimpan"])) {
		$facebook = $_POST["facebook"];
		$facebook = str_replace("https://", "", $facebook);
		$facebook = str_replace("http://", "", $facebook);
		$twitter = $_POST["twitter"];
		$twitter = str_replace("https://", "", $twitter);
		$twitter = str_replace("http://", "", $twitter);
		$instagram = $_POST["instagram"];
		$instagram = str_replace("https://", "", $instagram);
		$instagram = str_replace("http://", "", $instagram);

		if (!empty(trim($facebook)) && !empty(trim($twitter)) && !empty(trim($instagram)) ) {
			$data = array(
							"facebook" 	=> 	"https://".$facebook,
							"twitter"	=>	"https://".$twitter,
							"instagram"	=>	"https://".$instagram,
						);
			$updateAbout = $modelAbout->update(1,$data);
            if($updateAbout){
                echo "<script> alert('Data berhasil di simpan'); </script>";
                echo "<script> document.location.href = '?menu=sosmed'; </script>";
            }      
		} else {
			$errorFormData = Helper::spanDanger("facebook, Twitter, atau instagram tidak boleh kosong..!");
            $errorFormData .=  "<br><br>";
		}
	}

	$getByIdAbout = $modelAbout->getById(1);
?>

<div class="card border-light">
	<form action="" method="POST">
		<div class="card-header text-success">Data Sosial Media</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-8">
					<div>
						<?php echo isset($errorFormData) ? $errorFormData : ""; ?>		
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" name="facebook" class="form-control" value="<?php echo $getByIdAbout["facebook"]; ?>" placeholder="Facebook" required>
					</div>
					<div class="form-group">
						<label>Twitter</label>
						<input type="text" name="twitter" class="form-control" value="<?php echo $getByIdAbout["twitter"]; ?>" required placeholder="Twitter" >
					</div>
					<div class="form-group">
						<label>Instagram</label>
						<input type="text" name="instagram" class="form-control" value="<?php echo $getByIdAbout["instagram"]; ?>" required placeholder="Instagram" >
					</div>
					<button type="submit" name="btnSimpan" class="btn btn-primary">Update Sosial Media <i class="fa fa-hand-o-up"></i></button>
				</div>
			</div>
		</div>
	</form>
</div>