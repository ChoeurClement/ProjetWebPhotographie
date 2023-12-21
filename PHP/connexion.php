<?php
try
{
	$mysqlClient = new PDO('mysql:host=localhost;dbname=web_photographie;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>