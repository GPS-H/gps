function getNombre(){
    return document.getElementById("nombre").value;
}
function getApellido(){
    return document.getElementById("apellido").value;
}
function getDireccion(){
    return document.getElementById("direccion").value;
}
function getCorreo(){
    return document.getElementById("correo").value;
}
function getTelefono(){
    return document.getElementById("telefono").value;
}
function getCelular(){
    return document.getElementById("celular").value;
}
function limpiar(){
    document.getElementById("nombre").value="";
    document.getElementById("apellido").value="";
    document.getElementById("direccion").value="";
    document.getElementById("correo").value="";
    document.getElementById("telefono").value="";
    document.getElementById("celular").value="";
}
function almacenaPaciente(){
    var nombre = getNombre();
    var apellido = getApellido();
    var direccion = getDireccion();
    var correo = getCorreo();
    var telefono = getTelefono();
    var celular = getCelular();
    solicitud= new XMLHttpRequest();
    solicitud.open("POST", "bd/agregarPaciente.php",true);
    solicitud.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    solicitud.send("nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&correo="+correo+"&telefono="+telefono+"&celular="+celular);
    limpiar();
    alert("Se agrego un nuevo paciente con exito");
}
