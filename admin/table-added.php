<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin - Add New Table</title>
	<link rel="stylesheet" href="../style/normalize.css">
	<link rel="stylesheet" href="../style/main.css">

</head>
<body>

	<div id="wrapper">

		<?php include('menu.php');?>


		<h2>Add New Table</h2>

		<?php

	//if form has been submitted process it
		if(isset($_POST['submit'])){

			$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
			extract($_POST);

		//very basic validation
			if($postTitle ==''){
				$error[] = 'Please enter the table name.';
			}


			if(!isset($error)){

				try {

				//insert into database
					$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS `".$postTitle."` (
  `catID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catTitle` varchar(255) DEFAULT NULL,
  `catSlug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`catID`)
") ;
					$stmt->execute(array(
						':name' => $postTitle
					
					));

				//redirect to index page
					header('Location: table-added.php');
					exit;

				} catch(PDOException $e) {
					echo $e->getMessage();
				}

			}

		}

	//check for any errors
		if(isset($error)){
			foreach($error as $error){
				echo '<p class="error">'.$error.'</p>';
			}
		}
		?>

<h2>Table added!</h2>
		<form action='' method='post'>

			<p><label>Table Name</label><br />
				<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

						<p><input type='submit' name='submit' value='Submit'></p>

					</form>

				</div>