<?php
require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    adopt($pdo, $_PUT);
}

function adopt ($pdo, $_PUT) {

    // Updating the post, but changing adopted from 0 (false) to 1 (true)
    $stmt = $pdo->prepare('UPDATE posts SET owner_ID=? WHERE posts.ID =?');
	$stmt->execute([$_SESSION['user/ID'], $_PUT['ID']]);

	die(json_encode(['status'=>1,'message'=>'Successfully Adopted Pet']));

}
