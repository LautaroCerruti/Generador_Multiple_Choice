<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class DelegadorTest extends TestCase
{
    public function testDelegador1()
    {
        $nom = "./tests/preguntas.yml";
        $delega = new Delegador($nom, 5);
        $this->AssertEquals($delega->cantPreguntasDisponibles(), 26);
        $this->AssertEquals($delega->cantTemas(), 5);
    }

    public function testDelegador2()
    {
        $nom = "./tests/preguntas.yml";
        $delega = new Delegador($nom, 30);
        $this->AssertEquals($delega->cantPreguntasDisponibles(), 26);
        $this->AssertEquals($delega->cantTemas(), 26);
    }
}
