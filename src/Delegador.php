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
        $this->crearExamen($listaPreg);
    }

    protected function divisionTemas()
    {
        $listaPreg = array();
        shuffle($listaPreg);
        if ($this->cantTemas > $this->cantPreguntas) {
            $listaPreg = $this->arrayDivide($this->preguntas, $this->cantPreguntas);
            $this->cantTemas = $this->cantPreguntas;
        } else {
            $listaPreg = $this->arrayDivide($this->preguntas, $this->cantTemas);
        }
        return $listaPreg;
    }

    public function crearExamen($listaPreg)
    {
        $listaExamenes = array();
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

    protected function arrayDivide($array, $segmentCount)
    {
        $dataCount = count($array);
        if ($dataCount == 0) {
            return false;
        }
        $segmentLimit = int(floor($dataCount / $segmentCount));
        $outputArray = array();
        while ($dataCount > $segmentLimit) {
            $outputArray[] = array_splice($array, 0, $segmentLimit);
            $dataCount = count($array);
        }
        if ($dataCount > 0) {
            $outputArray[] = $array;
        }
        return $outputArray;
    }
}
