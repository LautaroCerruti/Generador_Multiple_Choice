<?php

namespace Generador_Multiple_Choice;

class Pregunta
{
    protected $descripcion;
    protected $correctas=array();
    protected $incorrectas=array();
    protected $ocultaranteriores = null;
    protected $ocultarningunaanteriores = null;
    protected $textoningunaanteriores = null;

    public function __CONSTRUCT($pregunta) {
        $this->descripcion=$pregunta["descripcion"];
        foreach ($pregunta["respuestas_correctas"] as $respuestacorrecta){
            array_push($this->correctas,$respuestacorrecta);
        }
        foreach ($pregunta["respuestas_correctas"] as $respuestaincorrecta){
            array_push($this->incorrectas,$respuestaincorrecta);
        }
        if (isset($pregunta["ocultar_opcion_todas_las_anteriores"])){
            $this->ocultaranteriores=true;
        } else {
            $this->ocultaranteriores=false;
        }
        if (isset($pregunta["ocultar_opcion_ninguna_de_las_anteriores"])){
            $this->ocultarningunaanteriores=true;
        } else {
            $this->ocultarningunaanteriores=false;
        }
        if (isset($pregunta["texto_ninguna_de_las_anteriores"])){
            $this->textoningunaanteriores=$pregunta["texto_ninguna_de_las_anteriores"];
        } else {
            $this->textoningunaanteriores=null;
        }
    }
}