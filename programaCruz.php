<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido: Cruz, Nombre: Rafael Iván. Legajo: 5535. Carrera: Tecnicatura Universitaria en Desarrollo Web. Mail: rafaelivancz@gmail.com Usuario Github: RafaIvanCz */

/* ****COMPLETAR***** */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER",
        "QUESO",
        "FUEGO",
        "CASAS",
        "RASGO",
        "GATOS",
        "GOTAS",
        "HUEVO",
        "TINTO",
        "NAVES",
        "VERDE",
        "MELON",
        "YUYOS",
        "PIANO",
        "PISOS"
        /* Agregar 5 palabras más */
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
$opcion = 0;

//Inicialización de variables:
$arrayPartidas = [];

//Proceso:


do {
    echo "Ingrese una opción:
    1) Jugar al wordix con una palabra elegida.
    2) Jugar al wordix con una palabra aleatoria.
    3) Mostrar una partida.
    4) Mostrar la primer partida ganadora.
    5) Mostrar resumen de Jugador.
    6) Mostrar listado de partidas ordenadas por jugador y por palabra.
    7) Agregar una palabra de 5 letras a Wordix.
    8) salir.\n";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra.

            echo "Ingrese su nombre: ";
            $nombreUsuario = trim(fgets(STDIN));
            echo "Ingrese un número entre 1 y " . count(cargarColeccionPalabras()) . " para seleccionar la palabra misteriosa: ";
            $numeroPalabra = trim(fgets(STDIN));

            echo "\nTenes 6 intentos para intentar adivinar la palabra misteriosa! BUENA SUERTE!\n\n";
            $palabrasCargadas = cargarColeccionPalabras();
            $arrayPartidas = jugarWordix($palabrasCargadas[$numeroPalabra - 1], $nombreUsuario);
            print_r($arrayPartidas);

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la partida de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador.

            break;
        case 3:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        case 4:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 4

            break;
        case 5:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 5

            break;
        case 6:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 6

            break;
        case 7:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 7

            break;
        case 8:
            echo "Has finalizado el juego. Hasta la próxima!";

            break;
        default:
            echo "Opción incorrecta.\n";
            break;
    }
} while ($opcion != 8);

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
