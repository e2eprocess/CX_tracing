<?php
  require_once("../../conexion_e2e_process.php");
  require_once("../../queryPeticiones.php");

  /*Declaracion de arrays json*/
  $category = array();
  $titulo = array();
  $series1 = array();
  $series2 = array();
  $series3 = array();

  /*Recuperar variables de sesión que contienen las fechas a comparar*/
  session_start();
  $from = $_SESSION["fechaFromNet"];
  $newFrom = date("Y-m-d", strtotime($from));
  $to=$_SESSION["fechaToNet"];
  $newTo = date("Y-m-d", strtotime($to));

  /*Declaración variables*/
  /*gestion fechas*/
  if(date("Y-m-d")==$newTo){
    $newToF = date("Y-m-d 00:00");
    $newTo = date("Y-m-d H:i", strtotime('-10 minute'));
    $peticionesHoy = busquedaHoy('kyop_mult_web_kyoppresentation',$newToF,$newTo,'Throughput');

  }
  else {
    $peticionesHoy = busqueda('kyop_mult_web_kyoppresentation',$newTo,'Throughput');
  }
  $peticionesPasada = busqueda('kyop_mult_web_kyoppresentation', $newFrom,'Throughput');
  $maxPeticiones = max_peti('kyop_mult_web_kyoppresentation');

  $r8 = pg_fetch_assoc($maxPeticiones);
  $max_peti = $r8['max_peticiones'];
  $Fecha_peti = $r8['fecha'];
  $TituloPeticiones = "Max. peticiones $Fecha_peti";

  $category['name'] = 'fecha';
  $titulo['text'] = "<b>$from</b> comparado con <b>$to</b>";


  while($r1  = pg_fetch_assoc($peticionesPasada)) {
        $category['data'][] = $r1['fecha'];
        $series1['data'][] = $r1['peticiones'];
        $series3['data'][] = $max_peti;
      }

  while($r2 = pg_fetch_assoc($peticionesHoy)) {
        $series2['data'][] = $r2['peticiones'];
      }

  $datos = array();
  array_push($datos,$category);
  array_push($datos,$series1);
  array_push($datos,$series2);
  array_push($datos,$series3);
  array_push($datos,$titulo);
  array_push($datos,$TituloPeticiones);

  print json_encode($datos, JSON_NUMERIC_CHECK);

  pg_close($db_con);

?>
