<?php
require_once('credentials.php');
try
{
  $myDb = new PDO(
      "mysql:host=".HOST.";dbname=".DBNAME."",
      DBUSER,
      DBPASSWORD,
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      )
  );
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

