<?php
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

// The issue is that while the action "signup" is passed into this, it is being seen as null.
// isset($_GET['action']) is false
// Action seems to always be null for some reason?

if(isset($_GET['action']) && $_GET['action']=='signout' && isset($_SESSION['user/ID'])){
	session_destroy();
	die(json_encode(['status'=>1,'message'=>'You have been signed out']));
}

if(isset($_SESSION['user/ID'])) die(json_encode(['status'=>-1,'message'=>'The user is already logged.']));

if(count($_POST)>0){
	switch($_POST['action']){
		case 'signin':
			signin($_POST['email'],$_POST['password']);
			break;
		case 'signup':
			// die(json_encode(['isset'=>isset($_GET['action']), 'action'=>$_GET['action']]));
			signup($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);
			break;
	}
}
die(json_encode(['status'=>-1,'message'=>'This route is invalid']));


function signin($email, $password){
	require(__DIR__.'/lib_db.php');

	// Check if the user is in the database
	$query=$pdo->prepare('SELECT ID,password,is_admin FROM users WHERE email=?');
	$query->execute([$email]);

	if($query->rowCount()==0){
		die(json_encode(['status'=>-1,'message'=>'The user does not exist. Please, sign up.']));
	}
	//Check whether the password is correct
	$user=$query->fetch();
	if(password_verify($password, $user['password'])){

		// die(json_encode(['action'=>$_GET['action'],'message'=>'Welcome to our website']));

		$_SESSION['user/ID']=$user['ID'];
		$_SESSION['user/is_admin']=$user['is_admin'];

		// die(json_encode(['Logged in?'=>$_SESSION['user/ID']]));

		die(json_encode(['status'=>1,'message'=>'Welcome to our website']));

	}else{
		die(json_encode(['status'=>-1,'message'=>'The email or password are incorrect']));
	}
}

function signup($email, $password, $firstname, $lastname){
	require(__DIR__.'/lib_db.php');

	// Check if they already have an account
	$query=$pdo->prepare('SELECT ID FROM users WHERE email=?');
	$query->execute([$email]);

	// die(json_encode(['Email'=>$email, 'Password'=>$password]));

	if($query->rowCount()>0){
		echo 'The user already exists. Please, sign in.';
		return;
	}

	//Add the user to the database
	$query=$pdo->prepare('INSERT INTO users (email, password, firstname, lastname) VALUES (?,?,?,?)');
	
	$query->execute([$email, password_hash($password, PASSWORD_DEFAULT), $firstname, $lastname]);

	die(json_encode(['status'=>1,'message'=>'Your has been registered']));
	//echo 'Your account has been created. Please, sign in.';
}
