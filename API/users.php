<?php
require(__DIR__.'/lib_session.php');
require(__DIR__.'/lib_db.php');

$stmt = $pdo -> query('SELECT * FROM users');

while ($row = $stmt->fetch()) {
    echo '<h4>'.$row['email'].' '.$row['first'].' '.$row['last'].' '.$row['adopted_animals'].' ADMIN: '.$row['is_admin'].'</h4>';
}

