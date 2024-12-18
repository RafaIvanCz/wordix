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
 * Este módulo obtiene una colección de palabras
 * @return array string indexado
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


/**
 * Este módulo crea un arreglo multidimensional de 10 partidas al azar, cada una dentro de un arreglo asociativo indexado
 * @return array multidimensional de arreglos asociativos indexados 
 */
function cargarPartidas()
{
    //int $intentos, $puntaje
    //string $nombre, $palabra
    //boolean $esDuplicado
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

        do {
            $nombre = strtolower($nombreJugadores[rand(0, count($nombreJugadores) - 1)]);
            $palabra = $colecPalabras[rand(0, count($colecPalabras) - 1)];

            $esDuplicado = false;
            foreach ($partidasPreCargadas as $partida) {
                if ($partida["jugador"] == $nombre && $partida["palabraWordix"] == $palabra) {
                    $esDuplicado = true;
                    break;
                }
            }
        } while ($esDuplicado);

        $partidasPreCargadas[$i] = [
            "palabraWordix" => $palabra,
            "jugador" => $nombre,
            "intentos" => $intentos,
            "puntaje" => $puntaje
        ];
    }

    return ($partidasPreCargadas);
}


/**
 * Este módulo agrega una palabra nueva a un arreglo indexado de strings, ambos recibidos por parámetros
 * @param string[] $arrayPalabras arreglo indexado de palabras
 * @param string $nuevaPalabra
 * @return array string indexado
 */
function agregarPalabra($arrayPalabras, $nuevaPalabra)
{
    $arrayPalabras[] = $nuevaPalabra;

    return ($arrayPalabras);
}


/**
 * Este módulo recibe un arreglo asociativo y un número y muestra la partida de un jugador
 * @param array $partida arreglo asociativo
 * @param int $partidaNro
 */
function mostrarPartida($partida, $partidaNro)
{
    //string $mensajePartida
    $mensajePartida = "";

    if ($partida["puntaje"] == 0) {
        $mensajePartida = "No adivinó la palabra";
    } else {
        $mensajePartida = "Adivinó la palabra en " . $partida["intentos"] . " intentos";
    }
    echo "\n******************************************\n";
    echo "Partida WORDIX " . $partidaNro . ": palabra " . $partida["palabraWordix"] . "\nJugador: " . $partida["jugador"] . "\nPuntaje: " . $partida["puntaje"] . "\nIntentos: " . $mensajePartida;
    echo "\n******************************************\n";
}


/**
 * Este módulo solicita el nombre de un jugador
 * @return string
 */
