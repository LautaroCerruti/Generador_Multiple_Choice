<?php

namespace Generador_Multiple_Choice;

use Twig_Environment;
use Twig_Loader_Filesystem;

require_once './vendor/autoload.php';

class Examen
{
    protected $preguntas = array();

    public function __construct($preguntas,$Tema)
    {
        $this->preguntas = $preguntas;
        $loader = new Twig_Loader_Filesystem('./templates');
        $twig = new Twig_Environment($loader);
        $html = $twig->render('TemplatePrueba.html', ['preguntas' => $preguntas]);
        file_put_contents("./PruebasGeneradas/" . $Tema . '.html',$html);
    }

}
