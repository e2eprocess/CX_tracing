$(document).ready(function() {
  var options = {
          chart: {
            renderTo: 'tiempoRespuesta',
            marginRight: 130,
            zoomType: 'xy'
          },
          title: {
            text: 'Tiempo de respuesta (ms.)',
            x: -20 //center
          },
          subtitle: {
            text: [],
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
            name: 'kqof_es_web_BBVANet_01 (F)',
            color: 'rgba(82,190,128,1)',
            type: 'spline',
            dashStyle: 'shortdot',
            data:[]
          },{
            name: 'kqof_es_web_BBVANet_01 (T)',
            color: 'rgba(82,190,128,1)',
            type: 'line',
            data:[]
          }]
      }

      $.getJSON("../php/netParticulares/KQOF/tiempoRespuesta.php", function(json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0].data = json[1]['data'];
        options.series[1].data = json[2]['data'];
        options.subtitle.text = json[3]['text'];

        chart = new Highcharts.Chart(options);
      });
  });