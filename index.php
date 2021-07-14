<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/coordinador.controlador.php";

require_once "modelos/coordinador.modelo.php";

$rutas = new controladorRutas();
$rutas -> index();