<?php
$password_file_path = file_get_contents(getenv('PASSWORD_FILE_PATH')) ;

$db_pass = trim($password_file_path);
$db_host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

    $cnx = new PDO($dsn, $db_user, $db_pass);
} catch (PDOException $e) {
    echo "erreur survenue lors de la connexion : " . $e->getMessage();
}