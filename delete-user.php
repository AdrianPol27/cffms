<?php

	include('db/connector.php');
	include('models/user-facade.php');

	$userFacade = new UserFacade;

	if (isset($_GET["id"])) {
		$id = $_GET["id"];
    $deletedBy = $_GET["deleted_by"];
    $deletedOn = date("Y-m-d");
		$deleteUser = $userFacade->deleteUser($id, $deletedBy, $deletedOn);

		if ($deleteUser) {
			header("Location: users.php?delete_user=User has been deleted successfully!");
		}
	}

?>