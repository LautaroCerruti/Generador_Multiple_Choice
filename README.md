# Generador_Multiple_Choice

[![Coverage Status](https://coveralls.io/repos/github/LautaroCerruti/Generador_Multiple_Choice/badge.svg?branch=master)](https://coveralls.io/github/LautaroCerruti/Generador_Multiple_Choice?branch=master)

[![Build Status](https://travis-ci.org/LautaroCerruti/Generador_Multiple_Choice.svg?branch=master)](https://travis-ci.org/LautaroCerruti/Generador_Multiple_Choice)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LautaroCerruti/Generador_Multiple_Choice/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LautaroCerruti/Generador_Multiple_Choice/?branch=master)

Participantes: Cerruti Lautaro, Spoletini Bruno

Generador automatico de examenes multiple choice.

El proyecto fué diseñado con el fin de obtener un programa al cual se le ingresan preguntas, con sus respectivas opciones y respuestas correctas, y generar un pdf por tema (en este caso un html debido a la falta de tiempo y la utilidad práctica), según la cantidad de temas que se quieran obtener, junto con otro set de pdf´s en el cuál estarán ya marcadas las respuestas correctas.
Para generar el/los exámenes, se utilizará el archivo "Generar.php", al cuál se le pasará como parámetro la cantidad de temas, 

//COOMPLETAR

Dentro de los errores mas frecuentes que ocurrieron, se encuentra el problema de la aleatoriedad en los test de Travis.
Para comprobar que las opciones se randomizaron (esto para que no queden en el mismo lugar en el cuál se ingresaron), se compara la primera opción que se leyó con la primera opción del array de opciones. El problema aqui, es que existe la posibilidad de que luego de que las opciones hayan sido randomizadas, estas queden en el mismo lugar, o al menos la primera leída quede en el primer lugar del array.
Esto provoca un falso negativo en Travis CI, por lo que hubo ocaciones en las que debimos correr mas de una vez este checkeo.
Errores producidos por el mal uso del programa, como ingresar más temas que preguntas, fueron considerados y cubiertos.
