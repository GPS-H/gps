var arreglo=new Array();    
function obtenerLavados(){
    solicitud = new XMLHttpRequest();
    solicitud.open("GET","http://localhost/gps/gpsv2/xml/usosFiltrp.php");
    solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    solicitud.send();
        solicitud.onreadystatechange=function(){
      if(this.readyState===4){
          if(this.status === 200){
              var documento=solicitud.responseXML;
              var total=documento.getElementsByTagName("contenido")[0].childElementCount;
              var lavado=documento.getElementsByTagName("lavado");
              var totalUso=documento.getElementsByTagName("total");
              for(var i=0;i<total;i++){
                  arreglo[i]=new Array();
                  arreglo[i][0]=lavado[i].innerHTML;
                  arreglo[i][1]=Number(totalUso[i].innerHTML);
              }
          }
        }
      };      
}

function graficarLavados() {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Numero de usos de filtros'
        },
        subtitle: {
            text: 'Filtros asociados por cantidad de usos'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Numero de usos'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Filtros con: <b>{point.x:.1f} usos</b>'
        },
        series: [{
            name: 'Population',
            data: arreglo,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                x: 4,
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    });
}