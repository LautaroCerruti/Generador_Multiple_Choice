<?php

namespace Generador_Multiple_Choice;

require_once  './vendor/autoload.php';

session_start();

$cantTemas = $_POST["CantidadTemas"];

$Index = $_POST["Index"];

$delegator = new Delegador('./index para pruebas/preguntas.yml',$cantTemas,$Index);

header('Location: /Generador_Multiple_Choice/PruebasGeneradas/'. $Index);
