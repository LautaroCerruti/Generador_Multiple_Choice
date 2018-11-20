<?php

namespace Generador_Multiple_Choice;

class Pregunta
{
    protected $descripcion;
    protected $correctas=array();
	protected $cantcorrectas;
    protected $incorrectas=array();
    protected $ocultaranteriores = null;
    protected $ocultarningunaanteriores = null;
    protected $textoningunaanteriores = null;
	
    public function __construct($pregunta) {
        $this->descripcion=$pregunta["descripcion"];
        foreach ($pregunta["respuestas_correctas"] as $respuestacorrecta){
            array_push($this->correctas,$respuestacorrecta);
        }
	$this->cantcorrectas = count($this->correctas);
        foreach ($pregunta["respuestas_incorrectas"] as $respuestaincorrecta){
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

	public function obtenerDescripcion(){
		return $this->descripcion;
	}
	protected function crearRespuestas(){
        $iterador=0;
        $iterador2=0;
		$opciones=array();
		foreach($this->correctas as $opcion){
			$opciones[$iterador] = $opcion;
			$iterador++;
		}
		foreach($this->incorrectas as $opcion){
			$opciones[$iterador] = $opcion;
            $iterador++;
            $i=0;
            $numcorrectas=array();
		}
        shuffle($opciones);
        for($iterador2=0;$iterador2<=$iterador;$iterador2++){ //este for es para encontrar y guardar en un array los num de las opciones correctas
            for($i;$i<=$iterador;$i++){ //lo hice a las apuradas pq se me termino el tiempo de trabajo, ni idea si anda
                if($opciones[$iterador2]==$this->correctas[$i]){
                    $numcorrectas[$x]=$opciones;
                    $x++;
                }
            }
        }
    }
    


}
