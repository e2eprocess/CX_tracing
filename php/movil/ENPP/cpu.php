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
  function busqueda($MAQUINA,$INSTANCIAS,$FECHA_QUERY){
    $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%k:%i')as fecha,
                                      cpu
                              FROM    informe_instancias
                              WHERE   maquina = '".$MAQUINA."'
                              AND     instancias = '".$INSTANCIAS."'
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
  $series19 = array();
  $series20 = array();
  $series21 = array();
  $series22 = array();
  $series23 = array();
  $series24 = array();


  /*Recuperar variables de sesión que contienen las fechas a comparar*/
  session_start();
  $from = $_SESSION["fechaFromNet"];
  $newFrom = date("Y-m-d", strtotime($from));
  $to=$_SESSION["fechaToNet"];
  $newTo = date("Y-m-d", strtotime($to));

  /*Declaración variables*/
  $ENPP_501_20_To = busqueda('apbad002','ENPP_501_20',$newTo);
  $ENPP_501_21_To = busqueda('apbad002','ENPP_501_21',$newTo);
  $ENPP_501_22_To = busqueda('apbad002','ENPP_501_22',$newTo);
  $ENPP_501_30_To = busqueda('apbad003','ENPP_501_30',$newTo);
  $ENPP_501_31_To = busqueda('apbad003','ENPP_501_31',$newTo);
  $ENPP_501_32_To = busqueda('apbad003','ENPP_501_32',$newTo);
  $ENPP_501_40_To = busqueda('apbad004','ENPP_501_40',$newTo);
  $ENPP_501_41_To = busqueda('apbad004','ENPP_501_41',$newTo);
  $ENPP_501_42_To = busqueda('apbad004','ENPP_501_42',$newTo);
  $ENPP_501_60_To = busqueda('apbad006','ENPP_501_60',$newTo);
  $ENPP_501_61_To = busqueda('apbad006','ENPP_501_61',$newTo);
  $ENPP_501_62_To = busqueda('apbad006','ENPP_501_62',$newTo);

  $ENPP_501_20_From = busqueda('apbad002','ENPP_501_20',$newFrom);
  $ENPP_501_21_From = busqueda('apbad002','ENPP_501_21',$newFrom);
  $ENPP_501_22_From = busqueda('apbad002','ENPP_501_22',$newFrom);
  $ENPP_501_30_From = busqueda('apbad003','ENPP_501_30',$newFrom);
  $ENPP_501_31_From = busqueda('apbad003','ENPP_501_31',$newFrom);
  $ENPP_501_32_From = busqueda('apbad003','ENPP_501_32',$newFrom);
  $ENPP_501_40_From = busqueda('apbad004','ENPP_501_40',$newFrom);
  $ENPP_501_41_From = busqueda('apbad004','ENPP_501_41',$newFrom);
  $ENPP_501_42_From = busqueda('apbad004','ENPP_501_42',$newFrom);
  $ENPP_501_60_From = busqueda('apbad006','ENPP_501_60',$newFrom);
  $ENPP_501_61_From = busqueda('apbad006','ENPP_501_61',$newFrom);
  $ENPP_501_62_From = busqueda('apbad006','ENPP_501_62',$newFrom);


  $category['name'] = 'fecha';
  $titulo['text'] = "<b>$from</b> comparado con <b>$to</b>";

  while($r1 = mysql_fetch_array($ENPP_501_20_From)) {
        $category['data'][] = $r1['fecha'];
        $series1['data'][] = $r1['cpu'];
      }
  while($r2 = mysql_fetch_array($ENPP_501_21_From)) {
        $series2['data'][] = $r2['cpu'];
      }
  while($r3 = mysql_fetch_array($ENPP_501_22_From)) {
        $series3['data'][] = $r3['cpu'];
      }
  while($r4 = mysql_fetch_array($ENPP_501_30_From)) {
        $series4['data'][] = $r4['cpu'];
      }
  while($r5 = mysql_fetch_array($ENPP_501_31_From)) {
        $series5['data'][] = $r5['cpu'];
      }
  while($r6 = mysql_fetch_array($ENPP_501_32_From)) {
        $series6['data'][] = $r6['cpu'];
      }
  while($r7 = mysql_fetch_array($ENPP_501_40_From)) {
        $series7['data'][] = $r7['cpu'];
      }
  while($r8 = mysql_fetch_array($ENPP_501_41_From)) {
        $series8['data'][] = $r8['cpu'];
      }
  while($r9 = mysql_fetch_array($ENPP_501_42_From)) {
        $series9['data'][] = $r9['cpu'];
      }
  while($r10 = mysql_fetch_array($ENPP_501_60_From)) {
        $series10['data'][] = $r10['cpu'];
      }
  while($r11 = mysql_fetch_array($ENPP_501_61_From)) {
        $series11['data'][] = $r11['cpu'];
      }
  while($r12 = mysql_fetch_array($ENPP_501_62_From)) {
        $series12['data'][] = $r12['cpu'];
      }

  while($r13 = mysql_fetch_array($ENPP_501_20_To)) {
        $series13['data'][] = $r13['cpu'];
      }
  while($r14 = mysql_fetch_array($ENPP_501_21_To)) {
        $series14['data'][] = $r14['cpu'];
      }
  while($r15 = mysql_fetch_array($ENPP_501_22_To)) {
        $series15['data'][] = $r15['cpu'];
      }
  while($r16 = mysql_fetch_array($ENPP_501_30_To)) {
        $series16['data'][] = $r16['cpu'];
      }
  while($r17 = mysql_fetch_array($ENPP_501_31_To)) {
        $series17['data'][] = $r17['cpu'];
      }
  while($r18 = mysql_fetch_array($ENPP_501_32_To)) {
        $series18['data'][] = $r18['cpu'];
      }
  while($r19 = mysql_fetch_array($ENPP_501_40_To)) {
        $series19['data'][] = $r19['cpu'];
      }
  while($r20 = mysql_fetch_array($ENPP_501_41_To)) {
        $series20['data'][] = $r20['cpu'];
      }
  while($r21 = mysql_fetch_array($ENPP_501_42_To)) {
        $series21['data'][] = $r21['cpu'];
      }
  while($r22 = mysql_fetch_array($ENPP_501_60_To)) {
        $series22['data'][] = $r22['cpu'];
      }
  while($r23 = mysql_fetch_array($ENPP_501_61_To)) {
        $series23['data'][] = $r23['cpu'];
      }
  while($r24 = mysql_fetch_array($ENPP_501_62_To)) {
        $series24['data'][] = $r24['cpu'];
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
  array_push($datos,$series19);
  array_push($datos,$series20);
  array_push($datos,$series21);
  array_push($datos,$series22);
  array_push($datos,$series23);
  array_push($datos,$series24);
  array_push($datos,$titulo);

  print json_encode($datos, JSON_NUMERIC_CHECK);

  mysql_close($conexion);

?>
