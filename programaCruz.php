<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
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

function agregarPalabra($arrayPalabras, $nuevaPalabra)
{
    do {
        $existePalabra = false;

        for ($i = 0; $i < count($arrayPalabras); $i++) {
            if ($nuevaPalabra == $arrayPalabras[$i]) {
                echo "La palabra ya existe! Intente con otra.\n";
                $existePalabra = true;
                break;
            }
        }

        if (!$existePalabra) {
            $arrayPalabras[] = $nuevaPalabra;
            echo "Palabra agregada con éxito!\n";
        } else {
            $nuevaPalabra = leerPalabra5Letras();
        }
    } while ($existePalabra);

    return ($arrayPalabras);
}

function seleccionarOpcion()
{
    $opcion = 0;

    do {
        echo "\nIngrese una opción:
        1) Jugar al wordix con una palabra elegida.
        2) Jugar al wordix con una palabra aleatoria.
        3) Mostrar una partida.
        4) Mostrar la primer partida ganadora.
        5) Mostrar resumen de Jugador.
        6) Mostrar listado de partidas ordenadas por jugador y por palabra.
        7) Agregar una palabra de 5 letras a Wordix.
        8) salir.\n";
        $opcion = trim(fgets(STDIN));

        if ($opcion < 1 && $opcion > 8)
            echo "Opción incorrecta!\n\n";
    } while ($opcion < 1 && $opcion > 8);

    return $opcion;
}

/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
$opcion = 0;
$cantidadPartidas = 0;
$guardarPartida = 0;
$mostrarPartida = 1;

//Inicialización de variables:
$partidaJugador = [];
$totalPartidas = [];
$coleccionTotalPalabras = cargarColeccionPalabras();
$cantidadPalabras = count($coleccionTotalPalabras);

//Proceso:

do {
    $opcionElegida = seleccionarOpcion();

    switch ($opcionElegida) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.

            echo "Ingrese su nombre: ";
            $nombreUsuario = trim(fgets(STDIN));
            do {
                $palabraUtilizada = false;
                $numeroPalabra = solicitarNumeroEntre(1, $cantidadPalabras);
                $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < count($totalPartidas); $i++) {
                    if ($totalPartidas[$i]["jugador"] == $nombreUsuario && $totalPartidas[$i]["palabraWordix"] == $palabraElegida) {
                        echo "Palabra ya utilizada.\n";
                        $palabraUtilizada = true;
                        break;
                    }
                }

            } while ($palabraUtilizada);

            echo "\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
            $partidaJugador = jugarWordix($coleccionTotalPalabras[$numeroPalabra - 1], $nombreUsuario);
            $totalPartidas[$cantidadPartidas] = $partidaJugador;
            $cantidadPartidas++;

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la par da de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.
            echo "Ingrese su nombre: ";
            $nombreUsuario = trim(fgets(STDIN));

            do {
                $palabraUtilizada = false;
                $numeroPalabra = rand(1, $cantidadPalabras);
                $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < count($totalPartidas); $i++) {
                    if ($totalPartidas[$i]["jugador"] == $nombreUsuario && $totalPartidas[$i]["palabraWordix"] == $palabraElegida) {
                        echo "Palabra ya utilizada.\n";
                        $palabraUtilizada = true;
                        break;
                    }
                }

            } while ($palabraUtilizada);

            echo "\nLa palabra fue elegida al azar y no será una que ya hayas elegido.\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
            $partidaJugador = jugarWordix($coleccionTotalPalabras[$numeroPalabra - 1], $nombreUsuario);
            $totalPartidas[$cantidadPartidas] = $partidaJugador;
            $cantidadPartidas++;

            break;
        case 3:

            break;
        case 4:

            break;
        case 5:

            break;
        case 6:
            echo "Cantidad de palabras cargadas: " . $cantidadPalabras . "\n";

            break;
        case 7:
            //Agregar una palabra de 5 letras a Wordix: Debe solicitar una palabra de 5 letras al usuario y agregarla en mayúsculas a la colección de palabras que posee Wordix, para que el usuario pueda utlizarla para jugar.

            if ($cantidadPalabras < 20) {
                $palabraNueva = leerPalabra5Letras();
                $coleccionTotalPalabras = agregarPalabra($coleccionTotalPalabras, $palabraNueva);
                $cantidadPalabras = count($coleccionTotalPalabras);
            } else {
                echo "LLegó a la cantidad límite de palabras guardadas. Ya no puede agregar palabras nuevas.\n";
            }

            break;
        case 8:
            echo "Hasta pronto!👋👋👋\n";
            break;
        default:
            echo "Opción incorrecta.\n\n";
            break;
    }
} while ($opcionElegida != 8);


                    
//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);