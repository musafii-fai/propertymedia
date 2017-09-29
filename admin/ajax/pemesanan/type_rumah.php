<?php 

	$model = new Model_mysqli();
	$model->setTable("rumah");

	if ($model->isPost()) {
		$id_type = $_POST["type_rumah"];
		$where = array("kategori_id" => $id_type);
		$orderBy = array("nama" => "ASC");
        $result = $model->findData(false,$where,$orderBy);

        $model->setTable("rumah_kategori");
		$getById = $model->getById($id_type);
		if ($result) {
			$model->response->status = true;
			$model->response->message = "Data rumah kategori Type berdasarkan Id";
			$model->response->data = $result;
		} else {
			$model->response->message = Helper::spanDanger("Rumah dengan type ".$getById["type"]." kosong..!");
			$model->response->data = $result;
		}

		$model->json();
	}


 ?>