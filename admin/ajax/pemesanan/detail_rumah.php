<?php 

	$model = new Model_mysqli();
	$model->setTable("rumah");
	$modelKategori = new Model_mysqli();
	$modelKategori->setTable("rumah_kategori");
	$modelBlok = new Model_mysqli();
	$modelBlok->setTable("rumah_blok");

	if ($model->isPost()) {
		$id_rumah = $_POST["rumah"];
        $result = $model->getById($id_rumah);
		if ($result) {
			$model->response->status = true;
			$model->response->message = "Data rumah berdasarkan Id";

			$type = $modelKategori->getById($result["kategori_id"]);
			$result["type"] = $type["type"];
			$result["harga"] = "Rp.".number_format($result["harga"],0,",",".");
			$result["blok_jumlah"] = $modelBlok->findData(false,array("rumah_id" => $id_rumah));
			$model->response->data = $result;
		} else {
			$model->response->message = Helper::spanDanger("Data sudah tidak ada, atau sudah di hapus.!");
			$model->response->data = $result;
		}

		$model->json();
	}

?>