function solicitarJugador()
{
    //string $nombre
    //boolean $esLetra
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


/**
 * Este módulo busca y devuelve el índice de la primer partida ganadora, en el caso de encontrarla, de un jugador específico
 * @param array $partidasTotales multidimensional de arreglos asociativos indexados
 * @param string $jugadorNombre
 * @return int
 */
function obtenerPrimerPartidaGanada($partidasTotales, $jugadorNombre)
{
    //int $indice
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


/**
 * Este módulo devuelve el resumen de partidas de un jugador específico
 * @param array $arregloPartidas multidimensional de arreglos asociativos indexados
 * @param string $nombreJugador
 * @return array asociativo
 */
function resumenJugador($arregloPartidas, $nombreJugador)
{
    //int $contadorPartidas, $puntajeTotal, $victoriasTotal, $porcentajeVictorias
    //int $intento, $intento1, $intento2, $intento3, $intento4, $intento5, $intento6
    $contadorPartidas = 0;
    $puntajeTotal = 0;
    $victoriasTotal = 0;
    $intento1 = 0;
    $intento2 = 0;
    $intento3 = 0;
    $intento4 = 0;
    $intento5 = 0;
    $intento6 = 0;

    foreach ($arregloPartidas as $partida) {
        if ($partida["jugador"] == $nombreJugador) {
            $contadorPartidas++;
            $puntajeTotal += $partida["puntaje"];

            if ($partida["puntaje"] > 0) {
                $victoriasTotal++;

                $intento = $partida["intentos"];

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


/**
 * Este módulo ordena por nombre y palabra un array multidimensional de arreglos asociativos indexados
 * con una función de comparación definida por el usuario y mantiene la asociación de índices.
 * @param array $a arreglo asociativo
 * @param array $b arreglo asociativo
 * @return int
 */
function ordenarPartidas($a, $b)
{
    //int $orden
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


/**
 * Este módulo invoca la función uasort() para ordenar y mostrar un array multidimensional de arreglos asociativos indexados
 * y luego utiliza la función print_r() para imprimir el contenido del array ordenado de manera estructurada por nombre y palabra.
 * @param $partidas multidimensional de arreglos asociativos indexados
 */
function coleccionPartidasOrdenadas($partidas)
{
    uasort($partidas, 'ordenarPartidas');

    echo "Colección de partidas ordenadas por jugador y palabra:\n";
    print_r($partidas);
}


/**
 * Este módulo muestra un menú de opciones
 * @return int
 */
function seleccionarOpcion()
{
    //int $opcion
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

/* Este programa principal le muestra al usuario un menú de opciones donde podrá ejecutar diferentes operaciones en el juego utilizando funciones para realizar distintos procesos */
// int $cantidadPartidas, $cantidadPalabras, $contadorPalabrasJugadas, $numeroPalabra, $numeroPartida, $valorIndice, $opcionElegida
// string $nombreUsuario, $nombreJugador, $nombreJugadorEstadistica, $palabraElegida, $palabraNueva
// boolean $existeJugador, $palabraUtilizada, $palabraExistente

//Declaración de variables:

$cantidadPartidas;
$cantidadPalabras;

//Inicialización de variables:
$partidaJugador = [];
$coleccionPartidas = cargarPartidas();
$coleccionTotalPalabras = cargarColeccionPalabras();
$contadorSaludo = 0;
$mensajeExplicacion = "\nDato IMPORTANTE antes de jugar!! \n -- Si una letra de la palabra que ingreses no está en la palabra misteriosa, se pintará de ROJO\n -- Si la letra está, pero la ubicación es incorrecta, se pintará de ANARANJADO\n -- Si la letra está en la posición correcta, se pintará de VERDE\n";

//Proceso:

do {

    $opcionElegida = seleccionarOpcion();
    $existeJugador = false;
    $cantidadPartidas = count($coleccionPartidas);
    $cantidadPalabras = count($coleccionTotalPalabras);

    switch ($opcionElegida) {
        case 1:
            //Jugar al wordix con una palabra elegida: se inicia la par da de wordix solicitando el nombre del jugador y un número de palabra para jugar. Si el número de palabra ya fue utilizada por el jugador, el programa debe indicar que debe elegir otro número de palabra. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.

            $nomJugador = "";
            $contadorPalabrasJugadas = 0;
            echo "Ingresa tu nombre: ";
            $nomJugador = strtolower(trim(fgets(STDIN)));

            foreach ($coleccionPartidas as $unaPartida) {
                if ($unaPartida["jugador"] == $nomJugador) {
                    $contadorPalabrasJugadas++;
                }
            }

            if ($contadorPalabrasJugadas == $cantidadPalabras) {
                echo "El jugador " . $nomJugador . " ya adivinó todas las palabras del juego.\n";
            } else {

                do {
                    $palabraUtilizada = false;
                    echo "Hay " . $cantidadPalabras . " palabras cargadas. ";
                    $numeroPalabra = solicitarNumeroEntre(1, $cantidadPalabras);
                    $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                    foreach ($coleccionPartidas as $unaPartida) {
                        if ($unaPartida["jugador"] == $nomJugador && $unaPartida["palabraWordix"] == $palabraElegida) {
                            echo "Palabra ya utilizada.\n";
                            $palabraUtilizada = true;
                            break;
                        }
                    }
                } while ($palabraUtilizada);

                if ($contadorSaludo == 0) {
                    echo $mensajeExplicacion;
                    $contadorSaludo++;
                }

                echo "\nTenés 6 chances para intentar adivinar la palabra misteriosa. ¡¡¡BUENA SUERTE!!!\n\n";
                $partidaJugador = jugarWordix($palabraElegida, $nomJugador);
                $coleccionPartidas[] = $partidaJugador;
            }

            break;
        case 2:
            //Jugar al wordix con una palabra aleatoria: se inicia la partida de wordix solicitando el nombre del jugador. El programa elegirá una palabra aleatoria de las disponibles para jugar, el programa debe asegurarse que la palabra no haya sido jugada por el Jugador. Luego de finalizar la partida, los datos de la partida deben ser guardados en una estructura de datos de partidas.            

            $contadorPalabrasJugadas = 0;
            echo "Ingresa tu nombre: ";
            $nombreUsuario = strtolower(trim(fgets(STDIN)));

            foreach ($coleccionPartidas as $unaPartida) {
                if ($unaPartida["jugador"] == $nombreUsuario) {
                    $contadorPalabrasJugadas++;
                }
            }

            if ($contadorPalabrasJugadas == $cantidadPalabras) {
                echo "El jugador " . $nombreUsuario . " ya adivinó todas las palabras del juego.\n";
            } else {

                do {
                    $palabraUtilizada = false;
                    $numeroPalabra = rand(1, $cantidadPalabras);
                    $palabraElegida = $coleccionTotalPalabras[$numeroPalabra - 1];

                    foreach ($coleccionPartidas as $unaPartida) {
                        if ($unaPartida["jugador"] == $nombreUsuario && $unaPartida["palabraWordix"] == $palabraElegida) {
                            $palabraUtilizada = true;
                            break;
                        }
                    }
                } while ($palabraUtilizada);


                if ($contadorSaludo == 0) {
                    echo $mensajeExplicacion;
                    $contadorSaludo++;
                }
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

            mostrarPartida($coleccionPartidas[($numeroPartida - 1)], $numeroPartida);

            break;
        case 4:
            //Mostrar la primer partida ganadora: Se le solicita al usuario un nombre de jugador y se muestra en pantalla el primer juego ganado por dicho jugador. En caso que el jugador no ganó ninguna partida, se debe indicar: “El jugador majo no ganó ninguna partida”.

            do {
                $nombreJugador = solicitarJugador();

                for ($i = 0; $i < $cantidadPartidas; $i++) {
                    if ($nombreJugador == $coleccionPartidas[$i]["jugador"]) {
                        $existeJugador = true;
                        break;
                    }
                }
                if (!$existeJugador) {
                    echo "El jugador no existe.\n";
                }
            } while (!$existeJugador);

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
            //Mostrar listado de partidas ordenadas por jugador y por palabra: Se mostrará en pantalla la estructura ordenada alfabéticamente por jugador y por palabra, utilizando la función predefinida uasort de php, y la función predefinida print_r. (En el código fuente documentar qué hace cada una de estas funciones predefinidas de php, utilizar el manual php.net). (Este es el único menú de opciones que debe utilizar la función print_r para mostrar la estructura de datos)

            coleccionPartidasOrdenadas($coleccionPartidas);

            break;
        case 7:
            //Agregar una palabra de 5 letras a Wordix: Debe solicitar una palabra de 5 letras al usuario y agregarla en mayúsculas a la colección de palabras que posee Wordix, para que el usuario pueda utlizarla para jugar.

            if ($cantidadPalabras < 20) {

                echo "Hay " . $cantidadPalabras . " palabras cargadas. Recordá que pueden ser hasta 20 como máximo.\n";

                do {
                    $palabraExistente = false;
                    $palabraNueva = leerPalabra5Letras();

                    foreach ($coleccionTotalPalabras as $palabra) {
                        if ($palabraNueva == $palabra) {
                            $palabraExistente = true;
                            echo "La palabra ya existe.\n";
                            break;
                        }
                    }
                } while ($palabraExistente);

                $coleccionTotalPalabras = agregarPalabra($coleccionTotalPalabras, $palabraNueva);

                echo "Palabra agregada con éxito!\n";
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