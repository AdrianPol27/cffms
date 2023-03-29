<?php

	include('db/connector.php');
	include('models/weight-facade.php');

	$weightFacade = new WeightFacade;

	if (isset($_GET["plu_num"])) {
		$PLUNum = $_GET["plu_num"];
    $deletedBy = $_GET["deleted_by"];
    $deletedOn = date("Y-m-d");
		$deleteWeight = $weightFacade->deleteWeight($PLUNum, $deletedBy, $deletedOn);

		if ($deleteWeight) {
			header("Location: weight.php?delete_weight=Weight has been deleted successfully!");
		}
	}

?>