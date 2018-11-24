<?php

namespace Generador_Multiple_Choice;

require_once  './vendor/autoload.php';

session_start();

$cantTemas = $_POST["CantidadTemas"];

$Index = $_POST["Index"];

$Preguntas = $_POST["UbicacionPreguntas"];

$delegator = new Delegador($Preguntas, $cantTemas, $Index);

header('Location: /Generador_Multiple_Choice/PruebasGeneradas/'.$Index);
