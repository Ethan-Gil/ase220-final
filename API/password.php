<?php
require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    password($pdo, $_PUT);
}

function password ($pdo, $_PUT) {

    $stmt = $pdo->prepare('UPDATE users SET password=? WHERE users.email =?');
	$stmt->execute([password_hash($_PUT['password'], PASSWORD_DEFAULT), $_PUT['email']]);

	die(json_encode(['status'=>1,'message'=>'Successfully changed password']));

}
