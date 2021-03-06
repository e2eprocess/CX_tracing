<?php
require_once("../conexion_e2e_process.php");
require_once("../querys/informeMensual/informeMensual.php");

$maxPeticiones = max_peti('apx');
$r8 = pg_fetch_assoc($maxPeticiones);
$newFrom = $r8['fecha_max'];

$newToF = date("Y-m-d 00:00");
$newTo = date("Y-m-d H:i", strtotime('-10 minute'));
$to = date("Y-m-d");

$titulo['text'] = "<b>$newFrom</b> comparado con <b>$to</b>";

$lppxo301CpuHoy = busquedaMaquinaHoy('lppxo301',$newToF,$newTo);
$lppxo302CpuHoy = busquedaMaquinaHoy('lppxo302',$newToF,$newTo);
$lppxo303CpuHoy = busquedaMaquinaHoy('lppxo303',$newToF,$newTo);
$lppxo304CpuHoy = busquedaMaquinaHoy('lppxo304',$newToF,$newTo);
$lppxo305CpuHoy = busquedaMaquinaHoy('lppxo305',$newToF,$newTo);
$lppxo309CpuHoy = busquedaMaquinaHoy('lppxo309',$newToF,$newTo);
$lppxo310CpuHoy = busquedaMaquinaHoy('lppxo310',$newToF,$newTo);

$lppxo301CpuPasada = busquedaMaquina('lppxo301',$newFrom);
$lppxo302CpuPasada = busquedaMaquina('lppxo302',$newFrom);
$lppxo303CpuPasada = busquedaMaquina('lppxo303',$newFrom);
$lppxo304CpuPasada = busquedaMaquina('lppxo304',$newFrom);
$lppxo305CpuPasada = busquedaMaquina('lppxo305',$newFrom);
$lppxo309CpuPasada = busquedaMaquina('lppxo309',$newFrom);
$lppxo310CpuPasada = busquedaMaquina('lppxo310',$newFrom);

/*Recuperación datos*/
$category['name'] = 'fecha';

while($r1 = pg_fetch_assoc($lppxo301CpuPasada)) {
      $category['data'][] = $r1['fecha'];
      $series1['data'][] = $r1['cpu'];
    }
while($r2 = pg_fetch_assoc($lppxo302CpuPasada)) {
      $series2['data'][] = $r2['cpu'];
    }
while($r3 = pg_fetch_assoc($lppxo303CpuPasada)) {
      $series3['data'][] = $r3['cpu'];
    }
while($r4 = pg_fetch_assoc($lppxo304CpuPasada)) {
      $series4['data'][] = $r4['cpu'];
    }
while($r5 = pg_fetch_assoc($lppxo305CpuPasada)) {
      $series5['data'][] = $r5['cpu'];
    }
while($r6 = pg_fetch_assoc($lppxo309CpuPasada)) {
      $series6['data'][] = $r6['cpu'];
    }
while($r7 = pg_fetch_assoc($lppxo310CpuPasada)) {
      $series7['data'][] = $r7['cpu'];
    }

while($r8 = pg_fetch_assoc($lppxo301CpuHoy)) {
      $series8['data'][] = $r8['cpu'];
    }
while($r9 = pg_fetch_assoc($lppxo302CpuHoy)) {
      $series9['data'][] = $r9['cpu'];
    }
while($r10 = pg_fetch_assoc($lppxo303CpuHoy)) {
      $series10['data'][] = $r10['cpu'];
    }
while($r11 = pg_fetch_assoc($lppxo304CpuHoy)) {
      $series11['data'][] = $r11['cpu'];
    }
while($r12 = pg_fetch_assoc($lppxo305CpuHoy)) {
      $series12['data'][] = $r12['cpu'];
    }
while($r13 = pg_fetch_assoc($lppxo309CpuHoy)) {
      $series13['data'][] = $r13['cpu'];
    }
while($r14 = pg_fetch_assoc($lppxo310CpuHoy)) {
      $series14['data'][] = $r14['cpu'];
    }

/*Carga del array del Json*/
$datos = array();
array_push($datos,$category);
array_push($datos,$series1);
array_push($datos,$series2);
array_push($datos,$series3);
array_push($datos,$series4);
array_push($datos,$series5);
array_push($datos,$series6);
array_push($datos,$series7);
array_push($datos,$series8);
array_push($datos,$series9);
array_push($datos,$series10);
array_push($datos,$series11);
array_push($datos,$series12);
array_push($datos,$series13);
array_push($datos,$series14);
array_push($datos,$titulo);

print json_encode($datos, JSON_NUMERIC_CHECK);

pg_close($db_con);

?>
