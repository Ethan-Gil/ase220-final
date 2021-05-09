<?php

require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

// API used to get all of the animals that the current user has adopted.
// Specifically used by dashboard page.

if ($_SESSION) {

    $stmt=$pdo->prepare('SELECT users.firstname, users.lastname, users.email, posts.title, posts.ID FROM users LEFT JOIN posts ON users.ID=posts.owner_ID WHERE users.ID=?');
	$stmt->execute([$_SESSION['user/ID']]);

	die(json_encode($stmt->fetchAll()));


    // Returning the USER Information:
    // die(json_encode(['title'=>$posts['title']]));
}
else {
    die(json_encode(['status'=>-1]));
}