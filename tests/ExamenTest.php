<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class ExamenTest extends TestCase
{
    public function testLeerYML()
    {
        $nom = "./tests/preguntas.yml";
        $Examen = new Examen($nom);
        $this->assertEquals($Examen->preguntasDisponibles(),26);
    }
}
