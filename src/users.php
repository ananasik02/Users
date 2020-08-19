<?php

function getUsers(){
	return json_decode(file_get_contents('users.json'), true);
}

function getUserById($id){

	$users = getUsers();
	foreach ($users as $user){
		if($user['id']==$id){
			return $user;
		}
	}

	return null;

}

function createUser($data){

	$users = getUsers();
	$data['id'] = rand(1000000, 2000000);
	$users[] = $data;
	putJson($users);


	return $data;

}

function updateUser($data, $id){

	$updatedUser = [];

	$users = getUsers();
	foreach ($users as $i=>$user) {
		if($user['id']==$id){
			$users[$i] = array_merge($user, $data);
			$updatedUser = $users[$i];
		}
	}
	putJson($users);

	return $updatedUser;

}

function deleteUser($id){

	$users = getUsers();
	foreach ($users as $i => $user) {
	 	if($user['id'] == $id){
	 		array_splice($users, $i, 1);
	 	}
	}

	putJson($users);

	return $users;

}


function uploadImage($file, $user){

	if(isset($_FILES['picture']) && $_FILES['picture']['name']){
		// if(!is_dir(filename: __DIR__."/images")){
		// 	mkdir(pathname:__DIR__."/images");
		// }
		$fileName = $_FILES['picture']['name'];
		$fileExt = explode('.', $fileName);
		$extension = strtolower(end($fileExt));
		move_uploaded_file($_FILES['picture']['tmp_name'], __DIR__."/images/${user['id']}.$extension");

		$user['extension'] = $extension;
		updateUser($user, $user['id']);
	}
}

function putJson($users){
	file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}