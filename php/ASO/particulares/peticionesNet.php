<?php
  include("../../conexion_e2e_process.php");

  /*Query fecha menos 24 horas
  function busqueda($CANAL,$FECHA_QUERY){
    $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%d/%m/%y-%k')as fecha,
                                      peticiones,
                                      max_peticiones
                              FROM    seguimiento_cx_canal
                              WHERE   canal like '".$CANAL."'
                              AND     fecha > DATE_SUB('".$FECHA_QUERY."', INTERVAL 24 HOUR)
                              AND     fecha <= '".$FECHA_QUERY."'");
    return $resultado;
  }*/

  /*query*/
  function busqueda($CANAL,$FECHA_QUERY){
    $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%k:%i')as fecha,
                                      peticiones,
                                      max_peticiones
                              FROM    seguimiento_cx_canal
                              WHERE   canal like '".$CANAL."'
                              AND     fecha like '".$FECHA_QUERY."%'");
    return $resultado;
  }

  /*Declaracion de arrays json*/
  $category = array();
  $titulo = array();
  $series1 = array();
  $series2 = array();
  $series3 = array();
  $series4 = array();
  $series5 = array();

  /*Recuperar variables de sesión que contienen las fechas a comparar*/
  session_start();
  $from = $_SESSION["fechaFromNet"];
  $newFrom = date("Y-m-d", strtotime($from));
  $to=$_SESSION["fechaToNet"];
  $newTo = date("Y-m-d", strtotime($to));

  /*Declaración variables*/
  $gtHoy = busqueda('%gtnet%',$newTo);
  $servicioHoy = busqueda('%ASOnet%',$newTo);

  $gtPasada = busqueda('%gtnet%', $newFrom);
  $servicioPasada = busqueda('%ASOnet%', $newFrom);

  /*Recuperación datos*/
  $category['name'] = 'fecha';
  $titulo['text'] = "<b>$from</b> comparado con <b>$to</b>";

  while($r1 = mysql_fetch_array($gtPasada)) {
        $category['data'][] = $r1['fecha'];
        $series1['data'][] = $r1['peticiones'];
      }
  while($r2 = mysql_fetch_array($servicioPasada)) {
        $series2['data'][] = $r2['peticiones'];
      }

  while($r3 = mysql_fetch_array($gtHoy)) {
        $series3['data'][] = $r3['peticiones'];
      }
  while($r4 = mysql_fetch_array($servicioHoy)) {
        $series4['data'][] = $r4['peticiones'];
      }

  $datos = array();
  array_push($datos,$category);
  array_push($datos,$series1);
  array_push($datos,$series2);
  array_push($datos,$series3);
  array_push($datos,$series4);
  array_push($datos,$titulo);

  print json_encode($datos, JSON_NUMERIC_CHECK);

  mysql_close($conexion);

?>