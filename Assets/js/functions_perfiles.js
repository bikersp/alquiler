// Modal Nuevo
function openModal(){
    document.querySelector('#idUsuario').value = "";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#formUsuario').reset();

	$("#modalFormUsuario").modal("show");
}

// Modal PErfil
function openModalPerfil(){
	$('modalFormPerfil').modal('show');
}