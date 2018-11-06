<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class Examen
{
    protected $cantPreguntas;
    protected $preguntas = array();

    public function generarExamen($nombreArchivo)
    {
        $preguntas = Yaml::parse(file_get_contents($nombreArchivo));
        foreach ($preguntas["preguntas"] as $pregunta){
            array_push($this->preguntas,new Pregunta($pregunta));        
        }
        $this->cantPreguntas = count($this->preguntas);
        return true;
    }

    public function preguntasDisponibles(){
        return $this->cantPreguntas;
    }
}
