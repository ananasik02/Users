<?php 
include 'partials/header.php';
require 'users.php';

$user = [
	'name'=>'',
	'username' => '',
	'email' => '',
	'phone' => '',
	'website' => '',
];

$errors = [
	'name' => "",
	'username' => "",
	'email' => "",
	'phone' => "",
	'website' => ""

];
$isValid = true;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$user = array_merge($user, $_POST);

	if(!$user['name']){
		$isValid = false;
		$errors['name'] = 'The name is mandatory';

	}
	if(!$user['username'] || strlen($user['username'])<6 || strlen($user['username'])>16){
		$isValid = false;
		$errors['username'] = 'The username is required and it must be more then 6 and less then 16 characters';

	}
	if($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)){
		$isValid = false;
		$errors['email'] = 'The email is invalid';
	}
	if($user['phone'] && !filter_var($user['phone'], FILTER_VALIDATE_INT)){
		$isValid = false;
		$errors['phone'] = 'The phone is invalid';
	}

	if($isValid){
		$user = createUser($_POST);
		uploadImage($_FILES['picture'], $user);	
		header("Location: index.php");
	}
}

?>

<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Create User:</h3>
		</div>
		<div class="card-body">
			 <?php include '_form.php' ?>
		</div>
	</div>
</div>