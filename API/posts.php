<?php
require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');


switch($_SERVER['REQUEST_METHOD']){
	case 'GET':
		if(isset($_GET['id'])) detail($pdo);
		else index($pdo);
		break;
	case 'POST': 
		create($pdo);
		break;
	case 'PUT':
		parse_str(file_get_contents("php://input"),$_PUT);
		edit($pdo,$_PUT);
		break;
	case 'DELETE':
		parse_str(file_get_contents("php://input"),$_DELETE);
		delete($pdo,$_DELETE['id']);
		break;
}

function index($pdo){
	$stmt=$pdo->prepare('SELECT ID,title,date FROM posts');
	$stmt->execute([]);
	die(json_encode($stmt->fetchAll()));
}

function detail($pdo){
	$stmt = $pdo->prepare('SELECT ID,title,description,image,date,user_ID,owner_ID FROM posts WHERE ID=?');
	$stmt->execute([$_GET['id']]);
	$post=$stmt->fetch();

	// Checking if the user is logged in
	$post['logged'] = isset($_SESSION['user/ID']);

	if(isset($_SESSION['user/ID']) && ($post['user_ID']==$_SESSION['user/ID'] || $_SESSION['user/is_admin']==1)) $post['manage']=1;
	else $post['manage']=0;
	die(json_encode($post));
}

function create($pdo){
	if(!isset($_SESSION['user/ID'])) die(json_encode(['status'=>-1,'message'=>'This page is for registered users only. Please <a href="auth.php">Sign in</a>.']));
	if(count($_POST)>0){
		$stmt = $pdo->prepare('INSERT INTO posts (title, description, image, date, user_ID) VALUES (?,?,?,?,?)');
		$stmt->execute([$_POST['title'], $_POST['description'], $_POST['image'], $_POST['date'], $_SESSION['user/ID']]);
		die(json_encode(['status'=>1,'message'=>'Successfully created post!']));
	}
}

function edit($pdo,$_PUT){
	if(count($_PUT)>0){
		$stmt = $pdo->prepare('UPDATE posts SET title = ?, description = ?, image = ?, date = ?, user_ID =? WHERE posts.ID =?');
		$stmt->execute([$_PUT['title'],$_PUT['description'],$_PUT['image'],$_PUT['date'],$_PUT['user_ID'],$_PUT['ID']]);
		die(json_encode(['status'=>1,'message'=>'Your data has been saved']));
	}
	die(json_encode(['status'=>-1,'message'=>'Your data was not saved']));
}

function delete($pdo,$id){
	$stmt = $pdo->prepare('SELECT * FROM posts WHERE ID=?');
	$stmt->execute([$id]);
	$post=$stmt->fetch();
	if(!isset($_SESSION['user/ID']) || $post['user_ID']!=$_SESSION['user/ID']) die(json_encode(['status'=>-1,'message'=>'You don\'t have the rights for this action']));
	$stmt = $pdo->prepare('DELETE FROM posts WHERE ID=?');
	$stmt->execute([$id]);
	die(json_encode(['status'=>1,'message'=>'The post has been deleted']));
}