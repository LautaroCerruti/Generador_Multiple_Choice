<?php

namespace Generador_Multiple_Choice;

use Symfony\Component\Yaml\Yaml;

use PHPUnit\Framework\TestCase;

class PreguntasTest extends TestCase
{
    /*
        Testea La primera pregunta donde se oculta la opcion de todas las anteriores, pero se ve que la ultima es ninguna de las anteriores
        Tambien se prueba la randomizacion de las preguntas.
    */
    public function testPregunta()
    {
        $tpreguntas = array();
        $nom = "./tests/preguntas.yml";
        $preguntas = Yaml::parse(file_get_contents($nom));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($tpreguntas, new Pregunta($pregunta));
        }
        $this->AssertEquals($tpreguntas[0]->obtenerDescripcion(),"El término pixel hace referencia a");
        $this->AssertNotEquals($tpreguntas[0]->obtenerOpciones()[0],"La unidad mínima de información de una imagen.");
        $this->AssertEquals(count($tpreguntas[0]->obtenerOpciones()),5);
        $this->AssertEquals($tpreguntas[0]->obtenerOpciones()[4],"Ninguna de las anteriores");
        $this->AssertEquals($tpreguntas[0]->obtenerCorrecta(),"La unidad mínima de información de una imagen.");
    }

    /*
        Testea segunda pregunta donde no hay respuesta correcta
    */
    public function testPregunta2()
    {
        $tpreguntas = array();
        $nom = "./tests/preguntas.yml";
        $preguntas = Yaml::parse(file_get_contents($nom));
        foreach ($preguntas["preguntas"] as $pregunta) {
            array_push($tpreguntas, new Pregunta($pregunta));
        }
        $this->AssertEquals($tpreguntas[1]->obtenerDescripcion(),"Para las imágenes vectoriales se cumple que");
        $this->AssertEquals(count($tpreguntas[1]->obtenerOpciones()),6);
        $this->AssertEquals($tpreguntas[1]->obtenerOpciones()[4],"Todas las anteriores");
        $this->AssertEquals($tpreguntas[1]->obtenerOpciones()[5],"Ninguna de las anteriores");
        $this->AssertEquals($tpreguntas[1]->obtenerLetracorrecta(),'F');
        $this->AssertEquals($tpreguntas[1]->obtenerCorrecta(),"Ninguna de las anteriores");
    }
}
