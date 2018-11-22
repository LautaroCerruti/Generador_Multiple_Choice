<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;

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
        $listaPreg = $this->divisionTemas();
        $listaExamenes = $this->crearExamen($listaPreg);
    }


    protected function divisionTemas()
    {
        $listaPreg = array();
        shuffle($listaPreg);
        if ($this->cantTemas > $this->cantPreguntas) {
            $listaPreg = $this->array_divide($this->preguntas, $this->cantPreguntas);
            $this->cantTemas = $this->cantPreguntas;
        }
        else {
        $listaPreg = $this->array_divide($this->preguntas, $this->cantTemas);
        }
        return $listaPreg;
    }

    public function crearExamen($listaPreg)
    {
        $listExamenes = array();
        /*foreach ($listaPreg as $Preg){
            $listaExamenes[$i]=new Examen($Preg);
        }*/
        for ($i = 0; $i < $this->cantTemas; $i++) {
            $listaExamenes[] = new Examen($listaPreg[$i]);
        }
        return $listaExamenes;
    }


    public function cantPreguntasDisponibles()
    {
        return $this->cantPreguntas;
    }

    public function cantTemas()
    {
        return $this->cantTemas;
    }

    protected function array_divide($array, $segmentCount) {
        $dataCount = count($array);
        if ($dataCount == 0) return false;
        $segmentLimit = floor($dataCount / $segmentCount);
        $outputArray = array();
        while ($dataCount > $segmentLimit) {
            $outputArray[] = array_splice($array, 0, $segmentLimit);
            $dataCount = count($array);
        }
        if ($dataCount > 0) $outputArray[] = $array;
        return $outputArray;
    }
}