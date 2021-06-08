<?php 

	require_once "pdo.php";
	session_start();

	$id = 0;
	$name = '';
	$location = '';
	$update = false;

	if (isset($_POST['save'])){
		$name = $_POST['name'];
		$location = $_POST['location'];


		$sql = $pdo->prepare("INSERT INTO data (name, location) VALUES (:nm, :lo)");

		$sql->execute(array(
						':nm' => $name,
						':lo' => $location
		));

		$_SESSION['message'] = "Record has been saved!";
		$_SESSION['msg_type'] = "success";

		header('Location: index.php');
		return;

	}

	if (isset($_GET['delete'])){
		$id = $_GET['delete'];
		$sql=$pdo->prepare("DELETE FROM data WHERE id = :id");
		$sql->execute(array(
						':id' => $id
		));

		$_SESSION['message'] = "Record has been deleted!";
		$_SESSION['msg_type'] = "danger";

		header('Location: index.php');
		return;

	}

	if (isset($_GET['edit'])){
		$id = $_GET['edit'];
		$update = true;
		$result = $pdo->query("SELECT * FROM data WHERE id=$id");
		$row=$result->fetch(PDO::FETCH_ASSOC);
		if($row!==false){	
			$name = $row['name'];
			$location = $row['location'];
		}
	}

	if (isset($_POST['update'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$location = $_POST['location'];


		$stmt = $pdo->query("UPDATE data SET name = '$name', location = '$location' WHERE id = $id");

		$_SESSION['message'] = "Record has been updated";
		$_SESSION['msg_type'] = "warning";

		header('Location: index.php');
		return;
	}
 ?>