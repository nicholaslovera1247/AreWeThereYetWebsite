<?php
$databaseName = 'NLOVERA_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'nlovera_writer';
$password = '9U-7oB%weea6A0n8;5zf';

$pdo = new PDO($dsn, $username, $password);
if ($pdo) print '<!-- Connection complete -->';
?>