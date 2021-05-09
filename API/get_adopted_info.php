<?php

require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

// Returns all of the posts published by the user that is logged in.


if ($_SESSION) {

    $stmt=$pdo->prepare('SELECT posts.ID,posts.title,users.firstname,users.lastname,users.email FROM posts LEFT JOIN users ON users.ID=posts.owner_ID');
	$stmt->execute([]);

	die(json_encode($stmt->fetchAll()));


    // Returning the USER Information:
    // die(json_encode(['title'=>$posts['title']]));
}
else {
    die(json_encode(['status'=>-1]));
}