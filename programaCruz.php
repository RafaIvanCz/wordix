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
function cargarColeccionPalabras($arrayPalabras, $nuevaPalabra)
{
    if (count($arrayPalabras) == 0) {
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

        $arrayPalabras = array_merge($arrayPalabras, $coleccionPalabras);
    }

    if ($nuevaPalabra != "" && $nuevaPalabra != null) {
        $arrayPalabras[] = $nuevaPalabra;
    }

    return ($arrayPalabras);
}

function seleccionarOpcion()
{
    $opcion = 0;

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
$palabraNueva = "";

//Inicialización de variables:
$partidaJugador = [];
$totalPartidas = [];
$coleccionTotalPalabras = [];
$cantidadPalabras = count(cargarColeccionPalabras($coleccionTotalPalabras, $palabraNueva));

//Proceso:

do {

    $opcionElegida = seleccionarOpcion();

    switch ($opcionElegida) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra.

            echo "Ingrese su nombre: ";
            $nombreUsuario = trim(fgets(STDIN));
            echo "Ingrese un número entre 1 y " . $cantidadPalabras . " para seleccionar la palabra misteriosa: ";
            $numeroPalabra = trim(fgets(STDIN));

            echo "\nTenés 6 intentos para intentar adivinar la palabra misteriosa! BUENA SUERTE!\n\n";
            $palabrasCargadas = cargarColeccionPalabras($coleccionTotalPalabras, null);
            $partidaJugador = jugarWordix($palabrasCargadas[$numeroPalabra - 1], $nombreUsuario);
            $cantidadPartidas++;
            $totalPartidas[$cantidadPartidas - 1] = $partidaJugador;

            for ($i = 0; $i < count($totalPartidas); $i++) {
                echo $totalPartidas[$i];
            }

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la par da de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador.

            break;
        case 3:

            break;
        case 4:

            break;
        case 5:

            break;
        case 6:
            $coleccionTotalPalabras = cargarColeccionPalabras($coleccionTotalPalabras, $palabraNueva);
            $cantidadPalabras = count($coleccionTotalPalabras);

            echo "Cantidad de palabras cargadas: " . $cantidadPalabras . "\n";

            break;
        case 7:
            //Agregar una palabra de 5 letras a Wordix: Debe solicitar una palabra de 5 letras al usuario y agregarla en mayúsculas a la colección de palabras que posee Wordix, para que el usuario pueda u lizarla para jugar.

            if ($cantidadPalabras < 20) {
                do {
                    $existePalabra = false;
                    $palabraNueva = leerPalabra5Letras();

                    for ($i = 0; $i < $cantidadPalabras; $i++) {
                        if ($palabraNueva == $coleccionTotalPalabras[$i]) {
                            echo "La palabra ya existe! Intente con otra.\n";
                            $existePalabra = true;
                            break;
                        }
                    }

                    if (!$existePalabra) {
                        cargarColeccionPalabras($coleccionTotalPalabras, $palabraNueva);
                        echo "Palabra agregada con éxito!\n";
                    }
                } while ($existePalabra);
            } else {
                echo "LLegó a la cantidad límite de palabras guardadas. Ya no puede agregar palabras nuevas.\n";
            }

            break;
        case 8:
            echo "Hasta pronto!👋👋👋\n";
            break;
        default:

            break;
    }
} while ($opcionElegida != 8);


                    
//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);