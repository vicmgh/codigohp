<?php
include("../conexion.php");
if ($_POST['action'] == 'sales') {


$diaSemana = date("w");

switch ($diaSemana){
    case 0: $diaSemanaFin = 0;
            $diaSemana = $diaSemana + 6;
            break;
    case 1: $diaSemanaFin = 6;
            $diaSemana = $diaSemana - 1;
            break;
    case 2: $diaSemanaFin = 5;
            $diaSemana = $diaSemana - 1;
            break;
    case 3: $diaSemanaFin = 4;
            $diaSemana = $diaSemana - 1;
            break;      
    case 4: $diaSemanaFin = 3;
            $diaSemana = $diaSemana - 1;
            break;
    case 5: $diaSemanaFin = 2;
            $diaSemana = $diaSemana - 1;
            break;
    case 6: $diaSemanaFin = 1;
            $diaSemana = $diaSemana - 1;
            break;
}


# Calcular el tiempo (no la fecha) de cuándo fue el inicio de semana
$tiempoDeInicioDeSemana = strtotime("-" . $diaSemana . " days"); # Restamos -X days
# Y formateamos ese tiempo
$fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);
# Ahora para el fin, sumamos
$tiempoDeFinDeSemana = strtotime("+" . $diaSemanaFin . " days");
# $tiempoDeFinDeSemana = strtotime("+" . $diaSemana . " days", $tiempoDeInicioDeSemana); # Sumamos +X days, pero partiendo del tiempo de inicio
# Y formateamos
$fechaFinSemana = date("Y-m-d", $tiempoDeFinDeSemana);



$desde = $fechaInicioSemana;
$hasta = $fechaFinSemana;



    /*$desde = date('Y') . '-01-01 00:00:00';
    $hasta = date('Y') . '-12-31 23:59:59';*/
    $query = mysqli_query($conexion, "SELECT SUM(IF(WEEKDAY(fecha) = 0, total, 0)) AS Lun,
    SUM(IF(WEEKDAY(fecha) = 1, total, 0)) AS Mar,
    SUM(IF(WEEKDAY(fecha) = 2, total, 0)) AS Mie,
    SUM(IF(WEEKDAY(fecha) = 3, total, 0)) AS Jue,
    SUM(IF(WEEKDAY(fecha) = 4, total, 0)) AS Vie,
    SUM(IF(WEEKDAY(fecha) = 5, total, 0)) AS Sab,
    SUM(IF(WEEKDAY(fecha) = 6, total, 0)) AS Dom 
    FROM pedidos WHERE fecha BETWEEN '$desde' AND '$hasta'");
    $arreglo = mysqli_fetch_assoc($query);
    echo json_encode($arreglo);
    die();
}
?>