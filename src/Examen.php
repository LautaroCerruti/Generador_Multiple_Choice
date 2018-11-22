<?php

namespace Generador_Multiple_Choice;

use Twig_Environment;
use Twig_Loader_Filesystem;

require_once './vendor/autoload.php';

class Examen
{
    protected $preguntas = array();

    public function __construct($preguntas, $Tema, $Index)
    {
        $this->preguntas = $preguntas;
        $loader = new Twig_Loader_Filesystem('./templates');
        $twig = new Twig_Environment($loader);
        $html = $twig->render('TemplatePrueba.html', ['preguntas' => $preguntas, 'Tema' => $Tema]);
        $html2 = $twig->render('TemplateRespuestas.html', ['preguntas' => $preguntas, 'Tema' => $Tema]);
        file_put_contents("./PruebasGeneradas/"."/".$Index."/Tema".$Tema.'.html', $html);
        file_put_contents("./PruebasGeneradas/"."/".$Index."/RespuestasTema".$Tema.'.html', $html2);
    }

}
