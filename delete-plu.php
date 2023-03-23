<?php

	include('db/connector.php');
	include('models/plu-facade.php');

	$PLUFacade = new PLUFacade;

	if (isset($_GET["plu_num"])) {
		$PLUNum = $_GET["plu_num"];
		$deletePLU = $PLUFacade->deletePLU($PLUNum);

		if ($deletePLU) {
			header("Location: plu.php?delete_plu=PLU has been deleted successfully!");
		}
	}

?>