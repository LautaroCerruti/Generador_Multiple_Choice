<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;

class Examen
{
    protected $preguntas = array();

    public function __construct($preguntas)
    {
        $this->preguntas=$preguntas;
        //array con las opciones de cada pregunta (foreach)
    }





}
