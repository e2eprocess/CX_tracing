$(document).ready(function() {
  var options = {
          chart: {
            renderTo: 'peticiones',
            marginRight: 130,
            zoomType: 'xy'
          },
          title: {
            text: 'Peticiones',
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
              format: '{value}'
            },
            title: {
              text: 'Peticiones EECC'
            },
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
            name: 'EECC (F)',
            color: 'rgba(65,105,225,1.0)',
            type: 'spline',
            marker:{
              enabled: false
            },
            dashStyle: 'shortdot',
            data:[]
          },{
            name: 'EECC (T)',
            color: 'rgba(65,105,225,1.0)',
            type: 'line',
            data:[]
          },{
            name: 'Max. Peticiones (7/11)',
            color: 'rgba(255,0,0,1.0)',
            type: 'line',
            data:[]
          }]
      }

      $.getJSON("../php/oficinas/EECC/peticiones.php", function(json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0].data = json[1]['data'];
        options.series[1].data = json[2]['data'];
        options.subtitle.text = json[3]['text'];
        options.series[2].data = json[4]['data'];

        chart = new Highcharts.Chart(options);
      });
  });