<?php
try {
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=clis_db','root','0713137778');
  //echo 'Connetion Sucessfull';

} catch (PDOException $e) {

  echo $e->getmessage();
}

?>
