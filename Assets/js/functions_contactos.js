let rowTable = "";
let tableContactos;
tableContactos = $("#tableContactos").dataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url:
      base_url +
      "/Assets/json/datatable_spanish.json" /*Idioma de visualizacion*/
  },
  ajax: {
    url: " " + base_url + "/contactos/getContactos",
    dataSrc: ""
  },
  columns: [
    // { data: "idcontacto" },
    { data: "idcontacto" },
    { data: "email" },
    { data: "nombre" },
    { data: "mensaje" },
    { data: "fecha" }
    // { data: "options" },
  ],
  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "desc"]]
});

// Ver Contacto
function fntViewInfo(idmensaje) {
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Contactos/getMensaje/" + idmensaje;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celEmail").innerHTML = objData.data.email;
        document.querySelector("#celFecha").innerHTML = objData.data.fecha;
        document.querySelector("#celMensaje").innerHTML = objData.data.mensaje;
        $("#modalViewMensaje").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
    return false;
  };
}

// Modal Nuevo Mensaje
function openModal() {
  rowTable = "";
  document.querySelector("#frmMensaje").reset();
  $("#modalFormMensaje").modal("show");
}

//Mensaje
if (document.querySelector("#frmMensaje")) {
  let frmMensaje = document.querySelector("#frmMensaje");
  frmMensaje.addEventListener(
    "submit",
    function (e) {
      e.preventDefault();

      let nombre = document.querySelector("#nombreContacto").value;
      let email = document.querySelector("#emailContacto").value;
      let mensaje = document.querySelector("#mensaje").value;

      if (nombre == "") {
        swal("", "El Asunto es obligatorio", "error");
        return false;
      }

      // if (!fntEmailValidate(email)) {
      //   swal("", "El email no es válido.", "error");
      //   return false;
      // }

      if (mensaje == "") {
        swal("", "Por favor escribe el mensaje", "error");
        return false;
      }

      divLoading.style.display = "flex";
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/Tienda/contacto";
      let formData = new FormData(frmMensaje);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            swal("", objData.msg, "success");
            document.querySelector("#frmMensaje").reset();
            $("#tableContactos").DataTable().ajax.reload();
            $("#modalFormMensaje").modal("hide");
          } else {
            swal("", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    },
    false
  );
}
