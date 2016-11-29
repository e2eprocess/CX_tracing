$(document).ready(function() {
  var options = {
          chart: {
            renderTo: 'aplicacion_mensual',
            marginRight: 130,
            zoomType: 'xy'
          },
          title: {
            text: 'KYFB - APLICACIÓN',
            x: -20 //center
          },
          subtitle: {
            text: 'Visión últimos 40 días',
            x: -20
          },
          credits: {
            enabled: false
          },
          xAxis: {
            //type: 'datetime',
            tickPixelInterval: 150,
            crosshair: true,
            categories: []
          },
          yAxis: [{ //tiempo de respuesta
            labels: {
              format: '{value} ms'
            },
            title: {
              text: 'Tiempo de respuesta (ms)'
            }
          },{ //Peticiones
            labels: {
              format: '{value}'
            },
            title: {
              text: 'Peticiones por minuto'
            },
            opposite: true
          }],
          tooltip: {
              shared: true
          },
          legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom',
              borderWidth: 1,
              itemStyle:{
                  fontSize: "10px"
                }

          },
          plotOptions: {
              line: {
                marker: {
                  enabled: false,
                  symbol: 'circle',
                  radius: 1,
                  states : {
                    hover: {enabled: true}
                  }
                }
              },
              spline: {
                marker: {
                  enabled: false,
                  symbol: 'circle',
                  radius: 1,
                  states : {
                    hover: {enabled: true}
                  }
                }
              }
          },
          /*series: []*/
          series: [{
            name: 'Tiempo Respuesta kyfb_mult_web_firmas_04',
            color: 'rgba(248,0,0,1.0)',
            type: 'line',
            index: 1,
            legendIndex: 0,
            data:[]
          },{
            name: 'Peticiones kyfb_mult_web_firmas_04',
            color: 'rgba(65,105,225,1.0)',
            type: 'column',
            yAxis: 1,
            index: 0,
            legendIndex: 1,
            data:[]
          },{
            name: 'Tiempo Respuesta kyfb_mult_web_kyfbws_03',
            color: 'rgba(248,0,0,1.0)',
            type: 'line',
            index: 1,
            legendIndex: 0,
            data:[]
          },{
            name: 'Peticiones kyfb_mult_web_kyfbws_03',
            color: 'rgba(65,105,225,1.0)',
            type: 'column',
            yAxis: 1,
            index: 0,
            legendIndex: 1,
            data:[]
          }]
      }

      $.getJSON("../php/netCash/KYFB/aplicacion_mensual.php", function(json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0].data = json[1]['data'];
        options.series[1].data = json[2]['data'];
        options.series[2].data = json[3]['data'];
        options.series[3].data = json[4]['data'];

        chart = new Highcharts.Chart(options);
      });
  });