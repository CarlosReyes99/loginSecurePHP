<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function conectaDB()
{
  	$host = 'localhost';
	$user = 'root';
	$pass = 'toor055';
	$dbname = 'tech'; // Added dbname

   $link = mysqli_init();
   if (!$link) {
    echo "mysqli_init failed";
    exit();
   }

   if (!mysqli_real_connect($link, $host, $user, $pass, $dbname)) {
    echo "Error al realizar la conexión a la base de datos: " . mysqli_connect_error();
    exit();
   }


   if (!mysqli_select_db($link,"tech"))
   {
      echo "Error al seleccionar la base de datos.";
      exit();
   }
   return $link;
}
?>
