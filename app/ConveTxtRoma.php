<?php

//CODIGO PARA CONVERTIR NUMEROS POSITIVOS A TEXTO

/*declara un array con la representación alfabética de los números 
*comprendidos entre 1 y 29. Esta característica se debe a que dichos 
*números no siguen un diagrama para su escritura*/
function basico($numero)
{
    $valor = array(
        'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho',
        'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciseis', 'diecisiete', 'dieciocho',
        'diecinueve', 'veinte', 'veintiuno ', 'vientidos ', 'veintitrés ', 'veinticuatro', 'veinticinco',
        'veintiséis', 'veintisiete', 'veintiocho', 'veintinueve'
    );
    return $valor[$numero - 1];
}

//declara un arreglo que contiene la conversión de los números 30, 40 … y 90.
function decenas($n)
{
    $decenas = array(
        30 => 'treinta', 40 => 'cuarenta', 50 => 'cincuenta', 60 => 'sesenta',
        70 => 'setenta', 80 => 'ochenta', 90 => 'noventa'
    );
    if ($n <= 29) return basico($n);

    $x = $n % 10;    //obtiene el módulo 10 de n.

    if ($x == 0) {
        /**Si el módulo del codigo 10 de n es cero se regresa la 
         * posición asociada a n en el vector decenas(línea 17) */
        return $decenas[$n];
    } else return $decenas[$n - $x] . ' y ' . basico($x);
    /**Si el módulo del codigo 10 de n es diferente de cero.
     *Se regresa la posición asociada a n en el vector decenas 
     *y se hace un llamado a la función básico */
}

/**declaramos un arreglo para la representación alfabética de los números 100,200, … y 900 */
function centenas($n)
{
    $cientos = array(
        100 => 'cien', 200 => 'doscientos', 300 => 'trecientos',
        400 => 'cuatrocientos', 500 => 'quinientos', 600 => 'seiscientos',
        700 => 'setecientos', 800 => 'ochocientos', 900 => 'novecientos'
    );

    if ($n >= 100) {
        if ($n % 100 == 0) {
            return $cientos[$n];
        } else {
            /** operador ternario para poder manejar la escritura de 
             *los números comprendidos entre 101 y 199 */
            $u = (int) substr($n, 0, 1);
            $d = (int) substr($n, 1, 2);
            return (($u == 1) ? 'ciento' : $cientos[$u * 100]) . ' ' . decenas($d);
        }
    } else return decenas($n);
}

function miles($n)
{
    if ($n > 999) {
        /**obtiene la longitud de n. En el caso de los miles está longitud varía entre 4 y 6.
        substr($cadena, -3) obtiene los últimos 3 caracteres de la cadena, línea 70 */
        if ($n == 1000) {
            return 'mil';
        } else {
            $l = strlen($n);
            $c = (int)substr($n, 0, $l - 3);
            $x = (int)substr($n, -3);
            if ($c == 1) {
                $cadena = 'mil ' . centenas($x);
            } else if ($x != 0) {
                $cadena = centenas($c) . ' mil ' . centenas($x);
            } else $cadena = centenas($c) . ' mil';

            return $cadena;
        }
    } else return centenas($n);
}
/**strlen > obtiene la longitud de una cadena y devuelve un número entero */
function millones($n)
{
    if ($n == 1000000) {
        return 'un millón';
    } else {
        $l = strlen($n);
        $c = (int)substr($n, 0, $l - 6);
        $x = (int)substr($n, -6);
        if ($c == 1) {
            $cadena = ' millón ';
        } else {
            $cadena = ' millones ';
        }
        return miles($c) . $cadena . (($x > 0) ? miles($x) : '');
    }
}

//Funcion donde se hace el filtrado del numero y la union de las demas funciones
function ConvertirNumTxt($n)
{
    switch (true) {
        case ($n >= 1 && $n <= 29):
            return basico($n);
            break;
        case ($n >= 30 && $n < 100):
            return decenas($n);
            break;
        case ($n >= 100 && $n < 1000):
            return centenas($n);
            break;
        case ($n >= 1000 && $n <= 999999):
            return miles($n);
            break;
        case ($n >= 1000000):
            return millones($n);
    }
}

//CODIGO PARA CONVERTIR NUMEROS POSITIVOS A ROMANOS
function ConverNumRomano($num)
{
    // Asegúrese de convertir el parámetro dado en un número entero
    $n = intval($num);
    $result = '';

    // Declare una matriz de búsqueda que usaremos para recorrer el número:
    $variable = array(
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
    );
    /**foreach nos sirve para recorrer un array ne N datos (practico) */
    foreach ($variable as $romano => $numero) {
        // Busque el número de coincidencias
        $nume = intval($n / $numero);

        // Concatenar personajes
        $result .= str_repeat($romano, $nume);

        // Resta eso del número
        $n = $n % $numero;
    }

    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML5, CSS3, php">
    <title> Conversor </title>
    <link rel="stylesheet" href="main.css">

    <link rel="icon" type="image/x-icon" href="../icons/co-blue.png" />

</head>

<body class="home">
    <nav id="recuadro">
        <div class="padre">
            <?php
            $opc = $_POST['opc'];
            switch ($opc) {
                case 1:
                    echo "<h3 >Numero en cadena de texto (Es)</h3>";
                    echo $_POST['numero'] . ' se escribe en texto −⫸ ';
                    $html = '<b>' . ucfirst(ConvertirNumTxt($_POST['numero'])) . '</b>';
                    echo $html;

                    break;
                case 2:
                    echo "<h3>Numero entero a Romano</h3>";
                    echo $_POST['numero'] . ' se escribe en numero romano −⫸ ';
                    $html = '<b>' . ucfirst(ConverNumRomano($_POST['numero'])) . '</b>';
                    echo $html;
                    break;
                default:
                    echo "Ocurrio un error en el transcurzo...";
                    break;
            }
            ?>
        </div>
        <footer class="footer">
            <div class="line"></div>
            <a href="https://sorian.ml/">© Sorian</a>
            <script type="text/javascript">
                copyright = new Date();
                update = copyright.getFullYear();
                document.write(" " + update + "   By <b> <i>Alan Atilio ");
            </script>
        </footer>
    </nav>
</body>

</html>