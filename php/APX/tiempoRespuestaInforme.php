<?php
require_once("../conexion_e2e_process.php");
require_once("../querys/informeMensual/informeMensual.php");

$maxPeticiones = max_peti('apx');
$r8 = pg_fetch_assoc($maxPeticiones);
$newFrom = $r8['fecha_max'];

$newToF = date("Y-m-d 00:00");
$newTo = date("Y-m-d H:i", strtotime('-20 minute'));
$to = date("Y-m-d");

$titulo['text'] = "<b>$newFrom</b> comparado con <b>$to</b>";

$newToF = date("Y-m-d 00:00");
$newTo = date("Y-m-d H:i", strtotime('-20 minute'));
$tiempoHoy = busquedaTimeHoy('apx',$newToF,$newTo, 'Time');

/*Declaración variables*/
$tiempoPasada = busquedaTime('apx', $newFrom, 'Time');

$category['name'] = 'fecha';

while($r1 = pg_fetch_assoc($tiempoPasada)) {
      $category['data'][] = $r1['fecha'];
      $series1['data'][] = $r1['tiempo_respuesta'];
    }
while($r2 = pg_fetch_assoc($tiempoHoy)) {
      $series2['data'][] = $r2['tiempo_respuesta'];
    }

$datos = array();
array_push($datos,$category);
array_push($datos,$series1);
array_push($datos,$series2);
array_push($datos,$titulo);

print json_encode($datos, JSON_NUMERIC_CHECK);

pg_close($db_con);

?>
