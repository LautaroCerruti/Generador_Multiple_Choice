<?php

namespace Generador_Multiple_Choice;

class Delegador
{
    protected $cantTemas;
    protected $cantPreguntas;
    protected $preguntas = array();

    public function __construct($nombreArchivo, $cantTemas)
    {
        $preguntas = Yaml::parse(file_get_contents($nombreArchivo));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($this->preguntas, new Pregunta($pregunta));
        }
        $this->cantTemas = $cantTemas;
        $this->cantPreguntas = count($this->preguntas);
        $listaPreg = $this->divisionTemas($cantTemas);
        $listaExamenes = $this->crearExamen($listaPreg);
    }


    protected function divisionTemas($cantTemas)
    {
        $listaPreg = array();
        shuffle($listaPreg);
        if ($this->cantTemas > $this->cantPreguntas){
            $listaPreg = array_chunk($this->preguntas, $this->cantPreguntas);
        }
        else{
        //funcion auxiliar
        $listaPreg = array_chunk($preguntas, $cantTemas);  
        }
        return $listaPreg;
    }

    protected function repartir($listaPreg)
    {
   //     ($this->cantPreguntas/$this->cantTemas)
    }

    public function crearExamen($listaPreg)
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