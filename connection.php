<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'final_projek';

$connect = mysqli_connect($servername, $username, $password, $dbName);

if (!$connect) {
    die('Connection Failed!');
}
