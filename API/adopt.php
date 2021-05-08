<?php
require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    adopt($pdo);
}

function adopt ($pdo) {

    // Getting the post information and saving it in $post
    $stmt = $pdo->prepare('SELECT * FROM posts WHERE ID=?');
    $stmt->execute([$_SESSION['user/ID']]);
    $post=$stmt->fetch();

    // Checking to see if we have the right post
    // die(json_encode(['Title'=>$post['title']]));

    // Updating the post, but changing adopted from 0 (false) to 1 (true)
    $stmt = $pdo->prepare('UPDATE posts SET title = ?, description = ?, image = ?, date = ?, user_ID =?, adopted=? WHERE posts.ID =?');
	$stmt->execute([$post['title'],$post['description'],$post['image'],$post['date'],$post['user_ID'], 1, $post['ID']]);
	die(json_encode(['status'=>1,'message'=>'Successfully Adopted Pet']));
}
