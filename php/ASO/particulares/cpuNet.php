<?php
include("../../conexion_e2e_process.php");

/* Query fecha menos 24 horas
function busqueda($MAQUINA,$FECHA_QUERY){
  $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%d/%m/%y-%k')as fecha,
                                    cpu
                            FROM    seguimiento_cx_maquina
                            WHERE   maquina = '".$MAQUINA."'
                            AND     canal = 'net'
                            AND     fecha > DATE_SUB('".$FECHA_QUERY."', INTERVAL 24 HOUR)
                            AND     fecha <= '".$FECHA_QUERY."'");
  return $resultado;
}*/

/*query*/
function busqueda($MAQUINA,$FECHA_QUERY){
  $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%k:%i')as fecha,
                                    cpu
                            FROM    seguimiento_cx_maquina
                            WHERE   maquina = '".$MAQUINA."'
                            AND     canal = 'net'
                            AND     fecha like '".$FECHA_QUERY."%'");
  return $resultado;
}

/*Declaracion de arrays json*/
$category = array();
$series1 = array();
$series2 = array();
$series3 = array();
$series4 = array();
$series5 = array();
$series6 = array();
$series7 = array();
$series8 = array();
$series9 = array();
$series10 = array();
$series11 = array();
$series12 = array();
$series13 = array();
$series14 = array();
$series15 = array();
$series16 = array();
$series17 = array();
$series18 = array();

/*Recuperar variables de sesión que contienen las fechas a comparar*/
session_start();
$from = $_SESSION["fechaFromNet"];
$newFrom = date("Y-m-d", strtotime($from));
$to=$_SESSION["fechaToNet"];
$newTo = date("Y-m-d", strtotime($to));

/*Declaración variables*/
$lpsrn302CpuHoy = busqueda('lpsrn302',$newTo);
$lpsrv301CpuHoy = busqueda('lpsrv301',$newTo);
$lpsrv302CpuHoy = busqueda('lpsrv302',$newTo);
$lpsrv303CpuHoy = busqueda('lpsrv303',$newTo);
$lpsrn301CpuHoy = busqueda('lpsrn301',$newTo);
$lpsrv304CpuHoy = busqueda('lpsrv304',$newTo);
$lpsrv319CpuHoy = busqueda('lpsrv319',$newTo);
$lpsrv320CpuHoy = busqueda('lpsrv320',$newTo);
$lpsrv321CpuHoy = busqueda('lpsrv321',$newTo);

$lpsrn302CpuPasada = busqueda('lpsrn302',$newFrom);
$lpsrv301CpuPasada = busqueda('lpsrv301',$newFrom);
$lpsrv302CpuPasada = busqueda('lpsrv302',$newFrom);
$lpsrv303CpuPasada = busqueda('lpsrv303',$newFrom);
$lpsrn301CpuPasada = busqueda('lpsrn301',$newFrom);
$lpsrv304CpuPasada = busqueda('lpsrv304',$newFrom);
$lpsrv319CpuPasada = busqueda('lpsrv319',$newFrom);
$lpsrv320CpuPasada = busqueda('lpsrv320',$newFrom);
$lpsrv321CpuPasada = busqueda('lpsrv321',$newFrom);

/*Recuperación datos*/
$category['name'] = 'fecha';
$titulo['text'] = "<b>$from</b> comparado con <b>$to</b>";

while($r1 = mysql_fetch_array($lpsrn302CpuPasada)) {
      $series1['data'][] = $r1['cpu'];
    }
while($r2 = mysql_fetch_array($lpsrv301CpuPasada)) {
      $series2['data'][] = $r2['cpu'];
    }
while($r3 = mysql_fetch_array($lpsrv302CpuPasada)) {
      $series3['data'][] = $r3['cpu'];
    }
while($r4 = mysql_fetch_array($lpsrv303CpuPasada)) {
      $series4['data'][] = $r4['cpu'];
    }
while($r5 = mysql_fetch_array($lpsrn301CpuPasada)) {
      $series5['data'][] = $r1['cpu'];
    }
while($r6 = mysql_fetch_array($lpsrv304CpuPasada)) {
      $series6['data'][] = $r6['cpu'];
    }
while($r7 = mysql_fetch_array($lpsrv319CpuPasada)) {
      $series7['data'][] = $r7['cpu'];
    }
while($r8 = mysql_fetch_array($lpsrv320CpuPasada)) {
      $series8['data'][] = $r8['cpu'];
    }
while($r9 = mysql_fetch_array($lpsrv321CpuPasada)) {
      $series9['data'][] = $r9['cpu'];
    }

while($r10 = mysql_fetch_array($lpsrn302CpuHoy)) {
      $category['data'][] = $r10['fecha'];
      $series10['data'][] = $r10['cpu'];
    }
while($r11 = mysql_fetch_array($lpsrv301CpuHoy)) {
      $series11['data'][] = $r11['cpu'];
    }
while($r12 = mysql_fetch_array($lpsrv302CpuHoy)) {
      $series12['data'][] = $r12['cpu'];
    }
while($r13 = mysql_fetch_array($lpsrv303CpuHoy)) {
      $series13['data'][] = $r13['cpu'];
    }
while($r14 = mysql_fetch_array($lpsrn301CpuHoy)) {
      $series14['data'][] = $r14['cpu'];
    }
while($r15 = mysql_fetch_array($lpsrv304CpuHoy)) {
      $series15['data'][] = $r15['cpu'];
    }
while($r16 = mysql_fetch_array($lpsrv319CpuHoy)) {
      $series16['data'][] = $r16['cpu'];
    }
while($r17 = mysql_fetch_array($lpsrv320CpuHoy)) {
      $series17['data'][] = $r17['cpu'];
    }
while($r18 = mysql_fetch_array($lpsrv321CpuHoy)) {
      $series18['data'][] = $r18['cpu'];
    }

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
array_push($datos,$series15);
array_push($datos,$series16);
array_push($datos,$series17);
array_push($datos,$series18);
array_push($datos,$titulo);

print json_encode($datos, JSON_NUMERIC_CHECK);

mysql_close($conexion);

?>