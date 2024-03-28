<?php

ob_start();
session_start();
session_destroy();
header("refresh:0;url = pagina_inicial.php");

?>