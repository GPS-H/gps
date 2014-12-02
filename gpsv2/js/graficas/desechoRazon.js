var arregloRazon=new Array();
var arregloTotal=new Array();
function obtenerRazon(){
    solicitud = new XMLHttpRequest();
    solicitud.open("GET","http://localhost/gps/gpsv2/xml/filtrosDesechos.php");
    solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    solicitud.send();
        solicitud.onreadystatechange=function(){
      if(this.readyState===4){
          if(this.status === 200){
              var documento=solicitud.responseXML;
              var total=documento.getElementsByTagName("contenido")[0].childElementCount;
              var razon=documento.getElementsByTagName("razon");
              var cantidad=documento.getElementsByTagName("total");
              for(var i=0;i<total;i++){
                  arregloRazon[i]=razon[i].innerHTML;
                  arregloTotal[i]=Number(cantidad[i].innerHTML);
              }
          }
        }
      };      
}


function graficarRazon(){
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Filtros Desechados'
        },
        subtitle: {
            text: 'Razones de cambio de filtro'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: arregloRazon
        },
        yAxis: {
            opposite: true
        },
        series: [{
            name: 'Filtros',
            data: arregloTotal
        }]
    });
}
