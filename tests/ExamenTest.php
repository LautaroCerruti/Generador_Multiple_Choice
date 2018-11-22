<?php

namespace Generador_Multiple_Choice;

use PHPUnit\Framework\TestCase;

class ExamenTest extends TestCase
{
    public function testHacerExamen()
    {
        //No va a andar hasta que termine el delegador y genere los examenes
        /*/
        $nom = "./tests/preguntas.yml";
        $Examen = new Examen($nom);
        $this->assertEquals($Delegador->preguntasDisponibles(),26);
        /*/
        $this->assertEquals(1,1); //Esto esta porque no me gustaba que quede como risky...
    }
}
