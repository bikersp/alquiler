let tableRoles;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener("DOMContentLoaded", function () {
  $("#tableRoles").DataTable({
    /*ID de la tabla*/ aProcessing: true,
    aServerside: true,
    language: {
      url:
        base_url +
        "/Assets/json/datatable_spanish.json" /*Idioma de visualizacion*/,
    },
    ajax: {
      url:
        base_url +
        "/Roles/getRoles" /* Ruta a la funcion getRoles que esta en el controlador roles.php*/,
      dataSrc: "",
    },
    columns: [
      /* Campos de la base de datos*/ { data: "idrol" },
      { data: "nombrerol" },
      { data: "descripcion" },
      { data: "status" },
      { data: "options" },
    ],
    // dom: "lBfrtip",
    // buttons: [
    //   {
    //     extend: "copyHtml5",
    //     text: "<i class='far fa-copy'></i> Copiar",
    //     titleAttr: "Copiar",
    //     className: "btn btn-secondary",
    //   },
    //   {
    //     extend: "excelHtml5",
    //     text: "<i class='fas fa-file-excel'></i> Excel",
    //     titleAttr: "Esportar a Excel",
    //     className: "btn btn-success",
    //   },
    //   {
    //     extend: "pdfHtml5",
    //     text: "<i class='fas fa-file-pdf'></i> PDF",
    //     titleAttr: "Esportar a PDF",
    //     className: "btn btn-danger",
    //   },
    //   {
    //     extend: "csvHtml5",
    //     text: "<i class='fas fa-file-csv'></i> CSV",
    //     titleAttr: "Esportar a CSV",
    //     className: "btn btn-info",
    //   },
    // ],
    responsieve: "true",
    bDestroy: true,
    iDisplayLength: 10 /*Mostrará los primero 10 registros*/,
    order: [[0, "desc"]] /*Ordenar de forma Desendente*/,
  });

  //Nuevo Rol
  let formRol = document.querySelector("#formRol");
  formRol.onsubmit = function (e) {
    e.preventDefault(); // Evita que se recargue la pag

    let intIdRol = document.querySelector("#idRol").value;
    let strNombre = document.querySelector("#txtNombre").value;
    let strDescripcion = document.querySelector("#txtDescripcion").value;
    let intStatus = document.querySelector("#listStatus").value;

    if (strNombre == "" || strDescripcion == "") {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }

    divLoading.style.display = "flex";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Roles/setRol";
    let formData = new FormData(formRol);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);

        if (objData.status) {
          if (rowTable == "") {
            $("#tableRoles").DataTable().ajax.reload();
          } else {
            htmlStatus =
              intStatus == 1
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';

            rowTable.cells[1].textContent = strNombre;
            rowTable.cells[2].textContent = strDescripcion;
            rowTable.cells[3].innerHTML = htmlStatus;
            rowTable = "";
          }
          $("#modalFormRol").modal("hide");
          formRol.reset();
          swal("Rol de usuario", objData.msg, "success");
        } else {
          swal("Error", objData.msg, "error");
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
});

// Datatables
$("#tableRoles").DataTable();

// Modal Nuevo
function openModal() {
  document.querySelector("#idRol").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formRol").reset();

  $("#modalFormRol").modal("show");
}

// Activacion de funcion fntEditRol
window.addEventListener(
  "load",
  function () {
    // fntEditRol();
    // fntDeleteRol();
    // fntPermisos();
  },
  false
);

// Modal Actualizar
function fntEditRol(element, idrol) {
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector("#titleModal").innerHTML = "Actualizar";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  // let idrol = idrol;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Roles/getRol/" + idrol;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idRol").value = objData.msg.idrol;
        document.querySelector("#txtNombre").value = objData.msg.nombrerol;
        document.querySelector("#txtDescripcion").value =
          objData.msg.descripcion;

        if (objData.msg.status == 1) {
          var optionSelect =
            '<option value="1" selected class="d-none">Activo</option>';
        } else {
          var optionSelect =
            '<option value="2" selected class="d-none">Inactivo</option>';
        }

        var htmlSelect = ` ${optionSelect}
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                                `;
        document.querySelector("#listStatus").innerHTML = htmlSelect;
        $("#modalFormRol").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
    return false;
  };
}

// Eliminar
function fntDeleteRol(idrol) {
  // let idrol = idrol;

  swal(
    {
      title: "Eliminar Rol",
      text: "¿Realmente quiere eliminar el Rol?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "No, cancelar",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxDeleteRol = base_url + "/Roles/deleteRol";
        let strData = "idrol=" + idrol;
        request.open("POST", ajaxDeleteRol, true);
        request.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              $("#tableRoles").DataTable().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
          return false;
        };
      }
    }
  );
}

// Mostrar Permisos
function fntPermisos(idrol) {
  // let idrol = idrol;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Permisos/getPermisosRol/" + idrol;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#contentAjax").innerHTML = request.responseText;
      $(".modalPermisos").modal("show");
      document
        .querySelector("#formPermisos")
        .addEventListener("submit", fntSavePermisos, false);
    }
  };
}

// Guardar Permisos
function fntSavePermisos(event) {
  event.preventDefault();
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Permisos/setPermisos";
  let formElement = document.querySelector("#formPermisos");
  let formData = new FormData(formElement);
  request.open("POST", ajaxUrl, true);
  request.send(formData);

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        swal("Permisos de Usuario!", objData.msg, "success");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
