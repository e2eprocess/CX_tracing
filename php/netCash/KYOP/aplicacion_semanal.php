<?php
include("../../conexion_e2e_process.php");

function busqueda($CANAL,$FECHA_QUERY){

  $resultado = mysql_query("SELECT  DATE_FORMAT(fecha, '%d/%m/%y-%k')as fecha,
                                    tiempo_respuesta,
                                    peticiones
                            FROM    seguimiento_cx_canal
                            WHERE   canal = '".$CANAL."'
                            AND     fecha > DATE_SUB('".$FECHA_QUERY."', INTERVAL 10 DAY)
                            AND     fecha <= '".$FECHA_QUERY."'");

  return $resultado;

}

$category = array();
$series1 = array();
$series2 = array();

$minuto = 10;

if(date("i")<$minuto){
  $hoy = date("Y-m-d H", strtotime('-2 hour'));
}else{
  $hoy = date("Y-m-d H", strtotime('-1 hour'));
}

$kyop_mult_web_kyoppresentation = busqueda('cash',$hoy);

$category['name'] = 'fecha';

while($r1  = mysql_fetch_array($kyop_mult_web_kyoppresentation)) {
      $series1['data'][] = $r1['tiempo_respuesta'];
      $series2['data'][] = $r1['peticiones'];
      $category['data'][] = $r1['fecha'];
    }


$datos = array();
array_push($datos,$category);
array_push($datos,$series1);
array_push($datos,$series2);


print json_encode($datos, JSON_NUMERIC_CHECK);

mysql_close($conexion);

?>