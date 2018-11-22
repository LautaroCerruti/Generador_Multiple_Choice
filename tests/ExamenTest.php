<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class ExamenTest extends TestCase
{
    public function testLeerYML()
    {
        //No va a andar hasta que termine el delegador y genere los examenes
        $nom = "./tests/preguntas.yml";
        $Examen = new Examen($nom);
        $this->assertEquals($Delegador->preguntasDisponibles(),26);
    }
}
