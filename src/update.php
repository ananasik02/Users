<?php
 
include 'partials/header.php';
require 'users.php';

if(!isset($_GET['id'])){
	include "partials/not-found.php";
	exit;

}
$userId = $_GET['id'];
$user = getUserById($userId);

if(!$user){
	include "partials/not-found.php";
	exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$user = updateUser($_POST, $userId);

	uploadImage($_FILES['picture'], $user);
	header("Location: index.php");

}



?>
<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Update User: <b> <?php echo $user['name'] ?> </b></h3>
		</div>
		<div class="card-body">
			<?php include '_form.php' ?>
		</div>
	</div>
</div>