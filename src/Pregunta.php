<?php

namespace Generador_Multiple_Choice;

class Pregunta
{
    protected $descripcion;
    protected $correctas = array();
    protected $cantcorrectas;
    protected $incorrectas = array();
    protected $ocultaranteriores = null;
    protected $ocultarningunaanteriores = null;
    protected $textoningunaanteriores = null;
    protected $Correcta = null;
    protected $LetraCorrecta = null;
    protected $Opciones = null;

    public function __construct($pregunta)
    {
        $this->descripcion = $pregunta["descripcion"];
        foreach ($pregunta["respuestas_correctas"] as $respuestacorrecta) {
            array_push($this->correctas, $respuestacorrecta);
        }
        $this->cantcorrectas = count($this->correctas);
        foreach ($pregunta["respuestas_incorrectas"] as $respuestaincorrecta) {
            array_push($this->incorrectas, $respuestaincorrecta);
        }
        if (isset($pregunta["ocultar_opcion_todas_las_anteriores"])) {
            $this->ocultaranteriores = true;
        } else {
            $this->ocultaranteriores = false;
        }
        if (isset($pregunta["ocultar_opcion_ninguna_de_las_anteriores"])) {
            $this->ocultarningunaanteriores = true;
        } else {
            $this->ocultarningunaanteriores = false;
        }
        if (isset($pregunta["texto_ninguna_de_las_anteriores"])) {
            $this->textoningunaanteriores = $pregunta["texto_ninguna_de_las_anteriores"];
        } else {
            $this->textoningunaanteriores = null;
        }
        $this->Opciones = $this->crearOpciones();
    }

    public function obtenerDescripcion()
    {
        return $this->descripcion;
    }

    public function obtenerCorrecta()
    {
        return $this->Correcta;
    }

    public function obtenerLetracorrecta()
    {
        return $this->LetraCorrecta;
    }

    public function obtenerOpciones()
    {
        return $this->Opciones;
    }

    public function numerarOpciones($opciones)
    {
        $contador = count($opciones)-1;
        for ($contador; $contador > -1; $contador--) {
            $opciones[$contador] = chr(ord('A')+$contador).") ".$opciones[$contador];
        }
        return $opciones;
    }

    protected function dosCorrectas($iterador, $opciones)
    {
        if ($this->cantcorrectas == 2) {
            $this->Correcta = $this->opcionDoble($iterador, $opciones, $this->correctas);
            if (count($this->incorrectas) >= 2) {
                $opciones[$iterador] = $this->opcionDoble($iterador, $opciones, $this->incorrectas);
                $iterador++;
            }
            $opciones[$iterador] = $this->Correcta;
            $this->LetraCorrecta = chr(ord('A')+$iterador);
            $iterador++;
        }
        return $opciones;
    }

    protected function noOcultarAnteriores($iterador, $opciones)
    {
        if ($this->ocultaranteriores === false) {
            $opciones[$iterador] = "Todas las anteriores";
            if (count($this->incorrectas) == 0) {
                $this->Correcta = "Todas las anteriores";
                $this->LetraCorrecta = chr(ord('A')+$iterador);
            }
            $iterador++;
        }
        return $opciones;
    }

    public function ocultarNingunaAnteriores($iterador, $opciones)
    {
        if ($this->ocultarningunaanteriores === false) {
            $texto = "Ninguna de las anteriores";
            if ($this->textoningunaanteriores != null) {
                $texto = $this->textoningunaanteriores;
            }
            $opciones[$iterador] = $texto;
            if ($this->cantcorrectas == 0) {
                $this->Correcta = $texto;
                $this->LetraCorrecta = chr(ord('A')+$iterador);
            }
            $iterador++;
        }
        return $opciones;
    }

    protected function crearOpciones()
    {
        $iterador = 0;
        $opciones = array();
        foreach ($this->correctas as $opcion) {
            $opciones[$iterador] = $opcion;
            $iterador++;
        }
        foreach ($this->incorrectas as $opcion) {
            $opciones[$iterador] = $opcion;
            $iterador++;
        }
        shuffle($opciones);

        $opciones = $this->dosCorrectas($iterador, $opciones);
        $iterador = count($opciones);

        $opciones = $this->noOcultarAnteriores($iterador, $opciones);
        $iterador = count($opciones);

        $opciones = $this->ocultarNingunaAnteriores($iterador, $opciones);

        if ($this->cantcorrectas == 1) {
            $this->unaCorrecta($opciones);
        }

        return $this->numerarOpciones($opciones);
    }

    protected function unaCorrecta($opciones)
    {
        $this->Correcta = $this->correctas[0];
        $numeroCorrecta = 0;
        foreach ($opciones as $auxiliar) {
            if ($this->Correcta === $auxiliar) {
                $this->LetraCorrecta = chr(ord('A')+$numeroCorrecta);
            }
            $numeroCorrecta++;
        }
    }

    protected function opcionDoble($cantOpciones, $opciones, $opcionesABuscar)
    {
        $x = 0;
        $numcorrectas = array();
        $countOpcionesaBuscar = count($opcionesABuscar);
        for ($iterador2 = 0; $iterador2 < $cantOpciones; $iterador2++) { //este for es para encontrar y guardar en un array los num de las opciones correctas
            for ($i = 0; $i < $countOpcionesaBuscar; $i++) {
                if ($opciones[$iterador2] === $opcionesABuscar[$i]) {
                    $numcorrectas[$x] = $iterador2;
                    $x++;
                }
            }
        }
        $a = chr(ord('A')+$numcorrectas[0]);
        $b = chr(ord('A')+$numcorrectas[1]);
        return $b." y ".$a;
    }
}
