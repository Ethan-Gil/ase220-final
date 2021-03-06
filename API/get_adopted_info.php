<?php

require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

// API used to get the list of users that have adopted animals.
// Specifically used by member's page.

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