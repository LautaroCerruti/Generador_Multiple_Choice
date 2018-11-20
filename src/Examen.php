<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;

class Examen
{
    protected $cantPreguntas;
    protected $preguntas = array();

    public function __construct($nombreArchivo){
        $preguntas = Yaml::parse(file_get_contents($nombreArchivo));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($this->preguntas, new Pregunta($pregunta));
        }
        $this->cantPreguntas = count($this->preguntas);
    }
    public function generarExamen($nombreArchivo)
    {
        
        return true;
    }

    public function preguntasDisponibles()
    {
        return $this->cantPreguntas;
    }
}
