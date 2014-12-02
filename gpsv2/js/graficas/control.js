function dibujar(){
    var lista=document.getElementById('lista').value;
    if(lista==="pacienteEdad"){
        graficarPacientesEdades();
    }
    if(lista==="desechoRazon"){
        graficarRazon();
    }
    if(lista==="filtrosUsos"){
        graficarLavados();
    }
}
function descargar(){
    var lista=document.getElementById('lista2').value;
    if(lista=="reporteFull"){
        window.location="reporteexcel.php";
    }
    if(lista=="reportePacienteFiltro"){
        window.location="excelPacientesFiltros.php";
    }
    if(lista=="reporteFiltros"){
        window.location="excelFiltros.php";
    }
}
