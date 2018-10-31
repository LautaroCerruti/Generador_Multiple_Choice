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
        foreach($preguntas["preguntas"] as $pregunta){
            //$this->preguntas[]=new Pregunta($pregunta);
            array_push($this->preguntas,$pregunta);        
        }
        $this->cantPreguntas = count($this->preguntas);
        return TRUE;
    }

    public function preguntasDisponibles(){
        return $this->cantPreguntas;
    }
}
