<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Settings About</li>
</ol>

<?php 
	$modelAbout = new Model_mysqli();
	$modelAbout->setTable("info_about");


	if (isset($_POST["btnSimpan"])) {
		$profile = $_POST["profile"];
		$strategi = $_POST["strategi"];
		$visi = $_POST["visi"];
		$misi = $_POST["misi"];

		if (!empty(trim($profile)) && !empty(trim($strategi)) && !empty(trim($visi)) ) {
			$data = array(
							"profile" 	=> 	$profile,
							"strategi"	=>	$strategi,
							"visi"	=>	$visi,
							"misi"	=>	$misi,
						);
			$updateAbout = $modelAbout->update(1,$data);
            if($updateAbout){
                echo "<script> alert('Data berhasil di simpan'); </script>";
                echo "<script> document.location.href = '?menu=about'; </script>";
            }      
		} else {
			$errorFormData = Helper::spanDanger("Profile, Strategi, Visi atau Misi tidak boleh kosong..!");
            $errorFormData .=  "<br><br>";
		}
	}

	$getByIdAbout = $modelAbout->getById(1);
?>

<div class="card border-primary">
<form action="" method="POST">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4">
				<button type="submit" name="btnSimpan" class="btn btn-primary">Update About <i class="fa fa-hand-o-up"></i></button>
			</div>
			<div class="col-md-6">
				<div id="inputMessage">
					<?php echo isset($errorFormData) ? $errorFormData : ""; ?>	
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="card border-success">
					<div class="card-header"><b>Profile</b></div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="profile" rows="5" required class="form-control"><?php echo $getByIdAbout["profile"]; ?></textarea>
						</div>
					</div>
				</div>				
			<br>
			</div>
			<div class="col-md-6">
				<div class="card border-primary">
					<div class="card-header"><b>Strategi</b></div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="strategi" rows="5" required class="form-control"><?php echo $getByIdAbout["strategi"]; ?></textarea>
						</div>
					</div>
				</div>		
				<br>
				<div class="card border-warning">
					<div class="card-header"><b>Tujuan</b></div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="tujuan" rows="5" required class="form-control"><?php echo $getByIdAbout["tujuan"]; ?></textarea>
						</div>
					</div>
				</div>		
			</div>
			<div class="col-md-6">
				<div class="card border-info">
					<div class="card-header"><b>Visi</b></div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="visi" rows="5" required class="form-control"><?php echo $getByIdAbout["visi"]; ?></textarea>
						</div>
					</div>
				</div>	
				<br>	
				<div class="card border-danger">
					<div class="card-header"><b>Misi</b></div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="misi" rows="5" required class="form-control"><?php echo $getByIdAbout["misi"]; ?></textarea>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</form>
</div>
