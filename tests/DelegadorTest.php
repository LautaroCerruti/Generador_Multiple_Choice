<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class DelegadorTest extends TestCase
{
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
