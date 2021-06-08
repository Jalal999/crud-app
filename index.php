<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
	<?php 
		require_once "pdo.php";
		require_once "process.php"; 
	?>

	<?php if(isset($_SESSION['message'])): ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>


		</div>
	<?php endif ?>

	<?php 
		$result = $pdo->query("SELECT * FROM data");
	?>
	<div class="container">
	<div class="row justify-content-center">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Location</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
		<?php 
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				echo "<tr><td>";
				echo htmlentities($row['name']);
				echo "</td><td>";
				echo htmlentities($row['location']);
				echo "</td><td>";
				echo '<a href="index.php?edit='.$row['id'].'" class="btn btn-info">Edit</a>';
				echo " ";
				echo '<a href="process.php?delete='.$row['id'].'" class="btn btn-danger">Delete</a>';
				echo "</td></tr>";
			}
		?>
		</table>


	</div>

	<?php
		function pre_r($array){
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		}

	 ?>
	<div class="row justify-content-center">
	<form method="post" action="process.php">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" value = "<?php echo $name ?>"placeholder="Enter your name" class="form-control">
		</div>
		<div class="form-group">
			<label>Location</label>
			<input type="text" name="location" value = "<?php echo $location ?>" placeholder="Enter your location" class="form-control">
		</div>
		<div class="form-group">
		<?php if($update == true): ?>
			<button type="submit" name="update" class="btn btn-info">Update</button>
		<?php else: ?>
			<button type="submit" name="save" class="btn btn-primary">Save</button>
		<?php endif; ?>
		</div>
	</form>
	</div>
	</div>
</body>
</html>