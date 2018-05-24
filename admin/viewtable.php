<?php require('../includes/config.php'); 

$tableid = $_GET['tablename']; ?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Blog - <?php echo $tableid;?></title>
		<link rel="stylesheet" href="style/normalize.css">
		<link rel="stylesheet" href="style/main.css">
	</head>
	<body>

		<div id="wrapper">

			<h1>Blog</h1>
			<hr />
			<p><a href="./">Blog Index</a></p>


		<?php
			try {

				$stmt = $db->query("SELECT postID
	FROM information_schema.COLUMNS
	WHERE TABLE_SCHEMA = DATABASE()
	AND TABLE_NAME = `".$tableid."`
	ORDER BY ORDINAL_POSITION");
				while($row = $stmt->fetch()){
					
					while($row = $stmt->fetch()){
				echo $row['postID'];
			}
				}

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>




		</div>

	</body>
	</html>