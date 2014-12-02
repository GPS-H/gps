var pacientesEdades=new Array();    
function obtenerPacientesEdades(){
    solicitud = new XMLHttpRequest();
    solicitud.open("GET","http://localhost/gps/gpsv2/xml/pacientesEdades.php");
    solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    solicitud.send();
        solicitud.onreadystatechange=function(){
      if(this.readyState===4){
          if(this.status === 200){
              var documento=solicitud.responseXML;
              var total=documento.getElementsByTagName("contenido")[0].childElementCount;
              var rango=documento.getElementsByTagName("rango");
              var totalPaciente=documento.getElementsByTagName("total");
              for(var i=0;i<total;i++){
                  pacientesEdades[i]=new Array();
                  pacientesEdades[i][0]=rango[i].innerHTML;
                  pacientesEdades[i][1]=Number(totalPaciente[i].innerHTML);
              }
          }
        }
      };      
}

function graficarPacientesEdades(){
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Porcentaje de pacientes agrupados por edad'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'

        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Pacientes',
            data: pacientesEdades
        }]
    });
}
