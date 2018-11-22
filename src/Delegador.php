<?php

namespace Generador_Multiple_Choice;

class Delegador
{

    protected $cantPreguntas;
    protected $preguntas = array();

    public function __construct($nombreArchivo, $cantTemas)
    {
        $preguntas = Yaml::parse(file_get_contents($nombreArchivo));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($this->preguntas, new Pregunta($pregunta));
        }
        $this->cantPreguntas = count($this->preguntas);

    }

    public function divisionTemas()
    {
        $listaPreg = array();
        shuffle($listaPreg);
        $listaPreg = array_chunk($preguntas, $cantTemas);
        return $listaPreg;
    }



    public function crearExamen()
    {
        $i = 0;
        $listExamenes = array();
        for ($i; $i<$cantTemas; $i++){
            $listaExamenes[$i]=new Examen($listaPreg[$i]);
        }
        return $listaExamenes;
    }



    public function cantPreguntasDisponibles()
    {
        return $this->cantPreguntas;
    }

}