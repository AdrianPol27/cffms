<?php

	include('db/connector.php');
	include('models/plu-facade.php');

	$PLUFacade = new PLUFacade;

	if (isset($_GET["plu_num"])) {
		$PLUNum = $_GET["plu_num"];
    $deletedBy = $_GET["deleted_by"];
    $deletedOn = date("Y-m-d");
		$deletePLU = $PLUFacade->deletePLU($PLUNum, $deletedBy, $deletedOn);

		if ($deletePLU) {
			header("Location: plu.php?delete_plu=PLU has been deleted successfully!");
		}
	}

?>