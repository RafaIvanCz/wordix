<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Cruz, Rafael Iván; Legajo: FAI-5535; carrera: Tecnicatura Universitaria en Desarrollo Web; mail: rafael.cruz@est.fi.uncoma.edu.ar; Usuario Github: RafaIvanCz */

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
    $partidasPreCargadas = [];

    for ($i = 0; $i < 10; $i++) {
        $intentos = rand(0, 6);
        if ($intentos > 0) {
            $puntaje = rand(1, 18);
        } else {
            $puntaje = 0;
        }

        $partidasPreCargadas[$i] = [
            "palabraWordix" => $colecPalabras[rand(0, count($colecPalabras) - 1)],
            "jugador" => strtolower($nombreJugadores[rand(0, count($nombreJugadores) - 1)]),
            "intentos" => $intentos,
            "puntaje" => $puntaje
        ];
    }

    return ($partidasPreCargadas);
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

function mostrarPartida($partida, $partidaNro)
{
    $mensajePartida = "";

    if ($partida["puntaje"] == 0) {
        $mensajePartida = "No adivinó la palabra";
    } else {
        $mensajePartida = "Adivinó la palabra en " . $partida["intentos"] . " intentos";
    }
    echo "\n******************************************\n";
    echo "Partida WORDIX " . $partidaNro + 1 . ": palabra " . $partida["palabraWordix"] . "\nJugador: " . $partida["jugador"] . "\nPuntaje: " . $partida["puntaje"] . "\nIntentos: " . $mensajePartida;
    echo "\n******************************************\n";
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

        $partidaPorJugador = $partidasTotales[$i];

        if ($partidaPorJugador["jugador"] == $jugadorNombre && $partidaPorJugador["puntaje"] > 0) {
            $indice = $i;
            break;
        }
    }
    return $indice;
}

function resumenJugador($arregloPartidas, $nombreJugador)
{
    $contadorPartidas = 0;
    $puntajeTotal = 0;
    $victoriasTotal = 0;
    $intento1 = 0;
    $intento2 = 0;
    $intento3 = 0;
    $intento4 = 0;
    $intento5 = 0;
    $intento6 = 0;

    for ($i = 0; $i < count($arregloPartidas); $i++) {
        $partidaPorNombre = $arregloPartidas[$i];

        if ($partidaPorNombre["jugador"] == $nombreJugador) {
            $contadorPartidas++;
            $puntajeTotal += $partidaPorNombre["puntaje"];

            if ($partidaPorNombre["puntaje"] > 0) {
                $victoriasTotal++;

                $intento = $partidaPorNombre["intentos"];

                switch ($intento) {
                    case '1':
                        $intento1++;
                        break;
                    case '2':
                        $intento2++;
                        break;
                    case '3':
                        $intento3++;
                        break;
                    case '4':
                        $intento4++;
                        break;
                    case '5':
                        $intento5++;
                        break;
                    case '6':
                        $intento6++;
                        break;
                }
            }
        }
    }
    $porcentajeVictorias = (int)(($victoriasTotal * 100) / $contadorPartidas);

    $estadisticaJugador = [
        "jugador" => $nombreJugador,
        "partidas" => $contadorPartidas,
        "puntajeTotal" => $puntajeTotal,
        "victorias" => $victoriasTotal,
        "porcentajeVictorias" => $porcentajeVictorias,
        "intentoUno" => $intento1,
        "intentoDos" => $intento2,
        "intentoTres" => $intento3,
        "intentoCuatro" => $intento4,
        "intentoCinco" => $intento5,
        "intentoSeis" => $intento6
    ];

    return ($estadisticaJugador);
}

function ordenarPartidas($a, $b)
{
    if ($a["jugador"] == $b["jugador"]) {

        if ($a["palabraWordix"] == $b["palabraWordix"]) {
            $orden = 0;
        } elseif ($a["palabraWordix"] < $b["palabraWordix"]) {
            $orden = -1;
        } else {
            $orden = 1;
        }
    } elseif ($a["jugador"] < $b["jugador"]) {
        $orden = -1;
    } else {
        $orden = 1;
    }
    return $orden;
}

