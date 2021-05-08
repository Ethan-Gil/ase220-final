<?php

require(__DIR__.'/lib_db.php');
require(__DIR__.'/lib_session.php');
header('Content-type: application/json');


// // Getting the current USER ID
// echo "Current User: ";
// echo($_SESSION['user/ID']);

// // Getting the current USER Email
// $stmt = $pdo->prepare('SELECT * FROM users WHERE ID=?');
// $stmt->execute([$_SESSION['user/ID']]);
// $user=$stmt->fetch();

// echo $user['email'];

// die(json_encode(['session'=>$_SESSION == true]));


// isset($_SESSION) always seems to evaluate to true
if ($_SESSION) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE ID=?');
    $stmt->execute([$_SESSION['user/ID']]);
    $user=$stmt->fetch();

    // Returning the USER Information:
    die(json_encode(['ID'=>$user['ID'], 'email'=>$user['email'], 'firstname'=>$user['firstname'], 'lastname'=>$user['lastname'], 
    'adopted_animals'=>$user['adopted_animals'], 'is_admin'=>$user['is_admin']]));
}
else {
    die(json_encode(['status'=>-1,'message'=>'No user is currently logged in.']));
}