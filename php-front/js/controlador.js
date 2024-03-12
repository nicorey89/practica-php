var usuarios = [];
var usuarioSeleccionado;

function obtenerUsuarios(){
    axios({
        method:'GET',
        url:'../../api-rest/api/index.php',
        responseType:'json'
    }).then(res=>{
        console.log(res.data);
        this.usuarios = res.data;
        llenarTablas();
    }).catch(error=>{
        console.log(error);
    });
}

obtenerUsuarios();

function llenarTablas(){
    document.querySelector('#tabla-usuarios tbody').innerHTML = '';
    for (let i = 0; i < usuarios.length; i++) {
        document.querySelector('#tabla-usuarios tbody').innerHTML +=
        `<tr>
        <td>${usuarios[i].nombre}</td>
        <td>${usuarios[i].apellido}</td>
        <td>${usuarios[i].fechaDeNacimiento}</td>
        <td>${usuarios[i].genero}</td>
        <td><button type="button" onclick="eliminar(${i})">X</button></td>
        <td><button type="button" onclick="seleccionar(${i})">editar</button></td>
        </tr>`;
        
    }
};

function eliminar(indice){
    axios({
        method:'DELETE',
        url:`../../api-rest/api/index.php?id=${indice}`,
        responseType:'json'
    }).then(res=>{
        console.log(res.data);
        obtenerUsuarios();
    }).catch(error=>{
        console.log(error);
    });
};

function guardar(){
    let usuario = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        fechaDeNacimiento: document.getElementById('fechaDeNacimiento').value,
        genero: document.getElementById('genero').value
    }
    console.log(usuario);
    axios({
        method:'POST',
        url:`../../api-rest/api/index.php`,
        responseType:'json',
        data: usuario
    }).then(res=>{
        console.log(res);
        obtenerUsuarios();
        vaciarFormulario();
    }).catch(error=>{
        console.log(error);
    });
};

function vaciarFormulario(){
    document.getElementById('nombre').value=null;
    document.getElementById('apellido').value=null;
    document.getElementById('fechaDeNacimiento').value=null;
    document.getElementById('genero').value='masculino';
    document.getElementById('btn-guardar').style.display = "inline";
    document.getElementById('btn-actualizar').style.display = "none";
};

function actualizar(){
     let usuario = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        fechaDeNacimiento: document.getElementById('fechaDeNacimiento').value,
        genero: document.getElementById('genero').value
    }
    console.log(usuario);
    axios({
        method:'PUT',
        url:`../../api-rest/api/index.php?id=${usuarioSeleccionado}`,
        responseType:'json',
        data: usuario
    }).then(res=>{
        console.log(res);
        obtenerUsuarios();
        vaciarFormulario();
    }).catch(error=>{
        console.log(error);
    }); 
};

function seleccionar(indice){
    console.log('selecciono el indice: ' + indice)
    usuarioSeleccionado = indice;
    axios({
        method:'GET',
        url:`../../api-rest/api/index.php/?id=${indice}`,
        responseType:'json'
    }).then(res=>{
        console.log(res);
        document.getElementById('nombre').value=res.data.nombre;
        document.getElementById('apellido').value=res.data.apellido;
        document.getElementById('fechaDeNacimiento').value=res.data.fechaDeNacimiento;
        document.getElementById('genero').value=res.data.genero;
        document.getElementById('btn-guardar').style.display = "none";
        document.getElementById('btn-actualizar').style.display = "inline";
    }).catch(error=>{
        console.log(error);
    });
};