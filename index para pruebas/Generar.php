<?php

namespace Generador_Multiple_Choice;

require_once  './vendor/autoload.php';

session_start();

$delegator = new Delegador('./index para pruebas/preguntas.yml',2);
/*
$_SESSION['delegador'] = $delegator;

header('Location: index.php');
*/