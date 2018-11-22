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
            $this->cantTemas = $this->cantPreguntas;
        }
        else{
        //funcion auxiliar
        $listaPreg = $this->array_divide($preguntas, $cantTemas);  
        }
        return $listaPreg;
    }

    public function crearExamen($listaPreg)
    {
        $i = 0;
        $listExamenes = array();
        for ($i; $i<$this->cantTemas; $i++){
            $listaExamenes[$i]=new Examen($listaPreg[$i]);
        }
        return $listaExamenes;
    }


    public function cantPreguntasDisponibles()
    {
        return $this->cantPreguntas;
    }

    protected function array_divide($array, $segmentCount) {
        $dataCount = count($array);
        if ($dataCount == 0) return false;
        $segmentLimit = floor($dataCount / $segmentCount);
        $outputArray = array();
        while($dataCount > $segmentLimit) {
            $outputArray[] = array_splice($array,0,$segmentLimit);
            $dataCount = count($array);
        }
        if($dataCount > 0) $outputArray[] = $array;
        return $outputArray;
    }

}