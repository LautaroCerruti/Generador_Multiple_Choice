<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;

class Delegador
{
    protected $cantTemas;
    protected $cantPreguntas;
    protected $Index;
    protected $preguntas = array();

    public function __construct($nombreArchivo, $cantTemas, $Index)
    {
        $this->Index= $Index;
        if(!file_exists('./PruebasGeneradas')){
            mkdir ('./PruebasGeneradas', 0777);
            }
        if(!file_exists('./PruebasGeneradas/' . $Index)){
        mkdir ('./PruebasGeneradas/' . $Index, 0777);
        }
        $preguntas = Yaml::parse(file_get_contents($nombreArchivo));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($this->preguntas, new Pregunta($pregunta));
        }
        $this->cantTemas = $cantTemas;
        $this->cantPreguntas = count($this->preguntas);
        shuffle($this->preguntas);
        $listaPreg = $this->divisionTemas();
        $listaExamenes = $this->crearExamen($listaPreg);
    }

    protected function divisionTemas()
    {
        $listaPreg = array();
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
        $listExamenes = array();
        /*foreach ($listaPreg as $Preg){
        $listaExamenes[$i]=new Examen($Preg);
        }*/
        for ($i = 0; $i < $this->cantTemas; $i++) {
            $listaExamenes[] = new Examen($listaPreg[$i],($i+1),$this->Index);
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
        $segmentLimit = floor($dataCount / $segmentCount);
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
