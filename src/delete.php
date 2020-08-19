<?php

include 'partials/header.php';
require 'users.php';

// if(!isset($_GET['id'])){
// 	include "partials/not-found.php";
// 	exit;

// }
// $userId = $_GET['id'];
// $user = getUserById($userId);

// if(!$user){
// 	include "partials/not-found.php";
// 	exit;
// }

// $userId = $_GET['id'];
// deleteUser($userId);

// header("Location: index.php");

if(!isset($_POST['id'])){
	include "partials/not-found.php";
	exit;

}
$userId = $_POST['id'];
deleteUser($userId);

header("Location: index.php");