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

function cargarPartidas()
{
    $nombreJugadores = ["Ivan", "Maria", "Lucas", "Jorge", "Abigail"];
    $colecPalabras = cargarColeccionPalabras();
    $coleccionPartidas = [];

    for ($i = 0; $i < 10; $i++) {
        $coleccionPartidas[$i] = ["palabraWordix" => $colecPalabras[rand(0, count($colecPalabras) - 1)], "jugador" => strtolower($nombreJugadores[rand(0, count($nombreJugadores) - 1)]), "intentos" => rand(0, 6), "puntaje" => rand(0, 15)];
    }

    return ($coleccionPartidas);
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

function mostrarPartida($partidas, $partidaNro)
{
    $mensajePartida = "";

    if ($partidas[$partidaNro]["intentos"] == 0) {
        $mensajePartida = "No adivinó la palabra";
    } else {
        $mensajePartida = "Adivinó la palabra en " . $partidas[$partidaNro]["intentos"] . " intentos";
    }

    echo "\nPartida WORDIX " . $partidaNro + 1 . ": palabra " . $partidas[$partidaNro]["palabraWordix"] . "\nJugador: " . $partidas[$partidaNro]["jugador"] . "\nPuntaje: " . $partidas[$partidaNro]["puntaje"] . "\nIntentos: " . $mensajePartida . "\n";
}

function solicitarJugador()
{
    $esLetra = false;

    while (!$esLetra) {
        echo "Ingrese el nombre del jugador: ";
        $nombre = strtolower(trim(fgets(STDIN)));

        if (ctype_alpha($nombre[0])) {
            $esLetra = true;
        } else {
            echo "El nombre debe comenzar con una letra.\n";
        }
    }
    return $nombre;
}

function obtenerPrimerPartidaGanada($partidasTotales, $jugadorNombre)
{
    $indice = -1;

    for ($i = 0; $i < count($partidasTotales); $i++) {
        if ($partidasTotales[$i]["jugador"] == $jugadorNombre && $partidasTotales[$i]["puntaje"] > 0) {
            $indice = $i;
            break;
        }
    }

    return $indice;
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

//Inicialización de variables:
$partidaJugador = [];
$totalPartidas = cargarPartidas();
$coleccionPalabras = cargarColeccionPalabras();
$cantidadPalabras = count($coleccionPalabras);

//Proceso:

do {
    $opcionElegida = seleccionarOpcion();

    switch ($opcionElegida) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.

            echo "Ingrese su nombre: ";
            $nombreUsuario = strtolower(trim(fgets(STDIN)));
            do {
                $palabraUtilizada = false;
                $numeroPalabra = solicitarNumeroEntre(1, $cantidadPalabras);
                $palabraElegida = $coleccionPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < count($totalPartidas); $i++) {
                    if ($totalPartidas[$i]["jugador"] == $nombreUsuario && $totalPartidas[$i]["palabraWordix"] == $palabraElegida) {
                        echo "Palabra ya utilizada.\n";
                        $palabraUtilizada = true;
                        break;
                    }
                }
            } while ($palabraUtilizada);

            echo "\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
            $partidaJugador = jugarWordix($coleccionPalabras[$numeroPalabra - 1], $nombreUsuario);
            $totalPartidas[count($totalPartidas)] = $partidaJugador;

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la partida de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.
            echo "Ingrese su nombre: ";
            $nombreUsuario = trim(fgets(STDIN));

            do {
                $palabraUtilizada = false;
                $numeroPalabra = rand(1, $cantidadPalabras);
                $palabraElegida = $coleccionPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < count($totalPartidas); $i++) {
                    if ($totalPartidas[$i]["jugador"] == $nombreUsuario && $totalPartidas[$i]["palabraWordix"] == $palabraElegida) {
                        echo "Palabra ya utilizada.\n";
                        $palabraUtilizada = true;
                        break;
                    }
                }
            } while ($palabraUtilizada);

            echo "\nLa palabra fue elegida al azar y no será una que ya hayas jugado.\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
            $partidaJugador = jugarWordix($coleccionPalabras[$numeroPalabra - 1], $nombreUsuario);
            $totalPartidas[count($totalPartidas)] = $partidaJugador;

            break;
        case 3:
            //Mostrar una partida: Se le solicita al usuario un número de partida y se muestra en pantalla con el siguiente formato:
            //Partida WORDIX <numero>: palabra <palabra>
            //Jugador: <nombre>
            //Puntaje: <puntaje> puntos
            //Intento: No adivinó la palabra | Adivinó la palabra en <X> intentos
            //Si el número de partida no existe, el programa deberá indicar el error y volver a solicitar un número de partida correcto.
            $numeroPartida = 0;

            do {
                echo "Hay " . count($totalPartidas) . " partidas jugadas. Ingresa el número de la que desees ver con detalle: ";
                $numeroPartida = trim(fgets(STDIN));

                if ($numeroPartida < 1 || $numeroPartida > count($totalPartidas))
                    echo "Número fuera de rango.\n";
            } while ($numeroPartida < 1 || $numeroPartida > count($totalPartidas));

            $numeroPartida--;

            mostrarPartida($totalPartidas, $numeroPartida);

            break;
        case 4:
            //Mostrar la primer partida ganadora: Se le solicita al usuario un nombre de jugador y se muestra en pantalla el primer juego ganado por dicho jugador. En caso que el jugador no ganó ninguna partida, se debe indicar: “El jugador majo no ganó ninguna partida”.

            $nombreJugador = solicitarJugador();
            $valorIndice = obtenerPrimerPartidaGanada($totalPartidas, $nombreJugador);

            if ($valorIndice != -1) {
                echo "\nPartida WORDIX " . $valorIndice + 1 . ": palabra " . $totalPartidas[$valorIndice]["palabraWordix"] . "\nJugador: " . $totalPartidas[$valorIndice]["jugador"] . "\nPuntaje: " . $totalPartidas[$valorIndice]["puntaje"] . "\nIntentos: " . $totalPartidas[$valorIndice]["intentos"] . "\n";
            } else {
                echo "El jugador " . $nombreJugador . " no ganó ninguna partida.\n";
            }

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
                $coleccionPalabras = agregarPalabra($coleccionPalabras, $palabraNueva);
                $cantidadPalabras = count($coleccionPalabras);
            } else {
                echo "LLegó a la cantidad límite de palabras guardadas (" . $cantidadPalabras . "). Ya no puede agregar palabras nuevas.\n";
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