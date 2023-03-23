<?php

	include('db/connector.php');
	include('models/weight-facade.php');

	$weightFacade = new WeightFacade;

	if (isset($_GET["plu_num"])) {
		$PLUNum = $_GET["plu_num"];
		$deleteWeight = $weightFacade->deleteWeight($PLUNum);

		if ($deleteWeight) {
			header("Location: weight.php?delete_weight=Weight has been deleted successfully!");
		}
	}

?>