<?php
  include("../../conexion_e2e_process.php");

  /* Query fecha menos 24 horas
  function busqueda($CANAL,$FECHA_QUERY){
    $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%d/%m/%y-%k')as fecha,
                                      Tiempo_respuesta
                              FROM    seguimiento_cx_canal
                              WHERE   canal like '".$CANAL."'
                              AND     fecha > DATE_SUB('".$FECHA_QUERY."', INTERVAL 24 HOUR)
                              AND     fecha <= '".$FECHA_QUERY."'");
    return $resultado;
  }*/

  /*query*/
  function busqueda($CANAL,$FECHA_QUERY){
    $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%k:%i')as fecha,
                                      Tiempo_respuesta
                              FROM    seguimiento_cx_canal
                              WHERE   canal = '".$CANAL."'
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

  /*Recuperar variables de sesión que contienen las fechas a comparar*/
  session_start();
  $from = $_SESSION["fechaFromNet"];
  $newFrom = date("Y-m-d", strtotime($from));
  $to=$_SESSION["fechaToNet"];
  $newTo = date("Y-m-d", strtotime($to));

  /*Declaración variables*/
  $frontusuarioHoy = busqueda('kygu_mult_web_frontusuario_02',$newTo);
  $serviciousuarioHoy = busqueda('kygu_mult_web_serviciosusuario_01',$newTo);

  $frontusuarioPasada = busqueda('kygu_mult_web_frontusuario_02', $newFrom);
  $serviciousuarioPasada = busqueda('kygu_mult_web_serviciosusuario_01', $newFrom);

  /*Recuperación datos*/
  $category['name'] = 'fecha';
  $titulo['text'] = "<b>$from</b> comparado con <b>$to</b>";

  while($r1 = mysql_fetch_array($frontusuarioPasada)) {
        $category['data'][] = $r1['fecha'];
        $series1['data'][] = $r1['Tiempo_respuesta'];
      }
  while($r2 = mysql_fetch_array($serviciousuarioPasada)) {
        $series2['data'][] = $r2['Tiempo_respuesta'];
      }

  while($r3 = mysql_fetch_array($frontusuarioHoy)) {
        $series3['data'][] = $r3['Tiempo_respuesta'];
      }
  while($r4 = mysql_fetch_array($serviciousuarioHoy)) {
        $series4['data'][] = $r4['Tiempo_respuesta'];
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