function coleccionPartidasOrdenadas($partidas)
{
    uasort($partidas, 'ordenarPartidas');

    echo "Colección de partidas ordenadas por jugador y palabra:\n";
    print_r($partidas);
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

$cantidadPartidas;

//Inicialización de variables:
$partidaJugador = [];
$coleccionPartidas = cargarPartidas();
$coleccionTotalPalabras = cargarColeccionPalabras();

$cantidadPartidas = count($coleccionPartidas);
$cantidadPalabras = count($coleccionTotalPalabras);

//Proceso:

do {
    $opcionElegida = seleccionarOpcion();

    switch ($opcionElegida) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.
            $palabraElegida = "";
            echo "Ingrese su nombre: ";
            $nombreUsuario = strtolower(trim(fgets(STDIN)));
            do {
                $palabraUtilizada = false;
                echo "Hay " . $cantidadPalabras . " palabras cargadas. ";
                $numeroPalabra = solicitarNumeroEntre(1, $cantidadPalabras);
                $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < $cantidadPartidas; $i++) {
                    $unaPartida = $coleccionPartidas[$i];
                    if ($unaPartida["jugador"] == $nombreUsuario && $unaPartida["palabraWordix"] == $palabraElegida) {
                        echo "Palabra ya utilizada.\n";
                        $palabraUtilizada = true;
                        break;
                    }
                }
            } while ($palabraUtilizada);

            echo "\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
            $partidaJugador = jugarWordix($palabraElegida, $nombreUsuario);
            $coleccionPartidas[] = $partidaJugador;

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la partida de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.
            $palabraElegida = "";
            $contadorPalabras = 1;
            echo "Ingrese su nombre: ";
            $nombreUsuario = strtolower(trim(fgets(STDIN)));

            do {
                $palabraUtilizada = false;
                $numeroPalabra = rand(1, $cantidadPalabras);
                $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                for ($i = 0; $i < $cantidadPartidas; $i++) {
                    $unaPartida = $coleccionPartidas[$i];
                    if ($unaPartida["jugador"] == $nombreUsuario && $unaPartida["palabraWordix"] == $palabraElegida) {
                        $palabraUtilizada = true;
                        $contadorPalabras++;
                        break;
                    }
                }

                if ($contadorPalabras == $cantidadPalabras) {
                    break;
                }
            } while ($palabraUtilizada);

            if ($contadorPalabras == $cantidadPalabras) {
                echo "El jugador " . $nombreUsuario . " ya adivinó todas las palabras del juego.";
            } else {
                echo "\nLa palabra fue elegida al azar y no será una que ya hayas jugado.\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
                $partidaJugador = jugarWordix($palabraElegida, $nombreUsuario);
                $coleccionPartidas[] = $partidaJugador;
            }

            break;
        case 3:
            //Mostrar una partida: Se le solicita al usuario un número de partida y se muestra en pantalla con el siguiente formato:
            //Partida WORDIX <numero>: palabra <palabra>
            //Jugador: <nombre>
            //Puntaje: <puntaje> puntos
            //Intento: No adivinó la palabra | Adivinó la palabra en <X> intentos
            //Si el número de partida no existe, el programa deberá indicar el error y volver a solicitar un número de partida correcto.

            echo "Hay " . $cantidadPartidas . " partidas jugadas. ";
            $numeroPartida = solicitarNumeroEntre(1, $cantidadPartidas);

            $numeroPartida--;

            mostrarPartida($coleccionPartidas[$numeroPartida], $numeroPartida);

            break;
        case 4:
            //Mostrar la primer partida ganadora: Se le solicita al usuario un nombre de jugador y se muestra en pantalla el primer juego ganado por dicho jugador. En caso que el jugador no ganó ninguna partida, se debe indicar: “El jugador majo no ganó ninguna partida”.

            $nombreJugador = solicitarJugador();
            $valorIndice = obtenerPrimerPartidaGanada($coleccionPartidas, $nombreJugador);

            if ($valorIndice != -1) {
                $partidaUnica = $coleccionPartidas[$valorIndice];

                echo "\n******************************************\n";
                echo "Partida WORDIX " . $valorIndice + 1 . ": palabra " . $partidaUnica["palabraWordix"] . "\nJugador: " . $partidaUnica["jugador"] . "\nPuntaje: " . $partidaUnica["puntaje"] . "\nIntentos: " . $partidaUnica["intentos"];
                echo "\n******************************************\n";
            } else {
                echo "El jugador " . $nombreJugador . " no ganó ninguna partida.\n";
            }

            break;
        case 5:
            // Mostrar Estadísticas Jugador: Se le solicita al usuario que ingrese un nombre de jugador y se muestra su estadística.
            $existeJugador = false;

            do {
                $nombreJugadorEstadistica = solicitarJugador();

                for ($i = 0; $i < $cantidadPartidas; $i++) {
                    if ($nombreJugadorEstadistica == $coleccionPartidas[$i]["jugador"]) {
                        $existeJugador = true;
                        break;
                    }
                }
                if (!$existeJugador) {
                    echo "El jugador no existe.\n";
                }
            } while (!$existeJugador);

            $jugadorResumen = resumenJugador($coleccionPartidas, $nombreJugadorEstadistica);

            echo "\n*************************************\n";
            echo "Jugador: " . $jugadorResumen["jugador"] . "\nPartidas: " . $jugadorResumen["partidas"] . "\nPuntaje Total: " . $jugadorResumen["puntajeTotal"] . "\nVictorias: " . $jugadorResumen["victorias"] . "\nPorcentaje Victorias: " . $jugadorResumen["porcentajeVictorias"] . "%\nAdivinadas:\n\tIntento 1: " . $jugadorResumen["intentoUno"] . "\n\tIntento 2: " . $jugadorResumen["intentoDos"] . "\n\tIntento 3: " . $jugadorResumen["intentoTres"] . "\n\tIntento 4: " . $jugadorResumen["intentoCuatro"] . "\n\tIntento 5: " . $jugadorResumen["intentoCinco"] . "\n\tIntento 6: " . $jugadorResumen["intentoSeis"];
            echo "\n*************************************\n";

            break;
        case 6:
            //Mostrar listado de partidas ordenadas por jugador y por palabra: Se mostrará en pantalla la estructura ordenada alfabéticamente por jugador y por palabra , utilizando la función predefinida uasort de php, y la función predefinida print_r. (En el código fuente documentar qué hace cada una de estas funciones predefinidas de php, utilizar el manual php.net). (Este es el único menú de opciones que debe utilizar la función print_r para mostrar la estructura de datos)

            coleccionPartidasOrdenadas($coleccionPartidas);
            
            break;
        case 7:
            //Agregar una palabra de 5 letras a Wordix: Debe solicitar una palabra de 5 letras al usuario y agregarla en mayúsculas a la colección de palabras que posee Wordix, para que el usuario pueda utlizarla para jugar.

            if ($cantidadPalabras < 20) {
                echo "Hay " . $cantidadPalabras . " palabras cargadas. Recordá que pueden ser hasta 20 como máximo.\n";
                $palabraNueva = leerPalabra5Letras();
                $coleccionTotalPalabras = agregarPalabra($coleccionTotalPalabras, $palabraNueva);
                $cantidadPalabras = count($coleccionTotalPalabras);

                if ($cantidadPalabras == 20) {
                    echo "\nLLegaste a la cantidad máxima de palabras guardadas!\n";
                }
            } else {
                echo "LLegaste a la cantidad máxima de palabras guardadas (" . $cantidadPalabras . "). Ya no podes agregar palabras nuevas.\n";
            }

            break;
        case 8:
            echo "Hasta pronto!👋👋👋\n";
            break;
        default:
            echo "Opción incorrecta.\n";
            break;
    }
} while ($opcionElegida != 8);


                    
//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);