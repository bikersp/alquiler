let tableClientes;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

// Agregar Eventos al cargar documento
document.addEventListener('DOMContentLoaded', function(){

	tableClientes = $('#tableClientes').DataTable({ /*ID de la tabla*/
        "aProcessing":true,
        "aServerside":true,
        "language": {
            "url": base_url+"/Assets/json/datatable_spanish.json" /*Idioma de visualizacion*/
        },
        "ajax":{
            "url": base_url+"/Clientes/getClientes",/* Ruta a la funcion getRoles que esta en el controlador roles.php*/
        "dataSrc":""
        },
        "columns":[/* Campos de la base de datos*/
            {"data":"idpersona"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"telefono"},
            {"data":"email_user"},
            {"data":"options"}
        ],
        "dom": 'lBfrtip',
        "buttons": [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "responsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10, /*Mostrará los primero 10 registros*/
        "order":[[0,"desc"]] /*Ordenar de forma Desendente*/
    });


    // Crear o Editar Usuario
    if (document.querySelector("#formCliente")) {
    	let formCliente = document.querySelector("#formCliente");
    	formCliente.onsubmit = function(e){
    		e.preventDefault();
    		let strIdentificacion = document.querySelector("#txtIdentificacion").value;
    		let strNombre = document.querySelector("#txtNombre").value;
    		let strApellido = document.querySelector("#txtApellido").value;
    		let strEmail = document.querySelector("#txtEmail").value;
    		let intTelefono = document.querySelector("#txtTelefono").value;
    		let strNit = document.querySelector("#txtNit").value;
            let strNomFiscal = document.querySelector("#txtNombreFiscal").value;
            let strDirFiscal = document.querySelector("#txtDirFiscal").value;
    		let strPassword = document.querySelector("#txtPassword").value;

    		if (strIdentificacion == '' || strNombre == '' || strApellido == '' || strEmail == '' || intTelefono == '' || strNit == '' || strNomFiscal == '' || strDirFiscal == '') {
    			swal("Atención", "Todos los campos son obligatorios.", "error");
    			return false;
    		}

    		let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 

            divLoading.style.display = "flex";
    		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    	    let ajaxUrl = base_url+'/Clientes/setCliente';
    	    let formData = new FormData(formCliente);
    	    request.open("POST", ajaxUrl, true);
    	    request.send(formData);

    	    request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);

                    if (objData.status) {
                        if (rowTable == "") {
                            $('#tableClientes').DataTable().ajax.reload();
                        }else{
                            rowTable.cells[1].textContent = strIdentificacion;
                            rowTable.cells[2].textContent = strNombre;
                            rowTable.cells[3].textContent = strApellido;
                            rowTable.cells[4].textContent = intTelefono;
                            rowTable.cells[5].textContent = strEmail;
                            rowTable = "";
                        }
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                        swal("Usuarios", objData.msg, "success");                         
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
    	}
    }
}, false);

// Eliminar Cliente
function fntDeleteCliente(idpersona){
    // let idUsuario = idpersona;    
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar el Cliente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm){

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxDeleteRol = base_url+'/Clientes/deleteCliente';
            let strData = "idUsuario="+idpersona;
            request.open("POST", ajaxDeleteRol, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        $('#tableClientes').DataTable().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg, "error");
                    }
                }
                return false;
            }
        }

    });
}

// Modal Ver Cliente
function fntViewCliente(idpersona){
	// let idpersona = idpersona;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Clientes/getCliente/'+idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        	let objData = JSON.parse(request.responseText);

            if (objData.status) {
            	let estadoUsuario = objData.data.status == 1 ?
            	'<span class="badge badge-success">Activo</span>' : 
            	'<span class="badge badge-danger">Inactivo</span>';

            	document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
            	document.querySelector("#celNombre").innerHTML = objData.data.nombres;
            	document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
            	document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
            	document.querySelector("#celEmail").innerHTML = objData.data.email_user;
            	document.querySelector("#celNit").innerHTML = objData.data.nit;
            	document.querySelector("#celNomFiscal").innerHTML = objData.data.nombrefiscal;
            	document.querySelector("#celDirFiscal").innerHTML = objData.data.direccionfiscal;
            	document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
            	$("#modalViewCliente").modal("show");
            }else{
            	swal("Error", objData.msg, "error");
            }
        }
        return false;
    }
}

// Modal Editar Cliente
function fntEditCliente(element, idpersona){
    rowTable = element.parentNode.parentNode.parentNode;
    // console.log(rowTable);
	document.querySelector('#titleModal').innerHTML = "Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

	// let idpersona = idpersona;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Clientes/getCliente/'+idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        	let objData = JSON.parse(request.responseText);

            if (objData.status) {
            	let estadoUsuario = objData.data.status == 1 ?
            	'<span class="badge badge-success">Activo</span>' : 
            	'<span class="badge badge-danger">Inactivo</span>';

            	document.querySelector("#idUsuario").value = objData.data.idpersona;
            	document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
            	document.querySelector("#txtNombre").value = objData.data.nombres;
            	document.querySelector("#txtApellido").value = objData.data.apellidos;
            	document.querySelector("#txtTelefono").value = objData.data.telefono;
            	document.querySelector("#txtEmail").value = objData.data.email_user;
            	document.querySelector("#txtNit").value = objData.data.nit;
            	document.querySelector("#txtNombreFiscal").value = objData.data.nombrefiscal;
            	document.querySelector("#txtDirFiscal").value = objData.data.direccionfiscal;
            }
        }
        $("#modalFormCliente").modal("show");
        return false;
    }
		    
}

// Modal Nuevo
function openModal(){
	rowTable = "";
    // document.querySelector('#idCliente').value = "";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#formCliente').reset();

	$("#modalFormCliente").modal("show");
}