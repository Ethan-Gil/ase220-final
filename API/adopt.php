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

    // Getting the user information and saving it in $user
    $stmt = $pdo->prepare('SELECT * FROM users WHERE ID=?');
    $stmt->execute([$_SESSION['user/ID']]);
    $user=$stmt->fetch();

    // Checking to see if we have the right post
    // die(json_encode(['Title'=>$post['title']]));

    // todo: logic for multiple pets. THIS NEEDS TO BE TESTED.
    // todo: Make sure to change this in the MYSQL execute statement below. Line 41, change $post['title'] to $pets.
    if ($user['adopted_animals'] == null) {
        $pets = $post['title'];
    }
    else {
        $pets = $pets + ', ' + $post['title'];
    }

    // Updating the post, but changing adopted from 0 (false) to 1 (true)
    $stmt = $pdo->prepare('UPDATE posts SET title = ?, description = ?, image = ?, date = ?, user_ID =?, adopted=? WHERE posts.ID =?');
	$stmt->execute([$post['title'], $post['description'], $post['image'], $post['date'], $post['user_ID'], 1, $post['ID']]);
	//die(json_encode(['status'=>1,'message'=>'Successfully Adopted Pet']));

    // Updating the user's adopted animals
    $stmt = $pdo->prepare('UPDATE users SET email = ?, password = ?, firstname = ?, lastname = ?, adopted_animals =?, is_admin=? WHERE users.ID =?');
	$stmt->execute([$user['email'], $user['password'], $user['firstname'], $user['lastname'], $post['title'], $user['is_admin'], $user['ID']]);
    die(json_encode(['status'=>1, 'message'=>'Successfully Adopted Pet']));    


}
