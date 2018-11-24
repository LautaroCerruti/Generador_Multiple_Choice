<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class DelegadorTest extends TestCase
{
    /*
    *   Aqui se prueba crear un delegador (el cual termina creando los examenes) con un archivo de 26 preguntas, y que cree 5 temas,
    *   luego se revisa que haya creado 10 archivos, las 5 pruebas y las 5 pruebas con las respuestas ya puestas
    */
    public function testDelegador1()
    {
        $nom = "./tests/preguntas.yml";
        $delega = new Delegador($nom, 5, "Prueba1");
        $this->AssertEquals($delega->cantPreguntasDisponibles(), 26);
        $this->AssertEquals($delega->cantTemas(), 5);

        $filecount = 0;
        $files = glob("./PruebasGeneradas/Prueba1/" . "*");
        if ($files) {
            $filecount = count($files);
        }
        $this->AssertEquals($filecount, 10);
    }

    /*
    *   Aqui se prueba crear un delegador con un archivo de 26 preguntas, y que cree 30 temas, esto es para ver que solo cree 26 temas,
    *   ya que la minima cantidad de preguntas por tema es 1, y para no crear repetidos hicimos que solo cree temas igual a la cantidad
    *   de preguntas del archivo para cuando pone un numero muy grande de temas.
    *   No se supone que este sea el uso que se le da al programa, pero lo implementams de esta forma para que no se rmpo si alguien lo intenta.
    *   luego se revisa que haya creado 52 archivos, las 26 pruebas y las 26 pruebas con las respuestas ya puestas
    */
    public function testDelegador2()
    {
        $nom = "./tests/preguntas.yml";
        $delega = new Delegador($nom, 30, "Prueba2");
        $this->AssertEquals($delega->cantPreguntasDisponibles(), 26);
        $this->AssertEquals($delega->cantTemas(), 26);

        $filecount = 0;
        $files = glob("./PruebasGeneradas/Prueba2/" . "*");
        if ($files) {
            $filecount = count($files);
        }
        $this->AssertEquals($filecount, 52);
    }
}
