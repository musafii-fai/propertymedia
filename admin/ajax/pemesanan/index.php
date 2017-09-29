<?php 

	$model = new Model_mysqli();
	$model->setTable("penjualan");
	$modelRumah = new Model_mysqli();
	$modelRumah->setTable("rumah");
	$modelBlok = new Model_mysqli();
	$modelBlok->setTable("rumah_blok");
	$modelPembeli = new Model_mysqli();
	$modelPembeli->setTable("pembeli");

	if ($model->isPost()) {
		$nama_pembeli = $_POST["nama_pembeli"];
		$jenis_kelamin = $_POST["jenis_kelamin"];
		$umur = $_POST["umur"];
		$pekerjaan = $_POST["pekerjaan"];
		$alamat = $_POST["alamat"];

		$id_rumah = isset($_POST["rumah"]) ? $_POST["rumah"] : "";
		$blok_rumah = isset($_POST["blok_rumah"]) ? $_POST["blok_rumah"] : "";
		$no_rumah = $_POST["no_rumah"];

		if (empty(trim($nama_pembeli)) || empty(trim($jenis_kelamin)) || empty(trim($umur)) || empty(trim($pekerjaan)) || empty(trim($alamat)) || empty(trim($id_rumah)) || empty(trim($blok_rumah)) || empty(trim($no_rumah)) ) {
			if (empty(trim($nama_pembeli))) {
				$model->response->error->nama_pembeli = Helper::spanDanger("Nama Pembeli harus di isi.!");
			} else { $model->response->error->nama_pembeli = ""; }

			if (empty(trim($jenis_kelamin))) {
				$model->response->error->jenis_kelamin = Helper::spanDanger("Jenis Kelamin harus di isi.!");
			} else { $model->response->error->jenis_kelamin = ""; }

			if (empty(trim($umur))) {
				$model->response->error->umur = Helper::spanDanger("Umur harus di isi.!");
			} else { $model->response->error->umur = ""; }

			if (empty(trim($pekerjaan))) {
				$model->response->error->pekerjaan = Helper::spanDanger("Pekerjaan harus di isi.!");
			} else { $model->response->error->pekerjaan = ""; }

			if (empty(trim($alamat))) {
				$model->response->error->alamat = Helper::spanDanger("Alamat harus di isi.!");
			} else { $model->response->error->alamat = ""; }

			if (empty(trim($id_rumah))) {
				$model->response->error->id_rumah = Helper::spanDanger("Rumah harus di isi.!");
			} else { $model->response->error->id_rumah = ""; }

			if (empty(trim($blok_rumah))) {
				$model->response->error->blok_rumah = Helper::spanDanger("Blok Rumah harus di isi.!");
			} else { $model->response->error->blok_rumah = ""; }

			if (empty(trim($no_rumah))) {
				$model->response->error->no_rumah = Helper::spanDanger("No Rumah harus di isi.!");
			} else { $model->response->error->no_rumah = ""; }
		} else {
			$resultBlok = $modelBlok->findData(false,array("rumah_id" => $id_rumah));
			$totalRumah = null;
			foreach ($resultBlok as $val) {
				$totalRumah += intval($val["jumlah"]);
			}

			$whereBlokNoRumah = array("rumah_id" => $id_rumah,"blok_rumah" => $blok_rumah,"no_rumah" => $no_rumah);
			$checkBlokNoRumah = $model->getByWhere($whereBlokNoRumah);
			if ($checkBlokNoRumah) {
				$model->response->message = "Blok dan no rumah terdaftar.";
				$model->response->error->blokNoRumah = Helper::spanDanger("Blok dan No Rumah sudah terdaftar, Silahkan pilih yang lain.!");
			} else {
				$countPenjualanRumahId = $model->getCount(array("rumah_id" => $id_rumah));
				if ($countPenjualanRumahId >= $totalRumah) {
					$model->response->message = "Pemesanan melebihi total rumah";
					$model->response->error->totalRumah = Helper::spanDanger("Rumah yang dipilih sudah melebihi total rumah yang tersedia.!<br>Silahkan pilih rumah yang lain..!");
				} else {
					$jumlahBlok = $modelBlok->getByWhere(array("rumah_id" => $id_rumah,"blok" => $blok_rumah));
					if ($no_rumah > $jumlahBlok["jumlah"]) {
						$model->response->message = "No Rumah melebihi jumlah blok rumah";
						$model->response->error->noRumahBlok = Helper::spanDanger("No Rumah melebihi jumlah blok rumah yang tersedia.!<br>Silahkan pilih no rumah yang lain..!");
					} else {
						$countJumlahBlokPenjualan = $model->getCount(array("rumah_id" => $id_rumah, "blok_rumah" => $blok_rumah));
						if ($countJumlahBlokPenjualan >= $jumlahBlok["jumlah"]) {
							$model->response->message = "Rumah yang di pilih melebihi jumlah blok rumah";
							$model->response->error->jumlahRumahBlok = Helper::spanDanger("Rumah yang dipilih sudah melebihi jumlah blok rumah yang tersedia.!<br>Silahkan pilih rumah yang lain..!");
						} else {
							$dataPembeli = array(
												"user_id"	=>	$admin["id"],
												"nama"		=>	$nama_pembeli,
												"jenis_kelamin"	=>	$jenis_kelamin,
												"umur"		=>	$umur,
												"alamat"	=>	$alamat,
												"pekerjaan"	=>	$pekerjaan,
											);	
							$idPembeli = $modelPembeli->insert($dataPembeli);
							$dataPenjualan = array(
												"user_id"		=>	$admin["id"],
												"rumah_id"		=>	$id_rumah,
												"pembeli_id"	=>	$idPembeli,
												"blok_rumah"	=>	$blok_rumah,
												"no_rumah"		=>	$no_rumah,
											);
							$insertPenjualan = $model->insert($dataPenjualan);
							if ($insertPenjualan) {
								$model->response->status = true;
								$model->response->message = Helper::alertSuccess("Pemesanan rumah berhasil di prosess..!");
							} else {
								$model->response->message = Helper::alertDanger("Gagal, prosess pemesanan rumah..!!!");
							}
						}
					}	
				}
			}
		}

		$model->json();
	}

?>